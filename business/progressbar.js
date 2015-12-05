$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
        
        
        
        var footer=$( document ).height() + 200;
  
        $("#footer").css('top',footer);

    });
    
    
    
    
    $(".check-next-step").click(function (e) {

        
            var input1=$('#qualitysel');
            var input2=$('#topiccontent');
            var input3=$('#industryid');
					var is_name1=input1.val();
					var is_name2=input2.val();
					var is_name3=input3.val();
					if(is_name1 && is_name2 && is_name3)
                    {
                       
                        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
                    }
					
        
        
        
        

    });
    
    
    
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}