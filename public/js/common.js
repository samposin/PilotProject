


	jQuery.fn.clearValidation = function (){
		var v = jQuery(this).validate();
		jQuery('[name]', this).each(function (){
			v.successList.push(this);
			/*v.showErrors();*/
			jQuery(this).parents('.control-group ').removeClass('error');
			$(this).parents('.error_class_div').removeClass('has-error');
			$(this).closest('.form-group').removeClass('has-error');
			jQuery(this).parents('.control-group').removeClass('success');
		});
		v.resetForm();
		v.reset();
	};

	jQuery(document).ready(function(){
	    /*
	    jQuery('div.alert').not('.alert-important').not(':hidden') .delay(3000).slideUp(300, function() {
	       jQuery(this).remove();
	    });
	    */
	});
