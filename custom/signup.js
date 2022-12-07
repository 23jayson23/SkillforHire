$("#registerUserForm").unbind('submit').bind('submit', function() {
    // form validation
    var userName = $("#fullname").val();
    var password = $("#password").val();

    if(userName == "") {
        $("#fullname").after('<p class="text-danger">User name field is required</p>');
        $('#fullname').closest('.form-group').addClass('has-error');
    }	else {
        // remov error text field
        $("#fullname").find('.text-danger').remove();
        // success out for form 
        $("#fullname").closest('.form-group').addClass('has-success');	  	
    }	// /else

    if(password == "") {
        $("#password").after('<p class="text-danger">Password field is required</p>');
        $('#password').closest('.form-group').addClass('has-error');
    }	else {
        // remov error text field
        $("#password").find('.text-danger').remove();
        // success out for form 
        $("#password").closest('.form-group').addClass('has-success');	  	
    }	// /else

    if(password && userName) {
        // submit loading button
        $("#registerbtn").button('loading');

        var form = $(this);
        var formData = new FormData(this);

        $.ajax({
            url : form.attr('action'),
            type: form.attr('method'),
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success:function(response) {

                if(response.success == true) {
                    
                    
                    // submit loading button
                    $("#registerbtn").button('reset');
                    
                    $("#registerUserForm")[0].reset();

                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
                                                            
                    // shows a successful message after operation
                    $('#messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');
          
          

                    // remove the mesages
                    Swal.fire({
                        icon: 'success',
                        title: 'Success.',
                        text: response
                        
                        
                      });
                    // remove text-error 
                    $(".text-danger").remove();
                    // remove from-group error
                    $(".form-group").removeClass('has-error').removeClass('has-success');

                } // /if response.success
                
            } // /success function
        }); // /ajax function
    }	 // /if validation is ok 
    					

    return false;
}); // /submit product form