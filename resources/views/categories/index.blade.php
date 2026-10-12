
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f5ff;
            color: #30234a;
            margin: 0;
            padding: 30px 16px;
        }
        .container {
            max-width: 850px;
            margin: auto;
        }
        .panel {
            background: white;
            border: 1px solid #eee6ff;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 22px;
            box-shadow: 0 6px 20px #4c1d9510;
        }
        h1, h2 { color: #6d28d9; }
        input {
            padding: 12px;
            border: 1px solid #ddd0f5;
            border-radius: 8px;
            width: 100%;
            box-sizing: border-box;
            margin: 8px 0 12px;
        }
        button, .btn {
            padding: 10px 14px;
            border: 0;
            border-radius: 8px;
            background: #7c3aed;
            color: white;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .delete { background: #be185d; }
        .category {
            padding: 16px 0;
            border-bottom: 1px solid #eee6ff;
        }
        .category:last-child { border-bottom: 0; }
        .message { color: #6d28d9; }
        .error { color: #be185d; }
        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .category-name { font-weight: bold; }
        .count { color: #786b91; font-size: 13px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Manage Categories 💜</h1>
    <p>Create and organize your task categories.</p>

    <p><a class="btn" href="{{ route('tasks.index') }}">← Back to Dashboard</a></p>

    @if (session('success'))
        <p class="message">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <section class="panel">
        <h2>Add New Category</h2>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <label for="name">Category Name</label>
            <input id="name" name="name" maxlength="100"
                   value="{{ old('name') }}" placeholder="e.g. Work" required>
            <button type="submit">Add Category</button>
        </form>
    </section>

    <section class="panel">
        <h2>Your Categories</h2>

        @forelse ($categories as $category)
            <div class="category">
                <p class="category-name">{{ $category->name }}</p>
                <p class="count">{{ $category->tasks_count }} task(s)</p>

                <div class="actions">
                    <form action="{{ route('categories.update', $category) }}"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <input name="name" value="{{ $category->name }}"
                               maxlength="100" aria-label="Category name" required>
                        <button type="submit">Update</button>
                    </form>

                    <form action="{{ route('categories.destroy', $category) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this category? Its tasks will remain, but become uncategorized.');">
                        @csrf
                        @method('DELETE')
                        <button class="delete" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p>No categories yet. Add your first category above.</p>
        @endforelse
    </section>
</div>
</body>
</html>
