<style>
  .paymentInfo h2
  {
  	color:black;
  	font-size:22px;
  	
  }
  .paymentInfo table 
  {
  	color:black ;
  	font-family:Open Sans;
  	font-size:17px;
  }
  
  .paymentInfo input
  {
  	

  }
  
  
  
  ::-webkit-input-placeholder {
    color:    black;
}
:-moz-placeholder {
    color:    black;
}
::-moz-placeholder {
    color:    black;
}
:-ms-input-placeholder {
    color:    black;
}

  
  .paymentInfo button
  {
      
    border:solid;
  	border-width:1px;
  	border-color:#2eb161;
  	background:#2eb161;
      transition:0.3s;
      -webkit-transition:0.3s;
  	
  }
  .paymentInfo button:hover
  {
  	background:#fff;
    color:#2eb161;
      
  }
</style>

<?php


include("dbConn.php");


$myWpUsername=$_SESSION['username'];
$myWPPassword=$_SESSION['password'];


$myResult=mysqli_query($conn, "SELECT ID FROM signup_writers WHERE email='".$myWpUsername."' AND password='".$myWPPassword."'");

if (mysqli_num_rows($myResult)!=0)
{
    
    $transactionSetails=mysqli_fetch_object(mysqli_query($conn, "SELECT bankName, accountNo, accountHolderName, ifscCode, balance FROM wpsecurepayment WHERE email='".$myWpUsername."'"));
    
    $bankName=$transactionSetails->bankName;
    $accountNo=$transactionSetails->accountNo;
    $holderName=$transactionSetails->accountHolderName;
    $ifsc=$transactionSetails->ifscCode;
    $myWpBalance=$transactionSetails->balance;
    
    $temp='';
   
    if ($accountNo=='')
 {
 
    $temp="<h3>Payment details not set</h3>";
 } 
    
echo "


    
                    
    <h3>Balance: ".$myWpBalance."&nbsp;₹</h3> <br>";
    echo "
    <h3 style='color:#2eb161;'>Transaction Details:</h3>
    <hr>
    
    ".$temp."

    
    
   
    <form method='POST' action='../php/databaseCall/bankdetailsUpdate.php'>
    <table class='table'> <tbody>
    <tr class='success'>
        <td>Bank Name:</td>
        <td><input type='text' required placeholder='Enter your bank name' name='bankName' value='".$bankName."'></td>
    </tr>
    
    
    
    <tr class='success'>
        <td>Account number:</td>
        <td><input type='text' required placeholder='Enter your account number' name='bankAccountNo' value='".$accountNo."'></td>
    </tr>
    <tr class='success'>
        <td>Name of account holder:</td>
        <td><input type='text' required placeholder='Enter the holder name' name='accountHolder' value='".$holderName."'>
    <tr class='success'>
        <td>IFSC Code:</td>
        <td><input type='text' required  placeholder='Enter the IFSC code' name='bankIfsc' value='".$ifsc."'>
            <input type='hidden' name='bankuser' value='".$myWpUsername."'>
        </td>
        
    </tr>
   
    </tbody>
    </table>
       <button type='submit' class='btn btn-info btn-lg' style='float:right;'>Update Info</button>
    </form>
    
    
    
    
";
            
    
}



?>