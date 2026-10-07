<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Task</title>


    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        input,
        textarea,
        select {
            padding: 8px;
            margin-top: 5px;
            width: 300px;
        }

        textarea {
            height: 80px;
        }

        button {
            padding: 10px 18px;
            cursor: pointer;
        }

        .error {
            color: red;
        }

    </style>

</head>


<body>

<div class="container">

    <div class="card">

        <h1>Edit Task</h1>


        {{-- Validation Errors --}}

        @if ($errors->any())

            <div class="error">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('tasks.update', $task) }}"
            method="POST"
        >

            @csrf

            @method('PUT')


            {{-- Title --}}

            <div>

                <label>Task Title</label>

                <br>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $task->title) }}"
                >

            </div>


            <br>


            {{-- Description --}}

            <div>

                <label>Description</label>

                <br>

                <textarea name="description">{{ old('description', $task->description) }}</textarea>

            </div>


            <br>


            {{-- Priority --}}

            <div>

                <label>Priority</label>

                <br>

                <select name="priority">

                    <option
                        value="low"
                        {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}
                    >
                        Low
                    </option>

                    <option
                        value="medium"
                        {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}
                    >
                        Medium
                    </option>

                    <option
                        value="high"
                        {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}
                    >
                        High
                    </option>

                </select>

            </div>


            <br>


            {{-- Due Date --}}

            <div>

                <label>Due Date</label>

                <br>

                <input
                    type="date"
                    name="due_date"
                    value="{{ old('due_date', $task->due_date) }}"
                >

            </div>


            <br>


            <button type="submit">
                Update Task
            </button>

        </form>


        <br>


        <a href="{{ route('tasks.index') }}">
            ← Back to Tasks
        </a>

    </div>

</div>

</body>

</html>