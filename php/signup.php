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


    <div class="tekstbox_loginreg">
    <?php
    if (isset($_POST["submit"])) {
        $fullName = $_POST["fullname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["repeat_password"];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $AllFieldsError = "";
        $PasswordError = "";
        $EmailError = "";
        $PasswordMatchError = "";
        $EmailErrorExist = "";

        if (empty($fullName)) {
            $AllFieldsError = "This field is required";
        }
        if (strlen($password) < 8) {
            $PasswordError = "Password must be at least 8 characters long";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $EmailError = "Email is not valid";
        }
        if ($password !== $passwordRepeat) {
            $PasswordMatchError = "Passwords do not match";
        }

        require_once "database.php";
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);

        if (!empty($AllFieldsError) || !empty($PasswordError) || !empty($EmailError) || !empty($PasswordMatchError)) {
            // Handle any validation errors here
        } else {
            if ($rowCount > 0) {
                $EmailErrorExist = "This email is already in use";
            } else {
                $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);

                    // Data saved successfully, redirect to login.php
                    header("Location: /Euphoriax/php/login.php");
                    exit; // Make sure to exit to prevent further execution
                } else {
                    die("Something went wrong");
                }
            }
        }
    }
    ?>




        <div class=login>
            <div class="zijkantfotoaccount">

                <img src="image/sideimage.png" alt="">

                <div class="tekst-box-tussen" id="accounttekst" style="text-align: left;">
                    <h1>MAKE YOUR ACCOUNT</h1>
                    <p> 
                    Here, you can create your account by providing some personal details, granting you 
                    access to packaging status updates, exclusive 
                    deals, and more. If you already have an existing account, just log in.</p>
                    <a href="/Euphoriax/index.html" class="hero-btn-tussen" style="margin-left: 3px;">GO BACK TO HOME</a>
                </div>

            </div>

            <div class="tektbox_loginreg">                    
                <form action="/Euphoriax/php/signup.php" method="post" class="invulkaders">

                    <img src="image/logozwart.png">
                    <h1>GET YOUR ACCOUNT</h1> 

                    <div class="form-group">
                        <p>User Name</p>
                        <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
                        <?php
                        if (isset($AllFieldsError)) {
                            echo "<div class='alert alert-danger'>$AllFieldsError</div>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <p>Email Addres</p>
                        <input type="email" class="form-control" name="email" placeholder="Email:">
                        <?php
                        if (isset($EmailError)) {
                            echo "<div class='alert alert-danger'>$EmailError</div>";
                        }
                        if (isset($EmailErrorExist)) {
                            echo "<div class='alert alert-danger'>$EmailErrorExist</div>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <p>Password</p>
                        <input type="password" class="form-control" name="password" placeholder="Password:">
                        <?php
                        if (isset($PasswordError)) {
                            echo "<div class='alert alert-danger'>$PasswordError</div>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <p>Repeat Password</p>
                        <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
                        <?php
                        if (isset($PasswordMatchError)) {
                            echo "<div class='alert alert-danger'>$PasswordMatchError</div>";
                        }
                        ?>
                    </div>
                    <div class="form-btn">
                        <input type="submit" class="btn btn-primary" value="SIGN UP" name="submit">
                    </div>
                    <div class="GoToSignup"><p><a href="/Euphoriax/php/login.php">Login</a></p></div>
                </form>
                
            <div>
        </div>
    </div>

    
</body>
</html>