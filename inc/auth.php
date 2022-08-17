<?php
session_start();

if(!isset($_SESSION['chatUser'])){
    $_SESSION['msg'] = "Access denied, you must login to view that page";
    header("Location: login");
    exit();
}
else if(isset($_SESSION['chatUser'])){
    if($_SESSION['chatUser'] != ""){
        $currUserId = $_SESSION['chatUser'];
        
        $query = mysqli_query($conn, "SELECT users.matNo, users.fName, users.lName, users.email, users.phoneNo, users.status, users.image, users.dateAdded, users.dateUpdated, genders.name AS gender, user_roles.name AS role FROM users LEFT JOIN user_roles ON users.role=user_roles.id LEFT JOIN genders ON users.gender=genders.id WHERE users.id=$currUserId");
        if(!$query){
            echo mysqli_error($conn);
         }
        $userData = mysqli_fetch_array($query);
        
        $currUserNo = $userData['matNo'];
        $currFullName = $userData['lName']." ".$userData['fName'];
        $currUserFName = $userData['fName'];
        $currUserLName = $userData['lName'];
        $currUserEmail = $userData['email'];
        $currUserPhone = $userData['phoneNo'];
        $currUserStatus = $userData['status'];
        $currUserRole = $userData['role'];
        $currUserImage = $userData['image'];
        $currUserDA = date("F d, Y - H:i",strtotime($userData['dateAdded']));
        $currUserDU = date("F d, Y - H:ia",strtotime($userData['dateUpdated']));
        $currUserNullDU = $userData['dateUpdated'];
        
    }
    else{
        $_SESSION['msg'] = "Access denied, you must login to view that page";
        header("Location: login");
        exit();
    }
}
else{
    
}

?>
