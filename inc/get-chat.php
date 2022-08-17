<?php 
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
    session_start();
    if(isset($_SESSION['matNo'])){
        include("config.php");
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";

        if(isset($_POST))
        
            $query = "SELECT * FROM messages
                        LEFT JOIN users ON users.matNo = messages.incoming_msg_id
                        WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id={$incoming_id})
                        OR  (outgoing_msg_id = {$incoming_id} AND incoming_msg_id={$outgoing_id}) ORDER BY msgId";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0){
                while($userData = mysqli_fetch_assoc($result)){
                $dec = decryptthis($userData['msg'], $key);
                if($userData['incoming_msg_id'] == $incoming_id){ //if this works then he is a message sender
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $dec .'<p>
                                </div>
                                </div>';
                }
                elseif($userData['outgoing_msg_id'] !== $outgoing_id){//he is a message reciever
                    $output .= '<div class="chat incoming">
                    <img src="https://127.0.0.1/chat_org/chatting_app/img/'.$userData['image'].'" alt="">
                    <div class="details">
                        <p>'. $dec .'</p>
                    </div>
                    </div>';
    }
            }
            echo $output;
        }
    }else{
        header("../login.php");
    }
?>