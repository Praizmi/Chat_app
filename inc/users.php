<?php
    session_start();
    include("config.php");
    $outgoing_id = $_SESSION['matNo'];
    $schoolSessID = $_SESSION['school'];
    $userCheck = mysqli_query($conn, "SELECT * FROM users WHERE (NOT matNo ='$outgoing_id' AND school = {$schoolSessID}) ");
    $output = "";
    $result = mysqli_num_rows($userCheck);
    if($result == 1){
        $output .= "No users are available to chat";
    }
    elseif($result > 0){
        include("data.php");
    }
    echo $output;

?>