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

$sql = "SELECT MAX(ID) FROM businesshomepage";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    $maxID=$row["MAX(ID)"];
    $i=$row["MAX(ID)"];
    while ($i>0){
        $orderNum="SELECT orders, topic, quality,industry_of_experience FROM businesshomepage WHERE ID='".$i."'";
        $con1=mysqli_fetch_object(mysqli_query($conn, $orderNum));
        
        $orderName[$i]=$con1->orders;
        $topicName[$i]=$con1->topic;
        $pricing[$i]=(($con1->quality)*4)/5;
        $myArea[$i]=$con1->industry_of_experience;
        
        $i--;
    }
    
}

else {
    echo "0 results";
}



$permanentEntryQuery="SELECT permanentEntry  FROM writerprofile WHERE email='".$Username."'";



$intercom="SELECT firstName, lastName FROM signup_writers WHERE email='".$Username."'";

$con3=mysqli_fetch_object(mysqli_query($conn, $intercom));

$name= $con3->firstName." ".$con3->lastName;
$date = date('Y-m-d H:i:s');




$con2=mysqli_fetch_object(mysqli_query($conn, $permanentEntryQuery));

$permanentEntry=$con2->permanentEntry;

if ($permanentEntry='1')
{
    $formDisplay='none';
}
else
{
    $formDisplay='block';
}


$profile2Check="SELECT mobileNo, address, city, state, zipCode, myReferences FROM writerprofile WHERE email='".$Username."'";

$con3=mysqli_fetch_object(mysqli_query($conn, $profile2Check));

$mobileNo=$con3->mobileNo;
$address=$con3->address;
$city=$con3->city;
$state=$con3->state;
$zipCode=$con3->zipCode;
$myReferences=$con3->myReferences ;


$sampleCk=mysqli_query($conn, "SELECT ID, paygrade, catagory FROM writerskillsample WHERE email='".$Username."'");

if(mysqli_num_rows($sampleCk)>0)
{
    $wordSample='';
    $payTemp=1;
    while($row = mysqli_fetch_assoc($sampleCk)) 
    {
        if ($row["paygrade"]=='')
        { $paygrade[$payTemp]="Sample under review";}
        else
        {
        $paygrade[$payTemp]=$row["paygrade"];
        }
        $area[$payTemp]=$row["catagory"];
        $payTemp++;
    }
  
}
else
{
    $payTemp=0;
    $wordSample=1;
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
    
    switch (true)
    {
        case ($_GET['pageNo']==0):
        {
            $prevBut='none';
            $nextBut='inline-block';
            break;
        }
        case ((($maxID / 5)+($maxID % 5) )<= ($_GET['pageNo']+1)):
        {
            $nextBut='none';
            break;
        }
        default:
        {
            $prevBut='inline-block';
            $nextBut='inline-block';
        }
    }
    
    
    $tabDisplay1='none';
    $tabDisplay2='block';
    
    
    $fontSize='15.8px';
    $fontWeight='900';
    $fontColor='#2eb161';
    
    
}
else
{
    $pageNo=0;
    $pageNoPassNext=1;
    $prevBut='none';
    
    $tabDisplay1='block';
    $tabDisplay2='none';
    
    
    
    $fontSize='15px';
    $fontWeight='100';
    $fontColor='black';
    
    if ($maxID <=5)
    {
       $nextBut='none'; 
    }
    
    else
    {
        $nextBut='inline-block';
    }
    
}

if ($maxID>0)
{
    $noProjDisplay='none';
}
else
{
    $noProjDisplay='block';
}

if ($wordSample=='')
{
    $applySampleDisplay='block';
}
else 
{
    $applySampleDisplay='none';
}



