<div class="tasks-container">
    @forelse ($tasks as $task)
        <div class="card task-card mb-3 {{ $task->completed ? 'completed' : '' }} priority-{{ strtolower($task->priority) }}" id="task-{{ $task->id }}" data-task-id="{{ $task->id }}">
            <div class="card-header">
                <span class="date-label date_echeance strong-echeance">
                    <i class="fas fa-hourglass-end"></i> Échéance: {{ $task->date_echeance->format('d/m/Y') }} {{ \Carbon\Carbon::parse($task->heure_echeance)->format('H:i') }}
                </span>
                <span class="date-label date-creation strong-creation">
                    <i class="fas fa-calendar-plus"></i> Créé le: {{ $task->created_at->format('d/m/Y H:i') }}
                </span>
            </div>
            <div class="card-body">
                <h5 class="card-title {{ $task->completed ? 'completed' : '' }}">{{ $task->title }}</h5>
                <p class="card-text">{{ $task->description }}</p>
                @if ($task->category)
                    <p class="card-text"><small>Catégorie: {{ $task->category }}</small></p>
                @endif
                <p class="card-text"><small>Priorité: {{ $task->priority }}</small></p>
            </div>
            <div class="card-footer">
                <div class="task-actions">
                    <button class="btn btn-success btn-sm toggle-complete {{ $task->completed ? 'completed' : '' }}" data-tooltip="{{ $task->completed ? 'Marquer comme non terminé' : 'Marquer comme terminé' }}">
                        <i class="fas {{ $task->completed ? 'fa-undo' : 'fa-check' }}"></i>
                    </button>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm" data-tooltip="Modifier">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" accept-charset="UTF-8">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" data-tooltip="Supprimer">
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