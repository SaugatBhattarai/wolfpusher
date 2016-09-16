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
					send_push_message($sid);
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			send_push_message($sid);
			// send_push_message("f98tEs-nL_E:APA91bFWUcnqh3FJtUMmaM30PL6MpBlkUjV6mrk-EunVB3bXxr8Qjm1NrhtCqH_iWdQNYDIX0jt9PsmsQxrpLqOzu72lhj_gb6_YyI1QBBnrLhFfaCFw-6BbPv8_v5VW-qKlDYF_poLu");
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
<?php
function send_push_message($subscription_ids){
	var_dump("Here ....");

  // Set GCM endpoint
  $url = 'https://android.googleapis.com/gcm/send';


  $fields = array(
      'registration_ids' => array($subscription_ids)
  );
 
  $headers = array(
      'Authorization:key='."AIzaSyDhx66lA2g02vAXEXQDqb19-DA2yjy5T_4",
      'Content-Type:application/json'
  );
 
 var_dump($headers);
  $ch = curl_init();
 
  // Set the url, number of POST vars, POST data
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($fields));
 
  var_dump("this is curl response");

  // // Execute postr
  $result = curl_exec($ch);
  // if ($result === FALSE) {
  // //     die('Push msg send failed in curl: ' . curl_error($ch));
  // // }
 
 if(!$result)
    {
        trigger_error(curl_error($ch));
    }
else{
	var_dump($result);
	// echo $result;
}
  // Close connection
  curl_close($ch);
}

 ?>