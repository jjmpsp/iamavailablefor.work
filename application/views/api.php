<!DOCTYPE HTML>
<html>
    <head>
    	<title>iamavailablefor.work - API</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="iamavailablefor.work is a website for showcasing your skills as a professional." />

        <link rel="icon" href="<?php echo base_url(); ?>static/images/favicon.ico">
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/uikit.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/base.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/home.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/sweetalert.css" />
        
        <script src="<?php echo base_url(); ?>static/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>static/js/uikit.min.js"></script>
        <script src="<?php echo base_url(); ?>static/js/sweetalert.min.js"></script>
        
        <style type="text/css">
            .apiMethodsList{
                margin-top:10px;
            }
            .apiMethodsList li{
                margin-left: 0px;
                margin-bottom: 10px;
            }
            .apiMethod{
                padding: 3px;
                background: #b3fb98;
                color: green;
            }
            .code{
                padding: 2px 4px;
                font-size: 90%;
                color: #c7254e;
                background-color: #f9f2f4;
                border-radius: 0;
            }
        </style>
    </head>
    <body>
        <?php $this->load->view('inc.header.php'); ?>  
        
        <div class="uk-container uk-container-center">
            <div class="uk-grid">
                <div class="uk-width-12">   
                    <div class="page">
                        <h3>API</h3>
                        <p>This page contains details of how to get and update information of your <i>iamavailableform.work</i> profile via our API.</p>

                        <hr>
                        <h4>Introduction</h4>
                        <p>An <i>iamavailableform.work</i> API key is 32 characters in length and allows you to make requests to our service from your own applications. API keys are genertated automatically for your profile when you sign up, and never expire. Due to this reason, you should treat your API key as a sensitive piece of information (just like a password), as a malicious user could potentially make requests to your account without your knowledge.</p>
                        <br>
                        <hr>
                        <h4>Getting your API key</h4>
                        <p>You can find your API key on your <a href="<?php echo base_url(); ?>account/">account page</a>. Please keep it safe. If you're logged in right now, your API key will be shown below for your convenience.</p>
                        <?php 
                        if( $this->aauth->is_loggedin() )
                        {   
                            echo '<div style="margin-top:10px;">Your API key:</div><input type="text" value="'.$this->data['api_key'].'" readonly style="width:98%;height:30px;font-size:14px;color:grey;" />';
                        }
                        ?>
                        <br>
                        <hr>
                        <h4>API methods available</h4>
                        <p>Note: As it's still early days for <i>iamavailablefor.work</i>, we only support a limited amount of API methods at this time.</p>
                        <ul class="apiMethodsList">
                            <li><span class="code">GET</span> <span class="apiMethod">api/toggleAvailability/?key={API_KEY}</span> - This API method allows you to toggle when you're available for work or not.</li>
                            <li><span class="code">GET</span> <span class="apiMethod">api/getProfileViews/?key={API_KEY}</span> - This API method allows you to check how many times your profile has been viewed.</li>
                            <li><span class="code">GET</span> <span class="apiMethod">api/getResponses/?key={API_KEY}</span> - This API method allows you to check messages sent to you via your profile contact form.</li>
                        </ul>
                        <hr>
                        <h4>Constructing an API request</h4>
                        <p>Constructing an API request couldn't be simpler. Simply append the name of the API method you'd like to invoke to the end of the <span class="code"><?php echo base_url(); ?></span> domain name. For example, if you'd like to see how many times your profile has been viewed, you should make use of the <span class="code">getProfileViews</span> API method.  The result of this is <span class="code"><?php echo base_url(); ?>api/getProfileViews/?key={API_KEY}</span>. You should then replace <span class="code">{API_KEY}</span> with your API key to specify that it's you making the request.</p>

                        <hr>
                        <h4>An example application</h4>
                        <p>So now for a real life example of using our API. Assume you have a cron job setup on your server to run every single day at 12:00AM (Midnight) and your sample application, <span class="code">Work Calendar</span> determines that you've booked in quite a lot of work for the next couple of weeks. The purpose of the <span class="code">Work Calendar</span> application is that it realises that you shouldn't be taking on anymore work at this point. The <span class="code">Work Calendar</span> application could send a web request to the <i>iamavailablefor.work</i> API telling it to change the availability on your profile from <span class="code">Available</span> to <span class="code">Unavailable</span>. This would mean that people can now see that you're not available to take on anymore work until you change your availability status again.</p>
                    </div>
                </div>
            </div>
        </div>

       <?php $this->load->view('inc.footer.php'); ?>
    </body>
</html>