<?php 
include('db_conn.php');

if (isset($_POST['writerEmail']))
{
    $writerEmail=$_POST['writerEmail'];
    
    $conn->query("UPDATE writerprofile SET canClaim='1' WHERE email='".$writerEmail."'");
    $conn->query("UPDATE businesshomepage SET claimedWriter='none' WHERE txnid='".$_POST['wprderID']."'");
    $conn->query("UPDATE writerwprecord SET finalstatus='Rejected' WHERE claimedOrderID='".$_POST['wprderID']."' AND writeremail='".$writerEmail."'");
    
}
?>