<?php 
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    

    /**
     * Stocker une nouvelle tâche dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->date_echeance = $request->date_echeance;
        $task->user_id = Auth::id();
        $task->heure_echeance =  $request->heure_echeance;
        $task->save();
        

        return redirect()->route('my_tasks')->with('success', 'Tâche créée avec succès.');
    }


    public function create()
{
    return view('newtask'); // Assurez-vous que la vue 'tasks.create' existe
}
public function index()
{   
    $tasks = Task::where('user_id', Auth::id())->get();

    

    return view('mytasks', compact('tasks'));
}
public function showTasks()

{
    // Récupérer l'utilisateur connecté
    $user = auth()->user();

    // Récupérer uniquement les tâches de cet utilisateur
    $tasks = Task::where('user_id', $user->id)->get();

    // Retourner la vue avec les tâches de l'utilisateur
    return view('mytasks', compact('tasks'));
}




public function edit($id)
{
    $task = Task::findOrFail($id); // Fetch task by ID or fail if not found
    return view('edit', compact('task')); // Pass the task to the view
}

public function update(Request $request, Task $task)
{
    // Validez les données de la requête
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        // autres champs si nécessaire
    ]);

    // Mettez à jour la tâche avec les données validées
    $task->update($validatedData);

    // Redirigez vers une page avec un message de succès
    return redirect()->route('my_tasks')->with('success', 'Tâche mise à jour avec succès.');
}
/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::destroy($id);
        return redirect('my-tasks')->with('flash_message', 'Tache supprimée!');  
    }

public function getHeureEcheanceAttribute($value)
{
    return Carbon::parse($value)->format('H:i');
}
}