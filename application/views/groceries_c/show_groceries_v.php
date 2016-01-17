<head>
    <script src="<?php echo base_url(); ?>public/js/add_grocery.js"></script>
</head>

<body>
<?php 
$add_grocery_url = site_url($this->router->fetch_class()).'/add_grocery';
$out = <<<EOD
<div class="container" >
    <div class="row">
        <h2 class ="text-center"> User groceries </h2>
        <h3 class ="text-warning text-center"> {$grocery_message} </h3>
        <ul class ="list-group col-sm-8 col-md-offset-2" id = "grocery_list">
            <li class="list-group-item ">
                <a  href =  " {$add_grocery_url} " class="btn btn-success col-md-offset-2"> 
                    <h5><span class="glyphicon glyphicon-plus"></span> Add new grocery</h5> 
                </a>
                 <a  href =  " #" class="btn btn-success col-md-offset-2" id = "add_grocery_form"> 
                    <h5><span class="glyphicon glyphicon-plus"></span> Add with jquery</h5> 
                </a>
            </li>   
            <!--
            <li class="list-group-item cm_fake_label clearfix">
                <div class="col-sm-9">
                    <input type="text" class="form-control col-sm-3" id="new_grocery" name="new_grocery" required = "true" placeholder="Enter new grocery">
                </div>
                <button type="submit" class="btn btn-default col-md-offset-1 " value = "Accept" >Submit</button> 
            </li>     
            --!>
        {$groceries_list}
        {$pagination}
         </ul>
    </div>
</div>
EOD;

echo $out;
