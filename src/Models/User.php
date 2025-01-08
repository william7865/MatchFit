<?php

namespace App\Models;

use PDO;

class User {

    public static function create($name, $email, $password, $role) {
        $pdo = self::getDatabaseConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $hashedPassword, $role]);
    }

    public static function createCoachProfile($email) {
        $pdo = self::getDatabaseConnection();
        $user = self::findByEmail($email);
        if ($user) {
            $sql = "INSERT INTO coaches (user_id, bio, video_url) VALUES (?, '', '')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$user['id']]);
        }
    }

    public static function authenticate($email, $password) {
        $pdo = self::getDatabaseConnection();
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public static function findByEmail($email) {
        $pdo = self::getDatabaseConnection();
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private static function getDatabaseConnection() {
        $host = getenv('DB_HOST');
        $db = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWORD');

        $dsn = "pgsql:host=$host;dbname=$db";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}
