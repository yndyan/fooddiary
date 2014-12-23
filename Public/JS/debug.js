$(document).ready(function(){
    
    $("#testdugme").click(function()
    {
        var getUrl = window.location;
        var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]; 
        $("#demo").text(getUrl);
        $("#demo2").text(baseUrl);
        
        
    });
    
});

