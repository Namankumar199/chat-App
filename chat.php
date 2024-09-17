
<?php  
session_start();
if(!isset($_SESSION['unique_id'])){
    header("Location: ./login.php");
}
else
{
    include_once './php/config.php';

    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);  // Prevent sql injection.

    $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE  unique_id = {$user_id}");
    if(mysqli_num_rows($sql1) > 0){  
        $row = mysqli_fetch_assoc($sql1);
    }
}
?>  

<?php  include_once 'header.php'; ?>  

<body>
    <div class="container">
        <div class="wrapper">
        <?php include_once 'shape.php'; ?>      

            <div class="chat-container message">  
               <header class="header message">
                    <a href="users.php"><i class="fa-solid fa-arrow-left"></i></a>
                    <div class="user-profile">
                    <img src="./user_images/<?php echo $row['img'] ?>" alt="user-image">
                    <p>
                        <?php echo $row['fname'] ." ". $row['lname']?> 
                        <span> <?php  echo $row['status'] ?></span>
                    </p>    
                </div>
                </header>

                <div class="message-list" id="message-list">
            
               </div>

                <form class="message-send-form"  id="message-send-form">
                    <input type="text" name="incoming_id" value="<?php echo $user_id ?>" hidden>
                    <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id'] ?>" hidden>
                    <input type="text" name="message-input" id="message-input" placeholder="Type a message here...">
                    <button id="message-button" name="messageSend">
                         <i class="fa-regular fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>

    <script src="./js/chat.js"></script>
</body>

</html>