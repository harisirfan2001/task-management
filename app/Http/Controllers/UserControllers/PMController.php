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
    public function index()
    {
        $tasks = Task::orderByRaw("
            CASE 
                WHEN priority = 'High' THEN 1
                WHEN priority = 'Medium' THEN 2
                WHEN priority = 'Low' THEN 3
                ELSE 4
            END
        ")->orderBy('created_at', 'desc')->get();

        return view('manager.create', compact('tasks'));
    }

    /**
     * Store a newly created resource via AJAX.
     */
    public function store(Request $request)
    {
        dd($request->all());
        // Validate request inputs
        $request->validate([
            'description' => 'required|string|max:1000',
            'assigned_to' => 'required',
            'deadline' => 'required|date|after:today',
            'remarks' => 'nullable|string|max:500',
            'priority' => 'required|in:High,Medium,Low',
        ]);

        // Create new task
        $task = Task::create([
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'deadline' => $request->deadline,
            'remarks' => $request->remarks,
            'date_of_creation' => now(), // Automatically set the creation date
            'priority' => $request->priority,
        ]);

        // Return JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Task created successfully.',
            'task' => $task
        ]);
    }

    /**
     * Fetch all tasks for AJAX rendering.
     */
    public function fetchTasks()
    {
        $tasks = Task::orderByRaw("
            CASE 
                WHEN priority = 'High' THEN 1
                WHEN priority = 'Medium' THEN 2
                WHEN priority = 'Low' THEN 3
                ELSE 4
            END
        ")->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'tasks' => $tasks
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