switch(true)
{
    case (($maxID - $pageNo)==0):
    {
        $newsFeed1='none';
        $newsFeed2='none';
        $newsFeed3='none';
        $newsFeed4='none';
        $newsFeed5='none';
        break;
    }
    
    case (($maxID - $pageNo)==1):
    {
        $newsFeed1='block';
        $newsFeed2='none';
        $newsFeed3='none';
        $newsFeed4='none';
        $newsFeed5='none';
        break;
    }
    
    case (($maxID - $pageNo)==2):
    {
        $newsFeed1='block';
        $newsFeed2='block';
        $newsFeed3='none';
        $newsFeed4='none';
        $newsFeed5='none';
        break;
    }
    
    case (($maxID - $pageNo)==3):
    {
        $newsFeed1='block';
        $newsFeed2='block';
        $newsFeed3='block';
        $newsFeed4='none';
        $newsFeed5='none';
        break;
    }
    
    case (($maxID - $pageNo)==4):
    {
        $newsFeed1='block';
        $newsFeed2='block';
        $newsFeed3='block';
        $newsFeed4='block';
        $newsFeed5='none';
        break;
    }
    
    default:
    {
        $newsFeed1='block';
        $newsFeed2='block';
        $newsFeed3='block';
        $newsFeed4='block';
        $newsFeed5='block';
    }
}


?>

<html>
    <head>
 
        <link rel="stylesheet" type="text/css" href="css/header.css">
        <link rel="stylesheet" type="text/css" href="css/writersHomepage.css">
        <link rel="stylesheet" type="text/css" href="css/reset.css"/>
        <meta charset="utf-8"/>
        
        
        <script src = "jquery/jquery-1.11.1.js"></script>
        <script src = "jquery/writerHomepage_jquery-1.11.1.js"></script>
        <script src = "js/header.js"></script>
        <title>Writer- White Panda</title>
        
        
        
        
        
        
        <style type="text/css">
            #job_search
            {
                font-size:<?php echo $fontSize ?>;
                font-weight:<?php echo $fontWeight ?>;
                color: <?php echo $fontColor ?>;
                
            }
            
            #welcome
            {
                display:<?php echo $tabDisplay1 ?>;
            }
            
            .writer_main .tab_result .job
            {
                display: <?php echo $tabDisplay2 ?>;

            }
            
            #tempDetails
            {
                display:<?php echo $formDisplay; ?> ;
            }
            
            #noProj
            {
                display:<?php echo $noProjDisplay; ?>;
            }
            
            #applySample
            {
                display:<?php echo $applySampleDisplay; ?>;
                
            }
            
            #newsFeed1
            {
                display:<?php echo $newsFeed1; ?>;
            }
            #newsFeed2
            {
                display:<?php echo $newsFeed2; ?>;
            }
            #newsFeed3
            {
                display:<?php echo $newsFeed3; ?>;
            }
            #newsFeed4
            {
                display:<?php echo $newsFeed4; ?>;
            }
            #newsFeed5
            {
                display:<?php echo $newsFeed5; ?>;
            }
        </style>
        
        
    </head>
    
    <body>
        <div id = "header">
            <a id = "home" href="/">
                <img id = "opaque" src="images/full_logo_white.png"/>
            </a>
            <span style="position:absolute; font-size:31px; font-family:champ; top:5px; left:341px; color:#fff;">Writers</span>
            <div class = "nav-bar">
                <ul>
                    
                    
                    <li><a style="font-family:nesia" href='php/signOutWriters.php'>Sign out</a></li>
                    <li><a style="font-family:nesia"><?php echo $_SESSION['username']; ?></a></li>
                    
                    
                </ul>
                
            </div>

         

        </div>
        
        
        
        
    
        
        <div class="writer_main">
            
            
           
<!--            <img id="arrow_writer" src="images/arrowWriter.png"/>-->
            <div class="writer_tab">
                <ul>
                    <a href="#"><li id="job_search">Job Search</li></a>
                    <a href="#"><li id="notification">Notification</li></a>
                    <a href="#"><li id="my_prof">My Profile</li></a>
                    <a href="#"><li id="incomp_ord">Claimed Projects</li></a>
                    <a href="#"><li id="payment">Payment</li></a>
<!--                    <a href="#"><li id="comp_ord">Completed Orders</li></a>-->
<!--                    <a href="#"><li id="payment">Payment</li></a>-->
                </ul>
            </div>
            
            <div class='tab_result'>
                <div id="welcome">
                    <table>
                        <tr>
                            <td id="welcomeNote">
                                <h1 >Welcome to your desk  </h1> <br> 
