<?php
include('../includes/autoloader1.inc.php');


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sender_id = $_SESSION['user_id'];
    $lastMessageId = $_GET['lastMessageId'];
    $receiver_id = $_GET['receiverId'];

    $message_obj = new Message;
    $messages = $message_obj->fetchMessages($sender_id, $receiver_id, $lastMessageId);
    header('Content-Type: application/json');
    echo json_encode($messages);
}