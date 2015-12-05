<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include('dbConn.php');
session_start();

    $jobfeed=$conn->query("SELECT mysubject, myNotification, date FROM notificationWriters WHERE email='".$_SESSION['username']."'");


$outp = "";
while($rs = $jobfeed->fetch_array(MYSQLI_ASSOC)) {
    
    
    
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Subject":"'.$rs['mysubject']. '",';
    $outp .= '"Notification":"'   . $rs['myNotification']       . '",';
   
    $outp .= '"Date":"'. $rs["date"].'"}';
   
}
$outp ='{"notifications":['.$outp.']}';
$conn->close();

echo($outp);
?>