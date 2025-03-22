<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Notifications\TaskReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
{
    \Log::info('Index method accessed', [
        'auth_check' => Auth::check(),
        'user_id' => Auth::id(),
        'session_id' => session()->getId()
    ]);

    $tasks = [];
    if (Auth::check()) {
        $query = Task::where('user_id', Auth::id());

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'completed') {
                $query->where('completed', true);
            } elseif ($request->status === 'pending') {
                $query->where('completed', false);
            }
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Sort
        if ($request->has('sort')) {
            if ($request->sort === 'due_date') {
                $direction = $request->direction === 'asc' ? 'asc' : 'desc';
                $query->orderBy('date_echeance', $direction)
                      ->orderBy('heure_echeance', $direction);
            } elseif ($request->sort === 'position') {
                $query->orderBy('position', 'asc');
            }
        } else {
            $query->orderBy('position', 'asc');
        }

        $tasks = $query->get();
    }

 

    return view('welcome', compact('tasks'));
    }
    public function create()
    {
        return view('newtask');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_echeance' => 'required|date',
            'heure_echeance' => 'required|date_format:H:i',
            'category' => 'nullable|string',
            'priority' => 'nullable|in:Low,Medium,High',
        ]);

        $task = Task::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'date_echeance' => $validatedData['date_echeance'],
            'heure_echeance' => $validatedData['heure_echeance'],
            'user_id' => Auth::id(),
            'completed' => false,
            'category' => $validatedData['category'] ?? null,
            'priority' => $validatedData['priority'] ?? 'Medium',
            'position' => Task::where('user_id', Auth::id())->max('position') + 1,
        ]);

        // Send a reminder notification if the due date is within 24 hours
        if ($task->date_echeance->isToday() || $task->date_echeance->isTomorrow()) {
            $task->user->notify(new TaskReminder($task));
        }

        return redirect()->route('my_tasks')->with('success', 'Tâche créée avec succès.');
    }

    public function edit($id)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);
        return view('edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('my_tasks')->with('error', 'Unauthorized');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_echeance' => 'required|date',
            'heure_echeance' => 'required|date_format:H:i',
            'category' => 'nullable|string',
            'priority' => 'nullable|in:Low,Medium,High',
        ]);

        $task->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'date_echeance' => $validatedData['date_echeance'],
            'heure_echeance' => $validatedData['heure_echeance'],
            'category' => $validatedData['category'] ?? null,
            'priority' => $validatedData['priority'] ?? 'Medium',
        ]);

        return redirect()->route('my_tasks')->with('success', 'Tâche mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);
        $task->delete();
        return redirect()->route('my_tasks')->with('success', 'Tâche supprimée avec succès!');
    }

    public function toggle(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $task->completed = !$task->completed;
        $task->save();

        return response()->json(['completed' => $task->completed]);
    }

    public function reorder(Request $request)
{
    \Log::info('Reorder Request:', $request->all());

    $taskIds = $request->input('taskIds', []);

    if (!is_array($taskIds) || empty($taskIds)) {
        \Log::error('Invalid task IDs:', ['taskIds' => $taskIds]);
        return response()->json(['success' => false, 'message' => 'Invalid task IDs'], 400);
    }

    $updatedCount = 0;
    foreach ($taskIds as $index => $taskId) {
        // Cast $taskId to integer
        $taskId = (int) $taskId;
        $task = Task::where('user_id', Auth::id())->where('id', $taskId)->first();
        if ($task) {
            $result = $task->update(['position' => $index + 1]);
            if ($result) {
                $updatedCount++;
                \Log::info('Updated task position:', ['taskId' => $taskId, 'position' => $index + 1]);
            } else {
                \Log::error('Failed to update task position:', ['taskId' => $taskId, 'position' => $index + 1]);
            }
        } else {
            \Log::warning('Task not found or not owned by user:', ['taskId' => $taskId, 'userId' => Auth::id()]);
        }
    }

    if ($updatedCount === 0) {
        \Log::error('No tasks were updated', ['taskIds' => $taskIds]);
        return response()->json(['success' => false, 'message' => 'No tasks were updated'], 400);
    }

    \Log::info('Reorder successful', ['updatedCount' => $updatedCount]);
    return response()->json(['success' => true, 'updated' => $updatedCount]);
    }
}