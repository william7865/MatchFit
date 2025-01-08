<?php
session_start();
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
    <div class="coaches-container">
        <?php foreach ($coaches as $coach): ?>
            <a href="/coach/profile/<?php echo $coach['id']; ?>" class="coach-card-link">
                <div class="coach-card">
                    <h2><?php echo htmlspecialchars(isset($coach['name']) ? $coach['name'] : 'Nom non disponible'); ?></h2>
                    <p><?php echo htmlspecialchars(isset($coach['email']) ? $coach['email'] : 'Email non disponible'); ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</body>
</html>