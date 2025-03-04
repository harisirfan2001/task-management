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
        $tasks = Task::all();
        $tasks = Task::orderByRaw("
            CASE 
                WHEN priority = 'High' THEN 1
                WHEN priority = 'Medium' THEN 2
                WHEN priority = 'Low' THEN 3
                ELSE 4
            END
        ")->orderBy('created_at', 'desc')->get();

        return view('pm-dashboard', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pm-dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request inputs
        $request->validate([
            'description' => 'required|string|max:1000',
            'assigned_to' => 'required', // Assumes users table for assignments
            'deadline' => 'required|date|after:today',
            'remarks' => 'nullable|string|max:500',
            'date_of_creation' => 'required|date',
            'priority' => 'required|in:High,Medium,Low',
        ]);

        // Create new task
        Task::create([
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'deadline' => $request->deadline,
            'remarks' => $request->remarks,
            'date_of_creation' => $request->date_of_creation,
            'priority' => $request->priority,
        ]);

        // Redirect back with success message
        return redirect()->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
