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
        <title>Writer-Sign Up</title>
        <link rel="icon" type="[MIME TYPE]" href="../images/webicon.png" />
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/writerSignUp.css">
        
        <script>
               
                function passwordmatch()
    {
        
        
        //Store the password field objects into variables ...
        var mypass = document.getElementById('pass1').value;
        var confirminput= document.getElementById('pass2');
        confirminput.setAttribute('pattern', mypass);
            
                    
        
    }  
            </script>
        
    </head>
    <body>
        <div class="bus_signup">
            <a href="../index.html"><img src="../images/full_logo_light2.png"/></a>
            
            <h2>Want To Be A Writer?</h2>
            
            
            <form class='f1' action="databaseCall/signupWriters.php" method="post" onsubmit="return checkForm(this);">
                <fieldset>
                <legend><h3>Let's get you signed up.</h3></legend>
                    <input id='name' class='textbox' type="text" name="fName" placeholder='First name' required="required"> &nbsp; &nbsp; <input id='name' class='textbox' type="text" name="lName" placeholder='Last name' required="required"><br>
                   
                    <input id='other' class='textbox'  title="Should be in the form something@company.com"  type="email" name="email" placeholder='Your Email ID' required="required" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title);"><br>
                    <input id='pass1' class='textbox mypass' type="password" title="Password must contain at least 8 alphanumeric characters" pattern="(?=.*\d)(?=.*[a-z-A-Z]).{8,}" onchange="passwordmatch()" name="pass" placeholder='Password --- Must contain atleast 8 alphanumeric characters' required="required"><br>
                    <input id='pass2' class='textbox mypass' title="Please enter the same Password as above"  pattern="passwordmatch()"  type="password" name="cpass" placeholder='Confirm Password' required="required"><br>
                    <input id='other' class='textbox' type="text" name="mobile" placeholder='Contact Number' required="required"><br>
                    <select id='other' class='textbox' name="experience" required="required" />
                        <option value="">--Experience--</option>
                        <option name="ex" value="1">Starter</option>
                        <option name ="prt" value="2">Part Time</option>
                        <option name ="prof" value="3">Professional</option>
                    </select>
                <h5 id="error"><?php echo $error; ?></h5>
                
                    <button id='create' type="submit" >Sign Up</button><br/>
                    <span>By registering, you agree to our Terms of Use</span>
                </fieldset>
            </form>
        </div>
    </body>
</html>