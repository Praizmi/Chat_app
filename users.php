<?php
    session_start();
    if(!isset($_SESSION['matNo'])){
        header("location: login");
    }
    include("inc/header.php");
    //include("inc/auth.php");
?>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php
                include("inc/config.php");
                $result = mysqli_query($conn, "SELECT * FROM users WHERE matNo = {$_SESSION['matNo']}");
                if(!$result){
                    echo mysqli_error($conn);
                }
                if(mysqli_num_rows($result) > 0){
                    $userData = mysqli_fetch_array($result);
                }
                ?>
                <div class="content">
                    <img src="https://127.0.0.1/chat_org/chatting_app/img/<?php echo $userData['image'];?>.jpg" alt="">
                    <div class="details">
                        <span><?php echo $userData['lName']." ".$userData['fName'];?></span>
                        <p><?php echo $userData['onlStatus']; ?></p>
                    </div>
                </div>
                <a href="inc/logout.php?logout_id=<?php echo $userData['matNo']; ?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select a user and start chatting</span>
                <input type="text" placeholder="Enter name to search">
                <button><i class="fa fa-search"></i></button>
            </div>
            <div class="user-list">

            </div>
        </section>
    </div>

    <script src="javascript/users.js"></script>

</body>

</html>