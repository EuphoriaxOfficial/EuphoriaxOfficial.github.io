<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
   exit;
}


$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "login_register";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION["user_id"]; // id connect

$sql1 = "SELECT full_name, email FROM users WHERE id = $id";
$result1 = mysqli_query($conn, $sql1);

$sql2 = "SELECT LEFT(full_name, 2) AS short_name FROM users WHERE id = $id";
$result2 = mysqli_query($conn, $sql2);

if ($result1) {
    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            $full_name = $row['full_name'];
            $email = $row['email'];
        }
    }
} else {
    echo "Query failed: " . mysqli_error($conn);
}


if ($result2) {
    $row = mysqli_fetch_assoc($result2); 
    if ($row) {
        $shortName = $row['short_name']; 
    } else {
        echo "No data found for this ID.";
    }
    mysqli_free_result($result2); 
} else {
    echo "Query failed: " . mysqli_error($conn);
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="vieuwport" 
    content="with=device-widht, initial-scale=1.0">

    <link rel="icon" href="icons/logozwartsite.png">
    <title>Euphoriax</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/topbar.css">
    <link rel="stylesheet" href="css/basics.css">
    <link rel="stylesheet" href="css/covers.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/sidemenu.css">
    <link rel="stylesheet" href="css/indexphp.css">

    <script src="js/script.js" defer></script>
    <script src="js/sidemenu.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" 
    rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
</head>

<body>

    <!---- 3 topbars ----->

    <section>

        <section class="topbarvast">
        <div class="topbar1">

            <div class="teksttopbar1">
                <a href="/Euphoriax/php/login.php">Account</a>
                <a href="/Euphoriax/partner.html">Partner</a>
                <a href="/Euphoriax/support.html">Support</a>
                <a href="/Euphoriax/blog.html">Blog</a>
                <a href="/Euphoriax/company.html">About Us</a>
                <a style="border-right-width: 0px; padding-left: 8px;"><img src="icons/belgie.png" alt=""></a>
            </div>
        </div>

        <div class="topbar2">

            <div class="icons-topbar2" style=" margin-right: 0;">
               <img class="menu-topbar2" src="icons/menu.png" 
               style="padding: 7px; cursor: pointer; opacity: 85%; margin-bottom: 0px;" 
               onclick="showMenu()" id="knop1">
            </div>

            <div class="logo-topbar2">
            <a href="/Euphoriax/index.html"><img src="image/logozwart.png"></a>
            </div>

            <div class="SideMenu" id="SideMenu">

                <div class="topbarvast">
                    <div class="sidemenuhoofd" style="padding-top: 30px; height: 100px;">
                        <a href="/Euphoriax/index.html" id="TitelSub" style="width: auto;">HOME</a>
                        <i class="fa fa-times" onclick="hideMenu()" id="knop2"></i>
                    </div>

                    <div class="sidemenuzoek" style="height: 100px; padding: 40px;
                    padding-top: 20px; padding-bottom: 20px; ">

                            <input class="zoekbar" 
                            style="order: 1; border-radius: 0; border-top-left-radius: 2px; border-bottom-left-radius: 2px; 
                            flex: 1; width: 0; display: block; height: 50px;"
                            id="zoekbar" type="text" placeholder="Search a product">

                            <button class="zoekknop" 
                            style="border-radius: 0; border-top-right-radius: 2px; border-bottom-right-radius: 29x; display: block;
                            height: 50px; width: 50px;" 
                            id="zoekknop">

                            <img src="icons/search.png">
                            </button>
                    </div>
                </div>

                    <div class="tussenfoto" style="margin: 0; margin-top: 200px;">
                        <img src="image/tussenfoto.png" style="height: 310px;">
                
                    </div>

                    
                    <div class="sidemenuhoofd">
                        <a href="/Euphoriax/store.html" id="TitelSub">STORE</a>
                        <img src="icons/slidemenuup.png" onclick="SubOpenClose(this, 'store'); SubiconChange(this)">
                    </div>
                    <div class="sidemenusub closesub" id="store-submenu">
                        <a href="/Euphoriax/store.html#Supplements"> <p>Supplements</p> </a>
                        <a href="/Euphoriax/store.html#Clothing"> <p>Clothing</p> </a>
                        <a href="/Euphoriax/store.html#Upcoming"> <p style="border-bottom: 0" >Upcoming</p> </a>
                    </div>
                
                    <div class="sidemenuhoofd">
                        <a href="/Euphoriax/store.html#Supplements" id="TitelSub">SUPPLEMENTS</a>
                        <img src="icons/slidemenuup.png" onclick="SubOpenClose(this, 'supplements'); SubiconChange(this)">
                    </div>
                    <div class="sidemenusub closesub" id="supplements-submenu">
                        <a href="#"> <p>PreWorkout</p> </a>
                        <a href="#"> <p>Creatine</p> </a>
                        <a href="#"> <p style="border-bottom: 0">Vitamines</p> </a>
                    </div>
                
                    <div class="sidemenuhoofd">
                        <a href="/Euphoriax/drops.html" id="TitelSub">DROPS</a>
                        <img src="icons/slidemenuup.png" onclick="SubOpenClose(this, 'drops'); SubiconChange(this)">
                    </div>
                    <div class="sidemenusub closesub" id="drops-submenu">
                        <a href="#"> <p>Monthly</p> </a>
                        <a href="#"> <p style="border-bottom: 0">Exclusive</p> </a>
                    </div>
                
                    <div class="sidemenuhoofd">
                        <a href="/Euphoriax/more.html" id="TitelSub">MORE</a>
                        <img src="icons/slidemenuup.png" onclick="SubOpenClose(this, 'more'); SubiconChange(this)">
                    </div>
                    <div class="sidemenusub closesub" id="more-submenu">
                        <a href="#"> <p>Monthly Drops</p> </a>
                        <a href="#"> <p>Upcoming Projects</p> </a>
                        <a href="#"> <p>Our App</p> </a>
                    </div>


                    <div class="footerside1">

                    </div>
                    <div class="footerside2">
                            <a href="/Euphoriax/php/index.php">Account</a>
                            <a href="/Euphoriax/partner.html">Partner</a>
                            <a href="/Euphoriax/support.html">Support</a>
                            <a href="/Euphoriax/blog.html">Blog</a>
                            <a href="/Euphoriax/company.html#About-Us">About Us</a>
                            <a style="border-right-width: 0px; padding-left: 8px;"><img src="icons/belgie.png" alt=""></a>
                    </div>
            </div>





            <div class="nav-links" id="navLinks">
                <ul>
                    <li><a href="/Euphoriax/index.html">HOME</a></li>
                    <li><a href="/Euphoriax/store.html">STORE</a></li>
                    <li><a href="/Euphoriax/store.html#Supplements">SUPPLEMENTS</a></li>
                    <li><a href="/Euphoriax/drops.html">DROPS</a></li>
                    <li><a href="/Euphoriax/more.html">MORE</a></li>
                </ul> 
            </div>

            <div class="zoek-container">
                    <input class="zoekbar" id="zoekbar2" type="text" placeholder="Search a product">
                    <button class="zoekknop" id="zoekknop2">
                        <img src="icons/search.png">
                    </button>

            </div>

            <div class="icons-topbar2" style="margin-left: 0px;">
                <a href="/Euphoriax/wishlist.html"><img src="icons/heart.png" style="padding: 3px; padding-bottom: 2px;"></a>
                <a href="/Euphoriax/shoppingcart.html"><img src="icons/shopping-bag.png" style="padding: 5px; padding-bottom: 6px; margin-right: 20px;"></a>
            </div>
                       
        </div>


    </section>

        <div class="topbar3" style="height: 104px;">
            <a href="partner.html" class="teksttopbar3"></a>
        </div>    
    </section>

        <div class="Titel_indexphp">
            <h1>YOUR ACCOUNT</h1>
        </div>

        <div class="InfoOrders_indexphp">
            <div class="columleft_indexphp">
                <div class="Info_indexphp">

                        <h2> <?php echo $shortName; ?> </h2>
                        
                        <div class="text_profile">
                        <div class="Name_text_profile">
                            <?php echo $full_name; ?>
                        </div>
                        <p> 
                            <?php echo  $email; ?>
                        </p>                    
                            <a href="/Euphoriax/php/logout.php" class="btn btn-warning">Log Out</a>
                        </div>
                </div>

                    <div class="adres_indexphp">
                    <h2>YOUR ADDRESS</h2>
                    <p>Rune Vanhoucke</p>
                    <p>Spiekerstraat 25</p>
                    <p>8630 Veurne</p>
                    <p>Belgium</p>
                    <a href="/Euphoriax/php/edit-adress.php" class= "changeadres_indexphp">Edit</a>
                    </div>
                    <div class="foto_indexphp">
                        <img src="image/foto_dashboard.png">
                    </div>
            </div>



            <div class="Orders_indexphp">
                <h2>YOUR ORDERS</h2>
                <div class="YourOrderType">
                    <div class="YourOrderType_text">
                        <h2>ORDER [#136664]</h2>
                        <p>Ordered on [date]</p>
                        <h3>STATUS</h3>
                        <p style="padding-bottom: 15px;">In Process</p>
                    </div>
                    <div class="YourOrderType_button">
                        <a href="">VIEUW ORDER</a>
                    </div>
                </div>

                <div class="YourOrderType">
                    <div class="YourOrderType_text">
                        <h2>ORDER [#136664]</h2>
                        <p>Ordered on [date]</p>
                        <h3>STATUS</h3>
                        <p style="padding-bottom: 15px;">In Process</p>
                    </div>
                    <div class="YourOrderType_button">
                        <a href="">VIEUW ORDER</a>
                    </div>
                </div>
                
                <div class="YourOrderType">
                    <div class="YourOrderType_text">
                        <h2>ORDER [#136664]</h2>
                        <p>Ordered on [date]</p>
                        <h3>STATUS</h3>
                        <p style="padding-bottom: 15px;">In Process</p>
                    </div>
                    <div class="YourOrderType_button">
                        <a href="">VIEUW ORDER</a>
                    </div>
                </div>


            </div>
        </div>

    
</body>
</html>