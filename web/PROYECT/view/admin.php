<!DOCTYPE html>
<html>

<head>
    <title>SpeedX Buy Cars - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../../PROYECT/css/style.css" rel="stylesheet" type="text/css">

</head>

<body>
    <div class="wrapper">
        <div id="top-header">
            <a href="/web/index.php?action=home"><img class="large-logo" src="../../PROYECT/images/05_carLogo.png" alt="" /></a>
            <div class="small-logo">
                <img src="../../PROYECT/images/loginLogo.png" alt="" /><span>Login</span>
                <img src="../../PROYECT/images/cartLogo.png" alt="" /><span>Cart</span>
            </div>
        </div>
        <header class="header">
            <nav class="header-nav" role="navigation">
                <div class="header-nav-brand">
                </div>
                <!--<ul class="header-nav-list">
                    <li><a href="#">Honda</a></li>
                    <li><a href="#">Chevrolet</a></li>
                    <li><a href="#">Ford</a></li>
                    <li><a href="#">Nissan</a></li>
                    <li><a href="#">Subaru</a></li>
                    <li><a href="#">Toyota</a></li>
                </ul>-->

                <?php echo $navlist; ?> 
                <div class="header-nav-toggle">
                    &#9776;
                </div>
            </nav>
        </header>
        <main>

           <?php
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                echo $message;
            }
            
            ?>
            <h1><?php echo $_SESSION['clientData']['customername'] . " " . $_SESSION['clientData']['username']; ?></h1>

            <ul>
                <li>First Name: <?php echo $_SESSION['clientData']['customername']; ?></li>
                <li>Username: <?php echo $_SESSION['clientData']['username']; ?></li>
                <li>Email: <?php echo $_SESSION['clientData']['email']; ?></li>
                <!--            ENHANCEMENT 7 WE ARE NOT SHOWING THE LEVEL DATA FOR THIS ENHANCEMENT
                    <li>User Lever: //<?php // echo $_SESSION['clientData']['clientLevel'];  ?></li>-->
            </ul>

            <a href='/PROYECT/accounts/index.php?action=mod&email title="Click to modify the Client Information"'>Click to modify your Information</a>

            <?php
            if ($_SESSION['clientData']['clientLevel'] > 2) {
                echo "<p> <a href='/PROYECT/products/'>Products</a></p>";
            }
            ?>
            
        </main>
    </div>
    <footer>
        <hr>
        <br />
        <p>&copy; 2018 speedxcars.com<p>
        <br />
    </footer>
    <script src="../js/car.js">
    </script>
</body>

</html>
