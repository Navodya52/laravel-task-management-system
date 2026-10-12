
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>

    
<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: "Segoe UI", Arial, sans-serif;
        background: #f8f5ff;
        color: #30234a;
    }

    
    .navbar {
        background: linear-gradient(135deg, #ec4899, #7c3aed);
        color: white;
        padding: 18px 6%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        box-shadow: 0 4px 20px rgba(76, 29, 149, 0.25);
    }


    .navbar h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
    }

    .navbar a {
        color: white;
        text-decoration: none;
    }

    .container {
        max-width: 1400px;
        margin: 32px auto;
        padding: 0 24px;
    }

    .welcome {
        margin-bottom: 28px;
    }

    .welcome h1 {
        margin-bottom: 8px;
        font-size: 32px;
        color: #951d83;
        font-weight: 750;
    }

    .welcome p {
        color: #786b91;
        margin-top: 0;
        font-size: 15px;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }

    .stat-card,
    .panel {
        background: #ffffff;
        padding: 24px;
        border: 1px solid #eee6ff;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(91, 33, 182, 0.07);
    }

    .stat-card {
        border-top: 4px solid #8b5cf6;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(91, 33, 182, 0.12);
    }

    .stat-card p {
        color: #786b91;
        margin: 0 0 12px;
        font-size: 15px;
    }

    .stat-card h2 {
        margin: 0;
        font-size: 32px;
        color: #6d28d9;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 350px minmax(0, 1fr);
        gap: 24px;
        align-items: start;
    }

    .panel h2 {
        font-size: 21px;
        margin-top: 0;
        margin-bottom: 22px;
        color: #4c1d95;
    }

    .form-group {
        margin-bottom: 18px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #493765;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #e2d6f8;
        border-radius: 10px;
        background: #fdfbff;
        font-family: inherit;
        font-size: 14px;
        color: #30234a;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    input:focus,
    textarea:focus,
    select:focus {
        outline: none;
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.13);
        background: #ffffff;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    .btn {
        display: inline-block;
        border: none;
        border-radius: 9px;
        padding: 11px 16px;
        cursor: pointer;
        font-family: inherit;
        font-size: 13px;
        font-weight: 650;
        text-decoration: none;
        text-align: center;
        transition: all 0.2s;
    }

    .btn-primary {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        color: white;
        box-shadow: 0 4px 10px rgba(109, 40, 217, 0.18);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #6d28d9, #5b21b6);
        transform: translateY(-1px);
    }

    .btn-success {
        background: #ede9fe;
        color: #5b21b6;
    }

    .btn-success:hover {
        background: #ddd6fe;
    }

    .btn-danger {
        background: #fce7f3;
        color: #be185d;
    }

    .btn-danger:hover {
        background: #fbcfe8;
    }

    .btn-secondary {
        background: #f1ebfc;
        color: #5b21b6;
    }

    .btn-secondary:hover {
        background: #e9ddff;
    }

    .full-width {
        width: 100%;
        padding: 13px;
        font-size: 14px;
    }

    .alert {
        padding: 15px 18px;
        border-radius: 11px;
        margin-bottom: 20px;
    }

    .alert-success {
        background: #ede9fe;
        color: #5b21b6;
        border: 1px solid #ddd6fe;
    }

    .alert-error {
        background: #fce7f3;
        color: #9d174d;
        border: 1px solid #fbcfe8;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 10px;
        margin-bottom: 16px;
    }

    .filter-buttons {
        display: flex;
        gap: 9px;
        flex-wrap: wrap;
        margin-top: 10px;
    }

    .task-card {
        background: #ffffff;
        border: 1px solid #eee6ff;
        border-radius: 13px;
        padding: 19px;
        margin-bottom: 15px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .task-card:hover {
        border-color: #d8b4fe;
        box-shadow: 0 5px 16px rgba(91, 33, 182, 0.06);
    }

    .task-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
    }

    .task-title {
        font-size: 17px;
        font-weight: 700;
        color: #3b2460;
        margin: 0 0 8px;
        overflow-wrap: anywhere;
    }

    .task-description {
        color: #786b91;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
        font-size: 14px;
        line-height: 1.6;
    }

    .task-meta {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin: 14px 0;
    }

    .badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background: #f1ebfc;
        color: #5b21b6;
    }

    .priority-high {
        background: #fce7f3;
        color: #be185d;
    }

    .priority-medium {
        background: #fef3c7;
        color: #92400e;
    }

    .priority-low {
        background: #dcfce7;
        color: #166534;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-completed {
        background: #dcfce7;
        color: #166534;
    }

    .task-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 14px;
    }

    .task-actions form {
        margin: 0;
    }

    .empty-state {
        padding: 35px 15px;
        text-align: center;
        color: #786b91;
    }

    .pagination {
        margin-top: 20px;
    }

    .pagination nav {
        display: flex;
        justify-content: center;
    }

    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 8px 12px;
        margin: 2px;
        border-radius: 8px;
        text-decoration: none;
    }

    .pagination a {
        color: #6d28d9;
        background: #f1ebfc;
    }

    .pagination span {
        color: #786b91;
    }

    .error-text {
        color: #be185d;
        font-size: 13px;
        margin-top: 5px;
    }

    hr {
        border: 0;
        border-top: 1px solid #eee6ff;
    }

    @media (max-width: 900px) {
        .stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .content-grid {
            grid-template-columns: 1fr;
        }

        .filter-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 520px) {
        .container {
            padding: 0 12px;
            margin-top: 20px;
        }

        .stats {
            gap: 10px;
        }

        .stat-card,
        .panel {
            padding: 16px;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .task-top {
            flex-direction: column;
        }

        .welcome h1 {
            font-size: 26px;
        }
    }
</style>

</head>

<body>

    <header class="navbar">
        <h2>Task Manager</h2>

        <div>
            @auth
                <span>Welcome, {{ auth()->user()->name }}</span>
                &nbsp; | &nbsp;
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}"
                      method="POST" style="display:none;">
                    @csrf
                </form>
            @endauth
        </div>
    </header>

    <main class="container">

        <section class="welcome">
            <h1>My Dashboard</h1>
            <p>Organize your work, manage your tasks, and track your progress.</p>
        </section>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <strong>Please check the following errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="stats">
            <div class="stat-card">
                <p>Total Tasks</p>
                <h2>{{ $totalTasks }}</h2>
            </div>

            <div class="stat-card">
                <p>Pending Tasks</p>
                <h2>{{ $pendingTasks }}</h2>
            </div>

            <div class="stat-card">
                <p>Completed Tasks</p>
                <h2>{{ $completedTasks }}</h2>
            </div>

            <div class="stat-card">
                <p>High Priority</p>
                <h2>{{ $highPriorityTasks }}</h2>
            </div>
        </section>

        <div class="content-grid">

            <!-- Create Task Form -->
            <section class="panel">
                <h2>+ Add New Task</h2>

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="title">Task Title *</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title') }}"
                            placeholder="Enter task title"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            placeholder="Describe your task..."
                        >{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>

                        <select name="category_id" id="category_id">
                            <option value="">Select Category (Optional)</option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="priority">Priority *</label>

                        <select name="priority" id="priority" required>
                            <option value="low"
                                {{ old('priority', 'medium') == 'low' ? 'selected' : '' }}>
                                Low
                            </option>

                            <option value="medium"
                                {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>
                                Medium
                            </option>

                            <option value="high"
                                {{ old('priority') == 'high' ? 'selected' : '' }}>
                                High
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input
                            type="date"
                            name="due_date"
                            id="due_date"
                            value="{{ old('due_date') }}"
                            min="{{ date('Y-m-d') }}"
                        >
                    </div>

                    <button type="submit" class="btn btn-primary full-width">
                        Add Task
                    </button>
                </form>
            </section>

            <!-- Task List -->
            <section class="panel">
                <h2>My Tasks</h2>

                <!-- Search and Filters -->
                <form action="{{ route('tasks.index') }}" method="GET">
                    <div class="filter-grid">
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Search by title..."
                            aria-label="Search tasks"
                        >

                        <select name="status" aria-label="Filter by status">
                            <option value="">All Statuses</option>
                            <option value="pending"
                                {{ $status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="completed"
                                {{ $status == 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>
                        </select>

                        <select name="priority" aria-label="Filter by priority">
                            <option value="">All Priorities</option>
                            <option value="high"
                                {{ $priority == 'high' ? 'selected' : '' }}>
                                High
                            </option>
                            <option value="medium"
                                {{ $priority == 'medium' ? 'selected' : '' }}>
                                Medium
                            </option>
                            <option value="low"
                                {{ $priority == 'low' ? 'selected' : '' }}>
                                Low
                            </option>
                        </select>

                        <select name="sort" aria-label="Sort tasks">
                            <option value="newest"
                                {{ $sort == 'newest' ? 'selected' : '' }}>
                                Newest First
                            </option>
                            <option value="oldest"
                                {{ $sort == 'oldest' ? 'selected' : '' }}>
                                Oldest First
                            </option>
                            <option value="due_date"
                                {{ $sort == 'due_date' ? 'selected' : '' }}>
                                Due Date
                            </option>
                            <option value="priority"
                                {{ $sort == 'priority' ? 'selected' : '' }}>
                                Priority
                            </option>
                        </select>
                    </div>

                    <div class="filter-buttons">
                        <button type="submit" class="btn btn-primary">
                            Search / Filter
                        </button>

                        <a href="{{ route('tasks.index') }}"
                           class="btn btn-secondary">
                            Clear Filters
                        </a>
                    </div>
                </form>

                <hr style="border:0; border-top:1px solid #e5e9f2; margin:22px 0;">

                @forelse ($tasks as $task)
                    <article class="task-card">
                        <div class="task-top">
                            <div>
                                <h3 class="task-title">
                                    {{ $task->title }}
                                </h3>

                                @if ($task->description)
                                    <p class="task-description">
                                        {{ $task->description }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="task-meta">
                            <span class="badge status-{{ $task->status }}">
                                {{ ucfirst($task->status) }}
                            </span>

                            <span class="badge priority-{{ $task->priority }}">
                                {{ ucfirst($task->priority) }} Priority
                            </span>

                            <span class="badge">
                                Category:
                                {{ $task->category ? $task->category->name : 'Uncategorized' }}
                            </span>

                            @if ($task->due_date)
                                <span class="badge">
                                    Due: {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                                </span>
                            @endif
                        </div>

                        <div class="task-actions">
                            <a href="{{ route('tasks.edit', $task) }}"
                               class="btn btn-secondary">
                                Edit
                            </a>

                            @if ($task->status !== 'completed')
                                <form action="{{ route('tasks.complete', $task) }}"
                                      method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-success">
                                        Mark Complete
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('tasks.destroy', $task) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this task?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">
                        <h3>No tasks found</h3>
                        <p>Add a new task or change your search filters.</p>
                    </div>
                @endforelse

                <div class="pagination">
                    {{ $tasks->links() }}
                </div>
            </section>

        </div>
    </main>

</body>
</html>
