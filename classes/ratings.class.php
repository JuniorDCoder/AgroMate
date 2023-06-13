<?php

class Ratings extends Message {
    
  
    public function addRating($farmerId, $userId, $rating, $comment = '') {
      $stmt = $this->conn->prepare("INSERT INTO farmer_ratings (farmer_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("iiis", $farmerId, $userId, $rating, $comment);
      $stmt->execute();
      
    }
  
    public function getAverageRating($farmerId) {
      $stmt = $this->conn->prepare("SELECT AVG(rating) FROM farmer_ratings WHERE farmer_id = ?");
      $stmt->bind_param("i", $farmerId);
      $stmt->execute();
      $result = $stmt->get_result();
      $avgRating = $result->fetch_row()[0];
     
      return $avgRating;
    }
  
    public function getTotalRatings($farmerId) {
      $stmt = $this->conn->prepare("SELECT * FROM farmer_ratings WHERE farmer_id = ?");
      $stmt->bind_param("i", $farmerId);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result;
    }
    public function countTotalRatings($farmerId) {
      $stmt = $this->conn->prepare("SELECT COUNT(*) FROM farmer_ratings WHERE farmer_id = ?");
      $stmt->bind_param("i", $farmerId);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result;
    }
    public function deleteRating($id){
      
    }
  }