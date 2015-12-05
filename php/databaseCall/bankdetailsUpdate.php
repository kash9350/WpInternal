<?php
include('wpdbConn/dbConn.php');
if (isset($_POST['bankName']) && isset($_POST['bankAccountNo']) && isset($_POST['accountHolder']) && isset($_POST['bankIfsc']) && isset($_POST['bankuser'] ))
{
	$bankName=$_POST['bankName'];
	$accountNo=$_POST['bankAccountNo'];
	$accountHolder=$_POST['accountHolder'];
	$ifsc=$_POST['bankIfsc'];
	$bankUsername=$_POST['bankuser'];
	
	mysqli_query($conn, "UPDATE wpsecurepayment SET bankName='".$bankName."', accountNo='".$accountNo."', accountHolderName='".$accountHolder."', ifscCode='".$ifsc."' WHERE email='".$bankUsername."'");
	
	
	
}

header("Location: ../../writers/");
?>