<?php

if (isset($_POST['areaEngaged']) && $_POST['pastEngaged']=='yes')
{
    $areaEngaged=$_POST['areaEngaged'];
}
else
{
    $areaEngaged[0]='none';
}


$everEngaged=$_POST['pastEngaged'];
$currentOcupation=$_POST['currentOccu'];
$gender=$_POST['gender'];
$areaEngagedString='';

   
    foreach ( $areaEngaged as $myvar)
    {
        $areaEngagedString=$areaEngagedString .$myvar . ', ';
    }





session_start();


$Username = $_SESSION['username'];


include('wpdbConn/dbConn.php');

// connection $conn created

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE writerprofile SET engaged_in_contentProfession='".$everEngaged."', contentDivision_Profession='".$areaEngagedString."', currentOccupation='".$currentOcupation."', gender='".$gender."' WHERE email='".$Username."'";

if ($conn->query($sql) === TRUE) {
    $sql2="UPDATE writerprofile SET permanentEntry='1' WHERE email='".$Username."'";
    $conn->query($sql2);
    header("Location: ../../writers");
    
} else {
    header("Location: ../../writers");
}

$conn->close();

?>