<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    



session_start();
include('dbConn.php');


    $receivecheck=mysqli_num_rows(mysqli_query($conn, "SELECT  ID FROM businesshomepage WHERE receivedStatus='1'"));
    $ordercheck=mysqli_num_rows(mysqli_query($conn, "SELECT  ID FROM businesshomepage WHERE email='".$_SESSION['myWpUsername']."'"));

$outp = "";

    
   
    $outp .= '{"ReceiveQuery":"'.$receivecheck. '",';
  
    $outp .= '"OrderQuery":"'. $ordercheck.'"}';
   

$outp ='{"myQueries":['.$outp.']}';
$conn->close();

echo($outp);
?>