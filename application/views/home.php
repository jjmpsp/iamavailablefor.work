<!DOCTYPE HTML>
<html>
    <head>
    	<title>iamavailablefor.work - Showcase your skills as a professinoal</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/uikit.css" />
        <script src="<?php echo base_url(); ?>static/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>static/js/uikit.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="iamavailablefor.work is a website for showcasing your skills as a professional." />
        <script src="<?php echo base_url(); ?>static/js/jquery.min.js"></script>

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

        <div class="uk-container uk-container-center">
            <div class="uk-grid">
                <div class="uk-width-12">   
                    <div class="page">
                        <h4 style="margin-bottom:10px;">Check to see if your desired <i>iamavailablefor.work</i> web address is available:</h4>
                        <?php
                            $attributes = array('id' => 'checkUsername', 'method' => 'POST');
                            echo form_open(base_url().'login/', $attributes);
                        ?>
                            <input type="text" name="username" id="username" placeholder="<?php echo base_url(); ?>{username}" onclick="this.value = '<?php echo base_url(); ?>';$('#submitButton').removeClass('ajaxLoading');$('#submitButton').val('Check');" />
                            <input type="submit" class="uk-button uk-button-primary" id="submitButton" value="Check"/>
                            <div class="uk-clearfix"></div>
                        <?php echo form_close(); ?>
                        <div id="availableDiv" style="display:none;">
                            <div> <span class="usernameVal"></span> is <span class="available">available</span>! <a href="register/">Create a portfolio with this web address</a>.</div>
                        </div>
                        <div id="takenDiv" style="display:none;">
                            <div> <span class="usernameVal"></span> is <span class="taken">taken</span>. If this is your account, <a href="http://iamavailablefor.work/login/">please login to manage it</a>.</div>
                        </div>
                        <br>
                        <div>
                            Already got a profile? <a href="<?php echo base_url(); ?>login/">Please login to make edits to your portfolio</a>.
                        </div>
                        </form>
                    </div>
                </div>

                <div class="uk-width-12">
                    <div class="page">
                        Hi {username}!
                        You're already logged in. To edit your profile, please go to your account page.
                    </div>
                </div>  

                <div class="uk-width-12">
                    <div class="page">
                        <h3>What is iamavailablefor.work?</h3>
                        <p><i>iamavailablefor.work</i> is a website for freelancers &amp; self-employed people to showcase their skills, qualities, and special abilities to find work. <a href="http://iamavailablefor.work/jjmpsp/" target="_blank">Click here to see an example of a profile.</a> Your <i>iamavailablefor.work</i> profile is just like a CV on Steroids. <i>iamavailablefor.work</i> was built with the following people in mind:</p>

                        <ul class="my_ul">
                            <li>Artists</li>
                            <li>Builders</li>
                            <li>Cake decorators</li>
                            <li>Grpahic designers</li>
                            <li>Landscapers</li>
                            <li>Programmers</li>
                            <li>&amp; more...</li>
                        </ul>

                        <hr>

                        <h3>What are the benefits of using this website over X, Y, or Z?</h3>
                        <ul class="my_ul">
                            <li>You get a nice friendly URL to showcase your profile (iamavailablefor.work/{whatever_you_like}).</li>
                            <li>You can set your own profile keywords, so you can be found via search engines for the skills you have presented on your profile.</li>
                            <li>It's super easy to create a profile, and it requires no maintanance at all (unless you'd like to add or modify information on your profile of course).</li>
                            <li>You don't have to create your own website to showcase your work (although if you're really professional, I recommend that you do).</li>
                            <li>We have API calls available for triggering actions for your profile. This allows you to programmatically set when you're available, or unavailable to work - without ever going near this website again if you don't want to.</li>
                        </ul>

                        <hr>

                        <h3>How much does it cost to use?</h3>
                        <p>It's completely free. I initially bought this cool domain name for my own use as I wanted to showcase my development skills on a portfolio website that I'd created. However, I thought I'd be nice and share this domain name (and this website) with everyone else who is looking for a great looking portfolio to present their skills.</p>

                        <hr>

                        <h3>Are there any limitations with setting up a profile?</h3>
                        <p>Yes.</p> 
                        <p>You're only allowed to register one (1) <i>iamavailablefor.work</i> web address per account. This is due to the way this system is setup. There are absolutely no limits on the amount of the accounts you can setup though, so if you do require another web address, feel free to create another account using a different email address.</p>
                        <p>Inactive accounts will have their account terminated without notice if unused for 90 days. This is to prevent web address 'squatting' and to make it fair for other users to get the web address they'd like to register, without other accounts setting reservations on a web addresses with inactive accounts. We class inactive accounts as those who have not setup a forwarding web address, or a profile on our website within 90 days of their initial sign up date.</p>
                        
                        <hr>

                        <h3>Why did you create this website and who are you?</h3>
                        <p>I needed a new job and on a random afternoon I got bored and built this website. As I mentioned above, I thought it would be cool to share this domain name with others. At the current time of writing this, I see many of my friends who have recently graduated creating websites to showcase their skills. Imagine if there was a website that could automate that? Oh wait... :D My name is <a href="http://joel-murphy.com/">Joel Murphy</a>, by the way.</p>

                        <hr>

                        <h3>I have an suggestion for this website. Who should I contact?</h3>
                        <p>Ooo I like suggestions. Let me know via the <a href="">Facebook page</a>. If you're familiar with GitHub, then you can also file an issue on the <a href="">official project page</a>. I check both websites regularly, so you'll probably get a near immediate response from me.</p>

                        <hr>

                        <h3>That is all.</h3>
                        <p>Thanks for taking the time to read this page. If you find my website useful, maybe you'd like to consider <a href="">Donating to my server fund</a> to keep this project going. Bye for now!</p>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('inc.footer.php'); ?>
    </body>
