<!DOCTYPE HTML>
<html>
    <head>
    	<title>iamavailablefor.work - Showcase your skills as a professinoal</title>
        <link rel="icon" href="<?php echo base_url(); ?>static/images/favicon.ico">
        <link href="<?php echo base_url(); ?>static/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
        <link href="<?php echo base_url(); ?>static/css/homeStyle.css" rel="stylesheet" type="text/css" media="all" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="iamavailablefor.work is a website for showcasing your skills as a professional." />
        <script src="<?php echo base_url(); ?>static/js/jquery-1.11.1.min.js"></script>

        <script type="text/javascript">

            var base_url = "<?php echo base_url(); ?>";

            function setNewToken(response)
            {   
                console.log(response.meta.newToken.hash);
                $('input[name="'+response.meta.newToken.name+'"]').val(response.meta.newToken.hash);
            }

            $(document).ready(function(){
                $("#checkUsername").submit(function(e){
                    e.preventDefault();

                    $("#submitButton").val("");
                    $("#submitButton").addClass("ajaxLoading");

                    var formData = new FormData($(this)[0]);

                    $.ajax({
                        url: base_url+"ajax/checkUsername/",
                        type: 'POST',
                        data: formData,
                        success: function (data) {
                            var json = JSON.parse(data);
                            setNewToken(json);

                            if(json.errors.invalidFormat){
                                alert(json.errors.invalidFormat);
                                return false;
                            }

                            $(".usernameVal").html($("#username").val().replace(base_url,""));
                            $("#availableDiv").hide();
                            $("#takenDiv").hide();

                            if(json.usernameAvailable){
                                $("#availableDiv").show();
                            }else{
                                $("#takenDiv").show();
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                });
            });
        </script>
    </head>
    <body>
        <?php $this->load->view('inc.header.php'); ?>        
        <section class="container">
            <div class="page">
                <h4 style="margin-bottom:10px;">Check to see if your <i>iamavailablefor.work</i> web address is available:</h4>
               <?php
                    $attributes = array('id' => 'checkUsername', 'method' => 'POST');
                    echo form_open(base_url().'login/', $attributes);
                ?>
                    <input type="text" name="username" id="username" style="width:93%;height:50px;float:left;color:#808080;" placeholder="<?php echo base_url(); ?>{username}" onclick="this.value = '<?php echo base_url(); ?>';$('#submitButton').removeClass('ajaxLoading');$('#submitButton').val('Check');" />
                    <input type="submit" id="submitButton" style="float:right;height:50px;width:60px;border:1px solid grey;" value="Check"/>
                    <div class="clearfix"></div>
                <?php form_close(); ?>
                <br>
                <div id="availableDiv" style="display:none;">
                    <div> <span class="usernameVal"></span> is <span class="available">available</span>! <a href="<?php echo base_url(); ?>register/">Create a portfolio with this web address</a>.</div>
                </div>
                <div id="takenDiv" style="display:none;">
                    <div> <span class="usernameVal"></span> is <span class="taken">taken</span>. If this is your account, <a href="<?php echo base_url(); ?>login/">please login to manage it</a>.</div>
                </div>
                <div>
                    Already got a profile? <a href="<?php echo base_url(); ?>login/">Please login to make edits to your portfolio</a>.
                </div>
            </div>
        </section>

        <section class="container">
            <div class="page">
                Hi {username}!
                You're already logged in. To edit your profile, please go to your account page.
            </div>
        </section>

        <section class="container">
            <div class="page">
                <h3>What is iamavailablefor.work?</h3>
                <p><i>iamavailablefor.work</i> is a website for freelancers & self-employed people to showcase their skills, qualities, and special abilities to find work. <a href="<?php echo base_url(); ?>jjmpsp/" target="_blank">Click here to see an example of a profile.</a> Your <i>iamavailablefor.work</i> profile is just like a CV on Steroids. <i>iamavailablefor.work</i> was built with the following people in mind:</p>

                <ul class="my_ul">
                    <li>Artists</li>
                    <li>Builders</li>
                    <li>Cake decorators</li>
                    <li>Grpahic designers</li>
                    <li>Landscapers</li>
                    <li>Programmers</li>
                    <li>& more...</li>
                </ul>

                <br>

                <h3>What are the benefits of using this website over X, Y, or Z?</h3>
                <ul class="my_ul">
                    <li>You get a nice friendly URL to showcase your profile (iamavailablefor.work/{whatever_you_like}).</li>
                    <li>You can set your own profile keywords, so you can be found via search engines for the skills you have presented on your profile.</li>
                    <li>It's super easy to create a profile, and it requires no maintanance at all (unless you'd like to add or modify information on your profile of course).</li>
                    <li>You don't have to create your own website to showcase your work (although if you're really professional, I recommend that you do).</li>
                    <li>We have API calls available for triggering actions for your profile. This allows you to programmatically set when you're available, or unavailable to work - without ever going near this website again if you don't want to.</li>
                </ul>

                <br>

                <h3>How much does it cost to use?</h3>
                <p>It's completely free. I initially bought this cool domain name for my own use as I wanted to showcase my development skills on a portfolio website that I'd created. However, I thought I'd be nice and share this domain name (and this website) with everyone else who is looking for a great looking portfolio to present their skills.</p>

                <br>

                <h3>Are there any limitations with setting up a profile?</h3>
                <p>Yes.</p> 
                <p>You're only allowed to register one (1) <i>iamavailablefor.work</i> web address per account. This is due to the way this system is setup. There are absolutely no limits on the amount of the accounts you can setup though, so if you do require another web address, feel free to create another account using a different email address.</p>
                <p>Inactive accounts will have their account terminated without notice if unused for 90 days. This is to prevent web address 'squatting' and to make it fair for other users to get the web address they'd like to register, without other accounts setting reservations on a web addresses with inactive accounts. We class inactive accounts as those who have not setup a forwarding web address, or a profile on our website within 90 days of their initial sign up date.</p>
                <br>

                <h3>Why did you create this website and who are you?</h3>
                <p>I needed a new job and on a random afternoon I got bored and built this website. As I mentioned above, I thought it would be cool to share this domain name with others. At the current time of writing this, I see many of my friends who have recently graduated creating websites to showcase their skills. Imagine if there was a website that could automate that? Oh wait... :D My name is <a href="http://joel-murphy.com/">Joel Murphy</a>, by the way.</p>

                <br>

                <h3>I have an suggestion for this website. Who should I contact?</h3>
                <p>Ooo I like suggestions. Let me know via the <a href="">Facebook page</a>. If you're familiar with GitHub, then you can also file an issue on the <a href="">official project page</a>. I check both websites regularly, so you'll probably get a near immediate response from me.</p>

                <br>

                <h3>That is all.</h3>
                <p>Thanks for taking the time to read this page. If you find my website useful, maybe you'd like to consider <a href="">Donating to my server fund</a> to keep this project going. Bye for now!</p>
            </div>
        </section>

        <?php $this->load->view('inc.footer.php'); ?>
    </body>
</html>