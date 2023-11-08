<?php
    include("inc/header.php");
?>

<body>
    <?php include("inc/config.php") ?>
    <div class="wrapper">
        <?php include("inc/alerts.php"); ?>
        <section class="form signup">
            <header>UNITY Chat</header>
            <form action="#">
                <div class="error-txt">This is an error message!</div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fName" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lName" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="field input">
                    <label>Matric Number</label>
                    <input type="text" name="matNo" placeholder="Enter your Matric Number eg 01801024" required>
                </div>
                <div class="field input">
                    <label>Phone Number</label>
                    <input type="text" name="phoneNo" placeholder="Enter your Phone Number" required>
                </div>
                <div class="field input">
                    <label for="">Department</label>
                    <select class="form-select" name="department" aria-label="Department">
                        <option value=""> -- select --</option>
                        <?php
                            $query = mysqli_query($conn, "SELECT * FROM departments");
                            while($row = mysqli_fetch_array($query)){
                            $id = $row['id'];
                            $name = $row['name'];
                            ?>
                        <option
                            <?php if(isset($_POST['department']) && $_POST['department'] == $id){ echo "selected"; } ?>
                            value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger"><?php if(isset($departmentErr)){ echo $departmentErr; } ?></span>
                </div>
                <div class="field input">
                    <label for="">Schools</label>
                    <select class="form-select" name="school" aria-label="School">
                        <option value=""> -- select --</option>
                        <?php
                            $query = mysqli_query($conn, "SELECT * FROM schools");
                            while($row = mysqli_fetch_array($query)){
                            $id = $row['id'];
                            $name = $row['name'];
                            ?>
                        <option <?php if(isset($_POST['school']) && $_POST['school'] == $id){ echo "selected"; } ?>
                            value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger"><?php if(isset($schoolErr)){ echo $schoolErr; } ?></span>
                </div>
                <div class="field input">
                    <label for="">Gender</label>
                    <select class="form-select" name="gender" aria-label="Gender">
                        <option value=""> -- select --</option>
                        <?php
                            $query = mysqli_query($conn, "SELECT * FROM genders");
                            while($row = mysqli_fetch_array($query)){
                            $id = $row['id'];
                            $name = $row['name'];
                            ?>
                        <option <?php if(isset($_POST['gender']) && $_POST['gender'] == $id){ echo "selected"; } ?>
                            value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger"><?php if(isset($genderErr)){ echo $genderErr; } ?></span>
                </div>
                <div class="field input">
                    <label for="">Role</label>
                    <select class="form-select" name="role" aria-label="Role">
                        <option value=""> -- select --</option>
                        <?php
                            $query = mysqli_query($conn, "SELECT * FROM roles");
                            while($row = mysqli_fetch_array($query)){
                            $id = $row['id'];
                            $name = $row['name'];
                            ?>
                        <option <?php if(isset($_POST['role']) && $_POST['role'] == $id){ echo "selected"; } ?>
                            value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger"><?php if(isset($roleErr)){ echo $roleErr; } ?></span>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                    <i class="fa fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Select Image</label>
                    <input type="file" name="image" required>
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to chat">
                </div>
            </form>
            <div class="link">Already signed up?<a href="login">Login Now</a></div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>
</body>

</html>