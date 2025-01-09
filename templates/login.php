<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = \App\Models\User::authenticate($email, $password);
    if ($user) {
        session_start();
        $_SESSION['user'] = $user;
        header('Location: /dashboard');
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Connexion</title>
</head>
<body>
    <?php include __DIR__ . '/partials/header.php'; ?>
    <h2>Connexion</h2>
    <form class ="connexion"action="" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
        <button type="submit">Se connecter</button>
        <a href="register">Pas encore inscrit ?</a>
        <?php if (!empty($error)) echo "<p>$error</p>"; ?>
    </form>
    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
