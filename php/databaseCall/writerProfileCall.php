<?php

$wordSample=$_POST['expertAreaSample'];
$areaName=$_GET['codeName'];
$topic=$_GET['topicName'];


session_start();


$Username = $_SESSION['username'];


include('wpdbConn/dbConn.php');
//connection created

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE writerprofile SET expertArea='".$areaName."', sampleAreaTopic='".$topic."', sampleExpertAreaText	='".$wordSample."'  WHERE email='".$Username."'";

if ($conn->query($sql) === TRUE) {
    
    header("Location: ../../writersHomepage.php");
    
} else {
    header("Location: ../../writersHomepage.php");
}








?>