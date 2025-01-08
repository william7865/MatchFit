<?php
require_once 'db.php';

class Review {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Ajouter un avis
    public function addReview($coachId, $userId, $rating, $comment) {
        $sql = "INSERT INTO reviews (coach_id, user_id, rating, comment) VALUES (:coach_id, :user_id, :rating, :comment)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':coach_id', $coachId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        return $stmt->execute();
    }

    // Récupérer les avis d'un coach
    public function getReviewsByCoach($coachId) {
        $sql = "SELECT * FROM reviews WHERE coach_id = :coach_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':coach_id', $coachId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
