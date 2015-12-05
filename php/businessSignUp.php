<?php
    if (isset($_GET['attemp']))
    {
        $error='The email you have entered is already registered.';
    }
    else
    {
        $error=null;
    }
?>

<html>
    <head>
        <title>Business-Sign Up</title>
        <link rel="icon" type="[MIME TYPE]" href="../images/webicon.png" />
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        
        <link rel="stylesheet" type="../text/css" href="../css/businessSignUp.css">
    </head>
    <body>
        <div class="bus_signup">
            <a href="../index.html"><img src="../images/full_logo_light2.png"/></a>
            <h1>Business</h1>
            <h2>You Are Just A Few Steps Behind</h2>
            
            
           <script>
               
                function passwordmatch()
    {
        
        
        //Store the password field objects into variables ...
        var mypass = document.getElementById('pass1').value;
        var confirminput= document.getElementById('pass2');
        confirminput.setAttribute('pattern', mypass);
            
                    
        
    }  
            </script>
            
            
            
            
            <form class='f1' action='databaseCall/signupBusiness.php'  method="post" onsubmit="return checkForm(this);">
                <fieldset>
                <legend><h3>Let's get you signed up.</h3></legend>
                    <input id='name' class='textbox' type="text" name="fName" placeholder='First name' required="required"> &nbsp; &nbsp; <input id='name' class='textbox' type="text" name="lName" placeholder='Last name' required="required"><br>
                    <input id='other' class='textbox' type="text" name="company" placeholder='Name of your Company' ><br>
                    <input id='other' class='textbox' type="text" name="mobile" placeholder='Contact Number' required="required"><br>
                    <input id='other' class='textbox' type="email" name="email" placeholder='Your Email ID' required="required" title="Should be in the form something@company.com" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title);"><br>
                    <input id='pass1' class='textbox mypass' type="password" title="Password must contain at least 8 alphanumeric characters" pattern="(?=.*\d)(?=.*[a-z-A-Z]).{8,}" name="pass" placeholder='Password --- Must contain atleast 8 alphanumeric characters' required="required" onchange="passwordmatch()"><br>
                    <input id='pass2' class='textbox mypass' title="Please enter the same Password as above"   type="password" name="cpass" placeholder='Confirm Password' required="required"><br>
                    <h5 id="error" style="color:red;"><?php echo $error; ?></h5>
                    <button id='create'  type="submit" >Sign Up</button><br/>
                    <span>By registering, you agree to our Terms of Use</span>
                </fieldset>
            </form>
        </div>
    </body>
</html>