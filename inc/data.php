    <?php
    //include('kyc.php');
    
    // function encryptthis($data, $key)
    // {
    //     $encryption_key = base64_decode($key);
    //     $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    //     $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    //     return base64_encode($encrypted. '::'. $iv);
    // }

    function decryptthis($data, $key)
    {
        $encryption_key = base64_decode($key);
        list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2), 2, null);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }
    $key = '110811qrr9n5%$$jdnfdosnn^%zkzhO';
    
    // $enc = encryptthis($message, $key);
    // $dec = decryptthis($enc, $key);

    while($userData = mysqli_fetch_assoc($userCheck)){
        $query ="SELECT * FROM messages WHERE (incoming_msg_id = {$userData['matNo']}
                    OR outgoing_msg_id = {$userData['matNo']}) AND (outgoing_msg_id = {$outgoing_id}
                    OR incoming_msg_id = {$outgoing_id}) ORDER BY msgId DESC LIMIT 1";
        $query2 = mysqli_query($conn, $query);
        $row2 = mysqli_fetch_assoc($query2);
/////////////////////////////////////////
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";

        (strlen($result) > 28) ? $dec =  substr($result, 0, 28) . '...' : $dec = $result;

        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
///////////////////////////////////////
        ($userData['onlStatus'] == "Offline now") ? $offline = "offline" : $offline = "";

        ($outgoing_id == $userData['matNo']) ? $hid_me = "hide" : $hid_me = "";
        
$decryptMessage = decryptthis($row2['msg']?? '', $key) ;
        $output .= '
        <a href="chat?user_matNo='.$userData['matNo'].'">
            <div class="content">
                <img src="https://127.0.0.1/chat_org/chatting_app/img/' .$userData['image'] . '" alt="">
                    <div class="details">
                        <span>'. $userData['fName'] . " " . $userData['lName'] .'</span>
                        <p>'. $you . $decryptMessage .'</p>
                    </div>
                </div>
            <div class="status-dot '.$offline.'"><i class="fa fa-circle"></i>  </div>
        </a>';
    }
?>