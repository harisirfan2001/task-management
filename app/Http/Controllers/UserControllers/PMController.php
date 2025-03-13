<?php

namespace App\Http\Controllers\UserControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class PMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::all();
        $activeTasks = $tasks->where('status', 'Active')->count();
        $completedTasks = $tasks->where('status', 'Completed')->count();
        $cancelledTasks = $tasks->where('status', 'Cancelled')->count();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'tasks' => $tasks,
                'activeTasks' => $activeTasks,
                'completedTasks' => $completedTasks,
                'cancelledTasks' => $cancelledTasks
            ]);
        }

        return view('manager.create', compact('tasks', 'activeTasks', 'completedTasks', 'cancelledTasks'));
    }

    /**
     * Store a newly created resource via AJAX.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:1000',
            'assigned_to' => 'required|string',
            'deadline' => 'required|date',
            'remarks' => 'nullable|string|max:500',
            'priority' => 'required|in:High,Medium,Low',
        ]);

        $task = new Task();
        $task->description = $request->description;
        $task->assigned_to = $request->assigned_to;
        $task->deadline = $request->deadline;
        $task->remarks = $request->remarks;
        $task->priority = $request->priority;
        $task->save();

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully.',
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found.'
            ], 404);
        }

        return response()->json($task);
    }

    /**
     * Update the specified resource via AJAX.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:1000',
            'assigned_to' => 'required|string',
            'deadline' => 'required|date',
            'remarks' => 'nullable|string|max:500',
            'priority' => 'required|in:High,Medium,Low',
        ]);

        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found.'
            ], 404);
        }

        $task->update([
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'deadline' => $request->deadline,
            'remarks' => $request->remarks,
            'priority' => $request->priority,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully.',
            'task' => $task
        ]);
    }

    /**
     * Remove the specified resource via AJAX.
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found.'
            ], 404);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully.'
        ]);
    }
}