</html>


<style type="text/css">
body{
    background: #243244;
}

header {
    background-color: #fff;
    height: 110px;
    min-width: 100%;
    float: left;
}
#header-title{
    line-height: 60px;
    margin: 0px;
}
#header-subtitle{
    line-height: 30px;
    margin: 0px;
}

#facebook-widget{
    position: absolute;
    top: 15px;
    right: 0px;
}
#twitter-widget{
    position: absolute;
    top: 50px;
    right: 0px;
}

ul.multicolor
{   
    font-size: 0;
    list-style: none;
    float:left;
    min-width: 100%;
    padding: 0px;
    margin: 0px;
    line-height: 0px;
}
ul.multicolor li
{
    display: inline-block;
    height: 7px;
    width: 20%;
}
ul.multicolor li:nth-child(1)
{
    background: #2ecc71;
}
ul.multicolor li:nth-child(2)
{
    background: #3498db;
}
ul.multicolor li:nth-child(3)
{
    background: #f1c40f;
}
ul.multicolor li:nth-child(4)
{
    background: #e74c3c;
}
ul.multicolor li:nth-child(5)
{
    background: #9b59b6;
}

.page {
    background-color: white;
    border-radius: 5px;
    margin-left: auto;
    margin-right: auto;
    margin-top: 30px;
    padding: 10px;
    word-break: break-all;
}

footer .separator{
    color: #c9c9c9;
}
#footer-menu {
    float: left;
    line-height: 20px;
    margin-bottom: 0px;
    padding-left: 0px;
}
#footer-menu li {
    display: inline;
}
#footer-credits{
    float: right;
}

#username{
    float: left;
    width: 88%;
    height: 50px;
    border: 2px solid #F5F5F5;
    background: #fff;
    box-shadow: 0px;
    color: #808080;
    font-size: 14px;
    padding-left: 10px;
}

#submitButton{
    float: right;
    height: 55px;
    width: 10%;
    border: 1px solid #808080;
}


/* ===== Mobile queries =====  */
/* Portrait */
@media only screen and (min-device-width: 320px) and 
(max-device-width: 480px) and 
(-webkit-min-device-pixel-ratio: 2) and 
(orientation: portrait) {
    #facebook-widget, #twitter-widget{
        display: none;
    }
    header{
        height: 80px;
        text-align: center;
    }
    #header-title{
        font-size: 24px;
        line-height:24px;
        padding-top: 15px;
    }
    #header-subtitle{
        font-size: 14px;
        line-height: 14px;
        padding-top: 12px;
    }

    #footer-menu {
        float: none;
        display: block;
        width: 100%;
        line-height: 20px;
        margin-bottom: 0px;
        padding-left: 0px;
    }
    #footer-menu li {
        display: block;
        width: 100%;
        margin-bottom: 10px;
        border: 1px solid #c9c9c9;
        border-radius: 5px;
        text-align: center;
        padding: 10px 0px;
    }
    #footer-menu li:last-child {
        margin-bottom: 0px;
    }
    .footer-credits{
        float: right;
    }
    #footer-menu .separator{
        display: none;
    }

    #footer-credits{
        float: none;
        display: block;
        width: 100%;
        float: none;
        text-align: center;
        margin-top: 30px;
    }

    #username{
        float: none;
        width: 96%;
        height: 50px;
        color: #808080;
        font-size: 14px;
        padding: 5px 3px;
    }

    #submitButton{
        float: none;
        height: 50px;
        width: 100%;
        border: 1px solid grey;
        border-radius: 0px;
    }
}

</style>