<?php

class Farmers extends Products
{   protected function checkName($name){
        if (!preg_match("/^[a-zA-Z0-9]*$/",$name) || empty($name)) {
           return false;
        }
        return true;
    }
    protected function checkEmail($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email)) {
           return false;
        }
        return true;
    }
    protected function checkPassword($pwd){
        if (empty($pwd) || strlen($pwd) < 6) {
            return false;
        }
        return true;
    }
    public function addFarmer($unique_id, $name, $email, $address, $phone, $pwd){
        
        if(!$this->checkName($name)){
            return 0;
        }
        else if(!$this->checkEmail($email)){
            return 1;
        }
        else if(!$this->checkPassword($pwd)){
            return 2;
        }
        else if ($this->farmerExist($name, $email)) {
            return 3;
        }
        else{
            $stmt = $this->conn->prepare("INSERT INTO farmers(unique_id,farmer_name,farmer_email,farmer_address,farmer_phone, farmer_password) VALUES (?,?,?,?,?,?);");
            $password = password_hash($pwd, PASSWORD_DEFAULT);
            $stmt->bind_param("ssssss",$unique_id,$name, $email, $address, $phone, $password);
            if($stmt->execute()){
                return true;
            }
        }
    }
    private function farmerExist($name, $email){
        $stmt = $this->conn->prepare("SELECT * FROM farmers WHERE farmer_name = ? OR farmer_email = ?;");
        $stmt->bind_param("ss",$name, $email);
        $stmt->execute();

        $stmt->store_result();
        return $stmt->num_rows() > 0;
    }

    public function loginFarmer($email, $password){
        $result = $this->getFarmer($email);
        $row = mysqli_fetch_assoc($result);
        
        if(!$this->checkEmail($email)){
            return -1;
        }
        else if(!$this->checkPassword($password)){
            return 2;
        }
        else if (empty($result)) {
            return 0;
        }

        else{
            if (password_verify($password, $row['farmer_password'])) {
                if ($this->updateStatus($email,"Active")) {
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
    private function updateStatus($email, $status){
        $stmt = $this->conn->prepare("UPDATE farmers SET status = ? WHERE farmer_email = ?;");
        
        $stmt->bind_param("ss",$status,$email);

        if ($stmt->execute()) {
            return true;
        }
        else{
            return false;
        }
    }

    public function logoutFarmer($email){
        
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

    public function getFarmer($email){
        $stmt = $this->conn->prepare("SELECT *  FROM farmers WHERE farmer_email = ?;");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function getFarmerById($id){
        $stmt = $this->conn->prepare("SELECT *  FROM farmers WHERE farmer_id = ?;");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function uploadFarmerProfilePicture($farmer_id, $fileSize, $fileExtension, $fileTmpName, $imageName){
        if ($this->checkFileSize($fileSize) && $this->checkFileExtension($fileExtension)) {
            $imageNewName = time()."-".$imageName;
            $fileNewName = "../farmers/public/farmerProfileImages/".$imageNewName;
            $uploaded = move_uploaded_file($fileTmpName, $fileNewName);
            
            $stmt = $this->conn->prepare("UPDATE farmers SET profile_picture = ? WHERE farmer_id = ?;");
            $stmt->bind_param("si",$imageNewName, $farmer_id);
            if ($stmt->execute()) {
                return true;
            }
            else{
                return false;
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
    protected function checkFileSize($fileSize){
        if ($fileSize < 2000000) {
            return true;
        }
        else{
            return false;
        }
    }
    protected function checkFileExtension($fileExtension){
        if ($fileExtension == 'jpg' || $fileExtension == 'png' || $fileExtension == 'jpeg') {
            return true;
        }
        else{
            return false;
        }
    }
    private function updateOtherProfileDetails($farmer_id, $farmer_name, $farmer_address, $farmer_phone){
        $stmt = $this->conn->prepare("UPDATE farmers 
        SET farmer_name = ?, farmer_address = ?, farmer_phone = ? WHERE farmer_id = ?;
        UPDATE products
        SET farmer_name ='$farmer_name';
        ");
        $stmt->bind_param("sssi",$farmer_name, $farmer_address, $farmer_phone, $farmer_id);

        if ($stmt->execute()) {
            return true;
        }
        else{
            return false;
        }
    }
    public function uploadProfilePicture($farmer_id, $fileSize, $fileExtension, $fileTmpName, $imageName, $farmer_name, $farmer_address, $farmer_phone){
        if ($this->checkFileSize($fileSize) && $this->checkFileExtension($fileExtension)) {
            $imageNewName = time()."-".$imageName;
            $fileNewName = "../public/farmerProfileImages/".$imageNewName;
            $uploaded = move_uploaded_file($fileTmpName, $fileNewName);

            $stmt = $this->conn->prepare( "UPDATE farmers SET profile_picture = ? WHERE farmer_id=?;");
            $stmt->bind_param("si",$imageNewName, $farmer_id);
            
            if ($uploaded && $stmt->execute() && $this->updateOtherProfileDetails($farmer_id, $farmer_name, $farmer_address, $farmer_phone)) {
                
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
    public function countFarmers(){
        
    }
    public function getAllExistingFarmers(){
        $stmt = $this->conn->prepare("SELECT * FROM farmers");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;   
    }
}