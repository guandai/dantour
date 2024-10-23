jQuery(function($) {
    $(".email_field").hide();
    $(".invalid_error").hide();
    $(".blank_error").hide();
    $("#download-checkbox").click(function() {
        if ( $(this).is(":checked") ) {
            $(".email_field").show();
        } else {
            $(".email_field").hide();
        }
    });
    // To check blank or valid email address.
    $(".btn-submit").click(function() {
        var emailVal = $("#email-id").val();
        if ( emailVal == '' ) {
            $("#blank_email").show();
            return false;
        }
        if(IsEmail(emailVal)==false){
            $("#blank_email").hide();
            $('#invalid_email').show();
            return false;
        }
        $('#invalid_email').hide();
    });
    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
            return false;
        }else{
            return true;
        }
    }
});