@extends('layouts.app')

@section('title', 'Create')

@section('body')
    <h1>This is the CREATE PAGE</h1>

    <form action="{{ route('store') }}" method="post" class="m-4">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>

@endsection