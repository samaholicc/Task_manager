<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Tâches - Modifier Tâche</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #b3cde0 100%);
            --card-bg: #f8f9fa;
            --text-color: #333;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            --nav-bg: rgba(255, 255, 255, 0.95);
            --footer-bg: #ffffff;
        }

        [data-theme="dark"] {
            --background: linear-gradient(135deg, #0f1c3a 0%, #1a2e5a 50%, #5a7aa8 100%);
            --card-bg: #2c3e50;
            --text-color: #e0e0e0;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            --nav-bg: rgba(44, 62, 80, 0.95);
            --footer-bg: #2c3e50;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background: var(--background);
            background-size: 200% 200%;
            color: var(--text-color);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            animation: gradientShift 15s ease infinite;
            position: relative;
            margin: 0;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.05);
            pointer-events: none;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 0%; }
            50% { background-position: 100% 100%; }
            100% { background-position: 0% 0%; }
        }

        .nav-bar {
            background: var(--nav-bg);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
        }

        .nav-bar .left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-bar .left i {
            font-size: 1.5em;
            color: #007bff;
            transition: transform 0.3s;
        }

        [data-theme="dark"] .nav-bar .left i {
            color: #66b0ff;
        }

        .nav-bar .left a {
            font-size: 1.5em;
            font-weight: 700;
            background: linear-gradient(90deg, #1e3c72, #007bff);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-decoration: none;
            position: relative;
            transition: color 0.3s;
        }

        [data-theme="dark"] .nav-bar .left a {
            background: linear-gradient(90deg, #a3c1ff, #66b0ff);
        }

        .nav-bar .left a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: #007bff;
            bottom: -5px;
            left: 0;
            transition: width 0.3s;
        }

        [data-theme="dark"] .nav-bar .left a::after {
            background: #66b0ff;
        }

        .nav-bar .left a:hover::after {
            width: 100%;
        }

        .nav-bar .left:hover i {
            transform: rotate(15deg);
        }

        .nav-bar .right {
            display: flex;
            align-items: center;
            gap: 10px; /* Consistent spacing between buttons */
        }

        .nav-bar .right a, .nav-bar .right button {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1em;
            font-weight: 500;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .nav-bar .right .new-task {
            background-color: #28a745; /* Green for New Task */
        }

        .nav-bar .right .new-task:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .nav-bar .right .my-tasks {
            background-color: #007bff; /* Blue for Profile */
        }

        .nav-bar .right .my-tasks:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .nav-bar .right .logout {
            background-color: #dc3545; /* Red for Logout */
        }

        .nav-bar .right .logout:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .nav-bar .right .theme-toggle {
            background-color: #6c757d; /* Gray for Theme Toggle */
            padding: 10px; /* Smaller padding for icon-only button */
            width: 40px; /* Fixed width to make it circular */
            height: 40px; /* Fixed height to make it circular */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .nav-bar .right .theme-toggle:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        [data-theme="dark"] .nav-bar .right .theme-toggle {
            background-color: #5a7aa8;
        }

        [data-theme="dark"] .nav-bar .right .theme-toggle:hover {
            background-color: #4a6a88;
        }

        .content {
            flex: 1;
            padding: 60px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            max-width: 500px;
            width: 100%;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        [data-theme="dark"] .form-container {
            background-color: var(--card-bg);
        }

        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
        }

        [data-theme="dark"] .form-container:hover {
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.4);
        }

        .title {
            background: linear-gradient(90deg, #1e3c72, #2a5298);
            padding: 20px;
            text-align: center;
        }

        [data-theme="dark"] .title {
            background: linear-gradient(90deg, #0f1c38, #1a2e5a);
        }

        .title h1 {
            font-size: 2em;
            color: #ffffff;
            font-weight: 700;
            margin: 0;
        }

        .form-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            font-weight: 500;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        [data-theme="dark"] .form-label {
            color: #e0e0e0;
        }

        .form-control {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        [data-theme="dark"] .form-control {
            background-color: #3a4b6b;
            border-color: #4a5b7b;
            color: #e0e0e0;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        [data-theme="dark"] .form-control:focus {
            border-color: #66b0ff;
            box-shadow: 0 0 5px rgba(102, 176, 255, 0.3);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .form-group i {
            position: absolute;
            left: 12px;
            top: 38px;
            color: #007bff;
            font-size: 1.2em;
        }

        [data-theme="dark"] .form-group i {
            color: #66b0ff;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        [data-theme="dark"] .btn {
            background-color: #4a90e2;
        }

        .btn:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        [data-theme="dark"] .btn:hover {
            background-color: #357abd;
        }

        .footer {
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 0.9em;
            background-color: var(--footer-bg);
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }

        [data-theme="dark"] .footer {
            color: #a0a0a0;
        }

        @media (max-width: 768px) {
            .nav-bar {
                padding: 10px 20px;
                flex-wrap: wrap;
                gap: 10px;
            }

            .nav-bar .left a {
                font-size: 1.3em;
            }

            .nav-bar .left i {
                font-size: 1.3em;
            }

            .nav-bar .right {
                flex-wrap: wrap;
                gap: 8px;
            }

            .nav-bar .right a, .nav-bar .right button {
                padding: 8px 15px;
            }

            .nav-bar .right .theme-toggle {
                padding: 8px;
                width: 36px;
                height: 36px;
            }

            .content {
                padding: 40px 10px;
            }

            .form-container {
                padding: 20px;
            }

            .title h1 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
<div class="nav-bar">
    <div class="left">
        <i class="fas fa-tasks"></i>
        <a href="/" class="active">Task Manager</a>
    </div>
    <div class="right">
        <a href="{{ route('new_task') }}" class="new-task">
            <i class="fas fa-plus"></i> Nouvelle Tâche
        </a>
        <a href="{{ route('profile.edit') }}" class="my-tasks">
            <i class="fas fa-user"></i> Profil
        </a>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
        <button class="theme-toggle" aria-label="Toggle theme">
            <i class="fas fa-moon"></i>
        </button>
    </div>
</div>
<div class="content">
    <form class="form-container" method="POST" action="{{ route('tasks.update', $task->id) }}">
        @csrf
        @method('PATCH')
        <div class="title">
            <h1>Modifier la Tâche</h1>
        </div>
        <div class="form-body">
            <div class="form-group">
                <label for="title" class="form-label">Titre de la tâche</label>
                <i class="fas fa-heading"></i>
                <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" value="{{ old('title', $task->title) }}" required>
                <div class="invalid-feedback">
                    {{ $errors->first('title', 'Veuillez entrer un titre pour la tâche.') }}
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <i class="fas fa-align-left"></i>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" rows="3" required>{{ old('description', $task->description) }}</textarea>
                <div class="invalid-feedback">
                    {{ $errors->first('description', 'Veuillez entrer une description pour la tâche.') }}
                </div>
            </div>
            <div class="form-group">
                <label for="date_echeance" class="form-label">Date d'échéance</label>
                <i class="fas fa-calendar-alt"></i>
                <input type="date" class="form-control {{ $errors->has('date_echeance') ? 'is-invalid' : '' }}" id="date_echeance" name="date_echeance" min="2024-06-16" value="{{ old('date_echeance', $task->date_echeance->format('Y-m-d')) }}" required>
                <div class="invalid-feedback">
                    {{ $errors->first('date_echeance', 'Veuillez sélectionner une date d\'échéance.') }}
                </div>
            </div>
            <div class="form-group">
                <label for="heure_echeance" class="form-label">Heure d'échéance</label>
                <i class="fas fa-clock"></i>
                <input type="time" class="form-control {{ $errors->has('heure_echeance') ? 'is-invalid' : '' }}" id="heure_echeance" name="heure_echeance" value="{{ old('heure_echeance', \Carbon\Carbon::parse($task->heure_echeance)->format('H:i')) }}" required>
                <div class="invalid-feedback">
                    {{ $errors->first('heure_echeance', 'Veuillez sélectionner une heure d\'échéance.') }}
                </div>
            </div>
            <div class="form-group">
                <label for="category" class="form-label">Catégorie</label>
                <i class="fas fa-tag"></i>
                <select class="form-control" id="category" name="category">
                    <option value="">Sélectionner une catégorie</option>
                    <option value="Work" {{ old('category', $task->category) === 'Work' ? 'selected' : '' }}>Travail</option>
                    <option value="Personal" {{ old('category', $task->category) === 'Personal' ? 'selected' : '' }}>Personnel</option>
                    <option value="Urgent" {{ old('category', $task->category) === 'Urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
            </div>
            <div class="form-group">
                <label for="priority" class="form-label">Priorité</label>
                <i class="fas fa-exclamation-circle"></i>
                <select class="form-control" id="priority" name="priority">
                    <option value="Low" {{ old('priority', $task->priority) === 'Low' ? 'selected' : '' }}>Basse</option>
                    <option value="Medium" {{ old('priority', $task->priority) === 'Medium' ? 'selected' : '' }}>Moyenne</option>
                    <option value="High" {{ old('priority', $task->priority) === 'High' ? 'selected' : '' }}>Haute</option>
                </select>
            </div>
            <button type="submit" class="btn">
                <i class="fas fa-save"></i> Enregistrer la tâche
            </button>
        </div>
    </form>
</div>
<div class="footer">
    <p>© 2024 Samia. Tous droits réservés.</p>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.querySelector('.theme-toggle');
        const currentTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', currentTheme);

        if (currentTheme === 'dark') {
            toggleButton.querySelector('i').classList.remove('fa-moon');
            toggleButton.querySelector('i').classList.add('fa-sun');
        }

        toggleButton.addEventListener('click', function () {
            let theme = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);

            if (theme === 'dark') {
                toggleButton.querySelector('i').classList.remove('fa-moon');
                toggleButton.querySelector('i').classList.add('fa-sun');
            } else {
                toggleButton.querySelector('i').classList.remove('fa-sun');
                toggleButton.querySelector('i').classList.add('fa-moon');
            }
        });
    });
</script>
</body>
</html>