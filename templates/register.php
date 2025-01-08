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
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form method="POST" action="/register">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="role">Role:</label>
    <select id="role" name="role" required>
        <option value="user">User</option>
        <option value="coach">Coach</option>
    </select>

    <button type="submit">Register</button>
</form>

    <?php if (!empty($error)) echo "<p>$error</p>"; ?>
</body>
</html>
