<?php 
		require 'dbconnect.php';
		// var_dump('00');die();
		if($_GET['act']=="sub"){
			// var_dump('check here');die();
			$sid = $_GET["sid"];
			// var_dump($sid);
			$sql = "INSERT INTO subunsub VALUES ('$sid')";
			
			// var_dump($sql);die();
			// var_dump($conn);
			//$retval = mysqli_query( $conn, $sql);
			if (mysqli_query($conn, $sql)) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

			mysqli_close($conn);
		}
		elseif($_GET['act']=="unsub"){
			$sid = $_GET["sid"];

			$sql = "DELETE FROM subunsub WHERE sid='$sid'";

			if (mysqli_query($conn, $sql)) {
			    echo "Deleted rows successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);
		}


?>
	