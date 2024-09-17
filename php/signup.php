<?php
session_start();
include_once 'config.php';

$fname = mysqli_real_escape_string($conn, $_POST['fname']);  // Prevent sql injection.
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password) )
    {
        //  check user email is valid or not
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            // check email allready exits or not
            $sql1 = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
           
            if(mysqli_num_rows($sql1) > 0){  // if email allready exists
                echo "$email - This email is allready exist!";
            }else{
                // let's check user upload file or not
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name']; // getting user upload img name
                    $tmp_name = $_FILES['image']['tmp_name'];  // this temporary name is used to save/move file in our folder
                    
                    // let's explode image and get the last extensions likg jpeg, png
                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode); // getting last extension of image
                    
                    $extensions = ['jpeg','png','jpg']; //these are valid img ext and we've store them in array
                    if(in_array($img_ext, $extensions) === true){ // if user uploaded img ext is matched with any array extensions

                        $time = time();
                        $new_img_name  = $time.$img_name;
                        $upload_dir = "../user_images/";

                        if(move_uploaded_file($tmp_name, $upload_dir . $new_img_name)){
                            $status = "Active now";
                            $random_id = rand(time(),10000000);
                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                            
                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                                 VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$hashedPassword}', '{$new_img_name}', '{$status}')");

                     if($sql2){    
                        $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                        if(mysqli_num_rows($sql3) > 0){  // if email allready exists
                           $row = mysqli_fetch_assoc($sql3);
                           $_SESSION['unique_id'] = $row['unique_id']; 
                         echo "Success";
                        }
                     }else{
                        echo "Something went wrong!";
                     }
                    }

                    }else{
                        echo 'Please select an Image file - jpeg, jpg, png!';          
                    }
                    
                }else{
                    echo 'Please select an Image file!';
                }
            }

        }else{
             echo "$email - This is not a valid email!";
        }

  }
  else
  {
    echo 'All input fields are required!';
  }
?>