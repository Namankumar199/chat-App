<?php
session_start();
include_once 'config.php';

$outgoing_id =$_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ");

$output ='';
   
    if(mysqli_num_rows($sql) == 1){  // if email allready exists
         $output .= "<h2 style='text-align:center;margin-top:2rem;'>No users are available to chat</h2>";       
    }elseif(mysqli_num_rows($sql) > 0){
    include_once 'data.php';   
    }
        
    echo $output;
?>