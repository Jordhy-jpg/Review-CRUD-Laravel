@extends('layouts.app')

@section('title', 'Tasks')

@section('body')
    <h1>This is the INDEX PAGE</h1>

    <ul class="m-4">
        @forelse ($tasks as $task)
            <li>
                {{ $task->title }} <br>
                {{ $task->description }} <br>
                @if ($task->completed)
                    <strong>Completed</strong>
                @else
                    <em>Pending</em>
                    <form action="{{ route('markAsComplete', $task) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Mark as Complete</button>
                    </form>
                @endif <br>
                <a href="{{ route('edit', $task) }}" class="nav-link">Edit Task</a> <br>
                <form action="{{ route('delete', $task) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Task</button>
                </form> <br>
            </li>
        @empty
            <h2>No Tasks.</h2>
        @endforelse
    </ul>

@endsection