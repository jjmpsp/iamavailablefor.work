<!DOCTYPE HTML>
<html>
    <head>
    	<title>iamavailablefor.work - Your account</title>
        <link rel="icon" href="<?php echo base_url(); ?>static/images/favicon.ico">
        <link href="<?php echo base_url(); ?>static/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
        <link href="<?php echo base_url(); ?>static/css/homeStyle.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo base_url(); ?>static/css/jquery.dynatable.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo base_url(); ?>static/css/sweetalert.css" rel="stylesheet" type="text/css" media="all" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="iamavailablefor.work is a website for showcasing your skills as a professional." />
        <script src="<?php echo base_url(); ?>static/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>static/js/jquery.dynatable.js"></script>
        <script src="<?php echo base_url(); ?>static/js/sweetalert.min.js"></script>
        <script src="<?php echo base_url(); ?>static/js/jquery.validate.min.js"></script>
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url(); ?>static/css/colorpicker.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>static/js/colorpicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>static/js/ion.sound.min.js"></script>

        <script type="text/javascript">
        var app = {};
        app.educationList = <?php echo ((strlen($this->data['customUserdata']['educationList']) > 0) ? $this->data['customUserdata']['educationList'] : "null"); ?>;
        app.skillsList = <?php echo ((strlen($this->data['customUserdata']['skillsList']) > 0) ? $this->data['customUserdata']['skillsList'] : "null"); ?>;
        app.portfolioList = <?php echo ((strlen($this->data['customUserdata']['portfolioList']) > 0) ? $this->data['customUserdata']['portfolioList'] : "null"); ?>;
        app.socialMediaList = <?php echo ((strlen($this->data['customUserdata']['socialMediaList']) > 0) ? $this->data['customUserdata']['socialMediaList'] : "null"); ?>;
        app.educationListTable = null;
        app.skillsListTable = null;
        app.portfolioListTable = null;
        app.socialMediaListTable = null;

        </script>
        <style type="text/css">
            input[type="text"], input[type="password"], select{
                width: 50%;
                height: 30px;
                line-height: 30px;
                background-color: inherit;
                border: 1px solid #ddd;
                padding: 22px 7px;
            }
            input[type="submit"]{
                width: 50%;
                height: 30px;
            }
            textarea{
                width: 50%;
                height: 150px;
                resize: none;
                padding: 5px;
                border: 1px solid #ddd;
                padding: 7px 7px;
            }  

            input[type="text"]:disabled {
                background: #dddddd url(<?php echo base_url(); ?>static/images/denied-icon.png) no-repeat right 5px center;
                background-size: 20px;
            }

            .errorField{
                border: 1px solid red;
            }

            #educationTable th, #skillsTable th, #portfolioTable th {
                color: #337ab7;
                padding: 20px 5px;
            }

            th:not(:first-child){
                text-align: center; 
                vertical-align: middle;
            }

            label.error { 
    position: relative;
    border: 5px solid #e74c3c;
    color: #fff;
    background: #e74c3c;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    margin-left: 20px;
    padding: 0px 5px;
    font-weight: normal;
}


label.error:before {
    content: "";
    position: absolute;
    left: 40px;
    border-width: 20px 20px 0;
    border-style: solid;
    border-color: #e74c3c transparent;
    display: block;
    width: 0;
    bottom: auto;
    left: -24px;
    top: 0px;
    border-width: 10px 20px 10px 0;
    border-color: transparent #e74c3c;
}

            .modal {
  text-align: center;
}

@media screen and (min-width: 768px) { 
  .modal:before {
    display: inline-block;
    vertical-align: middle;
    content: " ";
    height: 100%;
  }
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}

