<?php
    if (isset($_GET['attempt']))
    {
        $error='Incorrect Username or Password';
    }
    else
    {
        $error=null;
    }
?>


<html>
    <head>
        <title>Writer-Login</title>
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/Login.css">
        
        
        <script src = "../jquery/login-jquery-1.11.1.js"></script>
    </head>
    <body>
        <div class="bus_login">
            <a href='../index.html'><img  src="../images/full_logo_light2.png"/></a>
            <h1>Writer</h1>
            <h2>Welcome Back</h2>
            
            
            <form class='f1' action="databaseCall/loginWriters.php" method="post">
                <fieldset>
                <legend><h3>Let's get you signed in.</h3></legend>
                    
                    <input required id='other' class='textbox' type="email" name="email" placeholder='Your Email ID' ><br>
                    <input required id='other' class='textbox' type="password" name="pass" placeholder='Password' >
                    <h4 style='color:red;'><?php echo $error; ?></h4>
                  
                    
                    <input  type="checkbox" name="remember" value="remember_me"> Remember me &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; 
                    <a id="forgot" href="#" >Forgot password?</a>
                    <br>
                    
                    <button id='create' type="submit" >Login</button><br/>
                    
                </fieldset>
                
                
                
                
            </form>
            <form class='forgot_pass' action="forgotPassword/forgotWriter.php" method="post" id="passwd">
                <h3>Enter your email id and we will<br> send you a link to reset your password</h3>
                <input required id='other' class='textbox' type="email" name="email" placeholder='Your Email ID' ><br>
				<input name="action" type="hidden" value="password" />
                <button id='create' type="submit" >Send Password Reset Instructions</button>
                
            </form>
    </body>
</html>
