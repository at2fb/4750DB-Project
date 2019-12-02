<?php
session_start();

$computingIDUser = '\'' + $_SESSION['computingID'] + '\'';

include_once("./library.php"); // To connect to the database
$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

$sql = "SELECT sectionID FROM `Takes` WHERE computingID = '$computingIDUser'";

$result = mysqli_query($con, $sql);

$data = array();

if($result = mysqli_query($con, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
           array_push($data, $row);             
        }
   
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

// while ($row = mysqli_fetch_array($result))
// {
//     array_push($data, $row['sectionID']);
// }

echo json_encode($data);
exit();

?>