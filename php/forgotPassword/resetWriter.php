<?php
include('db.php');
$message="";
if(isset($_GET['action']))
{          
    if($_GET['action']=="reset")
    {
        $encrypt = $_GET['encrypt'];
        $username= $_GET['user'];
        $query = "SELECT ID FROM signup_writers where email='".$username."'";
        $result = mysqli_query($connection,$query);
        $Results = mysqli_fetch_array($result);
        $idEncrypy=md5(90*13+$Results['ID']);
        
        if($idEncrypy!=$encrypt)
        {
		header("location: ../writerLogin.php");
        }

    }
}
elseif(isset($_POST['action']))
{
    
    $encrypt      = $_POST['action'];
    $username	  = $_POST['email'];
    $password     = mysqli_real_escape_string($connection, $_POST['password']);
    $query = "SELECT ID FROM signup_writers where email='".$username."'";
        $result = mysqli_query($connection,$query);
        $Results = mysqli_fetch_array($result);
        $idEncrypy=md5(90*13+$Results['ID']);
    if($idEncrypy==$encrypt)
    {
        $query = "UPDATE signup_writers SET password='".$password."' WHERE email='".$username."'";
        mysqli_query($connection,$query);
//        echo $query;
	header("location: ../writerLogin.php");
        
    }
    else
    {
        header("location: ../writerLogin.php");
    }
}
else
{
    header("location: ../writerLogin.php");
}

?>
<head>  
	<title>Password Reset</title>
  	<link rel="stylesheet" type="text/css" href="../../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../../css/writerSignUp.css">
</head>

<body>

<div class="bus_signup">
            <a href='../../index.html'><img  src="../../images/full_logo_light2.png"/></a>
            
            <h2>Forgot your password!</h2>
            
            
            <form class='f1' action="resetWriter.php" method="post" id="reset">
                <fieldset>
                <legend><h3>Reset Your Password here</h3></legend>
                  <input id='other' class='textbox' type="password" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title);
  if(this.checkValidity()) form.cpass.pattern = this.value;
"  placeholder='Password --- Must contain upercase, lowercase and numbers' required="required" name="password" /><br>
                  <input id='other' class='textbox' title="Please enter the same Password as above"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title);
" type="password" placeholder='Confirm Password' required="required" name="password2" /><br>
                  <input name="action" type="hidden" value="<?php echo $encrypt; ?>" />
                  <input name="email" type="hidden" value="<?php echo $username; ?>" />
                  <button style='width:150px' id='create' type="submit" >Reset Password</button>
                </fieldset>
            </form>

</div>
</body>



        