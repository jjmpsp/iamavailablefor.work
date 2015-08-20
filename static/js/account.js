
$(document).ready(function(){

    $('#myModal').on('show.uk.modal', function () {
        $('#myModal .notice').html("");
    });
    $('#myModal1').on('show.uk.modal', function () {
        $('#myModal1 .notice').html("");
    });
    $('#myModal2').on('show.uk.modal', function () {
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
        console.log(response);
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
                app.educationList[i].deleteButton = '<button data-id="'+ app.educationList[i].id + '" class="uk-button uk-button-danger deleteButton">Delete</button>'; 
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
                app.skillsList[i].deleteButton = '<button data-id="'+ app.skillsList[i].id + '" class="uk-button uk-button-danger deleteButton">Delete</button>';
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
                app.portfolioList[i].deleteButton = '<button data-id="'+ app.portfolioList[i].id + '" class="uk-button uk-button-danger deleteButton">Delete</button>'; 
                app.portfolioList[i].itemImage = '<img class="portfolioImage" src="'+base_url+'uploads/portfolio/540x340/'+app.portfolioList[i].itemImage+'"/>'; 
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
                app.socialMediaList[i].deleteButton = '<button data-id="'+ app.socialMediaList[i].id + '" class="uk-button uk-button-danger deleteButton">Delete</button>';
                
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
        return '<div class="uk-alert uk-alert-error">'+message+'</div>';
    }

    function generateModalSuccess(message)
    {
        return '<div class="uk-alert uk-alert-success">'+message+'</div>';
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
            html: "Are you sure you want to delete this Education Place? <br>This action cannot be undone.",   
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
                success: function (json) {
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
            html: "Are you sure you want to delete this Skill? <br>This action cannot be undone.",    
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
                success: function (json) {
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
            html: "Are you sure you want to delete this Portfolio Item? <br>This action cannot be undone.",     
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
                success: function (json) {
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
        }else{
            $("#PortfolioItemImagePreview").css("display","block");
        }
    });

    $("#profilePictureImagePicker").change(function(){
        if(!readImage(this, "#profilePicturePreview"))
        {
            swal("error", "Please choose a valid image file!", "error");
        }else{
            $("#profilePicturePreview").css("display","block");
        }
    });

    $("#profileHeaderImageImagePicker").change(function(){
        if(!readImage(this, "#profileHeaderImagePreview"))
        {
            swal("error", "Please choose a valid image file!", "error");
        }else{
            $("#profileHeaderImageImagePicker").css("display","block");
        }
    });

    $("#editAccountForm").validate({
        submitHandler: function(form) {
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: base_url+"ajax/editAccountSettings/",
                type: 'POST',
                data: formData,
                success: function (json) {
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
                success: function (json) {
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
                success: function (json) {
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
                success: function (json) {
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
                success: function (json) {
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
                success: function (json) {
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
                success: function (json) {
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
                        var message = generateModalSuccess(json.message); 
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