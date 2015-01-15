
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
    <form action="<?php echo base_url();?>index.php/auth_ctrl/send_password_verify_code" method = "post" >
        <h2> Password reset page</h2>
        <h3>Please insert username or email address </h3>
        <h4>
            Email or username:
            <input type = "text" name = "username_or_email"  required = "true" />

        </h4>
        <h4>
            <input type="submit"  value = "Accept"/>
        </h4>
        <h4>
        <font color="red"><?php echo $this->session->flashdata('verify_warning');?></font>
        </h4>
    </form>
</div>
</body>