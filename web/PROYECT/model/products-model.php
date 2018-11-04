<?php

function getThumbImages($prodId) {
    $db =  get_db();
    $sql = 'SELECT imgId, imgPath, imgName, images.invId, invName FROM images JOIN inventory ON images.invId = inventory.invId WHERE images.invId = :prodType AND imgPath LIKE "%-tn%"';
    $stmt = $db->prepare($sql);
   
    $stmt->bindValue(':prodType', $prodId, PDO::PARAM_STR);
    
    $stmt->execute();
    $subitems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $subitems;
}

function getProductsById($prodId) {
    $db =  get_db();
    $sql = "SELECT * FROM product WHERE id = :prodId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_STR);
    $stmt->execute();
    $products = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $products;
}

function getProductsByCategory($type) {
    $db =  get_db();
    $sql = "SELECT * FROM product WHERE supplier_id IN (SELECT id FROM supplier WHERE companyName = :catType)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':catType', $type, PDO::PARAM_STR);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $products;
}


//DELETE PRODUCT
function deleteProduct($prodId) {
    $db =  get_db();
    $sql = 'DELETE FROM inventory WHERE invId = :prodId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//UPDATE PRODUCT
function updateProduct($catType, $prodName, $prodDesc, $prodImg, $prodPrice, $prodStock, $prodVendor, $prodId) {
    $db =  get_db();
    $sql = 'UPDATE inventory SET invName = :prodName, invDescription = :prodDesc, invImage = :prodImg, invPrice = :prodPrice, invStock = :prodStock, categoryId = :catType, invVendor = :prodVendor WHERE invId = :prodId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodDesc', $prodDesc, PDO::PARAM_STR);
    $stmt->bindValue(':prodImg', $prodImg, PDO::PARAM_STR);
    $stmt->bindValue(':prodPrice', $prodPrice, PDO::PARAM_STR);
    $stmt->bindValue(':prodStock', $prodStock, PDO::PARAM_INT);
    $stmt->bindValue(':prodVendor', $prodVendor, PDO::PARAM_STR);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    $stmt->bindValue(':catType', $catType, PDO::PARAM_INT);
    $stmt->bindValue(':prodName', $prodName, PDO::PARAM_STR);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}

function getProductInfo($prodId) {
    $db =  get_db();
    $sql = 'SELECT * FROM product WHERE id = :prodId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    $stmt->execute();
    $prodInfo = $stmt->fetch(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $prodInfo;
}

function getProductBasics() {
    $db =  get_db();
    $sql = 'SELECT productName, id FROM product ORDER BY productName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $products;
}

//Product Model.
//This function will handle site products
function regProducts($invName, $invDescription, $invImage, $invPrice, $invStock, $categoryId, $invVendor) {
// Create a connection object using the acme connection function
    $db = get_db();
// The SQL statement
    $sql = 'INSERT INTO inventory (invName, invDescription, invImage, invPrice, invStock, categoryId, invVendor)
    VALUES (:invName, :invDescription, :invImage, :invPrice, :invStock, :categoryId, :invVendor)';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}

function regCategories($categoryName) {
// Create a connection object using the acme connection function
    $db =  get_db();
// The SQL statement
    $sql = 'INSERT INTO categories (categoryName)
    VALUES (:categoryName)';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);

//UPPER AND LOWER    
//   $categoryName = strtoupper($categoryName);
// // The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}

?>