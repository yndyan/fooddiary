<head>
<style>
    #content
    {
        width: 600px;
        height: 400px;
        position: absolute;
        top: 300px;
        left: 100px;
        border-style: solid;
        border-color: black;
        padding-left :10px;

    }
</style>

<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>public/js/jquery-2.1.1.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>public/js/input.js"></script>
 <link rel="stylesheet" href="<?php echo base_url();?>public/css/style.css">
</head>

<body>
<div id="content">
    
    <h2> Add food</h2>
    <div style="float: left;margin-left: 40px;">
       <p> What:* </p>  
        <input  id = "food_in" > 
        <button id = "add">add</button>
        <form action = "<?php echo base_url(); ?>index.php/diary_ctrl/add_food" method = "post">
            <ul id = "food_list" type = "1"> </ul>
    </div>       
    <div style="float: right ;margin-right: 40px;">
            <p>When?</p>
            <p>Date: <input type="text" id="datepicker"></p>

            
        </br>
            <p>Why?</p>
            <input list="reasons" name="reason">
            <datalist id="reasons">
                <option value="Hungry"> 
                <option value="Bored">
                <option value="Free or cheap food">
                <option value="Will be hungry">
                <option value="Tired">
                <option value="Stressed">
                <option value="Watching movie">
                <option value="Reward yourself">
                <option value="Anxious">
                <option value="Feeling empty">
                <option value="Others eat">
                <option value="Special occasion">
                <option value="Put to sleep">
                </datalist>
        <h4>
            <input type = "submit"  value = "Accept"    />
        </h4>
        <h4>* - this fields are required </h4>
    </div>
    </form>
        
    




</body>