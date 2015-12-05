$(document).ready(function() {
			<!-- Real-time Validation -->
				
				
    
    
    
    $('#topiccontent').on('input', function() {
					var input=$(this);
					var is_name=input.val();
					if(is_name){input.removeClass("invalid").addClass("valid");}
					else{input.removeClass("valid").addClass("invalid");}
				});
    
    

    
    
				
				
        
        
		function myaletrs(area, varalert)
        {
            var input=$(area);
					var is_name=input.val();
					if(is_name){
                       
                        $(varalert).css({display:'none'});
                        $(area).css({borderColor:'green', borderWidth:'1px'});
                    }
					else{
                        $('html, body').animate({scrollTop: '260px'}, 400);
                       
                        $(varalert).css({display:'inline'});
                        $(area).css({borderColor:'red', borderWidth:'1px'});
                    }
        }
			<!-- After Form Submitted Validation-->
			$("#valck").click(function(event){
                
				myaletrs('#qualitysel', '#e1');
				myaletrs('#topiccontent', '#e2');
				myaletrs('#industryid', '#e3');
			});
			
			
			

});