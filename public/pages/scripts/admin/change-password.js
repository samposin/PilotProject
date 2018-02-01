
	/*
		This javascript file used in change password page
		URL: /admin/my-account/change-password
	*/

	// Apply validation logic on change password form
	var MyAccountChangePasswordFormValidation = function () {

	    var handleValidation = function() {
	        // for more info visit the official plugin documentation:
	        // http://docs.jquery.com/Plugins/Validation

	        var form = $('#frm_my_account_change_password');
	        var error = $('.alert-danger', form);
	        var success = $('.alert-success', form);

	        form.validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block help-block-error', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "", // validate all fields including form hidden input
	            rules: {
	                current_password: {
	                    required: true,
	                    minlength: 6,
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
					current_password: {
	                    required: "Please enter current password."
	                },
	                password: {
	                    required: "Please enter new password."
	                },
	                password_confirmation: {
	                    required: "Please enter same password."
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
		}

	    return {
	        //main function to initiate the module
	        init: function () {
	            handleValidation();
	        }
	    };

	}();

	jQuery(document).ready(function(){

		MyAccountChangePasswordFormValidation.init();

	});

