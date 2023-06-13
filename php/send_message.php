<?php

session_start();
require('classes/products.class.php');
require('classes/farmers.class.php');
require('classes/users.class.php');
require('classes/message.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_GET['receiverId'];
    $message = $_POST['message'];

    $message_obj = new Message();
    $message_obj->sendMessage($sender_id, $receiver_id, $message);
}