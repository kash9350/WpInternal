<?php

/*
$to = "ashimrajkonwar@gmail.com";
$subject = "Warm welcome";

$message = "
<html>
<head>
<title>Welcome Editors</title>
</head>
<body>
<p>Dear user,</p>
<p>Your account in White Panda's editor side has been successfully created. The username and password is attached below.</p>
<br>

<p>Username: ragini.nath@iitgn.ac.in</p>
<p>Password: n.ragini24365</p>
<br><br><br><br><br><br>


Regards,<br>
Team White Panda

</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: White Panda <support@whitepanda.in>' . "\r\n";
//$headers .= 'Cc: ashimrajkonwar@gmail.com' . "\r\n";

mail($to,$subject,$message,$headers);
echo "done";

*/



$to ="ashimrajkonwar@gmail.com";


$subject = "Warm welcome to Writers";

$message = "Dear 

Your account has been created on whitepanda.in .Kindly click on this link to confirm and access your account: http://www.whitepanda.in/php/databaseCall/emailVerify.php?email=".$email."&activeKey=".$emailActivationcode."<br>
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

?>