
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
    <h3>User data page </h3>
    <h4>
        <fieldset >
        <legend>Personal data:</legend>
        Username: <input type="text" value = "<?php echo $username; ?>"  size="35" readonly><br>
        Email: <input type="text" size="35" value = "<?php echo $email,$userStatus === users_m:: USER_STATUS_VERIFIED ? ' (verified)':' (not verified)';?>"  readonly><br>
        Full name: <input type="text"  size="35" value = "<?php echo $fullName; ?>" readonly> 
        </fieldset>
        <?php echo "<a href = ".base_url()."index.php/user_c/Send_new_verify_code> Send new verify code </a>";//mydo delete this ?>
    </h4>
    
    <p><a href = "<?php echo base_url();?>index.php/user_c/change_user_password">Change password</a></p>
    <p><a href = "<?php echo base_url();?>index.php/user_c/change_user_data">Change user data</a></p>
</div>
</body>