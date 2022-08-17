<?php
    session_start();
    if(isset($_SESSION['matNo'])){
        include("config.php");
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $key = '110811qrr9n5%$$jdnfdosnn^%zkzhO';

        function encryptthis($data, $key){
            $encryption_key = base64_decode($key);
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
            $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
            return base64_encode($encrypted. '::'. $iv);
        }

        function decryptthis($data, $key){
            $encryption_key = base64_decode($key);
            list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data),2),2,null);
            return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
        }


        $enc = encryptthis($message, $key);
    if(!empty($message)){
        $query = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, dateAdded) VALUES('$incoming_id','$outgoing_id', '$enc', NOW() )") or die();
    }
    }else{
        header("../login.php");
    }
?>