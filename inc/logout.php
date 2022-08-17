<?php
    session_start();
    if(isset($_SESSION['matNo'])){
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){
            $status = "Offline now";
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE matNo={$_GET['logout_id']}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../login");
            }
        }else{
            header("location: ../users");
        }
    }else{
        header("location: ../login");
    }
?>