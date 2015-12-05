<?php


session_start();


if (!isset($_SESSION['username']) || empty($_SESSION['username']))
{
    header("Location: php/writerLogin.php");

}

$Username = $_SESSION['username'];


$servername = "localhost";
$username = "wpRootDatabase";
$password = "orthrox";
$dbname = "whitepanda";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_GET['orderId']))
{
    $orderSpecification="SELECT orders, txnid,  noOfPosts, topic, industry_of_experience,  goal, style_of_writing, sample_blog, point_of_view, blog_structure, target_audience, key_points, things_to_avoid, keywords, special_instructions  FROM businesshomepage WHERE ID='".$_GET['orderId']."'";
    
    $con1=mysqli_fetch_object(mysqli_query($conn, $orderSpecification));
    
    
    
    $orderName=$con1->orders;
    
    $orderID=$con1->txnid;
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
    
 
}

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



mysqli_close($conn);




?>

<html>
    <head>
 
        <link rel="stylesheet" type="text/css" href="css/header.css">
        <link rel="stylesheet" type="text/css" href="css/reset.css">
        <link rel="stylesheet" type="text/css" href="css/writersHomepage.css">
        
        
        <script src = "jquery/jquery-1.11.1.js"></script>
        <script src = "jquery/writerHomepage_jquery-1.11.1.js"></script>
        <script src = "js/header.js"></script>
        <title>Writer- White Panda</title>
        
        
        
        <style type="text/css">
            #job_search
            {
                font-size:15.8px;
                font-weight:900;
                color: #2eb161;
                
            }
            
            
            .writer_main .tab_result .job
            {
                display: block;

            }
            
             .job table
            {
                margin-left:90px;
            }
            .job table tr
            {
                height: 40px;
            }
            
            
            .job table tr td
            {
                color:#2eb161;
                font-family:nesia;
                font-weight:900;
                font-size:20px;
                padding-right:30px;
                
            }
            #button
            {
                margin-left:650px;
                margin-top: 50px;
                height:38px;
                width:150px;
                background:#2eb161;
                color:#fff;
                font-size:17px;
                border-color:#2eb161;
                border-radius:4px;
                border-width:5px;
            }
            #button:hover
            {
                border-width:1px;
            }
            
         
          
            
            
        </style>
        
        
    </head>
    
    <body>
        <div class='nav_bar-writer'>
                <ul>
                    <li id="logo"><img src='images/full_logo.png'/></li>     
                    <li id='username'><a href="#"><?php echo $Username; ?>&#x25BC;</a></li>
                        
<!--                    <li><img src='images/EmptyProfile.png'/></li>-->
                </ul>
                <br/>
                <ul class="accnt">
                    <li>
                        <ul>
                            <a href="#"><li>&nbsp; &nbsp; Edit account info</li></a>
                            <a href="#"><li>&nbsp; &nbsp; Sign out</li></a>
                        </ul>
                    </li>
                </ul>
        </div>
        
        
        
    
        
        <div class="writer_main">
            
            
           
<!--            <img id="arrow_writer" src="images/arrowWriter.png"/>-->
            <div class="writer_tab">
                <ul>
                    <a href="#"><li id="job_search">Content Details</li></a>
                    <a href="writersHomepage.php"><li id="home">Home</li></a>
                </ul>
            </div>
            
            <div class='tab_result'>
                
                
                <div class='job'  id='orderSpec'>
                    
                    
   
                    <br/><br/><br/>
                    
                    <h1><span>Topic:</span><br><?php echo  $topicName; ?></h1> <br/><br/>
                    <table>
                        <tr>
                            <td>Catagory:</td>
                            <td><?php echo $orderName; ?></td>
                        </tr>
                        <tr>
                            <td>No. of Posts:</td>
                            <td><?php echo $noOfPosts; ?></td>
                        </tr>
                        <tr>
                            <td>Industry of experience:</td>
                            <td><?php echo $industry_of_experience; ?></td>
                        </tr>
                        <tr>
                            <td>Goal:</td>
                            <td><? echo emptycheck($goal); ?></td>
                        </tr>
                        <tr>
                            <td>Style of writing:</td>
                            <td><? echo emptycheck( $writingStyle); ?></td>
                        </tr>
                        <tr>
                            <td>Content Sample:</td>
                            <td><? echo emptycheck($sampleBlog); ?></td>
                        </tr>
                        <tr>
                            <td>Point Of View:</td>
                            <td><? echo emptycheck($pointsOfView); ?></td>
                        </tr>
                        <tr>
                            <td>Content Structure:</td>
                            <td><? echo emptycheck( $blogStructure); ?></td>
                        </tr>
                        <tr>
                            <td>Type of targeted audience:</td>
                            <td><? echo emptycheck($targetAudience); ?></td>
                        </tr>
                        <tr>
                            <td>Keypoints:</td>
                            <td><? echo emptycheck($keyPoints); ?></td>
                        </tr>
                        <tr>
                            <td>Things to avoid:</td>
                            <td><? echo emptycheck($thingsToAvoid); ?></td>
                        </tr>
                        <tr>
                            <td>Keywords:</td>
                            <td><? echo emptycheck($keywords); ?></td>
                        </tr>
                        <tr>
                            <td>Special Instructions:</td>
                            <td><? echo emptycheck($specialInstruct); ?></td>
                        </tr>
                    </table>
                 
                   
                    
                    <form method="post" action="php/databaseCall/claimProject.php" >
                        
                        <input type="hidden" name="orderID" value="<?php echo $orderID; ?>"/>
                        <input type="hidden" name="username" value="<?php echo $Username; ?>"/>
                        <button id="button" type="submit" >Claim Project</button>
                    </form>
                    
                    

                </div>
                
                
            </div>


        </div>
            
        <div class="foot">
            <br/>
            <a href = "privacy.html">Privacy</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href = "termsUse.html">Terms of Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href = "writersAgreement.html">Writers' Privacy Agreement</a>
        </div>
    </body>
</html>