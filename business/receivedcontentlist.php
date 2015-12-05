<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    



session_start();
include('dbConn.php');


    $receivelist=$conn->query("SELECT  txnid, orders, topic, dateOrder, dateReceive, quality FROM businesshomepage WHERE receivedStatus='1'");

$outp = "";
while($rs = $receivelist->fetch_array(MYSQLI_ASSOC)) {
    
    
    
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"TransactionID":"'.$rs['txnid']. '",';
    $outp .= '"Ordertype":"'   . $rs['orders']. '",';
    $outp .= '"Amount":"'   . $rs['quality']  . '",';
    $outp .= '"Topic":"'   . $rs['topic']       . '",';
    $outp .= '"ReceiveDate":"'   . $rs['dateReceive']       . '",';
    
    
    
    $outp .= '"OrderDate":"'. $rs["dateOrder"].'"}';
   
}
$outp ='{"receive":['.$outp.']}';
$conn->close();

echo($outp);
?>