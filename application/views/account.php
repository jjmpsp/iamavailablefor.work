<!DOCTYPE HTML>
<html>
    <head>
    	<title>iamavailablefor.work - Your account</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="iamavailablefor.work is a website for showcasing your skills as a professional." />

        <link rel="icon" href="<?php echo base_url(); ?>static/images/favicon.ico">
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/uikit.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/base.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/account.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/sweetalert.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/jquery.dynatable.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/colorpicker.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/nprogress.css" />
        
        <script src="<?php echo base_url(); ?>static/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>static/js/uikit.min.js"></script>
        <script src="<?php echo base_url(); ?>static/js/sweetalert.min.js"></script>
        <script src="<?php echo base_url(); ?>static/js/jquery.dynatable.js"></script>
        <script src="<?php echo base_url(); ?>static/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>static/js/colorpicker.js"></script>
        <script src="<?php echo base_url(); ?>static/js/nprogress.js"></script>
        <script src="<?php echo base_url(); ?>static/js/jquery.blockUI.js"></script>
        <script src="<?php echo base_url(); ?>static/js/account.js"></script>

        <script type="text/javascript">
            // Global vars, accessible to all scripts
            var app = {};
                app.educationList = <?php echo ((strlen($this->data['customUserdata']['educationList']) > 0) ? $this->data['customUserdata']['educationList'] : "null"); ?>;
                app.skillsList = <?php echo ((strlen($this->data['customUserdata']['skillsList']) > 0) ? $this->data['customUserdata']['skillsList'] : "null"); ?>;
                app.portfolioList = <?php echo ((strlen($this->data['customUserdata']['portfolioList']) > 0) ? $this->data['customUserdata']['portfolioList'] : "null"); ?>;
                app.socialMediaList = <?php echo ((strlen($this->data['customUserdata']['socialMediaList']) > 0) ? $this->data['customUserdata']['socialMediaList'] : "null"); ?>;
                app.educationListTable = null;
                app.skillsListTable = null;
                app.portfolioListTable = null;
                app.socialMediaListTable = null;

                var base_url = "<?php echo base_url(); ?>";

                $.blockUI.defaults.css = {}; 
                $.blockUI.defaults.message = '<h1>Contacting server...</h1> <img src="'+base_url+'static/images/loader.gif" />';
                $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
        </script>

        <style type="text/css">input[type="text"]:disabled { background: #dddddd url(<?php echo base_url(); ?>static/images/denied-icon.png) no-repeat right 5px center;background-size: 20px; }</style>
    </head>
    <body>
        <?php $this->load->view('inc.header.php'); ?>   

       <div class="uk-container uk-container-center">
            <div class="uk-grid">
                <div class="uk-width-12">   
                    <div class="page">
                        <input type="hidden" id="csrf_token_ajax" name="csrf_token" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display:none;" />
                        <h3>Your account</h3>
                        <p>From this page you will be able to make changes to your profile.</p> 
                        <p>Changes will instantly become visible on your profile web address once they are saved.</p>
                        <hr>
                        <h4>Account details</h4>
                        <?php
                            $attributes = array('id' => 'editAccountForm', 'method' => 'POST');
                            echo form_open(base_url().'login/', $attributes);
                        ?>
                            <br>
                            <label>Your username:</label>
                            <br>
                            <input type="text" name="username" value="<?php echo $this->data['userdata']->name; ?>" disabled />
                            <br>
                            <br>
                            <label>Your portfolio URL (<a href="<?php echo base_url().$this->data['userdata']->name; ?>/" target="_blank">open in a new tab</a>) :</label>
                            <br>
                            <input type="text" value="<?php echo base_url().$this->data['userdata']->name; ?>/" disabled />
                            <br>
                            <br>
                            <label>Your API key:</label>
                            <br>
                            <input type="text" id="api_key_input" value="<?php echo $this->data['customUserdata']['api_key']; ?>" disabled />
                            <br>
                        <?php echo form_close(); ?>

                        <hr>

                        <h4>Profile information</h4>
                        <?php
                            $attributes = array('id' => 'editProfileInformationForm', 'method' => 'POST');
                            echo form_open(base_url().'login/', $attributes);
                        ?>
                            <br>
                            <label>Your first name:</label>
                            <br>
                            <input type="text" name="firstName" minlength="2" required placeholder="Please enter your first name." value="<?php echo isset($this->data['customUserdata']['firstName']) ? $this->data['customUserdata']['firstName'] : ""; ?>" />
                            <br>
                            <br>
                            <label>Your last name:</label>
                            <br>
                            <input type="text" name="lastName" minlength="2" required placeholder="Please enter your last name." value="<?php echo isset($this->data['customUserdata']['lastName']) ? $this->data['customUserdata']['lastName'] : ""; ?>" />
                            <br>
                            <br>
                            <label>Your gender:</label>
                            <br>
                            <select name="gender">
                            <?php
                                foreach ($this->data['genders'] as $key => $value) {
                                    echo '<option value="'.$key.'" '.((isset($this->data['customUserdata']['gender']) && ($this->data['customUserdata']['gender'] == $key) ) ? "selected" : "").'>'.$this->data['genders'][$key].'</option>';  
                                }
                            ?>
                            </select>
                            <br>
                            <br>
                            <label>Your country:</label>
                            <br>
                            <select name="country">
                            <?php
                                foreach ($this->data['countries'] as $key => $value) {
                                    echo '<option value="'.$key.'" '.((isset($this->data['customUserdata']['country']) && ($this->data['customUserdata']['country'] == $key) ) ? "selected" : "").'>'.$this->data['countries'][$key].'</option>';  
                                }
                            ?>
                            </select>
                            <br>
                            <br>
                            <label>Your occupation:</label>
                            <br>
                            <input type="text" name="occupation" minlength="3" required value="<?php echo (isset($this->data['customUserdata']['occupation']) ? $this->data['customUserdata']['occupation'] : ""); ?>" placeholder="Enter your occupation here" />
                            <br>
                            <br>
                            <label>Your work status:</label>
                            <br>
                            <select name="workStatus">
                            <?php
                                foreach ($this->data['workStatus'] as $key => $value) {
                                    echo '<option value="'.$key.'" '.((isset($this->data['customUserdata']['workStatus']) && ($this->data['customUserdata']['workStatus'] == $key) ) ? "selected" : "").'>'.$this->data['workStatus'][$key].'</option>';  
                                }
                            ?>
                            </select>
                            <br>
                            <br>
                            <label>About you:</label>
                            <br>
                            <textarea name="about" minlength="12" required placeholder="Write something about yourself. This is where you should sell yourself and tell people why they should hire you for work over anyone else."><?php echo isset($this->data['customUserdata']['about']) ? $this->data['customUserdata']['about'] : ""; ?></textarea>
                            <br>
                            <br>
                            <label>Profile display picture:</label>
                            <br>
                            <input type="file" name="profilePicture" id="profilePictureImagePicker">
                            <img id="profilePicturePreview" src="#" style="display:none;max-height:120px;max-width:120px;margin-top:10px;border:1px solid grey;" alt="Image preview" />    
                            <br>
                            <br>
                            <label>Profile header image:</label>
                            <br>
                            <input type="file" name="profileHeaderImage" id="profileHeaderImageImagePicker">
                            <img id="profileHeaderImagePreview" src="#" style="display:none;max-height:120px;max-width:120px;margin-top:10px;border:1px solid grey;" alt="Image preview" />    
                            <br>
                            <br>
                            <label>Profile text colour:</label>
                            <br>
                            <input type="text" name="profileTextColour" id="profileTextColour" value="<?php echo isset($this->data['customUserdata']['profileTextColour']) ? $this->data['customUserdata']['profileTextColour'] : ""; ?>" />
                            <br>
                            <br>
                            <label>Profile forecolour:</label>
                            <br>
                            <input type="text" name="profileForecolor" id="profileForecolor" value="<?php echo isset($this->data['customUserdata']['profileForecolor']) ? $this->data['customUserdata']['profileForecolor'] : ""; ?>" />
                            
                            <br>
                            <br>
                            <button type="submit" form="editProfileInformationForm" value="Save profile information" class="uk-button uk-button-primary btn-md"><span class="glyphicon glyphicon-floppy-disk"></span> Save profile information</button>
                        <?php echo form_close(); ?>
                        <hr>
                        <h4>Your education history:</h4>
                        <br>
                        <button type="button" class="uk-button uk-button-primary" data-uk-modal="{target:'#myModal'}">
                            Add an education place
                        </button>
                        <br>
                        <br>
                        <div class="uk-overflow-container">
                            <table class="uk-table uk-table-bordered uk-table-striped uk-table-hover" id="educationTable">
                                <thead>
                                     <th data-dynatable-no-sort="true" data-dynatable-column="placeName">Place Name</th>
                                     <th data-dynatable-no-sort="true" data-dynatable-column="startYear">Start Year</th>
                                     <th data-dynatable-no-sort="true" data-dynatable-column="endYear">End Year</th>
                                     <th data-dynatable-no-sort="true" data-dynatable-column="deleteButton">Actions</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <h4>Your skills:</h4>
                        <br>
                        <button type="button" class="uk-button uk-button-primary" data-uk-modal="{target:'#myModal1'}">
                            Add a skill
                        </button>
                        <br>
                        <br>
                        <div class="uk-overflow-container">
                            <table class="uk-table uk-table-bordered uk-table-striped uk-table-hover" id="skillsTable">
                                <thead>
                                    <th data-dynatable-no-sort="true" data-dynatable-column="skillName">Skill Name</th>
                                    <th data-dynatable-no-sort="true" data-dynatable-column="skillPercentage">Skill percentage</th>
                                    <th data-dynatable-no-sort="true" data-dynatable-column="deleteButton">Actions</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <h4>Your work portfolio:</h4>
                        <br>
                        <button type="button" class="uk-button uk-button-primary" data-uk-modal="{target:'#myModal2'}">
                            Add a Portfolio Item
                        </button>
                        <br>
                        <br>
                        <div class="uk-overflow-container">
                            <table class="uk-table uk-table-bordered uk-table-striped uk-table-hover" id="portfolioTable">
                                <thead>
                                    <th data-dynatable-no-sort="true" data-dynatable-column="itemName">Item Name</th>
                                    <th data-dynatable-no-sort="true" data-dynatable-column="itemImage">Item Image</th>
                                    <th data-dynatable-no-sort="true" data-dynatable-column="itemDescription">Item Description</th>
                                    <th data-dynatable-no-sort="true" data-dynatable-column="deleteButton">Actions</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <h4>Your social profiles:</h4>
                        <br>
                        <button type="button" class="uk-button uk-button-primary" data-uk-modal="{target:'#myModal3'}">
                            Add a social media
                        </button>
                        <br>
                        <br>
                        <div class="uk-overflow-container">
                            <table class="uk-table uk-table-bordered uk-table-striped uk-table-hover" id="socialMediaTable">
                                <thead>
                                    <th data-dynatable-no-sort="true" data-dynatable-column="socialMediaName">Social Media Name</th>
                                    <th data-dynatable-no-sort="true" data-dynatable-column="socialMediaID">User ID</th>
                                    <th data-dynatable-no-sort="true" data-dynatable-column="deleteButton">Actions</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <h4>Profile settings</h4>
                        <br>
                        <?php
                            $attributes = array('id' => 'editProfileSettingsForm', 'method' => 'POST');
                            echo form_open(base_url().'login/', $attributes);
                        ?>
                            <label>Redirect to custom URL? This will disable your portfolio!</label>
                            <br>
                            <select id="redirectWebAddressToggle" name="redirectWebAddressToggle">
                                <option>Off</option>
                                <option>On</option>
                            </select>
                            <br>
                            <br>
                            <label>Custom URL:</label>
                            <br>
                            <input type="text" id="customUrlValue" name="customUrlValue" placeholder="http://example.com/" value="<?php echo isset($this->data['customUserdata']['customUrlValue']) ? $this->data['customUserdata']['customUrlValue'] : ""; ?>" disabled />
                            <br>
                            <br>
                            <button type="submit" form="editProfileSettingsForm" value="Save profile settings" class="uk-button uk-button-primary btn-md"><span class="glyphicon glyphicon-floppy-disk"></span> Save profile settings</button>
                        <?php echo form_close(); ?>
                        <hr>

                        <?php //print_r($this->data['userdata']); ?>

                        <?php //print_r($this->data['customUserdata']); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('inc.footer.php'); ?>

        <!-- Essential modals -->
        <div class="uk-modal" id="myModal" tabindex="-1">
            <div class="uk-modal-dialog">
                <button type="button" class="uk-modal-close uk-close"></button>
                <div class="uk-modal-header">
                    <h4 class="modal-title">Add education place</h4>
                </div>
                <div class="uk-modal-body">
                    <?php
                        $attributes = array('id' => 'addEducationForm', 'method' => 'POST');
                        echo form_open(base_url().'login/', $attributes);
                    ?>
                        <div class="notice"></div>
                        <label>Name of education place:</label>
                        <br>
                        <input name="placeName" minlength="3" required type="text" value="" placeholder="Place name" />
                        <br>
                        <br>
                        <label>Start date:</label>
                        <br>
                        <select name="startYear" id="startYear">
                            <?php
                                $years = range(date('Y'), 1920);
                                foreach($years as $year) {
                                    echo '<option value="'.$year.'">'.$year.'</option>';
                                }
                            ?>
                        </select>
                        <br>
                        <br>
                        <label>Leaving date:</label>
                        <br>
                        <select name="endYear" id="endYear">
                            <?php
                                $years = range(date('Y'), 1920);
                                foreach($years as $year) {
                                    echo '<option value="'.$year.'">'.$year.'</option>';
                                }
                            ?>
                        </select>
                        <br>
                        <br>
                    <?php echo form_close(); ?>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="uk-button uk-modal-close">Cancel</button>
                    <button type="submit" form="addEducationForm" value="Add education place" class="uk-button uk-button-primary">Add education place</button>
                </div>
            </div>
        </div>

        <div class="uk-modal" id="myModal1" tabindex="-1">
            <div class="uk-modal-dialog">
                <button type="button" class="uk-modal-close uk-close"></button>
                <div class="uk-modal-header">
                    <h4 class="modal-title">Add a skill</h4>
                </div>
                <div class="uk-modal-body">
                    <?php
                        $attributes = array('id' => 'addSkillForm', 'method' => 'POST');
                        echo form_open(base_url().'login/', $attributes);
                    ?>
                        <div class="notice"></div>
                        <label>Name of skill:</label>
                        <br>
                        <input type="text" minlength="1" required name="skillName" value="" placeholder="Skill name" />
                        <br>
                        <br>
                        <label>Skill percentage (%):</label>
                        <br>
                        <select name="skillPercentage">
                            <?php
                                $skills = range(1, 100);
                                foreach($skills as $skill) {
                                    if($skill==50)
                                    {
                                        echo '<option selected value="'.$skill.'">'.$skill.'</option>';
                                    }else{
                                        echo '<option value="'.$skill.'">'.$skill.'</option>';
                                    }
                                }
                            ?>
                        </select>
                        <br>
                        <br>
                    <?php echo form_close(); ?>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="uk-button uk-modal-close">Cancel</button>
                    <button type="submit" form="addSkillForm" value="Add skill" class="uk-button uk-button-primary">Add skill</button>
                </div>
            </div>
        </div>

        <div class="uk-modal" id="myModal2" tabindex="-1">
            <div class="uk-modal-dialog">
                <button type="button" class="uk-modal-close uk-close"></button>
                <div class="uk-modal-header">
                    <h4 class="modal-title">Add a portfolio item</h4>
                </div>
                <div class="uk-modal-body">
                    <?php
                        $attributes = array('id' => 'addPortfolioItemForm', 'method' => 'POST');
                        echo form_open_multipart(base_url().'login/', $attributes);
                    ?>
                        <div class="notice"></div>
                        <label>Name of item:</label>
                        <br>
                        <input name="itemName" minlength="3" required type="text" value="" placeholder="Item name" />
                        <br>
                        <br>
                        <label>Item URL (optional):</label>
                        <br>
                        <input name="itemUrl" type="text" value="" placeholder="http://example.com/" />
                        <br>
                        <br>
                        <label>Item image:</label>
                        <br>
                        <input type="file" name="itemImage" id="PortfolioItemImageFilePicker">
                        <img id="PortfolioItemImagePreview" src="#" style="display:none;max-height:120px;max-width:120px;margin-top:10px;border:1px solid grey;" alt="Image preview" />
                        <br>
                        <br>
                        <label>Item description:</label>
                        <br>
                        <textarea name="itemDescription" minlength="10" required placeholder="Say something about this portfolio item."></textarea>
                        <br>
                        <br>
                    <?php echo form_close(); ?>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="uk-button uk-modal-close">Cancel</button>
                    <button type="submit" form="addPortfolioItemForm" value="Add portfolio item" class="uk-button uk-button-primary">Add portfolio item</button>
                </div>
            </div>
        </div>

        <div class="uk-modal" id="myModal3" tabindex="-1">
            <div class="uk-modal-dialog">
                <button type="button" class="uk-modal-close uk-close"></button>
                <div class="uk-modal-header">
                    <h4 class="modal-title">Add a social media account</h4>
                </div>
                <div class="uk-modal-body">
                    <?php
                        $attributes = array('id' => 'addSocialMediaForm', 'method' => 'POST');
                        echo form_open_multipart(base_url().'login/', $attributes);
                    ?>
                        <div class="notice"></div>
                        <label>Social Media name:</label>
                        <br>
                        <select name="socialMediaName">
                        <?php
                            foreach ($this->data['socialMedias'] as $key => $value) {
                                echo '<option value="'.$key.'">'.$this->data['socialMedias'][$key].'</option>';  
                            }
                        ?>
                        </select>
                        <br>
                        <br>
                        <label>Profile ID or username:</label>
                        <br>
                        <input name="socialMediaID" minlength="3" required type="text" value="" placeholder="Profile ID or username" />
                        <br>
                        <br>
                    <?php echo form_close(); ?>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button type="button" class="uk-button uk-modal-close">Cancel</button>
                    <button type="submit" form="addSocialMediaForm" value="Add portfolio item" class="uk-button uk-button-primary">Add Social Media</button>
                </div>
            </div>
        </div>

    </body>
</html>