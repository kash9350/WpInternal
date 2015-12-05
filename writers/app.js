var app= angular.module('myApp', []);
app.controller('writerdatabase', function($scope, $http, $sce, $timeout){
    $http.get("./jobfeeds.php").success(function(response){
        $scope.myfeeds=response.feeds;
    
        
        
        
        
    
    });
        
    $http.get("./mynotification.php").success(function(response){
        $scope.mynotifications=response.notifications;
        
        });
    
    $http.get("./claimedprojects.php").success(function(response){
        $scope.myclaimedproject=response.myclaims;
        
        });
    
    
    
    $scope.selectedTab = 0; //set selected tab to the 1st by default.
        
        /** Function to set selectedTab **/
        $scope.selectTab = function(index){
            $scope.selectedTab = index;
        }
        
        
   	$scope.claimed = 0; //set selected tab to the 1st by default.
        
        /** Function to set selectedTab **/
        $scope.claimed = function(index){
            $scope.myclaimed=index;
        }
             
                                                       
});



	    
	





