<div class="modal fade" id="add_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-danger">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background: #3498DB  ; color: #fff; border-radius: 5px 5px 0 0">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add a shoe for sale!
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="form-horizontal text-center" name="" action="">
                   <div class="input-group">
                           <span class="input-group-addon">Name</span>
                           <input type="text" class="form-control text-center" name="productname" placeholder="Converse" required>
                    </div><br>
                    <div class="input-group">
                             <span class="input-group-addon">Description</span>
                             <textarea class="form-control text-center" name="description" rows="5" placeholder="Amazing"></textarea>
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-addon">Category</span>
                        <select class="form-control text-center" id="category" name="category" style="width:100%;">
                          <option>Mens sneakers</option>
                          <option>Mens formal</option>
                          <option>Womens casual</option>
                          <option>Womens sneakers</option>
                        </select>
                    </div><br>
                    <div class="input-group">
                           <span class="input-group-addon">Size</span>
                           <input type="number" class="form-control text-center" name="size" value="7" required>
                    </div><br>
                    <div class="input-group">
                           <span class="input-group-addon">Price in PhP</span>
                           <input type="number" class="form-control text-center" name="price" value="0" required>
                    </div><br>
                    <div class="input-group">
                           <span class="input-group-addon">Color</span>
                           <input type="text" class="form-control text-center" name="color" placeholder="Red" required>
                    </div><br>
                    
                    <div class="input-group" style="width:100%; margin-bottom: 20px;">
                        <div class="input-group input-file" name="">
                            <input type="text" class="form-control" placeholder='Choose a file...' name="photo_url"/>
                                <span class="input-group-addon">Choose</span>
                        </div>
                    </div>
                
            </div>
            
	            <!-- Modal Footer -->
	            <div class="modal-footer form-group controls" style="border-top: none">
	                <input type="button" class="btn btn-info" value="Sell product" data-dismiss="modal">
	            </div>
			</form>
        </div>
    </div>
</div>
