<?php
session_start();

// echo $_SESSION['computingID'];

 include_once("./library.php"); // To connect to the database
 $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 // Check connection

$computingIDUser = '\'' + $_SESSION['computingID'] + '\'';
$htmlComputingID = $_SESSION['computingID'];

//get the type of the user
$sql = "SELECT type FROM `Users` WHERE computingID = $computingIDUser";

$type = "";

// Attempt select query execution
if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
                $type = $row['type'];
            
        }
   
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

//Insert query 

// for Students
 $sqlS="INSERT INTO Takes (computingID, sectionID)
 VALUES
 ('$_SESSION[computingID]','$_POST[sectionID]')";

//Instructors
 $sqlI="INSERT INTO Teaches (instructorID, sectionID)
 VALUES
 ('$_SESSION[computingID]','$_POST[sectionID]')";


// 1) if type == student
 if($type == "Student"){
   if (!mysqli_query($con,$sqlS))
   {
   die( mysqli_error($con));
   }
   echo "1 record added"; // Output to user
   
   mysqli_close($con);
 }


// 2) if type == Instructor
 elseif ($type=="Instructor") {
   if (!mysqli_query($con,$sqlI))
   {
   die( mysqli_error($con));
   }
   echo "1 record added"; // Output to user
   
   mysqli_close($con);
 }



?>
