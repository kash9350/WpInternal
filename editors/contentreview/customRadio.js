
function contentOp($temp)
{
    switch (true)
    {
        case ($temp==1):
            $("#reject").show();
            $("#correctionPoints").hide();
            $("#upload").hide();
            break;
        case ($temp==2):
            $("#correctionPoints").show();
            
            $("#upload").hide();
            break;
        case ($temp==3):
            
            $("#upload").show();
            $("#correctionPoints").hide();
            
            break;
            
    }
    
}

$(document).ready(function () {


});