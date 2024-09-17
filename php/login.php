<?php
session_start();
include_once 'config.php';

$email = mysqli_real_escape_string($conn, $_POST['email']);        // prevent sql injection
$password = mysqli_real_escape_string($conn, $_POST['password']);

$status = "Active now";
if(!empty($email) && !empty($password)){
 
    $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");              
   
    
    if(mysqli_num_rows($sql1) > 0){  // if email allready exists
        $row = mysqli_fetch_assoc($sql1);
        $hashed_password = $row['password'];
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['unique_id'] = $row['unique_id']; 
            $sql2 = mysqli_query($conn,"UPDATE users  SET status = '{$status}' WHERE unique_id = '{$_SESSION['unique_id']}'");
            echo "Success";             
        } else {
            echo "Incorrect password.";
        }
       
    }else{
        echo "Email doesn't exists!";
    }

}else{
    echo 'Please Enter EmailId and Password';
}


?>