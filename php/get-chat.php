<?php

session_start();
include_once 'config.php';

// Check if the user is logged in
if (isset($_SESSION['unique_id'])) {

    // Sanitize incoming data
    $incoming_id = mysqli_real_escape_string($conn,$_POST['incoming_id']);
    $outgoing_id = mysqli_real_escape_string($conn,$_POST['outgoing_id']);
    
    
    $incoming_id = intval($incoming_id);
    $outgoing_id = intval($outgoing_id);

    // Initialize output
    $output = "";
      $sql = "SELECT * FROM messages 
                LEFT JOIN users ON users.unique_id = messages.incoming_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR   (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
      $result = mysqli_query($conn,$sql);

     if($result){
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
               
               if($row['outgoing_msg_id'] == $outgoing_id){
                   $output.= '<div class="outgoing">
                   <div class="details">
                   <p>'.$row['message'] .'</p>
                   </div>
                   </div>';
                }else{
                    $output.= '<div class="incoming">
                    <div class="details">
                        <img src="./user_images/'.$row['img'].'" alt="">      
                        <p style="width:100%;">'.$row['message'] .'</p>
                    </div>
                    </div>';
                     
                }
            }
            echo $output;
        }
     }else{
        echo "connection failed";
     }
}