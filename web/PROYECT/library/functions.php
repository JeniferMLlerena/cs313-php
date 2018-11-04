<?php

/*
 * This file will become a library of custom functions that we will use in our code to perform a variety of tasks
 */

function ThumbImages($subitems) {
    $subinfo = '<hr><div id="subprod-display"><ul>';   
    foreach ($subitems as $subitem) {
        $subinfo .= "<li>";
        $subinfo .= "<img src='$subitem[imgPath]' alt='Image of $subitem[imgName] on SpeedX.com'>";
        $subinfo .= "</li>";
    }
    $subinfo .= '</ul></div>';
    return $subinfo;
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {

    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            return;
    }

    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {

        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
}

// Processes images by getting paths and
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . DIRECTORY_SEPARATOR;

    // Set up the image path
    $image_path = $dir . DIRECTORY_SEPARATOR . $filename;

    // Set up the thumbnail image path
    $image_path_tn = $dir . makeThumbnailName($filename);

    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the pathes, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;
        // Moves the file to the target folder
        move_uploaded_file($source, $target);
        // Send file for further processing
        processImage($image_dir_path, $filename);
        // Sets the path for the image for Database storage
        $filepath = $image_dir . DIRECTORY_SEPARATOR . $filename;
        // Returns the path where the file is stored
        return $filepath;
    }
}

// Build the products select list
function buildProductsSelect($products) {
    $prodList = '<select name="invItem" id="invItem">';
    $prodList .= "<option>Choose a Product</option>";
    foreach ($products as $product) {
        $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[invName] image on SpeedX.com' alt='$image[invName] image on SpeedX.com'>";
        $id .= "<p><a href='/PROYECT/uploads?action=delete&id=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}

function productInformation($item) {
    $pdinfo = '<div id="prod-description">';

    $pdinfo .= "<div id='desc-right'>";
    $pdinfo .= "<img src='$item[invImage]' alt='Image of $item[invName] on SpeedX.com'>";
    $pdinfo .= "</div>";

    $pdinfo .= "<div id='desc-left'>";
    $pdinfo .= "<h2>$item[invName]</h2>";
    $pdinfo .= "$item[invDescription]<br><br>";
    $pdinfo .= "A $item[invVendor] product<br>";
    $pdinfo .= "<strong>Primary Material:</strong> $item[invStyle]<br>";
    $pdinfo .= "<strong>Product Weight:</strong> $item[invWeight] (lbs)<br>";
    $pdinfo .= "<strong>Shipping Size:</strong> $item[invSize] inches (w x l x h)<br>";
    $pdinfo .= "<strong>Ships from:</strong> $item[invLocation]<br><br>";
    $pdinfo .= "<strong>Number in Stock:</strong> $item[invStock]<br><br>";
    $pdinfo .= "<strong id=price-css>$$item[invPrice]</strong><br>";
    $pdinfo .= "</div>";

    $pdinfo .= "</div>";

    return $pdinfo;
}

function buildProductsDisplay($products) {
    $pd = '<ul>';
    var_dump($products);
    foreach ($products as $product) {
        $image = $product[productimage];
        var_dump($image);
        $pd .= '<li>';
        $pd .= '<a href="#">';
        $pd .= '<img src="' .$image. '" alt="Image of ' .$product[productname]. ' on SpeedX.com">';
        $pd .= '</a>';
        $pd .= '<hr>';
        $pd .= '<a href="#"><h2>' . $product[productname] .'</h2></a>';
        $pd .= "<span>$" . $product[unitprice] ."</span>";
        $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
}

function checkEmail($email) {
    $sanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $valEmail = filter_var($sanEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($password) {
    $pattern = '/^(?=.*[\W])(?=[a-zA-Z0-9])[\w\W]{8,}$/i';
    return preg_match($pattern, $password);
}

function buildNav() {
    $suppliers = getSuppliers();
    $navlist = "<li><a href='.' title='View the Car Homepage'>Home</a></li>";
    foreach ($suppliers as $supplier) {
        $navlist .= '<li><a href="/PROYECT/products/index.php?action=category&type= ' . $supplier["companyname"] . ' " title=View our ' . $supplier["companyname"] . 'product line>' .$supplier["companyname"] . '</a></li>';
    }
    return $navlist;
}
