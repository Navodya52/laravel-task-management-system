<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display the task list.
     */
    public function index()
    {
        // Get the logged-in user's ID
        $userId = Auth::id();


        // Dashboard Statistics

        $totalTasks = Task::where(
            'user_id',
            $userId
        )->count();

        $pendingTasks = Task::where(
            'user_id',
            $userId
        )->where(
            'status',
            'pending'
        )->count();

        $completedTasks = Task::where(
            'user_id',
            $userId
        )->where(
            'status',
            'completed'
        )->count();

        $highPriorityTasks = Task::where(
            'user_id',
            $userId
        )->where(
            'priority',
            'high'
        )->count();


        // Search and Filters

        $search = request('search');

        $status = request('status');

        $priority = request('priority');

        $sort = request('sort', 'newest');


        // Create Query
        // Only get tasks belonging to the logged-in user

        $query = Task::where(
            'user_id',
            $userId
        );


        // Search by title

        if ($search) {

            $query->where(
                'title',
                'like',
                '%' . $search . '%'
            );
        }


        // Filter by status

        if ($status) {

            $query->where(
                'status',
                $status
            );
        }


        // Filter by priority

        if ($priority) {

            $query->where(
                'priority',
                $priority
            );
        }


        // Sorting

        switch ($sort) {

            case 'oldest':

                $query->orderBy(
                    'created_at',
                    'asc'
                );

                break;


            case 'due_date':

                $query->orderByRaw(
                    'due_date IS NULL, due_date ASC'
                );

                break;


            case 'priority':

                $query->orderByRaw(
                    "FIELD(priority, 'high', 'medium', 'low')"
                );

                break;


            case 'newest':

            default:

                $query->orderBy(
                    'created_at',
                    'desc'
                );

                break;
        }


        // Pagination

        $tasks = $query->paginate(5);


        // Send data to Blade view

        return view(
            'tasks.index',
            compact(
                'tasks',
                'search',
                'status',
                'priority',
                'sort',
                'totalTasks',
                'pendingTasks',
                'completedTasks',
                'highPriorityTasks'
            )
        );
    }


    /**
     * Store a newly created task.
     */
    public function store()
    {
        // Validate the task data

        $validated = request()->validate([

            'title' => 'required|string|max:255',

            'description' => 'nullable|string',

            'priority' => 'required|in:low,medium,high',

            'due_date' => 'nullable|date|after_or_equal:today',

        ]);


        // New tasks are pending by default

        $validated['status'] = 'pending';


        // Attach the logged-in user to the task

        $validated['user_id'] = Auth::id();


        // Create the task

        Task::create($validated);


        return redirect('/tasks')
            ->with(
                'success',
                'Task created successfully!'
            );
    }


    /**
     * Show the form for editing a task.
     */
    public function edit(Task $task)
    {
        // Check whether the task belongs to the logged-in user

        if ($task->user_id !== Auth::id()) {
            abort(403);
        }


        return view(
            'tasks.edit',
            compact('task')
        );
    }


    /**
     * Update the specified task.
     */
    public function update(
        Request $request,
        Task $task
    ) {

        // Check whether the task belongs to the logged-in user

        if ($task->user_id !== Auth::id()) {
            abort(403);
        }


        // Validate the task data

        $validated = $request->validate([

            'title' => 'required|string|max:255',

            'description' => 'nullable|string',

            'priority' => 'required|in:low,medium,high',

            'due_date' => 'nullable|date|after_or_equal:today',

        ]);


        // Update the task

        $task->update($validated);


        return redirect('/tasks')
            ->with(
                'success',
                'Task updated successfully!'
            );
    }


    /**
     * Delete the specified task.
     */
    public function destroy(Task $task)
    {
        // Check whether the task belongs to the logged-in user

        if ($task->user_id !== Auth::id()) {
            abort(403);
        }


        // Delete the task

        $task->delete();


        return redirect('/tasks')
            ->with(
                'success',
                'Task deleted successfully!'
            );
    }


    /**
     * Mark the specified task as completed.
     */
    public function complete(Task $task)
    {
        // Check whether the task belongs to the logged-in user

        if ($task->user_id !== Auth::id()) {
            abort(403);
        }


        // Mark the task as completed

        $task->update([
            'status' => 'completed',
        ]);


        return redirect('/tasks')
            ->with(
                'success',
                'Task completed successfully!'
            );
    }
}