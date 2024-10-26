<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Tâches - Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    
    <!-- Blade Template Content -->
    <div class="container">
        <div class="nav-bar">
            <a class="active">Task Manager</a>
        </div>
        <div class="row justify-content-center">
            <div class="container mt-5">

                <div class="home-section">
                    <div class='card'>
                    <div class="card-header">
                        <h1>Connexion</h1>
                    </div>
                    <div class="card-body"> 
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email Address -->
                            <div class="form-group mb-3">
                                <label for="email" class="form-label form-label-strong">{{ __('Adresse email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <!-- Custom error for invalid email format -->
                                <span class="invalid-feedback" role="alert" id="emailError" style="display: none;">
                                    <strong>Veuillez entrer une adresse e-mail valide.</strong>
                                </span>
                            </div>
                            <label for="password" class="form-label form-label-strong">{{ __('Mot de passe') }}</label> <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"> @error('password') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror </div> <!-- Confirm Password --> <div class="form-group mb-3"> <label for="password_confirmation" class="form-label form-label-strong">{{ __('Confirmer le mot de passe') }}</label> <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password"> @error('password_confirmation') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
                            <!-- Submit Button -->
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Connexion') }}
                                </button>
                            </div>

                            <!-- General error message for empty fields -->
                            @if ($errors->any())
                                <div class="alert alert-danger mt-3">
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
    </div>
    <!-- End Blade Template Content -->
    <div class="footer">
        <p>©2024 Samia</p>
    </div>

    <script>
        // JavaScript code to validate the form
        document.querySelector('form').addEventListener('submit', function(event) {
            let isValid = true;
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('emailError');

            // Reset the error display
            emailError.style.display = 'none';
            // Check if the email format is valid
            if (!emailInput.value.match(/^[^@]+@\w+(\.\w+)+$/)) {
                emailError.style.display = 'block';
                isValid = false;
            }

            // If the form is invalid, prevent submission
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>