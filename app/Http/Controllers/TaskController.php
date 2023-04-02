<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::today()->paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());
        return redirect()->route('tasks.index')->with('success', 'task created');
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('tasks.index')->with('success', 'task updated');
    }

    public function complete(Task $task)
    {
        $task->update(['completed' => true]);
        return back()->with('success', 'task completed');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', 'task deleted');
    }

    public function search(SearchTaskRequest $request)
    {
        $from = $request->validated('from');
        $to = $request->validated('to');
        $tasks = Task::whereBetween('date', [$from, $to])->get();
        return back()->with('tasks', $tasks)->withInput(['from' => $from, 'to' => $to]);
    }
}
