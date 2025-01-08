<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header('Location: /login');
    exit;
}

$user = \App\Models\User::findByEmail($_SESSION['email']);
if (!$user) {
    echo "Erreur : utilisateur non trouvé.";
    exit;
}
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
    <form method="POST" action="/updateProfile">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="password">Nouveau mot de passe:</label>
        <input type="password" id="password" name="password">

        <button type="submit">Mettre à jour</button>
    </form>

    <!-- Bouton de déconnexion -->
    <form action="/logout" method="post">
        <button type="submit">Déconnexion</button>
    </form>
</body>
</html>