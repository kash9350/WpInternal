



<?php


$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="lkXTUXtR";



If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 
       if ($hash != $posted_hash) {
	       echo "<h1>Invalid Transaction. Please try again. Transaction details are invalid</h1>";
		   }
	   else {
	  
         
          echo "<h3>Thank You For your Order</h3>";
          
     
        
		   } 
		   
		   


		   
		    
		         
?>	



  
    
  
  


<?php

if(isset($_POST['txnid']))
{
include("wpdbConn/dbConn.php");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

session_start();
	   
    $dataEntry3=$_SESSION['orders'];
    $quality=$_SESSION['quality'];
    $dataEntry1=$_SESSION['noOfPosts'];
    $dataEntry2=$_SESSION['deliveryTime'];
    $topic=$_SESSION['topic'];
    $industry=$_SESSION['industry_of_experience'];
    $goal=$_SESSION['goal'];
    $styleOfWriting=$_SESSION['style_of_writing'];
    $sampleBlog=$_SESSION['sample_blog'];
    $pointOfView=$_SESSION['point_of_view'];
    $blogStructure= $_SESSION['blog_structure'];
    $targetAudience=$_SESSION['target_audience'];
    $keyPoints=$_SESSION['key_points'];
    $avoid=$_SESSION['things_to_avoid'];
    $keywords=$_SESSION['keywords'];
    $specialInstructions=$_SESSION['special_instructions'];
    
    
    
    
date_default_timezone_set('Asia/Calcutta');

$date=date("Y-m-d H:i:s");



//$sql = "UPDATE businesshomepage SET confirmed='1' WHERE txnid = '".$txnid."' ";

$sql ="INSERT INTO businesshomepage (email, txnid, orders, quality, noOfPosts, deliveryTime, topic, industry_of_experience, goal, style_of_writing, sample_blog, point_of_view, blog_structure, target_audience, key_points, things_to_avoid, keywords, special_instructions, amountPaid, dateOrder) VALUES ('$email', '$txnid', '$dataEntry3', '$quality', '$dataEntry1', '$dataEntry2', '$topic', '$industry', '$goal', '$styleOfWriting', '$sampleBlog', '$pointOfView', '$blogStructure', '$targetAudience', '$keyPoints', '$avoid', '$keywords', '$specialInstructions', '$quality', '$date')";





function emptycheck($myvalue)
{
    if ($myvalue!='' || $myvalue!=0)
    {
        return $myvalue;
    }
    else
    {
        return '---';
    }
}


if ($conn->query($sql) === TRUE) {
    
    $to = $email;
$subject = "Order review";




$message = "Dear ".$firstname.",<br><br>
You have placed an order of ".$dataEntry3." on Whitepanda. Your order id is ".$txnid.". Please find the details of the content you have ordered below.<br><br><br>



<div style='max-width:600px;margin-left:auto;margin-right:auto;background-color:#1295c9;color:white;padding:5px'>
    <div style='text-align:center;padding:5px 0; font-size:26px;'><b>Your Content Details</b></div>
    <div style='background-color:#f4f4f4;padding:10px;margin-top:6px'>
 
    <table style='width:100%; color:black;'>
        <thead>
            <tr style='font-size:19px;'>
                <td>Topic: ".$topic."</td>
                <td></td>
                
            </tr> 
            
        </thead>   
        
        <tbody style='background:#D9EDF7; border:solid;'>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Catagory</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$dataEntry3."</td>
            </tr>
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>No. of Posts</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$dataEntry1."</td>
            </tr>
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Industry of experience</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$industry."</td>
            </tr>
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Amount</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Rs. ".$quality."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Goal</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".emptycheck($goal)."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Style of writing</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".emptycheck( $styleOfWriting)."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Content Sample</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".emptycheck($sampleBlog)."</td>
            </tr>
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Point of view</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".emptycheck($pointOfView)."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Content Structure</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".emptycheck( $blogStructure)."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Type of Target Audience</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".emptycheck($targetAudience)."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Keypoints</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".emptycheck($keyPoints)."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Things to avoid</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".emptycheck($avoid)."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Keywords </td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".emptycheck($keywords)."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Special Instructions </td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".emptycheck($specialInstructions)."</td>
            </tr>
          
        </tbody>
    </table>
 
 </div>
 </div>









<br><br>
If you feel some changes need to be made to your order, feel free to mail us on support@whitepanda.in<br><br><br><br>
Regards,<br>
Team White Panda";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: White Panda <whitepanda@business.com>' . "\r\n";

mail($to,$subject,$message,$headers);
    
    
    

$to = "ashimrajkonwar@gmail.com, aditya.ganesh@iitgn.ac.in, roshan.agarwal@iitgn.ac.in, bhaskar.jyoti@iitgn.ac.in";
$subject = "New client";

$message = "Dear Admins,<br>
<br> A new client named ".$firstname." with email id ".$email." has placed an order of an amount of Rs.".$quality.".<br><br><br>






Cheer up<br>
Team White Panda";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: White Panda <whitepanda@business.com>' . "\r\n";

mail($to,$subject,$message,$headers);
    
    
    
    
    
    
} 
else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
}


?>
<html>
    <head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
      
      <link rel="stylesheet" href = "http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
      <script type="text/javascript" 
  src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

   
    </head>
    <style>
		    html { 
		  background: url('https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTRa42yysmeUy-k4VRBZvNvx0CmZC2rSnBP5XdLP7z7Lc35fpprew') no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		} 
    </style>
    <style type="text/css">
    .bs-example{
    	margin: 80px;
    }
    </style>
    
    <body>
    <div class="bs-example">
    <div class="panel panel-primary">
  <div class="panel-heading">Transaction details</div>
  <div class="panel-body">
    <h4>Thank You. Your order status is <?php echo $status; ?>.</h3>
    <h4>Your Transaction ID for this transaction is  <?php echo $txnid; ?></h4>
    <h4>We have received a payment of Rs. <?php echo  $amount; ?>. Your order will soon be shipped.</h4>
    

  </div>
</div>
</div>
<div class="progress" style="width:80%;margin-left:10%">
          
    <div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%;" >
      Redirecting to home
    </div>
  </div>

    </body>
 </html>
 
 <script>
 setTimeout(function () {
       window.location.href = "http://www.whitepanda.in/business"; //will redirect to your blog page (an ex: blog.html)
    }, 3000);
 </script>