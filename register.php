<?php
 include_once("./library.php"); // To connect to the database
 $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 // Check connection

//error array
 $errors = array(); 



 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }

//check if the password and re-entered password is same
 if ($_POST[password_1] != $_POST[password_2]) {
	echo "The two passwords do not match";
	mysqli_close($con);
  } 

  //check if the input field is not empty -- put up an error message if one of the field is empty
  	
  if (empty($_POST[computingID])) { 
  	echo "computingID is required";
  	mysqli_close($con);
   }
  
  if (empty($_POST[major])) { 
  	echo "Major is required";
  	mysqli_close($con);
   }
   if (empty($_POST[password_1])) { 
  	echo "passwords is required";
  	mysqli_close($con);
   }
   if (empty($_POST[password_2])) { 
  	echo "Reenter password";
  	mysqli_close($con);
   }
  

 // Form the SQL query (an INSERT query)
 $sql="INSERT INTO Users (computingID, major, password)
 VALUES
 ('$_POST[computingID]','$_POST[major]','$_POST[password_1]')";


 if (!mysqli_query($con,$sql))
 {
 die( mysqli_error($con));
 echo "Connection Failed";
 }
 echo "1 record added"; // Output to user
 mysqli_close($con);
?>
