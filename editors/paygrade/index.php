<?php
include('dbConn.php');

session_start();
if(isset($_SESSION['mytime']))
{
    if((time() - $_SESSION['mytime'])>1200)
    {
        session_destroy();
    }
}

if(isset($_SESSION['myWpEditorUsername']) && isset($_SESSION['myWpEditorpasskey']))
{
    $result=mysqli_num_rows(mysqli_query($conn, "SELECT ID FROM wpeditors WHERE email='".$_SESSION['myWpEditorUsername']."' AND password='".$_SESSION['myWpEditorpasskey']."'"));
    
    if ($result!=0)
    {
        include("./K45ADQLY34YHSQDHDKTI9KSJWJAFWJFF78.html");
    }
    else
    {
        header("Location: ../../editors/");
    }
}

else
{
    header("Location: ../../editors/");
}
?>