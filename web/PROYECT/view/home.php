<!DOCTYPE html>
<html>

<head>
    <title>SpeedX Buy Cars</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../../PROYECT/css/style.css" rel="stylesheet" type="text/css">

</head>

<body>
    <div class="wrapper">
        <div id="top-header">
            <a href="../../PROYECT/view/home.php"><img class="large-logo" src="../../PROYECT/images/05_carLogo.png" alt="" /></a>
            <div class="small-logo">
                <img src="../../PROYECT/images/loginLogo.png" alt="" />
                <span><a href="?action=login">Login</a></span>
                <img src="../../PROYECT/images/cartLogo.png" alt="" /><span>Cart</span>
            </div>
        </div>
        <header class="header">
            <nav class="header-nav" role="navigation">
                <div class="header-nav-brand">
                </div>
                <ul class="header-nav-list">
                    <!--<li><a href="#">Honda</a></li>
                    <li><a href="#">Chevrolet</a></li>
                    <li><a href="#">Ford</a></li>
                    <li><a href="#">Nissan</a></li>
                    <li><a href="#">Subaru</a></li>
                    <li><a href="#">Toyota</a></li>-->
                    
                <?php echo $navlist;?>
                </ul>
                <div class="header-nav-toggle">
                    &#9776;
                </div>
            </nav>
        </header>
        <section>
            <h1>Find your next match</h1>
            <p><b>Shop Cars for Sale</b>
                Find the right price, dealer and advice.</p>
        </section>
        
        <section>
            <img src="../../PROYECT/images/05_banner_car.jpg" alt="banner car on the road" />
        </section>
        <br/>
        <section id="cars-section">
            <div>
                <p>Cars for sale under $5,000</p>
                <img src="../../PROYECT/images/05_carLogo.png" alt="" />
            </div>
            <div>
                <p>Cars for sale under $8,000</p>
                <img src="../../PROYECT/images/05_carLogo.png" alt="" />
            </div>
            <div>
                <p>Used cars priced $1,000 or less</p>
                <img src="../../PROYECT/images/05_carLogo.png" alt="" />
            </div>
        </section>
    </div>
    <footer>
        <hr>
        <br/>
        <p>&copy; 2018 speedxcars.com<p>
        <br/>
    </footer>
    <script src="../js/car.js">
    </script>
</body>
</html>
