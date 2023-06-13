<?php

class Users extends Farmers{
    public function addUser($unique_id, $name, $email, $address, $phone, $pwd){
        
        if(!$this->checkName($name)){
            return 0;
        }
        else if(!$this->checkEmail($email)){
            return 1;
        }
        else if(!$this->checkPassword($pwd)){
            return 2;
        }
        else if ($this->userExist($name, $email)) {
            return 3;
        }
        else {
            $stmt = $this->conn->prepare("INSERT INTO users(unique_id,user_name, user_email, user_address, user_phone, user_password) VALUES (?,?,?,?,?,?);");
            $password = password_hash($pwd, PASSWORD_DEFAULT);
            $stmt->bind_param("ssssss",$unique_id,$name, $email, $address, $phone, $password);

            if ($stmt->execute()) {

                return true;
            }
        }
    }
    private function userExist($name, $email){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_name = ?  OR user_email = ?;");
        $stmt->bind_param("ss",$name, $email);
        $stmt->execute();


        $stmt->store_result();
        return $stmt->num_rows() > 0;
    }
    public function loginUser($email, $password){
        $result = $this->getUser($email);
        $row = mysqli_fetch_assoc($result);
        if(!$this->checkEmail($email)){
            return -1;
        }
        else if(!$this->checkPassword($password)){
            return 2;
        }
        else if(empty($result)) {
            return 0;
        }
        else {
            if (password_verify($password, $row['user_password'])) {
                if ($this->updateStatus($row['user_id'], "Active")) {
                    return true;
                }
                else {
                    return 1;
                }
            }
            else{
                return false;
            }
        }
    }
    private function updateStatus($user_id,$status){
        $stmt = $this->conn->prepare("UPDATE users SET status = ? WHERE user_id = ?;");
        $stmt->bind_param("si",$status,$user_id);

        if ($stmt->execute()) {
            return true;
        }
        else{
            return false;
        }
    }
    public function logoutUser($email){
        
        if ($this->updateStatus($email,"Offline")) {
            session_start();
            session_unset();
            session_destroy();

            return true;
        }
        else{
            session_start();
            session_unset();
            session_destroy();
        }
    }


    public function getUser($email){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_email = ?;");
        $stmt->bind_param("s",$email);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result;
    }
    public function getUserById($id){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id = ?;");
        $stmt->bind_param("i",$id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result;
    }
    public function uploadProfilePicture($user_id, $fileSize, $fileExtension, $fileTmpName, $imageName, $user_name, $user_address, $user_phone){
        if ($this->checkFileSize($fileSize) && $this->checkFileExtension($fileExtension)) {
            $imageNewName = time()."-".$imageName;
            $fileNewName = "../public/userProfileImages/".$imageNewName;
            $uploaded = move_uploaded_file($fileTmpName, $fileNewName);

            $stmt = $this->conn->prepare( "UPDATE users SET profile_picture = ? WHERE user_id=?;");
            $stmt->bind_param("si",$imageNewName, $user_id);
            
            if ($uploaded && $stmt->execute() && $this->updateOtherProfileDetails($user_id, $user_name, $user_address, $user_phone)) {
                
                return true;
            }
        }

        else if(!$this->checkFileExtension($fileExtension)){
            return 1;
        }

        else if(!$this->checkFileSize($fileSize)){
            return 0;
        }

        else{
            return false;
        }
    }
    private function updateOtherProfileDetails($user_id, $user_name, $user_address, $user_phone){
        
        if (!$this->checkName($user_name)) {
            return 0;
        }
        else{
            if(!$this->conn->ping()){
                $this->conn->real_connect("localhost","root","","agromate");
            }
            $stmt = $this->conn->prepare("UPDATE users SET user_name =?, user_address = ?, user_phone =? WHERE user_id =?");
            $stmt->bind_param("sssi",$user_name, $user_address, $user_phone, $user_id);
            $stmt->execute();
            return true;
            
        }
    }
    public function getAllExistingUsers(){
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;   
    }
    public function saveProductForLater($user_id, $productId) {
        $stmt = $this->conn->prepare("INSERT INTO saved_products (user_id, product_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $productId);
        $stmt->execute();
      }
    
      public function getSavedProducts($user_id) {
        $savedProducts = array();
        $stmt = $this->conn->prepare("SELECT * FROM saved_products  WHERE user_id = ? ORDER BY id DESC");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
      }
    
      public function removeSavedProduct($savedProductId) {
        $stmt = $this->conn->prepare("DELETE FROM saved_products WHERE id = ?");
        $stmt->bind_param("i", $savedProductId);
        $stmt->execute();
        
      }
    
      public function moveSavedProductToCart($savedProductId) {
        $savedProduct = $this->getSavedProductById($savedProductId);
        $productId = $savedProduct['product_id'];
        $this->addProductToCart($productId);
        $this->removeSavedProduct($savedProductId);
      }
    
      private function getSavedProductById($savedProductId) {
        $stmt = $this->conn->prepare("SELECT * FROM saved_products WHERE id = ?");
        $stmt->bind_param("i", $savedProductId);
        $stmt->execute();
        $result = $stmt->get_result();
        $savedProduct = $result->fetch_assoc();
        
        return $savedProduct;
      }
      
    
      private function addProductToCart($productId) {
        // Implementation for adding a product to the cart
      }
}
