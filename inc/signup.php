<?php
    session_start();
    include_once "config.php";
    $fName = stripslashes(trim(mysqli_real_escape_string($conn, $_POST['fName'])));
    $lName = stripslashes(trim(mysqli_real_escape_string($conn, $_POST['lName'])));
    $school = stripslashes(trim(mysqli_real_escape_string($conn, $_POST['school'])));
    $matNo = stripslashes(trim(mysqli_real_escape_string($conn, $_POST['matNo'])));
    $department = stripslashes(trim(mysqli_real_escape_string($conn, $_POST['department'])));
    $phoneNo = stripslashes(trim(mysqli_real_escape_string($conn, $_POST['phoneNo'])));
    $role = stripslashes(trim(mysqli_real_escape_string($conn, $_POST['role'])));
    $gender = stripslashes(trim(mysqli_real_escape_string($conn, $_POST['gender'])));
    $email = stripslashes(trim(mysqli_real_escape_string($conn, $_POST['email'])));
    $password = stripslashes(trim(mysqli_real_escape_string($conn, $_POST['password'])));

    if(!empty($fName) && !empty($lName) && !empty($email) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $query = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if(mysqli_num_rows($query) > 0){// to check if email already exists
                echo "$email - This email already exist!!";
            }
            else{
                //lets check user upload file or not
                if(isset($_FILES['image'])){
                    //if file is upload
                    $img_name = $_FILES['image']['name'];//getting usr uploaded img name
                    $tmp_name = $_FILES['image']['tmp_name'];//this temporary name is used to save/move files in our folder

                    //explode image and get the last extension like jpg, png
                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode); //here we get the extension of an  user uploaded img file

                    $extensions = ['png', 'jpeg', 'jpg']; //these are the extensions
                    if(in_array($img_ext, $extensions) === true ){ //if user uploaded img ext is matched with any array extensions
                        $time = time();// current time

                        //let's move the user uploaded img to our particular folder
                        $currUserImage = $time.$img_name;
                        if (move_uploaded_file($tmp_name, "../img/".$currUserImage)) {
                            $onlStatus = "Active now";

                            //inserting user data
                            $query = mysqli_query($conn, "INSERT INTO users (fName,lName,school,matNo,department,email,role,gender,phoneNo,password,image,dateAdded,onlStatus)
                                                    VALUES ('$fName', '$lName','$school','$matNo','$department','$email','$role','$gender','$phoneNo','$password','$currUserImage',NOW(),'$onlStatus')");
                                                    if(!$query){
                                                        echo mysqli_error($conn);
                                                     }
                            if($query){
                                $result= mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' OR matNo='$matNo'");
                                $rowNum = mysqli_num_rows($result);

                                if($rowNum > 0){
                                    $row = mysqli_fetch_assoc($result);
                                    $_SESSION['email'] = $row['email'];
                                    $_SESSION['matNo'] = $row['matNo'];
                                    $_SESSION['school'] = $row['school'];
                                    // $userData = mysqli_fetch_array($result);
                                    // $userId = $userData['id'];
                                    // $email = $userData['email'];
                                    // $matNo = $userData['matNo'];
                                    // $status = $userData['status'];
                                    echo "success";
                                }
                            }else{
                                echo "something went wrong";
                            }
                        }
                    }else{
                        echo "Please select an Image file- .jpg, .jpeg, .png!";
                    }

                }else{
                    echo "Please select an Image file";
                }
            }
        }else{
            echo "$email - This is not a valid email";
        }
    }
    else{
        echo "All input fields are required!";
    }
?>
