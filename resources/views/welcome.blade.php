<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionnaire de Tâches</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('build/assets/app-e33f6074.css') }}">
  <script src="{{ asset('build/assets/app-e33f6074.js') }}" defer></script>
</head>
<style>      .features-list li {
    padding: 10px;
    border-bottom: 1px solid #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    transition: background-color 0.3s;
  }
  .features-list li:hover {
    background-color: rgba(255,255,255,0.2);
  }
  .features-list i {
    font-size: 1.5em;
    color: #007bff;
    transition: transform 0.3s;
  }
  .features-list i:hover {
    transform: rotate(360deg);
  }

  /* Button Styles */
.button-container a {
  background-color: #007bff;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
  display: inline-block;
  border: none;
  border-radius: 5px;
  transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
}

.button-container a:hover {
  background-color: #0056b3;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

/* Dashboard Section Adjustment */
.home-section {
  margin-top: 50px; /* Adjust this value to move the section down */
}

/* Additional Dashboard Section Styles */
.home-section {
  background-color: rgba(255,255,255,0.1);
  border-radius: 10px;
  padding: 40px;
  transition: transform 0.3s, box-shadow 0.3s;
}

.home-section:hover {
  transform: scale(1.02);
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
</style>
<body>
<div class="nav-bar">
<div class="left">
  <a href="#home" class="active">Task Manager</a>
</div>
  <!-- Dans un fichier Blade -->
@if(Auth::check())
      <!-- L'utilisateur est connecté --> 
       <a href="{{ route('logout') }}" class="right">Déconnexion</a>
      <a href="{{ route('new_task') }}" class="right">Nouvelle Tâche</a>
      <a href="{{ route('my_tasks') }}" class="right">Mes Tâches</a>
     
        <form id="logout-form" method="head" style="display: none;">
            @csrf
        </form>
@else
    <!-- L'utilisateur n'est pas connecté -->
    <a href="{{ route('register') }}" class="right">Inscription</a>
    <a href="{{ route('login') }}" class="right">Connexion</a>
    
@endif
</div>
</div>

<div class="home-section">
  <h1>Bienvenue sur le Gestionnaire de Tâches</h1>
  <ul class="features-list">
    <li><i class="fas fa-plus-circle"></i> Créer des tâches</li>
    <li><i class="fas fa-edit"></i> Modifier vos tâches</li>
    <li><i class="fas fa-tasks"></i> Visualiser toutes vos tâches</li>
    <li><i class="fas fa-trash-alt"></i> Supprimer des tâches</li>
  </ul>
</div>

<div class="footer">
  <p>©2024 Samia</p>
</div>
</body>
</html>
