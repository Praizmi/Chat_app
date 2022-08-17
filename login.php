<?php
    include("inc/header.php");
    include("inc/config.php");
    
?>
<body>
    <div class="wrapper">
    <?php include("inc/alerts.php"); ?>
        <section class="form login">
            <header>UNITY Chat</header>
            <form action="#" autocomplete="off">
                <div class="error-txt"></div>
                <div class="field input">
                    <label>Email Address </label>
                    <input type="text" name="email" placeholder="Enter your email or Matric Number">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password">
                    <i class="fa fa-eye" ></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to chat">
                </div>
            </form>
            <div class="link">Don't have an account?<a href="signup">Sign up</a></div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>

</body>

</html>
