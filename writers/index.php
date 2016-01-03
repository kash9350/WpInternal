<?php
session_start();


if (!isset($_SESSION['username']) || empty($_SESSION['username']))
{
    header("Location: ../php/writerLogin.php");

}

$Username = $_SESSION['username'];


include('dbConn.php');


// Create connection

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


include('emptydatabase.php');



?>
<!DOCTYPE html>
<html lang="en">
    <head>
 
        <link rel="stylesheet" type="text/css" href="header.css">
        <link rel="stylesheet" type="text/css" href="../css/footer.css">
        <link rel="stylesheet" type="text/css" href="writersHomepage.css">
        <link rel="stylesheet" type="text/css" href="../css/reset.css"/>

        <link rel="icon" type="[MIME TYPE]" href="../images/webicon.png" />
        <meta charset="utf-8"/>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        
        
        <script src = "header.js"></script>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="lib/bootstrap.min.css">
  <script src="lib/jquery.min.js"></script>
  <script src="lib/bootstrap.min.js"></script>
        <script src = "writerHomepage_jquery-1.11.1.js"></script>
        
        
        
        <script src="lib/angular.min.js"></script>
        <script src="app.js"></script>
        
        <link href='./fileUpload.css' rel='stylesheet' type='text/css'>
        <script src="./fileUpload.js"></script>
        
        
        
        
    
    
        <title>Writer- White Panda</title>
        
        
        
    </head>
    
    <body>
        
       <div id = "header">
            <a id = "home" href="./">
                <img id = "opaque" src="../images/full_logo_white.png"/>
            </a>
            <span style="position:absolute; font-size:31px; font-family:champ; top:1px; left:341px; color:#fff;">Writers</span>
            <div class = "nav-bar">
                <ul>
                    
                    
                    <li><a style="font-family:nesia" href='../php/signOutWriters.php'>Sign out</a></li>
                    <li><a style="font-family:nesia"><?php echo $_SESSION['username']; ?></a></li>
                    
                    
                </ul>
                
            </div>

         

        </div>
        
        
        <div class="alert alert-warning" style="margin-top:85px; width:86%; margin-left:6%; display:<?php echo mydisplay($mysampleexist); ?>">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Attention!</strong> You haven't submitted content samples. You will not be able to take projects. To submit now <a href="../writerSampleArea.html"><button type="button" class="btn btn-danger btn-sm" href='#'>CLICK HERE</button></a>
  </div>
        
    
        
        <div class="container writer_main">
            
            
           
<!--            <img id="arrow_writer" src="images/arrowWriter.png"/>-->
            <div class="writer_tab" >
                <ul >
                    <a data-toggle="tab" href="#jobSearch"><li id="job_search" >Job Search</li></a>
                    <a data-toggle="tab" href="#notification"><li >Notification</li></a>
                    <a data-toggle="tab" href="#myProfile"><li id="my_prof">My Profile</li></a>
                    <a data-toggle="tab" href="#incompleteOrders"><li id="incomp_ord">Claimed Projects</li></a>
                    <a data-toggle="tab" href="#mypayment"><li id="payment">Payment</li></a>
<!--                    <a href="#"><li id="comp_ord">Completed Orders</li></a>-->
<!--                    <a href="#"><li id="payment">Payment</li></a>-->
                </ul>
            </div>
            
            <div ng-app="myApp" ng-controller="writerdatabase" class='tab-content tab_result' style="font-family:'Open Sans'">
                <div id="welcome">
                    <table>
                        <tr>
                            <td id="welcomeNote">
                                <h1 >Welcome to your desk  </h1> <br> 
• Go ahead! Lots of cool Projects coming up...<br>
  • Meanwhile, Submit samples to improve your rank
  
