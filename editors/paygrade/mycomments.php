<?php
include('dbConn.php');

if(isset($_POST['mywpusername']) && isset($_POST['mycomments']) && isset($_POST['mywpareaname']))
{

mysqli_query($conn, "UPDATE writerskillsample SET comments='".$_POST['mycomments']."' WHERE email='".$_POST['mywpusername']."' AND catagory='".$_POST['mywpareaname']."'");
    
}

header('Location: ../paygrade/');
?>