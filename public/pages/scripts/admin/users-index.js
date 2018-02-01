
	/*
		This javascript file used in user list page
		URL: /admin/users
	*/

	//Delete function that opens popup and takes confirmation then send request to server
	function deleteUser(event,id_local)
	{
		event.stopPropagation();
	    title='<div style="font-weight:bold;">Are you sure you want to delete? <br>This action cannot be undone and will delete all information.</div>';
	    content='' +
	    '<form name="frm_delete_user" id="frm_delete_user" method="post">' +
	    '   <input type="hidden" name="_method" value="DELETE">'+
	    '   <input type="hidden" name="hdn_user_id" value="'+id_local+'">' +
	    '   <input type="hidden" name="_token" value="'+csrf_token+'">'+
	    '   <h4 style="font-weight:bold;">Please enter delete in capital letters to delete this user.</h4>'+
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
	                            jQuery('#frm_delete_user').submit();
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
		location.href=url_users+"/"+id;
	}


	//Apply datatable plugin to user list
	var UserListDataTable = function (){

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
                    // metronic spesific
                    "metronicGroupActions": "_TOTAL_ records selected:  ",
                    "metronicAjaxRequestGeneralError": "Could not complete request. Please check your internet connection",
                    // data tables specific
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

		        var user_id=$('.btn-list-edit',jQuery(this)).data("user-id");
		        goToEditPage(event,user_id);

		    });
		};

		return {

	        //main function to initiate the module
	        init: function () {
	            handleRecords();
	        }
	    };

	}();


	// Apply validation logic and form submission logic on add user form
	var UserAddFormValidation = function () {

	    var handleValidation = function() {
	        // for more info visit the official plugin documentation:
	        // http://docs.jquery.com/Plugins/Validation

	        var form = $('#frm_user_add');
	        var error = $('.alert-danger', form);
	        var success = $('.alert-success', form);

	        form.validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block help-block-error', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "", // validate all fields including form hidden input
	            rules: {
	                username: {
	                    minlength: 2,
	                    maxlength:50,
	                    required: true,
	                    remote: {
                            url: "users/check-username-availability",
                            type: "post",
                            data: {username: $("input[text='username']").val(), _token: csrf_token},
                            dataFilter: function (data) {
                                var json = JSON.parse(data);
                                if (json.msg == "true") {
                                    return "\"" + "This username has already been taken." + "\"";
                                } else {
                                    return 'true';
                                }
                            }
                        }
	                },
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
                            url: "users/check-email-availability",
                            type: "post",
                            data: {email: $("input[text='email']").val(), _token: csrf_token},
                            dataFilter: function (data) {
                                var json = JSON.parse(data);
                                if (json.msg == "true") {
                                    return "\"" + "Email already in use" + "\"";
                                } else {
                                    return 'true';
                                }
                            }
                        }
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
	                username: {
	                    required: "Please provide username."
	                },
	                firstname: {
	                    required: "Please provide firstname."
	                },
	                email: {
	                    required: "Please provide email."
	                },
	                password: {
	                    required: "Please enter password."

	                },
	                password_confirmation: {
	                    required: "Please enter password."
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

	                jQuery('.modal_msg',jQuery(form)).html("");
	                success.show();
	                error.hide();

					jQuery(form).ajaxSubmit({
						// other available options:
						url:       'users'  ,       // override for form's 'action' attribute
						type:      'post'  ,      // 'get' or 'post', override for form's 'method' attribute
						dataType:   'json',     // 'xml', 'script', or 'json' (expected server response type)
						// $.ajax options can be used here too, for example:
						//timeout:   3000,
						success: function(response, textStatus, xhr, form) {

					        var html='';

					        if(response.success)
					        {
					            location.href=url_users;
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


	jQuery(document).ready(function(){

		UserListDataTable.init();

		// Open popup for creating user
		jQuery('#anc_create_user').on('click',function(){
			jQuery("#frm_user_add").clearValidation();
	        jQuery("#modal_create_user").modal('show');
	    });

	    UserAddFormValidation.init();

	});