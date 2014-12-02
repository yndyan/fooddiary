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

<div id ="content">
    <h2>Change user password</h2>
    <h3>Please insert passwords </h3>
    <form action="<?php echo base_url(); ?>index.php/user_ctrl/change_User_Password" method = "post">
        <h4>
            Old password:
            <input type = "text" name = "old_password"  required = "true" />
            <?php echo form_error("old_password");?>
        </h4>

        <h4>
            New password:
            <input type = "text" name = "new_password"  required = "true" />
            <?php echo form_error("new_password");?>
        </h4>

        <h4>
            Confirm new password:
            <input type ="text"  name = "new_confpass"  required = "true" />
            <?php echo form_error ("new_confpass");?>
        </h4>
        <h4>
            <button type = "submit"> Accept</button>
        </h4>
    </form>
</div>
</body>