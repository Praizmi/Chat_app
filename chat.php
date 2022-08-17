<?php
    session_start();
    if(!isset($_SESSION['matNo'])){
        header("location: login");
    }
?>
<?php
include("inc/header.php");
include("inc/meta.php"); ?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                include("inc/config.php");
                $user_matNo = mysqli_real_escape_string($conn, $_GET['user_matNo']);
                $result = mysqli_query($conn, "SELECT * FROM users WHERE matNo = {$user_matNo}");
                /* if(!$result){
                     echo mysqli_error($conn);}*/
                if(mysqli_num_rows($result) > 0){
                    $userData = mysqli_fetch_array($result);
                }
                ?>

                <a href="users" class="back-icon"><i class="fa fa-arrow-left"></i></a>
                <img src="https://127.0.0.1/chat_org/chatting_app/img/<?php echo $userData['image']; ?>" alt="">
                <div class="details">
                    <span><?php echo $userData['fName']." ".$userData['lName'];?></span>
                    <p><?php echo $userData['onlStatus']; ?></p>
                </div>
            </header>
            <div class="chat-box">

            </div>
                <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['matNo']; ?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_matNo; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type your message here..">
                <button><i class="fa fa-plane"></i></button>
                </form>
        </section>
    </div>

    <script src="javascript/chat.js"></script>

</body>

</html>
