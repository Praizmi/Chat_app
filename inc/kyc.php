<?php
        include("config.php");

        $query = "SELECT * FROM messages";
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $key = '110811qrr9n5%$$jdnfdosnn^%zkzhO';

        function encryptthis($data, $key)
        {
            $encryption_key = base64_decode($key);
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
            $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
            return base64_encode($encrypted. '::'. $iv);
        }

        function decryptthis($data, $key)
        {
            $encryption_key = base64_decode($key);
            list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2), 2, null);
            return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
        }
        
        $enc = encryptthis($message, $key);
        $dec = decryptthis($enc, $key);
?>