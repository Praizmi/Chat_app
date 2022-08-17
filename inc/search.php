<?php 
    session_start();
    include("config.php");
    $outgoing_id = $_SESSION['matNo'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $output = "";
    $userCheck = mysqli_query($conn, "SELECT * FROM users WHERE NOT matNo ='$outgoing_id' AND (fName LIKE '%{$searchTerm}%'  OR lName LIKE '%{$searchTerm}%')");
    if(mysqli_num_rows($userCheck) > 0){
        include("data.php");
    }else{
        $output .= "No user found related to your search term";
    }
    echo $output;
?>