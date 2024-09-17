<?php
session_start();
include_once 'config.php';

if (isset($_POST['searchTerm'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $output = '';
    
$outgoing_id =$_SESSION['unique_id'];

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')");
   
    if(mysqli_num_rows($sql) > 0){
    include_once 'data.php';
    }else{
        $output .= "<h2 style='text-align:center;margin-top:2rem;color:#fff;'> No users found..</h2>";       
    }
    echo $output;
}
