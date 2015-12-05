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




function errorChk($sql)
{
    if (!mysql_query($sql))
    {
	   die('Error: ' . mysql_error());
    }
}


$fName =$_POST['fName'];
$lName =$_POST['lName'];
$email =$_POST['email'];
$pass =$_POST['pass'];
$mobile =$_POST['mobile'];
$experience =$_POST['experience'];


$date=date("Y-m-d H:i:s");


$emailCk="SELECT email FROM signup_writers WHERE email='".$email."'";

$r = mysql_query($emailCk);

$emailActivationcode=rand(111111,999999);

if((mysql_affected_rows()==0)) {
    
    $sql ="INSERT INTO signup_writers (firstName, lastName, email, password, mobile, signUp_dateTime, experience, emailActivationCode) VALUES ('$fName', '$lName', '$email', '$pass', '$mobile', '$date', '$experience', '$emailActivationcode')";


 

$to = $email;

$subject = "Warm welcome to Writers";

$message = "Dear ".$fName." ".$lName.",<br><br>

Your account has been created on whitepanda.in .Kindly click on this link to confirm and access your account: http://www.whitepanda.in/php/databaseCall/emailVerify.php?email=".$email."&activeKey=".$emailActivationcode."<br><br>
A very warm welcome to White Panda. You are now part of one of the nation’s biggest community of freelance writers. Being a part of White Panda you now get access to a large job feed in your area of expertise.<br>
1.	Visit the Writer Workbench and click on job search.<br>
2.	Click on the link at the top to give a topic proficiency test.<br>
3.	After completing the proficiency test, our editors will assign you a paygrade within 24 hours. Once that is assigned, you may start applying for jobs in your industry using the job search option.<br><br>
Kindly go through the attached FAQ sheet for more details. In case of any queries, feel free to mail us support@whitepanda.in<br><br><br><br>

Regards,<br>
Team White Panda

";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: White Panda <whitepanda@writers.com>' . "\r\n";

mail($to,$subject,$message,$headers);

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    errorChk($sql);
   
   
}

else{
     header("Location: ../writerSignUp.php?attemp=1");
    exit();
    
}










mysql_close();
header("Location: ../../afterWriterSignUpEmailVerify.html");
?>