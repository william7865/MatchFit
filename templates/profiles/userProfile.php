<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

$user = \App\Models\User::findById($_SESSION['user_id']);
$sports = \App\Models\User::getSports();
$userSports = \App\Models\User::getUserSports($_SESSION['user_id']);

$name = $user['name'] ?? '';
$email = $user['email'] ?? '';
$bio = $user['bio'] ?? '';
$video_url = $user['video_url'] ?? '';
$status = $user['status'] ?? 'unavailable';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="/css/userProfile.css">
</head>
<body>
    <?php include __DIR__ . '../../partials/header.php'; ?>
    <h1>Bienvenue sur votre profil</h1>
    <form method="POST" action="/updateProfile">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

        <label for="password">Nouveau mot de passe:</label>
        <input type="password" id="password" name="password">

        <label for="sports">Sports préférés:</label>
        <select id="sports" name="sports[]" multiple>
            <?php foreach ($sports as $sport): ?>
                <option value="<?php echo $sport['id']; ?>" <?php echo in_array($sport['id'], array_column($userSports, 'id')) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($sport['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn-update">Mettre à jour</button>
    </form>

    <h2>Vos sports préférés</h2>
    <ul>
        <?php if (!empty($userSports)): ?>
            <?php foreach ($userSports as $sport): ?>
                <li>
                    <?php echo htmlspecialchars($sport['name']); ?>
                    <form method="POST" action="/removeUserSport" style="display:inline;">
                        <input type="hidden" name="sport_id" value="<?php echo $sport['id']; ?>">
                        <button type="submit" class="btn-delete">Supprimer</button>
                    </form>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Vous n'avez pas encore sélectionné de sports préférés.</li>
        <?php endif; ?>
    </ul>

    <?php include __DIR__ . '../../partials/footer.php'; ?>
</body>
</html>