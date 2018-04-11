<?php
	$shoeID = $_SESSION['shoeID'];

	require '../../database/config.php';
	$sql = "CALL SP_GET_SHOE($shoeID)";
	$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    while($row = mysqli_fetch_assoc($result)) {
        $shoeID    = $row['uid'];
        $shoeName  = $row['name'];
        $shoeDesc  = $row['description'];
        $shoeType  = $row['type'];
        $shoeCateg = $row['category'];
        $shoePrice = $row['price'];
        $shoeSize  = $row['size'];
        $shoeColor = $row['color'];
        $shoeImg   = "../".$row['photo_url'];
    }
    mysqli_close($conn);

    $_SESSION['shoeImg'] = $row['photo_url'];
?>

<div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        	<form action="../../database/brand_edit_product.php" method="POST" enctype="multipart/form-data">
	            <!-- Modal Header -->
	            <div class="modal-header" style="background: #37474F; color: #fff; border-radius: 5px 5px 0 0">
	                <button type="button" class="close" style="color:#eee" 
	                   data-dismiss="modal">
	                       <span aria-hidden="true">&times;</span>
	                       <span class="sr-only">Close</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">
	                    Edit Product
	                </h4>
	            </div>
	            
	            <!-- Modal Body -->
	            <div class="modal-body">
	                <div class="col-md-12">
	                	<div class="col-md-6">
	                		<div class="form-group">
	                			<label for="name">Shoe Name</label>
	                			<input type="text" class="form-control" id="name" name="name" value="<?php echo $shoeName;?>" required>
	                		</div>
	
							<img src="<?php echo $shoeImg; ?>" alt="..." width="100%">

	                		<div class="form-group">
							    <div class="input-group">
	                                <label class="input-group-btn">
	                                    <span class="btn btn-primary">
	                                        Browse<input type="file" style="display: none" name="imgpath" id="imgpath">
	                                    </span>
	                                </label>
	                                <input type="text" class="form-control" placeholder="Select an image" onkeydown="return false;" style="background: #eee" required>
	                            </div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
	                			<label for="description">Item Description</label>
	                			<textarea class="form-control" id="description" name="description" rows="6" required><?php echo $shoeDesc;?></textarea>
	                		</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="type">Type</label>
										<select class="form-control" id="type" name="type" required>
											<option <?php if($shoeType == 'mens') echo "selected='selected'"; ?> >Mens</option>
											<option <?php if($shoeType == 'womens') echo "selected='selected'"; ?> >Womens</option>
									    </select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="category">Category</label>
										<select class="form-control" id="category" name="category" required>
											<option <?php if($shoeCateg == 'Sneakers') echo "selected='selected'"; ?>>
												Sneakers
											</option>
											<option <?php if($shoeCateg == 'Running') echo "selected='selected'"; ?>>
												Running
											</option>
											<option <?php if($shoeCateg == 'Training') echo "selected='selected'"; ?>>
												Training
											</option>
											<option <?php if($shoeCateg == 'Formal') echo "selected='selected'"; ?>>
												Formal
											</option>
											<option <?php if($shoeCateg == 'Casual') echo "selected='selected'"; ?>>
												Casual
											</option>
									    </select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="size">Size</label>
										<input type="number" class="form-control" id="size" name="size" min="1" max="100" aria-describedby="addon-size" value="<?php echo $shoeSize;?>" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="color">Color</label>
										<select class="form-control" id="color" name="color" required>
											<option <?php if($shoeColor == 'black') echo "selected='selected'"; ?> style="background-color: #000000; color: #fff" value="black">
												Black
											</option>
											<option <?php if($shoeColor == 'gray') echo "selected='selected'"; ?> style="background-color: #9E9E9E; color: #000" value="gray">
												Gray
											</option>
											<option <?php if($shoeColor == 'white') echo "selected='selected'"; ?> style="background-color: #ffffff; color: #000" value="white">
												White
											</option>
											<option <?php if($shoeColor == 'red') echo "selected='selected'"; ?> style="background-color: #E53935; color: #fff" value="red">
												Red
											</option>
											<option <?php if($shoeColor == 'orange') echo "selected='selected'"; ?> style="background-color: #FF9800; color: #fff" value="orange">
												Orange
											</option>
											<option <?php if($shoeColor == 'yellow') echo "selected='selected'"; ?> style="background-color: #FFEB3B; color: #000" value="yellow">
												Yellow
											</option>
											<option <?php if($shoeColor == 'green') echo "selected='selected'"; ?> style="background-color: #00C853; color: #000" value="green">
												Green
											</option>
											<option <?php if($shoeColor == 'blue') echo "selected='selected'"; ?> style="background-color: #0288D1; color: #fff" value="blue">
												Blue
											</option>
											<option <?php if($shoeColor == 'indigo') echo "selected='selected'"; ?> style="background-color: #3F51B5; color: #fff" value="indigo">
												Indigo
											</option>
											<option <?php if($shoeColor == 'violet') echo "selected='selected'"; ?> style="background-color: #9C27B0; color: #fff" value="">
												Violet
											</option>	
									    </select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="price">Price</label>
								<div class="input-group">
									<span class="input-group-addon" id="addon-price">&#8369;</span>
									<input type="number" class="form-control" id="price" name="price" min="1" aria-describedby="addon-price" value="<?php echo $shoePrice;?>" required>
								</div>
							</div>
						</div>
	                </div>
	            </div>

				<br/>
	            
	            <!-- Modal Footer -->
	            <div class="modal-footer" style="border-top: none">
	                <button type="button" class="btn bnt-default" style="background: #eee" data-dismiss="modal">
	                    Cancel
	                </button>
	                &nbsp;
	                <!-- <a href=""> -->
	                <button type="submit" name="submit" class="btn btn-info">
	                    Save Changes
	                </button>
		            <!-- </a> -->
	            </div>
	        </form>

        </div>
    </div>
</div>

<!-- this is for displaying filename on textinput (shoe img uploads) -->
<script type="text/Javascript">
    $(function() {
        // We can attach the `fileselect` event to all file inputs on the page
        $(document).on('change', ':file', function() {
            var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        // We can watch for our custom `fileselect` event like this
        $(document).ready( function() {
            $(':file').on('fileselect', function(event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }

            });
        });
    });
</script>