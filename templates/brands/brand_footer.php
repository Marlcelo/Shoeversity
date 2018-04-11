<?php
	if(!isset($_SESSION)) {
		session_start();
	}
	$token = $_SESSION['sessionToken'];
?>

 <!--Footer-->
 <footer class="footer" id="footer" style="padding-bottom: 0px;">
      
	<!--Footer Links-->
	<div class="container text-center text-md-left">
	    <div class="row">
	        <div class="col-md-4">
	            <h3> Contact </h3>
	            <ul>
	                <li><a href="#">About us</a></li>
	                <li>shoeversityofficial@gmail.com</li>
	            </ul>
	        </div>
	        <div class="col-md-4">
	            <h3> Important Links </h3>
	            <ul>
	                <li> <a href="../../views/brands/products.php?token=<?php echo $token ?>"> Products </a> </li>
	                <li> <a href="../../views/brands/account.php?token=<?php echo $token ?>"> My Account </a> </li>
	                <li> <a href="../../database/logout.php"> Logout </a> </li>
	            </ul>
	        </div>
	        <div class="col-md-4">
	            <h3> Lost? </h3>
	            <ul>
	                <li> 
		                <form action="" class="navbar-form" role="search" style="width: 100%">
			                <div class="input-group" style="margin-left: 0px">
			    	            <input type="text" class="form-control" placeholder="Search" name="search-product" required>
		                        <div class="input-group-btn">
		                            <button class="btn btn-primary" type="submit" style="margin-top: 0px">
		                            <i class="glyphicon glyphicon-search"></i>
		                            </button>
		                        </div>
		                    </div>
	                	</form>
	            	</li>
	         		</ul>
	     	</div>
  		</div>
	</div>

		<!--Copyright-->
	<div class="footer-bottom"  style="margin-top: 30px;">
		<div class="container">
		    <p class="pull-left"> Copyright © 2018, Lachica, Medina, Ricanor. All rights reserved.</p>
		    <div class="pull-right">
		        <ul class="nav nav-pills payments">
		            <li><i class="fa fa-cc-visa"></i></li>
		            <li><i class="fa fa-cc-mastercard"></i></li>
		            <li><i class="fa fa-cc-amex"></i></li>
		            <li><i class="fa fa-cc-paypal"></i></li>
		        </ul>
		    </div>
		</div>
	</div>
	<!--/.Copyright-->

</footer>
<!--/.Footer-->
