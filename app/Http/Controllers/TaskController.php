<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display the task list.
     */
    public function index()
    {
        $userId = Auth::id();

        // Dashboard statistics
        $totalTasks = Task::where('user_id', $userId)->count();

        $pendingTasks = Task::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        $completedTasks = Task::where('user_id', $userId)
            ->where('status', 'completed')
            ->count();

        $highPriorityTasks = Task::where('user_id', $userId)
            ->where('priority', 'high')
            ->count();

        // Search and filters
        $search = request('search');
        $status = request('status');
        $priority = request('priority');
        $sort = request('sort', 'newest');

        // Retrieve only the logged-in user's tasks
        $query = Task::where('user_id', $userId);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if (in_array($status, ['pending', 'completed'], true)) {
            $query->where('status', $status);
        }

        if (in_array($priority, ['low', 'medium', 'high'], true)) {
            $query->where('priority', $priority);
        }

        // Sorting
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;

            case 'due_date':
                $query->orderByRaw('due_date IS NULL, due_date ASC');
                break;

            case 'priority':
                $query->orderByRaw(
                    "FIELD(priority, 'high', 'medium', 'low')"
                );
                break;

            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Pagination and category relationship
        $tasks = $query->with('category')->paginate(5)->withQueryString();

        // Categories for the task form
        $categories = Category::orderBy('name')->get();

        return view('tasks.index', compact(
            'tasks',
            'search',
            'status',
            'priority',
            'sort',
            'totalTasks',
            'pendingTasks',
            'completedTasks',
            'highPriorityTasks',
            'categories'
        ));
    }

    /**
     * Store a newly created task.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date|after_or_equal:today',
        ]);

        $validated['status'] = 'pending';
        $validated['user_id'] = Auth::id();

        Task::create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully!');
    }

    /**
     * Show the form for editing a task.
     */
    public function edit(Task $task)
    {
        abort_unless($task->user_id === Auth::id(), 403);

        $categories = Category::orderBy('name')->get();

        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified task.
     */
    public function update(Request $request, Task $task)
    {
        abort_unless($task->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date|after_or_equal:today',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }

    /**
     * Delete the specified task.
     */
    public function destroy(Task $task)
    {
        abort_unless($task->user_id === Auth::id(), 403);

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }

    /**
     * Mark a task as completed.
     */
    public function complete(Task $task)
    {
        abort_unless($task->user_id === Auth::id(), 403);

        $task->update([
            'status' => 'completed',
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task completed successfully!');
    }
}
