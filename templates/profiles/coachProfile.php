<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'coach') {
    header('Location: /login');
    exit;
}

$user = \App\Models\User::findByEmail($_SESSION['email']);
if (!$user) {
    echo "Erreur : utilisateur non trouvé.";
    exit;
}

// Initialiser les valeurs pour éviter les erreurs de type null
$name = $user['name'] ?? '';
$email = $user['email'] ?? '';
$bio = $user['bio'] ?? '';
$video_url = $user['video_url'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Coach</title>
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

    <h1>Bienvenue sur votre profil, Coach</h1>
    <!-- Afficher les informations du coach -->
    <form method="POST" action="/updateProfile">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

        <label for="password">Nouveau mot de passe:</label>
        <input type="password" id="password" name="password">

        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio"><?php echo htmlspecialchars($bio); ?></textarea>

        <label for="video_url">URL de la vidéo:</label>
        <input type="url" id="video_url" name="video_url" value="<?php echo htmlspecialchars($video_url); ?>">

        <button type="submit">Mettre à jour</button>
    </form>

    <!-- Bouton de déconnexion -->
    <form action="/logout" method="post">
        <button type="submit">Déconnexion</button>
    </form>
</body>
</html>