• This is a beta version<br>
  • Supply samples to improve your writing skill
  
</td>
                            <td><img src="images/desk.png"></td>
                        </tr>
  
                    </table>
                   
                </div>
                
                <div class='job' >
                    <br><br>
                    <a id="applySample" href="writerSampleArea.html">Apply for this test to get assigned to projects (**mandatory)</a>
                    
                    
                    
                    
                    
<!----------------------FILTER LIST------------------>
<!--                    
                    <ul>
                        
                        <li><input type="text" style="border-color:transparent;"  placeholder="Search Jobs"><img src='images/search2.png'/></li>
                        
                        <li>
                            <select style="border-color:transparent;">
                                <option value="all">All</option>
                                <option value="blogPost">Blog Post</option>
                                <option value="whitePapers">White Papers</option>
                                <option value="tweets">Tweets</option>
                                <option value="fb">Facebook Posts</option>
                                <option value="webPage">Website Pages</option>
                                <option value="prod">Product Description</option>
                                <option value="press">Press Release</option>
                                <option value="artile">Article</option>
                            </select>
                         | </li>
                        
                    </ul>


-->
                    
                    <br/><br/><br/><br/><br/>
                    
                    <h5 id='noProj'><img src="images/search.png"/></h5>
                    <h1 id='noProj'>No updated projects</h1>
                    
                    
                    
                    
                    <a id="newsFeed1" href="writersHomepageContentDesc.php?orderId=<?php echo ($maxID - $pageNo); ?>"><span class="feeds"><h2><?php echo orderList($orderName[$maxID - $pageNo]); ?></h2><h3>Topic: <?php echo $topicName[$maxID-$pageNo]; ?><span id="time">Due in 18 hours</span></h3><h4><span style='font-size:17px;'>Area: <? echo $myArea[$maxID-$pageNo]; ?></span><span id="time" style='font-size:17px;'>INR <?php echo $pricing[$maxID-$pageNo]; ?>₹</span></h4></span></a>
                    
                    
                    <a id="newsFeed2" href="writersHomepageContentDesc.php?orderId=<?php echo ($maxID -1 - $pageNo); ?>"><span class="feeds"><h2><?php echo orderList($orderName[$maxID-1-$pageNo]); ?></h2><h3>Topic: <?php echo $topicName[$maxID-1-$pageNo]; ?><span id="time">Due in 18 hours</span></h3><h4><span style='font-size:17px;'>Area: <? echo $myArea[$maxID-1-$pageNo]; ?></span><span id="time" style='font-size:17px;'>INR Rs. <?php echo $pricing[$maxID-1-$pageNo]; ?></span></h4></span></a>
                    
                    <a id="newsFeed3" href="writersHomepageContentDesc.php?orderId=<?php echo ($maxID -2 - $pageNo); ?>"><span class="feeds"><h2><?php echo orderList($orderName[$maxID-2-$pageNo]); ?></h2><h3>Topic: <?php echo $topicName[$maxID-2-$pageNo]; ?><span id="time">Due in 18 hours</span></h3><h4><span style='font-size:17px;'>Area: <? echo $myArea[$maxID-2-$pageNo]; ?></span><span id="time" style='font-size:17px;'>INR Rs. <?php echo $pricing[$maxID-2-$pageNo]; ?></span></h4></span></a>
                    
                    <a id="newsFeed4" href="writersHomepageContentDesc.php?orderId=<?php echo ($maxID -3 -$pageNo); ?>"><span class="feeds"><h2><?php echo orderList($orderName[$maxID-3-$pageNo]); ?></h2><h3>Topic: <?php echo $topicName[$maxID-3-$pageNo]; ?><span id="time">Due in 18 hours</span></h3><h4><span style='font-size:17px;'>Area: <? echo $myArea[$maxID-3-$pageNo]; ?></span><span id="time" style='font-size:17px;'>INR Rs. <?php echo $pricing[$maxID-3-$pageNo]; ?></span></h4></span></a>
                    
                    <a id="newsFeed5" href="writersHomepageContentDesc.php?orderId=<?php echo ($maxID -4 - $pageNo); ?>"><span class="feeds"><h2><?php echo orderList($orderName[$maxID-4-$pageNo]); ?></h2><h3>Topic: <?php echo $topicName[$maxID-4-$pageNo]; ?><span id="time">Due in 18 hours</span></h3><h4><span style='font-size:17px;'>Area: <? echo $myArea[$maxID-4-$pageNo]; ?></span><span id="time" style='font-size:17px;'>INR Rs. <?php echo $pricing[$maxID-4-$pageNo]; ?></span></h4></span></a>
                    
                    <a id="prevPageBut" class='pageChangeBut'  href="./writersHomepage.php?pageNo=<?php echo $pageNoPassPrev; ?> "><img style="display:  <?php echo $prevBut; ?>; " src="images/arrows-left.png"/></a> &nbsp; &nbsp;<a class='pageChangeBut'  href="./writersHomepage.php?pageNo=<?php echo $pageNoPassNext; ?>"><img style="display: <?php echo $nextBut; ?>;" src="images/arrows-right.png"/></a>
                    
                    
                    
                </div>
                
                <div class="profile">
                    
                <h2>Ladderboard<hr></h2>
                    <?php if($payTemp!=0){  
                    echo "<table style='width:40%;'>
                        <tr >
                            <th style='float:left;font-size:17px;'>Area of expertise</th>
                            <th style='font-size:17px;'>Level</th> 
                        </tr>";
                    for($i=$payTemp;$i--;$i>0){
                        echo "<tr>
                            <td>".$area[$i]."</td>
                            <td>".$paygrade[$i]."</td> 
                        </tr>";
                            }
                    echo "</table>"; 
                    }
                    else {echo "No sample uploaded";}
                    ?>
                    
                    <br>
                <h2>Improve Your Skill<hr></h2>
                    <h4 id="sampleTest">You can now improve your writing level by a sample <a  href="writerSampleArea.html">TEST</a>
                    </h4>



                    <!--
                <form id='tempDetails' method="post" action="php/databasecall/profile1CallWriter.php">
                    
                    <h2>Profession<hr/></h2>
                    <p>Are you ever engaged in content writing?</p>
                    <p>&nbsp; &nbsp; <input type="radio" name='pastEngaged' value="yes">Yes <input type='radio' name="pastEngaged" value="no">No</p>
                    
                    <p>If yes then what do you write for?</p>
                    
                    <p>
                        &nbsp; &nbsp; <input type="checkbox" name="areaEngaged[]" value="Blog Post">Blog Post<br/>
                        &nbsp; &nbsp; <input type="checkbox" name="areaEngaged[]" value='White Papers'>White Papers<br/>
                        &nbsp; &nbsp; <input type="checkbox" name="areaEngaged[]" value='Tweets'>Tweets<br/>
                        &nbsp; &nbsp; <input type="checkbox" name="areaEngaged[]" value='Facebook Posts'>Facebook Posts<br/>
                        &nbsp; &nbsp; <input type="checkbox" name="areaEngaged[]" value='Website Pages'>Website Pages<br/>
                        &nbsp; &nbsp; <input type="checkbox" name="areaEngaged[]" value='Product Description'>Product Description<br/>
                        &nbsp; &nbsp; <input type="checkbox" name="areaEngaged[]" value='Press release'>Press release<br/>
                        &nbsp; &nbsp; <input type="checkbox" name="areaEngaged[]" value='Article'>Article<br/>
                    
                    </p>
                    
                    <p>What is your current occupation?
                        <select name="currentOccu">
                            <option value="">select</option>
                            <option value="student">Student</option>
                            <option value="others">others</option>
                        </select>
                    </p>
                    
                    
                    <br>
                    
                    
                    <h2>Personal<hr/></h2>
                    <p>Gender 
                        <select name="gender">
                            <option value=''>..select</option>
                            <option value='male'>Male</option>
                            <option value='female'>Female</option>
                        </select>
                    </p>
                    
                    <h3><input id="update_but" type="submit" value='Update'></h3>
                    <br><br><br><br><br><br><br><br>
                </form>

