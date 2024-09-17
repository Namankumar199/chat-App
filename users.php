<?php  
session_start();
if(!isset($_SESSION['unique_id'])){
    header("Location: ./login.php");
}
else
{
    include_once './php/config.php';
    $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE  unique_id = '$_SESSION[unique_id]'");
    if(mysqli_num_rows($sql1) > 0){  // if email allready exists
        $row = mysqli_fetch_assoc($sql1);
    }
}
?>  

<?php  include_once 'header.php'; ?>  

<body>
    <div class="container">
        <div class="wrapper">
        <?php include_once 'shape.php'; ?>      
            <div class="chat-container" style="height:600px">
                <header class="header user">
                    <div class="user-profile">
                        <img src="./user_images/<?php echo $row['img'] ?>" alt="">
                        <p>
                            <?php echo $row['fname'] ." ". $row['lname']?> 
                            <span> <?php  echo $row['status'] ?></span>
                        </p>
                    </div>
                    <a href="./php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" id='logout_btn'> Logout </a>
                </header>
                <div class="search-box">
                    <input id="user-search-input" type="text" placeholder="Enter name to search...">
                    <button id="user-search-button"> <i class="fa-solid fa-magnifying-glass"></i> </button>
                </div>

                <div class="users-list" id="user-list">
                        <!-- All users  -->
                </div>
            </div>
        </div>
    </div>
    <script src="./js/users.js"></script>
</body>

</html>