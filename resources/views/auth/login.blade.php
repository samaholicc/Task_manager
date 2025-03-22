<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Tâches - Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background: linear-gradient(
                135deg,
                #1e3c72 0%,
                #2a5298 50%,
                #b3cde0 100%
            );
            background-size: 200% 200%;
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            animation: gradientShift 15s ease infinite;
            position: relative;
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
            background: linear-gradient(90deg, #ffffff, #f8f9fa);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .nav-bar .left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-bar .left i {
            font-size: 1.8em;
            color: #007bff;
            transition: transform 0.3s;
        }

        .nav-bar .left a {
            font-size: 1.8em;
            font-weight: 700;
            color: #1e3c72;
            text-decoration: none;
            transition: color 0.3s;
        }

        .nav-bar .left:hover i {
            transform: rotate(15deg);
        }

        .nav-bar .left a:hover {
            color: #0056b3;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .home-section {
            max-width: 500px;
            width: 100%;
            margin: 40px 15px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .home-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(90deg, #1e3c72, #2a5298);
            padding: 20px;
            text-align: center;
        }

        .card-header h1 {
            font-size: 2em;
            color: #ffffff;
            font-weight: 700;
            margin: 0;
        }

        .card-header .subtitle {
            font-size: 1em;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 400;
            margin-top: 5px;
        }

        .card-body {
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

        .form-control {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .form-group i.field-icon {
            position: absolute;
            left: 12px;
            top: 38px;
            color: #007bff;
            font-size: 1.2em;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 38px;
            color: #666;
            cursor: pointer;
            font-size: 1.2em;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.9em;
            margin-top: 5px;
            animation: fadeIn 0.3s ease-in;
        }

        .reset-password-text {
            display: block;
            color: #dc3545;
            font-size: 0.9em;
            margin-top: 5px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .reset-password-text:hover {
            color: #c82333;
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .btn {
            width: 100%;
            padding: 15px; /* Increased padding for larger button */
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 1.1em; /* Increased font size */
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .register-link {
            display: block;
            width: 100%;
            padding: 15px; /* Match the padding of the login button */
            background-color: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 1.1em; /* Match the font size of the login button */
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            margin-top: 15px;
        }

        .register-link:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            animation: fadeIn 0.3s ease-in;
        }

        .alert-danger ul {
            list-style: none;
            padding: 0;
        }

        .footer {
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 0.9em;
            background-color: #ffffff;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 768px) {
            .nav-bar {
                padding: 10px 20px;
            }

            .home-section {
                margin: 20px 10px;
                padding: 20px;
            }

            .card-header h1 {
                font-size: 1.8em;
            }

            .nav-bar .left a {
                font-size: 1.5em;
            }

            .nav-bar .left i {
                font-size: 1.5em;
            }

            .btn, .register-link {
                padding: 12px; /* Slightly smaller padding for mobile */
                font-size: 1em; /* Slightly smaller font size for mobile */
            }

            .reset-password-text {
                font-size: 0.85em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav-bar">
            <div class="left">
                <i class="fas fa-tasks"></i>
                <a href="{{ route('login') }}" class="active">Task Manager</a>
            </div>
        </div>
        <div class="home-section">
            <div class="card">
                <div class="card-header">
                    <h1>Connexion</h1>
                    <div class="subtitle">Accédez à vos tâches en toute simplicité</div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email Address -->
                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('Adresse email') }}</label>
                            <i class="fas fa-envelope field-icon"></i>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span class="invalid-feedback" role="alert" id="emailError" style="display: none;">
                                <strong>Veuillez entrer une adresse e-mail valide.</strong>
                            </span>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                            <i class="fas fa-lock field-icon"></i>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!-- Add "Reset Password" link below password input -->
                            <a href="{{ route('password.request') }}" class="reset-password-text">
                                {{ __('Mot de passe oublié ?') }}
                            </a>
                        </div>

                        <!-- Submit Button and Register Link -->
                        <div class="form-group">
                            <button type="submit" class="btn">
                                {{ __('Se connecter') }}
                            </button>
                            <a href="{{ route('register') }}" class="register-link">
                                {{ __('Inscription') }}
                            </a>
                        </div>

                        <!-- General Error Message -->
                        @if ($errors->any())
                            <div class="alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>© 2024 Samia. Tous droits réservés.</p>
    </div>

    <script>
        // Email validation
        document.querySelector('form').addEventListener('submit', function(event) {
            let isValid = true;
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('emailError');

            emailError.style.display = 'none';
            if (!emailInput.value.match(/^[^@]+@\w+(\.\w+)+$/)) {
                emailError.style.display = 'block';
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });

        // Password toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>