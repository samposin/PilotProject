
	/*
	    This javascript file used in user detail page
	    URL: /admin/users/1
	 */

    // Apply validation logic on edit user form
	var UserEditFormValidation = function () {

	    var handleValidation = function() {
	        // for more info visit the official plugin documentation:
	        // http://docs.jquery.com/Plugins/Validation

	        var form = $('#frm_user_edit');
	        var error = $('.alert-danger', form);
	        var success = $('.alert-success', form);

	        form.validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block help-block-error', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "", // validate all fields including form hidden input
	            rules: {
	                firstname: {
	                    minlength: 2,
	                    maxlength:25,
	                    required: true
	                },
	                lastname: {
	                    minlength: 2,
	                    maxlength:25,
	                },
	                email: {
	                    minlength: 2,
	                    maxlength:50,
	                    required: true,
	                    email: true,
	                    remote: {
                            url: url_check_user_email_availability,
                            type: "post",
                            data: {email: $("input[text='email']").val(), _token: csrf_token, user_id:$("input[name='hdn_user_id']").val()},
                            dataFilter: function (data) {
                                var json = JSON.parse(data);
                                if (json.msg == "true") {
                                    return "\"" + "Email already in use" + "\"";
                                } else {
                                    return 'true';
                                }
                            },
                            onkeyup: false,
                            beforeSend:function(){

                            },
                            complete:function(){

                            }
                        }
	                },
	                password: {
	                    minlength: 6,
	                },
	                password_confirmation: {
	                    minlength: 6,
	                    equalTo: "#password"
	                }
	            },
	            messages: { // custom messages for radio buttons and checkboxes
	                firstname: {
	                    required: "Please provide firstname."
	                },
	                lastname: {
	                    required: "Please provide lastname."
	                },
	                email: {
	                    required: "Please provide email."
	                }
	            },
	            errorPlacement: function (error, element) { // render error placement for each input type
	                if (element.parent(".input-group").size() > 0) {
	                    error.insertAfter(element.parent(".input-group"));
	                } else if (element.attr("data-error-container")) {
	                    error.appendTo(element.attr("data-error-container"));
	                } else if (element.parents('.radio-list').size() > 0) {
	                    error.appendTo(element.parents('.radio-list').attr("data-error-container"));
	                } else if (element.parents('.radio-inline').size() > 0) {
	                    error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
	                } else if (element.parents('.checkbox-list').size() > 0) {
	                    error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
	                } else if (element.parents('.checkbox-inline').size() > 0) {
	                    error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
	                } else {
	                    error.insertAfter(element); // for other inputs, just perform default behavior
	                }
	            },
	            invalidHandler: function (event, validator) { //display error alert on form submit
	                success.hide();
	                error.show();
	                Metronic.scrollTo(error, -200);
	            },
	            highlight: function (element) { // highlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },
	            unhighlight: function (element) { // revert the change done by highlight
	                $(element)
	                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
	            },
	            success: function (label) {
	                label
	                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
	            },
	            submitHandler: function (form) {
	                success.show();
	                error.hide();
	                form.submit(); // submit the form
	            }
	        });
		};

	    return {

	        //main function to initiate the module
	        init: function () {
	            handleValidation();
	        }
	    };

	}();


	jQuery(document).ready(function(){

		UserEditFormValidation.init();

		//Display form for edit information and hide readonly information
	    jQuery('#anc_edit_user').on('click',function(){
	        jQuery('.display_value_section').hide();
	        jQuery('.display_control_section').show();
	    });

		//Display readonly information and hide form for edit information with resetting
	    jQuery('#btnCancel').on('click',function(){
	        jQuery('.display_value_section').show();
	        jQuery('.display_control_section').hide();
	        jQuery("#frm_user_edit").clearValidation();
	    });

	});