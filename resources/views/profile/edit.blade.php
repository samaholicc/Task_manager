<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Tâches - Modifier Profil</title>
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

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            animation: fadeIn 0.3s ease-in;
        }

        [data-theme="dark"] .alert-success {
            background-color: #2a5a3a;
            color: #a3d7b0;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
    <form class="form-container" method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')
        <div class="title">
            <h1>Modifier Profil</h1>
        </div>
        <div class="form-body">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="form-group">
                <label for="name" class="form-label">Nom</label>
                <i class="fas fa-user"></i>
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                <div class="invalid-feedback">
                    {{ $errors->first('name', 'Veuillez entrer votre nom.') }}
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Adresse email</label>
                <i class="fas fa-envelope"></i>
                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                <div class="invalid-feedback">
                    {{ $errors->first('email', 'Veuillez entrer une adresse email valide.') }}
                </div>
            </div>
            <button type="submit" class="btn">
                <i class="fas fa-save"></i> Enregistrer les modifications
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