<?php
require_once 'db.php';

class Coach {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupérer le profil d'un coach
    public function getCoachByUserId($userId) {
        $sql = "SELECT * FROM coaches WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer un coach
    public function createCoach($userId, $bio, $videoUrl) {
        $sql = "INSERT INTO coaches (user_id, bio, video_url) VALUES (:user_id, :bio, :video_url)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':video_url', $videoUrl);
        return $stmt->execute();
    }
}
?>
