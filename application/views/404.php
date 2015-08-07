<!DOCTYPE HTML>
<html>
    <head>
    	<title>iamavailablefor.work - Oops we can't find that page!</title>
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
                border:;
            }
        </style>
    </head>
    <body>
        <?php $this->load->view('inc.header.php'); ?>  
        <section class="container">
            <div class="page">
                <h3>Missing content</h3>
                <br>
                <div class="errors">
                    <?php
                        if(isset($this->data['errors'])){
                            echo $this->data['errors'];
                        }
                    ?>
                </div>
            </div>
        </section>

        <?php $this->load->view('inc.footer.php'); ?>
    </body>
</html>