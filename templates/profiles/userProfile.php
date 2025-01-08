<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header('Location: /login');
    exit;
}

// Récupérer les informations de l'utilisateur depuis la base de données
// ...

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Bienvenue sur votre profil, Utilisateur</h1>
    <!-- Afficher les informations de l'utilisateur -->
    <!-- ... -->

    <!-- Bouton de déconnexion -->
    <form action="/logout" method="post">
        <button type="submit">Déconnexion</button>
    </form>
</body>
</html>