-->


                    
                <form action="php/databaseCall/profile2CallWriter.php"  method="post">
                    
                    <h2>Address<hr/></h2>
                    <p>Mobile Number +91<input name='mobileNo' type="text" value='<?php echo $mobileNo; ?>'/></p>
                    <p>Address &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;<input name="address"  type="text" value='<?php echo $address; ?>' /></p>
                    
                    <p>City &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;<input name="city" value="<?php echo $city; ?>" type="text"/></p>
                    <p>State &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                        <select  name="state">
                            <option value="">---Select your State---</option>
                            
                            
<option value='Andaman and Nicobar Islands'>Andaman and Nicobar Islands</option>
<option value='Andhra Pradesh'>Andhra Pradesh</option>
<option value='Arunachal Pradesh'>Arunachal Pradesh</option>
<option value='Assam'>Assam</option>
<option value='Bihar'>Bihar</option>
<option value='Chandigarh'>Chandigarh</option>
<option value='Chhattisgarh'>Chhattisgarh</option>
<option value='Dadra and Nagar Haveli'>Dadra and Nagar Haveli</option>
<option value='Daman and Diu'>Daman and Diu</option>
<option value='Delhi'>Delhi</option>
<option value='Goa'>Goa</option>
<option value='Gujarat'>Gujarat</option>
<option value='Haryana'>Haryana</option>
<option value='Himachal Pradesh'>Himachal Pradesh</option>
<option value='Jammu and Kashmir'>Jammu and Kashmir</option>
<option value='Jharkhand'>Jharkhand</option>
<option value='Karnataka'>Karnataka</option>
<option value='Kerala'>Kerala</option>
<option value='Lakshadweep'>Lakshadweep</option>
<option value='Madhya Pradesh'>Madhya Pradesh</option>
<option value='Maharashtra'>Maharashtra</option>
<option value='Manipur'>Manipur</option>
<option value='Meghalaya'>Meghalaya</option>
<option value='Mizoram'>Mizoram</option>
<option value='Nagaland'>Nagaland</option>
<option value='Odisha'>Odisha</option>
<option value='Puducherry'>Puducherry</option>
<option value='Punjab'>Punjab</option>
<option value='Rajasthan'>Rajasthan</option>
<option value='Sikkim'>Sikkim</option>
<option value='Tamil Nadu'>Tamil Nadu</option>
<option value='Telengana'>Telengana</option>
<option value='Tripura'>Tripura</option>
<option value='Uttar Pradesh'>Uttar Pradesh</option>
<option value='Uttarakhand'>Uttarakhand</option>
<option value='West Bengal'>West Bengal</option>

                        </select>
                    
                    </p>
                    <p>Pin Code &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; <input name="zipCode" value="<?php echo $zipCode ?>" type="text"/></p>
                    
                    <br/><br/>
                    <h2>Profession</h2><hr>
                    <p>Content references</p><br>
                    <textarea rows="7" cols="50"  name='writerReferences' ><?php if ($myReferences==''){ echo 'Mention some of your content references';}
else{
  echo $myReferences;
} ?></textarea><br><br><br>
                    
                    
                    <h3><input id="update_but" type="submit" value='Update'></h3>
                    </form>
                </div>
                
                <div class="claimedProjects">
                    <br><br>
                    <?php include("claimCheck.php"); ?>
                    
                </div>
                
                <div class="paymentInfo" style='background:#2eb161;margin-top:40px;width:60%;padding:0px 50px 50px 50px;color:#fff'>
                    <br><br><br>
                        
                    <?php include("paymentdata.php"); ?>
                </div>

                <div class="myNotifications" >
                       <br><br>
                     <?php include("notification/notification.html"); ?>
                </div>
            </div>


        </div>
            
        <div class="foot">
            <br/>
            <a href = "privacy.html">Privacy</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href = "termsUse.html">Terms of Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href = "writersAgreement.html">Writers' Privacy Agreement</a>
        </div>
    </body>
</html>