<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="vieuwport" 
    content="with=device-widht, initial-scale=1.0">

    <link rel="icon" href="icons/logozwartsite.png">
    <title>Euphoriax</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/basics.css">
    <link rel="stylesheet" href="css/covers.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/account.css">

    <script src="js/script.js" defer></script>
    <script src="js/sidemenu.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" 
    rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
</head>
<body>


    <div class=login>
        <div class="zijkantfotoaccount">

            <img src="image/sideimage.png" alt="">

            <div class="tekst-box-tussen" id="accounttekst" style="text-align: left;">
                <h1>LOGIN TO YOUR ACCOUNT</h1>
                <p> You have the option to log into your account by clicking here. However, if you choose not to log in at this time, you can simply return to the homepage.</p>
                <a href="/Euphoriax/index.html" class="hero-btn-tussen" style="margin-left: 3px;">GO BACK TO HOME</a>
            </div>

        </div>

        <div class="tektbox_loginreg">


                <form action="/Euphoriax/php/login.php" method="post" class="invulkaders">
                    <img src="image/logozwart.png">
                    <h1>MY ACCOUNT</h1>                           
                    <div class="form-group">
                        <p>Email Address</p>
                        <input type="email" placeholder="Enter Email:" name="email" class="form-control" >
                    </div>
                    <div class="form-group">
                        <p>Password</p>
                        <input type="password" placeholder="Enter Password:" name="password" class="form-control">
                        
                        <?php
                        if (isset($_POST["login"])) {
                            $email = $_POST["email"];
                            $password = $_POST["password"];
                            
                            // Controleer of zowel e-mail als wachtwoord zijn ingevuld
                            if (empty($email) || empty($password)) {
                                echo "<div class='alert alert-danger'>All fields are required</div>";
                            } else {
                                require_once "database.php";
                                $sql = "SELECT * FROM users WHERE email = '$email'";
                                $result = mysqli_query($conn, $sql);
                                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                
                                if ($user) {
                                    if (password_verify($password, $user["password"])) {
                                        session_start();
                                        $_SESSION["user_id"] = $user["id"];
                                        $_SESSION["user"] = "yes";
                                        header("Location: /Euphoriax/php/index.php");
                                        die();
                
                                    } else {
                                        echo "<div class='alert alert-danger'>Wrong email or password</div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger'>Wrong email or password</div>";
                                }
                            }
                        }
                        ?>

                    </div>
                    <div class="form-btn">
                        <input type="submit" value="LOGIN" name="login" class="btn btn-primary">
                    </div>
                    <div class="GoToSignup"><p><a href="/Euphoriax/php/signup.php">Sign Up</a></p></div>

                </form>
        </div>

    </div>
</body>
</html>