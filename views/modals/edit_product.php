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
	                <button type="button" class="close" 
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
	                                <input type="text" class="form-control" placeholder="Select an image" readonly>
	                            </div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
	                			<label for="description">Item Description</label>
	                			<textarea class="form-control" id="description" name="description" rows="6" required><?php echo $shoeDesc;?></textarea>
	                		</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="type">Type</label>
										<select class="form-control" id="type" name="type" required>
											<option disabled>--</option>
											<option <?php if($shoeType == 'mens') echo "selected='selected'"; ?> >Mens</option>
											<option <?php if($shoeType == 'womens') echo "selected='selected'"; ?> >Womens</option>
									    </select>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label for="category">Category</label>
										<select class="form-control" id="category" name="category" required>
											<option disabled>--</option>
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
								<div class="col-md-4">
									<div class="form-group">
										<label for="size">Size</label>
										<!-- <div class="input-group">
											<span class="input-group-addon" id="addon-size">
												<img src="../../images/icons/color.png" alt="img">
											</span>	 -->
											<input type="number" class="form-control" id="size" name="size" min="1" max="100" aria-describedby="addon-size" value="<?php echo $shoeSize;?>" required>
										<!-- </div> -->
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label for="color">Color</label>
										<input type="color" class="form-control" id="color" name="color" value="<?php echo $shoeColor;?>" required>
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