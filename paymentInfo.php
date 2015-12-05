<?php

header("Location: facebook.com");
include("wpdbConn/dbConn.php");

session_start();
$myWpUsername=$_SESSION['username'];
$myWPPassword=$_SESSION['password'];

echo '<h1>ssassas</h1>';
$myResult=mysqli_query($conn, "SELECT ID FROM signup_writers WHERE email='".$myWpUsername."' AND password='".$myWpPassword."'");

if (mysqli_num_rows($myResult)!=0)
{
    
    $transactionSetails=mysqli_fetch_object(mysqli_query($conn, "SELECT bankName, accountNo,    accountHolderName, ifscCode, balance FROM wpsecurepayment WHERE email='".$myWpUsername."'"));
    
    $bankName=$transactionSetails->bankName;
    $accountNo=$transactionSetails->accountNo;
    $holderName=$transactionSetails->accountHolderName;
    $ifsc=$transactionSetails->ifscCode;
    $myWpBalance=$transactionSetails->balance;
    
    
echo "
<table>
    <h2>Transaction:</h2>
                    <hr>
    <tr>
        <td>Balance:</td>
        <td>".$myWpBalance."</td>
    </tr>
    
    <tr>
    <form action='php/databaseCall/askingPayment.php' method='POST' >
        <td>Ask for transaction</td>
        <td><input type='text' name='askingValue'/> <button type='submit' >Request Transaction </button> </td>
        </form>
    </tr>
    <br><br><br>
    <h2>Transaction Details</h2>
    <hr>";
 if ($accountNo=='')
 {
    echo "<h3>Payment details not set</h3>"
 }
    
    echo "
    <form method='POST' action='php/databaseCall/bankdetailsUpdate.php'>
    <tr>
        <td>Bank Name:</td>
        <td><input type='text' name='bankName' value='".$bankName."'/></td>
    </tr>
    
    
    
    <tr>
        <td>Account number:</td>
        <td><input type='text' name='bankName' value='".$accountNo."'/></td>
    </tr>
    <tr>
        <td>Name of account holder:</td>
        <td><input type='text' name='bankName' value='".$holderName."'/></td>
    </tr>
    <tr>
        <td>IFSC Code:</td>
        <td><input type='text' name='bankName' value='".$ifsc."'/></td>
    </tr>
    
       <button type='submit'>Update Info</button>
    </form>
    
    
    
    
</table>"
            
    
}



?>

