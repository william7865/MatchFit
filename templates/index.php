<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatchFit - Accueil</title>
    <link rel="stylesheet" href="/css/style.css">
<body>
    <?php include __DIR__ . '/partials/header.php'; ?>
    <main>
    <section class="hero">
      <h1>Bienvenue chez Match<span>Fit</span></h1>
      <p>Avec matchfit nous serons là pour vous accompagner</p>
      <div class="cards">
        <div class="card">
          <img src="/image/coach.jpg" alt="Image 1">
          <div class="card-content">
            <h2>Coach</h2>
            <p>Découvrez nos coachs professionnels prêts à vous <mark>accompagner</mark></p>
          </div>
        </div>
        <div class="card">
          <img src="/image/training.jpg" alt="Image 2">
          <div class="card-content">
            <h2>Cours Gratuit</h2>
            <p>Profitez de nos cours gratuits pour découvrir notre <mark>expertise</mark></p>
          </div>
        </div>
      </div>
    </section>

    <div class="container">
        <div class="wrapper">
            <img src="/image/football.jpg">
            <img src="/image/basketball.jpg">
            <img src="/image/tennis.jpg">
            <img src="/image/rugby.jpg">
            <img src="/image/football.jpg">
            <img src="/image/basketball.jpg">
            <img src="/image/tennis.jpg">
            <img src="/image/rugby.jpg">
        </div>
    </div>
    </section>

    <section class="team">
      <div class="profile">
        <div class="avatar"></div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
      <div class="profile">
        <div class="avatar"></div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
      <div class="profile">
        <div class="avatar" style="background-image: url(IMG_9270.JPG);"></div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
      <div class="profile">
        <div class="avatar" style="background-image: url(IMG_9269.JPG);"></div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </section>
  </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>