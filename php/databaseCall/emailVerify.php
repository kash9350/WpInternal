<?php


include('wpdbConn/dbConn.php');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email=$_GET['email'];
$getCode=$_GET['activeKey'];

 
$sql="SELECT emailActivationCode, firstName, lastName FROM signup_writers WHERE email='".$email."'";
$con1=mysqli_fetch_object(mysqli_query($conn, $sql));
        
$activationKey=$con1->emailActivationCode ;
$fName=$con1->firstName;
$lName=$con1->lastName;

if ($getCode==$activationKey)  
{
	$sql2 = "UPDATE signup_writers SET email_activation='1' WHERE email='".$email."'";
	mysqli_query($conn, $sql2);
	
	
	
	

$to = "ashimrajkonwar@gmail.com, aditya.ganesh@iitgn.ac.in, roshan.agarwal@iitgn.ac.in, bhaskar.jyoti@iitgn.ac.in";
$subject = "New client";

$message = "Dear Admins,<br>
<br> A new Writer named ".$fName." ".$lName." with email id ".$email." has signed up.<br><br><br>






Cheer up<br>
Team White Panda";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: White Panda <whitepanda@business.com>' . "\r\n";

mail($to,$subject,$message,$headers);
	
	
	
	
	
	

	header("Location: ../writerLogin.php");
}
        
  
    


?>