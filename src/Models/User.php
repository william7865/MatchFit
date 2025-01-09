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

    public static function getAllCoaches() {
        $pdo = self::getDatabaseConnection();
        $sql = "SELECT id, name, email FROM users WHERE role = 'coach'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public static function update($userId, $name, $email, $password = null) {
        $pdo = self::getDatabaseConnection();
        $sql = "UPDATE users SET name = ?, email = ?";
        $params = [$name, $email];

        if ($password !== null) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql .= ", password = ?";
            $params[] = $hashedPassword;
        }

        $sql .= " WHERE id = ?";
        $params[] = $userId;

        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
    }
    public static function updateCoachProfile($userId, $bio, $video_url, $status) {
        $pdo = self::getDatabaseConnection();
        $sql = "UPDATE coaches SET bio = ?, video_url = ?, status = ? WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$bio, $video_url, $status, $userId]);
    }

    public static function findById($id) {
        $pdo = self::getDatabaseConnection();
        $sql = "SELECT users.*, coaches.bio, coaches.video_url, coaches.status 
                FROM users 
                LEFT JOIN coaches ON users.id = coaches.user_id 
                WHERE users.id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function getSports() {
        $pdo = self::getDatabaseConnection();
        $sql = "SELECT * FROM sports";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public static function updateUserSports($userId, $sports) {
        $pdo = self::getDatabaseConnection();

        // Récupérer les sports existants de l'utilisateur
        $existingSports = self::getUserSports($userId);
        $existingSportIds = array_column($existingSports, 'id');

        // Ajouter les nouveaux sports
        $sql = "INSERT INTO user_sports (user_id, sport_id) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        foreach ($sports as $sportId) {
            if (!in_array($sportId, $existingSportIds)) {
                $stmt->execute([$userId, $sportId]);
            }
        }
    }

    public static function removeUserSport($userId, $sportId) {
        $pdo = self::getDatabaseConnection();
        $sql = "DELETE FROM user_sports WHERE user_id = ? AND sport_id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$userId, $sportId]);
    }

    public static function getUserSports($userId) {
        $pdo = self::getDatabaseConnection();
        $sql = "SELECT sports.id, sports.name FROM user_sports 
                JOIN sports ON user_sports.sport_id = sports.id 
                WHERE user_sports.user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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