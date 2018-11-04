<?php

// Create or access a Session
session_start();

//Car controler
require_once 'library/connections.php';
require_once 'model/acme-model.php';

// Get the accounts model
require_once 'model/accounts-model.php';
// Get the functions library
require_once 'library/functions.php';

// Get the array of categories
$categories = getCategories();
$navlist = buildNav();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'home';
    }

    // Check if the firstname cookie exists, get its value
    if (isset($_COOKIE['firstName'])) {
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstName', FILTER_SANITIZE_STRING);
}
   
    switch ($action) {
        case 'home':
            include 'view/home.php';
            break;

        case 'login':
            include 'view/login.php';
            break;

        case 'registration':
            include 'view/registration.php';
            break;

        case 'error':
            include 'errordocs/500.php';
            break;
    }
}
?>