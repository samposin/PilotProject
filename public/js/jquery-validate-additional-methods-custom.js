
	/*
		This javascript file contains addition validation methods for jquery validate plugin
	*/
	jQuery(document).ready(function(){

		/*
			This function validate zip with zip extension
		*/

		jQuery.validator.addMethod("custom_zip_with_ext", function(value, element, params) {

			var zip=params[0];
		    var zip_ext=params[1];

		    if(zip!="")
		    {
		        if(zip_ext!=""){
		            if(zip_ext.length>4){
			            $.validator.messages["custom_zip_with_ext"] = "Please enter no more than 4 characters for zip extension.";
			            return false;
		            }
		        }
		    }

		    return true;

		}, jQuery.validator.format("Please enter the correct value"));


		/*
			This function validate phone with phone extension and phone type
		*/

		jQuery.validator.addMethod("custom_phone_with_ext_and_type", function(value, element, params) {

			var phone=params[0];
		    var phone_ext=params[1];
		    var phone_type=params[2];

		    if(phone!="")
		    {
		        if(phone_ext!=""){
		            if(phone_ext.length>8){
			            $.validator.messages["custom_phone_with_ext_and_type"] = "Please enter no more than 8 characters for phone extension.";
			            return false;
		            }
		        }
		    }

		    return true;

		}, jQuery.validator.format("Please enter the correct value"));

	});