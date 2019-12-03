<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"  media="screen,projection"/>
</head>
<body>



<?php
session_start();

//computingID of the user
$com =  $_SESSION['computingID'];

$q = htmlspecialchars($_GET['q']);
$check = substr($q, 0, 3);


$con = mysqli_connect('cs4750.cs.virginia.edu','sj7yj','?Dndbquddkfl1240','sj7yj');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//get the type of the user
$sqlType = "SELECT type FROM `Users` WHERE computingID = '".$com."'";

$type = "";

// Attempt select query execution
if($result = mysqli_query($con, $sqlType)){
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



//Adding sections into Takes/Teaches
if($check == 'add'){

    //type == Student
    if($type == "Student"){
        $classToAdd = substr($q, 3);
        $classToAdd = intval($classToAdd);
       $queryInsert = "INSERT INTO Takes (computingID,sectionID) VALUES ('".$com."',$classToAdd)";
        mysqli_query($con,$queryInsert);

    } 

    if ($type == "Instructor"){
        $classToAdd = substr($q, 3);
        $classToAdd = intval($classToAdd);
       $queryInsert = "INSERT INTO Teaches (instructorID, sectionID) VALUES ('".$com."',$classToAdd)";

        mysqli_query($con,$queryInsert);
    }
}


//Deleting from Takes/Teaches
if(!empty($q)){
    if($type == "Student"){
    
        $q = intval($q);
        $queryDelete = "DELETE FROM Takes WHERE computingID= '".$com."' AND sectionID=" .$q;
        mysqli_query($con,$queryDelete);

    } 

    if ($type == "Instructor"){
        $q = intval($q);
        $queryDelete = "DELETE FROM Teaches WHERE instructorID= '".$com."' AND sectionID=" .$q;

        mysqli_query($con,$queryDelete);
    }

}


//Loading the data into Table


if($type == "Student"){
    mysqli_select_db($con,"sj7yj");
    $sql="SELECT * FROM Takes WHERE computingID= '".$com."'";
    $result = mysqli_query($con,$sql);
        

        echo "<div class=container>";
        echo "<table >";
            echo "<thead>";
                echo "<tr>";
                    echo "<th> ClassName </th>";
                    echo "<th> </th>";
                echo"</tr>";
            echo"</thead>";

            echo "<tbody>";
              echo "<tr>";
    while($row = mysqli_fetch_array($result)) {

        $sql2="SELECT className FROM Class WHERE sectionID=" . $row['sectionID'];
        $result2 = mysqli_query($con,$sql2);
        echo "<td> ".mysqli_fetch_array($result2)[0]." </td>";
        echo '<td> <button class= "btn" style = "background-color: transparent;box-shadow: none;color: black" onclick="deleteFunc(' . $row['sectionID'] .')">Delete</button></td>';



        //echo "<br />";
    echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";

} 

if ($type == "Instructor"){

    mysqli_select_db($con,"sj7yj");
    $sql="SELECT * FROM Teaches WHERE instructorID= '".$com."'";
    $result = mysqli_query($con,$sql);
        

        echo "<div class=container>";
        echo "<table >";
            echo "<thead>";
                echo "<tr>";
                    echo "<th> ClassName </th>";
                    echo "<th> </th>";
                echo"</tr>";
            echo"</thead>";

            echo "<tbody>";
              echo "<tr>";
    while($row = mysqli_fetch_array($result)) {

        $sql2="SELECT className FROM Class WHERE sectionID=" . $row['sectionID'];
        $result2 = mysqli_query($con,$sql2);
        echo "<td> ".mysqli_fetch_array($result2)[0]." </td>";
        echo '<td> <button class= "btn" style = "background-color: transparent;box-shadow: none;color: black" onclick="deleteFunc(' . $row['sectionID'] .')">Delete</button></td>';



        //echo "<br />";
    echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
}

mysqli_close($con);
?>
</body>
</html>