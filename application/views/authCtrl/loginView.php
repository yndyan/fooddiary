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
    <h2> Login page </h2>
    <h3><?php echo $this->session->flashdata('verify_warning');?></h3>
    <form action = "<?php echo base_url();?>index.php/auth_ctrl/login" method = "post">
        <h4>Username: <input type="text"   name="username_or_email"  required = "true" value="<?php echo set_value('username_or_email'); ?>"/>
            <?php echo form_error('username_or_email'); ?></h4>
        <h4>Password:  <input type="password"   name="password" required = "true"/>
            <?php echo form_error('password'); ?></h4>
        <h4><button type="submit" name = "button" value="login"> Login </button></h4>
    </form>
    <h3> <font color="red"><?php  //echo $auth_message; ?></font></h3>
    <a href = "<?php echo base_url();?>index.php/auth_ctrl/choose_content/pass_reset">Forgot pass</a>
</div>
</body>

