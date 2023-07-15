<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Models\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = auth()->user()->tasks;

        return view('tasks.index')
            ->with([
                'tasks' => $tasks,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $task = Task::query()->create($request->validated());

        if (!$task) {
            return back()->with('status', 'task-create-error');
        }

        return redirect()->route('tasks.index')
            ->with('status', 'task-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $taskStatuses = TaskStatus::cases();

        return view('tasks.edit')
            ->with([
                'task' => $task,
                'taskStatuses' => $taskStatuses,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $updateResult = $task->update($request->validated());

        if (!$updateResult) {
            return back()->with('status', 'task-update-error');
        }

        return back()->with('status', 'task-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('status', 'task-deleted');
    }
}
