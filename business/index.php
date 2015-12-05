<?php


session_start();

if (!isset($_SESSION['myWpUsername']) || empty($_SESSION['myWpUsername']) || !isset($_SESSION['myWpPassword']))
{


echo    '<script type="text/javascript">

   window.location="../php/businessLogin.php";

</script>';
   exit();
}

else
{
	$user=$_SESSION["myWpUsername"];
	$wpPassword= $_SESSION["myWpPassword"];
	
}


include('dbConn.php');


$intercom="SELECT firstName, lastName, mobile FROM signup_business WHERE email='".$_SESSION['myWpUsername']."'";


$con3=mysqli_fetch_object(mysqli_query($conn, $intercom));

$name= $con3->firstName." ".$con3->lastName;
$mobile=$con3->mobile;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" type="[MIME TYPE]" href="../images/webicon.png" />
        <meta charset="utf-8"/>
        
        <link rel="stylesheet" type="text/css" href="../css/footer.css"/>

        <link rel="stylesheet" type="text/css" href="businessHomepage.css">
        <link rel="stylesheet" type="text/css" href="header.css">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="lib/bootstrap.min.css">
        <script src="lib/jquery.min.js"></script>
        <script src="lib/bootstrap.min.js"></script>
        
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        
        
        
        <script src = "businessHomepage_jquery-1.11.1.js"></script>
        <script src = "formvalidation.js"></script>
        
        
 
        <script src="progressbar.js"></script>


        
        
        <link rel="stylesheet" type="text/css" href="orderstatusprogressbar.css"/>
        
        
        
        
        
        <script src="lib/angular.min.js"></script>
        <script src="app.js"></script>

  
        <link rel="stylesheet" type="text/css" href="progressbar.css"/>
        <link rel="stylesheet" type="text/css" href="formvalidation.css"/>
        
        <title>Business- White Panda</title>
        
        
        
<!--        INTERCOM IMPORT--------------->
        
 
        
        
        
    </head>
    
    
    
    
    
    
    
    <body>
        


        
        
        
        <div id = "header">
            <a id = "home" href="/">
                <img id = "opaque" src="../images/full_logo_white.png"/>
            </a>
            <span style="position:absolute; font-size:31px; font-family:champ; top:1px; left:341px; color:#fff;">Business</span>
            <div class = "nav-bar">
                <ul>
                    
                    
                    <li><a style="font-family:nesia" href='../php/signOutWriters.php'>Sign out</a></li>
                    <li><a style="font-family:nesia"><?php echo $_SESSION['myWpUsername']; ?></a></li>
                    
                    
                </ul>
                
            </div>

         

        </div>
        
        
        
        
        
    
        
        <div class="container business_main">
            
            
           

            <div class="business_tab">
                <ul>
                    
                    <a data-toggle="tab" href="#ordernow"><li >Order now</li></a>
                    <a data-toggle="tab" href="#myorderedcontent"><li >My orders</li></a>
                    <a data-toggle="tab" href="#received"><li >Received files</li></a>
                </ul>
            </div>
            
            <div ng-app="myApp" ng-controller="businessdatabase" class='tab-content tab_result'>
                
                
        
                
                <div id="welcome">
                    <h1>Welcome to our desk</h1>
                    <h5><img src="../images/desk2.png"/></h5>
                </div>
                
                
                <div id="ordernow" class="tab-pane fade order_now">
        
                    <div class="row" style=" margin-left:-20px;">
		                  <section>
                              <div class="wizard">                          
<!-- ---------------------------   INCLUDING ORDER PROGRESS BAR -------------->
                                  <?php include('orderprogressbar.html'); ?>
<!--                                  --------------------------------------------->
                                  
            
                                  <form role="form" action="pgexecute.php" method="post" name="payuForm">

            
                                      <div class="myfooterposition tab-content">
                                          <div class="tab-pane active" role="tabpanel" id="step1">
                                              
<!----------------------------------------INCLUDING STEP 1------------------------------->
                                              <?php include('orderformstep1.html'); ?>
<!--  ------------------------------------------------------------------------------- -->              
                        
                                          </div>
                                          
                                          <div class="tab-pane" role="tabpanel" id="step2">
                                              
                        
