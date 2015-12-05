<?php
include('db_conn.php');
if (isset($_POST['writerEmail']) && isset($_POST['wporderID']))
{
    $myextendedTime=$_POST['extendedTime']." hours";
    $mydateselect=mysqli_fetch_object($conn->query("SELECT ClaimedDateAndTime FROM writerwprecord WHERE claimedOrderID='".$_POST['wporderID']."' AND writeremail='".$_POST['writerEmail']."'"));
    
    $dateclaimed=date_create($mydateselect->ClaimedDateAndTime);
    
    $dateclaimChange=date_add($dateclaimed, date_interval_create_from_date_string($myextendedTime));
    
    $dateFormatTransform=$dateclaimChange->format("Y-m-d H:i:s");
    
    
    $mydateselect=$conn->query("UPDATE writerwprecord SET ClaimedDateAndTime='".$dateFormatTransform."' WHERE claimedOrderID='".$_POST['wporderID']."' AND writeremail='".$_POST['writerEmail']."'");
    
}

    
    
?>