<?php
include('db.php');
if(isset($_POST['action']))
{          
    
    if($_POST['action']=="password")
    {
        $email      = mysqli_real_escape_string($connection,$_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // Validate email address
        {
            header("location: ../writerLogin.php");
        }
        else
        {
        	
            $query = "SELECT ID FROM signup_writers where email='".$email."'";
            $result = mysqli_query($connection,$query);
            $Results = mysqli_fetch_array($result);
            
            if(count($Results)>=1)
            {
                $encrypt = md5(90*13+$Results['ID']);
                $message = "Your password reset link send to your e-mail address.";
                $to=$email;
                $subject="Forgot Password";
                $from = 'info@whitepanda.in';
                $body='Hi, <br/> <br/>Forgot your password? <br><br>Click here to reset your password http://www.whitepanda.in/php/forgotPassword/resetWriter.php?encrypt='.$encrypt.'&user='.$email.'&action=reset   <br/> <br/>--<br>whitepanda.in<br>Your Destination for Content Marketing.';
                $headers = "From: " . strip_tags($from) . "\r\n";
                $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                
                mail($to,$subject,$body,$headers);
                
                //$query = "SELECT id FROM users where md5(90*13+id)='".$encrypt."'";
//                $Results = mysqli_fetch_array($result);
//                print_r($Results);
//                $message = $encrypt. $query;
		header("location: ../../forgotPassword.html");
            }
            else
            {
                header("location: ../writerLogin.php");
            }
        }
    }
}


?>