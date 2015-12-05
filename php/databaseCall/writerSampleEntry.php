<?php

$wordSample=$_POST['expertAreaSample'];



$areaName=$_GET['codeName'];
$topic=$_POST['topic'];

function areaSet($name)
{
    switch (true)
    {
        case ($name=="artAndDesign"):
            return "Art and Design";
            break;
        case ($name=="entertainment"):
            return "Entertainment";
            break;
        case ($name=="lifestyleAndTravel"):
            return "Lifestyle and Travel";
            break;
        case ($name=="sportsAndFitness"):
            return "Sports and Fitness";
            break;
        case ($name =="business"):
            return "Business";
            break;
        case ($name=="foodAndBeverage"):
            return "Food and Beverage";
            break;
        case ($name =="publishingAndJournalism"):
            return "Publishing and Journalism";
            break;
        case ($name=="education"):
            return "Education";
            break;
        case ($name=="healthcareAndSciences"):
            return "Healthcare and Sciences";
            break;
        case ($name=="softwareAndTechnology"):
            return "Software and Technology";
            break;
    }
}

$catagory= areaSet($areaName);

session_start();


$Username = $_SESSION['username'];





include('wpdbConn/dbConn.php');



$sectorEntry="topic_".$areaName;


$sampleEntry="sample_".$areaName;

// Created connection $conn 

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$topic=mysqli_real_escape_string($conn, $topic);
$wordSample=mysqli_real_escape_string($conn, $wordSample);

$refInject=mysqli_fetch_object(mysqli_query($conn, "SELECT myReferences FROM writerprofile WHERE email='".$_SESSION['username']."'"));

$references=$refInject->myReferences ;

$existCheck=mysqli_query($conn , "SELECT ID FROM writerskillsample WHERE email='".$Username."' AND catagory='".$catagory."'");

if(mysqli_num_rows($existCheck)==0)
{
	$insertSample="INSERT INTO writerskillsample (email, catagory,  topic, sample, myReferences) VALUES ('$Username', '$catagory', '$topic', '$wordSample', '$references')";
mysqli_query($conn, $insertSample); 
}
else
{
	$updateSample="UPDATE writerskillsample SET topic='".$topic."', sample='".$wordSample."', myReferences='".$references."' WHERE email='".$Username."' AND catagory='".$catagory."'";
	mysqli_query($conn, $updateSample);
}






    





if ($conn->query($sql) === TRUE) {
    
    header("Location: ../../writers");
    
} else {
    header("Location: ../../writers");
}








?>