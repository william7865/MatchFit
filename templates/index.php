<?php
// Redirige l'utilisateur si déjà connecté (par exemple avec $_SESSION)
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard'); // Redirige vers une page de tableau de bord si déjà connecté
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatchFit - Accueil</title>
    <link rel="stylesheet" href="styles.css"> <!-- Si tu veux ajouter un fichier CSS -->
</head>
<body>
    <header>
        <h1>Bienvenue sur MatchFit</h1>
        <nav>
            <a href="login">Se connecter</a> |
            <a href="register">S'inscrire</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Rejoignez-nous et trouvez le coach de vos rêves !</h2>
            <p>Connectez-vous ou inscrivez-vous pour accéder à nos services de coaching personnalisé.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 MatchFit - Tous droits réservés</p>
    </footer>
</body>
</html>
