<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil du Coach</title>
    <link rel="stylesheet" href="/css/coachAccount.css">
</head>
<body>
    <?php include __DIR__ . '/../partials/header.php'; ?>

    <div class="coach-page">
        <!-- Section principale -->
        <div class="main-section">
            <div class="left-content">
                <h1>Coaching Privé Remise en forme et Perte de Poids. À Domicile/En Extérieur/En Salle/En Visio/En Ligne</h1>

                <h2>Lieux du cours</h2>
                <ul>
                    <li>📍 Chez Amine : Paris 11e</li>
                    <li>📹 Webcam</li>
                    <li>🗺️ Chez vous ou lieu public : déplacement jusqu'à 5 km depuis Paris 11e</li>
                </ul>

                <!-- Ambassadeur Section -->
                <div class="ambassador-section">
                    <h3>Ambassadeur</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod, ipsum voluptatem adipisci perspiciatis asperiores, fugit, numquam ea ab cumque id iure. Eligendi perspiciatis dolorem rerum fugiat impedit animi ex consequatur.
                    </p>
                </div>
            </div>

            <!-- Carte de profil du coach -->
            <div class="profile-card">
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
                <p>Réponse : <strong>5h</strong></p>
                <p>Élèves : <strong>50+</strong></p>
                <a href="#" class="contact-button">Contacter</a>
            </div>
        </div>

        <!-- Séances de sport -->
        <h2>Ses séances de sport</h2>
        <div class="coach-sessions">
            <?php
            $sessions = \App\Models\User::getSessionsByCoach($coach['id']);
            if (!empty($sessions)): ?>
                <ul>
                    <?php foreach ($sessions as $session): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($session['title']); ?></strong><br>
                            <?php echo htmlspecialchars($session['description']); ?><br>
                            Prix : <?php echo htmlspecialchars($session['price']); ?> €
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Le coach n'a pas encore ajouté de séances de sport.</p>
            <?php endif; ?>
        </div>

        <h2>Ajouter un avis</h2>
<form method="POST" action="/addReview" class="review-form">
    <input type="hidden" name="coach_id" value="<?php echo htmlspecialchars($coach['id']); ?>">

    <div class="form-group">
        <label for="rating">Note globale :</label>
        <div class="stars">
            <input type="radio" id="star5" name="rating" value="5" required><label for="star5" title="5 étoiles"></label>
            <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 étoiles"></label>
            <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 étoiles"></label>
            <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 étoiles"></label>
            <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 étoile"></label>
        </div>
    </div>

    <div class="form-group">
        <label for="comment">Partagez votre expérience :</label>
        <textarea id="comment" name="comment" required></textarea>
    </div>

    <button type="submit" class="add-review-button">Ajouter l'avis</button>
</form>
        <!-- Affichage des avis -->
        <h2>Avis <span class="info-icon">ⓘ</span></h2>
        <div class="coach-reviews">
            <?php
            $reviews = \App\Models\User::getReviewsByCoach($coach['id']);
            if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review-card">
                        <div class="review-header">
                            <div class="review-avatar">
                                <span class="review-initial"><?php echo strtoupper(substr(htmlspecialchars($review['user_name']), 0, 1)); ?></span>
                            </div>
                            <div class="review-user">
                                <strong><?php echo htmlspecialchars($review['user_name']); ?></strong>
                            </div>
                            <div class="review-rating">
                                ⭐ <?php echo htmlspecialchars($review['rating']); ?>
                            </div>
                        </div>
                        <div class="review-content">
                            <p><?php echo htmlspecialchars($review['comment']); ?></p>
                        </div>
                        <?php if (!empty($review['response'])): ?>
                            <div class="review-response">
                                <strong>Réponse de <?php echo htmlspecialchars($coach['name']); ?> :</strong>
                                <p><?php echo htmlspecialchars($review['response']); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Il n'y a pas encore d'avis pour ce coach.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>