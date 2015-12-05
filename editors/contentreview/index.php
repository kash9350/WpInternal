<?php
include('db_conn.php');

session_start();

if(isset($_SESSION['mytime']))
{
    if((time() - $_SESSION['mytime'])>2000)
    {
        session_destroy();
    }
}

if(isset($_SESSION['myWpEditorUsername']) && isset($_SESSION['myWpEditorpasskey']))
{
    
    
    
    
    
    $result=mysqli_num_rows(mysqli_query($conn, "SELECT ID FROM wpeditors WHERE email='".$_SESSION['myWpEditorUsername']."' AND password='".$_SESSION['myWpEditorpasskey']."'"));
    
    
    
    if ($result!=0)
    {
        include("./AQ7ETS3GS7ET7993YSHF472SG6FGRTCBM4ZX54D515G580FH45LA4QR454558.html");
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