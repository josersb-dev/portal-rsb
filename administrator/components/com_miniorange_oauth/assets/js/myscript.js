
function add_css_tab(element) {
    
    jQuery(".mo_nav_tab_active").removeClass("mo_nav_tab_active").removeClass("active");
    jQuery(element).addClass("mo_nav_tab_active");
}


function copyToClipboard(element) { 
    var temp = jQuery("<input>");
    jQuery("body").append(temp);
    temp.val(jQuery(element).val()).select();
    document.execCommand("copy");
    temp.remove();
}

function validateEmail(emailField) 
{
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (reg.test(emailField.value) == false) 
    {
        document.getElementById('email_error').style.display = "block";
        document.getElementById('submit_button').disabled = true;
    } 
    else 
    {
        document.getElementById('email_error').style.display = "none";
        document.getElementById('submit_button').disabled = false;
    }
}

function back_button(){
    jQuery('#mo_otp_cancel_form').submit();
}

function resend_otp(){
    jQuery('#resend_otp_form').submit();
}    

//  tourrg.init();
function mo_oauth_account_exist(){
    jQuery('#oauth_account_already_exist').submit();
}


jQuery(document).ready(function () {
    jQuery('.premium').click(function () {
        jQuery('.nav-tabs a[href=#licensing-plans]').tab('show');
    });
});



function upgradeBtn()
{
    jQuery("#myModal").css("display","block");
}
function upgradeClose()
{
    jQuery("#myModal").css("display","none");
}
function oauth_back_to_register()
{
    jQuery('#oauth_cancel_form').submit();
}

function mo_oauth_show_proxy_form() {
	jQuery('#submit_proxy1').show();
	jQuery('#register_with_miniorange').hide();
	jQuery('#proxy_setup1').hide();
}
		
function mo_oauth_hide_proxy_form() {
	jQuery('#submit_proxy1').hide();
	jQuery('#register_with_miniorange').show();
	jQuery('#proxy_setup1').show();
	jQuery('#submit_proxy2').hide();
	jQuery('#mo_oauth_registered_page').show();
}
		
function mo_oauth_show_proxy_form2() {
	jQuery('#submit_proxy2').show();
	jQuery('#mo_oauth_registered_page').hide();
}

