<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatchFit - Accueil</title>
    <link rel="stylesheet" href="styles.css">
<body>
    <header>
        <h1>Bienvenue sur MatchFit</h1>
        <nav>
            <a href="/">Accueil</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/coach">Coach</a>
                <a href="/free-courses">Cours gratuit</a>
                <a href="/profile">Profile</a>
                <form action="/logout" method="post" style="display:inline;">
                    <button type="submit">Déconnexion</button>
                </form>
            <?php else: ?>
                <a href="/login">Se connecter</a> |
                <a href="/register">S'inscrire</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <section>
            <h2>Rejoignez-nous et trouvez le coach de vos rêves !</h2>
            <p>Connectez-vous ou inscrivez-vous pour accéder à nos services de coaching personnalisé.</p>
        </section>
    </main>
</body>
</html>