<?php

if(!isset($_SESSION)) {
	session_start();
}

require 'config.php';
$brandID     = $_SESSION['b_id'];		// brand ID of logged in brand
$shoeID 	 = $_SESSION['shoeID'];		// shoe ID of the shoe being edited
$name        = $_POST['name'];
$description = mysqli_real_escape_string($conn, $_POST['description']);
$type        = $_POST['type'];
$category    = $_POST['category'];
$size        = $_POST['size'];
$color       = $_POST['color'];
$price       = $_POST['price'];
$imgpath     = $_FILES["imgpath"]["name"];
$imgpathOld  = $_SESSION['shoeImg'];
mysqli_close($conn);

$error_msg = '';

/********** GET BRAND NAME **********/
require 'config.php';
$sql = "CALL SP_GET_BRAND_INFO($brandID)";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$brand_name = $row['brand_name'];

mysqli_close($conn);
/********** END BRAND NAME **********/


/****** BEGIN IMAGE PROCESSING ******/
switch($type) {
	case 'Mens': $target_dir = "../images/php-uploads/shoes/mens/"; break;
	case 'Womens': $target_dir = "../images/php-uploads/shoes/womens/"; break;
}

$target_file = $target_dir . basename($imgpath);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imgpath"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $error_msg .= "File is not an image. ";
        $uploadOk = 0;
    }
}
// Rename image to fit site specifications
$renamed_file = $target_dir;
$renamed_file .= strtolower(str_replace(' ', '_', $brand_name));
$renamed_file .= '-';
$renamed_file .= strtolower($category);
$renamed_file .= '-';
$renamed_file .= strtolower(str_replace(' ', '_', $name));
$renamed_file .= '.'.$imageFileType;

// Check if file already exists in server directory
// if (file_exists($renamed_file)) {
//     $error_msg .= "The file already exists. ";
//     $uploadOk = 0;
// }
// Check file size
if ($_FILES["imgpath"]["size"] > 500000) {
    $error_msg .= "The file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $error_msg .= "Only JPG, JPEG, PNG, and GIF files are allowed.";
    $uploadOk = 0;
}

/******  END IMAGE PROCESSING  ******/


/*****  BEGIN QUERY PROCESSING  *****/
require 'config.php';

$type = strtolower($type);
$sql = "CALL SP_SET_SHOE(".$shoeID.", '".$name."', '".$description."', '".$type."', '".$category."', ".$size.", ".$price.", '".$color."', '".$renamed_file."');";

if($uploadOk == 1) {
	$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	// $row = mysqli_fetch_assoc($result);

	// $message = $row['str_return'];

	// if($message == 'SUCCESS') {
	if($result) {
		$_SESSION['success_msg'] = "Your shoe '" . $name . "' was successfully updated!";

		// Delete previous image
		unlink($imgpathOld);

		// if everything is ok, try to upload IMAGE
	    if (move_uploaded_file($_FILES["imgpath"]["tmp_name"], $renamed_file)) {
	        echo "The file ". basename( $_FILES["imgpath"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }

		$success_path = "../views/brands/products.php?addProduct=" . md5('success');
		header("Location: $success_path");
		exit();
	}
	else {
		$error_msg .= "Sorry, something went wrong.";
		$_SESSION['error_msg'] = $error_msg;
		$error_path = "../views/brands/products.php?addProduct=" . md5('failed');
		header("Location: $error_path");
		exit();
	}
}
else {
	$error_msg .= "Sorry, your file was not uploaded.";
	$_SESSION['error_msg'] = $error_msg;
	$error_path = "../views/brands/products.php?addProduct=" . md5('failed');
	header("Location: $error_path");
	exit();
}
mysqli_close($conn);
/******  END QUERY PROCESSING  ******/

?>