<?php
include('dbConn.php');
if(isset($_POST['username']) && isset($_POST['password']))
{
    $results=mysqli_num_rows(mysqli_query($conn, "SELECT ID FROM wpeditors WHERE email='".$_POST['username']."' AND password='".$_POST['password']."'"));
    
    if ($results!=0)
    {
        session_start();
        $_SESSION['myWpEditorUsername']=$_POST['username'];
        $_SESSION['myWpEditorpasskey']=$_POST['password'];
        $_SESSION['mytime']=time();
        header("Location: ./select.html");
        
    }
    else
    {
        header("Location: ../editors/");
    }
}

else
{
    header("Location: ../editors/");
}
?>