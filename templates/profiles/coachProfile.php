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
$status = $user['status'] ?? 'unavailable';

// Récupérer les séances de sport du coach
$sessions = \App\Models\User::getSessionsByCoach($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Coach</title>
    <link rel="stylesheet" href="/css/coachProfile.css">
</head>
<body>
    <?php include __DIR__ . '../../partials/header.php'; ?>
    <h1>Bienvenue sur votre profil, Coach <?php echo htmlspecialchars($name); ?></h1>
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

        <label for="status">Statut:</label>
        <select id="status" name="status">
            <option value="available" <?php echo ($status === 'available') ? 'selected' : ''; ?>>Disponible</option>
            <option value="unavailable" <?php echo ($status === 'unavailable') ? 'selected' : ''; ?>>Indisponible</option>
        </select>

        <button type="submit">Mettre à jour</button>
    </form>

    <h2>Ajouter une séance de sport</h2>
    <form method="POST" action="/createSession">
        <label for="title">Titre:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="price">Prix:</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <button type="submit">Ajouter la séance</button>
    </form>

    <h2>Vos séances de sport</h2>
    <ul>
        <?php if (!empty($sessions)): ?>
            <?php foreach ($sessions as $session): ?>
                <li>
                    <strong><?php echo htmlspecialchars($session['title']); ?></strong><br>
                    <?php echo htmlspecialchars($session['description']); ?><br>
                    Prix : <?php echo htmlspecialchars($session['price']); ?> €
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Vous n'avez pas encore ajouté de séances de sport.</li>
        <?php endif; ?>
    </ul>

    <?php include __DIR__ . '../../partials/footer.php'; ?>
</body>
</html>