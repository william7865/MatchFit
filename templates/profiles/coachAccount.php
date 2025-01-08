<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil du Coach</title>
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

    <h1>Profil du Coach</h1>
    <div class="coach-profile">
        <h2><?php echo htmlspecialchars($coach['name']); ?></h2>
        <p>Email : <?php echo htmlspecialchars($coach['email']); ?></p>
        <p>Bio : <?php echo htmlspecialchars($coach['bio'] ?? 'Le coach n\'a pas fourni de bio.'); ?></p>
        <p>URL de la vidéo : 
            <?php if (!empty($coach['video_url'])): ?>
                <a href="<?php echo htmlspecialchars($coach['video_url']); ?>" target="_blank"><?php echo htmlspecialchars($coach['video_url']); ?></a>
            <?php else: ?>
                Le coach n'a pas fourni d'URL de vidéo.
            <?php endif; ?>
        </p>
    </div>
</body>
</html>