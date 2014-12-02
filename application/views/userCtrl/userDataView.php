
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
        Username: <?php echo $username; ?> </br>
        Email address: <?php echo $email,$userStatus === userModel:: USER_STATUS_VERIFIED ? ' (verified)':' (not verified)';?> </br>
        Full name: <?php echo $fullName; ?>
        <fieldset>
        <legend>Personalia:</legend>
        Name: <input type="text"><br>
        Email: <input type="text"><br>
        Date of birth: <input type="text">
        </fieldset>
        <?php echo "<a href = ".base_url()."index.php/user_ctrl/Send_new_verify_code> Send new verify code </a>"; ?>
    </h4>
</div>
</body>