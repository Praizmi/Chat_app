<?php
    $mainURL = "https://127.0.0.1/CHAT_ORG/chatting_app/";
    $imgURL = "https://127.0.0.1/chat_org/chatting_app/img";

    $conn = mysqli_connect("localhost", "root", "", "chat");
    if(!$conn){
        echo "Database disconnected" . mysqli_connect_error();
    }
?>
