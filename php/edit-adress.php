<?php
session_start();
if (isset($_SESSION["user"])) {
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
        $firstname = $_POST["firstname"];
        $name = $_POST["name"];
        $city = $_POST["city"];
        $country = $_POST["country"];

        $AllFieldsError = "";
        $NameError = "";
        $AdressMatchError = "";
        $AdressError = "";

        if (empty($fullName)) {
            $AllFieldsError = "This field is required";
        }
        if (strlen($password) < 8) {
            $NameError = "NameError";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $AdressMatchError = "AdressMatchError";
        }
        if ($password !== $passwordRepeat) {
            $AdressError = "AdressError";
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
                $sql = "INSERT INTO users (firstname, name, city, country) VALUES (?, ?, ?)";
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
                    <h1>SECURE SPONSORSHIP</h1>
                    <p> Are you actively involved in fitness, nutrition, and related activities on a 
                        daily <br> basis and interested in sponsorship opportunities? This is your chance!</p>
                    <a href="/Euphoriax/index.html" class="hero-btn-tussen" style="margin-left: 3px;">GET SPONSORED</a>
                </div>

            </div>

            <div class="tektbox_loginreg">                    
                <form action="/Euphoriax/php/signup.php" method="post" class="invulkaders">

                    <img src="image/logozwart.png">
                    <h1>ADD YOUR ADDRESS</h1> 

                    <div class="form-group">
                        <p>First Name</p>
                        <input type="text" class="form-control" name="firstname" placeholder="First Name:">
                        <?php
                        if (isset($AllFieldsError)) {
                            echo "<div class='alert alert-danger'>$AllFieldsError</div>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <p>Name</p>
                        <input type="text" class="form-control" name="name" placeholder="Name:">
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
                        <p>Address</p>
                        <input type="address" class="form-control" name="address" placeholder="Address:">
                        <?php
                        if (isset($PasswordError)) {
                            echo "<div class='alert alert-danger'>$PasswordError</div>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <p>Country</p>
                        <input type="option" class="form-control" name="country" placeholder="Country:">
                        <?php
                        if (isset($PasswordMatchError)) {
                            echo "<div class='alert alert-danger'>$PasswordMatchError</div>";
                        }
                        ?>
                    </div>
                    <div class="form-btn">
                        <input type="submit" class="btn btn-primary" value="ADD ADDRESS" name="submit">
                    </div>
                </form>
                
            <div>
        </div>
    </div>

    
</body>
</html>