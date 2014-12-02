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
<div id ="content">
    <h3>Please insert and confirm new password </h3>
    <form action="<?php echo base_url(); ?>index.php/auth_ctrl/reset_password/<?php  echo $pass_code; ?>" method = "post">
        <h4>
            New password:
            <input type = "password" name = "new_password"  required = "true" />
            <?php echo form_error("new_password");?>
        </h4>

        <h4>
            Confirm password:
            <input type ="password"  name = "new_confpass"  required = "true" />
            <?php echo form_error ("new_confpass");?>
        </h4>
        <h4>
            <button type = "submit"> Accept</button>
        </h4>
    </form>
</div>
</body>