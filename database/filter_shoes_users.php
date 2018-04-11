<?php

if(!isset($_SESSION)) {
	session_start();
	require 'activity_check.php';
}

$brand 		= $_POST['brand'];
$priceFrom 	= $_POST['priceFrom'];
$priceTo 	= $_POST['priceTo'];
$type 		= $_POST['type'];
$category 	= $_POST['category'];
$size 		= $_POST['size'];
$color 		= $_POST['color'];

$brand 		= trim($brand);
$priceFrom	= trim($priceFrom);
$priceTo 	= trim($priceTo );
$type 		= trim($type);
$category 	= trim($category);
$size 		= trim($size);
$color 		= trim($color);

$brand 		= filter_var($brand, FILTER_SANITIZE_STRING);
$priceFrom 	= filter_var($priceFrom, FILTER_SANITIZE_NUMBER_FLOAT);
$priceTo  	= filter_var($priceTo , FILTER_SANITIZE_NUMBER_FLOAT);
$type 		= filter_var($type, FILTER_SANITIZE_STRING);
$category 	= filter_var($category, FILTER_SANITIZE_STRING);
$size 		= filter_var($size, FILTER_SANITIZE_NUMBER_INT);
$color 		= filter_var($color, FILTER_SANITIZE_STRING);

echo "brand: " . $brand . "<br>";
echo "price: " . $priceFrom . " - " . $priceTo . "<br>";
echo "type: " . $type . "<br>";
echo "category: " . $category . "<br>";
echo "size: " . $size . "<br>";
echo "color: " . $color . "<br>";

/* VALIDATE INPUT */
if(!empty($priceFrom) && $priceFrom != '') {
	if(empty($priceTo) || $priceTo == '' || $priceTo < $priceFrom) {
		$_SESSION['error_msg'] = "Invalid price range in filter";
		header("Location: ../views/users/products.php?error=" . md5('filter'));
		exit();
	}
}
else if(!empty($priceTo) && $priceTo != '') {
	if(empty($priceFrom) || $priceFrom == '') {
		$_SESSION['error_msg'] = "Invalid price range in filter";
		header("Location: ../views/users/products.php?error=" . md5('filter'));
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
	$filter_msg = "<strong>Showing filtered results for:</strong> &nbsp;";

	// BRAND
	if(!empty($brand) && $brand != '') {
		$filter .= "posted_by = $brand";

		// get brand name;
		require 'config.php';
		$query = "CALL SP_GET_BRAND_INFO($brand)";
		$res = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($res);
		$brand_name = $row['brand_name'];
		mysqli_close($conn);

		$filter_msg .= "<span class='label label-primary' style='font-size: 13px; padding: 4px 12px'>$brand_name</span>";
		$filter_msg .= "&nbsp;";
	}

	// PRICE RANGE
	if(!empty($priceFrom) && $priceFrom != '' && !empty($priceTo) && $priceTo != '') {
		if(!empty($brand) && $brand != '') {
			$filter .= " AND ";
		}	

		$filter .= "price BETWEEN $priceFrom AND $priceTo";

		$filter_msg .= "<span class='label label-primary' style='font-size: 13px; padding: 4px 12px'>";
		$filter_msg .= "&#8369; $priceFrom &mdash; &#8369; $priceTo";
		$filter_msg .= "</span>";
		$filter_msg .= "&nbsp;";
	}

	// TYPE
	if(!empty($type) && $type != '') {
		if(!empty($brand) 	  && $brand != '' 	  ||
	       !empty($priceFrom) && $priceFrom != '' && !empty($priceTo)   && $priceTo != '') {
			$filter .= " AND ";
		}	

		$filter .= "type = '$type'";

		$filter_msg .= "<span class='label label-primary' style='font-size: 13px; padding: 4px 12px'>";
		$filter_msg .= ucfirst("$type");
		$filter_msg .= "</span>";
		$filter_msg .= "&nbsp;";
	}

	// CATEGORY
	if(!empty($category) && $category != '') {
		if(!empty($brand) 	  && $brand != '' 	  ||
	       !empty($priceFrom) && $priceFrom != '' && !empty($priceTo)   && $priceTo != '' ||
	   	   !empty($type) 	  && $type != '') {
			$filter .= " AND ";
		}	

		$filter .= "category = '$category'";

		$filter_msg .= "<span class='label label-primary' style='font-size: 13px; padding: 4px 12px'>";
		$filter_msg .= ucfirst("$category");
		$filter_msg .= "</span>";
		$filter_msg .= "&nbsp;";
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

		$filter_msg .= "<span class='label label-primary' style='font-size: 13px; padding: 4px 12px'>";
		$filter_msg .= "Size $size";
		$filter_msg .= "</span>";
		$filter_msg .= "&nbsp;";
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

		$filter_msg .= "<span class='label label-primary' style='font-size: 13px; padding: 4px 12px'>";
		$filter_msg .= ucfirst("$color");
		$filter_msg .= "</span>";
		$filter_msg .= "&nbsp;";
	}
}


# RETURN SQL STATEMENT
$filtered_sql = $sql . $filter;
$_SESSION['grid_sql'] = $filtered_sql;
$_SESSION['grid_applied_filters'] = $filter_msg;

# Redirect back to products.php to display filtered results
header("Location: ../views/users/products.php");
exit();

// echo $filtered_sql;
?>
