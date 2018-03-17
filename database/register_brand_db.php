<?php
	if(isset($_POST['registerBrand'])){
		$pass = $_POST['pword'];
		$cpass = $_POST['confirmpword'];

		if($pass == $cpass){
			require 'config.php';



			$brandname = $_POST['brandname'];
			$uname = $_POST['uname'];
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

			// header("Location: ../index.php"); //PLEASE CHANGE THIS TO USER LANDING PAGE
		}
	}

?>