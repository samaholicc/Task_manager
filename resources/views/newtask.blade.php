<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Tâches - Nouvelle Tâche</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ici, vous pouvez ajouter des styles CSS supplémentaires si nécessaire */
    </style>
</head>
<body class="body">
    <div class="nav-bar">
        <a href="/" class="active">Task Manager</a>
    </div>
    
                <form class="form-container" method="POST" action="{{ route('tasks.store') }}" novalidate>
                   <div class="title"><h1 >Nouvelle tâche</h1></div>
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label form-label-strong">Titre de la tâche</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                        <div class="invalid-feedback">
                            Veuillez entrer un titre pour la tâche.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label form-label-strong">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        <div class="invalid-feedback">
                            Veuillez entrer une description pour la tâche.
                        </div>
                    </div>
                    <div class="mb-3">
                    <label for="date_echeance" class="form-label-strong">Date d'échéance</label>
                    <input type="date" class="form-control" id="date_echeance" name="date_echeance" min="2024-06-16" required>
                    </div>
                        <div class="mb-3">
                        <label for="heure_echeance" class="form-label-strong">Heure d'échéance</label>
                        <input type="time" class="form-control" id="heure_echeance" name="heure_echeance" required>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer la tâche</button>
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>©2024 Samia</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
