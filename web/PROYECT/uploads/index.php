<?php

// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/acme-model.php';
require_once '../model/products-model.php';
require_once '../model/uploads-model.php';

$navlist = buildNav();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'home';
    }
}

//****************************************+WEEK 11
// path to directory name where images are stored
set_include_path('/usr/lib/pear');

//$image_dir = '\acme\images\products';
//$path = $_SERVER['DOCUMENT_ROOT'];
//// the path below assumes the image directory is inside the current folder
////  $image_dir_path = getcwd() . DIRECTORY_SEPARATOR . $image_dir;
//$image_dir_path = getcwd() . DIRECTORY_SEPARATOR . $image_dir . DIRECTORY_SEPARATOR;
//var_dump($image_dir_path);


$image_dir = '/acme/images/products';
// the path below assumes the image directory is inside the current folder
//  $image_dir_path = getcwd() . DIRECTORY_SEPARATOR . $image_dir;
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . $image_dir;

switch ($action) {
//        Hande Image File Uploads
    case 'upload':
        //store the incoming product id
        // Store the incoming product id
        $prodId = filter_input(INPUT_POST, 'invItem', FILTER_VALIDATE_INT);
        // Store the name of the uploaded image
        $imgName = $_FILES['file1']['name'];

        $imageCheck = checkExistingImage($imgName);

        if ($imageCheck) {
            $message = '<p class="notice">An image by that name already exists.</p>';
        } elseif (empty($prodId) || empty($imgName)) {
            $message = '<p class="notice">You must select a product and image file for the product.</p>';
        } else {

            // Upload the image, store the returned path to the file
            $imgPath = uploadFile('file1');

            // Insert the image information to the database, get the result
            $result = storeImages($imgPath, $prodId, $imgName);

            // Set a message based on the insert result
            if ($result) {
                $message = '<p class="notice">The upload succeeded.</p>';
            } else {
                $message = '<p class="notice">Sorry, the upload failed.</p>';
            }
        }

        // Store message to session
        $_SESSION['message'] = $message;

        // Redirect to this controller for default action
        header('location: .');
        break;
    //        Hande Image File Deletes
    case 'delete':
        // Get the image name and id
        $filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_STRING);
        $imgId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        // Build the full path to the image to be deleted
        $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;

        // Check that the file exists in that location
        if (file_exists($target)) {
            // Deletes the file in the folder
            $result = unlink($target);
        }

        // Remove from database only if physical file deleted
        if ($result) {
            $remove = deleteImage($imgId);
        }

        // Set a message based on the delete result
        if ($remove) {
            $message = "<p class='notice'>$filename was successfully deleted.</p>";
        } else {
            $message = "<p class='notice'>$filename was NOT deleted.</p>";
        }

        // Store message to session
        $_SESSION['message'] = $message;

        // Redirect to this controller for default action
        header('location: .');
        break;

    //        Hande default option
    default:
        // Call function to return image info from database
        $imageArray = getImages();

        // Build the image information into HTML for display
        if (count($imageArray)) {
            $imageDisplay = buildImageDisplay($imageArray);
        } else {
            $imageDisplay = '<p class="notice">Sorry, no images could be found.</p>';
        }

        // Get inventory information from database
        $products = getProductBasics();
        // Build a select list of product information for the view
        $prodSelect = buildProductsSelect($products);

        include '../view/image-admin.php';
        break;
}
?>