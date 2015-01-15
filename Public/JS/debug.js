window.onload = function(){
   var xmlhttp;
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }//if
    else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }//else

    var my_list =  document.getElementById("myList");
    var input_field = document.getElementById("field1");   
    
    
    
    
    xmlhttp.onreadystatechange = function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            var rezultat = JSON.parse(xmlhttp.responseText);
            
            while (my_list.firstChild){
                my_list.removeChild(my_list.firstChild);
            }
            for(i=0;i<rezultat.length;i++){
                function add_remove_list_item(j){
                        var x = document.createElement("LI");
                var t = document.createTextNode(rezultat[j].value);
                x.appendChild(t);
                var achild = my_list.appendChild(x);
                console.log( JSON.stringify(achild) );    
                achild.onclick = function(){
                    input_field.value = t.wholeText; 
                    while (my_list.firstChild){
                       my_list.removeChild(my_list.firstChild);
                    }//while
                };//function
    }
                add_remove_list_item(i);
            }; //for
          
        };//if
    };//function
    
    input_field.onkeyup = function (){
        var in_string =  input_field.value ;//pokupi vrednost
        if(in_string.length >1){//ajax
            xmlhttp.open("POST","http://localhost/fooddiary/index.php/debug_ctrl/vrati",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("like_value="+in_string );
        }//if
        else{
            while (my_list.firstChild){
                my_list.removeChild(my_list.firstChild);
            }
        }
    };
};//onload

	