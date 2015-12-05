<?php
session_start();
    
$Username = $_SESSION['username'];
$Password = $_SESSION['password'] ; 
if (isset($_SESSION['username']) && isset($_SESSION['password']))
{
    

include 'algo.php';
$score=0;



if (isset($_POST['one']))

{
    $servername = "localhost";
$username = "wpRootDatabase";
$password = "orthrox";
$dbname = "whitepanda";


$conn = new mysqli($servername, $username, $password, $dbname);

$temp=$_POST['one'];

$sql = "SELECT determiner2_ques, determiner2_ans1, determiner2_ans2, determiner3_ques, determiner3_ans1, determiner3_ans2, determiner3_ans3, determiner4_ques, determiner4_ans1, determiner4_ans2, determiner4_ans3	, determiner4_ans4, scramble1_qsn, scramble1_ans, scramble2_qsn, scramble2_ans, scramble3_qsn, scramble3_ans, scramble4_qsn, scramble4_ans, wordGame1_qsn, wordGame1_opt1, wordGame1_opt2, wordGame1_ans1, wordGame1_ans2, wordGame2_qsn, wordGame2_opt1, wordGame2_opt2, wordGame2_ans1, wordGame2_ans2, wordGame3_qsn, wordGame3_opt1, wordGame3_opt2, wordGame3_ans1, wordGame3_ans2 FROM writertestquestions WHERE ID='".$temp."'";
    
    $con1=mysqli_fetch_object(mysqli_query($conn, $sql));
    
        
  
    function det_score($determiner_ans, $sel_name, $row)
    {
        
        
        global $score;
        
        if ($_POST[$sel_name]==$determiner_ans[$row])
        {
            $score+=1;
            
        }
    }
    
    function scramble_score($scramble_ans, $sel_name)
    {
        
        global $score;
        
        if ($_POST[$sel_name]==$scramble_ans)
        {
            $score+=3;
            
        }
    }
    
    
    function wordGame($word_ans, $sel_name, $optArr)
    {

        global $score;
        
        if ($_POST[$sel_name]==$word_ans[$optArr])
        {
            $score+=1;
        }
    }
    
    
    $determiner2_ans=array($con1->determiner2_ans1, $con1->determiner2_ans2);
    $determiner3_ans=array($con1->determiner3_ans1, $con1->determiner3_ans2, $con1->determiner3_ans3);
    $determiner4_ans=array($con1->determiner4_ans1, $con1->determiner4_ans2, $con1->determiner4_ans3, $con1->determiner4_ans4);
    
    $scramble1_ans=$con1->scramble1_ans;
    $scramble2_ans=$con1->scramble2_ans;
    $scramble3_ans=$con1->scramble3_ans;
    $scramble4_ans=$con1->scramble4_ans;
    
    $wordGame1_ans=array($con1->wordGame1_ans1, $con1->wordGame1_ans2);
    $wordGame2_ans=array($con1->wordGame2_ans1, $con1->wordGame2_ans2);
    $wordGame3_ans=array($con1->wordGame3_ans1, $con1->wordGame3_ans2);
    
    
    det_score($determiner2_ans, 'fill1', 0);
    det_score($determiner2_ans, 'fill2', 1);
    
    det_score($determiner3_ans, 'fill3', 0);
    det_score($determiner3_ans, 'fill4', 1);
    det_score($determiner3_ans, 'fill5', 2);
    
    det_score($determiner4_ans, 'fill6', 0);
    det_score($determiner4_ans, 'fill7', 1);
    det_score($determiner4_ans, 'fill8', 2);
    det_score($determiner4_ans, 'fill9', 3);
    
    scramble_score($scramble1_ans, "scramble1");
    scramble_score($scramble2_ans, "scramble2");
    scramble_score($scramble3_ans, "scramble3");
    scramble_score($scramble4_ans, "scramble4");
    
    wordGame($wordGame1_ans, "wordGame1", 0);
    wordGame($wordGame1_ans, "wordGame2", 1);
    wordGame($wordGame2_ans, "wordGame3", 0);
    wordGame($wordGame2_ans, "wordGame4", 1);
    wordGame($wordGame3_ans, "wordGame5", 0);
    wordGame($wordGame3_ans, "wordGame6", 1);
    
    
}




include('databaseCall/wpdbConn/dbLink.php');

if (!$link)
{
	die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db(DB_NAME, $link);

if (!$db_selected)
{
	die('Ca\'t use ' . DB_NAME . ': ' . mysql_error());
}



if ($score>10)
{
       
    $sql2="UPDATE signup_writers SET score='$score' WHERE email='$Username'";
    


mysqli_query($conn, $sql2);

    $myProfileEmailQuery=mysqli_query($conn, "SELECT ID FROM writerprofile WHERE email='".$Username."'");
    
    if (mysqli_num_rows($myProfileEmailQuery)==0)
    {
    	mysqli_query($conn, "INSERT INTO writerprofile (email) VALUES ('$Username')");
    }
    
    $myPaymentDetails=mysqli_query($conn, "SELECT ID FROM wpsecurepayment WHERE email='".$Username."'");
    
    
    if (mysqli_num_rows($myPaymentDetails)==0)
    {
        $writerName=mysqli_query($conn, "SELECT firstName, lastName FROM signup_writers WHERE email='".$Username."'");
        
        $nameResult=mysqli_fetch_object($writerName);
        $fulName=$nameResult->firstName . " ".$nameResult->lastName;
        
    	mysqli_query($conn, "INSERT INTO wpsecurepayment (email, name) VALUES ('$Username', '$fulName')");
    }
    
    header("Location: ../afterWriterTestPageredirect.html");
    
}

else
{
        session_start();
    session_destroy();
    header("Location: ../afterWriterTestPage.html");
    exit();
}






mysql_close();
}

else   {
    header("Location: writerLogin.php");
}

?>