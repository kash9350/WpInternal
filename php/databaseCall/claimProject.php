<?php
include('wpdbConn/dbConn.php');


if (isset($_POST["orderID"]) && isset($_POST["username"]) && isset($_POST["OrderedDate"]))
{
    
    $writer="SELECT canClaim FROM writerprofile WHERE email='".$_POST['username']."'";
    
    $orderedDate=$_POST["OrderedDate"];
    
    $business="SELECT quality, industry_of_experience FROM businesshomepage WHERE txnid='".$_POST["orderID"]."'";
    
    $resultBusiness=mysqli_fetch_object(mysqli_query($conn, $business));
    $contentQuality=$resultBusiness->quality;
    $expertArea=$resultBusiness->industry_of_experience;

    
    $writerGrade="SELECT paygrade FROM writerskillsample WHERE email='".$_POST['username']."' AND catagory='".$expertArea."'" ;


    
    $result=mysqli_query($conn, $writerGrade);
    
    /*Check if writer is previously rejected*/
    $checkRejection=mysqli_query($conn, "SELECT finalstatus FROM writerwprecord WHERE writeremail='".$_POST['username']."' AND claimedOrderID='".$_POST["orderID"]."'");
    
    
    $gradeFetch=mysqli_fetch_object($result);  
    $payGrade=$gradeFetch->paygrade;
    $resultWriter=mysqli_fetch_object(mysqli_query($conn, $writer));
    $anyClaim=$resultWriter->canClaim;
    
    switch (true)
    {
        case (mysqli_num_rows($result)==0):
            {
                $message="You have to submit a sample on this catagory to take this project";
                break;
            }
            
        case (mysqli_num_rows($checkRejection)!=0):
            {
                $message="You cannot claim this project as you have been previously rejected in this project.";
                break;
            }
            
        
            
        case ($anyClaim==0):
            {
                $message=$anyClaim."You have already claimed a project. Finish it to claim another one";
                break;
            }
            
        case (($payGrade+ ($payGrade/4)) < $contentQuality):
            {
                $message="Your profile doesn't meet the required skill level";
                break;
            }
            
        
            
        case (($payGrade+ ($payGrade/4)) >= $contentQuality):
            {
                
                
                
                 date_default_timezone_set('Asia/Calcutta');
	$date=date("Y-m-d H:i:s");
    
    
    $businessDatabase="UPDATE businesshomepage SET claimedWriter='".$_POST["username"]."', claimedStatus='1', claimedDate='".$date."' WHERE txnid='".$_POST["orderID"]."'";
    
    
    $writerDatabase="UPDATE writerprofile SET canClaim='0' WHERE email='".$_POST["username"]."'";
    
    $writerhistory= "INSERT INTO writerWpRecord (writeremail, claimedOrderID, budget, finalstatus, ClaimedDateAndTime, OrderedDateAndTime) VALUES ('".$_POST['username']."', '".$_POST['orderID']."', '".($contentQuality-($contentQuality/5))."', 'Claimed', '".$date."', '".$orderedDate."' )";
 
    
    mysqli_query($conn, $businessDatabase);
    mysqli_query($conn, $writerDatabase);
    mysqli_query($conn, $writerhistory);
    
    
	$mywriterclaim =mysqli_query($conn, "SELECT orders, quality, noOfPosts, deliveryTime, topic, industry_of_experience, goal, style_of_writing, sample_blog, point_of_view, blog_structure, target_audience, key_points, things_to_avoid, keywords, special_instructions, dateOrder FROM businesshomepage WHERE txnid='".$_POST["orderID"]."'");
	
	$mywritername=mysqli_query($conn, "SELECT firstName, lastName FROM signup_writers WHERE email='".$_POST["username"]."'");
	
	$claimedmails= $mywriterclaim->fetch_array(MYSQLI_ASSOC);
    	
    	$writerName=$mywritername->fetch_array(MYSQLI_ASSOC);
    	
    	
    	$clientorderdate=date_create($claimedmails['dateOrder']);
    	
    	//$editorsubmissiondate=date_add($clientorderdate, date_interval_create_from_date_string("96 hours"));
    	
    	$thistime=date_create($date);
    	
    	$mytimediff=date_diff($clientorderdate, $thistime);
    	
    	$timediffinhours=($mytimediff->format("%a"))*24 + ($mytimediff->format("%h"));
    	
    	if ( $timediffinhours>60)
    	{
    		$remainingtimetosubmit=96-$timediffinhours;
    	}
    	else
    	{
    		$remainingtimetosubmit=36;
    	}
    	
    	$writersubmitdate=date_add($thistime, date_interval_create_from_date_string($remainingtimetosubmit." hours"));

	$writersubmitdateformat= date_format($writersubmitdate,"l jS \of F Y h:i:s A");
    	
    	
    	
    	
     $to = $_POST["username"];
$subject = "Claimed Job";

	$fullname=$writerName['firstName']." ".$writerName['lastName'];


$message = "Dear ".$fullname.",<br><br>
You have applied for ".$claimedmails['orders'].". The details are as follows:<br><br>



<div style='max-width:600px;margin-left:auto;margin-right:auto;background-color:#1295c9;color:white;padding:5px'>
    <div style='text-align:center;padding:5px 0; font-size:26px;'><b>Your Content Details</b></div>
    <div style='background-color:#f4f4f4;padding:10px;margin-top:6px'>
 
    <table style='width:100%; color:black'>
        <thead>
            <tr style='font-size:19px;'>
                <td>Topic: ".$claimedmails['topic']."</td>
                <td></td>
                
            </tr> 
            
        </thead>   
        
        <tbody style='background:#D9EDF7; border:solid;'>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Catagory</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$claimedmails['orders']."</td>
            </tr>
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>No. of Posts</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$claimedmails['noOfPosts']."</td>
            </tr>
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Industry of experience</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$claimedmails['industry_of_experience']."</td>
            </tr>
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Stipend</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Rs. ".($claimedmails['quality']-($claimedmails['quality']/5))."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Goal</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$claimedmails['goal']."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Style of writing</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$claimedmails['style_of_writing']."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Content Sample</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$claimedmails['sample_blog']."</td>
            </tr>
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Point of view</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$claimedmails['point_of_view']."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Content Structure</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$claimedmails['blog_structure']."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Type of Target Audience</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$claimedmails['target_audience']."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Keypoints</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$claimedmails['key_points']."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Things to avoid</td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$claimedmails['things_to_avoid']."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Keywords </td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$claimedmails['keywords']."</td>
            </tr>
            
            <tr>
                <td style='background:#D9EDF7; border:none; padding:20px;'>Special Instructions </td>
                <td style='background:#D9EDF7; border:none; padding:20px;'>".$claimedmails['special_instructions']."</td>
            </tr>
          
        </tbody>
    </table>
 
 </div>
 </div>


<br><br>
The Submission is due on ".$writersubmitdateformat.". Please note that failing to submit the job or submitting the job late may have consequences. So please make it a point to stick to this deadline. <br><br><br><br>
Regards,<br>
Team White Panda";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: White Panda <whitepanda@business.com>' . "\r\n";

mail($to,$subject,$message,$headers);
    

        
        
        $message="This project is now on your claimed list. Your submission deadline is on ".$writersubmitdateformat.".";
       
            }
    }
    
  
    
    
}

    

?>
<!DOCTYPE html>
<html>
    <head>
        <script src="../../bootstrap/jquery.min.js"></script>
      <link rel="stylesheet" href = "../../bootstrap/bootstrap.min.css">
      <script type="text/javascript" 
  src="../../bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript">
    $(window).load(function(){
        $('#myModal').modal('show');
    });
</script>



<script>
function redir()
{
	window.location = "../../writers";
}
</script>
    </head>
    <body>

<div class="container">
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onclick="redir()">&times;</button>
          <h4 class="modal-title">Dear <?php echo $_POST["username"]; ?></h4>
        </div>
        <div class="modal-body">
          <p><?php echo $message; ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="redir()">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

</body>
</html>