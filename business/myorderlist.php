<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    



session_start();
include('dbConn.php');


    $orderlist=$conn->query("SELECT  txnid, orders, topic, dateOrder, quality,industry_of_experience, noOfPosts, deliveryTime, goal, style_of_writing, sample_blog, point_of_view, blog_structure, target_audience, key_points, things_to_avoid, keywords,special_instructions, claimedStatus, editorReview, receivedStatus FROM businesshomepage WHERE email='".$_SESSION['myWpUsername']."'");

$outp = "";
while($rs = $orderlist->fetch_array(MYSQLI_ASSOC)) {
    
    
    
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"TransactionID":"'.$rs['txnid']. '",';
    $outp .= '"Ordertype":"'   . $rs['orders']. '",';
    $outp .= '"Amount":"'   . $rs['quality']  . '",';
    $outp .= '"Topic":"'   . $rs['topic']       . '",';
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
    $outp .= '"SpecialInstructions":"'   . $rs['special_instructions']  . '",';
    $outp .= '"Industry":"'   . $rs['industry_of_experience']    . '",';
    $outp .= '"ClaimedStatus":"'   . $rs['claimedStatus']    . '",';
    $outp .= '"ReviewStatus":"'   . $rs['editorReview']    . '",';
    $outp .= '"ReceiveStatus":"'   . $rs['receivedStatus']    . '",';
    
    
    $outp .= '"Date":"'. $rs["dateOrder"].'"}';
   
}
$outp ='{"orders":['.$outp.']}';
$conn->close();

echo($outp);
?>