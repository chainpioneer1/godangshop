function FormPost(buttonsection,SPATH,url,formnameid) {
	
 var buttonval=$(buttonsection).val();
        $(buttonsection).attr('value', 'Wait....').after('<img src="'+SPATH+'assets/img/loader.gif" class="loaderimg"/>');
        $(buttonsection).attr('disabled', 'disabled');
		
        $.ajax({
            type: "POST",
            url: url,
            data: $('#'+formnameid).serialize(),
            dataType: "json",
            cache: false,
            success: function(msg) {
			$('.loaderimg').remove();
                    
                if (msg['status'] == 'OK' && formnameid=="member_logform") { 
                  window.location.href='postjob';
                }
                else if(msg['status'] == 'OK' && formnameid=="member_register"){
                    
                  window.location.href='postjob/newuserLogin/'+msg['uid'];
                }
                if (msg['status'] == 'OK') {
                    
                    if(formnameid=="register"){
						//alert("LOGIN") 
                    //--------------------------------Trick----To get Loged in the user after signup
                    $("#username").val(msg['u']);
                    $("#password").val(msg['p']);
                    loginFormPost();
                    //----------------------------------------
                    }
                    if(formnameid=="changepass_frm"){ 
                        $("#change_pass").attr("checked", false);
                    }
				$('#'+formnameid).trigger('reset');
				clearErrors();
				 $('#'+formnameid).hide();
                                 $('.alert-success').html(msg['message']).show();
                                
                                
                                   if(msg['location']){
                                            window.location.replace( msg['location']);
                                    } 
				 
                  
                } else if (msg['status'] == 'FAIL') {
                    registerFormPostResponse(buttonsection,buttonval,formnameid,msg['errors']);
                }
            },
            error: function(msg) {
				
                $(buttonsection).attr('value', buttonval);
                $(buttonsection).removeAttr('disabled');
            }
        });
        
        return false;
    }
 
 function registerFormPostResponse(buttonsection,buttonval,formnameid,errors) {
        $(buttonsection).attr('value', buttonval);
        $(buttonsection).removeAttr('disabled');
    
        clearErrors();
        if (errors.length > 0) {
            for (i = 0; i < errors.length; i++) {
                showError(formnameid,errors[i].id, errors[i].message);
            }
        }
    }
    
    
 
 function clearErrors() {
        $('.rerror').hide();
        
       
    }
    
    function showError(formnameid,field, message) {
        
        if ( field == 'zip' || field == 'state' || field == 'city' ) {
            $('#'+formnameid+' #' + field).after('<span class="error-msg" id="errmsg_' + field + '">' + message + '</span>');
        } else {
            message = " <span class=\"error-msg\"> "+message+"</span>";
            $('#'+formnameid+' #'+field+'Error')
                .html(message)
                .show();
        }
    }