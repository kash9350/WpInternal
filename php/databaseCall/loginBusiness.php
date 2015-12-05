<?php



include('wpdbConn/dbLink.php');


if (!$link)
{
	die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db(DB_NAME, $link);

if (!$db_selected)
{
	die('Ca\'t use ' . DB_NAME . ': ' . mysql_error());
}




$Username = $_POST['email'];
$Password = $_POST['pass'] ; 
 
$sql="SELECT email FROM signup_business WHERE email='".$Username."' and password='".$Password."'";
$r = mysql_query($sql);
if(!$r) {
   $err=mysql_error();
   print $err;
   exit();
}
if(mysql_affected_rows()==0){
    header("Location: ../businessLogin.php?attempt=error");
    exit();
}
else{
    session_start();
    $_SESSION['myWpUsername'] = $Username;
    $_SESSION['myWpPassword'] = $Password;
    
    header("Location: ../../business");
    exit();
   //proceed to perform website’s functionality – e.g. present information to the user
}




mysql_close();
?>