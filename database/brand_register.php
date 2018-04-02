<?php
	if(isset($_POST['registerBrand'])){
		$pass = $_POST['pword'];
		$cpass = $_POST['confirmpword'];

		if($pass == $cpass){
			require 'config.php';
			session_start();

			$uname = $_POST['uname'];

			//Check if username matches another accounts
			$query = "CALL SP_CHECK_UNAME_DUPLICATE('".$uname."');"; 
			echo $query;

			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

			$row = mysqli_fetch_assoc($result);
			var_dump($row);
			mysqli_close();

			if($row['col'] == 'TRUE'){ //Same username as another account
				$error_msg .= "Sorry the username has already been taken!<br>Please try a different username.";
				$_SESSION['error_msg'] = $error_msg;
				$error_path = "../views/register.php?register=" . md5('failed');
				header("Location: $error_path");
				exit();
			}else{
				$brandname = $_POST['brandname'];
				$email = $_POST['email'];

				$numbers = array();
				array_push($numbers, $_POST['number1']);
				$locations = array();
				array_push($locations, $_POST['location1']);

				$counter = 2;
				$flag = true;

				while ($flag) {
					if(isset($_POST['number'.$counter])){
						array_push($numbers, $_POST['number'.$counter]);
						$counter++;
					}else
						$flag = false;
				}

				$counter = 2;
				$flag = true;

				while ($flag) {
					if(isset($_POST['location'.$counter])){
						array_push($locations, $_POST['location'.$counter]);
						$counter++;
					}else
						$flag = false;
				}

	//************************************************************
	//		ADD BRAND INFO
	//************************************************************
				require 'config.php';

				$query = "CALL SP_ADD_BRAND_INFO('".$brandname."','".$uname."','".$pass."','".$email."');";

				echo "$query";

				$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

				$row = mysqli_fetch_assoc($result);
				var_dump($row);

				if($row['result'] == 'SUCCESS')
					echo "STORED BRAND INFO";
				else
					echo "ERROR";	// For Checking purposes

				mysqli_close($conn);
				require 'config.php';
	//**********************************************************
	//		GET REGISTERED BRAND UID
	//***********************************************************

				$query = "CALL SP_GET_BRAND('".$brandname."','".$email."','".$uname."');";

				echo "$query";

				$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

				$row = mysqli_fetch_assoc($result);
				var_dump($row);
				$uid = $row['uid'];
				$username = $row['b_username'];
				$pass = $row['b_password'];

	//**********************************************************
	//		ADD BRAND CONTACTS 	
	//**********************************************************
				
				for ($i=0; $i < sizeof($numbers); $i++) { 
					mysqli_close($conn);
					require 'config.php';

					$query = "CALL SP_ADD_BRAND_CONTACT('".$uid."', '".$numbers[$i]."')"; // Add brand contact numbers

					echo "$query";

					$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

					$row = mysqli_fetch_assoc($result);
					var_dump($row);				
				}
	//*****************************************************
	//		ADD LOCATIONS
	//*****************************************************
				for ($i=0; $i < sizeof($locations); $i++) { 
					mysqli_close($conn);
					require 'config.php';

					$query = "CALL SP_ADD_BRAND_LOCATION('".$uid."', '".$locations[$i]."')"; // Add brand contact numbers

					echo "$query";

					$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

					$row = mysqli_fetch_assoc($result);
					var_dump($row);
					
					if($row['col'] == "SUCCESS")
						echo "STORED LOCATION <BR>";

					
				}

	//*****************************************************
	//		ADD LINKS
	//*****************************************************
			mysqli_close($conn);

			$website = $_POST['website'];
			$facebook = $_POST['facebook'];
			$twitter = $_POST['twitter'];
			$instagram = $_POST['instagram'];



			if(isset($website) && trim($website) != ''){
				require 'config.php';

				$query = "CALL SP_ADD_BRAND_LINK('".$uid."','website','".$website."');";

				echo "$query";

				$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

				$row = mysqli_fetch_assoc($result);
				var_dump($row);

				if($row['col'] == "SUCCESS")
					echo "Stored WEBSITE LINK <BR>";
				else
					echo "ERROR <br>";

				mysqli_close($conn);

			}
			if(isset($facebook) && trim($facebook) != ''){
				require 'config.php';

				$query = "CALL SP_ADD_BRAND_LINK('".$uid."','facebook','".$facebook."');";

				echo "$query";

				$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

				$row = mysqli_fetch_assoc($result);
				var_dump($row);

				if($row['col'] == "SUCCESS")
					echo "Stored FACEBOOK LINK <BR>";
				else
					echo "ERROR <br>";

				mysqli_close($conn);
			}
			if(isset($twitter) && trim($twitter) != ''){
				require 'config.php';

				$query = "CALL SP_ADD_BRAND_LINK('".$uid."','twitter','".$twitter."');";

				echo "$query";

				$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

				$row = mysqli_fetch_assoc($result);
				var_dump($row);

				if($row['col'] == "SUCCESS")
					echo "Stored TWITTER LINK <BR>";
				else
					echo "ERROR <br>";

				mysqli_close($conn);
			}
			if(isset($instagram) && trim($instagram) != ''){
				require 'config.php';

				$query = "CALL SP_ADD_BRAND_LINK('".$uid."','instagram','".$instagram."');";

				echo "$query";

				$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

				$row = mysqli_fetch_assoc($result);
				var_dump($row);

				if($row['col'] == "SUCCESS")
					echo "Stored INSTAGRAM LINK <BR>";
				else
					echo "ERROR <br>";

				mysqli_close($conn);
			}

	//*****************************************************
	//		ADD TO SITE_USERS
	//*****************************************************

			require 'config.php';

				$query = "CALL SP_ADD_SITE_USER('Brand','".$username."','".$pass."');";

				echo "$query";

				$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

				$row = mysqli_fetch_assoc($result);
				var_dump($row);

				if($row['col'] == "SUCCESS")
					echo "Stored SITE USER AS BRAND <BR>";
				else
					echo "ERROR <br>";

				mysqli_close($conn);
				
				$_SESSION['success_msg'] = "Thank you for registering to Shoeversity, ".$uname.".<br> Please wait for your account to be verified before you can log in.";

				$success_path = "../views/index.php?register=" . md5('success');
				header("Location: $success_path");
				//header("Location: ../views/index.php"); //Since brand isnt verifed yet, must be redirected BACK TO GUEST LANDING PAGE
			}
			}

			
	}

?>