<style>
    #content
    {
        width: 600px;
        height: 400px;
        position: absolute;
        top: 200px;
        left: 100px;
        border-style: solid;
        border-color: black;
        padding-left :10px;


    }

</style>
<body>
<div id="content">
    <h2> Registration page</h2>

    <h3>Please insert your data </h3>


    <form action = "<?php echo base_url(); ?>index.php/auth_ctrl/register_new_user" method = "post">
        <h4>
            Username:*
            <input type = "text"        name = "username"   required = "true"  value="<?php echo set_value('username'); ?>" />
            <?php echo form_error('username'); ?>
        </h4>

        <h4>
            Password:*
            <input type = "password"    name = "password"   required = "true"/>
            <?php echo form_error('password'); ?>
        </h4>


        <h4>
            Password confirmation:*
            <input type = "password"    name = "confpass"   required = "true""/>
            <?php echo form_error('confpass'); ?>
        </h4>

        <h4>
            Email adress:*
            <input type = "text"        name = "email"      required = "true"   value="<?php echo set_value('email'); ?>"/>
            <?php echo form_error('email'); ?>
        </h4>

        <h4>
            Full name:       <input type = "text"        name = "fullname"       value="<?php echo set_value('fullname'); ?>"/>
        </h4>

        <h4>
            <input type = "submit"  value = "Accept"    />
        </h4>
        <h4>* - this fields are required for registration</h4>


    </form>
</div>
</body>