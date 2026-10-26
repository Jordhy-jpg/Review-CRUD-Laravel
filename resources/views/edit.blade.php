@extends('layouts.app')

@section('title', 'Edit')

@section('body')
    <h1>This is the Edit PAGE</h1>

    <form action="{{ route('update', $task) }}" method="post" class="m-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $task->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>

@endsection