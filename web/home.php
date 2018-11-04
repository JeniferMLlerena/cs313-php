<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
    <meta name="description" content="Home Page for cs313">
    <meta name="author" content="Jenifer Langfoss">
  </head>
  <body>
    <div id="profile">
        <img src="profile.jpg" alt="photoProfile">
        <span>My profile</span>
    </div>
    <a href="assignments.php">Click here to go to the assignments</a>

    <div class="user-profile">
          <div class="username">Jenifer Langfoss</div>
            <div class="bio">
              Senior Software Engineering
            </div>
            <div class="description">
              I sometimes design websites and applications for the web.
              I love to dance and paint.
              I am from Peru but I have lived in Spain for the last 11 years.
            </div>
            <ul class="data">
              <li><span> Facebook</span></li>
              <li><span> Instagram</span></li>
              <li><span> Linkedin</span></li>
            </ul>
    </div>

    <footer>
      Today is <?php print date('l jS \of F Y'); ?>
    </footer>
  </body>
</html>
