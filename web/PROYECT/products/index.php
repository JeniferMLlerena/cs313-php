<?php

// Create or access a Session
session_start();

//Products Controller
require_once '../library/connections.php';
require_once '../model/car-model.php';

// Get the accounts model
require_once '../model/accounts-model.php';

// Get the products model
require_once '../model/products-model.php';

// Get the functions library
require_once '../library/functions.php';

// Get the array of categories
$suppliers = getSuppliers();
$navlist = "<li><a href='.' title='View the Car Homepage'>Home</a></li>";
foreach ($suppliers as $supplier) {
 /*   $navlist .= '<li><a href="/PROYECT/products/index.php?action=category&type= ' . $supplier["companyname"] . ' " title=View our ' . $supplier["companyname"] . 'product line>' .$supplier["companyname"] . '</a></li>'; */
    $navlist .= '<li><a href="/PROYECT/products/index.php?action=category&type=' . $supplier["companyname"] . '" title=View our ' . $supplier["companyname"] . 'product line>' .$supplier["companyname"] . '</a></li>'; 
}

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'prod-mgmt';
        header('location: /PROYECT/products/index.php?action=prod-mgmt');
        exit;
    }
}

switch ($action) {
    case 'detailProduct':
        $prodId = filter_input(INPUT_GET, 'prodId', FILTER_VALIDATE_INT);
        $item = getProductsById($prodId);
        if (!count($item)) {
            $message = "<p class='notice'>Sorry, no $item products ccould be found.</p>";
        } else {
            $prodDisplay = productInformation($item);
        }      
       
        $subitems = getThumbImages($prodId);
        if (!count($subitems)) {
            $message = "<p class='notice'>Sorry, no extra images for this product ccould be found.</p>";
        } else {
            $subprodDisplay = ThumbImages($subitems);
        }                      
        include '../view/product-detail.php';
        exit;        
        break;
    
    case 'category':
        $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
        $products = getProductsByCategory($type);
        if (!count($products)) {
            $message = "<p class='notice'>Sorry, no $type products could be found.</p>";
        } else {
            $prodDisplay = buildProductsDisplay($products);
        }        
        include '../view/category.php';
        break;

    case 'deleteProd':
        $prodName = filter_input(INPUT_POST, 'prodName', FILTER_SANITIZE_STRING);
        $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);

        //ENHANCEMETN 7
        $deleteResult = deleteProduct($prodId);

        if ($deleteResult) {
            $message = "<p>Congratulations, $prodName was successfully delete.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
            $message = "<p>Error. The new product was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        }
        break;

    case 'del':
        $prodId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($prodId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-delete.php';
        exit;
        break;

    case 'updateProd':
        $catType = filter_input(INPUT_POST, 'catType', FILTER_SANITIZE_NUMBER_INT);
        $prodName = filter_input(INPUT_POST, 'prodName', FILTER_SANITIZE_STRING);
        $prodDesc = filter_input(INPUT_POST, 'prodDesc', FILTER_SANITIZE_STRING);
        $prodImg = filter_input(INPUT_POST, 'prodImg', FILTER_SANITIZE_STRING);
        //$prodThumb = filter_input(INPUT_POST, 'prodThumb', FILTER_SANITIZE_STRING);
        $prodPrice = filter_input(INPUT_POST, 'prodPrice', FILTER_SANITIZE_NUMBER_FLOAT);
        $prodStock = filter_input(INPUT_POST, 'prodStock', FILTER_SANITIZE_NUMBER_INT);
        //$prodSize = filter_input(INPUT_POST, 'prodSize', FILTER_SANITIZE_NUMBER_INT);
        //$prodWeight = filter_input(INPUT_POST, 'prodWeight', FILTER_SANITIZE_NUMBER_INT);
        //$prodLocation = filter_input(INPUT_POST, 'prodLocation', FILTER_SANITIZE_STRING);
        $prodVendor = filter_input(INPUT_POST, 'prodVendor', FILTER_SANITIZE_STRING);
        //$prodStyle = filter_input(INPUT_POST, 'prodStyle', FILTER_SANITIZE_STRING);

        $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);



        if (empty($catType) || empty($prodName) || empty($prodDesc) || empty($prodImg) || empty($prodPrice) || empty($prodStock) || empty($prodVendor)) {
            $message = '<p>Please complete all information for the updated item! Double check the category of the item.</p>';
            include '../view/prod-update.php';
            exit;
        }
        //ENHANCEMETN 7
        $updateResult = updateProduct($catType, $prodName, $prodDesc, $prodImg, $prodPrice, $prodStock, $prodVendor, $prodId);

//        if ($updateResult) {
//            $message = "<p>Congratulations, $prodName was successfully modify.</p>";
//            include '../view/new-prod.php';
//            exit;
        if ($updateResult) {
            $message = "<p>Congratulations, $prodName was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
            $message = "<p>Error. The new product was not modify.</p>";
            include '../view/prod-update.php';
            exit;
        }
        break;

    case 'mod':
        $prodId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($prodId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }
        $catType = $prodInfo["categoryId"];
        include '../view/prod-update.php';
        exit;
        break;

    case 'prod-mgmt':
        $products = getProductBasics();

        if (count($products) > 0) {
            $prodList = '<table>';
            $prodList .= '<thead>';
            $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $prodList .= '</thead>';
            $prodList .= '<tbody>';
            foreach ($products as $product) {
                $prodList .= "<tr><td>$product[invName]</td>";
                $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
                $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
            }
            $prodList .= '</tbody></table>';
        } else {
            $message = '<p class="notify">Sorry, no products were returned.</p>';
        }

        include '../view/prod-mgmt.php';
        break;

    case 'newProductForm':
// will take me to product form
        include '../view/new-prod.php';
        break;

    case 'newProduct':
// get data from (inventory table) form
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $categoryId = filter_input(INPUT_POST, 'catType', FILTER_SANITIZE_NUMBER_INT);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);

