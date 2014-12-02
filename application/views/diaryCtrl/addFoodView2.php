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
    textarea {
        resize: none;
    }

</style>
<body>
<div id="content">
    <h2> Add food</h2>
    <form action = "<?php echo base_url(); ?>index.php/diary_ctrl/add_food" method = "post">
            <div style="float: left;margin-left: 40px;">
            <p> What:* </p>
            <textarea name = "description"  required = "true" rows="7" cols="30">
- soup
- peas
- salad</textarea>
            <p>Description:</p>
                <textarea name = "description"   rows="2" cols="30">Please enter food description.</textarea>

            </div>

            <div style="float: right; margin-right: 40px;">

        <p>When?</p>
        <select name="date">
            <option value="<?php echo date("Y-m-d",strtotime("-4 day"));?>"><?php echo date("Y-m-d  D",strtotime("-4 day"));?></option>
            <option value="<?php echo date("Y-m-d",strtotime("-3 day"));?>"><?php echo date("Y-m-d  D",strtotime("-3 day"));?></option>
            <option value="<?php echo date("Y-m-d",strtotime("-2 day"));?>"><?php echo date("Y-m-d  D",strtotime("-2 day"));?></option>
            <option value="<?php echo date("Y-m-d",strtotime("-1 day"));?>">Yesterday</option>
            <option selected = "selected" value="<?php echo date("Y-m-d");?>">Today</option>
        </select>
        <select name="time">
            <?php   $hours =  (int)date('H');
            for($cnt = 0; $cnt <($hours-1); $cnt++){
            ?>
            <option value="<?php echo $cnt;?>"><?php echo $cnt,' h';?></option>
            <?php }?>
            <option value="<?php echo date("H",strtotime("-1 hour"));?>">Last hour</option>
            <option selected = "selected" value="<?php echo date("H");?>">Now</option>
        </select>
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