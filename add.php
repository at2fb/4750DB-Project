<?php 

$classToAdd = htmlspecialchars($_GET['q']);
echo $classToAdd;

$con = mysqli_connect('cs4750.cs.virginia.edu','sj7yj','?Dndbquddkfl1240','sj7yj');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

if(!empty($classToAdd)){
    $queryInsert = "INSERT INTO Takes (computingID, sectionID) VALUES ('sj7yj',$classToAdd)";
    mysqli_query($con,$queryInsert);
    
       
}
?>