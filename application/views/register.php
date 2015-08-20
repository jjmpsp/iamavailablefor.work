<!DOCTYPE HTML>
<html>
    <head>
    	<title>iamavailablefor.work - Create your profile</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="iamavailablefor.work is a website for showcasing your skills as a professional." />

        <link rel="icon" href="<?php echo base_url(); ?>static/images/favicon.ico">
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/uikit.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/base.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/register.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/sweetalert.css" />
        
        <script src="<?php echo base_url(); ?>static/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>static/js/uikit.min.js"></script>
        <script src="<?php echo base_url(); ?>static/js/sweetalert.min.js"></script>
    </head>
    <body>
        <?php $this->load->view('inc.header.php'); ?>  
        
        <div class="uk-container uk-container-center">
            <div class="uk-grid">
                <div class="uk-width-12">   
                    <div class="page">
                        <h3>Create your profile</h3>
                        <p>Please input your email address, a username, and a password to sign up to <i>iamavailablefor.work</i>.</p>
                        <hr>
                        <?php
                            $attributes = array('id' => 'createAccountForm', 'method' => 'POST');
                            echo form_open(base_url().'register/', $attributes);
                        ?>
                            <div class="validation_error"><?php echo form_error('email'); ?></div>
                            <label>Your email address:</label>
                            <br>
                            <input type="text" name="email" placeholder="Enter your email address" value="<?php echo set_value('email'); ?>" />
                            <br>
                            <br>
                            <div class="validation_error"><?php echo form_error('email_confirm'); ?></div>
                            <label>Confirm your email address:</label>
                            <br>
                            <input type="text" name="email_confirm" placeholder="Confirm your email address" value="<?php echo set_value('email_confirm'); ?>" />
                            <br>
                            <br>
                            <div class="validation_error"><?php echo form_error('password'); ?></div>
                            <label>Choose a password:</label>
                            <br>
                            <input type="password" name="password" placeholder="Enter a password" value="<?php echo set_value('password'); ?>" />
                            <br>
                            <br>
                            <div class="validation_error"><?php echo form_error('password_confirm'); ?></div>
                            <label>Confirm your password:</label>
                            <br>
                            <input type="password" name="password_confirm" placeholder="Confirm your password" value="<?php echo set_value('password_confirm'); ?>" />
                            <br>
                            <br>
                            <div class="validation_error"><?php echo form_error('username'); ?></div>
                            <label>Choose a username:</label>
                            <br>
                            <input type="text" name="username" placeholder="Enter a username" value="<?php echo $this->input->get('username') ? $this->input->get('username') : set_value('username'); ?>" />
                            <br>
                            <br>
                            <input type="submit" class="uk-button uk-button-primary" value="Sign up" />
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('inc.footer.php'); ?>
    </body>
</html>