<?php
    session_start();
    include_once "config.php";
    //$matNo = stripslashes(trim(mysqli_real_escape_string($conn, $_POST['matNo'])));
    $email = stripslashes(trim(mysqli_real_escape_string($conn, $_POST['email'])));
    $password = stripslashes(trim(mysqli_real_escape_string($conn, $_POST['password'])));

    //$cryptedPwd = md5($password);
    if(!empty($email) && !empty($password)){
        $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
        if(mysqli_num_rows($query) > 0){ //if users credentials matched
            $row = mysqli_fetch_assoc($query);
            //$_SESSION['email'] = $row['email'];
            $_SESSION['matNo'] = $row['matNo'];
            $_SESSION['school'] = $row['school'];
            echo "success";
            "Location: https://127.0.0.1/chat_org/chatting_app/users";

        }else{
            echo "Email or Password is incorrect!";
        }
    }else{
        echo "All input fields are required";
    }
