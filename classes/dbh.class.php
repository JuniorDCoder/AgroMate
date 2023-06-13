<?php
require('config.php');
class Dbh{
    private $conn;
    private static $instance;
    private $db_host = db_host;
    private $db_user = db_user;
    private $db_pwd = db_pwd;
    private $db_name = db_name;
    function __construct(){
        
    }

    public function connectFirst(){
        $this->conn = mysqli_connect($this->db_host, $this->db_user, $this->db_pwd, $this->db_name);
        if (!$this->conn) {
            die("Connection failed: ".mysqli_connect_error());
        }
       
        return $this->conn;
    }
}