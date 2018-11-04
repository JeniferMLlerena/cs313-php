<?php

//ENHANCEMENT 7
function updatePassword($clientPassword, $clientId) {
//    var_dump($clientFirstname, $clientLastname, $clientEmail, $clientId);
//    exit;
    $db = get_db();
    $sql = 'UPDATE customer
            SET	password = :clientPassword
            WHERE id = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}

function updateClient($clientFullname, $userName, $email, $id) {
//    var_dump($clientFirstname, $clientLastname, $clientEmail, $clientId);
//    exit;
    $db = get_db();
    $sql = 'UPDATE customer
            SET	customerName = :clientFullname,
                email = :clientEmail,
                userName = :clientUsername
            WHERE id = :clientId';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':clientFullname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);    
    $stmt->bindValue(':clientUsername', $clientLastname, PDO::PARAM_STR);    
    //$stmt->bindValue(':clientPhonenumber', $clientPhonenumber, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}

//Accounts Model for the visitors.
function getClientInfo($clientId) {
    $db = get_db();
    $sql = 'SELECT * FROM customer WHERE id = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientInfo = $stmt->fetch(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $clientInfo;
}

//This function will handle site registrations
function regVisitor($fullname, $email, $username, $password, $phonenumber) {
// Create a connection object using the acme connection function
    $db = get_db();
// The SQL statement
    $sql = 'INSERT INTO customer (customerName,
           email, userName, password)
           VALUES (:fullname, :email, :username, :password)';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':fullname', $fullname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);    
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);    
    //$stmt->bindValue(':phonenumber', $lastname, PDO::PARAM_STR);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}

// Check for an existing email address
function checkExistingEmail($email) {
    $db = get_db();
    $sql = 'SELECT email FROM customer WHERE email = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();

    if (empty($matchEmail)) {
        return 0;
    } else {
        return 1;
    }
//        if (empty($matchEmail)) {
//            // return 0;
//            echo 'Nothing found';
//            exit;
//        } else {
//            //return 1;
//            echo 'Match found';
//            exit;
//        }
}

// Get client data based on an email address
function getClient($email) {
    $db = get_db();
    $sql = 'SELECT id, customerName, email, userName, phonenumber clientLevel, password FROM customer WHERE email = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}
