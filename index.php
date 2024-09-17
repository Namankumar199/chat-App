<?php
session_start();
if(isset($_SESSION['unique_id'])){  // if user is logged in
    header("location: users.php");
}
?>

<?php  include_once 'header.php'; ?>  
<body>
    <div class="container">
        <div class="wrapper">
        <?php include_once 'shape.php'; ?>    
            <div class="chat-container">
                <header class="header">
                    <h1>Realtime Chat App</h1>
                </header>
                <div class="signup-form">
                    <form id="form" enctype="multipart/form-data">
                        <div class="error-msg"> hello fromerror </div>
                        <div class="fields name">
                            <div class="fields">
                                <label for="fname">First Name</label>
                                <input type="text" id="fname" name="fname" placeholder="First Name">
                            </div>
                            <div class="fields">
                                <label for="lname">Last Name</label>
                                <input type="text" id="lname" name="lname" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="fields">
                            <label for="email">Email Address</label>
                            <input type="text" id="email" name="email" placeholder="Enter your email">
                        </div>
                        <div class="fields password-field">
                            <label for="password">Password</label>
                            <div class="password-div">
                                <input type="password" id="password" name="password" placeholder="Enter new password">
                                <img src="images/eye-close.png" id="password-img" alt="password">
                            </div>
                        </div>
                        <div class="fields image">
                            <label for="image">Select Image</label>
                            <input type="file" id="image" name="image">
                        </div>
                        <div class="fields">
                            <button type="submit" id="submit" name="submit">Continue to Chat</button>
                        </div>
                        <div class="fields">
                            <p>Already signed up? <a href="login.php">Login now</a></p>
                        </div>
                    </form>
                </div>


            </div>
        </div>

    </div>

<ul class="circles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>

    <script src="./js/pass-show-hide.js"></script>
    <script src="./js/signup.js"></script>

</body>

</html>