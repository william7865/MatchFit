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
    <?php include __DIR__ . '/partials/header.php'; ?>
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
    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>