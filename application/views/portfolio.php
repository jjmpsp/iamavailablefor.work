<!DOCTYPE HTML>
<html>
    <head>
    	<title><?php echo $this->security->xss_clean($this->data['customUserdata']['firstName']." ".$this->data['customUserdata']['lastName'])." is ".(($this->data['customUserdata']['workStatus'] == 1) ? 'available ✓' : 'unavailable ✖').' for work | '.$this->security->xss_clean($this->data['customUserdata']['firstName']." ".$this->data['customUserdata']['lastName']); ?>'s freelance profile</title>     
        <link rel="icon" href="<?php echo base_url().'uploads/favicon/16x16/'.$this->data['customUserdata']['profilePicture']; ?>">
        <link href="<?php echo base_url(); ?>static/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
        <link href="<?php echo base_url(); ?>static/css/flag-icon.min.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo base_url(); ?>static/css/style.css" rel="stylesheet" type="text/css" media="all" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="iamavailablefor.work is a website for showcasing your skills as a professional." />
        <script src="<?php echo base_url(); ?>static/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>static/js/move-top.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>static/js/easing.js"></script>
        <script type="text/javascript">

        	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }

            $(document).ready(function($) {
            	$(".scroll").click(function(event){		
            		event.preventDefault();
            		$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
            	});

                $().UItoTop({ easingType: 'easeOutQuart' });
            });
        </script>

        <style type="text/css">
        .image-container {
            position: relative;
            display: inline-block;
            width: 100%;
            cursor: pointer;
        }
        .image-container .after {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            color: #FFF;
            opacity: 0;
        }
        .image-container:hover > .after {
            opacity: 1;
            display: block;
            background: rgba(0, 0, 0, .6);
            text-align: left;
        }
        .image-container .after h4{
            color: white;
            padding: 20px 20px 0px 20px;
        }
        .image-container .after p{
            margin-left:20px;
            color: #dedede;
        }

        .skillItem:not(:last-child){
            margin-bottom: 40px;
        }
        </style>
    </head>
    <body>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
            // Check if a user is viewing their own profile
            if( $this->data['userdata']->id == $this->aauth->get_user_id() )
            {
                echo '
                <div class="edit-profile">
                    <a href="'.base_url().'account/" class="btn btn-primary btn-sm">Edit profile</a>
                </div>';
            }
        ?>    

        <div class="profile-info">
            <span class="flag-icon flag-icon-<?php echo strtolower($this->data['customUserdata']['country']); ?>"></span>
            <span class="profile_name"><?php echo $this->data['customUserdata']['firstName']." ".$this->data['customUserdata']['lastName']; ?></span>
        </div>

        <div class="header-section" style="background:url(<?php echo base_url().'uploads/header_images/1170x500/'.$this->data['customUserdata']['headerImage']; ?>);background-size: cover;background-position: 50%;background-repeat: no-repeat;">
            <div class="continer">
                <img class="profile_picture" src="<?php echo base_url().'uploads/profile_pictures/250x250/'.$this->data['customUserdata']['profilePicture']; ?>">
                <h1>I'm <span class="name"><?php echo $this->data['customUserdata']['firstName'] ?>.</span></h1>
                <h2>I'm a <span class="occupation"><?php echo $this->security->xss_clean($this->data['customUserdata']['occupation']); ?>.</span></h2>
                <h3>I'm currently <?php echo ($this->data['customUserdata']['workStatus'] == 1) ? '<span class="available">available ✓</span>' : '<span class="unavailable">Unavailable ✖</span>'; ?> for work.</h3>
                <a href="#contact" class="scroll top"><span class="glyphicon glyphicon-triangle-bottom next1" aria-hidden="true"></span></a>
            </div>
        </div>
        <div class="study-section">
            <div class="container">
                <div class="study-grids">
                    <div class="col-md-6 study-grid">
                        <h3>About me<span>:</span></h3>
                        <div class="study1">
                            <p><?php echo $this->security->xss_clean($this->data['customUserdata']['about']); ?></p>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-1 study-grid">
                        <h3>Education<span>:</h3>
                        <div class="study1">
                            <?php
                                $educationList = json_decode($this->data['customUserdata']['educationList'],true);
                                if(count($educationList)>0)
                                {
                                    foreach ($educationList as $key => $value) {
                                        echo '<p>'.$this->security->xss_clean($value['placeName']).'<label>('.$value['startYear'].' - '.$value['endYear'].')</label></p>';
                                    }
                                }else{
                                    echo '<p>No education history yet.</p>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>

        <hr>

        <div class="skills-section" id="skills">
        	<div class="container">
                <div class="skills-grid">
				    <div class="col-md-12 skills-col">
				        <h3>My Skills<span>:</span></h3>
				        <div class="study2">
                            <?php
                                $skillsList = json_decode($this->data['customUserdata']['skillsList'],true);
                                if(count($skillsList)>0)
                                {
                                    foreach ($skillsList as $key => $value) {
                                        echo '<div class="skillItem"><h4>'.$this->security->xss_clean($value['skillName']).'<label>('.$value['skillPercentage'].'% proficient)</label></h4><div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$value['skillPercentage'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$value['skillPercentage'].'%;background:'.randomPastelColor().'"></div></div></div>';
                                    }
                                }else{
                                    echo '<p>No skills yet.</p>';
                                }
                            ?>
				        </div>
				    </div>
				</div>
			</div>
        </div>

        <hr>

        <div class="portfolio-section" id="portfolio">
            <div class="container">
                <div class="portfolio-grid">
                    <h3>My work portfolio<span>:</span></h3>

                    <div class="portfolio-row">
                        <?php
                            $portfolioList = json_decode($this->data['customUserdata']['portfolioList'],true);
                            if(count($portfolioList)>0)
                            {   
                                foreach ($portfolioList as $key => $value) {
                                    echo '
                                    <div class="col-xs-12 col-sm-12 col-md-6 service-grid">
                                        <div class="image-container">
                                            <img src="'.base_url().'uploads/portfolio/540x340/'.$value['itemImage'].'" class="img-responsive portfolio-item" />
                                            <div class="after">
                                                <h4>'.$this->security->xss_clean($value['itemName']).'</h4>
                                                <p>'.$this->security->xss_clean($value['itemDescription']).'</p>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }else{
                                echo '<p>No Portfolio items yet.</p>';
                            }
                        ?>
	                    <div class="clearfix"> </div>
                    </div>

                </div>
            </div>
        </div>

        <hr>

        <div class="social-icons" id="social-icons">
            <div class="container"> 
                <h3>Me on the internet<span>:</span></h3>
                <?php
                    $socialMediaList = json_decode($this->data['customUserdata']['socialMediaList'],true);
                    if(count($socialMediaList)>0)
                    {   
                        foreach ($socialMediaList as $key => $value) {
                            echo '
                            <div class="col-md-4 col-sm-4 face">
                                <a class="soc soc-'.$this->security->xss_clean($value['socialMediaName']).'" href="#"></a>
                            </div>';
                        }
                    }else{
                        echo '<p>No Social Media profiles.</p>';
                    }
                ?>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="contact-section" id="contact">
            <div class="container">
                <h3>Want to hire me?</h3>
                <div class="contact-details">
                    <form>
                        <div class="col-md-6 contact-left">
                            <input type="text" class="text" value="Your Name *" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name *';}">
                            <input type="text" class="text" value="Your Email Address *" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email *';}">
                            <input type="text" class="text" value="Your Phone Number *" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Phone *';}">
                        </div>
                        <div class="col-md-6 contact-right">
                            <textarea  value="Message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Hi Joel, I was just browsing your profile on IamAvailableForWork. Would you be willing to work with me?';}">Hi Joel, I was just browsing your profile on IamAvailableForWork. Would you be willing to work with me?</textarea>
                            <input type="submit" value="Send Joel a Message"/>
                        </div>
                        <div class="clearfix"> </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-section">
            <div class="container">
                <div class="footer-top">
                    <p>&copy; Joel Murphy 2015 <span> | </span> <a href="<?php echo base_url(); ?>">Get your own</a></p>
                </div>
                <a href="#" id="toTop"> <span id="toTopHover" style="opacity: 1;"> </span></a>
            </div>
        </div>
    </body>
</html>