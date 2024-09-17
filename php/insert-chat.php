<?php

session_start();
include_once 'config.php';
if(isset($_SESSION['unique_id'])){
    // if()
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message-input']);

    $incoming_id = intval($incoming_id);
    $outgoing_id = intval($outgoing_id);
    
    if(!empty($message)){
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, message) 
                                VALUES ({$incoming_id}, {$outgoing_id},'{$message}')");

            if ($sql) {
                echo "Message inserted successfully.";
            } else {
                echo "Error1: " . mysqli_error($conn);
            }

    }else{

        echo "plz input some message";
    }
    
}else{
    header('../login/php');
}


?>