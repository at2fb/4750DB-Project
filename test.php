<?php 
session_start();

include_once("./library.php"); // To connect to the database
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

$sectionID = $_POST['sectionID'];
$computingID = $POST['computingID'];

$query = "DELETE FROM Takes WHERE (sectionID= $sectionID AND computingID = $computingID)" ;
mysqli_query($con,$query);
echo 1;
exit;

// if($id > 0){

//     $query = "DELETE FROM Takes WHERE id=".$id;
//     mysqli_query($con,$query);
//     echo 1;
//     exit;

//   // // Check record exists
//   // $checkRecord = mysqli_query($con,"SELECT * FROM posts WHERE id=".$id);
//   // $totalrows = mysqli_num_rows($checkRecord);

//   // if($totalrows > 0){
//   //   // Delete record
//   //   $query = "DELETE FROM posts WHERE id=".$id;
//   //   mysqli_query($con,$query);
//   //   echo 1;
//   //   exit;
//   // }
// }

// echo 0;
// exit;