<?php
 include_once("./library.php"); // To connect to the database
 $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 // Check connection

//error array
 $errors = array(); 


//  form validation: ensure that the form is correctly filled ...
//   by adding (array_push()) corresponding error unto $errors array
//   if (empty($_POST[computingID])) { array_push($errors, "computingID is required"); }
//   if (empty($_POST[major])) { array_push($errors, "major is required"); }
//   if (empty($_POST[password_1])) { array_push($errors, "Password is required"); }
//   if ($password_1 != $password_2) {
// 	array_push($errors, "The two passwords do not match");
//   }

// if (count($errors) > 0) {
// 	foreach ($errors as $error) :
// 		echo $error	
// }

 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }

  //check if the input field is not empty --> put up an error message if one of the field is empty
  	
  if (empty($_POST[computingID])) { 
  	echo "computingID is required";
  	mysqli_close($con);
   }
  
   if (empty($_POST[password_1])) { 
  	echo "passwords is required";
  	mysqli_close($con);
   }


 // Form the SQL query (an INSERT query)
 $sql="SELECT computingID, password FROM Users WHERE computingID = $_POST[user] AND password = $_POST[password_1]
 VALUES
 ('$_POST[computingID]','$_POST[major]','$_POST[password_1]')";


 if (!mysqli_query($con,$sql))
 {
 die( mysqli_error($con));
 }
 echo "Login successful"; // Output to user
 mysqli_close($con);
?>
