<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all()->toArray();
        return array_reverse($tasks);
    }

    public function store(Request $request)
    {
        $task = new Task();
        $task->fill($request->input());
        $task->save();
        return response()->json('Task created!');
    }

    public function show($id)
    {
        $task = Task::find($id);
        return response()->json($task);
    }

    public function update($id, Request $request)
    {
        $task = Task::find($id);
        $task->update($request->all());
        return response()->json('Task updated!');
    }

    public function check($id)
    {
        $task = Task::find($id);
        $task->update(['checked' => true]);
        return response()->json('Task checked updated!');
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return response()->json('Task deleted!');
    }
}
