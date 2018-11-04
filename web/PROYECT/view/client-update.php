<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo $message;
}
?>
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

           <!--                <h1>    CLIENT MODIFY</h1>-->
            <h1><?php
                if (isset($clientInfo['customername'])) {
                    echo "Modify $clientInfo[customername] ";
                } elseif (isset($clientFulltname)) {
                    echo $clientFullname;
                }
                ?>
            </h1>

            <p>Modify the client below. All fields are requiered!<p>

            <form method="post" action="/PROYECT/accounts/index.php">
                <p>All fields are requiered.<p>
                    Full Name<br>
                    <input type="text" name="clientFullname" id="clientFullname" required <?php
                    if (isset($clientFullname)) {
                        echo "value='$clientFullname'";
                    } elseif (isset($clientInfo['customername'])) {
                        echo "value='$clientInfo[customername]'";
                    }
                    ?>><br>

                    Email Adress<br>
                    <input type="text" name="email" id="email" required <?php
                    if (isset($email)) {
                        echo "value='$email'";
                    } elseif (isset($clientInfo['email'])) {
                        echo "value='$clientInfo[email]'";
                    }
                    ?>><br>

                   
                    Username<br>
                    <input type="text" name="userName" id="userName" required <?php
                    if (isset($userName)) {
                        echo "value='$userName'";
                    } elseif (isset($clientInfo['username'])) {
                        echo "value='$clientInfo[username]'";
                    }
                    ?>><br>
                    
                    <input class="buttons" type="submit" name="submit" value="Update Client">
                    <input type="hidden" name="action" value="updateClient"><br>
                    <input type="hidden" name="id" value="<?php
                    if (isset($clientInfo['id'])) {
                        echo $clientInfo['id'];
                    } elseif (isset($id)) {
                        echo $id;
                    }
                    ?>"> 
            </form>
            <form method="post" action="/PROYECT/accounts/index.php">

                <br>
                <br>
                Old Password<br>
                <input readonly type="password" name="password" id="password" value="<?php
                if (isset($clientPassword)) {
                    echo "value='$clientPassword'";
                } elseif (isset($clientInfo['clientPassword'])) {
                    echo "value='$clientInfo[clientPassword]'";
                }
                ?>"><br> 

                <!--ENHANCEMENT 7-->
                New Password<br>
                <span class="spancss">Password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" value="<?php
                ?>"><br> 

                <br>
                <input class="buttons" type="submit" name="submit" value="Update Password">
                <input type="hidden" name="action" value="updatePassword"><br>
                <input type="hidden" name="clientId" value="<?php
                if (isset($clientInfo['clientId'])) {
                    echo $clientInfo['clientId'];
                } elseif (isset($clientId)) {
                    echo $clientId;
                }
                ?>">
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
