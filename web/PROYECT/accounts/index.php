<?php

// Create or access a Session
session_start();

//Accounts Controller
require_once '../library/connections.php';
// Get the functions library
require_once '../library/functions.php';

require_once '../model/car-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the products model
require_once '../model/products-model.php';


// Get the value from the action key - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'resgitration';
        header('location: ../index.php?action=registration');
        exit;
    }
}

switch ($action) {
    case 'updatePassword';
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $checkPassword = checkPassword($clientPassword);
// Hash the checked password
        $clientPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        if (empty($clientPassword)) {
            $message = '<p>Please write a new password.</p>';
            include '../view/client-update.php';
            exit;
        }
        $updateResult = updatePassword($clientPassword, $clientId);

        if ($updateResult === 1) {
            $clientData = getClientInfo($clientId);
            $_SESSION['loggedin'] = TRUE;
// Remove the password from the array
// the array_pop function removes the last
// element from an array
            array_pop($clientData);
// Store the array into the session
            $_SESSION['clientData'] = $clientData;
            $message = "<p>Congratulations, password was successfully updated.</p>";
            $_SESSION['message'] = $message;
// Send them to the admin view
            include '../view/admin.php';
            exit;
        } else {
            $message = "<p>Error. The client's password was not modify.</p>";
            include '../view/client-update.php';
            exit;
        }

        break;

    case 'updateClient':
        $clientFullname = filter_input(INPUT_POST, 'clientFullname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email');        
        $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
        $checkEmail = checkEmail($clientEmail);

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);


        if (empty($clientFullname) || empty($userName) || empty($email)) {
            $message = '<p>Please complete all information for the updated the contact information.</p>';
            include '../view/client-update.php';
            exit;
        }
        $updateResult = updateClient($clientFullname, $userName, $clientEmail, $id);
var_dump($updateResult);

        if ($updateResult === 1) {
            $clientData = getClientInfo($clientId);
            $_SESSION['loggedin'] = TRUE;
// Remove the password from the array
// the array_pop function removes the last
// element from an array
            array_pop($clientData);
// Store the array into the session
            $_SESSION['clientData'] = $clientData;
            $message = "<p>Congratulations, $clientFirstname  was successfully updated.</p>";
            $_SESSION['message'] = $message;
// Send them to the admin view
            include '../view/admin.php';
            exit;
        } else {
            $message = "<p>Error. The client was not modify.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;

    case 'mod':
        $clientId = $_SESSION['clientData']['id'];
        $clientInfo = getClientInfo($clientId);
        if (count($clientInfo) < 1) {
            $message = 'Sorry, your information could be found.';
        }
        include '../view/client-update.php';
        exit;
        break;

    case 'registration':
        $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email');
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);        
        $phonenumber = filter_input(INPUT_POST, 'phonenumber', FILTER_SANITIZE_STRING);
        $checkEmail = checkEmail($email);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $checkPassword = checkPassword($password);

        $existingEmail = checkExistingEmail($email);

        // Check for existing email address in the table
        if ($existingEmail) {
            $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

        // Check for missing data
        if (empty($fullname) || empty($username) || empty($checkEmail) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }

        // Hash the checked password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regVisitor($fullname, $email, $username, $password, $phonenumber);
        // Check and report the result --- COOKIES ----
        if ($regOutcome === 1) {
            setcookie('firstname', $firstname, strtotime('+1 year'), '/');
            $message = "<p>Thanks for registering $firstname. Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
        }
        break;

    case 'login':
        $email = filter_input(INPUT_POST, 'email');
        $email = checkEmail($email);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $passwordCheck = checkPassword($password);

// Run basic checks, return if errors
        if (empty($email) || empty($passwordCheck)) {
            $message = '<p class="notice">Please provide a valid email address and password.</p>';
            include '../view/login.php';
            exit;
        }

// A valid password exists, proceed with the login process
// Query the client data based on the email address
        $clientData = getClient($email);
// Compare the password just submitted against
// the hashed password for the matching client
        $hashCheck = password_verify($password, $clientData['password']);
        
// If the hashes don't match create an error
// and return to the login view
        if (!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
// A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
// Remove the password from the array
// the array_pop function removes the last
// element from an array
        array_pop($clientData);
// Store the array into the session
        $_SESSION['clientData'] = $clientData;
        
// Send them to the admin view
        include '../view/admin.php';
        exit;
        break;

    case 'logout':
        session_destroy();
        header('Location: ../index.php');
        exit;
}
?>