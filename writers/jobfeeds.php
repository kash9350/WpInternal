<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include('dbConn.php');
    
    date_default_timezone_set('Asia/Calcutta');
$mydate=date("Y-m-d H:i:s");

$datex=date_create($mydate);



function myCompare($orderedOn)
    {
    
    	global $datex;
    	$orderedOn=date_create($orderedOn);
    	
    	
    	if(date_add($datex, date_interval_create_from_date_string("-96 hours"))>= $orderedOn)
    	{
    		return "ThisExpired";
    	}
    	
    	
    	
    	
    }
$orderWritersTimeout=mysqli_query($conn, "SELECT txnid, dateOrder, writerUploaded FROM businesshomepage WHERE claimedWriter NOT LIKE 'none' OR editorReview='0'");


while ($orderStatusUpdate=  $orderWritersTimeout->fetch_array(MYSQLI_ASSOC))
{
	switch (true)
	{
		case((myCompare($orderStatusUpdate['dateOrder'])=='ThisExpired') && ($orderStatusUpdate['writerUploaded']=='0')):
		{
			
			mysqli_query($conn, "UPDATE businesshomepage SET claimedWriter='none', editorReview='1' WHERE txnid='".$orderStatusUpdate['txnid']."'");
			
			break;
		}
		
		case (myCompare($orderStatusUpdate['dateOrder'])=='ThisExpired'):
		{
			mysqli_query($conn, "UPDATE businesshomepage SET editorReview='1' WHERE txnid='".$orderStatusUpdate['txnid']."'");

			break;	
		}
	}
	
}



$mynewdate=date_add($datex, date_interval_create_from_date_string("-96 hours"));

$mymainhourformat=date_format($mynewdate,"Y-m-d H:i:s");


    $jobfeed=$conn->query("SELECT email, txnid, orders, topic, quality,industry_of_experience, noOfPosts, deliveryTime, goal, style_of_writing, sample_blog, point_of_view, blog_structure, target_audience, key_points, things_to_avoid, keywords,special_instructions, dateOrder   FROM businesshomepage WHERE claimedWriter='none' AND editorReview='0'");


$outp = "";
while($rs = $jobfeed->fetch_array(MYSQLI_ASSOC)) {
    
    
    
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Ordertype":"'.$rs['orders']. '",';
    $outp .= '"Topic":"'   . $rs['topic']       . '",';
    $outp .= '"Client":"'   . $rs['email']       . '",';
    $outp .= '"WpTransactionID":"'   . $rs['txnid']       . '",';
    $outp .= '"NoOfPosts":"'   . $rs['noOfPosts']       . '",';
    $outp .= '"DeliveryTime":"'   . $rs['deliveryTime']       . '",';
    $outp .= '"Goal":"'   . $rs['goal']       . '",';
    $outp .= '"Styleofwriting":"'   . $rs['style_of_writing']       . '",';
    $outp .= '"ContentSample":"'   . $rs['sample_blog']       . '",';
    $outp .= '"Pointofview":"'   . $rs['point_of_view']       . '",';
    $outp .= '"ContentStructure":"'   . $rs['blog_structure']       . '",';
    $outp .= '"TargetAudience":"'   . $rs['target_audience']       . '",';
    $outp .= '"Keypoints":"'   . $rs['key_points']       . '",';
    $outp .= '"Thingstoavoid":"'   . $rs['things_to_avoid']       . '",';
    $outp .= '"Keywords":"'   . $rs['keywords']       . '",';
    $outp .= '"SpecialInstructions":"'   . $rs['special_instructions']       . '",';
    $outp .= '"Budget":"'   . ($rs['quality'] -($rs['quality']/5))      . '",';
   $outp .= '"OrderedDate":"'   . $rs['dateOrder']       . '",';
    $outp .= '"Industry":"'. $rs["industry_of_experience"].'"}';
   
}
$outp ='{"feeds":['.$outp.']}';
$conn->close();

echo($outp);
?>