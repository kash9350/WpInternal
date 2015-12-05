var app= angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http, $sce, $timeout){
    $http.get("./uploadedFiles.php").success(function(response){
        $scope.names=response.records;
        
        
        $scope.initialCond = function() {
        
            $scope.rejectionContent=$sce.trustAsHtml("Confirm Rejection");
            
            $scope.sendCorrection=$sce.trustAsHtml("Claim Corrections");
            $scope.extendtimefx=$sce.trustAsHtml("Extend Time");
            $scope.approvalBtn=$sce.trustAsHtml("Approve and Pay");
            
            
        }
        
        $scope.rejectionWriter = function( writer, wporderID) {

            
            
            
            $scope.rejectionContent=$sce.trustAsHtml('<span id="loading" class="glyphicon glyphicon-refresh"></span>&nbsp;Rejecting Writer');
            
            
            $http({
    method: 'POST',
    url: 'rejectWriter.php',
    data: "writerEmail=" + writer+ "&wprderID="+wporderID,
    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
});
            
            /*$http.post('rejectWriter.php', {writerEmail: 'writer'}).
success(function(data, status, headers, config) {
  // this callback will be called asynchronously
  // when the response is available
}).
error(function(data, status, headers, config) {
  // called asynchronously if an error occurs
  // or server returns response with an error status.
});*/
            
            $scope.finished=function()
            {
                $scope.rejectionContent=$sce.trustAsHtml('<span  class="glyphicon glyphicon-ok"></span>&nbsp;Writer Rejected');
            }
            $timeout( function(){ $scope.finished(); }, 2500);
            
            //$scope.rejectionContent='<span id="loading" class="glyphicon glyphicon-refresh"></span>&nbsp; Rejecting Writer';  

	           
	    };
        
        
	    $scope.correction = function(writer, points) {
	         $scope.sendCorrection=$sce.trustAsHtml('<span id="loading" class="glyphicon glyphicon-refresh"></span>&nbsp;Sending');  
            
            $http({
                method: 'POST',
                url: 'comment.php',
                data: "writerEmail=" + writer+"&comments="+points,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
            
            
            $scope.finished=function()
            {
                $scope.sendCorrection=$sce.trustAsHtml('<span  class="glyphicon glyphicon-ok"></span>&nbsp;Sent');
            }
            $timeout( function(){ $scope.finished(); }, 2500);
            
            
            
	    };
        
        
        $scope.extension = function(writer, orderID, extendedTime, remainingTime) {
            $scope.extendtimefx=$sce.trustAsHtml('<span id="loading" class="glyphicon glyphicon-refresh"></span>&nbsp;Extending');
            
            
            if (remainingTime!='IsNegative')
            {
                var canExtendTime=remainingTime-24;
                    
                if (canExtendTime>=extendedTime)
                {
                    $http({
                    method: 'POST',
                    url: 'writerTimeExtension.php',
                    data: "writerEmail=" + writer+"&wporderID="+orderID+"&extendedTime="+extendedTime,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
                    
                    $scope.finished=function()
                    {
                        $scope.extendtimefx=$sce.trustAsHtml('<span  class="glyphicon glyphicon-ok"></span>&nbsp;Extended');
                    }
                    $timeout( function(){ $scope.finished(); }, 2500);
                }
                
                else
                {
                    $scope.finished=function()
                    {
                        $scope.extendtimefx=$sce.trustAsHtml('<span  class="glyphicon glyphicon-ok"></span>&nbsp;Your entry is crossing left time limit');
                    }
                    $timeout( function(){ $scope.finished(); }, 2500);   
                }
            }
            
            
                
            
            
            
            
            
            
            
	    };
        
        
        
        $scope.approval = function(writer, orderID, uploadStatus, paidAmount) {
            $scope.approvalBtn=$sce.trustAsHtml('<span id="loading" class="glyphicon glyphicon-refresh"></span>&nbsp;Requesting Approval');
            
            
            
            
                    
                if (uploadStatus==1)
                {
                    $http({
                    method: 'POST',
                    url: 'writerPaymentWP.php',
                    data: "writerEmail=" + writer+"&wporderID="+orderID+"&writerStatus="+uploadStatus+"&paidAmount="+paidAmount,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
                    
                    $scope.finished=function()
                    {
                        $scope.approvalBtn=$sce.trustAsHtml('<span  class="glyphicon glyphicon-ok"></span>&nbsp;Approval Done');
                    }
                    $timeout( function(){ $scope.finished(); }, 2500);
                }
                
                else
                {
                    $scope.finished=function()
                    {
                        $scope.approvalBtn=$sce.trustAsHtml('<span  class="glyphicon glyphicon-ok"></span>&nbsp;Content has not been uploded.');
                    }
                    $timeout( function(){ $scope.finished(); }, 2500);   
                }
            
            
            
                
            
            
            
            
            
            
            
	    };
        
        
     

        
        
    
    });
                                                       
});



	    
	





