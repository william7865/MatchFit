<?php
session_start();
?>
<?php
$sports = [
    'football' => [
        'title' => 'Football',
        'videos' => [
            ['title' => 'Tir', 'src' => '/video/le_tir.mp4', 'steps' => [
                'Positionnez vos pieds à largeur des épaules.',
                'Pliez légèrement les genoux pour vous équilibrer.',
                'Tenez le ballon avec vos deux mains au niveau de la poitrine.',
                'Propulsez le ballon en tendant vos bras.',
            ]],
            ['title' => 'Passe', 'src' => '/video/la_passe.mp4', 'steps' => [
                'Placez-vous face à votre partenaire.',
                'Tenez le ballon avec les deux mains.',
                'Pliez légèrement les coudes et préparez-vous à pousser.',
                'Lancez le ballon avec une trajectoire droite.',
            ]],
            ['title' => 'Dribble', 'src' => '/video/le_dribble.mp4', 'steps' => [
                'Tenez le ballon d’une main au niveau de la taille.',
                'Faites rebondir le ballon contre le sol.',
                'Alternez la main si nécessaire pour contourner l’adversaire.',
            ]],
            ['title' => 'Défense', 'src' => '/video/la_defense.mp4', 'steps' => [
                'Gardez une position basse avec les genoux fléchis.',
                'Placez vos bras devant pour intercepter.',
                'Suivez les mouvements de votre adversaire avec vos pieds.',
            ]],
        ],
    ],
    'basketball' => [
        'title' => 'Basketball',
        'videos' => [
            ['title' => 'Tir au panier', 'src' => '/video/le_tir_basket.mp4', 'steps' => [
                'Placez vos pieds à largeur des épaules.',
                'Fléchissez légèrement les genoux pour gagner en stabilité.',
                'Visez l’arceau avec vos yeux avant de tirer.',
                'Étendez vos bras et suivez le mouvement avec vos poignets.',
            ]],
            ['title' => 'Passe en basket', 'src' => '/video/la_passe_basket.mp4', 'steps' => [
                'Tenez le ballon à deux mains près de votre poitrine.',
                'Choisissez votre coéquipier comme cible.',
                'Propulsez le ballon vers lui avec force et précision.',
            ]],
            ['title' => 'Dribble', 'src' => '/video/le_dribble_basket.mp4', 'steps' => [
                'Faites rebondir le ballon avec une main.',
                'Gardez les yeux levés pour observer le terrain.',
                'Changez de main pour éviter vos adversaires.',
            ]],
            ['title' => 'Défense en basketball', 'src' => '/video/la_defense_basket.mp4', 'steps' => [
                'Adoptez une posture basse avec les genoux fléchis.',
                'Suivez les mouvements de votre adversaire latéralement.',
                'Essayez d’intercepter le ballon sans commettre de faute.',
            ]],
        ],
    ],
    'rugby' => [
        'title' => 'Rugby',
        'videos' => [
            ['title' => 'Passe en rugby', 'src' => '/video/la_passe_rugby.mp4', 'steps' => [
                'Positionnez-vous en oblique par rapport à votre coéquipier.',
                'Tenez le ballon à deux mains.',
                'Effectuez une passe rapide avec les deux mains.',
            ]],
            ['title' => 'La mêlée', 'src' => '/video/la_melee_rugby.mp4', 'steps' => [
                'Les avants des deux équipes se regroupent et se lient pour former deux blocs solides.',
                'Sur l’instruction de l’arbitre ("flexion", "liaison", "jeu"), les deux blocs entrent en contact de manière contrôlée.',
                'Le demi de mêlée introduit le ballon au centre de la mêlée.',
                'Les joueurs tentent de talonner le ballon avec leurs pieds pour le récupérer et le faire sortir vers l’arrière.',
                'La mêlée se termine lorsque le ballon sort proprement ou si l’arbitre siffle une faute.',
            ]],
            ['title' => 'Ruck', 'src' => '/video/le_ruck.mp4', 'steps' => [
                'Positionnez-vous au-dessus du ballon au sol.',
                'Poussez contre vos adversaires avec vos épaules.',
                'Protégez le ballon pour votre équipe.',
            ]],
            ['title' => 'Jeu au pied', 'src' => '/video/le_jeu_au_pied.mp4', 'steps' => [
                'Positionnez le ballon de manière stable.',
                'Reculez de quelques pas pour préparer votre tir.',
                'Frappez le ballon avec le dessus de votre pied.',
            ]],
        ],
    ],
    'tennis' => [
        'title' => 'Tennis',
        'videos' => [
            [
                'title' => 'Service',
                'src' => '/video/le_service_tennis.mp4',
                'steps' => [
                    'Placez vos pieds parallèles au filet.',
                    'Lancez la balle en l’air avec votre main non dominante.',
                    'Frappez la balle avec votre raquette au sommet du lancer.',
                ],
            ],
            [
                'title' => 'Coup droit',
                'src' => '/video/le_coup_droit_tennis.mp4',
                'steps' => [
                    'Positionnez-vous face à la balle.',
                    'Frappez la balle avec la face ouverte de la raquette.',
                    'Suivez votre mouvement pour plus de puissance.',
                ],
            ],
            [
                'title' => 'Revers',
                'src' => '/video/le_revers_tennis.mp4',
                'steps' => [
                    'Tenez la raquette avec les deux mains.',
                    'Effectuez un mouvement fluide de l’arrière vers l’avant.',
                    'Visez une trajectoire basse pour déstabiliser l’adversaire.',
                ],
            ],
            [
                'title' => 'Volée',
                'src' => '/video/la_vollee_tennis.mp4',
                'steps' => [
                    'Avancez vers le filet.',
                    'Frappez la balle avant qu’elle ne touche le sol.',
                    'Utilisez un mouvement court et précis.',
                ],
            ],
        ],
    ],
];

$sports_selected = isset($_POST['sports']) ? $_POST['sports'] : [];

if (empty($sports_selected)) {
    $sports_selected = ['football', 'basketball',];
}

$videos_to_display = [];
foreach ($sports_selected as $sport) {
    $videos = $sports[$sport]['videos'];
    shuffle($videos);
    $videos_to_display = array_merge($videos_to_display, $videos);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page des Cours</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #d3d3d3;
            color: #000;
        }

        .page-title {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-bottom: 20px;
        }

        .page-title h1 {
            margin: 0;
            font-size: 24px;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .video-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        video {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .steps h2 {
            margin: 10px 0;
            font-size: 18px;
            color: #333;
        }

        .steps ul, .steps ol {
            margin: 0;
            padding: 0 20px;
            text-align: left;
        }

        .steps li {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .steps ol {
            list-style-type: decimal;
        }

        @media screen and (max-width: 768px) {
            .video-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<?php include __DIR__ . '/partials/header.php'; ?>
<h1 class="page-title">Cours sélectionnés</h1>

<div class="video-grid">
    <?php foreach ($videos_to_display as $video): ?>
        <div class="video-card">
            <video controls>
                <source src="<?= $video['src'] ?>" type="video/mp4">
                Votre navigateur ne supporte pas la lecture de vidéos.
            </video>
            <h2><?= $video['title'] ?></h2>
            <ol>
                <?php foreach ($video['steps'] as $step): ?>
                    <li><?= $step ?></li>
                <?php endforeach; ?>
            </ol>
        </div>
    <?php endforeach; ?>
</div>
<?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>