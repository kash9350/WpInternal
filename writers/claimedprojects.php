<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
session_start();
    include('dbConn.php');
    
    $writerDatabaseClaimTimeUpdate=$conn->query("SELECT ID, finalstatus, ClaimedDateAndTime, OrderedDateAndTime FROM writerWpRecord");
    
    date_default_timezone_set('Asia/Calcutta');
    $thisTime=date_create(date("Y-m-d H:i:s"));
    
    function dateCompare($claimedOn, $orderedOn)
    {
    	global $thisTime; 
    	
    	
    	$claimedOn=date_create($claimedOn);
    	$orderedOn=date_create($orderedOn);
    	
    	
    	if (date_add($orderedOn, date_interval_create_from_date_string("-60 hours")) >= $thisTime)
    	{
    		if (date_add($claimedOn, date_interval_create_from_date_string("-36 hours")) >= $thisTime)
    		{
    			return "Expired";
    		}
    		else
    		{
    			return "CanContinue";
    		}
    	}
    	
    	else
    	{
    		if (date_add($orderedOn, date_interval_create_from_date_string("-24 hours")) >= $claimedOn)
    		{
    			return "CanContinue";
    		}
    		else
    		{
    			return "Expired";
    		}
    	}
    	
    	
    }
    
    
    
    while($myrows = $writerDatabaseClaimTimeUpdate->fetch_array(MYSQLI_ASSOC))
    {
    	switch ($myrows['finalstatus'])
    	{
    		case ('Claimed'):
    		{
    			switch (dateCompare($myrows['ClaimedDateAndTime'], $myrows['OrderedDateAndTime']))
    			{
    				case ('Expired'):
    				{
    					mysqli_query($conn, "UPDATE writerWpRecord SET finalstatus='Timeout' WHERE ID='".$myrows['ID']."'");
    					break;
    				}
    				
    				case ('CanContinue'):
    				{
 
    					break;
    				}
    			}
    			break;
    		}
    		
    		case ('Uploaded'):
    		{
    			switch (dateCompare($myrows['ClaimedDateAndTime'], $myrows['OrderedDateAndTime']))
    			{
    				case ('Expired'):
    				{
    					mysqli_query($conn, "UPDATE writerWpRecord SET finalstatus='ResubmitTimeup' WHERE ID='".$myrows['ID']."'");
    					break;
    				}
    				
    				case ('CanContinue'):
    				{
 
    					break;
    				}
    			}
    			break;
    		}
    	}
    }
    
    $myclaimedfindid=$conn->query("SELECT claimedOrderID FROM writerWpRecord WHERE writeremail='".$_SESSION['username']."'");

    
    $myidselectdatabase="";
    while($st=$myclaimedfindid->fetch_array(MYSQLI_ASSOC))
    {
    	if ($myidselectdatabase=="")
    	{
    		$myidselectdatabase="'".$st['claimedOrderID']."' ";
    		
    	}
    	else
    	{
    		$myidselectdatabase.="OR txnid='".$st['claimedOrderID']."'";
    	}
    }
    
    
    
    $myclaimedprojects=$conn->query("SELECT email, txnid, orders, topic, quality,industry_of_experience, noOfPosts, deliveryTime, goal, style_of_writing, sample_blog, point_of_view, blog_structure, target_audience, key_points, things_to_avoid, keywords,special_instructions   FROM businesshomepage WHERE txnid=".$myidselectdatabase);


$outp = "";



while($rs = $myclaimedprojects->fetch_array(MYSQLI_ASSOC)){
    
    $writerThisorderStatus=mysqli_fetch_object($conn->query( "SELECT finalstatus, ClaimedDateAndTime FROM writerWpRecord WHERE writeremail='".$_SESSION['username']."' AND claimedOrderID='".$rs['txnid']."'"));
    {
    
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Ordertype":"'.$rs['orders']. '",';
    $outp .= '"Topic":"'   . $rs['topic']       . '",';
    $outp .= '"Client":"'   . $rs['email']       . '",';
    $outp .= '"WpTransactionID":"'   . $rs['txnid']       . '",';
    
    
    $outp .= '"ThisOrderStatus":"'   . $writerThisorderStatus->finalstatus   . '",';
    
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
    $outp .= '"Budget":"'   . ($rs['quality'] -($rs['quality']/5))       . '",';
   
    $outp .= '"Industry":"'. $rs["industry_of_experience"].'"}';
    
    }
   
}


$outp ='{"myclaims":['.$outp.']}';
$conn->close();

echo($outp);
?>