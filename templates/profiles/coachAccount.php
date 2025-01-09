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
    <?php include __DIR__ . '/../partials/header.php'; ?>

    <h1>Profil du Coach</h1>
    <div class="coach-profile">
        <h2><?php echo htmlspecialchars($coach['name']); ?></h2>
        <p>Email : <?php echo htmlspecialchars($coach['email']); ?></p>
        <p>Bio : 
            <?php if (!empty($coach['bio'])): ?>
                <?php echo htmlspecialchars($coach['bio']); ?>
            <?php else: ?>
                Le coach n'a pas fourni de bio.
            <?php endif; ?>
        </p>
        <p>Statut : 
            <?php if (!empty($coach['status'])): ?>
                <?php echo htmlspecialchars($coach['status'] === 'available' ? 'Disponible' : 'Indisponible'); ?>
            <?php else: ?>
                Le coach n'a pas fourni de statut.
            <?php endif; ?>
        </p>
        <p>Vidéo : 
            <?php if (!empty($coach['video_url'])): ?>
                <?php
                // Convertir l'URL YouTube en URL d'intégration
                $video_url = htmlspecialchars($coach['video_url']);
                if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $video_url, $id)) {
                    $video_id = $id[1];
                    $embed_url = "https://www.youtube.com/embed/$video_id";
                } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $video_url, $id)) {
                    $video_id = $id[1];
                    $embed_url = "https://www.youtube.com/embed/$video_id";
                } else {
                    $embed_url = $video_url;
                }
                ?>
                <iframe width="560" height="315" src="<?php echo $embed_url; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <?php else: ?>
                Le coach n'a pas fourni de vidéo.
            <?php endif; ?>
        </p>
    </div>
    <?php include __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>