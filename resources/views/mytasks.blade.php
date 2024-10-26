<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Tâches - Mes Tâches</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    
</head>
<body>

    <div class='content'>
         <div class="nav-bar">
        <a href="/" class="active">Task Manager</a>
</div>
        <div class="tasks-container">
       
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="home-section">
                        <h1>Mes Tâches</h1>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        @forelse ($tasks as $task)
<div class="card task-card mb-3" id="task-{{ $task->id }}">
    <div class="card-header">
        <span class="date-label date_echeance strong-echeance">
        <i class="fas fa-hourglass-end"></i> Échéance: {{ $task->date_echeance->format('d/m/Y') }} {{ $task->heure_echeance->format('H:i') }}
        </span>
        <span class="date-label date-creation strong-creation">
            <i class="fas fa-calendar-plus" ></i> Créé le: {{ $task->created_at->format('d/m/Y H:i') }}
        </span>
    </div>
    <div class="card-body">
        <h5 class="card-title completed">{{ $task->title }}</h5>
        <p class="card-text">{{ $task->description }}</p>
    </div>
    <div class="card-footer">
        <div class="task-actions">
            <button class="btn btn-success btn-sm toggle-complete">
                <i class="fas fa-check"></i>
            </button>
            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-pencil-alt"></i>
            </a>
            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" accept-charset="UTF-8" style="display:inline">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        </div>
    </div>
</div>




                            @empty
                                <div class="alert alert-warning" role="alert">
                                    Aucune tâche trouvée.
                                </div>
                            @endforelse
                        
                    
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>©2024 Samia</p>
    </div>

    <script src="{{ asset('js/task-manager.js') }}"></script>
</body>
</html>