// Validate the inputs
//if empty
        if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invPrice) || empty($invStock) || empty($categoryId) || empty($invVendor)) {
            $message = '<p class="bad">Please provide information for all empty form fields.</p>';

            include '../view/new-prod.php';
            exit;
        }


        $regOutcome = regProducts($invName, $invDescription, $invImage, $invPrice, $invStock, $categoryId, $invVendor);

// Check and report the result
        if ($regOutcome === 1) {
            $message = "<p class='good'>Thanks for registering $invName as a new product.</p>";
            include '../view/new-prod.php';
            exit;
        } else {
            $message = "<p class='bad'>Sorry $invName, but the registration for the product failed. Please try again.</p>";
            include '../view/new-prod.php';
            exit;
        }

        break;

    case 'newCategoryForm':
// will take me to category form
        include '../view/new-cat.php';
        break;

    case 'newCategory':
// get data from form
        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);

// Validate the inputs
//if empty
        if (empty($categoryName)) {
            $message = '<p class="bad"> * Please provide information for all empty form fields.</p>';
            include '../view/new-cat.php';
            exit;
        }

//if it exist
        $dbCheck = getCategoryByName($categoryName);
//      
        if (count($dbCheck) && count($dbCheck[0])) {
            $message = '<p class="bad"> * ERROR: This category already exist.</p>';
            include '../view/new-cat.php';
            exit;
        }

        $regOutcome = regCategories($categoryName);
//        $insert = addCategory($categoryName);
//        if ($insert)
//        {
//            header('location: index.php');
//            exit;
//        }
//        else
//        {
//            $message = "<p> Error. The new category was not added.";
//            include '../view/new-cat.php';
//            exit;
//        }
// Check and report the result
        if ($regOutcome === 1) {
            $message = "<p class='good'>Thanks for registering $categoryName as a new category.</p>";
            header('location: index.php');
            //include '../view/new-cat.php';
            // header('location: index.php');
            exit;
        } else {
            $message = "<p class=bad'>Sorry $categoryName, but the registration for the category failed. Please try again.</p>";
            include '../view/new-cat.php';
            exit;
        }
        break;
}
?>