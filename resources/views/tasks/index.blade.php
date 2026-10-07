<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Task Management System</title>


    {{-- Bootstrap CSS --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>


<body class="bg-light">


<div class="container py-5">


    {{-- Page Header --}}

    <div class="mb-4">

        <h1 class="fw-bold mb-1">
            Task Management System
        </h1>

        <p class="text-muted mb-0">
            Manage your tasks efficiently
        </p>

    </div>


    {{-- Dashboard Statistics --}}

    <div class="row g-3 mb-4">


        {{-- Total Tasks --}}

        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Total Tasks
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ $totalTasks }}
                            </h2>

                        </div>

                        <div class="fs-1">
                            📋
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Pending Tasks --}}

        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Pending
                            </p>

                            <h2 class="fw-bold mb-0 text-warning">
                                {{ $pendingTasks }}
                            </h2>

                        </div>

                        <div class="fs-1">
                            ⏳
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Completed Tasks --}}

        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                Completed
                            </p>

                            <h2 class="fw-bold mb-0 text-success">
                                {{ $completedTasks }}
                            </h2>

                        </div>

                        <div class="fs-1">
                            ✅
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- High Priority Tasks --}}

        <div class="col-md-3">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">
                                High Priority
                            </p>

                            <h2 class="fw-bold mb-0 text-danger">
                                {{ $highPriorityTasks }}
                            </h2>

                        </div>

                        <div class="fs-1">
                            🔴
                        </div>

                    </div>

                </div>

            </div>

        </div>


    </div>


    {{-- Success Message --}}

    @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- Validation Errors --}}

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Create New Task --}}

    <div class="card shadow-sm border-0 mb-4">


        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                Create New Task
            </h5>

        </div>


        <div class="card-body">


            <form
                action="{{ route('tasks.store') }}"
                method="POST"
            >

                @csrf


                <div class="row">


                    {{-- Task Title --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Task Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            placeholder="Enter task title"
                            value="{{ old('title') }}"
                        >

                    </div>


                    {{-- Priority --}}

                    <div class="col-md-3 mb-3">

                        <label class="form-label fw-semibold">
                            Priority
                        </label>

                        <select
                            name="priority"
                            class="form-select"
                        >

                            <option value="low">
                                Low
                            </option>

                            <option
                                value="medium"
                                {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}
                            >
                                Medium
                            </option>

                            <option value="high">
                                High
                            </option>

                        </select>

                    </div>


                    {{-- Due Date --}}

                    <div class="col-md-3 mb-3">

                        <label class="form-label fw-semibold">
                            Due Date
                        </label>

                        <input
                            type="date"
                            name="due_date"
                            class="form-control"
                            value="{{ old('due_date') }}"
                        >

                    </div>


                    {{-- Description --}}

                    <div class="col-12 mb-3">

                        <label class="form-label fw-semibold">
                            Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="3"
                            placeholder="Enter task description"
                        >{{ old('description') }}</textarea>

                    </div>


                </div>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    + Create Task
                </button>


            </form>


        </div>


    </div>


    {{-- Search & Filter --}}

    <div class="card shadow-sm border-0 mb-4">


        <div class="card-header bg-white">

            <h5 class="mb-0">
                Search, Filter & Sort
            </h5>

        </div>


        <div class="card-body">


            <form
                action="{{ route('tasks.index') }}"
                method="GET"
            >


                <div class="row align-items-end">


                    {{-- Search --}}

                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Search
                        </label>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by title..."
                            value="{{ $search }}"
                        >

                    </div>


                    {{-- Status --}}

                    <div class="col-md-2 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >

                            <option value="">
                                All
                            </option>

                            <option
                                value="pending"
                                {{ $status == 'pending' ? 'selected' : '' }}
                            >
                                Pending
                            </option>

                            <option
                                value="completed"
                                {{ $status == 'completed' ? 'selected' : '' }}
                            >
                                Completed
                            </option>

                        </select>

                    </div>


                    {{-- Priority --}}

                    <div class="col-md-2 mb-3">

                        <label class="form-label">
                            Priority
                        </label>

                        <select
                            name="priority"
                            class="form-select"
                        >

                            <option value="">
                                All
                            </option>

                            <option
                                value="low"
                                {{ $priority == 'low' ? 'selected' : '' }}
                            >
                                Low
                            </option>

                            <option
                                value="medium"
                                {{ $priority == 'medium' ? 'selected' : '' }}
                            >
                                Medium
                            </option>

                            <option
                                value="high"
                                {{ $priority == 'high' ? 'selected' : '' }}
                            >
                                High
                            </option>

                        </select>

                    </div>


                    {{-- Sort --}}

                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Sort By
                        </label>

                        <select
                            name="sort"
                            class="form-select"
                        >

                            <option
                                value="newest"
                                {{ $sort == 'newest' ? 'selected' : '' }}
                            >
                                Newest First
                            </option>

                            <option
                                value="oldest"
                                {{ $sort == 'oldest' ? 'selected' : '' }}
                            >
                                Oldest First
                            </option>

                            <option
                                value="due_date"
                                {{ $sort == 'due_date' ? 'selected' : '' }}
                            >
                                Due Date
                            </option>

                            <option
                                value="priority"
                                {{ $sort == 'priority' ? 'selected' : '' }}
                            >
                                Priority
                            </option>

                        </select>

                    </div>


                    {{-- Filter Button --}}

                    <div class="col-md-2 mb-3">

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Apply
                        </button>

                    </div>


                </div>


                {{-- Clear Filters --}}

                <a
                    href="{{ route('tasks.index') }}"
                    class="text-decoration-none"
                >
                    Clear Filters
                </a>


            </form>


        </div>


    </div>


    {{-- Task List --}}

    <div class="card shadow-sm border-0">


        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                My Tasks
            </h5>


            <span class="badge bg-primary">
                {{ $tasks->total() }} Tasks
            </span>


        </div>


        <div class="card-body">


            @if ($tasks->count() > 0)


                @foreach ($tasks as $task)


                    <div class="card mb-3 border-0 shadow-sm">


                        <div class="card-body">


                            {{-- Task Header --}}

                            <div class="d-flex justify-content-between align-items-start">


                                <div>

                                    <h5 class="fw-bold mb-2">
                                        {{ $task->title }}
                                    </h5>


                                    @if ($task->description)

                                        <p class="text-muted mb-3">
                                            {{ $task->description }}
                                        </p>

                                    @endif


                                </div>


                                {{-- Status Badge --}}

                                @if ($task->status === 'completed')

                                    <span class="badge bg-success">
                                        Completed
                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>

                                @endif


                            </div>


                            {{-- Priority and Due Date --}}

                            <div class="mb-3">


                                {{-- Priority Badge --}}

                                @if ($task->priority === 'high')

                                    <span class="badge bg-danger me-2">
                                        High Priority
                                    </span>

                                @elseif ($task->priority === 'medium')

                                    <span class="badge bg-warning text-dark me-2">
                                        Medium Priority
                                    </span>

                                @else

                                    <span class="badge bg-secondary me-2">
                                        Low Priority
                                    </span>

                                @endif


                                {{-- Due Date Status --}}

                                @if ($task->due_date)


                                    @if (
                                        \Carbon\Carbon::parse($task->due_date)->isPast()
                                        && $task->status !== 'completed'
                                    )

                                        <span class="badge bg-danger">
                                            ⚠ Overdue
                                        </span>

                                        <span class="text-danger ms-2">
                                            📅 {{ $task->due_date }}
                                        </span>


                                    @elseif (
                                        \Carbon\Carbon::parse($task->due_date)->isToday()
                                        && $task->status !== 'completed'
                                    )

                                        <span class="badge bg-warning text-dark">
                                            ⚠ Due Today
                                        </span>

                                        <span class="text-warning ms-2">
                                            📅 {{ $task->due_date }}
                                        </span>


                                    @elseif ($task->status === 'completed')

                                        <span class="text-muted">
                                            📅 Due: {{ $task->due_date }}
                                        </span>


                                    @else

                                        <span class="badge bg-info text-dark">
                                            Upcoming
                                        </span>

                                        <span class="text-muted ms-2">
                                            📅 {{ $task->due_date }}
                                        </span>

                                    @endif


                                @endif


                            </div>


                            {{-- Action Buttons --}}

                            <div>


                                {{-- Complete Button --}}

                                @if ($task->status !== 'completed')


                                    <form
                                        action="{{ route('tasks.complete', $task) }}"
                                        method="POST"
                                        class="d-inline"
                                    >

                                        @csrf

                                        @method('PATCH')


                                        <button
                                            type="submit"
                                            class="btn btn-success btn-sm"
                                        >
                                            ✓ Complete
                                        </button>


                                    </form>


                                @endif


                                {{-- Edit Button --}}

                                <a
                                    href="{{ route('tasks.edit', $task) }}"
                                    class="btn btn-outline-primary btn-sm"
                                >
                                    ✎ Edit
                                </a>


                                {{-- Delete Button --}}

                                <form
                                    action="{{ route('tasks.destroy', $task) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this task?');"
                                >

                                    @csrf

                                    @method('DELETE')


                                    <button
                                        type="submit"
                                        class="btn btn-outline-danger btn-sm"
                                    >
                                        🗑 Delete
                                    </button>


                                </form>


                            </div>


                        </div>


                    </div>


                @endforeach


                {{-- Pagination --}}

                <div class="mt-4">

                    {{ $tasks->withQueryString()->links() }}

                </div>


            @else


                {{-- No Tasks --}}

                <div class="text-center py-5">

                    <div class="fs-1 mb-3">
                        📋
                    </div>

                    <h5 class="text-muted">
                        No tasks found
                    </h5>

                    <p class="text-muted">
                        Create a new task or change your filters.
                    </p>

                </div>


            @endif


        </div>


    </div>


</div>


{{-- Bootstrap JavaScript --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>