<?php

function emptyCkeck($temp)
{
    if ($temp=="")
    {
        return "Not mentioned";
    }
    else
    {
        return $temp;
    }
}

function payGrade($temp)
{   
    switch ($temp)
    {
        case 200:
            return "Novice";
            break;
        case 400:
            return "Journey Man";
            break;
        case 800:
            return "Veteran";
            break;
        case 1600:
            return "Expert";
            break;
        default:
            return "null";
    }
}
?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include('db_conn.php');

//$writerprofile = $conn->query("SELECT email, claimedOrderID, uploadedFilename FROM writerprofile WHERE uploaded='1'");

$orderDetails=$conn->query("SELECT txnid, topic, industry_of_experience, email, orders, quality, noOfPosts, goal, style_of_writing, sample_blog, point_of_view, blog_structure, target_audience, key_points, things_to_avoid, keywords, special_instructions, claimedWriter, claimedStatus, dateOrder FROM businesshomepage WHERE receivedStatus='0'");

$outp = "";
while($rs = $orderDetails->fetch_array(MYSQLI_ASSOC)) {
    
    
    

    
    
date_default_timezone_set('Asia/Calcutta');
$thisdate=date("Y-m-d H:i:s");

$date1=date_create($rs['dateOrder']);
$date2=date_create($thisdate);


$deliveryDate=date_add($date1, date_interval_create_from_date_string("120 hours"));
$diff=date_diff($date2, $deliveryDate);
//echo $diff->format("%R%h");
$mydateformat=$diff->format("%a:%h:%i:%R");
$mydatearray=  explode(":", $mydateformat);  
    
$myhours=$mydatearray[0]*24 + $mydatearray[1];

$mymin= $mydatearray[2];
$finalTime= $myhours." hrs ".$mymin." min";
if ($mydatearray[3]=='-')
{
	$finalTime="Timeup";
    $myhours="IsNegative";
} 
    
    $firstname="";
    $lastname="";
    
    
    
    $writername=mysqli_fetch_object($conn->query("SELECT firstName, lastName FROM signup_writers WHERE email='".$rs['claimedWriter']."'"));
    

   
    
    
    
    
    
    $payGrade=mysqli_fetch_object($conn->query("SELECT paygrade FROM writerskillsample WHERE email='".$rs['claimedWriter']."' AND catagory='".$rs['industry_of_experience']."'"));
    
    $mypaygrade='';
    $fileuploadstatus=0;
    $uploadedFilename="";
    if ($rs['claimedWriter']!='none')
    {
        $firstname=$writername->firstName;
        $lastname=$writername->lastName;
        $mypaygrade=$payGrade->paygrade;
        
        $writerprofile = mysqli_fetch_object($conn->query("SELECT  finalstatus, uploadedFilename FROM writerwprecord WHERE claimedOrderID='".$rs['txnid']."' AND writeremail='".$rs['claimedWriter']."'"));
        
        
        if ($writerprofile->finalstatus=="Uploaded")
        {
            $fileuploadstatus=1;
        }
        $uploadedFilename=$writerprofile->uploadedFilename;
    

    }
    
    
    
    
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Name":"'  . $firstname." ".$lastname. '",';
    $outp .= '"OrderID":"'   . $rs['txnid']       . '",';
    $outp .= '"Myhours":"'   . $finalTime. '",';
    $outp .= '"Myonlyhours":"'   . $myhours. '",';
    
    $outp .= '"FileUploadStatus":"'   . $fileuploadstatus. '",';
    $outp .= '"Filename":"'   . $uploadedFilename. '",';
    $outp .= '"Email":"'   . $rs['claimedWriter']        . '",';
    $outp .= '"Area":"'    . $rs['industry_of_experience']. '",';
    $outp .= '"Skill":"'   . payGrade($mypaygrade) . '",';
    $outp .= '"Budget":"'  . $rs['quality']       . '",';
    $outp .= '"Client":"'  . $rs['email']       . '",';
    $outp .= '"Topic":"'   . $rs['topic']       . '",';
    $outp .= '"Catagory":"'. $rs['orders']       . '",';
    $outp .= '"Numberofpost":"'   . $rs['noOfPosts']       . '",';
    $outp .= '"Goal":"'   . emptyCkeck($rs['goal'])       . '",';
    $outp .= '"StyleofWriting":"'   . emptyCkeck($rs['style_of_writing'])      . '",';
    $outp .= '"Sample":"'   . emptyCkeck($rs['sample_blog'])      . '",';
    $outp .= '"PointofView":"'   . emptyCkeck($rs['point_of_view'])      . '",';
    $outp .= '"Structure":"'   . emptyCkeck($rs['blog_structure'])     . '",';
    $outp .= '"TargetAudience":"'   . emptyCkeck($rs['target_audience'])     . '",';
    $outp .= '"Keypoints":"'   . emptyCkeck($rs['key_points'])    . '",';
    $outp .= '"Avoid":"'   . emptyCkeck($rs['things_to_avoid'])     . '",';
    $outp .= '"Keywords":"'   . emptyCkeck($rs['keywords'])    . '",';
    $outp .= '"SpecialInstructions":"'   . emptyCkeck($rs['special_instructions']). '"}';
   
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>