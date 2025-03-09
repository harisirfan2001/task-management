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

        $task = Task::create([
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'deadline' => $request->deadline,
            'remarks' => $request->remarks,
            'priority' => $request->priority,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully.',
            'task' => $task
        ]);
    }

    /**
     * Remove the specified resource via AJAX.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully.'
        ]);
    }
}
