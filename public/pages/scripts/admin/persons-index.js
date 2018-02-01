
	/*
		This javascript file used in person list page
		URL: /admin/persons
	*/

	//Delete function that opens popup and takes confirmation then send request to server
	function deletePerson(event,id_local)
	{
		event.stopPropagation();
	    title='<div style="font-weight:bold;">Are you sure you want to delete? <br>This action cannot be undone and will delete all information.</div>';
	    content='' +
	    '<form name="frm_delete_person" id="frm_delete_person" method="post">' +
	    '   <input type="hidden" name="_method" value="DELETE">'+
	    '   <input type="hidden" name="hdn_person_id" value="'+id_local+'">' +
	    '   <input type="hidden" name="_token" value="'+csrf_token+'">'+
	    '   <h4 style="font-weight:bold;">Please enter delete in capital letters to delete this person.</h4>'+
	    '   <div class="form-group">'+
	    '       <div class="error_class_div ">'+
	    '           <input type="text" id="txt_ps_delete" name="txt_ps_delete" placeholder="Please enter delete in capital letters." class="form-control">'+
	    '           <span for="txt_ps_delete" class="help-block" style="display:none;">Please enter delete in capital letters.</span>'+
	    '       </div>'+
	    '   </div>' +
	    '</form>';
	    bootbox.dialog({
	        message: content,
	        title: title,
	        buttons: {
	            success: {
	                label: "Ok",
	                className: "btn-danger",
	                callback: function() {
	                    var txt_ps_delete_obj=jQuery("#txt_ps_delete");
	                    title = txt_ps_delete_obj.val();
	                    if (!title)
	                    {
	                        txt_ps_delete_obj.parents('.error_class_div').addClass('has-error');
	                        jQuery('.help-block',txt_ps_delete_obj.parents('.error_class_div')).show();
	                        return false;
	                    }
	                    else
	                    {
	                        if(title=='DELETE')
	                        {
	                            txt_ps_delete_obj.parents('.error_class_div').removeClass('has-error');
	                            jQuery('.help-block',txt_ps_delete_obj.parents('.error_class_div')).hide();
	                            jQuery('#frm_delete_person').submit();
	                        }
	                        else
	                        {
	                            txt_ps_delete_obj.parents('.error_class_div').addClass('has-error');
	                            jQuery('.help-block',txt_ps_delete_obj.parents('.error_class_div')).show();
	                            return false;
	                        }
	                    }
	                }
	            },
	            danger: {
	                label: "Cancel",
	                className: "btn-warning",
	                callback: function() {
	                    return true;
	                }
	            }
	        }
	    });
	}

	//This function redirect to person detail page
	function goToEditPage(event,id)
	{
		event.stopPropagation();
		location.href=url_persons+"/"+id;
	}

	//Apply datatable plugin to person list
	var PersonListDataTable = function (){

		var handleRecords = function (){

			var table = $('#datatable_ajax');

			var oTable = table.dataTable({
	            "order": [
                    [0, "asc"]
                ],// set first column as a default sort by asc
                "columnDefs": [ {
	                    "targets"  : 'no-sort',
	                    "orderable": false,
	                },
	                {
	                    "className": "text-center",
	                    "targets": []
					}],
	            "language": { // language settings
                    // metronic specific
                    "metronicGroupActions": "_TOTAL_ records selected:  ",
                    "metronicAjaxRequestGeneralError": "Could not complete request. Please check your internet connection",
                    // data tables spesific
                    "lengthMenu": "<span class='seperator'>|</span>View _MENU_ records",
                    "info": "<span class='seperator'>|</span>Found total _TOTAL_ records",
                    "infoEmpty": "No records found to show",
                    "emptyTable": "No data available in table",
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "previous": "Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First",
                        "page": "Page",
                        "pageOf": "of"
                    }
                },
	            "lengthMenu": [
                    [5, 10, 15, 20, 50, 100, 150, -1],
                    [5, 10, 15, 20, 50, 100, 150, "All"] // change per page values here
                ],
	            // set the initial value
	            "pageLength": 10,
	            "pagingType": "bootstrap_extended", // pagination type(bootstrap, bootstrap_full_number or bootstrap_extended)
				"dom": "<'row'<'col-xs-12 col-sm-12 col-md-6 col-lg-12' f><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r><'table-scrollable't><'row' <'col-xs-3 col-sm-3 col-md-3 col-lg-3 anc_add_contacts_cont clear'> <'col-xs-12 col-sm-12 col-md-9 col-lg-12 text-right'pli><'col-md-4 col-sm-12'>>", // datatable layout
	            fnDrawCallback: function( oSettings ) {
					$('div#datatable_ajax_filter input').addClass("input-medium");
				}
	        });

	        var tableWrapper = $('#datatable_ajax_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
	        tableWrapper.addClass("dataTables_extended_wrapper");

	        $('#datatable_ajax tbody').on('click', 'tr', function (event) {

		        var person_id=$('.btn-list-edit',jQuery(this)).data("person-id");
		        goToEditPage(event,person_id);

		    });
		};

		return {

	        //main function to initiate the module
	        init: function () {
	            handleRecords();
	        }
	    };

	}();

	// Apply validation logic and form submission logic on add person form
	var PersonAddFormValidation = function () {

	    var handleValidation = function() {
	        // for more info visit the official plugin documentation:
	        // http://docs.jquery.com/Plugins/Validation

	        var form = $('#frm_person_add');
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
		                $(element)
			                .closest('.form-group').removeClass('has-error'); // set error class to the control group
	                }

	            },
	            success: function (label) {
	                label
	                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
	            },
	            submitHandler: function (form) {

	                jQuery('.modal_msg',jQuery(form)).html("");
	                success.show();
	                error.hide();

					jQuery(form).ajaxSubmit({
						// other available options:
						url:       url_persons  ,       // override for form's 'action' attribute
						type:      'post'  ,      // 'get' or 'post', override for form's 'method' attribute
						dataType:   'json',     // 'xml', 'script', or 'json' (expected server response type)
						// $.ajax options can be used here too, for example:
						//timeout:   3000,
						success: function(response, textStatus, xhr, form) {

					        var html='';
					        if(response.success)
					        {
					            location.href=url_persons;
					        }
					        else
					        {
					            html+=''+
					            '<div class="alert alert-danger">'+
                                '   <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button>'+
								'   <ul>';

								for (var i in response.errors)
								{
									html+='<li>'+response.errors[i]+'</li>';
								}

								html+=''+
								'   </ul>'+
                                '</div>';

					            jQuery('.modal_msg',jQuery(form)).html(html);
					        }
					    },
					    error: function(xhr, textStatus, errorThrown) {

					    },
					    complete: function(xhr, textStatus) {

					    }
					});


					// !!! Important !!!
					// always return false to prevent standard browser submit and page navigation
					return false;

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
    };


	jQuery(document).ready(function(){

		initPickers();
		PersonListDataTable.init();

		// Open popup for creating person
		jQuery('#anc_create_person').on('click',function(){
			jQuery("#frm_person_add").clearValidation();
	        jQuery("#modal_create_person").modal('show');
	    });

	    PersonAddFormValidation.init();

	});