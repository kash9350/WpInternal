<?php

include('wpdbConn/dbConn.php');
//connection created


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT MAX(ID) FROM businesshomepage";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    $maxID=$row["MAX(ID)"];
    $i=$row["MAX(ID)"];
    while ($i>0){
        $orderNum="SELECT orders, topic FROM businesshomepage WHERE ID='".$i."'";
        $con1=mysqli_fetch_object(mysqli_query($conn, $orderNum));
        
        $orderName[$i]=$con1->orders;
        $topicName[$i]=$con1->topic;
        
        $i--;
    }
    
}

else {
    echo "0 results";
}


mysqli_close($conn);


function orderList($ordNo)
{
    switch ($ordNo)
    {
        case 1:
            return 'Standard Blog Post';
            break;
        case 2:
            return 'Long Blog Post';
            break;
        case 3:
            return 'Facebook Post';
            break;
        case 4:
            return "Tweets";
            break;
        case 5:
            return 'Website Pages';
            break;
        case 6:
            return 'Articles';
            break;
        case 7:
            return 'Press Release';
            break;
        case 8:
            return 'Product Description';
            break;
    }
}



if (isset($_GET['pageNo']))
{
    $pageNo=5 * ($_GET['pageNo']);
    $pageNoPassNext=$_GET['pageNo']+1;
    $pageNoPassPrev=$_GET['pageNo']-1;
    if ($_GET['pageNo']==0)
    {
        $prevBut='none';   
    }
    else
    {
        $prevBut='inline-block';
    }
    
    $tabDisplay1='none';
    $tabDisplay2='block';
}
else
{
    $pageNo=0;
    $pageNoPassNext=1;
    $prevBut='none';
    
    $tabDisplay1='block';
    $tabDisplay2='none';
}


?>