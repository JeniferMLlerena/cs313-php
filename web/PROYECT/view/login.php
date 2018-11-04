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
                <ul class="header-nav-list">
                    <?php echo $navlist; ?>
                </ul>
                <div class="header-nav-toggle">
                    &#9776;
                </div>
            </nav>
        </header>
        <main>
            <!--            <form action="demo_form.asp">-->

            <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>


            <!--                 <form method="post" action="/acme/accounts/"> -->
            <form action="/PROYECT/accounts/index.php?action=login" method="post">

                <h1>SpeedX Login</h1>
                Email Adress<br>
                <input type="email" name="email" value=" " required><br>
                Password:<br>
                <span class="spancss">Password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                <input type="password" name="password"><br>

                <input class="buttons" type="submit" value="Login"><br>
                <input type="hidden" name="action" value="login">

                <br>
                <br>
                <p class="negrita">Not a member?</p>

            </form>
            <form>
                <input class="buttons" type="submit" value="Register">
                <input type="hidden" name="action" value="registration">
            </form>
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
