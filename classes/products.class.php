<?php

class Products

{
    protected $conn;
    function __construct(){
        require_once(dirname(__FILE__).'/dbh.class.php');
        $db = new Dbh();
        $this->conn = $db->connectFirst();
    }
    public function getAllFarmerProducts($farmer_name){
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE farmer_name = ?;");
        $stmt->bind_param("s",$farmer_name);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
    public function getParticularProduct($product_id){
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE product_id = ?;");
        $stmt->bind_param("i",$product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function getAllExistingProducts(){
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY product_id DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function countProducts($farmer_name){
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE farmer_name = ?;");
        $stmt->bind_param("s",$farmer_name);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows();
        return $result;
    }

    public function addProductPicture($fileSize, $fileExtension, $fileTmpName, $imageName,$farmer_name,$farmer_email,$farmer_phone, $product_name, $product_description, $product_price){
        if ($this->checkFileSize($fileSize) && $this->checkFileExtension($fileExtension)) {
            $imageNewName = time()."-".$imageName;
            $fileNewName = "../public/farmerProductImages/".$imageNewName;
            $uploaded = move_uploaded_file($fileTmpName, $fileNewName);
            if ($uploaded && $this->addOtherProductDetails($farmer_name, $farmer_email, $farmer_phone, $product_name, $product_description, $product_price, $imageNewName)) {
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
    private function addOtherProductDetails($farmer_name, $farmer_email, $farmer_phone, $product_name, $product_description, $product_price, $product_image){
        $stmt = $this->conn->prepare("INSERT INTO products(farmer_name,farmer_email farmer_phone, product_name, product_description, product_price, image_name) VALUES (?,?,?,?,?,?);");
        $stmt->bind_param("sssssis",$farmer_name, $farmer_email, $farmer_phone, $product_name,$product_description,$product_price,$product_image);
        if ($stmt->execute()) {
            return true;
        }
    }
    private function checkFileSize($fileSize){
        if ($fileSize < 2000000) {
            return true;
        }
        else{
            return false;
        }
    }
    private function checkFileExtension($fileExtension){
        $allowed_extensions = ["jpg","png","jpeg","jfif","gif"];
        if (in_array($fileExtension, $allowed_extensions)) {
            return true;
        }
        else{
            return false;
        }
    }
    public function deleteProduct($id){
        $stmt = $this->conn->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->bind_param("i",$id);
        if ($stmt->execute()) {
            return true;
        }
        else{
            return false;
        }
    }
}
