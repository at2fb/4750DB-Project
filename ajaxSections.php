<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>



<?php
$q = intval($_GET['q']);

$classToAdd = htmlspecialchars($_GET['classToAdd']);

$con = mysqli_connect('cs4750.cs.virginia.edu','rm4mp','Niw6ogha','rm4mp');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

if(!empty($classToAdd)){
    $queryInsert = "INSERT INTO Takes (computingID, sectionID) VALUES ('sj7yj',$classToAdd)";
    mysqli_query($con,$queryInsert);
    
       
}

if(!empty($q)){
    $queryDelete = "DELETE  FROM Takes WHERE computingID= 'sj7yj' AND sectionID=" .$q;
    mysqli_query($con,$queryDelete);
}

mysqli_select_db($con,"rm4mp");
$sql="SELECT * FROM Takes WHERE computingID='sj7yj'";
$result = mysqli_query($con,$sql);


while($row = mysqli_fetch_array($result)) {

    $sql2="SELECT className FROM Class WHERE sectionID=" . $row['sectionID'];
    $result2 = mysqli_query($con,$sql2);
    echo mysqli_fetch_array($result2)[0];
    echo '<button onclick="deleteFunc(' . $row['sectionID'] .')">Delete</button>';


    echo "<br />";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>