<!--    ------------------------------------INCLUDING STEP 2----------------------------->
                                            <?php include('orderformstep2.html'); ?>
<!--        ----------------------------------------------------------------------------->
                        
                        
                                          </div>
                
                
                                          <div class="tab-pane" role="tabpanel" id="step3">
                        
                        
<!--                       ---------------INCLUDING STEP 3------------------------------->
                                              <?php include('orderformstep3.html'); ?>
                                              
<!--                                              --------------------------------------->
                                          </div>
                    
                    
                                      </div>
                                  </form>
                              </div>
                        </section>
                    </div>          
                </div>
                
                <div id="myorderedcontent" class="tab-content tab-pane fade" ><br><br>
                    
                    <div ng-class="{myqueryempty: myQueryProperties[0].OrderQuery==0}" id="myorderlist" class="tab-pane fade in active">
                        <h2>Your orders</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Transaction ID</td>
                                    <td>Date</td>
                                    <td>Catagory</td>
                                    <td>Amount(₹)</td>
                                    <td>Details</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="x in myorderlist" class="info">
                                    <td>{{x.TransactionID}}</td>
                                    <td>{{x.Date}}</td>
                                    <td>{{x.Ordertype}}</td>
                                    <td>{{x.Amount}}</td>
                                    <td><button type="button" ng-click="mydescriptionselect($index)" data-toggle="tab" href="#description" class="btn btn-info btn-sm">Check</button></td>
                                    <td><button type="button" ng-click="searchstatus($index)" data-toggle="tab" href="#statustab" class="btn btn-success btn-sm">View</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="description" class="tab-pane fade">
                        <a data-toggle="tab" href="#myorderlist" style="color:#2eb161; text-decoration:none; font-size:15px;"><span class="glyphicon glyphicon-chevron-left"></span>Take me back</a>
                        
                        <h2>My Order Details</h2>
                        
                        
                        
                        <table class="table" >
                        <thead>
                                <tr style="font-size:18px;color:#2eb161;">
                                    <h3 style="color:#2eb161;">Topic: &nbsp; {{myorderlist[details].Topic}}</h3>
       
                                </tr>
                         </thead>
                         <tbody style="color:#2eb161;">
                             <tr class="success">
                                 <td>Catagory</td>
                                 <td>{{myorderlist[details].Ordertype}}</td>
                             </tr>
                             <tr class="danger">
                                 <td>No. of Posts</td>
                                 <td>{{myorderlist[details].NoOfPosts}}</td>
                             </tr>
                             <tr class="info">
                                 <td>Industry of experience</td>
                                 <td>{{myorderlist[details].Industry}}</td>
                             </tr>
                             <tr class="danger">
                                 <td>Stipend</td>
                                 <td>{{myorderlist[details].Amount}} ₹</td>
                             </tr>
                             <tr class="success">
                                 <td>Goal</td>
                                 <td>{{myorderlist[details].Goal}}</td>
                             </tr>
                             <tr class="danger">
                                 <td>Style of writing</td>
                                 <td>{{myorderlist[details].Styleofwriting}}</td>
                             </tr>
                             <tr class="info">
                                 <td>Content Sample</td>
                                 <td>{{myorderlist[details].ContentSample}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Point of View</td>
                                 <td>{{myorderlist[details].Pointofview}}</td>
                             </tr>
                             <tr class="danger">
                                 <td>Content Structure</td>
                                 <td>{{myorderlist[details].ContentStructure}}</td>
                             </tr>
                             <tr class="info">
                                 <td>Target audience</td>
                                 <td>{{myorderlist[details].TargetAudience}}</td>
                             </tr>
                             <tr class="success">
                                 <td>Keypoints</td>
                                 <td>{{myorderlist[details].Keypoints}}</td>
                             </tr>
                             <tr class="danger">
                                 <td>Things to avoid</td>
                                 <td>{{myorderlist[details].Thingstoavoid}}</td>
                             </tr>
                             <tr class="info">
                                 <td>Keywords</td>
                                 <td>{{myorderlist[details].Keywords}}</td>
                             </tr>
                             <tr class="info">
                                 <td>Special Instructions</td>
                                 <td>{{myorderlist[details].SpecialInstructions}}</td>
                                 
                             </tr>
                         </tbody>
                    </table>
                    
                    </div>
                    
                    <div id="statustab" class="tab-pane fade">
                        
                        <a data-toggle="tab" href="#myorderlist" style="color:#2eb161; text-decoration:none; font-size:15px;"><span class="glyphicon glyphicon-chevron-left"></span>Take me back</a>
                        
                        <h2>My order status</h2>
                        
                        <div class="mycustomwizard orderstats">
                        <div class="mycustomwizard-inner">
    <div class="connecting-line"></div>
    <ul class="nav nav-tabs" role="tablist">
                                             
        <li role="presentation" class="active disabled">
            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Choose Type">
                <span class="round-tab">
                    <i style="vertical-align:center;" class="glyphicon glyphicon-time"></i>
                    
                </span>
                
                
            </a>
            <h3 id="myok" class="glyphicon glyphicon-ok" ></h3>
            <h4>Waiting for writers</h4>
        </li>
        
        <li role="presentation" ng-class="{active: myorderlist[classproperties].ClaimedStatus==1}" class="disabled">
            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Suggest Details">
                <span class="round-tab">
                    <i class="glyphicon glyphicon-pencil"></i>
                    
                </span>
            </a>
            <h3 id="myok" class="glyphicon glyphicon-ok" ></h3>
            <h4>Writer has claimed</h4>
        </li>
        
        
        
        <li role="presentation" ng-class="{active: myorderlist[classproperties].ReviewStatus==1}" class="disabled">
            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Pay">
                <span class="round-tab">
                    <i class="glyphicon glyphicon-edit"></i>
                </span>
            </a>
            <h3 id="myok" class="glyphicon glyphicon-ok" ></h3>
            <h4 >Writer has submitted. Content under review.</h4>
        </li>
        <li role="presentation" ng-class="{active: myorderlist[classproperties].ReceiveStatus==1}" class="disabled">
            <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Suggest Details">
                <span class="round-tab">
                    <i class="glyphicon glyphicon-upload"></i>
                </span>
                
            </a>
            <h3 id="myok" class="glyphicon glyphicon-ok" ></h3>
            
            <h4>Content reveived. Check your received tab.</h4>
        </li>

                       
    </ul>
</div>
                        </div>
                        
                    </div>
                    
                    <div ng-class="{myqueryempty: myQueryProperties[0].OrderQuery!=0}">
                        <h1>No Content Ordered</h1>
                        <img src="../images/receivedContent.png"/>
                    </div>
                </div>
                
                
                <div id="received" class="tab-pane fade received_content">
                    
                    <div ng-class="{myqueryempty: myQueryProperties[0].ReceiveQuery==0}" id="receivedlist" class="tab-pane fade in active">
                        <h2>Your received content</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Transaction ID</td>
                                    <td>Ordered on</td>
                                    <td>Received on</td>
                                    <td>Catagory</td>
                                    <td>Topic</td>
                                    <td>Stipend</td>
                                    <td>Download key</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="x in myreceivedfiles" class="info">
                                    <td>{{x.TransactionID}}</td>
                                    <td>{{x.OrderDate}}</td>
                                    <td>{{x.ReceiveDate}}</td>
                                    <td>{{x.Ordertype}}</td>
                                    <td>{{x.Topic}}</td>
                                    <td>{{x.Amount}}</td>
                                    <td><button type="button" class="btn btn-success btn-sm">Download</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    
                    
                    
                    
                    
                    <div ng-class="{myqueryempty: myQueryProperties[0].ReceiveQuery!=0}">
                    
                        <h1>No Content Received</h1>
                        <img src="../images/receivedContent.png"/>
                    </div>
                </div>
                
                
            </div>


        </div>
        
    
    
    
<!--    footer------------>
        
        
<!--
        
        <div id = "footer">
        
            <div id = "footer-links">
                <span id="copyright">Copyright © 2015 whitepanda.in. All rights reserved.</span>
                <a href = "privacy.html">Privacy</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href = "termsUse.html">Terms of Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href = "writersAgreement.html">Writers' Privacy Agreement</a><br/>
            </div>
        </div>
-->
    </body>
</html>
