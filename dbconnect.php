
<?php
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = 'root';

   $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
   echo "string";
   if(! $conn )
   {
     die('Could not connect: ' . mysql_error());
   }
   // echo 'Connected successfully';
   mysqli_select_db( $conn, 'wolfpusher' );
?>
