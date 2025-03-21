<!DOCTYPE html> 
<html lang="fr"> 
    <head> <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Gestionnaire de Tâches - Inscription</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> 
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}"> 
    </head> 
    <body> 
        <style> 
        .home-section { padding: 50px; } 
        form input[type="text"], form input[type="email"], form input[type="password"]
        { width: 98%; padding: 10px; border: none; border-radius: 5px; margin-bottom: 10px; }
        .invalid-feedback { display: block; color: red; }
        .checkbox-inline { display: flex; align-items: center;}
        </style>
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
        <form method="POST" action="{{ route('register') }}"> @csrf 
            <!-- Name -->
            <div class="form-group mb-3"> 
                <label for="name" class="form-label form-label-strong">{{ __('Nom') }}</label> 
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus> @error('name') 
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror </div> 
                <!-- Email Address --> 
                <div class="form-group mb-3"> <label for="email" class="form-label form-label-strong">{{ __('Adresse email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"> @error('email') 
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror </div> 
                <!-- Password --> 
                <div class="form-group mb-3"> 
                    <label for="password" class="form-label form-label-strong">{{ __('Mot de passe') }}</label> 
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"> 
                    @error('password') <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror </div> 
                    <!-- Confirm Password --> 
                    <div class="form-group mb-3"> 
                    <label for="password_confirmation" class="form-label form-label-strong">
                        {{ __('Confirmer le mot de passe') }}</label>
                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password"> @error('password_confirmation') 
                    <span class="invalid-feedback" role="alert">{{ $message }}</span> 
                    @enderror <span id="password-error" class="invalid-feedback" style="display: none;">
                    </span> </div>
                    <!-- Show Password Checkbox -->
                    <div class="form-group mb-3 checkbox-inline ">
                        <input type="checkbox" id="show-password">

                        <label for="show-password">Afficher le mot de passe</label>
                    </div> 
                    <!-- Submit Button --> 
                    <div class="form-group mb-0"> <button type="submit" class="btn btn-primary btn-block"> {{ __('Inscription') }} </button> </div> </form> </div> </div> </div> </div> <div class="footer"> <p>©2024 Samia</p> </div> <script> document.addEventListener('DOMContentLoaded', function() { const showPasswordCheckbox = document.getElementById('show-password'); const passwordField = document.getElementById('password'); const confirmPasswordField = document.getElementById('password_confirmation'); const passwordError = document.getElementById('password-error'); showPasswordCheckbox.addEventListener('change', function() { const type = showPasswordCheckbox.checked ? 'text' : 'password'; passwordField.type = type; confirmPasswordField.type = type; }); const form = document.querySelector('form'); form.addEventListener('submit', function(event) { const password = passwordField.value; const confirmPassword = confirmPasswordField.value; if (password !== confirmPassword) { event.preventDefault(); passwordError.textContent = 'Les mots de passe ne correspondent pas.'; passwordError.style.display = 'block'; } }); });
    </script> 
    </body> 
</html>