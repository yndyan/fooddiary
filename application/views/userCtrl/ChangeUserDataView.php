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

<body>
<div id="content">
    <h2>Change user data</h2>
    <h3>Please insert new data </h3>
    <form action = "<?php echo base_url(); ?>index.php/user_c/change_User_Data"  method = "post">
        <h4>
            Email adress:
            <input type = "text"        name = "email"    value="<?php echo (set_value('email')?set_value('email'):$email);?>"/>
            <?php echo form_error('email'); ?>
        </h4>

        <h4>
            Full name:
            <input type = "text"        name = "fullname"  value="<?php echo (set_value('fullname')?set_value('fullname'):$fullName); ?>"/>
        </h4>

        <h4>
            <input type = "submit"  value = "Accept"    />
        </h4>

    </form>
</div>
</body>