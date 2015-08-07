<!DOCTYPE HTML>
<html>
    <head>
    	<title>iamavailablefor.work - Create your profile</title>
        <link href="<?php echo base_url(); ?>static/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
        <link href="<?php echo base_url(); ?>static/css/homeStyle.css" rel="stylesheet" type="text/css" media="all" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="iamavailablefor.work is a website for showcasing your skills as a professional." />
        <script src="<?php echo base_url(); ?>static/js/jquery-1.11.1.min.js"></script>

        <style type="text/css">
            input[type="text"], input[type="password"]{
                width: 50%;
                height: 30px;
            }
            input[type="submit"]{
                width: 50%;
                height: 30px;
            }
            .validation_error{
                width: 50%;
                color: red;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <?php $this->load->view('inc.header.php'); ?>  
        <section class="container">
            <div class="page">
                <h3>Create your profile</h3>
                <br>
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
                    <input type="submit" value="Sign up" />
                <?php echo form_close(); ?>
            </div>
        </section>

        <?php $this->load->view('inc.footer.php'); ?>
    </body>
</html>