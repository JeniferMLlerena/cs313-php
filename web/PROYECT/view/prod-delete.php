<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /acme/');
    exit;
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
               <!--                <h1>Add Product</h1>-->
            <h1><?php
                if (isset($prodInfo['invName'])) {
                    echo "Modify $prodInfo[invName] ";
                } elseif (isset($prodName)) {
                    echo $prodName;
                }
                ?>
            </h1>

            <p>Modify the product below. All fields are requiered!<p>

                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>

            <form method="post" action="/acme/products/index.php">
                Category<br>
                <?php echo $catList; ?><br>

                <!--                    in DB-->
                Product Name<br>
                <input type="text" name="prodName" id="prodName" required <?php
                if (isset($prodName)) {
                    echo "value='$prodName'";
                } elseif (isset($prodInfo['invName'])) {
                    echo "value='$prodInfo[invName]'";
                }
                ?>><br>
                <!--                    in DB-->                    
                Product Description<br>
                <input type="text" name="prodDesc" id="prodDesc" required <?php
                if (isset($prodDesc)) {
                    echo "value='$prodDesc'";
                } elseif (isset($prodInfo['invDescription'])) {
                    echo "value='$prodInfo[invDescription]'";
                }
                ?>><br>
                <!--                    in DB-->
                Product Image (path to image)<br>
                <input type="text" name="prodImg" id="prodImg" required <?php
                if (isset($prodImg)) {
                    echo "value='$prodImg'";
                } elseif (isset($prodInfo['invImage'])) {
                    echo "value='$prodInfo[invImage]'";
                }
                ?>><br>

                Product Thumbnail (path to thumbnail)<br>
                <input type="text" name="invThumbnail" id="invThumbnail" value=""><br>

                <!--                    in DB-->                    
                Product Price<br>
                <input type="text" name="prodPrice" id="prodPrice" required <?php
                if (isset($prodPrice)) {
                    echo "value='$prodPrice'";
                } elseif (isset($prodInfo['invPrice'])) {
                    echo "value='$prodInfo[invPrice]'";
                }
                ?>><br>
                <!--                    in DB-->
                # in Stock<br>
                <input type="text" name="prodStock" id="prodStock" required <?php
                if (isset($prodStock)) {
                    echo "value='$prodStock'";
                } elseif (isset($prodInfo['invStock'])) {
                    echo "value='$prodInfo[invStock]'";
                }
                ?>><br>

                Shipping Size ( W x H x L in inches )<br>
                <input type="text" name="invSize" id="invSize" value=""><br>
                Weight (lbs.)<br>
                <input type="text" name="invWeight" id="invWeight" value=""><br>
                Location (city name)<br>
                <input type="text" name="invLocation" id="invLocation" value=""><br>

                <!--                    in DB-->
                Vendor Name<br>
                <input type="text" name="prodVendor" id="prodVendor" required <?php
                if (isset($prodVendor)) {
                    echo "value='$prodVendor'";
                } elseif (isset($prodInfo['invVendor'])) {
                    echo "value='$prodInfo[invVendor]'";
                }
                ?>><br>

                Primary Material<br>
                <input type="text" name="invMaterial" id="invMaterial" value=""><br><br>

                <input class="buttons" type="submit" name="submit" value="Update Product">
                <input type="hidden" name="action" value="updateProd"><br>
                <input type="hidden" name="prodId" value="<?php
                if (isset($prodInfo['invId'])) {
                    echo $prodInfo['invId'];
                } elseif (isset($prodId)) {
                    echo $prodId;
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
