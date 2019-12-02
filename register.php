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

  //check if the input field is not empty --> put up an error message if one of the field is empty
  	
  if (empty($_POST[computingID])) { 
  	echo "computingID is required";
  	mysqli_close($con);
   }
  
  // if (empty($_POST[major])) { 
  // 	echo "Major or Department is required";
  // 	mysqli_close($con);
  //  }
   if (empty($_POST[password_1])) { 
  	echo "passwords is required";
  	mysqli_close($con);
   }
   if (empty($_POST[password_2])) { 
  	echo "Reenter password";
  	mysqli_close($con);
   }
  

 // Form the SQL query (an INSERT query)

//for Users for student
$sqlU1="INSERT INTO Users (computingID, major, password, type)
 VALUES
 ('$_POST[computingID]','$_POST[major]','$_POST[password_1]', 'Student')";

//for Users for instructor
$sqlU2="INSERT INTO Users (computingID, major, password, type)
 VALUES
 ('$_POST[computingID]','$_POST[depart]','$_POST[password_1]', 'Instructor')";


// for Students
 $sqlS="INSERT INTO Student (computingID, major)
 VALUES
 ('$_POST[computingID]','$_POST[major]')";

//Instructors
 $sqlI="INSERT INTO Instructor (instructorID, department)
 VALUES
 ('$_POST[computingID]','$_POST[depart]')";


//addes the data into the User table & student table
 if (!empty($_POST[major])){
  //for User 
    if (!mysqli_query($con,$sqlU1))
   {
   die( mysqli_error($con));
   }
   // echo "1 record added"; // Output to user

   //for student
    if (!mysqli_query($con,$sqlS))
   {
   die( mysqli_error($con));
   }
   // echo "1 record added"; // Output to user
   
   mysqli_close($con);
   header( "Location: login.html" ); 
 }

//addes the data into the User table & instructor table
 else if (!empty($_POST[depart])){
  //for User 
    if (!mysqli_query($con,$sqlU2))
   {
   die( mysqli_error($con));
   }
   // echo "1 record added"; // Output to user

   //for student
    if (!mysqli_query($con,$sqlI))
   {
   die( mysqli_error($con));
   }
   // echo "1 record added"; // Output to user 
   mysqli_close($con);
   header( "Location: login.html" ); 
 }


?>
