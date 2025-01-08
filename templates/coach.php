<?php
require_once __DIR__ . '/../src/Models/User.php';

$coaches = \App\Models\User::getAllCoaches();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Coachs</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <header>
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

    <h1>Liste des Coachs</h1>
    <ul>
        <?php foreach ($coaches as $coach): ?>
            <li><?php echo htmlspecialchars($coach['name']); ?> - <?php echo htmlspecialchars($coach['email']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>