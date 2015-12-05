<?php
include("db_conn.php");

if (isset($_POST['writerEmail']) && isset($_POST['comments']))
{
    $writer=$_POST['writerEmail'];
    $comments=$_POST['comments'];
    
    $conn->query("UPDATE writerprofile SET comments='".$comments."' WHERE email='".$writer."'");
}
?>