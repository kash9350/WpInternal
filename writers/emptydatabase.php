<?php
include('dbConn.php');
$jobCheck=mysqli_num_rows(mysqli_query($conn, "SELECT ID FROM businesshomepage WHERE claimedWriter='none'"));

$mynotificationexist=mysqli_num_rows(mysqli_query($conn, "SELECT ID FROM notificationWriters WHERE email='".$_SESSION['username']."'"));

$myexistedclaims=mysqli_num_rows(mysqli_query($conn, "SELECT ID FROM writerWpRecord WHERE writeremail='".$_SESSION['username']."'"));

$mysampleexist=mysqli_num_rows(mysqli_query($conn, "SELECT ID FROM writerskillsample WHERE email='".$_SESSION['username']."'"));




function mydisplay($mytemp)
{
    if ($mytemp!=0)
    {
        return 'none';
    }
    else
    {return 'block';}
}

?>