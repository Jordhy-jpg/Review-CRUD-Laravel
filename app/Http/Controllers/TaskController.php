<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::latest()->get();

        return view("index", compact("tasks"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'completed' => ['boolean']
        ]);

        Task::create($validated);

        return redirect()->route('index');
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Task $task)
    // {
    //     return view('show', compact('task'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'completed' => ['boolean']
        ]);

        $task->update($validated);

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Task $task)
    {
        $task->delete();

        return redirect()->route('index');
    }

    public function markAsComplete(Task $task)
    {
        $task->update([
            'completed' => true
        ]);

        return redirect()->route('index');
    }
}
