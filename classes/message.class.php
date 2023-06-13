<?php

class Message extends Users{
    
    public function sendMessage($sender_id, $receiver_id, $message) {
        $sql = "INSERT INTO messages (sender_id, receiver_id, message, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iis", $sender_id, $receiver_id, $message);
        $stmt->execute();
    }

    public function fetchMessages($senderId, $receiverId, $lastMessageId = null) {
        // Fetch messages from the database
        $query = "SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY created_at ASC";
        if ($lastMessageId) {
          $query .= " AND id > ?";
        }
        $stmt = $this->conn->prepare($query);
        if ($lastMessageId) {
          $stmt->bind_param("iisi", $senderId, $receiverId, $receiverId, $senderId, $lastMessageId);
        } else {
          $stmt->bind_param("isii", $senderId, $receiverId, $receiverId, $senderId);
        }
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Convert the result set to an array of associative arrays
        $messages = array();
        while ($row = $result->fetch_assoc()) {
          $messages[] = $row;
        }
        return $messages;
      }
      public function updateMessage($messageId, $newMessage) {
        $stmt = $this->conn->prepare("UPDATE messages SET message = ? WHERE id = ?");
        $stmt->bind_param("is",$messageId, $newMessage);
        $stmt->execute();
        
    }
}