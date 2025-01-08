<?php
$host = '127.0.0.1';  // Adresse du serveur
$db = 'matchfit';      // Nom de la base de données
$user = 'postgres';    // Utilisateur de la base de données
$pass = 'password';    // Mot de passe de l'utilisateur

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
?>
