<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $role = $_POST['role'];
        \App\Models\User::create($name, $email, $password, $role);
        header('Location: /login');
        exit;
    } catch (Exception $e) {
        $error = "L'email est déjà utilisé.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <title>Inscription</title>
</head>
<body>
<h2>Inscription</h2>
    <form class="inscription" action="/register" method="post">
        <label for="name">Nom</label>
        <input type="text" name="name" id="name">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
        <label for="password2">Confirmer le mot de passe</label>
        <input type="password" name="password2" id="password2">
    <label for="role">Role:</label>
    <select id="role" name="role" required>
        <option value="user">User</option>
        <option value="coach">Coach</option>
    </select>
    <button type="submit">S'inscrire</button>
    <a href="login">Déjà inscrit ?</a>
</form>

    <?php if (!empty($error)) echo "<p>$error</p>"; ?>
</body>
</html>