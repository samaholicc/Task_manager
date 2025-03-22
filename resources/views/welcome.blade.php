<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Tâches - Mes tâches</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <style>
        :root {
            --background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #b3cde0 100%);
            --card-bg: #ffffff;
            --text-color: #333;
            --card-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            --nav-bg: rgba(255, 255, 255, 0.95);
            --footer-bg: #ffffff;
            --priority-low: #28a745;
            --priority-medium: #ffc107;
            --priority-high: #dc3545;
            --completed-bg: #e9f7ef;
            --due-date-highlight: #ff6f61;
            --cta-bg: #007bff;
        }

        [data-theme="dark"] {
            --background: linear-gradient(135deg, #0f1c3a 0%, #1a2e5a 50%, #5a7aa8 100%);
            --card-bg: #2c3e50;
            --text-color: #e0e0e0;
            --card-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            --nav-bg: rgba(44, 62, 80, 0.95);
            --footer-bg: #2c3e50;
            --completed-bg: #3a5a4b;
            --due-date-highlight: #ff8a80;
            --cta-bg: #66b0ff;
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

        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
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
            color: #1e3c72; /* Couleur fixe pour lisibilité */
            text-decoration: none;
            position: relative;
            transition: color 0.3s;
        }

        [data-theme="dark"] .nav-bar .left a {
            color: #a3c1ff; /* Couleur claire pour le mode sombre */
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
            gap: 10px;
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
            background-color: #28a745;
        }

        .nav-bar .right .new-task:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .nav-bar .right .my-tasks {
            background-color: #007bff;
        }

        .nav-bar .right .my-tasks:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .nav-bar .right .logout {
            background-color: #dc3545;
        }

        .nav-bar .right .logout:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .nav-bar .right .theme-toggle {
            background-color: #6c757d;
            padding: 10px;
            width: 40px;
            height: 40px;
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
        }

        .tasks-container {
            max-width: 900px;
            margin: 20px auto 0;
        }

        .home-section {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            animation: slideIn 0.5s ease-out;
        }

        [data-theme="dark"] .home-section {
            background-color: var(--card-bg);
        }

        .home-section h1 {
            font-size: 2.2em;
            color: #1e3c72;
            font-weight: 700;
            margin-bottom: 25px;
        }

        [data-theme="dark"] .home-section h1 {
            color: #a3c1ff;
        }

        .home-section p {
            font-size: 1.1em;
            color: #555;
            margin-bottom: 15px;
        }

        [data-theme="dark"] .home-section p {
            color: #b0b0b0;
        }

        .home-section p a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .home-section p a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        [data-theme="dark"] .home-section p a {
            color: #66b0ff;
        }

        [data-theme="dark"] .home-section p a:hover {
            color: #4a8fe2;
        }

        /* Features Section Styles - Grid Layout */
        .features-section {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .feature {
            background: linear-gradient(145deg, var(--card-bg), #f0f4f8);
            border-radius: 15px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: slideIn 0.5s ease-out;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        [data-theme="dark"] .feature {
            background: linear-gradient(145deg, var(--card-bg), #3a4b6b);
        }

        .feature:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .feature-content {
            text-align: center;
        }

        .feature-content h2 {
            font-size: 1.5em;
            color: #1e3c72;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: color 0.3s;
        }

        .feature-content h2 i {
            color: #007bff;
            font-size: 1.2em;
            transition: transform 0.3s;
        }

        .feature:hover h2 i {
            transform: scale(1.2);
        }

        [data-theme="dark"] .feature-content h2 {
            color: #a3c1ff;
        }

        [data-theme="dark"] .feature-content h2 i {
            color: #66b0ff;
        }

        .feature-content h2:hover {
            color: #007bff;
        }

        [data-theme="dark"] .feature-content h2:hover {
            color: #66b0ff;
        }

        .feature-content p {
            font-size: 0.95em;
            color: #555;
            line-height: 1.5;
        }

        [data-theme="dark"] .feature-content p {
            color: #b0b0b0;
        }

        /* Style spécifique pour l'appel à l'action */
        .feature.cta {
            background: var(--cta-bg);
            color: #ffffff;
            border: 2px solid transparent;
            grid-column: span 4; /* Occupe toute la largeur */
        }

        .feature.cta:hover {
            background: #0056b3;
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        }

        [data-theme="dark"] .feature.cta {
            background: var(--cta-bg);
        }

        [data-theme="dark"] .feature.cta:hover {
            background: #4a8fe2;
        }

        .feature.cta h2 {
            color: #ffffff;
        }

        .feature.cta h2 i {
            color: #ffffff; /* Rocket visible en mode sombre */
        }

        .feature.cta p {
            color: #e0e0e0;
        }

        .feature.cta p a {
            color: #ffffff;
            font-weight: 600;
            text-decoration: underline;
        }

        .feature.cta p a:hover {
            color: #ff6f61;
        }

        .filter-sort {
            margin-bottom: 25px;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .filter-sort select {
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            font-size: 1em;
            cursor: pointer;
            background-color: #f8f9fa;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        [data-theme="dark"] .filter-sort select {
            background-color: #3a4b6b;
            border-color: #4a5b7b;
            color: #e0e0e0;
        }

        .filter-sort select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        [data-theme="dark"] .filter-sort select:focus {
            border-color: #66b0ff;
            box-shadow: 0 0 5px rgba(102, 176, 255, 0.3);
        }

        .alert-success, .alert-warning {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            animation: fadeIn 0.3s ease-in;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        [data-theme="dark"] .alert-success {
            background-color: #2a5a3a;
            color: #a3d7b0;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        [data-theme="dark"] .alert-warning {
            background-color: #5a4b2a;
            color: #d7c3a3;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .task-card {
            background: linear-gradient(145deg, var(--card-bg), #f0f4f8);
            border: none;
            border-radius: 15px;
            margin-bottom: 25px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
            animation: slideIn 0.5s ease-out;
        }

        .task-card.completed {
            background: linear-gradient(145deg, var(--completed-bg), #d0e7d5);
        }

        [data-theme="dark"] .task-card {
            background: linear-gradient(145deg, var(--card-bg), #3a4b6b);
        }

        [data-theme="dark"] .task-card.completed {
            background: linear-gradient(145deg, var(--completed-bg), #4a6a88);
        }

        .task-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-shadow);
        }

        .task-card.priority-low .priority-badge {
            background-color: var(--priority-low);
        }

        .task-card.priority-medium .priority-badge {
            background-color: var(--priority-medium);
        }

        .task-card.priority-high .priority-badge {
            background-color: var(--priority-high);
        }

        .card-header {
            background: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid #e9ecef;
            padding: 20px 25px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            font-size: 0.95em;
            position: relative;
            gap: 10px;
        }

        [data-theme="dark"] .card-header {
            background: rgba(44, 62, 80, 0.9);
            border-bottom: 1px solid #4a5e72;
        }

        .date-label {
            color: #666;
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
        }

        [data-theme="dark"] .date-label {
            color: #a0a0a0;
        }

        .date-label i {
            margin-right: 5px;
            color: #007bff;
        }

        [data-theme="dark"] .date-label i {
            color: #66b0ff;
        }

        .date-label.due-date {
            font-weight: 700;
            font-size: 1.1em;
            color: var(--due-date-highlight);
            background: rgba(255, 111, 97, 0.1);
            padding: 5px 10px;
            border-radius: 5px;
        }

        [data-theme="dark"] .date-label.due-date {
            color: var(--due-date-highlight);
            background: rgba(255, 138, 128, 0.2);
        }

        .strong-echeance, .strong-creation {
            font-weight: 500;
        }

        .card-body {
            padding: 25px;
            position: relative;
        }

        .card-title {
            font-size: 1.5em;
            font-weight: 700;
            color: #1e3c72;
            margin-bottom: 15px;
        }

        [data-theme="dark"] .card-title {
            color: #e0e0e0;
        }

        .card-title.completed {
            text-decoration: line-through;
            color: #666;
        }

        [data-theme="dark"] .card-title.completed {
            color: #a0a0a0;
        }

        .card-text {
            color: #555;
            font-size: 1.1em;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        [data-theme="dark"] .card-text {
            color: #b0b0b0;
        }

        .card-text.category, .card-text.priority {
            font-size: 0.95em;
            color: #777;
            margin-bottom: 5px;
        }

        [data-theme="dark"] .card-text.category, [data-theme="dark"] .card-text.priority {
            color: #a0a0a0;
        }

        .priority-badge {
            position: absolute;
            top: -15px;
            right: 15px;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 0.85em;
            font-weight: 600;
            color: #fff;
            text-transform: uppercase;
            z-index: 1;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .card-footer {
            background: rgba(255, 255, 255, 0.9);
            border-top: 1px solid #e9ecef;
            padding: 15px 25px;
            display: flex;
            justify-content: flex-end;
        }

        [data-theme="dark"] .card-footer {
            background: rgba(44, 62, 80, 0.9);
            border-top: 1px solid #4a5e72;
        }

        .task-actions {
            display: flex;
            gap: 15px;
        }

        .task-actions .btn {
            padding: 10px;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            position: relative;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .task-actions .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .task-actions .btn i {
            margin: 0;
            font-size: 1.2em;
        }

        .task-actions .btn-success {
            background-color: #28a745;
        }

        .task-actions .btn-success:hover {
            background-color: #218838;
        }

        .task-actions .btn-success.completed {
            background-color: #6c757d;
        }

        .task-actions .btn-success.completed:hover {
            background-color: #5a6268;
        }

        .task-actions .btn-primary {
            background-color: #007bff;
        }

        .task-actions .btn-primary:hover {
            background-color: #0056b3;
        }

        .task-actions .btn-danger {
            background-color: #dc3545;
        }

        .task-actions .btn-danger:hover {
            background-color: #c82333;
        }

        .task-actions .btn::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8em;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .task-actions .btn:hover::after {
            opacity: 1;
            visibility: visible;
        }

        .task-actions form {
            display: inline-block;
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

        /* Media Queries pour responsivité */
        @media (max-width: 1024px) {
            .features-section {
                grid-template-columns: repeat(2, 1fr);
            }
            .feature.cta {
                grid-column: span 2; /* Sur 2 colonnes sur écrans moyens */
            }
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

            .tasks-container {
                margin: 10px auto 0;
            }

            .home-section {
                padding: 20px;
            }

            .home-section h1 {
                font-size: 1.8em;
            }

            .filter-sort {
                flex-direction: column;
                align-items: center;
            }

            .card-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .task-actions {
                justify-content: center;
            }

            .task-actions .btn {
                width: 40px;
                height: 40px;
            }

            .card-title {
                font-size: 1.3em;
            }

            .card-text {
                font-size: 1em;
            }

            .priority-badge {
                top: -10px;
                right: 10px;
                font-size: 0.75em;
                padding: 4px 8px;
            }

            .date-label.due-date {
                font-size: 1em;
            }

            .features-section {
                grid-template-columns: 1fr;
            }

            .feature-content h2 {
                font-size: 1.5em;
            }

            .feature-content p {
                font-size: 0.95em;
            }

            .feature.cta {
                grid-column: span 1; /* Sur 1 colonne sur petits écrans */
            }
        }

        .swal2-container {
            z-index: 10000 !important;
            display: block !important;
            visibility: visible !important;
        }
        .swal2-toast {
            z-index: 10001 !important;
        }
    </style>
</head>
<body>
<div class="nav-bar">
    <div class="left">
        <i class="fas fa-tasks"></i>
        <a href="{{ route('home') }}" class="active">Task Manager</a>
    </div>
    <div class="right">
        @if (Auth::check())
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
        @else
            <a href="{{ route('login') }}" class="my-tasks">
                <i class="fas fa-sign-in-alt"></i> Connexion
            </a>
            <a href="{{ route('register') }}" class="new-task">
                <i class="fas fa-user-plus"></i> Inscription
            </a>
        @endif
        <button class="theme-toggle" aria-label="Toggle theme">
            <i class="fas fa-moon"></i>
        </button>
    </div>
</div>
<div class="content">
    @if (Auth::check())
        <div class="tasks-container">
            <div class="home-section">
                <h1>Mes Tâches</h1>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="filter-sort">
                    <form method="GET" action="{{ route('my_tasks') }}">
                        <select name="status" onchange="this.form.submit()">
                            <option value="">Tous</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Terminé</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>En attente</option>
                        </select>
                        <select name="category" onchange="this.form.submit()">
                            <option value="">Toutes les catégories</option>
                            <option value="Work" {{ request('category') === 'Work' ? 'selected' : '' }}>Travail</option>
                            <option value="Personal" {{ request('category') === 'Personal' ? 'selected' : '' }}>Personnel</option>
                            <option value="Urgent" {{ request('category') === 'Urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                        <select name="sort" onchange="this.form.submit()">
                            <option value="">Trier par</option>
                            <option value="due_date" {{ request('sort') === 'due_date' && request('direction') === 'asc' ? 'selected' : '' }}>Date d'échéance (croissant)</option>
                            <option value="due_date" {{ request('sort') === 'due_date' && request('direction') === 'desc' ? 'selected' : '' }}>Date d'échéance (décroissant)</option>
                            <option value="position" {{ request('sort') === 'position' ? 'selected' : '' }}>Ordre personnalisé</option>
                        </select>
                        <input type="hidden" name="direction" value="{{ request('direction', 'asc') === 'asc' ? 'desc' : 'asc' }}">
                    </form>
                </div>
            </div>
            @forelse ($tasks as $task)
                <div class="card task-card mb-3 {{ $task->completed ? 'completed' : '' }} priority-{{ strtolower($task->priority) }}" id="task-{{ $task->id }}" data-task-id="{{ $task->id }}">
                    <div class="card-header">
                        <span class="date-label due-date strong-echeance">
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
                            <p class="card-text category">Catégorie: {{ $task->category }}</p>
                        @endif
                        <span class="priority-badge">{{ $task->priority }}</span>
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
                <div class="home-section">
                    <div class="alert alert-warning" role="alert">
                        Aucune tâche trouvée.
                    </div>
                </div>
            @endforelse
        </div>
    @else
        <div class="features-section">
            <div class="home-section" style="grid-column: span 4;">
                <h1>Découvrez Task Manager</h1>
                <p>Gérez vos tâches simplement et avec style.</p>
            </div>

            <!-- Call to Action (Placé en haut) -->
            <div class="feature cta" style="grid-column: span 4;">
                <div class="feature-content">
                    <h2><i class="fas fa-rocket"></i> Lancez-vous !</h2>
                    <p><a href="{{ route('login') }}">Connexion</a> | <a href="{{ route('register') }}">Inscription</a></p>
                </div>
            </div>

            <!-- Feature 1: Task Creation and Editing -->
            <div class="feature">
                <div class="feature-content">
                    <h2><i class="fas fa-plus-circle"></i> Créez & Modifiez</h2>
                    <p>Ajoutez et ajustez vos tâches en un clic.</p>
                </div>
            </div>

            <!-- Feature 2: Filtering and Sorting -->
            <div class="feature">
                <div class="feature-content">
                    <h2><i class="fas fa-filter"></i> Filtrez & Triez</h2>
                    <p>Organisez vos tâches par statut ou priorité.</p>
                </div>
            </div>

            <!-- Feature 3: Drag-and-Drop Reordering -->
            <div class="feature">
                <div class="feature-content">
                    <h2><i class="fas fa-arrows-alt"></i> Glisser-Déposer</h2>
                    <p>Réorganisez vos tâches facilement.</p>
                </div>
            </div>

            <!-- Feature 4: Task Completion Toggle -->
            <div class="feature">
                <div class="feature-content">
                    <h2><i class="fas fa-check-circle"></i> Tâches Terminées</h2>
                    <p>Marquez vos succès en un geste.</p>
                </div>
            </div>

            <!-- Feature 5: Theme Toggle -->
            <div class="feature">
                <div class="feature-content">
                    <h2><i class="fas fa-moon"></i> Thème Clair/Sombre</h2>
                    <p>Adaptez l’interface à votre style.</p>
                </div>
            </div>

            <!-- Feature 6: Task Card Display -->
            <div class="feature">
                <div class="feature-content">
                    <h2><i class="fas fa-th-large"></i> Cartes Élégantes</h2>
                    <p>Vos tâches, claires et stylées.</p>
                </div>
            </div>

            <!-- Feature 7: Responsive Design -->
            <div class="feature">
                <div class="feature-content">
                    <h2><i class="fas fa-mobile-alt"></i> Design Adaptatif</h2>
                    <p>Parfait sur tous vos appareils.</p>
                </div>
            </div>

            <!-- Feature 8: Notifications de Rappel -->
            <div class="feature">
                <div class="feature-content">
                    <h2><i class="fas fa-bell"></i> Rappels</h2>
                    <p>Ne ratez jamais une échéance.</p>
                </div>
            </div>
        </div>
    @endif
</div>
<div class="footer">
    <p>© 2024 Samia. Tous droits réservés.</p>
</div>

<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    console.log('Testing SweetAlert...');
    try {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Test Message',
            showConfirmButton: false,
            timer: 1500
        });
        console.log('SweetAlert test executed successfully');
    } catch (error) {
        console.error('SweetAlert Test Error:', error);
    }

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

    function initializeEventListeners() {
        const toggleButtons = document.querySelectorAll('.toggle-complete');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                const taskCard = this.closest('.task-card');
                const taskId = taskCard.dataset.taskId;

                fetch(`/tasks/${taskId}/toggle`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.completed !== undefined) {
                        if (data.completed) {
                            taskCard.classList.add('completed');
                            taskCard.querySelector('.card-title').classList.add('completed');
                            button.classList.add('completed');
                            button.setAttribute('data-tooltip', 'Marquer comme non terminé');
                            button.querySelector('i').classList.remove('fa-check');
                            button.querySelector('i').classList.add('fa-undo');
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Tâche marquée comme terminée',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            taskCard.classList.remove('completed');
                            taskCard.querySelector('.card-title').classList.remove('completed');
                            button.classList.remove('completed');
                            button.setAttribute('data-tooltip', 'Marquer comme terminé');
                            button.querySelector('i').classList.remove('fa-undo');
                            button.querySelector('i').classList.add('fa-check');
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'info',
                                title: 'Tâche marquée comme non terminée',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'Erreur lors de la mise à jour',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Erreur lors de la mise à jour',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            });
        });

        const deleteForms = document.querySelectorAll('.task-actions form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Vous ne pourrez pas revenir en arrière !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Oui, supprimer !',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    }

    initializeEventListeners();

    const taskList = document.querySelector('.tasks-container');
    if (taskList) {
        const initialTaskIds = Array.from(taskList.querySelectorAll('.task-card')).map(card => card.dataset.taskId);
        console.log('Initial DOM order:', initialTaskIds);

        Sortable.create(taskList, {
            animation: 150,
            draggable: '.task-card',
            onEnd: function (evt) {
                const taskIds = Array.from(taskList.querySelectorAll('.task-card')).map(card => card.dataset.taskId);
                fetch('/tasks/reorder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ taskIds: taskIds })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Ordre des tâches mis à jour',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = '/my-tasks?sort=position&direction=asc';
                        });
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: data.message || 'Erreur lors de la réorganisation',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Erreur lors de la réorganisation',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            }
        });
    }
});
</script>
</body>
</html>