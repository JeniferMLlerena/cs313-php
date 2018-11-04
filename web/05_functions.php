<?php
//Build the navigation bar
function buildNav() {
$categories = getCategories();
$navlist = '<ul>';
    $navlist .= "<li><a href='/acme/index.php?action=home' title='View the Acme Homepage'>Home</a></li>";

    foreach ($categories as $category) {
    $navlist .= "<li><a href='/acme/products/index.php?action=category&type=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    $navlist .= "</ul>";
return $navlist;
}

//SIGN UP
/*Check Email*/
function checkEmail($email) {
    $sanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $valEmail = filter_var($sanEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

/*Check the passwords
    - 1 CAPITAL LETTER
    - 1 NUMBER AT LEAST
    - 1 SPECIAL CHARACTER
*/
function checkPassword($password) {
    $pattern = '/^(?=.*[\W])(?=[a-zA-Z0-9])[\w\W]{8,}$/i';
    return preg_match($pattern, $password);
}
?>