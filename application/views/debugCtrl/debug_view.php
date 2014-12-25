<head>
    <script src="<?php echo base_url();?>public/js/jquery-2.1.1.min.js"></script>

    <script src="<?php echo base_url();?>public/js/debug.js"></script>
    
    
    <style>

    ul.moj_stil li {
        border-style: solid;
        border-width: 1px;
        width: 150px;
        text-align: center;
        list-style-type:none;
    }

    ul.moj_stil li:hover {
        background-color: lightgrey;
    }
    .field{
        margin-left: 40px;
        text-align: center;
        width: 152px;
        border-style: solid;
        border-color: black;
        border-width: 3px;
    }
    </style>
</head>

<body>

  <input  id="field1" class ="field"> 
  <ul id="myList" class = "moj_stil" > </ul>
  
  </br>
  </br>
  
  <input  id="field2" class ="field"> 
  <ul id="myList2" class = "moj_stil" > </ul>
  
  

  
</body>

<script>











    $("#testdugme").click(function(){
        var getUrl = window.location;
        var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]; 
        $("#demo").text(getUrl);
        $("#demo2").text(baseUrl);

    });


</script>