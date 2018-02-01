
	/*
	    This javascript file used in person detail page
	    URL: /admin/persons/1
	 */

    // Apply validation logic on edit person form
	var PersonEditFormValidation = function () {

	    var handleValidation = function() {
	        // for more info visit the official plugin documentation:
	        // http://docs.jquery.com/Plugins/Validation

	        var form = $('#frm_person_edit');
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
	                    required: true,
	                },
	                lastname: {
	                    minlength: 2,
	                    maxlength:25,
	                    required: true
	                },
	                gender: {
	                    required: true
	                },
	                birth_date: {
	                    required: true
	                },
	                email: {
	                    minlength: 2,
	                    maxlength:50,
	                    email: true,
	                },
	                street1: {
	                    required: true
	                },
	                city: {
	                    required: true
	                },
	                state: {
	                    required: true
	                },
	                zip: {
	                    required: true,
	                    minlength:5,
	                    maxlength:5,
	                    custom_zip_with_ext:function(){ return [$("#zip").val(),$("#zip_ext").val()]; }
	                },
	                phone1: {
	                    minlength:10,
	                    maxlength:10,
	                    custom_phone_with_ext_and_type:function(){ return [$("#phone1").val(),$("#phone1_ext").val(),$("#phone1_type").val()]; }
	                },
	                phone2: {
	                    minlength:10,
	                    maxlength:10,
	                    custom_phone_with_ext_and_type:function(){ return [$("#phone2").val(),$("#phone2_ext").val(),$("#phone2_type").val()]; }
	                },
	                phone3: {
	                    minlength:10,
	                    maxlength:10,
	                    custom_phone_with_ext_and_type:function(){ return [$("#phone3").val(),$("#phone3_ext").val(),$("#phone3_type").val()]; }
	                }
	            },
	            messages: { // custom messages for radio buttons and checkboxes
	                firstname: {
	                    required: "Please provide firstname."
	                },
	                lastname: {
	                    required: "Please provide lastname."
	                },
	                gender: {
	                    required: "Please select gender."
	                },
	                birth_date: {
	                    required: "Please provide birth date."
	                },
	                street1: {
	                    required: "Please provide street."
	                },
	                city: {
	                    required: "Please provide city."
	                },
	                state: {
	                    required: "Please select state."
	                },
	                zip: {
	                    required: "Please provide zip.",
	                    minlength:"Please enter at least 5 characters for zip.",
	                    maxlength:"Please enter no more than 5 characters for zip."

	                },
	                phone1: {
	                    minlength:"Please enter at least 10 characters for phone.",
	                    maxlength:"Please enter no more than 10 characters for phone."
	                },
	                phone2: {
	                    minlength:"Please enter at least 10 characters for phone.",
	                    maxlength:"Please enter no more than 10 characters for phone."
	                },
	                phone3: {
	                    minlength:"Please enter at least 10 characters for phone.",
	                    maxlength:"Please enter no more than 10 characters for phone."
	                }
	            },
	            errorPlacement: function (error, element) { // render error placement for each input type
	                if (element.parent(".input-group").size() > 0) {
	                    error.insertAfter(element.parent(".input-group"));
	                } else if (element.attr("data-error-container")) {
	                    error.appendTo(element.attr("data-error-container"));
	                } else if (element.parents('.radio-list').size() > 0) {
	                    //error.appendTo(element.parents('.radio-list').attr("data-error-container"));
	                    element.parents('.radio-list').append(error);
	                } else if (element.parents('.radio-inline').size() > 0) {
	                    error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
	                } else if (element.parents('.checkbox-list').size() > 0) {
	                    error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
	                } else if (element.parents('.checkbox-inline').size() > 0) {
	                    error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
	                } else if (element.parents('.custom-zip-group').size() > 0) {
	                    element.parents('.custom-zip-group').append(error);
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
	                if(
	                    $(element).prop('name')=='phone1_ext'  ||
	                    $(element).prop('name')=='phone2_ext'  ||
	                    $(element).prop('name')=='phone3_ext'  ||
	                    $(element).prop('name')=='phone1_type' ||
	                    $(element).prop('name')=='phone2_type' ||
	                    $(element).prop('name')=='phone3_type' ||
	                    $(element).prop('name')=='zip_ext'
	                )
	                {
	                }
	                else
	                {
		                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
	                }
	            },
	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
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

	var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true
        });
    }


	jQuery(document).ready(function(){

		initPickers();

		PersonEditFormValidation.init();

		//Display form for edit information and hide readonly information
	    jQuery('#anc_edit_person').on('click',function(){
	        jQuery('.display_value_section').hide();
	        jQuery('.display_control_section').show();
	    });

		//Display readonly information and hide form for edit information with resetting
	    jQuery('#btnCancel').on('click',function(){
	        jQuery('.display_value_section').show();
	        jQuery('.display_control_section').hide();
	        jQuery("#frm_person_edit").clearValidation();
	    });

	});