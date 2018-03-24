<?php

// $records_per_page = 6;
$page = '';
$output = '';

# Get inupt from AJAX call
if(isset($_POST['page']) && isset($_POST['records'])) {
	$page = $_POST['page'];
	$records_per_page = $_POST['records'];
}
else {
	$page = 1; // default page load is 1
	$records_per_page = 5; // default
}

$start_from = ($page - 1) * $records_per_page;


# Begin query processing 
require 'config.php';
$sql = "SELECT * FROM shoes ORDER BY uid ASC LIMIT $start_from, $records_per_page";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
mysqli_close($conn);

# Render table with rows from query
$colCounter = 1;

while($row = mysqli_fetch_assoc($result)) {

	if($colCounter % 3 == 0) $output .= "<div class='row'>";

	$output .= '<div class="col-sm-4" style="cursor: pointer;">';
	$output .= '<span class="thumbnail" style="min-height: 0px" onclick="location.href='."'view_product.php?pid=".$row['uid']."';".'">';
	$output .= '<img src="../'.$row['photo_url'].'" alt="..." width="100%">';
	// $output .= '<div class="ratings">
	//                 <span class="glyphicon glyphicon-star"></span>
	//                 <span class="glyphicon glyphicon-star"></span>
	//                 <span class="glyphicon glyphicon-star"></span>
	//                 <span class="glyphicon glyphicon-star"></span>
	//                 <span class="glyphicon glyphicon-star-empty"></span>
	//             </div>';
	$output .= '<label class="lead"><h2 style="margin-bottom: 0; cursor: pointer">'. $row['name'] .'</h2></label>';
	$output .= '<hr class="line" style="border: 0.5px solid #aaa; margin: 10px 0px">';
	$output .= '<div class="row">
                            <div class="col-md-6 col-sm-6">
                                <p class="price"> &#8369;&nbsp;'. $row['price'] .'</p>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <a href="view_product.php?pid='. $row['uid'] .'">
                                    <button class="btn btn-info pull-right">VIEW ITEM</button>
                                </a>
                           </div>
                            
                        </div>';
	$output .= '</span>';
	$output .= '</div>';

	if($colCounter % 3 == 0) $output .= "</div>"; 
	$colCounter++;
}

$output .= '<br/>';

/**************************************************************/

# Query for total number of records
require 'config.php';
$sql = "SELECT * FROM shoes";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
mysqli_close($conn);


$total_records = mysqli_num_rows($result);
$num_pages = ceil($total_records/$records_per_page);

# Display the pagination UI
$output .= "<div class='row text-center' style='display: block;'>";
$output .="<ul class='pagination'>";

# Previous Button
$output .= "<li><button class='btn btn-default' id='prev-page' style='margin-top: 0px; padding: 0px; min-width: 35px; font-size: 22px; height: 36px'>&laquo;</button></li>";

# Page Numbers
for($i = 1; $i <= $num_pages; $i++) {
	$output .= "
		<span class='pagination-link btn btn-default' style='cursor: pointer; padding: 7px; min-width: 35px;'
			id='";
	$output .= $i;
	$output .= "'>";
	$output .= $i;
	$output .= "</span>";
}

# Next Button
$output .= "<li><button class='btn btn-default' id='next-page' style='margin-top: 0px; margin-left: 4px; padding: 0px; min-width: 35px; font-size: 22px; height: 36px'>&raquo;</button></li>";

$output .= "</ul>";
$output .= "</div>";


# Return output to AJAX Callback function
echo $output;

?>