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
            transition: background .25s, color .25s;
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
            box-shadow: 0 4px 20px rgba(124, 58, 237, .2);
        }

        .navbar h2 {
            margin: 0;
            font-size: 24px;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
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
            margin-bottom: 26px;
        }

        .welcome h1 {
            margin-bottom: 8px;
            font-size: 32px;
            color: #7c2dce;
        }

        .welcome p {
            color: #786b91;
            margin-top: 0;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 26px;
        }

        .stat-card, .panel {
            background: white;
            padding: 24px;
            border: 1px solid #eee6ff;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(91, 33, 182, .06);
            transition: background .25s, border-color .25s;
        }

        .stat-card {
            border-top: 4px solid #8b5cf6;
        }

        .stat-card p {
            color: #786b91;
            margin: 0 0 12px;
        }

        .stat-card h2 {
            margin: 0;
            font-size: 32px;
            color: #7c3aed;
        }

        .progress-panel {
            margin-bottom: 26px;
        }

        .progress-panel h2,
        .panel h2 {
            color: #6d28d9;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 21px;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .progress-percent {
            color: #7c3aed;
            font-weight: bold;
        }

        .progress-track {
            width: 100%;
            height: 14px;
            background: #ede9fe;
            border-radius: 20px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, #ec4899, #7c3aed);
            border-radius: 20px;
            transition: width .4s ease;
        }

        .progress-caption {
            color: #786b91;
            font-size: 14px;
            margin-bottom: 0;
            margin-top: 12px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 350px minmax(0, 1fr);
            gap: 24px;
            align-items: start;
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

        input, textarea, select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #e2d6f8;
            border-radius: 10px;
            background: #fdfbff;
            font-family: inherit;
            font-size: 14px;
            color: #30234a;
            transition: border-color .2s, box-shadow .2s;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, .13);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .btn {
            display: inline-block;
            border: none;
            border-radius: 9px;
            padding: 11px 15px;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            font-weight: 650;
            text-decoration: none;
            text-align: center;
            transition: all .2s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ec4899, #7c3aed);
            color: white;
        }

        .btn-primary:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .btn-success {
            background: #ede9fe;
            color: #5b21b6;
        }

        .btn-danger {
            background: #fce7f3;
            color: #be185d;
        }

        .btn-secondary {
            background: #f1ebfc;
            color: #5b21b6;
        }

        .btn-secondary:hover,
        .btn-success:hover,
        .btn-danger:hover {
            filter: brightness(.96);
        }

        .full-width {
            width: 100%;
            padding: 13px;
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
            background: white;
            border: 1px solid #eee6ff;
            border-radius: 13px;
            padding: 19px;
            margin-bottom: 15px;
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

        .pagination a, .pagination span {
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

        hr {
            border: 0;
            border-top: 1px solid #eee6ff;
        }

        /* Dark mode */
        body.dark-mode {
            background: #171225;
            color: #f3eaff;
        }

        body.dark-mode .welcome h1 {
            color: #d8b4fe;
        }

        body.dark-mode .welcome p,
        body.dark-mode .stat-card p,
        body.dark-mode .progress-caption,
        body.dark-mode .task-description,
        body.dark-mode .empty-state {
            color: #c4b5d9;
        }

        body.dark-mode .panel,
        body.dark-mode .stat-card,
        body.dark-mode .task-card {
            background: #241b35;
            border-color: #403052;
            color: #f3eaff;
        }

        body.dark-mode .panel h2,
        body.dark-mode .task-title {
            color: #d8b4fe;
        }

        body.dark-mode label {
            color: #e9ddff;
        }

        body.dark-mode input,
        body.dark-mode textarea,
        body.dark-mode select {
            background: #302440;
            border-color: #55416f;
            color: #ffffff;
        }

        body.dark-mode input::placeholder,
        body.dark-mode textarea::placeholder {
            color: #b8a8cc;
        }

        body.dark-mode .btn-secondary {
            background: #403052;
            color: #eadcff;
        }

        body.dark-mode .btn-success {
            background: #3b2b57;
            color: #e9ddff;
        }

        body.dark-mode .btn-danger {
            background: #51223e;
            color: #ffd6e8;
        }

        body.dark-mode .progress-track {
            background: #403052;
        }

        body.dark-mode hr {
            border-color: #403052;
        }

        body.dark-mode .pagination a {
            background: #403052;
            color: #e9ddff;
        }

        body.dark-mode .alert-success {
            background: #302440;
            color: #e9ddff;
            border-color: #55416f;
        }

        body.dark-mode .alert-error {
            background: #51223e;
            color: #ffd6e8;
            border-color: #78345d;
        }

        @media (max-width: 1000px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .filter-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .container {
                padding: 0 14px;
                margin-top: 22px;
            }

            .stat-card, .panel {
                padding: 17px;
            }

            .welcome h1 {
                font-size: 27px;
            }
        }

        @media (max-width: 480px) {
            .filter-grid {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 16px;
            }

            .navbar h2 {
                font-size: 21px;
            }

            .nav-right {
                gap: 10px;
            }
        }
        
        /* Fix task list spacing */
        .task-card {
            margin-bottom: 14px;
            padding: 20px;
        }

        .task-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .task-actions form {
            display: inline-flex;
            margin: 0;
        }

        /* Fix Laravel pagination layout */
        .pagination {
            margin-top: 24px;
            display: flex;
            justify-content: center;
            overflow-x: auto;
        }

        .pagination nav {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .pagination nav > div {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            width: 100%;
        }

        /* Hide the mobile-only pagination summary */
        .pagination nav > div:first-child {
            display: none;
        }

        /* Remove bullets and align page numbers horizontally */
        .pagination nav ul {
            display: flex !important;
            flex-direction: row !important;
            align-items: center;
            justify-content: center;
            gap: 6px;
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
            flex-wrap: wrap;
        }

        .pagination nav li {
            list-style: none !important;
            margin: 0;
            padding: 0;
        }

        .pagination nav li::marker {
            content: "";
        }

        .pagination nav a,
        .pagination nav span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            min-height: 38px;
            padding: 8px 12px;
            border-radius: 9px;
            text-decoration: none;
            white-space: nowrap;
        }

        .pagination nav a {
            background: #f1ebfc;
            color: #6d28d9;
        }

        .pagination nav span[aria-current="page"] {
            background: #7c3aed;
            color: #ffffff;
        }

        /* Dark mode pagination */
        body.dark-mode .pagination nav a {
            background: #403052;
            color: #eadcff;
        }

        body.dark-mode .pagination nav span[aria-current="page"] {
            background: #7c3aed;
            color: #ffffff;
        }

        body.dark-mode .pagination nav span {
            color: #d1c4e9;
        }

    </style>
</head>

<body>

<header class="navbar">
    <h2>Task Manager 💜</h2>

    <div class="nav-right">
        @auth
            <span>Welcome, {{ auth()->user()->name }}</span>

            <a href="{{ route('categories.index') }}">Manage Categories</a>

            <button type="button" id="themeToggle" class="btn btn-secondary">
                🌙 Dark Mode
            </button>

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
        <div class="alert alert-success">{{ session('success') }}</div>
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

    <!-- Dashboard statistics -->
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

    <!-- Task completion progress -->
    @php
        $completionPercentage = $totalTasks > 0
            ? round(($completedTasks / $totalTasks) * 100)
            : 0;
    @endphp

    <section class="panel progress-panel">
        <h2>📊 Task Completion Progress</h2>

        <div class="progress-info">
            <span>Your overall progress</span>
            <span class="progress-percent">{{ $completionPercentage }}%</span>
        </div>

        <div class="progress-track"
             role="progressbar"
             aria-valuenow="{{ $completionPercentage }}"
             aria-valuemin="0"
             aria-valuemax="100"
             aria-label="Task completion progress">
            <div class="progress-fill"
                data-progress="{{ $completionPercentage }}">
            </div>
        </div>

        <p class="progress-caption">
            {{ $completedTasks }} of {{ $totalTasks }} tasks completed.
        </p>
    </section>

    <div class="content-grid">

        <!-- Add task form -->
        <section class="panel">
            <h2>+ Add New Task</h2>

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="title">Task Title *</label>
                    <input type="text" name="title" id="title"
                           value="{{ old('title') }}"
                           placeholder="Enter task title"
                           maxlength="255" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description"
                              placeholder="Describe your task...">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id">
                        <option value="">Select Category (Optional)</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                    <input type="date" name="due_date" id="due_date"
                           value="{{ old('due_date') }}"
                           min="{{ date('Y-m-d') }}">
                </div>

                <button type="submit" class="btn btn-primary full-width">
                    Add Task
                </button>
            </form>
        </section>

        <!-- Task list -->
        <section class="panel">
            <h2>My Tasks</h2>

            <form action="{{ route('tasks.index') }}" method="GET">
                <div class="filter-grid">
                    <input type="text" name="search"
                           value="{{ $search }}"
                           placeholder="Search by title..."
                           aria-label="Search tasks">

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

            <hr style="margin: 24px 0;">

            @forelse ($tasks as $task)
                <article class="task-card">
                    <h3 class="task-title">{{ $task->title }}</h3>

                    @if ($task->description)
                        <p class="task-description">{{ $task->description }}</p>
                    @endif

                    <div class="task-meta">
                        <span class="badge status-{{ $task->status }}">
                            {{ ucfirst($task->status) }}
                        </span>

                        <span class="badge priority-{{ $task->priority }}">
                            {{ ucfirst($task->priority) }} Priority
                        </span>

                        <span class="badge">
                            Category: {{ $task->category ? $task->category->name : 'Uncategorized' }}
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
                    <p>Add a task or change your search filters.</p>
                </div>
            @endforelse

            <div class="pagination">
                {{ $tasks->links() }}
            </div>
        </section>
    </div>
</main>

<script>
    const themeToggle = document.getElementById('themeToggle');
    const savedTheme = localStorage.getItem('taskManagerTheme');

    function updateThemeButton() {
        const isDark = document.body.classList.contains('dark-mode');
        themeToggle.textContent = isDark ? '☀️ Light Mode' : '🌙 Dark Mode';
    }

    if (savedTheme === 'dark') {
        document.body.classList.add('dark-mode');
    }

    updateThemeButton();

    document.querySelectorAll('.progress-fill').forEach(function (bar) {
    bar.style.width = bar.dataset.progress + '%';
    });

    themeToggle.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');

        const isDark = document.body.classList.contains('dark-mode');

        localStorage.setItem(
            'taskManagerTheme',
            isDark ? 'dark' : 'light'
        );

        updateThemeButton();
    });
</script>

</body>
</html>
