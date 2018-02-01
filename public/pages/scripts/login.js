
	/*
		This javascript file used in my-account page
		URL: /admin/my-account
	*/

	var Login = function() {

		// Apply validation logic on login form
	    var handleLogin = function() {

	        $('#login-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                username: {
	                    required: true
	                },
	                password: {
	                    required: true
	                },
	                remember: {
	                    required: false
	                }
	            },
	            messages: {
	                username: {
	                    required: "Username is required."
	                },
	                password: {
	                    required: "Password is required."
	                }
	            },
	            invalidHandler: function(event, validator) { //display error alert on form submit
	                jQuery('.alert').hide();
	                $('.msg-login', $('#login-form')).show();
	            },
	            highlight: function(element) { // highlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },
	            success: function(label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },
	            errorPlacement: function(error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },
	            submitHandler: function(form) {
	                form.submit(); // form validation success, call ajax form submit
	            }
	        });

	        $('#login-form input').keypress(function(e) {
	            if (e.which == 13) {
	                if ($('#login-form').validate().form()) {
	                    $('#login-form').submit(); //form validation success, call ajax form submit
	                }
	                return false;
	            }
	        });
	    };

		// Apply validation logic on forgot password form
	    var handleForgetPassword = function() {

	        $('.forget-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "",
	            rules: {
	                email: {
	                    required: true,
	                    email: true
	                }
	            },
	            messages: {
	                email: {
	                    required: "Email is required."
	                }
	            },
	            invalidHandler: function(event, validator) { //display error alert on form submit
					$('.msg-login', $('#forget-form')).show();
	            },

	            highlight: function(element) { // highlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function(label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function(error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function(form) {
	                form.submit();
	            }
	        });

	        $('.forget-form input').keypress(function(e) {
	            if (e.which == 13) {
	                if ($('.forget-form').validate().form()) {
	                    $('.forget-form').submit();
	                }
	                return false;
	            }
	        });

	        jQuery('#back-btn').click(function() {
	            location.href=url_login;
	        });
	    };

		// Apply validation logic on reset password form
	    var handleResetPassword = function() {
			var form = $('#reset-form');

	        form.validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block help-block-error', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "", // validate all fields including form hidden input
	            rules: {
	                email: {
	                    required: true,
	                    email: true
	                },
	                password: {
	                    required: true,
	                    minlength: 6,
	                },
	                password_confirmation: {
	                    required: true,
	                    minlength: 6,
	                    equalTo: "#password"
	                }
	            },
	            messages: { // custom messages for radio buttons and checkboxes
	                email: {
	                    required: "Please enter email."
	                },
	                password: {
	                    required: "Please enter password."
	                },
	                password_confirmation: {
	                    required: "Please enter password."
	                }
	            },
	            errorPlacement: function (error, element) { // render error placement for each input type
	                jQuery('.server-error',form).remove();
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
	                form.submit(); // submit the form
	            }
	        });

	        $('.reset-form input').keypress(function(e) {
	            if (e.which == 13) {
	                if ($('.reset-form').validate().form()) {
	                    $('.reset-form').submit();
	                }
	                return false;
	            }
	        });
	    };

	    return {
	        //main function to initiate the module
	        init: function() {
	            handleLogin();
	            handleForgetPassword();
	            handleResetPassword();
	        }
	    };

	}();