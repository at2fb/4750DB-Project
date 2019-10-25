<?php
session_start();

// initializing variables
// $username = "";
// $email    = "";
$errors = array(); 

// connect to the database
// $db = mysqli_connect('localhost', 'root', '', 'registration');
include_once("./library.php"); // To connect to the database
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
// Check connection
 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }


// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $computingID = mysqli_real_escape_string($db, $_POST['computingID']);
  $major = mysqli_real_escape_string($db, $_POST['major']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($computingID)) { array_push($errors, "Username is required"); }
  if (empty($major)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM Users WHERE computingID='$computingID' LIMIT 1";
  $result = mysqli_query($con, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['computingID'] === $computingID) {
      array_push($errors, "computingID already exists");
    }

   }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password_1);//encrypt the password before saving in the database

    $query = "INSERT INTO Users (computingID, major, password) 
          VALUES('$computingID', '$major', '$password')";
    mysqli_query($con, $query);
    $_SESSION['computingID'] = $computingID;
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php');
  }
}

if (!mysqli_query($con,$sql))
 {
 die('Error: ' . mysqli_error($con));
 }
 echo "1 record added"; // Output to user
 mysqli_close($con);
 ?>

// ... 