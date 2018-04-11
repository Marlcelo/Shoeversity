<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        	<form action="../../database/brand_add_product.php" method="POST" enctype="multipart/form-data">
	            <!-- Modal Header -->
	            <div class="modal-header" style="background: #37474F; color: #fff; border-radius: 5px 5px 0 0">
	                <button type="button" class="close" style="color:#eee" 
	                   data-dismiss="modal">
	                       <span aria-hidden="true">&times;</span>
	                       <span class="sr-only">Close</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">
	                    Add Product
	                </h4>
	            </div>
	            
	            <!-- Modal Body -->
	            <div class="modal-body">
	                <div class="col-md-12">
	                	<div class="col-md-6">
	                		<div class="form-group">
	                			<label for="name">Shoe Name</label>
	                			<input type="text" class="form-control" id="name" name="name" required>
	                		</div>
	                		<div class="form-group">
	                			<label for="description">Item Description</label>
	                			<textarea class="form-control" id="description" name="description" rows="9" required></textarea>
	                		</div>
						</div>

						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="type">Type</label>
										<select class="form-control" id="type" name="type" required>
											<option selected="selected" disabled>--</option>
											<option>Mens</option>
											<option>Womens</option>
									    </select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="category">Category</label>
										<select class="form-control" id="category" name="category" required>
											<option selected="selected" disabled>--</option>
											<option>Sneakers</option>
											<option>Running</option>
											<option>Training</option>
											<option>Formal</option>
											<option>Casual</option>
									    </select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="size">Size</label>
										<!-- <div class="input-group">
											<span class="input-group-addon" id="addon-size">
												<img src="../../images/icons/color.png" alt="img">
											</span>	 -->
											<input type="number" class="form-control" id="size" name="size" min="1" max="100" aria-describedby="addon-size" required>
										<!-- </div> -->
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="color">Color</label>
										<!-- <input type="color" class="form-control" id="color" name="color" required> -->
										<select class="form-control" id="color" name="color" required>
											<option selected="selected" disabled>--</option>
											<option value="black"  style="background-color: #000000; color: #fff">
												Black
											</option>
											<option value="gray"   style="background-color: #9E9E9E; color: #000">
												Gray
											</option>
											<option value="white"  style="background-color: #ffffff; color: #000">
												White
											</option>
											<option value="red"    style="background-color: #E53935; color: #fff">
												Red
											</option>
											<option value="orange" style="background-color: #FF9800; color: #fff">
												Orange
											</option>
											<option value="yellow" style="background-color: #FFEB3B; color: #000">
												Yellow
											</option>
											<option value="green"  style="background-color: #00C853; color: #000">
												Green
											</option>
											<option value="blue"   style="background-color: #0288D1; color: #fff">
												Blue
											</option>
											<option value="indigo" style="background-color: #3F51B5; color: #fff">
												Indigo
											</option>
											<option value="violet" style="background-color: #9C27B0; color: #fff">
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
									<input type="number" class="form-control" id="price" name="price" min="1" aria-describedby="addon-price" required>
								</div>
							</div>

							<div class="form-group">
								<label for="imgpath">Image</label>
							    <!-- <input type="file" name="imgpath" id="imgpath"> -->
							    <div class="input-group">
	                                <label class="input-group-btn">
	                                    <span class="btn btn-primary">
	                                        Browse<input type="file" style="display: none" name="imgpath" id="imgpath">
	                                    </span>
	                                </label>
	                                <input type="text" class="form-control" placeholder="Select an image" readonly>
	                            </div>
							    <!-- <input type="submit" value="Upload Image" name="submit"> -->
							</div>
	
							<!-- <div class="form-group">
								<label for="price">Price</label>
								<div class="input-group">
									<span class="input-group-addon" id="addon-price">&#8369;</span>
									<input type="number" class="form-control" id="price" name="price" min="1" max="100" aria-describedby="addon-price" required>
								</div>
							</div> -->
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
	                    Add Product
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