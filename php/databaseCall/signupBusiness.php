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






$fName =$_POST['fName'];
$lName =$_POST['lName'];
$email =$_POST['email'];
$pass =$_POST['pass'];
$mobile =$_POST['mobile'];
$company=$_POST['company'];


$date=date("Y-m-d H:i:s");

$emailCk="SELECT email FROM signup_business WHERE email='".$email."'";

$r = mysql_query($emailCk);


if((mysql_affected_rows()==0)) {
  
  
  
    
   
$sql ="INSERT INTO signup_business (firstName, lastName, email, password, mobile, signUp_dateTime, company) VALUES ('$fName', '$lName', '$email', '$pass', '$mobile', '$date', '$company')";







$to = $email;
$subject = "Warm welcome to clients";

$message = "Dear ".$fName." ".$lName.",<br><br>

Yay! You’ve joined the White Panda family! <br>
Your account has been successfully created. Now generating quality content for your websites, blogs and social media accounts has become as easy as 1...2...3 <br><br>
What next? <br>
1. Visit the Business Workbench and click on ‘Order now’.<br>
2. Enter details regarding the content you need.<br>
3. Enter your payment details. <br><br>
Et Voila! White Panda-certified content delivered to your inbox in five business days! You even have a 72-hour window to get us to rework any bits you’re not 100% satisfied with. It really doesn’t get better than this!<br><br><br><br>


Regards,<br>
Team White Panda
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: White Panda <whitepanda@business.com>' . "\r\n";

mail($to,$subject,$message,$headers);






$to = "ashimrajkonwar@gmail.com, aditya.ganesh@iitgn.ac.in, roshan.agarwal@iitgn.ac.in, bhaskar.jyoti@iitgn.ac.in";
$subject = "New client";

$message = "Dear Admins,<br>
<br> A new client named ".$fName." ".$lName." with email id ".$email." has signed up.<br><br><br>






Cheer up<br>
Team White Panda";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: White Panda <whitepanda@business.com>' . "\r\n";

mail($to,$subject,$message,$headers);



//$headers .= 'Cc: ashimrajkonwar@gmail.com, aditya.ganesh@iitgn.ac.in, roshan.agarwal@iitgn.ac.in, bhaskar.jyoti@iitgn.ac.in' . "\r\n";

//mail($to,$subject,$message,$headers);








    
    mysql_query($sql);
   header("Location: ../../afterBusinessSignUp.html");
    
    exit();
   
   
}

else{
     header("Location: ../businessSignUp.php?attemp=1");
    
    exit();
    
}









mysql_close();
?>