.portfolioImage{
    max-height: 100px;
}
        </style>

        <script type="text/javascript">

        var base_url = "<?php echo base_url(); ?>";

            $(document).ready(function(){

                ion.sound({
                    sounds: [
                        {
                            name: "water_droplet",
                            volume: 1.0,
                            preload: true
                        }
                    ],
                    volume: 0.5,
                    path: "<?php echo base_url(); ?>static/sounds/",
                    preload: true
                });

                $('#myModal').on('hidden.bs.modal', function () {
                    $('#myModal .notice').html("");
                });
                $('#myModal1').on('hidden.bs.modal', function () {
                    $('#myModal1 .notice').html("");
                });
                $('#myModal2').on('hidden.bs.modal', function () {
                    $('#myModal2 .notice').html("");
                });

                app.educationListTable = $('#educationTable').dynatable({
                    features: {
                        paginate: false,
                        search: false,
                        recordCount: false,
                        perPageSelect: true
                    }
                }).data('dynatable');

                app.skillsListTable = $('#skillsTable').dynatable({
                    features: {
                        paginate: false,
                        search: false,
                        recordCount: false,
                        perPageSelect: true
                    }
                }).data('dynatable');

                app.portfolioListTable = $('#portfolioTable').dynatable({
                    features: {
                        paginate: false,
                        search: false,
                        recordCount: false,
                        perPageSelect: true
                    }
                }).data('dynatable');

                app.socialMediaListTable = $('#socialMediaTable').dynatable({
                    features: {
                        paginate: false,
                        search: false,
                        recordCount: false,
                        perPageSelect: true
                    }
                }).data('dynatable');
                
                updateEducationTable();   
                updateSkillsTable();   
                updatePortfolioTable();
                updateSocialMediaTable();   

                function clearFileInput(ctrl) {
                    try {
                        ctrl.value = null;
                    } catch(ex) { }
                    if (ctrl.value) {
                        ctrl.parentNode.replaceChild(ctrl.cloneNode(true), ctrl);
                    }
                }

                function readImage(input, target) {
                    if (input.files && input.files[0]) { 
                        if (input.files[0].name.match(/\.(jpg|jpeg|png|gif)$/))
                        {
                            var reader = new FileReader();
                            
                            reader.onload = function (e) {
                                $(target).attr('src', e.target.result);
                                $(target).show();
                            }
                            
                            reader.readAsDataURL(input.files[0]);
                            return true;
                        }else{
                            clearFileInput(input);
                            return false;
                        }
                    }
                }

                function setNewToken(response)
                {   
                    console.log(response.meta.newToken.hash);
                    $('input[name="'+response.meta.newToken.name+'"]').val(response.meta.newToken.hash);
                }

                $('#profileTextColour').ColorPicker({
                    onBeforeShow: function () {
                        $(this).ColorPickerSetColor(this.value);
                    },
                    onChange: function (hsb, hex, rgb, el) {
                        $('#profileTextColour').val("#"+hex);
                    }
                })

                $('#profileForecolor').ColorPicker({
                    onBeforeShow: function () {
                        $(this).ColorPickerSetColor(this.value);
                    },
                    onChange: function (hsb, hex, rgb, el) {
                        $('#profileForecolor').val("#"+hex);
                    }
                })

                function updateEducationTable()
                {   
                    // Hide table if there are no records.
                    if(app.educationList.length >0)
                    {
                        for(var i=0; i<app.educationList.length; i++){ 
                            app.educationList[i].deleteButton = '<button data-id="'+ app.educationList[i].id + '" class="btn btn-danger btn-sm deleteButton"><span class="glyphicon glyphicon-trash"></span> Delete</button>'; 
                        }
                        
                        app.educationListTable.settings.dataset.originalRecords = app.educationList;
                        app.educationListTable.process();

                        console.log("table updated");
                        $('#educationTable').show();
                    }else{
                        $('#educationTable').hide();
                    }
                }

                function updateSkillsTable()
                {   
                    // Hide table if there are no records.
                    if(app.skillsList.length >0)
                    {
                        for(var i=0; i<app.skillsList.length; i++){ 
                            app.skillsList[i].deleteButton = '<button data-id="'+ app.skillsList[i].id + '" class="btn btn-danger btn-sm deleteButton"><span class="glyphicon glyphicon-trash"></span> Delete</button>'; 
                            app.skillsList[i].skillPercentage = app.skillsList[i].skillPercentage + '%'; 
                        }
                        
                        app.skillsListTable.settings.dataset.originalRecords = app.skillsList;
                        app.skillsListTable.process();

                        console.log("table updated");
                        $('#skillsTable').show();
                    }else{
                        $('#skillsTable').hide();
                    }
                }

                function updatePortfolioTable()
                {   
                    // Hide table if there are no records.
                    if(app.portfolioList.length >0)
                    {
                        for(var i=0; i<app.portfolioList.length; i++){ 
                            app.portfolioList[i].deleteButton = '<button data-id="'+ app.portfolioList[i].id + '" class="btn btn-danger btn-sm deleteButton"><span class="glyphicon glyphicon-trash"></span> Delete</button>'; 
                            app.portfolioList[i].itemImage = '<img class="portfolioImage" src="<?php echo base_url(); ?>uploads/portfolio/540x340/'+app.portfolioList[i].itemImage+'"/>'; 
                        }
                        
                        app.portfolioListTable.settings.dataset.originalRecords = app.portfolioList;
                        app.portfolioListTable.process();

                        console.log("table updated");
                        $('#portfolioTable').show();
                    }else{
                        $('#portfolioTable').hide();
                    }
                }


                function updateSocialMediaTable()
                {   
                    // Hide table if there are no records.
                    if(app.socialMediaList.length >0)
                    {
                        for(var i=0; i<app.socialMediaList.length; i++){ 
                            app.socialMediaList[i].deleteButton = '<button data-id="'+ app.socialMediaList[i].id + '" class="btn btn-danger btn-sm deleteButton"><span class="glyphicon glyphicon-trash"></span> Delete</button>'; 
                            
                            socialMedias = {
                                'twitter'   : "Twitter",
                                'facebook'  : "Facebook",
                                'google'    : "Google+",
                                'instagram' : "instagram"
                            };

                            app.socialMediaList[i].socialMediaName = socialMedias[app.socialMediaList[i].socialMediaName]; 
                        }
                        
                        app.socialMediaListTable.settings.dataset.originalRecords = app.socialMediaList;
                        app.socialMediaListTable.process();

                        console.log("table updated");
                        $('#socialMediaTable').show();
                    }else{
                        $('#socialMediaTable').hide();
                    }
                }

                function generateModalError(message)
                {
                    ion.sound.play("water_droplet");
                    return '<div class="alert alert-danger" role="alert">\
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>\
                        <span class="sr-only">Error:</span>\
                        '+message+'\
                    </div>';
                }

                function generateModalSuccess(message)
                {
                    ion.sound.play("water_droplet");
                    return '<div class="alert alert-success" role="alert">\
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>\
                        <span class="sr-only">Error:</span>\
                        '+message+'\
                    </div>';
                }

                $.fn.resetForm = function() {
                    return this.each(function(){
                        this.reset();
                    });
                }

                $(document).on('click', '#educationTable .deleteButton', function(){
                    var _that = $(this);
                    swal({   
                        title: "Are you sure?",   
                        text: "Are you sure you want to delete this education place?",   
                        type: "warning",   
                        showCancelButton: true,  
                        cancelButtonText: "Close", 
                        confirmButtonColor: "#DD6B55",   
                        confirmButtonText: "Yes, delete it!",   
                        closeOnConfirm: false 
                    }, function(){
                        $.ajax({
                            url: base_url+"ajax/deleteEducation/",
                            type: 'POST',
                            data: {
                                csrf_token : $("#csrf_token_ajax").val(),
                                educationId : $(_that).attr("data-id")
                            },
                            success: function (data) {
                                var json = JSON.parse(data);
                                setNewToken(json);

                                if( json.errors.length > 0)
                                {
                                    var message = "";
                                    for (var i = 0; i < json.errors.length; i++) {
                                        message += json.errors[i].message + "\n";
                                    };
                                    swal("error", message, "error");
                                    return;
                                }

                                if( json.message )
                                {
                                    swal("success", json.message, "success");
                                    app.educationList = json.educationList;
                                    updateEducationTable();
                                }
                            },
                            cache: false
                        });
                    });
                });

                $(document).on('click', '#skillsTable .deleteButton', function(){
                    var _that = $(this);
                    swal({   
                        title: "Are you sure?",   
                        text: "Are you sure you want to delete this skill?",   
                        type: "warning",   
                        showCancelButton: true,  
                        cancelButtonText: "Close", 
                        confirmButtonColor: "#DD6B55",   
                        confirmButtonText: "Yes, delete it!",   
                        closeOnConfirm: false 
                    }, function(){
                        $.ajax({
                            url: base_url+"ajax/deleteSkill/",
                            type: 'POST',
                            data: {
                                csrf_token : $("#csrf_token_ajax").val(),
                                skillId : $(_that).attr("data-id")
                            },
                            success: function (data) {
                                var json = JSON.parse(data);
                                setNewToken(json);

                                if( json.errors.length > 0)
                                {
                                    var message = "";
                                    for (var i = 0; i < json.errors.length; i++) {
                                        message += json.errors[i].message + "\n";
                                    };
                                    swal("error", message, "error");
                                    return;
                                }

                                if( json.message )
                                {
                                    swal("success", json.message, "success");
                                    app.skillsList = json.skillsList;
                                    console.log(json.skillsList);
                                    updateSkillsTable();
                                }
                            },
                            cache: false
                        });
                    });

                });

                $(document).on('click', '#portfolioTable .deleteButton', function(){
                    var _that = $(this);
                    swal({   
                        title: "Are you sure?",   
                        text: "Are you sure you want to delete this portfolio item?",   
                        type: "warning",   
                        showCancelButton: true,  
                        cancelButtonText: "Close", 
                        confirmButtonColor: "#DD6B55",   
                        confirmButtonText: "Yes, delete it!",   
                        closeOnConfirm: false 
                    }, function(){
                        $.ajax({
                            url: base_url+"ajax/deletePortfolioItem/",
                            type: 'POST',
                            data: {
                                csrf_token : $("#csrf_token_ajax").val(),
                                portfolioItemId : $(_that).attr("data-id")
                            },
                            success: function (data) {
                                var json = JSON.parse(data);
                                setNewToken(json);

                                if( json.errors.length > 0)
                                {
                                    var message = "";
                                    for (var i = 0; i < json.errors.length; i++) {
                                        message += json.errors[i].message + "\n";
                                    };
                                    swal("error", message, "error");
                                    return;
                                }

                                if( json.message )
                                {
                                    swal("success", json.message, "success");
                                    app.portfolioList = json.portfolioList;
                                    updatePortfolioTable();
                                }
                            },
                            cache: false
                        });
                    });
                });

                $("#redirectWebAddressToggle").change(function(){
                    var customUrlValue  = $("#customUrlValue");
                    if($(this).val() == "On")
                    {
                        customUrlValue.removeAttr("disabled");
                    }else{
                        customUrlValue.attr("disabled", "disabled");
                        customUrlValue.removeClass("errorField");
                    }
                });

                $("#PortfolioItemImageFilePicker").change(function(){
                    if(!readImage(this, "#PortfolioItemImagePreview"))
                    {
                        swal("error", "Please choose a valid image file!", "error");
                    }
                });

                $("#profilePictureImagePicker").change(function(){
                    if(!readImage(this, "#profilePicturePreview"))
                    {
                        swal("error", "Please choose a valid image file!", "error");
                    }
                });

                $("#profileHeaderImageImagePicker").change(function(){
                    if(!readImage(this, "#profileHeaderImagePreview"))
                    {
                        swal("error", "Please choose a valid image file!", "error");
                    }
                });

                $("#editAccountForm").validate({
                    submitHandler: function(form) {
                        var formData = new FormData($(this)[0]);

                        $.ajax({
                            url: base_url+"ajax/editAccountSettings/",
                            type: 'POST',
                            data: formData,
                            success: function (data) {
                                var json = JSON.parse(data);
                                setNewToken(json);

                                if( json.errors.length > 0)
                                {
                                    var message = "";
                                    for (var i = 0; i < json.errors.length; i++) {
                                        $("#"+json.errors[i].field).addClass("errorField");
                                        message += json.errors[i].message + "\n";
                                    };
                                    swal("error", message, "error");
                                    return;
                                }

                                if( json.message )
                                {
                                    swal("success", json.message, "success");

                                    $("#editAccountForm :input").each(function(){
                                        var input = $(this);
                                        input.removeClass("errorField");
                                    });
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    }
                });

                $("#editProfileSettingsForm").validate({
                    submitHandler: function(form) {

                        var formData = new FormData($("#editProfileSettingsForm")[0]);

                        $.ajax({
                            url: base_url+"ajax/editProfileSettings/",
                            type: 'POST',
                            data: formData,
                            success: function (data) {
                                var json = JSON.parse(data);
                                setNewToken(json);

                                if( json.errors.length > 0)
                                {
                                    var message = "";
                                    for (var i = 0; i < json.errors.length; i++) {
                                        $("#"+json.errors[i].field).addClass("errorField");
                                        message += json.errors[i].message + "\n";
                                    };
                                    swal("error", message, "error");
                                    return;
                                }

                                if( json.message )
                                {
                                    swal("success", json.message, "success");

                                    $("#editProfileSettingsForm :input").each(function(){
                                        var input = $(this);
                                        input.removeClass("errorField");
                                    });
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    }
                });
    
                jQuery.validator.addMethod("validHexColour", function(value, element) {
                    return /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(value);
                }, "Must be a valid hex value.");

                jQuery.validator.addMethod("greaterThanOrEqual", function(value, element, params) {
                    if (!/Invalid|NaN/.test(new Date(value))) {
                        return new Date(value) >= new Date($(params).val());
                    }
                    return isNaN(value) && isNaN($(params).val()) 
                        || (Number(value) >= Number($(params).val())); 
                },'Year must be before start date.');

                $("#editProfileInformationForm").validate({
                    rules : {
                        profileTextColour : { validHexColour : true },
                        profileForecolor : { validHexColour : true }
                    },
                    submitHandler: function(form) {

                        var formData = new FormData($("#editProfileInformationForm")[0]);

                        $.ajax({
                            url: base_url+"ajax/editProfileInformation/",
                            type: 'POST',
                            data: formData,
                            success: function (data) {
                                var json = JSON.parse(data);
                                setNewToken(json);
                                
                                console.log(json);

                                if( json.errors.length > 0)
                                {
                                    var message = "";
                                    for (var i = 0; i < json.errors.length; i++) {
                                        $("#"+json.errors[i].field).addClass("errorField");
                                        message += json.errors[i].message + "\n";
                                    };
                                    swal("error", message, "error");
                                    return;
                                }

                                if( json.message )
                                {
                                    swal("success", json.message, "success");

                                    $("#editProfileSettingsForm :input").each(function(){
                                        var input = $(this);
                                        input.removeClass("errorField");
                                    });
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    }
                });
                
                $("#addEducationForm").validate({
                    rules: {
                        endYear: { greaterThanOrEqual: "#startYear" }
                    },
                    submitHandler: function(form) {
                        var formData = new FormData($("#addEducationForm")[0]);
                        $.ajax({
                            xhr: function() {
                                var xhr = new window.XMLHttpRequest();
                                xhr.upload.addEventListener("progress", function(evt) {
                                    if (evt.lengthComputable) {
                                        var percentComplete = (evt.loaded / evt.total)*100;
                                        console.log(percentComplete);
                                    }
                               }, false);

                               xhr.addEventListener("progress", function(evt) {
                                   if (evt.lengthComputable) {
                                       var percentComplete = (evt.loaded / evt.total)*100;
                                       console.log(percentComplete);
                                   }
                               }, false);

                               return xhr;
                            },
                            url: base_url+"ajax/addEducation/",
                            type: 'POST',
                            data: formData,
                            success: function (data) {
                                var json = JSON.parse(data);
                                setNewToken(json);
                                
                                if( json.errors.length > 0)
                                {
                                    var message = "";
                                    for (var i = 0; i < json.errors.length; i++) {
                                        $("#"+json.errors[i].field).addClass("errorField");
                                        message += json.errors[i].message + "\n";
                                    };
                                    var message = generateModalError(message); 
                                    $("#addEducationForm .notice").html(message);

                                    return;
                                }

                                app.educationList = json.educationList;
                                updateEducationTable();

                                if( json.message )
                                {
                                    var message = generateModalSuccess(json.message); 
                                    $("#addEducationForm .notice").html(message);

                                    $("#addEducationForm").resetForm();

                                    $("#addEducationForm :input").each(function(){
                                        var input = $(this);
                                        input.removeClass("errorField");
                                    });
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    }
                });
                
                $("#addSkillForm").validate({
                    submitHandler: function(form) {
                        var formData = new FormData($("#addSkillForm")[0]);

                        $.ajax({
                            url: base_url+"ajax/addSkill/",
                            type: 'POST',
                            data: formData,
                            success: function (data) {
                                var json = JSON.parse(data);
                                setNewToken(json);
                                
                                if( json.errors.length > 0)
                                {
                                    var message = "";
                                    for (var i = 0; i < json.errors.length; i++) {
                                        $("#"+json.errors[i].field).addClass("errorField");
                                        message += json.errors[i].message + "\n";
                                    };
                                    var message = generateModalError(message); 
                                    $("#addSkillForm .notice").html(message);

                                    return;
                                }

                                app.skillsList = json.skillsList;
                                updateSkillsTable();

                                if( json.message )
                                {
                                    var message = generateModalSuccess(json.message); 
                                    $("#addSkillForm .notice").html(message);

                                    $("#addSkillForm").resetForm();

                                    $("#addSkillForm :input").each(function(){
                                        var input = $(this);
                                        input.removeClass("errorField");
                                    });
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    }
                });
                
                $("#addPortfolioItemForm").validate({
                    rules: {
                        itemUrl: {
                            required: false,
                            url: true
                        }
                    },
                    submitHandler: function(form) {
                        var formData = new FormData($("#addPortfolioItemForm")[0]);

                        $.ajax({
                            url: base_url+"ajax/addPortfolioItem/",
                            type: 'POST',
                            data: formData,
                            success: function (data) {
                                var json = JSON.parse(data);
                                setNewToken(json);
                                
                                if( json.errors.length > 0)
                                {
                                    var message = "";
                                    for (var i = 0; i < json.errors.length; i++) {
                                        $("#"+json.errors[i].field).addClass("errorField");
                                        message += json.errors[i].message + "\n";
                                    };
                                    var message = generateModalError(message); 
                                    $("#addPortfolioItemForm .notice").html(message);

                                    return;
                                }

                                app.portfolioList = json.portfolioList;
                                updatePortfolioTable();

                                if( json.message )
                                {
                                    var message = generateModalSuccess(message); 
                                    $("#addPortfolioItemForm .notice").html(message);

                                    $("#addPortfolioItemForm :input").each(function(){
                                        var input = $(this);
                                        input.removeClass("errorField");
                                    });
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    }
                });
                
                $("#addSocialMediaForm").validate({
                    submitHandler: function(form) {
                        var formData = new FormData($("#addSocialMediaForm")[0]);

                        $.ajax({
                            url: base_url+"ajax/addSocialMedia/",
                            type: 'POST',
                            data: formData,
                            success: function (data) {
                                var json = JSON.parse(data);
                                setNewToken(json);
                                
                                console.log(json);

                                if( json.errors.length > 0)
                                {
                                    var message = "";
                                    for (var i = 0; i < json.errors.length; i++) {
                                        $("#"+json.errors[i].field).addClass("errorField");
                                        message += json.errors[i].message + "\n";
                                    };
                                    var message = generateModalError(message); 
                                    $("#addSocialMediaForm .notice").html(message);

                                    return;
                                }

                                app.socialMediaList = json.socialMediaList;
                                updateSocialMediaTable();

                                if( json.message )
                                {
                                    var message = generateModalSuccess(message); 
                                    $("#addSocialMediaForm .notice").html(message);

                                    $("#addSocialMediaForm :input").each(function(){
                                        var input = $(this);
                                        input.removeClass("errorField");
                                    });
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    }
                });

            });
        </script>
    </head>
    <body>
        <?php $this->load->view('inc.header.php'); ?>    
        <section class="container">
            <div class="page">
                <input type="hidden" id="csrf_token_ajax" name="csrf_token" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display:none;" />
                <h3>Your account</h3>
                <p>From this page you will be able to make changes to your profile.</p> 
                <p>Changes will instantly become visible on your profile web address as they are saved.</p>
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
                    <button type="submit" form="editProfileInformationForm" value="Save profile information" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-floppy-disk"></span> Save profile information</button>
                <?php echo form_close(); ?>
                <hr>
                <h4>Your education history:</h4>
                <br>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                    <span class="glyphicon glyphicon-plus"></span>
                    Add an education place
                </button>
                <br>
                <br>
                <table class="table table-bordered table-hover" id="educationTable">
                    <thead>
                         <th data-dynatable-no-sort="true" data-dynatable-column="placeName">Place Name</th>
                         <th data-dynatable-no-sort="true" data-dynatable-column="startYear">Start Year</th>
                         <th data-dynatable-no-sort="true" data-dynatable-column="endYear">End Year</th>
                         <th data-dynatable-no-sort="true" data-dynatable-column="deleteButton">Actions</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <hr>
                <h4>Your skills:</h4>
                <br>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal1">
                    <span class="glyphicon glyphicon-plus"></span>
                    Add a skill
                </button>
                <br>
                <br>
                <table class="table table-bordered table-hover" id="skillsTable">
                    <thead>
                        <th data-dynatable-no-sort="true" data-dynatable-column="skillName">Skill Name</th>
                        <th data-dynatable-no-sort="true" data-dynatable-column="skillPercentage">Skill percentage</th>
                        <th data-dynatable-no-sort="true" data-dynatable-column="deleteButton">Actions</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <hr>
                <h4>Your work portfolio:</h4>
                <br>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal2">
                    <span class="glyphicon glyphicon-plus"></span> 
                    Add a Portfolio Item
                </button>
                <br>
                <br>
                <table class="table table-bordered table-hover" id="portfolioTable">
                    <thead>
                        <th data-dynatable-no-sort="true" data-dynatable-column="itemName">Item Name</th>
                        <th data-dynatable-no-sort="true" data-dynatable-column="itemImage">Item Image</th>
                        <th data-dynatable-no-sort="true" data-dynatable-column="itemDescription">Item Description</th>
                        <th data-dynatable-no-sort="true" data-dynatable-column="deleteButton">Actions</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <hr>
                <h4>Your social profiles:</h4>
                <br>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal3">
                    <span class="glyphicon glyphicon-plus"></span> 
                    Add a social media
                </button>
                <br>
                <br>
                <table class="table table-bordered table-hover" id="socialMediaTable">
                    <thead>
                        <th data-dynatable-no-sort="true" data-dynatable-column="socialMediaName">Name</th>
                        <th data-dynatable-no-sort="true" data-dynatable-column="socialMediaID">User ID</th>
                        <th data-dynatable-no-sort="true" data-dynatable-column="deleteButton">Actions</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
                    <button type="submit" form="editProfileSettingsForm" value="Save profile settings" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-floppy-disk"></span> Save profile settings</button>
                <?php echo form_close(); ?>
                <hr>

                <?php //print_r($this->data['userdata']); ?>

                <?php //print_r($this->data['customUserdata']); ?>
            </div>
        </section>

        <?php $this->load->view('inc.footer.php'); ?>


        <div class="modal" id="myModal" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add education place</h4>
              </div>
              <div class="modal-body">
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
              <div class="modal-footer">
                <button type="submit" form="addEducationForm" value="Add education place" class="btn btn-primary">Add education place</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" id="myModal1" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a skill</h4>
              </div>
              <div class="modal-body">
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
                                    echo '<option value="'.$skill.'">'.$skill.'</option>';
                                }
                            ?>
                        </select>
                        <br>
                        <br>
                    <?php echo form_close(); ?>
              </div>
              <div class="modal-footer">
                <button type="submit" form="addSkillForm" value="Add skill" class="btn btn-primary">Add skill</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" id="myModal2" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a Portforlio Item</h4>
              </div>
              <div class="modal-body">
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
              <div class="modal-footer">
                <button type="submit" form="addPortfolioItemForm" value="Add portfolio item" class="btn btn-primary">Add portfolio item</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" id="myModal3" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a Social Media</h4>
              </div>
              <div class="modal-body">
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
              <div class="modal-footer">
                <button type="submit" form="addSocialMediaForm" value="Add portfolio item" class="btn btn-primary">Add Social Media</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>

    </body>
</html>