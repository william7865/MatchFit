<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Coaching Sportif</title>
    <link rel="stylesheet" href="/css/coach.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
</head>
<body>
    <?php include __DIR__ . '/partials/header.php'; ?>
    <div id="app">
        <section class="hero-section" :class="{'fade-in': showContent}">
            <div class="hero-content">
                <h1>Coaching sportif : 16 703 coaches pour un programme sur-mesure</h1>
                <ul class="hero-features">
                    <li>🥇 La crème du coaching sportif en France</li>
                    <li>🏋️ 16 703 entraîneurs</li>
                    <li>🔒 Paiement sécurisé</li>
                    <li>💸 Aucune commission</li>
                </ul>
                <div class="search-bar">
                    <input type="text" placeholder="Coaching Sportif">
                    <button>Rechercher</button>
                </div>
            </div>
            <div class="hero-images">
                <div class="image image-1"></div>
                <div class="image image-2"></div>
                <div class="image image-3"></div>
            </div>
        </section>

        <h1>Trouvez le coach parfait pour atteindre vos objectifs !</h1>
        <div class="coaches-container">
            <?php foreach ($coaches as $coach): ?>
                <a href="/coach/profile/<?php echo $coach['id']; ?>" class="coach-card-link">
                    <div class="coach-card" :class="{'visible': showContent}">
                        <h2><?php echo htmlspecialchars(isset($coach['name']) ? $coach['name'] : 'Nom non disponible'); ?></h2>
                        <p><?php echo htmlspecialchars(isset($coach['email']) ? $coach['email'] : 'Email non disponible'); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include __DIR__ . '/partials/footer.php'; ?>
    <script>
        new Vue({
            el: '#app',
            data: {
                showContent: false,
            },
            mounted() {
                setTimeout(() => {
                    this.showContent = true;
                }, 0);
            }
        });
    </script>
</body>
</html>