</td>
                            <td><img src="../images/desk.png"></td>
                        </tr>
  
                    </table>
                   
                </div>
                
                <div  id="jobSearch" class='tab-pane fade job'>
                    <br><br>
                    <input type="text" class="form-control" placeholder="Filter by any syntax" ng-model="searchjob"/>
                    
                    <div ng-repeat="x in myfeeds | filter:searchjob" >
                       
                        <a data-toggle="tab" href=".jobDetails" ng-click="selectTab($index)"><span class="feeds"><h4>{{x.Ordertype}}</h4><h3>Topic: {{x.Topic}}<span id="time">Due in 18 hours</span></h3><h4><span style='font-size:17px;'>Area: {{x.Industry}}</span><span id="time" style='font-size:17px;'>Stipend: {{x.Budget}} ₹</span></h4></span></a>
                        
                    </div>
                   
                    
                    <br/><br/><br/><br/>
                    <div style="display:<?php  echo mydisplay($jobCheck); ?>">
                        <h5 id='noProj'><img src="../images/search.png"/></h5>
                        <h2 id='noProj'>No updated projects</h2>
                    </div>
                    
                    
                    
                    
                </div>
                
                
                <div id="contentDescriptions{{$index}}" class="tab-pane fade jobDetails" >
                    <br>
                    <a data-toggle="tab" href="#jobSearch" style="float:left; font-size:16px; text-decoration:none; color:#2eb161;"><span class="glyphicon glyphicon-chevron-left"></span>Take me back</a>
                    <br><br>
                     <table class="table" >
                        <thead>
                            <tr style="font-size:18px;color:#2eb161;">
                                <h3 style="color:#2eb161;">Topic: &nbsp; {{myfeeds[selectedTab].Topic}}</h3>
       
                            </tr>
                         </thead>
                         <tbody style="color:black;">
                             <tr class="success">
                                 <td>Catagory</td>
                                 <td>{{myfeeds[selectedTab].Ordertype}}</td>
                             </tr>
                             <tr class="success">
                                 <td>No. of Posts</td>
                                 <td>{{myfeeds[selectedTab].NoOfPosts}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Industry of experience</td>
                                 <td>{{myfeeds[selectedTab].Industry}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Stipend</td>
                                 <td>{{myfeeds[selectedTab].Budget}} ₹</td>
                             </tr>
                             <tr class="success">
                                 <td>Goal</td>
                                 <td>{{myfeeds[selectedTab].Goal}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Style of writing</td>
                                 <td>{{myfeeds[selectedTab].Styleofwriting}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Content Sample</td>
                                 <td>{{myfeeds[selectedTab].ContentSample}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Point of View</td>
                                 <td>{{myfeeds[selectedTab].Pointofview}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Content Structure</td>
                                 <td>{{myfeeds[selectedTab].ContentStructure}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Target audience</td>
                                 <td>{{myfeeds[selectedTab].TargetAudience}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Keypoints</td>
                                 <td>{{myfeeds[selectedTab].Keypoints}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Things to avoid</td>
                                 <td>{{myfeeds[selectedTab].Thingstoavoid}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Keywords</td>
                                 <td>{{myfeeds[selectedTab].Keywords}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Special Instructions</td>
                                 <td>{{myfeeds[selectedTab].SpecialInstructions}}</td>
                                 
                             </tr>
                         </tbody>
                    </table>
                    
                    <form method="post" action="../php/databaseCall/claimProject.php" >
                        
                        <input type="hidden" name="orderID" value="{{myfeeds[selectedTab].WpTransactionID}}"/>
                        <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>"/>
                        <input type="hidden" name="OrderedDate" value="{{myfeeds[selectedTab].OrderedDate}}"/>
                        <button type="submit" class="btn btn-info btn-lg" style="background:#2eb161; float:right;">Claim Project</button>
                    </form>
                </div>
                
                
                <div  id="notification"  class="tab-pane fade myNotifications" >
                    
                       <br><br>
                     <div ng-repeat="x in mynotifications" class="" style="width:80%; background:#e9eaed; padding: 10px 10px 12px 30px;color:#2eb161; border-radius:5px; text-align:left; outline:none;border:none;margin-bottom:20px;">
    
    <h4>• {{x.Subject}} </h4>
                         <h5>&nbsp;&nbsp; {{x.Notification}}</h5>
    <span style="text-align:right">&nbsp; &nbsp;{{x.Date}}</span>
    

</div>
                    
                    <br/><br/><br/><br/>
                    <div style="display:<?php  echo mydisplay($mynotificationexist); ?>; text-align:center;">
                        <h5 id='noProj'><img src="../images/search.png" style='height:200px' /></h5>
                        <h2 id='noProj'style="color:#2eb161;">No activities found</h2>
                    </div>
                    
                    

                </div>
                
               
                
                <div id='myProfile' class="tab-pane fade profile" >
                    
                    <?php include('myprofile.php'); ?>
                </div>
                
                
                
                
                
                <div id="incompleteOrders" class="tab-pane fade claimedProjects job" style="text-align:left;">
                    <br><br>
                    <div ng-repeat="x in myclaimedproject" >
                       
                        <a data-toggle="tab" href="#myclaimedprojectview" ng-click="claimed($index)"><span class="feeds"><h4>{{x.Ordertype}}</h4><h3>Topic: {{x.Topic}}<span id="time">Due in 18 hours</span></h3><h4><span style='font-size:17px;'>Area: {{x.Industry}}</span><span id="time" style='font-size:17px;'>Stipend: {{x.Budget}} ₹</span></h4></span></a>
                        
                    </div>
                    
                    
                    <br/><br/><br/><br/>
                    <div style="display:<?php  echo mydisplay($myexistedclaims); ?>; text-align:center; color:#2eb161;">
                        <h5 id='noProj'><img src="../images/search.png" style="height:200px;" /></h5>
                        <h2 id='noProj' >No claimed projects</h2>
                    </div>
                    
                </div>
                
                
                
                <div id="myclaimedprojectview" class="tab-pane fade" >
                    <br>
                    <a data-toggle="tab" href="#incompleteOrders" style="float:left; font-size:16px; text-decoration:none; color:#2eb161;"><span class="glyphicon glyphicon-chevron-left"></span>Take me back</a>
                    <br><br>
                     <table class="table" >
                        <thead>
                            <tr style="font-size:18px;color:#2eb161;">
                                <h3 style="color:#2eb161;">Topic: &nbsp; {{myclaimedproject[myclaimed].Topic}}{{claimed}}</h3>
       
                            </tr>
                         </thead>
                         <tbody style="color:black;">
                             <tr class="success">
                                 <td>Catagory</td>
                                 <td>{{myclaimedproject[myclaimed].Ordertype}}</td>
                             </tr>
                             <tr class="success">
                                 <td>No. of Posts</td>
                                 <td>{{myclaimedproject[myclaimed].NoOfPosts}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Industry of experience</td>
                                 <td>{{myclaimedproject[myclaimed].Industry}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Stipend</td>
                                 <td>{{myclaimedproject[myclaimed].Budget}} ₹</td>
                             </tr>
                             <tr class="success">
                                 <td>Goal</td>
                                 <td>{{myclaimedproject[myclaimed].Goal}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Style of writing</td>
                                 <td>{{myclaimedproject[myclaimed].Styleofwriting}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Content Sample</td>
                                 <td>{{myclaimedproject[myclaimed].ContentSample}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Point of View</td>
                                 <td>{{myclaimedproject[myclaimed].Pointofview}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Content Structure</td>
                                 <td>{{myclaimedproject[myclaimed].ContentStructure}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Target audience</td>
                                 <td>{{myclaimedproject[myclaimed].TargetAudience}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Keypoints</td>
                                 <td>{{myclaimedproject[myclaimed].Keypoints}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Things to avoid</td>
                                 <td>{{myclaimedproject[myclaimed].Thingstoavoid}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Keywords</td>
                                 <td>{{myclaimedproject[myclaimed].Keywords}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Special Instructions</td>
                                 <td>{{myclaimedproject[myclaimed].SpecialInstructions}}</td>
                                 
                             </tr>
                         </tbody>
                    </table>
                    
                    
                    
                    <style>
        
        	#gly-spin {
  -webkit-animation: spin 1s infinite linear;
  -moz-animation: spin 1s infinite linear;
  -o-animation: spin 1s infinite linear;
  animation: spin 1s infinite linear;
}

@-moz-keyframes spin {
  0% {
    -moz-transform: rotate(0deg);
  }
  100% {
    -moz-transform: rotate(359deg);
  }
}
@-webkit-keyframes spin {
  0% {
    -webkit-transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(359deg);
  }
}
@-o-keyframes spin {
  0% {
    -o-transform: rotate(0deg);
  }
  100% {
    -o-transform: rotate(359deg);
  }
}
@keyframes spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg);
  }
}
            
        </style>
        
        <script>
        	$(document).ready(function(){
    			$("#myuploadbutton").click(function(){
        			if ($('#myuploadeddoc').val()=='')
        			{
        				
        				$('#docemptywarning').css('display', 'block');
        			}
        			
        			else
        			{
        				var filename = $('#myuploadeddoc').val().replace(/C:\\fakepath\\/i, '');
        				var extensionname= filename.split('.').pop();
        				
        				var defaultextensions= ["doc", "docx", "pdf"];
        				
        				if( jQuery.inArray(extensionname, defaultextensions) !== -1 )
        				{
        					/*var myorderID=$("#WporderID").val();
        					var ClientName=$("i#ClientName").val();
        					var MyWpwriter=$("#MyWpwriter").val();
        					var myuploadfile=document.getElementById("#myuploadeddoc");
        					
        					
        					var dataString = 'WporderID='+ myorderID + '&ClientName=' + ClientName + '&MyWpwriter=' + MyWpwriter +'&doc=' + myuploadfile;
 						 //alert (dataString);return false;
 						$.ajax({
 						type: "POST",
 						url: "./upload.php",
   						data: dataString,
    						success: function() {
     							 alert('done');
  							});
  						return false;*/
  						
  						$('#myuploadform').submit();
 


        				}
        			}
        			
        			
    			});
		});
        </script>
      
      <style>
      	.myuploadblock
      	{
      		background:red;
      		border-color:red;
      		
      	}
      	.myuploadblock:hover
      	{
      		background:red;
      		border-color:red;
      	}
      </style>
      
                    
                    <div class="alert" ng-hide="myclaimedproject[myclaimed].ThisOrderStatus=='Claimed'"  ng-class="{'alert-info':myclaimedproject[myclaimed].ThisOrderStatus=='Uploaded' || myclaimedproject[myclaimed].ThisOrderStatus=='ResubmitTimeup', 'alert-success':myclaimedproject[myclaimed].ThisOrderStatus=='Approved', 'alert-warning':myclaimedproject[myclaimed].ThisOrderStatus=='Rejected', 'alert-danger':myclaimedproject[myclaimed].ThisOrderStatus=='Timeout'}" style="text-align:center;margin-right:3.5%;">
                    
  					<span ng-show="myclaimedproject[myclaimed].ThisOrderStatus=='Uploaded'" >You have already uploaded. Your content is under review. If you want to improve your submitted content, you can upload again within<br> {{myclaimedproject[myclaimed].ResubmitRemainingTime}}.</span>
  					<span ng-show="myclaimedproject[myclaimed].ThisOrderStatus=='ResubmitTimeup'" >Your uploaded content is under review. Content status will be uploaded shortly.</span>
  					<span ng-show="myclaimedproject[myclaimed].ThisOrderStatus=='Approved'" >Your uploaded content is appoved. Your balance has been updated.</span>
  					<span ng-show="myclaimedproject[myclaimed].ThisOrderStatus=='Rejected'" >Your submitted content is rejected due low quality. Please try claiming another project.</span>
  					<span ng-show="myclaimedproject[myclaimed].ThisOrderStatus=='Timeout'" >Rejected due no response within 36 hours. Please try to submit in time in your upcoming projects to avoid temporary block.</span>
		    </div>
                    <form id="myuploadform" action="./upload.php"  method="POST" enctype="multipart/form-data" style="text-align:center;">
            
             		<input type="hidden" id="WporderID" name="WporderID" value="{{myclaimedproject[myclaimed].WpTransactionID}}"/>
             		<input type="hidden" id="ClientName" name="ClientName" value="{{myclaimedproject[myclaimed].Client}}"/>
             		<input type="hidden" id="MyWpwriter" name="MyWpwriter" value="<?php echo $_SESSION['username']; ?>"/>
  
        		<div class="fileupload fileupload-new" data-provides="fileupload">
        			
        			
        			
    				<span class="btn btn-primary btn-file" id="mainupbut" ng-class="{'myuploadblock': myclaimedproject[myclaimed].ThisOrderStatus=='Rejected' || myclaimedproject[myclaimed].ThisOrderStatus=='Timeout'}" ><span class="fileupload-new" >Select file</span>
    				<span class="fileupload-exists">Change</span>         <input ng-disabled="myclaimedproject[myclaimed].ThisOrderStatus=='Rejected' || myclaimedproject[myclaimed].ThisOrderStatus=='Timeout' || myclaimedproject[myclaimed].ThisOrderStatus=='ResubmitTimeup'" type="file" name="doc" id="myuploadeddoc" /></span>
    				<span class="fileupload-preview"></span>
    				<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a><br><br>
            			<button class="btn btn-info" ng-class="{'btn-danger': myclaimedproject[myclaimed].ThisOrderStatus=='Rejected' || myclaimedproject[myclaimed].ThisOrderStatus=='Timeout'}" ng-disabled="myclaimedproject[myclaimed].ThisOrderStatus=='Rejected' || myclaimedproject[myclaimed].ThisOrderStatus=='Timeout' || myclaimedproject[myclaimed].ThisOrderStatus=='ResubmitTimeup'" type="button"  id="myuploadbutton"  >Upload File <i class="glyphicon glyphicon-refresh" id="gly-spin"></i></button>
            			<p id="docemptywarning" style="color:red; display:none;">No file selected to upload.</p>
            			<p id="docformatwarning" style="color:red; display:none;">Please upload a pdf, doc or docx file.</p>
  			</div>
  
 		    </form>
                    
<!--                    UNCLAIM CODE  HERE------->
                    
                    
                </div>
                
                
                
                <div id="mypayment" class="tab-pane fade paymentInfo">
                    
                    <br><br><br>
                        
                    <?php include("paymentdata.php"); ?>
                </div>

                
            </div>


        </div>
            
        <div id = "footer">
            
            <div id = "footer-links">
                <span id="copyright">Copyright © 2015 whitepanda.in. All rights reserved.</span>
                <a href = "privacy.html">Privacy</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href = "termsUse.html">Terms of Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href = "writersAgreement.html">Writers' Privacy Agreement</a><br/>
            </div>
        </div>
    </body>
</html>