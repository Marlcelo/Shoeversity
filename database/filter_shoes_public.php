<?php

if(!isset($_SESSION)) {
	session_start();
}
require 'config.php';

$brand 		= $_POST['brand'];
$priceFrom 	= $_POST['priceFrom'];
$priceTo 	= $_POST['priceTo'];
$type 		= $_POST['type'];
$category 	= $_POST['category'];
$size 		= $_POST['size'];
$color 		= $_POST['color'];

echo "brand: " . $brand . "<br>";
echo "price: " . $priceFrom . " - " . $priceTo . "<br>";
echo "type: " . $type . "<br>";
echo "category: " . $category . "<br>";
echo "size: " . $size . "<br>";
echo "color: " . $color . "<br>";

/* VALIDATE INPUT */
if(!empty($priceFrom) && $priceFrom != '') {
	if(empty($priceTo) || $priceTo == '' || $priceTo < $priceFrom) {
		$_SESSION['error_msg'] = "Invalid price range";
		header("Location: ../views/index.php?error=" . md5('filter'));
		exit();
	}
}
else if(!empty($priceTo) && $priceTo != '') {
	if(empty($priceFrom) || $priceFrom == '') {
		$_SESSION['error_msg'] = "Invalid price range";
		header("Location: ../views/index.php?error=" . md5('filter'));
		exit();
	}
}

/* IF VALID INPUT, PROCEED */

$sql = "SELECT * FROM shoes";

// Count how many filters were applied 
$ctr = 0;
if(!empty($brand) 		&& $brand != '')	 $ctr++;
if(!empty($priceFrom) 	&& $priceFrom != '') $ctr++;
if(!empty($priceTo) 	&& $priceTo != '') 	 $ctr++;
if(!empty($type) 		&& $type != '') 	 $ctr++;
if(!empty($category) 	&& $category != '')  $ctr++;
if(!empty($size) 		&& $size != '') 	 $ctr++;
if(!empty($color) 		&& $color != '')     $ctr++;

$filter = '';

# APPEND FILTERING CONDITIONS IN WHERE CLAUSE
if($ctr > 0) {
	$filter .= ' WHERE ';

	// BRAND
	if(!empty($brand) && $brand != '') {
		$filter .= "posted_by = $brand";
	}

	// PRICE RANGE
	if(!empty($priceFrom) && $priceFrom != '' && !empty($priceTo) && $priceTo != '') {
		if(!empty($brand) && $brand != '') {
			$filter .= " AND ";
		}	

		$filter .= "price BETWEEN $priceFrom AND $priceTo";
	}

	// TYPE
	if(!empty($type) && $type != '') {
		if(!empty($brand) 	  && $brand != '' 	  ||
	       !empty($priceFrom) && $priceFrom != '' && !empty($priceTo)   && $priceTo != '') {
			$filter .= " AND ";
		}	

		$filter .= "type = '$type'";
	}

	// CATEGORY
	if(!empty($category) && $category != '') {
		if(!empty($brand) 	  && $brand != '' 	  ||
	       !empty($priceFrom) && $priceFrom != '' && !empty($priceTo)   && $priceTo != '' ||
	   	   !empty($type) 	  && $type != '') {
			$filter .= " AND ";
		}	

		$filter .= "category = '$category'";
	}

	// SIZE 
	if(!empty($size) && $size != '') {
		if(!empty($brand) 	  && $brand != '' 	  ||
	       !empty($priceFrom) && $priceFrom != '' && !empty($priceTo)   && $priceTo != '' ||
	   	   !empty($type) 	  && $type != ''	  ||
	   	   !empty($category) && $category != '') {
			$filter .= " AND ";
		}	

		$filter .= "size = $size";
	}

	// COLOR
	if(!empty($color) && $color != '') {
		if(!empty($brand) 	  && $brand != '' 	  ||
	       !empty($priceFrom) && $priceFrom != '' && !empty($priceTo)   && $priceTo != '' ||
	   	   !empty($type) 	  && $type != ''	  ||
	   	   !empty($category) && $category != ''	  ||
	   	   !empty($size) && $size != '') {
			$filter .= " AND ";
		}	

		$filter .= "color = '$color'";
	}

}


# RETURN SQL STATEMENT
$filtered_sql = $sql . $filter;
$_SESSION['grid_sql'] = $filtered_sql;

?>
