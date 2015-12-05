var app= angular.module('myApp', []);
app.controller('businessdatabase', function($scope, $http, $sce, $timeout){
    $http.get("./myorderlist.php").success(function(response){
        $scope.myorderlist=response.orders;
    
        
        
        
        
    
    });
    
        
    $http.get("./receivedcontentlist.php").success(function(response){
        $scope.myreceivedfiles=response.receive;
        
        });
    
    
    
    $http.get("./emptycheck.php").success(function(response){
        $scope.myQueryProperties=response.myQueries;
        
        });
    
    
    
    $scope.classproperties = 0; //set selected tab to the 1st by default.
        
        /** Function to set selectedTab **/
        $scope.searchstatus = function(index){
            $scope.classproperties = index;
        }
        
        
        
        
        $scope.details = 0; //set selected tab to the 1st by default.
    
        /** Function to set selectedTab **/
        $scope.mydescriptionselect = function(index){
            $scope.details = index;
        }
             
                                                       
});



	    
	





