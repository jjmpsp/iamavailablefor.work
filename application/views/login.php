<!DOCTYPE HTML>
<html>
    <head>
    	<title>iamavailablefor.work - Login to your account</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="iamavailablefor.work is a website for showcasing your skills as a professional." />

        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/uikit.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/base.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/login.css" />
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
                        <h3>Login to your account</h3>
                        <p>Please input your username and password to login to <i>iamavailablefor.work</i></p>
                        <hr>
                        <div class="errors">
                            <?php
                                if(isset($this->data['errors'])){
                                    echo $this->data['errors'];
                                }
                            ?>
                        </div>
                        <?php
                            $attributes = array('id' => 'login', 'method' => 'POST');
                            echo form_open(base_url().'login/', $attributes);
                        ?>  
                            <div class="validation_error"><?php echo form_error('email'); ?></div>
                            <label>Your email address:</label>
                            <br>
                            <input type="text" name="email" id="email" placeholder="Your email address." />
                            <br>
                            <br>
                            <div class="validation_error"><?php echo form_error('password'); ?></div>
                            <label>Your password:</label>
                            <br>
                            <input type="password" name="password" id="password" placeholder="Your password." />
                            <br>
                            <br>
                            <input type="submit" class="uk-button uk-button-primary" value="Login" />
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('inc.footer.php'); ?>
    </body>
</html>