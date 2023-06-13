<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Messaging Portal</title>
        <link rel="stylesheet" href="../css/messaging.css">
        <link href="../css/font-awesome.min.css" rel="stylesheet" >
        <style>
            .no-messages {
            text-align: center;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            margin: 20px 0;
        }
        
        
        .no-messages h1 {
            font-size: 24px;
            margin-bottom: 10px;
            color: chartreuse;
        }
        
        .no-messages p {
            font-size: 16px;
            color: #555;
        }
        </style>
    </head>
    <body>
    <?php
            include('../includes/autoloader1.inc.php');

            // Check if the sender and receiver IDs are set in the URL
            if (isset($_GET['senderId']) && isset($_GET['receiverId'])) {
                $senderId =$_GET['senderId'];
                $receiverId = $_GET['receiverId'];
                

                // Check if a message was sent
                $message = new Message;
                if (isset($_POST['message'])) {
                $messageText = $_POST['message'];
                
                $message->sendMessage($senderId, $receiverId, $messageText);
                }
                
                $messages = $message->fetchMessages($senderId, $receiverId);
                
               
            }
        ?>
        <?php

            $users = new Users;
            $result = $users->getAllExistingUsers();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="users">
                        <h2>All  &nbsp;<i class="fa fa-buysellads text-dark fs-2 align-middle"></i> groMate Users</h2>
                        <ul class="list-group">
                        <?php
                         if (isset($_SESSION['unique_id'])) {
                                $sender_Id = $_SESSION['unique_id'];
                              } else {
                                // Handle the case where the sender ID is not set
                              }
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<a href="messaging.php?receiverId='.$row['unique_id'].'&senderId='.$_SESSION['unique_id'].'">'.$row['user_name'].': ('.$row['user_email'].')</a><br>';
                            }

                        ?>
                        </ul>
                    </div>
                </div>
                <a href="dashboard.php?msg=Returned Back To Dashboard!" class="dashboard-button btn btn-danger">Return to Dashboard</a>
                <div class="col-md-8">
                    <div class="chat">
                        <h2><i class="fa fa-buysellads text-dark fs-2 align-middle"></i> groMate</h2>
                        <div class="chat-window">
                        <div class="message-container">
                        <?php
              // Display all messages between the sender and receiver
              if (isset($messages)) {
                foreach ($messages as $message) {
                    if ($message['sender_id'] == $senderId) {
                      echo '<div class="message-row right">';
                      echo '<div class="message right">';
                      echo '<p class="send">' . $message['message'] . '</p>';
                      echo '</div>';
                      echo '<h6><img src="public/farmerProfileImages/work-1.png" class="rounded-image1" width="60" height="60" alt="abc"></h6>';
                      echo '</div>';
                    } else {
                      echo '<div class="message-row left">';
                      echo '<h6><img src="public/farmerProfileImages/work-1.png" width="60" height="60" class="rounded-image" alt="abc"></h6>';
                      echo '<div class="message left">';
                      echo '<p class="receive">' . $message['message'] . '</p>';
                      echo '</div>';
                      echo '</div>';
                    }
                  }
              }
               else{
                echo '<div class="no-messages">
                    
                    <h1>There are no messages to display</h1>
                    <p>Please check back later for updates.</p>
                    </div> '; 
                }
            ?>
                            </div>
                        </div>
                        <form action="" method="post">
                        <div class="chat-input">
                            <input type="text" name="message" class="form-control" placeholder="Type a message">
                            <button id="send-button" type="submit" class="btn btn-primary">Send</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
        <script>
        $(function() {
            // The ID of the last message received
            var lastMessageId = null;

            // Repeatedly fetch new messages from the server
            setInterval(function() {
                $.get('messaging.php?receiverId=<?php echo $receiverId; ?>&lastMessageId=' + lastMessageId, function(data) {
                    // Append new messages to the message container
                    data.forEach(function(message) {
                    var html = '';
                    if (message.sender_id == '<?php echo $senderId; ?>') {
                        html += '<div class="message-row right">';
                        html += '<div class="message right">';
                        html += '<p class="send">' + message.message + '</p>';
                        html += '</div>';
                        html += '<h6><img src="../img/8.jpg" class="rounded-image1" alt="abc"></h6>';
                        html += '</div>';
                    } else {
                        html += '<div class="message-row left">';
                        html += '<h6><img src="../img/8.jpg" class="rounded-image" alt="abc"></h6>';
                        html += '<div class="message left">';
                        html += '<p class="receive">' + message.message + '</p>';
                        html += '</div>';
                        html += '</div>';
                    }
                    $('.message-container').append(html);

                    // Update the last message ID
                    lastMessageId = message.id;
                    });
                });
            }, 1000);
        });
        </script>
    </body>
    </body>
</html>