<?php
while($row = mysqli_fetch_assoc($sql)){

      $sql2= "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
        OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id}
        OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC limit 1";
        
        $query2=mysqli_query($conn,$sql2);
        $row2= mysqli_fetch_assoc($query2);

         if(mysqli_num_rows($query2) > 0){
            $result = $row2['message'];
         }  else{
            $result="No message available ";
         }  
            
      //    trimming message if it's more than 28 characters long
         (strlen($result) > 28) ? $msg = substr($result, 0, 28).'...' : $msg = $result;
       //  adding you: text before msg if login id send msg
         
      if (isset($row2) && is_array($row2) && isset($row2['outgoing_msg_id'])) {
            $you = ($outgoing_id == $row2['outgoing_msg_id']) ? "You: " : "";
        } else {
            // Handle the case where $row2 is not set, not an array, or missing 'outgoing_msg_id'
            $you = "";
        }
      //   ($row['status'] == "Offline now") ? $offline = "Offline now" : $offline = "";
      //   $status =$offline;
        
        $output .= '  
        <a href="chat.php?user_id='.$row['unique_id'].'" style="color:#000;" class="fields" target=_blank>
                
                <div class="user-profile">
                      <img src="./user_images/'.$row['img'].'" alt="">
                      <p class="user-name" style="text-align:left;"><strong style="font-weight:600;color:green;"> '.$row['fname']." ".$row['lname'].'</strong>
                      <i class="text"> '. '<span style="color:blue;">'.$you .'</span>'. $msg . ' </i>
                      </p>
                      </div>      
                   ' . ($row['status'] == "Offline now" ? '<div class="offline-icon"></div>' : '<div class="active-icon"></div>') . '                
                </a>
                ';               
            }
   ?>