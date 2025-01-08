<?php
require_once 'db.php';

class Message {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Envoyer un message
    public function sendMessage($senderId, $receiverId, $message) {
        $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (:sender_id, :receiver_id, :message)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':sender_id', $senderId);
        $stmt->bindParam(':receiver_id', $receiverId);
        $stmt->bindParam(':message', $message);
        return $stmt->execute();
    }

    // Récupérer les messages entre deux utilisateurs
    public function getMessages($userId, $coachId) {
        $sql = "SELECT * FROM messages WHERE (sender_id = :user_id AND receiver_id = :coach_id) OR (sender_id = :coach_id AND receiver_id = :user_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':coach_id', $coachId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
