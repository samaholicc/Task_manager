<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Tâches - Inscription</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <style>.home-section {
  padding: 02px; /* Ajuste le padding pour l'espace intérieur */
}
form input[type="text"],
form input[type="email"],
form input[type="password"],
form input [type="password_confirmation"]
{    width: 98%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    margin-bottom: 10px;
}
</style>

    <!-- Blade Template Content -->
    <div class="container">
    <div class="nav-bar">
        <a class="active">Task Manager</a>
    </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="home-section">
                    <div class="card-header">
                    <h1>Inscription</h1>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label form-label-strong">{{ __('Nom') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>

                        <!-- Email Address -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label form-label-strong">{{ __('Adresse email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label form-label-strong">{{ __('Mot de passe') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label form-label-strong">{{ __('Confirmer le mot de passe') }}</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Inscription') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Blade Template Content -->

    <div class="footer">
        <p>©2024 Samia</p>
    </div>
</body>
</html>
