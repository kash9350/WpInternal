<?php



include('wpdbConn/dbLink.php');




$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$link)
{
	die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db(DB_NAME, $link);

if (!$db_selected)
{
	die('Ca\'t use ' . DB_NAME . ': ' . mysql_error());
}

function errorChk($sql)
{
    if (!mysql_query($sql))
    {
	   die('Error: ' . mysql_error());
    }
}


$Username = $_POST['email'];
$Password = $_POST['pass'] ; 
 
$sql="SELECT email FROM signup_writers WHERE email='".$Username."' and password='".$Password."'";
$r = mysql_query($sql);
if(!$r) {
   $err=mysql_error();
   print $err;
   exit();
}
if(mysql_affected_rows()==0){
    header("Location: ../writerLogin.php?attempt=error");
    exit();
}
else{
    session_start();
    $_SESSION['username'] = $Username;
    $_SESSION['password'] = $Password;
    
    
    $require="SELECT email_activation, sampleAreaExpert, testLimit, score FROM signup_writers WHERE email='".$Username."'";
    
    $con1=mysqli_fetch_object(mysqli_query($conn, $require));
    
    $emailActive=$con1->email_activation;
    $sampleExpert=$con1->sampleAreaExpert;
    $testLimit=$con1->testLimit;
    $score=$con1->score;
    
    
    
    if ($emailActive==0)
    {
        header("Location: ../writerLogin.php?attempt=error");
        session_destroy();
    }
    else
    {
        if ($testLimit<4)
        {
            if ($score>10)
            {
                $emailCk="SELECT email FROM writerprofile WHERE email='".$Username."'";
                $r2 = mysql_query($emailCk);
                if((mysql_affected_rows()==0))
                {
                    $sql2 ="INSERT INTO writerprofile (email) VALUES ('$Username')";
                    errorChk($sql2);
                }
                header("Location: ../../writers/");
            }
            else
            {
                header("Location: ../../writerTest.html");
            }
            
        }
        else
        {
            header("Location: ../writerLogin.php?attempt=error");
            session_destroy();
        }
        
    }
    
    exit();
   //proceed to perform website’s functionality – e.g. present information to the user
}




mysql_close();
?>