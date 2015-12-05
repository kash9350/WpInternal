

<?php
include("wpdbConn/dbConn.php");
$claim="SELECT claimedOrderID FROM writerprofile WHERE email='".$Username."'";
$results=mysqli_fetch_object(mysqli_query($conn, $claim));
$orderID=$results->claimedOrderID;




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



if ($orderID=='0')
{
    echo "<h5><img src='images/claimedProj.png'</h5>
                        <h2>No claimed projects!</h2>";
}

else
{  
    
        $orderSpecification="SELECT orders,  noOfPosts, topic, industry_of_experience,  goal, style_of_writing, sample_blog, point_of_view, blog_structure, target_audience, key_points, things_to_avoid, keywords, special_instructions  FROM businesshomepage WHERE txnid='".$orderID."'";
    
    $con1=mysqli_fetch_object(mysqli_query($conn, $orderSpecification));
    
    
    
    $orderName=$con1->orders;
    
 
    $noOfPosts=$con1->noOfPosts;
    $topicName=$con1->topic;
    $industry_of_experience=$con1->industry_of_experience;
    $goal=$con1->goal;
    $writingStyle=$con1->style_of_writing;
    $sampleBlog=$con1->sample_blog;
    $pointsOfView=$con1->point_of_view;
    $blogStructure=$con1->blog_structure;
    $targetAudience=$con1->target_audience;
    $keyPoints=$con1->key_points;
    $thingsToAvoid=$con1->things_to_avoid;
    $keywords=$con1->keywords;
    $specialInstruct=$con1->special_instructions;


    echo "
    <h1><span><u>Topic</u></span><br>".  $topicName."</h1> <br/><br/>
                    <table>
                        <tr>
                            <td>Catagory:</td>
                            <td>". $orderName."</td>
                        </tr>
                        <tr>
                            <td>No. of Posts:</td>
                            <td>". $noOfPosts."</td>
                        </tr>
                        <tr>
                            <td>Industry of experience:</td>
                            <td>". $industry_of_experience."</td>
                        </tr>
                        <tr>
                            <td>Goal:</td>
                            <td>". emptycheck($goal)."</td>
                        </tr>
                        <tr>
                            <td>Style of writing:</td>
                            <td>". emptycheck( $writingStyle)."</td>
                        </tr>
                        <tr>
                            <td>Content Sample:</td>
                            <td>". emptycheck($sampleBlog)."</td>
                        </tr>
                        <tr>
                            <td>Point Of View:</td>
                            <td>". emptycheck($pointsOfView)."</td>
                        </tr>
                        <tr>
                            <td>Content Structure:</td>
                            <td>". emptycheck( $blogStructure)."</td>
                        </tr>
                        <tr>
                            <td>Type of targeted audience:</td>
                            <td>". emptycheck($targetAudience)."</td>
                        </tr>
                        <tr>
                            <td>Keypoints:</td>
                            <td>". emptycheck($keyPoints)."</td>
                        </tr>
                        <tr>
                            <td>Things to avoid:</td>
                            <td>". emptycheck($thingsToAvoid)."</td>
                        </tr>
                        <tr>
                            <td>Keywords:</td>
                            <td>". emptycheck($keywords)."</td>
                        </tr>
                        <tr>
                            <td>Special Instructions:</td>
                            <td>". emptycheck($specialInstruct)."</td>
                        </tr>
                    </table>";
echo '<hr>
                    <h2>Upload your file here:</h2>
                    <form action="php/uploadCode/upload.php" method="POST" enctype="multipart/form-data">
             <input type="file" name="doc" value="Choose File" />
             <input type="submit" name="upload" value="Upload" class="samp_but"/>
             <input type="hidden" name="orderID" value="'.$orderID.'"/>
             <input type="hidden" name="username" value="'.$Username.'"/>
             </form>';
}




?>