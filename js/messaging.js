$(document).ready(function() {
    // Load list of users
    $.ajax({
        url: "users.php",
        type: "GET",
        dataType: "json",
        success: function(users) {
            for (var i = 0; i < users.length; i++) {
                var user = users[i];
                var html = '<li class="list-group-item" data-user-id="' + user.id + '">' + user.name + '</li>';
                $('.users ul').append(html);
            }
        }
    });

    // Send message
    $('#send-button').click(function(event) {
        event.preventDefault();

        var message = $('.chat-input input').val();
        if (message !== '') {
            $.ajax({
                url: "../php/send_message.php",
                type: "POST",
                data: {
                    receiver_id: receiver_id,
                    message: message
                },
                success: function() {
                    // Clear the message input field
                    $('.chat-input input').val('');

                    // Fetch messages
                    fetchMessages(receiver_id);
                },
                error: function() {
                    alert("Error sending message");
                }
            });
        }
    });

    // Load chat window
    var receiver_id = null;
    $('.users ul').on('click', 'li', function() {
        receiver_id = $(this).data('user-id');

        // Clear chat window
        $('.chat-window').empty();

        // Fetch messages
        fetchMessages(receiver_id);
    });

    // Send message
    $('.chat-input').submit(function(event) {
        event.preventDefault();

        var message = $('.chat-input input').val();
        if (message !== '') {
            $.ajax({
                url: "../send_message.php",
                type: "POST",
                data: {
                    receiver_id: receiver_id,
                    message: message
                },
                success: function() {
                    // Clear the message input field
                    $('.chat-input input').val('');

                    // Fetch messages
                    fetchMessages(receiver_id);
                }
            });
        }
    });

    // Fetch messages periodically
    setInterval(function() {
        if (receiver_id !== null) {
            fetchMessages(receiver_id);
        }
    }, 1000);
});

function fetchMessages(receiver_id) {
    $.ajax({
        url: "../fetch_messages.php",
        type: "GET",
        data: {
            receiver_id: receiver_id
        },
        dataType: "json",
        success: function(messages) {
            // Display messages in the chat window
            $('.chat-window').empty();
            for (var i = 0; i < messages.length; i++) {
                var message = messages[i];
                var html = '<div class="message">';
                html += '<div class="message-sender">' + message.sender_name + '</div>';
                html += '<div class="message-text">' + message.message + '</div>';
                html += '</div>';
                $('.chat-window').append(html);
            }
        }
    });
}