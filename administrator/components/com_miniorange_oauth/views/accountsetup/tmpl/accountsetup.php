<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_miniorange_oauth
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::_('jquery.framework');
JHtml::_('script',JURI::base() . 'components/com_miniorange_oauth/assets/js/bootstrap.js'); 
JHtml::_('stylesheet',JURI::base() . 'components/com_miniorange_oauth/assets/css/miniorange_oauth.css');
JHtml::_('stylesheet',JURI::base() . 'components/com_miniorange_oauth/assets/css/miniorange_boot.css');
JHtml::_('script',JURI::base() . 'components/com_miniorange_oauth/assets/js/jeswanthscript.js');
JHtml::_('script',JURI::base() . 'components/com_miniorange_oauth/assets/js/myscript.js'); 
JHtml::_('stylesheet','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
?>  
<?php
if (MoOAuthUtility::is_curl_installed() == 0) { ?>
    <p style="color:red;">(Warning: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP CURL
            extension</a> is not installed or disabled) Please go to Troubleshooting for steps to enable curl.</p>
    <?php
}


$active_tab = JFactory::getApplication()->input->get->getArray();

$oauth_active_tab = isset($active_tab['tab-panel']) && !empty($active_tab['tab-panel']) ? $active_tab['tab-panel'] : 'configuration';

global $license_tab_link;
$license_tab_link="index.php?option=com_miniorange_oauth&view=accountsetup&tab-panel=license";

$current_user = JFactory::getUser();
if(!JPluginHelper::isEnabled('system', 'miniorangeoauth')) {
    ?>
    <div id="system-message-container">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <div class="alert alert-error">
            <h4 class="alert-heading">Warning!</h4>
            <div class="alert-message">
                <h4>
                    This component requires System Plugin to be activated. Please activate the following plugin
                    to proceed further: System - miniOrange OAuth Client
                </h4>
                <h4>Steps to activate the plugins:</h4>
                <ul>
                    <li>In the top menu, click on Extensions and select Plugins.</li>
                    <li>Search for miniOrange in the search box and press 'Search' to display the plugins.</li>
                    <li>Now enable the System plugin.</li>
                </ul>
            </div>
            </h4>
        </div>
    </div>
<?php } ?>
<style>
    /* .TC_modal {
        position: fixed;
        z-index: 10; 
        left:0;
        top: 0!important;
        width: 100%!important;
        height: 100%!important; 
        overflow: auto; 
        background-color: rgba(0,0,0,0.4)!important; 
        display:none;
    } */
    /* .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        height: auto;
        border:3px solid #2384d3;
    } */
    .close {
        color: red;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }   
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<script>
    function MyClose(){
        jQuery(".TC_modal").css("display","none");
    }
    function show_TC_modal(){
        jQuery(".TC_modal").css("display","block");
    }
    function CloseFreeSetup()
    {
        <?php
                setcookie("free_setup_box","1");
        ?>
        jQuery("#mo_freesetupBox").css("display","none");
    }
</script>

<?php
$boxHide = JFactory::getApplication()->input->cookie->get('free_setup_box');
if($boxHide != 1)
{ ?>
     <div id="mo_freesetupBox" class="mo_boot_row mo_boot_my-1 mo_boot_border mo_boot_border-dark" style="background-repeat: no-repeat;background-size:cover;background:blackbackground: #bdc3c7; background: linear-gradient(to right, #173a65, #2a69b8);">
         <div class="mo_boot_col-sm-12 mo_boot_py-1 mo_boot_text-center mo_boot_text-light">
         <p><?php echo JText::_('COM_MINIORANGE_OAUTH_WELCOME_MESSAGE1');?></p>
         <p><?php echo JText::_('COM_MINIORANGE_OAUTH_WELCOME_MESSAGE2');?> <a href="mailto:joomlasupport@xecurify.com" ><strong style="color:white"><?php echo JText::_('COM_MINIORANGE_OAUTH_WELCOME_MESSAGE3');?></strong></a></p>
         <input type="button" onclick="window.open('https://miniorange.com/contact')" target="_blank" value="<?php echo JText::_('COM_MINIORANGE_OAUTH_WELCOME_MESSAGE_CONTACT_US');?>"  class="mo_boot_btn mo_boot_btn-success" />
         <span onclick="CloseFreeSetup()" class="mo_boot_btn mo_boot_btn-danger"><?php echo JText::_('COM_MINIORANGE_OAUTH_CLOSE_WELCOME_MESSAGE');?></span>
         </div>
     </div>
     <?php 
}
?>

    <button id="mo_TC"  onclick="show_TC_modal()" style=" float: right; margin-right:10px" class="mo_boot_btn mo_boot_btn-primary">T&C</button>
    <a style=" float: right; margin-right:10px" class="mo_boot_btn mo_boot_text-light mo_boot_bg-success" href="<?php echo JURI::base()?>index.php?option=com_miniorange_oauth&view=accountsetup&tab-panel=support">
        <?php echo JText::_('COM_MINIORANGE_OAUTH_SUPPORT');?>
    </a>
    <div id="TC_Modal" class="TC_modal">
        <div class="modal-content">
            <div class="mo_boot_row">
                <h5 class="mo_boot_col-sm-11"><?php echo JText::_('COM_MINIORANGE_OAUTH_TERMS_AND_CONDITIONS');?></h5>
                <span class="mo_boot_col-sm-1 close" onclick="MyClose()"><span>&times;</span></span>
            </div>
            <div>
                <hr>
                <ul> 
                    <li><?php echo JText::_('COM_MINIORANGE_OAUTH_TERMS_AND_CONDITIONS1');?></li>
                    <li><?php echo JText::_('COM_MINIORANGE_OAUTH_TERMS_AND_CONDITIONS2');?></li>
                    <li><?php echo JText::_('COM_MINIORANGE_OAUTH_TERMS_AND_CONDITIONS3');?></li>
                    <li><?php echo JText::_('COM_MINIORANGE_OAUTH_TERMS_AND_CONDITIONS4');?></li>
                    <li>
                        <form method="post" name="f" action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.saveAdminMail'); ?>" > 
                            <?php
                                $dVar=new JConfig(); 
                                $check_email = $dVar->mailfrom;
                                $call= new MoOauthCustomer();
                                $result=$call->getAccountDetails();
                                if($result['contact_admin_email']!=NULL)
                                {
                                    $check_email =$result['contact_admin_email'];
                                }
                            ?>
                            <div class="mo_boot_row mo_boot_mt-3">
                                <div class="mo_boot_col-sm-5">
                                    <input type="email" name="oauth_client_admin_email"  class="mo_boot_form-control" placeholder="<?php echo $check_email;?>">
                                </div>
                                <div class="mo_boot_col-sm-3">
                                    <input type="submit" class="mo_boot_btn mo_boot_btn-primary">
                                </div>
                            </div>                            
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nav-tab-wrapper mo_idp_nav-tab-wrapper" id="myTabTabs">
        <a id="configtab" class="mo_nav-tab mo_nav_tab_<?php echo $oauth_active_tab == 'configuration' ? 'active' : ''; ?>" href="#configuration"
            onclick="add_css_tab('#configtab');"
            data-toggle="tab"><?php echo JText::_('COM_MINIORANGE_OAUTH_TAB1_CONFIGURE_OAUTH');?>
        </a>
        <a id="attributetab" class="mo_nav-tab mo_nav_tab_<?php echo $oauth_active_tab == 'attrrolemapping' ? 'active' : ''; ?>" href="#attrrolemapping"
            onclick="add_css_tab('#attributetab');"
            data-toggle="tab"><?php echo JText::_('COM_MINIORANGE_OAUTH_TAB2_ATTRIBUTE_MAPPING');?>
        </a>
        <a id="roletab" class="mo_nav-tab mo_nav_tab_<?php echo $oauth_active_tab == 'rolemapping' ? 'active' : ''; ?>" href="#rolemapping"
            onclick="add_css_tab('#roletab');"
            data-toggle="tab"><?php echo JText::_('COM_MINIORANGE_OAUTH_TAB3_ROLE_GROUP_MAPPING');?>
        </a>
        <a id="advancetab" class="mo_nav-tab mo_nav_tab_<?php echo $oauth_active_tab == 'loginlogoutsettings' ? 'active' : ''; ?>" href="#loginlogoutsettings"
            onclick="add_css_tab('#advancetab');"
            data-toggle="tab"><?php echo JText::_('COM_MINIORANGE_OAUTH_TAB4_ADVANCED_SETTINGS');?>
        </a>
        <a id="licensetab" class=" mo_boot_bg-success mo_nav-tab mo_nav_tab_<?php echo $oauth_active_tab == 'license' ? 'active' : ''; ?>" href="#licensing-plans"
            onclick="add_css_tab('#licensetab');"
            data-toggle="tab"><?php echo JText::_('COM_MINIORANGE_OAUTH_TAB5_LICENSING_PLANS');?>
        </a>
        <a id="addons" class="mo_nav-tab mo_nav_tab_<?php echo $oauth_active_tab =='addon'?'active':'';?>" href="#addon"
            onclick="add_css_tab('#addons');"
            data-toggle="tab"><?php echo JText::_('COM_MINIORANGE_OAUTH_TAB6_ADD_ONS');?>
        </a>
        <a id="accounttab" class="mo_nav-tab mo_nav_tab_<?php echo $oauth_active_tab == 'account' ? 'active' : ''; ?>" href="#description"
            onclick="add_css_tab('#accounttab');"
            data-toggle="tab"><?php echo JText::_('COM_MINIORANGE_OAUTH_TAB7_ACCOUNT_SETUP'); ?>
        </a>
    </div> 
    <div class="tab-content" id="myTabContent">
        <div id="description" class="tab-pane <?php echo $oauth_active_tab == 'account' ? 'active' : ''; ?>">
            <div class="mo_boot_row mo_boot_m-1" style="background-color:#e0e0d8;">
                <?php
                $customer_details = MoOAuthUtility::getCustomerDetails();
                $registration_status = $customer_details['registration_status'];
                if ($customer_details['login_status']) { ?>
                    <div class="mo_boot_col-sm-8">
                        <?php mo_oauth_login_page(); ?>
                    </div>
                    <div class="mo_boot_col-sm-4">
                        <?php  echo mo_oauth_support();?>
                    </div>
                <?php
                } else { 
                    if ($registration_status == 'MO_OTP_DELIVERED_SUCCESS' || $registration_status == 'MO_OTP_VALIDATION_FAILURE' || $registration_status == 'MO_OTP_DELIVERED_FAILURE') {
                        ?>
                        <div class="mo_boot_col-sm-8">
                            <?php mo_otp_show_otp_verification(); ?>
                        </div>
                        <div class="mo_boot_col-sm-4">
                            <?php  echo mo_oauth_support();?>
                        </div>
                    <?php
                    }
                    else if (!MoOAuthUtility::is_customer_registered()) {
                        ?>
                            <div class="mo_boot_col-sm-8">
                                <?php mo_oauth_registration_page(); ?>
                            </div>
                            <div class="mo_boot_col-sm-4">
                                <?php  echo mo_oauth_support();?>
                            </div>
                        <?php
                    }
                    else
                    {
                        ?>
                            <div class="mo_boot_col-sm-8">
                                <?php mo_oauth_account_page(); ?>
                            </div>
                            <div class="mo_boot_col-sm-4">
                                <?php  echo mo_oauth_support();?>
                            </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div id="configuration" class="tab-pane <?php echo $oauth_active_tab == 'configuration' ? 'active' : ''; ?>">
            <div class="mo_boot_row mo_boot_m-1" style="background-color:#e0e0d8;">
                <div class="mo_boot_col-sm-12">
                    <?php selectAppByIcon(); ?>
                </div>
            </div>
        </div>
        <div id="attrrolemapping" class="tab-pane <?php echo $oauth_active_tab == 'attrrolemapping' ? 'active' : ''; ?>">
            <div class="mo_boot_row mo_boot_m-1" style="background-color:#e0e0d8;">
                <div class="mo_boot_col-sm-8">
                    <?php attributerole(); ?>
                </div>
                <div id="confsupport" class="mo_boot_col-sm-4">
                    <?php  echo mo_oauth_support();?>
                </div>
            </div>
        </div>
        <div id="rolemapping" class="tab-pane <?php echo $oauth_active_tab == 'rolemapping' ? 'active' : ''; ?>">
            <div class="mo_boot_row mo_boot_m-1" style="background-color:#e0e0d8;">
                <div class="mo_boot_col-sm-8">
                    <?php roleMapping(); ?>
                </div>
                <div id="confsupport" class="mo_boot_col-sm-4">
                    <?php  echo mo_oauth_support();?>
                </div>
            </div>
        </div>
        <div id="loginlogoutsettings" class="tab-pane <?php echo $oauth_active_tab == 'loginlogoutsettings' ? 'active' : ''; ?>">
            <div class="mo_boot_row mo_boot_m-1" style="background-color:#e0e0d8;">
                <div class="mo_boot_col-sm-8">
                    <?php loginlogoutsettings(); ?>
                </div>
                <div id="confsupport" class="mo_boot_col-sm-4">
                    <?php  echo mo_oauth_support();?>
                </div>
            </div>
        </div>
        <div id="support" class="tab-pane <?php echo $oauth_active_tab == 'support' ? 'active' : ''; ?>">
            <div class="mo_boot_row mo_boot_m-1" style="background-color:#e0e0d8;">
                <div class="mo_boot_col-sm-8">
                    <?php support();   ?>
                </div>
                <div id="confsupport" class="mo_boot_col-sm-4">
                    <?php mo_oauth_side_addon()?>
                </div>
            </div>
        </div>
        <div id="addon" class="tab-pane <?php echo $oauth_active_tab == 'addon' ? 'active' : ''; ?>">
            <div class="mo_boot_row mo_boot_m-1" style="background-color:#e0e0d8;">
                <div class="mo_boot_col-sm-12 mo_boot_mx-2">
                    <?php mo_oauth_addon();?>
                </div>
            </div>
        </div>

        <div id="licensing-plans" class="tab-pane <?php echo $oauth_active_tab == 'license' ? 'active' : ''; ?>">
            <div class="mo_boot_row mo_boot_m-1" style="background-color:#e0e0d8;">
                <div class="mo_boot_col-sm-12">
                    <?php
                        echo mo_oauth_licensing_plan()
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--
        *End Of Tabs for accountsetup view.
        *Below are the UI for various sections of Account Creation.
    -->
<?php


function mo_oauth_login_page()
{
    global $license_tab_link;
    $result = MoOAuthUtility::getCustomerDetails();
    $admin_email = $result["email"];
    ?>
    <form name="f" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.verifyCustomer'); ?>">
        <div class="mo_boot_row mo_boot_mx-1 mo_boot_my-3 tab_box_style">
            <div class="mo_boot_col-sm-12 mo_boot_mt-3">
                <h3><?php echo JText::_('COM_MINIORANGE_OAUTH_LOGIN_WITH_MINIORANGE');?></h3>
                <hr>
                <p><?php echo JText::_('COM_MINIORANGE_OAUTH_LOGIN_WITH_MINIORANGE_NOTE');?></p>
            </div>
            <div class="mo_boot_col-sm-12 mo_boot_p-3">
                <div class="mo_boot_row mo_boot_mt-2">
                    <div class="mo_boot_col-sm-3">
                        <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_LOGIN_WITH_MINIORANGE_EMAIL');?></strong>
                    </div>
                    <div class="mo_boot_col-sm-6">
                        <input class="mo_boot_form-control oauth-textfield" type="email" name="email" id="email" required placeholder="person@example.com" value="<?php echo $admin_email; ?>"/>
                    </div>
                </div>
                <div class="mo_boot_row mo_boot_mt-2">
                    <div class="mo_boot_col-sm-3">
                        <strong><span  class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_LOGIN_WITH_MINIORANGE_PASSWORD');?></strong>
                    </div>
                    <div class="mo_boot_col-sm-6">
                        <input class="mo_boot_form-control oauth-textfield" required type="password" name="password" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_LOGIN_WITH_MINIORANGE_PASSWORD_PLACEHOLDER');?>"/>
                    </div>
                </div>
                <div class="mo_boot_row mo_boot_my-4 mo_boot_text-center">
                    <div class="mo_boot_col-sm-12">
                        <input type="submit" class="mo_boot_btn mo_boot_btn-success" value="<?php echo JText::_('COM_MINIORANGE_OAUTH_LOGIN_WITH_MINIORANGE_BUTTON');?>"/>&nbsp;&nbsp;
                        <a href="https://login.xecurify.com/moas/idp/resetpassword" target="_blank" class="mo_boot_btn mo_boot_btn-primary" style="text-decoration:none;color:white!important;" ><?php echo JText::_('COM_MINIORANGE_OAUTH_FORGOT_YOUR_PASSWORD');?></a>&nbsp;&nbsp;
                        <a href="#oauth_cancel_link" onclick="oauth_back_to_register()" class="mo_boot_btn mo_boot_btn-danger"><?php echo JText::_('COM_MINIORANGE_OAUTH_BACK_TO_REGISTERATION');?></a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form id="oauth_cancel_form" method="post"
          action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.cancelform'); ?>">
    </form>
    <?php
}

/* Show otp verification page*/
function mo_otp_show_otp_verification()
{
    global $license_tab_link;
    ?>
    <div class="mo_boot_row mo_boot_mx-1 mo_boot_my-3 tab_box_style">
        <div class="mo_boot_col-sm-12 mo_boot_mt-3">
            <form name="f" method="post" id="otp_form" action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.validateOtp'); ?>">
                <div class="mo_boot_row">
                    <div class="mo_boot_col-sm-12  mo_boot_mt-2">
                        <h3><?php echo JText::_('COM_MINIORANGE_OAUTH_VERIFY_YOUR_EMAIL');?></h3>
                        <hr/>
                    </div>
                    <div class="mo_boot_col-sm-12 mo_boot_mt-2">
                        <div class="mo_boot_row mo_boot_mt-2">
                            <div class="mo_boot_col-sm-3 mo_boot_mt-2">
                                <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_ENTER_OTP');?></strong>
                            </div>
                            <div class="mo_boot_col-sm-6 mo_boot_mt-2">
                                <input class="mo_boot_form-control" autofocus="true" type="text" name="otp_token" required placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_ENTER_OTP_PLACEHOLDER');?>"/>
                            </div>
                            <div class="mo_boot_col-sm-2 mo_boot_mt-2">
                                <a onclick="resend_otp()" class="mo_boot_btn mo_boot_btn-primary" style="text-decoration:none;color:white!important;" ><?php echo JText::_('COM_MINIORANGE_OAUTH_RESEND_OTP');?></a>
                            </div>
                        </div>
                        <div class="mo_boot_row mo_boot_mt-2 mo_boot_text-center">
                            <div class="mo_boot_col-sm-12 mo_boot_mt-3">
                                <input type="submit" value="<?php echo JText::_('COM_MINIORANGE_OAUTH_VALIDATE_OTP');?>" class="mo_boot_btn mo_boot_btn-success"/>
                                <input type="button" value="<?php echo JText::_('COM_MINIORANGE_OAUTH_BACK_BUTTON');?>" onclick="back_button()" class="mo_boot_btn mo_boot_btn-danger"/>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </form>

            <form method="post"
                action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.cancelform'); ?>"
                id="mo_otp_cancel_form">
            </form>
 
            <form name="f" id="resend_otp_form" method="post"
                action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.resendOtp'); ?>">
            </form>


            <form id="phone_verification" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.phoneVerification'); ?>">
                <div class="mo_boot_row mo_boot_mt-2">
                    <div class="mo_boot_col-sm-12 mo_boot_mt-2">
                        <h4><?php echo JText::_('COM_MINIORANGE_OAUTH_DID_NOT_RECIEVE_OTP');?></h4>
                        <?php echo JText::_('COM_MINIORANGE_OAUTH_DID_NOT_RECIEVE_OTP_NOTE');?>
                        <?php echo JText::_('COM_MINIORANGE_OAUTH_ENTER_PHONE_TO_VALIDATE_OTP');?>
                    </div>
                    <div class="mo_boot_col-sm-4 mo_boot_mt-2">
                        <input class="mo_boot_form-control" required="true" pattern="[\+]\d{1,3}\d{10}" autofocus="true" type="text"
                            name="phone_number" id="phone_number" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_ENTER_PHONE_TO_VALIDATE_OTP_PLACEHOLDER');?>"
                            title="Enter phone number without any space or dashes with country code."/>
                    </div>
                    <div class="mo_boot_col-sm-2 mo_boot_mt-2">
                        <input type="submit" value="<?php echo JText::_('COM_MINIORANGE_OAUTH_SEND_OTP');?>" class="mo_boot_btn mo_boot_btn-success"/>
                    </div>
                    <div class="mo_boot_col-sm-12 mo_boot_mt-2">
                        <hr>
                        <p style="color:#b42f2f;"><?php echo JText::_('COM_MINIORANGE_OAUTH_FACING_ISSUES_WHILE_SENDING_OTP1');?> <a href="mailto:joomlasupport@xecurify.com"><?php echo JText::_('COM_MINIORANGE_OAUTH_FACING_ISSUES_WHILE_SENDING_OTP2');?></a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <?php
}

/* Create Customer function */
function mo_oauth_registration_page()
{
    global $license_tab_link;
    $current_user = JFactory::getUser();
    ?>
    <!--Register with miniOrange-->
    <div class="mo_boot_row mo_boot_mx-1 mo_boot_my-3 tab_box_style" id="register_with_miniorange">
        <div class="mo_boot_col-sm-12 mo_boot_mt-2">
            <form name="f" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.moOAuthRegisterCustomer'); ?>">
                <div class="mo_boot_row mo_boot_mt-2">
                    <div class="mo_boot_col-sm-7 mo_boot_mt-2">
                        <h3><?php echo JText::_('COM_MINIORANGE_OAUTH_REGISTER_WITH_MINIORANGE');?></h3>
                    </div>
                    <div class="mo_boot_col-sm-5 mo_boot_mt-2">
                        <span onclick="mo_oauth_account_exist()" class="mo_boot_btn mo_boot_btn-success"><?php echo JText::_('COM_MINIORANGE_OAUTH_ALREADY_REGISTERED_WITH_MINIORANGE');?></span>
                    </div>
                </div>
                <div class="mo_boot_row mo_boot_mt-2">
                    <div class="mo_boot_col-sm-12">
                        <hr>
                        <p class='alert alert-info'><?php echo JText::_('COM_MINIORANGE_OAUTH_REGISTER_WITH_MINIORANGE_NOTE');?><br><br></p>
                        <em><p style="color: #b42f2f;"><?php echo JText::_('COM_MINIORANGE_OAUTH_FACING_ISSUES_DURING_REGISTERATION1');?> <a href="https://www.miniorange.com/businessfreetrial" target="_blank"><strong><?php echo JText::_('COM_MINIORANGE_OAUTH_FACING_ISSUES_DURING_REGISTERATION2');?></strong></a> <?php echo JText::_('COM_MINIORANGE_OAUTH_FACING_ISSUES_DURING_REGISTERATION3');?></p></em>
                    </div>
                </div>
                <div class="mo_boot_row mo_boot_mt-2">
                    <div class="mo_boot_col-sm-3">
                        <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_REGISTERATION_EMAIL');?></strong>
                    </div>
                    <div class="mo_boot_col-sm-6">
                        <input class="mo_boot_form-control oauth-textfield" type="email" name="email" required placeholder="person@example.com" value="<?php echo $current_user->email; ?>"/>
                    </div>
                </div>
                <div class="mo_boot_row mo_boot_mt-2">
                    <div class="mo_boot_col-sm-3">
                        <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_REGISTERATION_PHONE');?></strong>
                    </div>
                    <div class="mo_boot_col-sm-6">
                        <input class="mo_boot_form-control oauth-textfield" type="tel" id="phone" pattern="[\+]\d{11,14}|[\+]\d{1,4}([\s]{0,1})(\d{0}|\d{9,10})" name="phone" title="Phone with country code eg. +1xxxxxxxxxx" placeholder="Phone with country code eg. +1xxxxxxxxxx"/>
                        <small><em><?php echo JText::_('COM_MINIORANGE_OAUTH_REGISTERATION_PHONE_NOTE');?></em></small>
                    </div>
                </div>
                <div class="mo_boot_row mo_boot_mt-2">
                    <div class="mo_boot_col-sm-3">
                        <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_REGISTERATION_PASSWORD');?></strong>
                    </div>
                    <div class="mo_boot_col-sm-6">
                        <input class="mo_boot_form-control oauth-textfield" required type="password" name="password" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_REGISTERATION_PASSWORD_PLACEHOLDER');?>"/>
                    </div>
                </div>
                <div class="mo_boot_row mo_boot_mt-2">
                    <div class="mo_boot_col-sm-3">
                        <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_REGISTERATION_CONFIRM_PASSWORD');?></strong>
                    </div>
                    <div class="mo_boot_col-sm-6">
                        <input class="mo_boot_form-control oauth-textfield" required type="password" name="confirmPassword" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_REGISTERATION_CONFIRM_PASSWORD_PLACEHOLDER');?>"/>
                    </div>
                </div>
                <div class="mo_boot_row mo_boot_my-4 mo_boot_text-center">
                    <div class="mo_boot_col-sm-12">
                        <input type="submit" value="<?php echo JText::_('COM_MINIORANGE_OAUTH_REGISTER');?>" class="mo_boot_btn mo_boot_btn-success"/>
                        <input id="mo_oauth_proxy" type="button" class='mo_boot_btn mo_boot_btn-success' onclick='mo_oauth_show_proxy_form()' value="<?php echo JText::_('COM_MINIORANGE_OAUTH_CONFIGURE_PROXY_SERVER');?>"/>
                    </div>
                </div>
            </form>
            <form name="f" id="oauth_account_already_exist" method="post"
                action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.customerLoginForm'); ?> ">
            </form>
        </div>
    </div>

        <div class="mo_boot_row" id="submit_proxy1" style="display : none">
        <div class="mo_boot_row mo_boot_mx-1 mo_boot_my-3 tab_box_style">	
        <?php moOAuthProxySetup(); ?>
    </div>
    </div>
    <?php
}

function moOAuthProxySetup()
{
	$mo_oauth_config = getAppDetails();
	$proxy_server_url = isset($mo_oauth_config['proxy_server_url'])? $mo_oauth_config['proxy_server_url']: ""; 
	$proxy_server_port = isset($mo_oauth_config['proxy_server_port'])? $mo_oauth_config['proxy_server_port']: "";
	$proxy_username = isset($mo_oauth_config['proxy_username'])? $mo_oauth_config['proxy_username']: ""; 
	$proxy_password = isset($mo_oauth_config['proxy_password'])? $mo_oauth_config['proxy_password']: "";
    ?>
    <div class="mo_boot_row mo_boot_p-3 mo_ldap_tab_background"> 
        <div class="mo_boot_col-sm-12"  id="mo_ldap_proxy_config">
            <div class="mo_boot_row mo_boot_mt-2">
                <div class="mo_boot_col-sm-7">
                    <input type="hidden" name="option1" />
                    <h3><?php echo JText::_('COM_MINIORANGE_CONFIGURE_PROXY'); ?></h3>
                </div>
				<div class="mo_boot_col-sm-2 mo_boot_mx-2">
				<form action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.moOAuthProxyConfigReset'); ?>" name="mo_ldap_proxy_form1" method="post">
                    <input type="button" value="<?php echo JText::_('COM_MINIORANGE_RESET'); ?>" onclick='submit();' class="mo_boot_btn mo_boot_btn-success" />
                </form>
				</div>
                <div class="mo_boot_col-sm-2 mo_boot_mx-4">
                    <input type="button" class="mo_boot_float-right mo_boot_btn mo_boot_btn-danger" value="<?php echo JText::_('COM_MINIORANGE_CANCEL'); ?>" onclick = "mo_oauth_hide_proxy_form();"/>
                </div>
            </div>
            <hr>

            <form  action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.moOAuthProxyServer'); ?>" name="proxy_form" method="post">
                <div class="mo_boot_row">
                    <div class="mo_boot_col-sm-12">  
                        <p><strong><?php echo JText::_('COM_MINIORANGE_PROXY_MESSAGE'); ?></strong></p>
                        <p><?php echo JText::_('COM_MINIORANGE_PROXY_DETAILS'); ?></p>
                    </div>
                </div>

                <div class="mo_boot_row" id="mo_ldap_proxy_host_name">
                    <div class="mo_boot_col-sm-3">
                        <strong><?php echo JText::_('COM_MINIORANGE_PROXY_HOSTNAME'); ?>:<span class="mo_ldap_highlight">*</span></strong>
                    </div>
                    <div class="mo_boot_col-sm-8">
                        <input type="text" name="proxy_server_url" placeholder="<?php echo JText::_('COM_MINIORANGE_PROXY_HOSTNAME_PLACEHOLDER');?>" class="mo_boot_form-control" value="<?php echo $proxy_server_url?>" required/>
                    </div>
                </div>

                <div class="mo_boot_row" id="mo_ldap_port_number">
                    <div class="mo_boot_col-sm-3"><br>
                        <strong><?php echo JText::_('COM_MINIORANGE_PROXY_PORT'); ?>:<span class="mo_ldap_highlight">*</span></strong>
                    </div>
                    <div class="mo_boot_col-sm-8"><br>
                        <input type="number" name="proxy_server_port" placeholder="<?php echo JText::_('COM_MINIORANGE_PROXY_PORT_PLACEHOLDER');?>" class="mo_boot_form-control" value="<?php echo $proxy_server_port ?>" required/>
                    </div>
                </div>

                <div class="mo_boot_row" id="mo_ldap_proxy_username">
                    <div class="mo_boot_col-sm-3"><br>
                        <strong><?php echo JText::_('COM_MINIORANGE_PROXY_USERNAME'); ?>:</strong>
                    </div>
                    <div class="mo_boot_col-sm-8"><br>
                        <input type="text" name="proxy_username" placeholder="<?php echo JText::_('COM_MINIORANGE_PROXY_USERNAME_PLACEHOLDER');?>" class="mo_boot_form-control " value="<?php echo $proxy_username ?>" />
                    </div>
                </div>

                <div class="mo_boot_row" id="mo_ldap_proxy_password">
                    <div class="mo_boot_col-sm-3"><br>
                        <strong><?php echo JText::_('COM_MINIORANGE_PROXY_PASSWORD'); ?>:</strong>
                    </div>
                    <div class="mo_boot_col-sm-8"><br>
                        <input type="password" name="proxy_password" placeholder="<?php echo JText::_('COM_MINIORANGE_PROXY_PASSWORD_PLACEHOLDER');?>" class="mo_boot_form-control" value="<?php echo $proxy_password ?>">
                    </div>
                </div>

                <div class="mo_boot_row mo_boot_text-center mo_boot_mt-3">
                    <div class="mo_boot_col-sm-12">
                        <input type="submit" style="width:100px;" value="<?php echo JText::_('COM_MINIORANGE_SAVE'); ?>" class="mo_boot_btn mo_boot_btn-success" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
}
function mo_oauth_account_page()
{
    global $license_tab_link;
    $result = MoOAuthUtility::getCustomerDetails();
    $email = $result['email'];
    $customer_key = $result['customer_key'];
    $api_key = $result['api_key'];
    $customer_token = $result['customer_token'];
    $pluginVersion = MoOAuthUtility::GetPluginVersion(); 
    $jVersion 			= new JVersion();
    $phpVersion 		= phpversion();
    $jCmsVersion 		= $jVersion->getShortVersion();
    if (!JPluginHelper::isEnabled('system', 'miniorangeoauth')) {

        ?>
        <div id="system-message-container">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <div class="alert alert-error">
                <h4 class="alert-heading">Warning!</h4>
                <div class="alert-message">
                    <h4>This component requires User and System Plugin to be activated. Please activate the following 2
                        plugins
                        to proceed further.</h4>
                    <li>System -miniOrange OAuth Client Verification</li>
                    </ul>
                    <h4>Steps to activate the plugins.</h4>
                    <ul>
                        <li>In the top menu, click on Extensions and select Plugins.</li>
                        <li>Search for miniOrange in the search box and press 'Search' to display the plugins.</li>
                        <li>Now enable both User and System plugin.</li>
                    </ul>
                </div>
                </h4>
            </div>
        </div>
    <?php }
    ?>
    <div class="mo_boot_row mo_boot_mx-1 mo_boot_my-3 tab_box_style" id="mo_oauth_registered_page">
        <div class="mo_boot_col-sm-12 mo_boot_mt-2">
            <p class="mo_oauth_welcome_message"><?php echo JText::_('COM_MINIORANGE_OAUTH_CONFIGURE_PROXY_SERVER');?><p><br>
            <h3><?php echo JText::_('COM_MINIORANGE_OAUTH_CUSTOMER_PROFILE');?></h3><br/>
        </div>
        <div class="mo_boot_col-sm-12  mo_boot_mt-2 mo_boot_table-responsive">
            <table class="mo_boot_table mo_boot_table-striped mo_boot_table-hover mo_boot_table-bordered">
                <tr>
                    <td><strong><?php echo JText::_('COM_MINIORANGE_OAUTH_CUSTOMER_USERNAME_EMAIL'); ?></strong></td>
                    <td><?php echo $email ?></td>
                </tr>
                <tr>
                    <td><strong><?php echo JText::_('COM_MINIORANGE_OAUTH_CUSTOMER_ID'); ?></strong></td>
                    <td><?php echo $customer_key ?></td>
                </tr>
                <tr>
                    <td><strong><?php echo JText::_('COM_MINIORANGE_OAUTH_PLUGIN_VERSION'); ?></strong></td>
                    <td><?php echo $pluginVersion ?></td>
                </tr>
                <tr>
                    <td><strong><?php echo JText::_('COM_MINIORANGE_OAUTH_PHP_VERSION'); ?></strong></td>
                    <td><?php echo $phpVersion ?></td>
                </tr>
                <tr>
                    <td><strong><?php echo JText::_('COM_MINIORANGE_OAUTH_JOOMLA_VERSION'); ?></strong></td>
                    <td><?php echo $jCmsVersion ?></td>
                </tr>
                
            </table>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_my-4 mo_boot_text-center">
            <form method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.removeAccount'); ?>">
                <input type="submit"  class="mo_boot_btn mo_boot_btn-danger mo_boot_my-3" value="<?php echo JText::_('COM_MINIORANGE_OAUTH_REMOVE_ACCOUNT');?>">
                <input id="proxy" type="button" class='mo_boot_btn mo_boot_btn-success' onclick='mo_oauth_show_proxy_form2()' value="<?php echo JText::_('COM_MINIORANGE_OAUTH_CONFIGURE_PROXY_SERVER');?>"/>
            </form>
        </div>
    </div>

    <div class="mo_boot_row" id="submit_proxy2" style="display:none">
        <div class="mo_boot_row mo_boot_mx-1 mo_boot_my-3 tab_box_style">    	
            <?php moOAuthProxySetup(); ?>
    	</div>
    </div> 
    <?php
}
function getAppJason(){
    return '{	
        "azure": {
            "label":"Azure AD", "type":"oauth", "image":"azure.png", "scope": "openid email profile", "authorize": "https://login.microsoftonline.com/{tenant}/oauth2/v2.0/authorize", "token": "https://login.microsoftonline.com/{tenant}/oauth2/v2.0/token", "userinfo":"https://graph.microsoft.com/beta/me", "guide":"https://plugins.miniorange.com/azure-ad-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-windowslive"
        },
        "azureb2c": {
            "label":"Azure B2C", "type":"openidconnect", "image":"azure.png", "scope": "openid email", "authorize": "https://{tenant}.b2clogin.com/{tenant}.onmicrosoft.com/{policy}/oauth2/v2.0/authorize", "token": "https://{tenant}.b2clogin.com/{tenant}.onmicrosoft.com/{policy}/oauth2/v2.0/token", "userinfo": "", "guide":"https://plugins.miniorange.com/azure-ad-b2c-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-windowslive"
        },
        "cognito": {
            "label":"AWS Cognito", "type":"oauth", "image":"cognito.png", "scope": "openid", "authorize": "https://{domain}/oauth2/authorize", "token": "https://{domain}/oauth2/token", "userinfo": "https://{domain}/oauth2/userInfo", "guide":"https://plugins.miniorange.com/aws-cognito-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-amazon"
        },
        "adfs": {
            "label":"ADFS", "type":"openidconnect", "image":"adfs.png", "scope": "openid", "authorize": "https://{domain}/adfs/oauth2/authorize/", "token": "https://{domain}/adfs/oauth2/token/", "userinfo": "", "guide":"", "logo_class":"fa fa-windowslive"
        },
        "whmcs": {
            "label":"WHMCS", "type":"oauth", "image":"whmcs.png", "scope": "openid profile email", "authorize": "https://{domain}/oauth/authorize.php", "token": "https://{domain}/oauth/token.php", "userinfo": "https://{domain}/oauth/userinfo.php?access_token=", "guide":"https://plugins.miniorange.com/whmcs-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "keycloak": {
            "label":"keycloak", "type":"openidconnect", "image":"keycloak.png", "scope": "openid", "authorize": "https://{domain}/realms/{realm}/protocol/openid-connect/auth", "token": "https://{domain}/realms/{realm}/protocol/openid-connect/token", "userinfo": "{domain}/realms/{realm}/protocol/openid-connect/userinfo", "guide":"https://plugins.miniorange.com/keycloak-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "slack": {
            "label":"Slack", "type":"oauth", "image":"slack.png", "scope": "users.profile:read", "authorize": "https://slack.com/oauth/authorize", "token": "https://slack.com/api/oauth.access", "userinfo": "https://slack.com/api/users.profile.get", "guide":"https://plugins.miniorange.com/slack-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-slack"
        },
        "discord": {
            "label":"Discord", "type":"oauth", "image":"discord.png", "scope": "identify email", "authorize": "https://discordapp.com/api/oauth2/authorize", "token": "https://discordapp.com/api/oauth2/token", "userinfo": "https://discordapp.com/api/users/@me", "guide":"https://plugins.miniorange.com/discord-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "invisioncommunity": {
            "label":"Invision Community", "type":"oauth", "image":"invis.png", "scope": "email", "authorize": "{domain}/oauth/authorize/", "token": "https://{domain}/oauth/token/", "userinfo": "https://{domain}/oauth/me", "guide":"https://plugins.miniorange.com/joomla-oauth-sign-on-sso-using-invision-community", "logo_class":"fa fa-lock"
        },
        "bitrix24": {
            "label":"Bitrix24", "type":"oauth", "image":"bitrix24.png", "scope": "user", "authorize": "https://{accountid}.bitrix24.com/oauth/authorize", "token": "https://{accountid}.bitrix24.com/oauth/token", "userinfo": "https://{accountid}.bitrix24.com/rest/user.current.json?auth=", "guide":"https://plugins.miniorange.com/bitrix24-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-clock-o"
        },
        "wso2": {
            "label":"WSO2", "type":"oauth", "image":"wso2.png", "scope": "openid", "authorize": "https://{domain}/wso2/oauth2/authorize", "token": "https://{domain}/wso2/oauth2/token", "userinfo": "https://{domain}/wso2/oauth2/userinfo", "guide":"https://plugins.miniorange.com/wso2-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "okta": {
            "label":"Okta", "type":"openidconnect", "image":"okta.png", "scope": "openid email profile", "authorize": "https://{domain}/oauth2/default/v1/authorize", "token": "https://{domain}/oauth2/default/v1/token", "userinfo": "", "guide":"https://plugins.miniorange.com/login-with-okta-using-joomla", "logo_class":"fa fa-lock"
        },
        "onelogin": {
            "label":"OneLogin", "type":"openidconnect", "image":"onelogin.png", "scope": "openid", "authorize": "https://{domain}/oidc/auth", "token": "https://{domain}/oidc/token", "userinfo": "", "guide":"https://plugins.miniorange.com/onelogin-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "gapps": {
            "label":"Google", "type":"oauth", "image":"google.png", "scope": "email", "authorize": "https://accounts.google.com/o/oauth2/auth", "token": "https://www.googleapis.com/oauth2/v4/token", "userinfo": "https://www.googleapis.com/oauth2/v1/userinfo", "guide":"https://plugins.miniorange.com/google-apps-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-google-plus"
        },
        "fbapps": {
            "label":"Facebook", "type":"oauth", "image":"facebook.png", "scope": "public_profile email", "authorize": "https://www.facebook.com/dialog/oauth", "token": "https://graph.facebook.com/v2.8/oauth/access_token", "userinfo": "https://graph.facebook.com/me/?fields=id,name,email,age_range,first_name,gender,last_name,link", "guide":"https://plugins.miniorange.com/facebook-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-facebook"
        },
        "gluu": {
            "label":"Gluu Server", "type":"oauth", "image":"gluu.png", "scope": "openid", "authorize": "http://{domain}/oxauth/restv1/authorize", "token": "http://{domain}/oxauth/restv1/token", "userinfo": "http:///{domain}/oxauth/restv1/userinfo", "guide":"https://plugins.miniorange.com/gluu-server-single-sign-on-sso-joomla-login-using-gluu", "logo_class":"fa fa-lock"
        },
        "linkedin": {
            "label":"LinkedIn", "type":"oauth", "image":"linkedin.png", "scope": "r_liteprofile w_member_social r_emailaddress", "authorize": "https://www.linkedin.com/oauth/v2/authorization", "token": "https://www.linkedin.com/oauth/v2/accessToken", "userinfo": "https://api.linkedin.com/v2/me", "guide":"https://plugins.miniorange.com/linkedin-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-linkedin-square"
        },
        "strava": {
            "label":"Strava", "type":"oauth", "image":"strava.png", "scope": "public", "authorize": "https://www.strava.com/oauth/authorize", "token": "https://www.strava.com/oauth/token", "userinfo": "https://www.strava.com/api/v3/athlete", "guide":"https://plugins.miniorange.com/strava-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "fitbit": {
            "label":"FitBit", "type":"oauth", "image":"fitbit.png", "scope": "profile", "authorize": "https://www.fitbit.com/oauth2/authorize", "token": "https://api.fitbit.com/oauth2/token", "userinfo": "https://www.fitbit.com/1/user", "guide":"https://plugins.miniorange.com/fitbit-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "box": {
            "label":"Box", "type":"oauth", "image":"box.png", "scope": "root_readwrite", "authorize": "https://account.box.com/api/oauth2/authorize", "token": "https://api.box.com/oauth2/token", "userinfo": "https://api.box.com/2.0/users/me", "guide":"https://plugins.miniorange.com/box-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "github": {
            "label":"GitHub", "type":"oauth", "image":"github.png", "scope": "user repo", "authorize": "https://github.com/login/oauth/authorize", "token": "https://github.com/login/oauth/access_token", "userinfo": "https://api.github.com/user", "guide":"https://plugins.miniorange.com/github-single-sign-on-sso-joomla-oauth-openid-connect", "logo_class":"fa fa-github"
        },
        "gitlab": {
            "label":"GitLab", "type":"oauth", "image":"gitlab.png", "scope": "read_user", "authorize": "https://gitlab.com/oauth/authorize", "token": "http://gitlab.com/oauth/token", "userinfo": "https://gitlab.com/api/v4/user", "guide":"https://plugins.miniorange.com/gitlab-single-sign-on-sso-joomla-oauth-openid-connect", "logo_class":"fa fa-gitlab"
        },
        "clever": {
            "label":"Clever", "type":"oauth", "image":"clever.png", "scope": "read:students read:teachers read:user_id", "authorize": "https://clever.com/oauth/authorize", "token": "https://clever.com/oauth/tokens", "userinfo": "https://api.clever.com/v1.1/me", "guide":"https://plugins.miniorange.com/clever-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "salesforce": {
            "label":"Salesforce", "type":"oauth", "image":"salesforce.png", "scope": "email", "authorize": "https://login.salesforce.com/services/oauth2/authorize", "token": "https://login.salesforce.com/services/oauth2/token", "userinfo": "https://login.salesforce.com/services/oauth2/userinfo", "guide":"https://plugins.miniorange.com/salesforce-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "reddit": {
            "label":"Reddit", "type":"oauth", "image":"reddit.png", "scope": "identity", "authorize": "https://www.reddit.com/api/v1/authorize", "token": "https://www.reddit.com/api/v1/access_token", "userinfo": "https://www.reddit.com/api/v1/me", "guide":"https://plugins.miniorange.com/reddit-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-reddit"
        },
        "paypal": {
            "label":"PayPal", "type":"openidconnect", "image":"paypal.png", "scope": "openid", "authorize": "https://www.paypal.com/signin/authorize", "token": "https://api.paypal.com/v1/oauth2/token", "userinfo": "", "guide":"https://plugins.miniorange.com/paypal-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-paypal"
        },
        "swiss-rx-login": {
            "label":"Swiss RX Login", "type":"openidconnect", "image":"swiss-rx-login.png", "scope": "anonymous", "authorize": "https://www.swiss-rx-login.ch/oauth/authorize", "token": "https://swiss-rx-login.ch/oauth/token", "userinfo": "", "guide":"", "logo_class":"fa fa-lock"
        },
        "yahoo": {
            "label":"Yahoo", "type":"openidconnect", "image":"yahoo.png", "scope": "openid", "authorize": "https://api.login.yahoo.com/oauth2/request_auth", "token": "https://api.login.yahoo.com/oauth2/get_token", "userinfo": "", "guide":"https://plugins.miniorange.com/yahoo-single-sign-on-sso-joomla-oauth-openid-connect", "logo_class":"fa fa-yahoo"
        },
        "spotify": {
            "label":"Spotify", "type":"oauth", "image":"spotify.png", "scope": "user-read-private user-read-email", "authorize": "https://accounts.spotify.com/authorize", "token": "https://accounts.spotify.com/api/token", "userinfo": "https://api.spotify.com/v1/me", "guide":"https://plugins.miniorange.com/spotify-single-sign-on-sso-joomla-oauth-openid-connect", "logo_class":"fa fa-spotify"
        },
        "eveonlinenew": {
            "label":"Eve Online", "type":"oauth", "image":"eveonline.png", "scope": "publicData", "authorize": "https://login.eveonline.com/oauth/authorize", "token": "https://login.eveonline.com/oauth/token", "userinfo": "https://esi.evetech.net/verify", "guide":"https://plugins.miniorange.com/oauth-openid-connect-single-sign-on-sso-into-joomla-using-eve-online", "logo_class":"fa fa-lock"
        },
        "vkontakte": {
            "label":"VKontakte", "type":"oauth", "image":"vk.png", "scope": "openid", "authorize": "https://oauth.vk.com/authorize", "token": "https://oauth.vk.com/access_token", "userinfo": "https://api.vk.com/method/users.get?fields=id,name,email,age_range,first_name,gender,last_name,link&access_token=", "guide":"https://plugins.miniorange.com/vkontakte-single-sign-on-sso-joomla-oauth-openid-connect", "logo_class":"fa fa-vk"
        },
        "pinterest": {
            "label":"Pinterest", "type":"oauth", "image":"pinterest.png", "scope": "read_public", "authorize": "https://api.pinterest.com/oauth/", "token": "https://api.pinterest.com/v1/oauth/token", "userinfo": "https://api.pinterest.com/v1/me/", "guide":"https://plugins.miniorange.com/pinterest-single-sign-on-sso-joomla-oauth-openid-connect", "logo_class":"fa fa-pinterest"
        },
        "vimeo": {
            "label":"Vimeo", "type":"oauth", "image":"vimeo.png", "scope": "public", "authorize": "https://api.vimeo.com/oauth/authorize", "token": "https://api.vimeo.com/oauth/access_token", "userinfo": "https://api.vimeo.com/me", "guide":"https://plugins.miniorange.com/vimeo-single-sign-on-sso-joomla-oauth-openid-connect", "logo_class":"fa fa-vimeo"
        },
        "deviantart": {
            "label":"DeviantArt", "type":"oauth", "image":"devart.png", "scope": "browse", "authorize": "https://www.deviantart.com/oauth2/authorize", "token": "https://www.deviantart.com/oauth2/token", "userinfo": "https://www.deviantart.com/api/v1/oauth2/user/profile", "guide":"https://plugins.miniorange.com/deviantart-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-deviantart"
        },
        "dailymotion": {
            "label":"Dailymotion", "type":"oauth", "image":"dailymotion.png", "scope": "email", "authorize": "https://www.dailymotion.com/oauth/authorize", "token": "https://api.dailymotion.com/oauth/token", "userinfo": "https://api.dailymotion.com/user/me?fields=id,username,email,first_name,last_name", "guide":"https://plugins.miniorange.com/dailymotion-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "meetup": {
            "label":"Meetup", "type":"oauth", "image":"meetup.png", "scope": "basic", "authorize": "https://secure.meetup.com/oauth2/authorize", "token": "https://secure.meetup.com/oauth2/access", "userinfo": "https://api.meetup.com/members/self", "guide":"", "logo_class":"fa fa-lock"
        },
        "autodesk": {
            "label":"Autodesk", "type":"oauth", "image":"autodesk.png", "scope": "user:read user-profile:read", "authorize": "https://developer.api.autodesk.com/authentication/v1/authorize", "token": "https://developer.api.autodesk.com/authentication/v1/gettoken", "userinfo": "https://developer.api.autodesk.com/userprofile/v1/users/@me", "guide":"https://plugins.miniorange.com/autodesk-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "zendesk": {
            "label":"Zendesk", "type":"oauth", "image":"zendesk.png", "scope": "read write", "authorize": "https://{domain}/oauth/authorizations/new", "token": "https://{domain}/oauth/tokens", "userinfo": "https://{domain}/api/v2/users", "guide":"https://plugins.miniorange.com/login-with-zendesk-as-an-oauth-openid-connect-server", "logo_class":"fa fa-lock"
        },
        "laravel": {
            "label":"Laravel", "type":"oauth", "image":"laravel.png", "scope": "", "authorize": "http://{domain}/oauth/authorize", "token": "http://{domain}/oauth/token", "userinfo": "http://{domain}}/api/user/get", "guide":"https://plugins.miniorange.com/login-with-joomla-oauth-sign-on-sso-using-laravel-passport", "logo_class":"fa fa-lock"
        },
        "identityserver": {
            "label":"Identity Server", "type":"oauth", "image":"identityserver.png", "scope": "openid", "authorize": "https://{domain}/connect/authorize", "token": "https://{domain}/connect/token", "userinfo": "https://{domain}/connect/introspect", "guide":"https://plugins.miniorange.com/identityserver3-oauth-openid-connect-single-sign-on-sso-into-joomla-identityserver3-sso-login", "logo_class":"fa fa-lock"
        },
        "nextcloud": {
            "label":"Nextcloud", "type":"oauth", "image":"nextcloud.png", "scope": "user:read:email", "authorize": "https://{domain}/index.php/apps/oauth2/authorize", "token": "https://{domain}/index.php/apps/oauth2/api/v1/token", "userinfo": "https://{domain}/ocs/v2.php/cloud/user?format=json", "guide":"https://plugins.miniorange.com/joomla-oauth-sign-on-sso-using-nextcloud", "logo_class":"fa fa-lock"
        },
        "twitch": {
            "label":"Twitch", "type":"oauth", "image":"twitch.png", "scope": "Analytics:read:extensions", "authorize": "https://id.twitch.tv/oauth2/authorize", "token": "https://id.twitch.tv/oauth2/token", "userinfo": "https://id.twitch.tv/oauth2/userinfo", "guide":"https://plugins.miniorange.com/twitch-single-sign-on-sso-joomla-oauth-openid-connect", "logo_class":"fa fa-lock"
        },
        "wildApricot": {
            "label":"Wild Apricot", "type":"oauth", "image":"wildApricot.png", "scope": "auto", "authorize": "https://{domain}/sys/login/OAuthLogin", "token": "https://oauth.wildapricot.org/auth/token", "userinfo": "https://api.wildapricot.org/v2.1/accounts/{accountid}/contacts/me", "guide":"https://plugins.miniorange.com/wildapricot-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "connect2id": {
            "label":"Connect2id", "type":"oauth", "image":"connect2id.png", "scope": "openid", "authorize": "https://c2id.com/login", "token": "https://{domain}/token", "userinfo": "https://{domain}/userinfo", "guide":"https://plugins.miniorange.com/connect2id-single-sign-on-sso-joomla-oauth-openid-connect", "logo_class":"fa fa-lock"
        },
        "miniorange": {
            "label":"miniOrange", "type":"oauth", "image":"miniorange.png", "scope": "openid", "authorize": "https://login.xecurify.com/moas/idp/openidsso", "token": "https://login.xecurify.com/moas/rest/oauth/token", "userinfo": "https://logins.xecurify.com/moas/rest/oauth/getuserinfo", "guide":"https://plugins.miniorange.com/miniorange-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "orcid": {
            "label":"ORCID", "type":"openidconnect", "image":"orcid.png", "scope": "openid", "authorize": "https://orcid.org/oauth/authorize", "token": "https://orcid.org/oauth/token", "userinfo": "", "guide":"https://plugins.miniorange.com/orcid-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "diaspora": {
            "label":"Diaspora", "type":"openidconnect", "image":"diaspora.png", "scope": "openid", "authorize": "https://{domain}/api/openid_connect/authorizations/new", "token": "https://{domain}/api/openid_connect/access_tokens", "userinfo": "", "guide":"", "logo_class":"fa fa-lock"
        },
        "timezynk": {
            "label":"Timezynk", "type":"oauth", "image":"timezynk.png", "scope": "read:user", "authorize": "https://api.timezynk.com/api/oauth2/v1/auth", "token": "https://api.timezynk.com/api/oauth2/v1/token", "userinfo": "https://api.timezynk.com/api/oauth2/v1/userinfo", "guide":"", "logo_class":"fa fa-lock"
        },
        "Amazon": {
            "label":"Amazon", "type":"oauth", "image":"cognito.png", "scope": "profile", "authorize": "https://www.amazon.com/ap/oa", "token": "https://api.amazon.com/auth/o2/token", "userinfo": "https://api.amazon.com/user/profile", "guide":"https://plugins.miniorange.com/amazon-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "Office 365": {
            "label":"Office 365", "type":"oauth", "image":"microsoft.webp", "scope": "openid email profile", "authorize": "https://login.microsoftonline.com/{tenant}/oauth2/v2.0/authorize", "token": "https://login.microsoftonline.com/{tenant}/oauth2/v2.0/token", "userinfo": "https://graph.microsoft.com/beta/me", "guide":"https://plugins.miniorange.com/joomla-oauth-single-sign-on-sso-using-office365", "logo_class":"fa fa-lock"
        },
        "Instagram": {
            "label":"Instagram", "type":"oauth", "image":"instagram.png", "scope": "user_profile user_media", "authorize": "https://api.instagram.com/oauth/authorize", "token": "https://api.instagram.com/oauth/access_token", "userinfo": "https://graph.instagram.com/me?fields=id,username&access_token=", "guide":"https://plugins.miniorange.com/instagram-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "Line": {
            "label":"Line", "type":"oauth", "image":"line.webp", "scope": "profile openid email", "authorize": "https://access.line.me/oauth2/v2.1/authorize", "token": "https://api.line.me/oauth2/v2.1/token", "userinfo": "https://api.line.me/v2/profile", "guide":"https://plugins.miniorange.com/line-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "PingFederate": {
            "label":"PingFederate", "type":"oauth", "image":"ping.webp", "scope": "openid", "authorize": "https://{domain}/as/authorization.oauth2", "token": "https://{domain}/as/token.oauth2", "userinfo": "https://{domain}/idp/userinfo.oauth2", "guide":"https://plugins.miniorange.com/ping-federate-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "OpenAthens": {
            "label":"OpenAthens", "type":"oauth", "image":"openathens.webp", "scope": "openid", "authorize": "https://sp.openathens.net/oauth2/authorize", "token": "https://sp.openathens.net/oauth2/token", "userinfo": "https://sp.openathens.net/oauth2/userInfo", "guide":"https://plugins.miniorange.com/openathens-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "Intuit": {
            "label":"Intuit", "type":"oauth", "image":"intuit.webp", "scope": "openid email profile", "authorize": "https://appcenter.intuit.com/connect/oauth2", "token": "https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer", "userinfo": "https://accounts.platform.intuit.com/v1/openid_connect/userinfo", "guide":"https://plugins.miniorange.com/oauth-openid-connect-single-sign-on-sso-into-joomla-using-intuit", "logo_class":"fa fa-lock"
        },
        "Twitter": {
            "label":"Twitter", "type":"oauth", "image":"twitter-logo.webp", "scope": "email", "authorize": "https://api.twitter.com/oauth/authorize", "token": "https://api.twitter.com/oauth2/token", "userinfo": "https://api.twitter.com/1.1/users/show.json?screen_name=here-comes-twitter-screen-name", "guide":"https://plugins.miniorange.com/twitter-sso-single-sign-on-joomla-using-oauth-client-openid-connect", "logo_class":"fa fa-lock"
        },
        "WordPress": {
            "label":"WordPress", "type":"oauth", "image":"intuit.webp", "scope": "profile openid email custom", "authorize": "http://{site_base_url}/wp-json/moserver/authorize", "token": "http://{site_base_url}/wp-json/moserver/token", "userinfo": "http://{site_base_url}/wp-json/moserver/resource", "guide":"https://plugins.miniorange.com/oauth-openid-connect-single-sign-on-sso-into-joomla-using-wordpress", "logo_class":"fa fa-lock"
        },
        "Subscribestar": {
            "label":"Subscribestar", "type":"oauth", "image":"Subscriberstar-logo.png", "scope": "user.read user.email.read", "authorize": "https://www.subscribestar.com/oauth2/authorize", "token": "https://www.subscribestar.com/oauth2/token", "userinfo": "https://www.subscribestar.com/api/graphql/v1?query={user{name,email}}", "guide":"https://plugins.miniorange.com/subscribestar-oauth-openid-connect-single-sign-on-sso-into-joomla-subscribestar-sso-login", "logo_class":"fa fa-lock"
        },
        "Classlink": {
            "label":"Classlink", "type":"oauth", "image":"classlink.webp", "scope": "email profile oneroster full", "authorize": "https://launchpad.classlink.com/oauth2/v2/auth", "token": "https://launchpad.classlink.com/oauth2/v2/token", "userinfo": "https://nodeapi.classlink.com/v2/my/info", "guide":"https://plugins.miniorange.com/classlink-oauth-sso-openid-connect-single-sign-on-in-joomla-classlink-sso-login", "logo_class":"fa fa-lock"
        },
        "HP": {
            "label":"HP", "type":"oauth", "image":"hp-logo.webp", "scope": "read", "authorize": "https://{hp_domain}/v1/oauth/authorize", "token": "https://{hp_domain}/v1/oauth/token", "userinfo": "https://{hp_domain}/v1/userinfo", "guide":"https://plugins.miniorange.com/hp-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
        },
        "Basecamp": {
            "label":"Basecamp", "type":"oauth", "image":"basecamp-logo.webp", "scope": "openid", "authorize": "https://launchpad.37signals.com/authorization/new?type=web_server", "token": "https://launchpad.37signals.com/authorization/token?type=web_server", "userinfo": "https://launchpad.37signals.com/authorization.json", "guide":"https://plugins.miniorange.com/basecamp-oauth-and-openid-connect-single-sign-on-sso-login", "logo_class":"fa fa-lock"
        },
        "Feide": {
            "label":"Feide", "type":"oauth", "image":"feide-logo.webp", "scope": "openid", "authorize": "https://auth.dataporten.no/oauth/authorization", "token": "https://auth.dataporten.no/oauth/token", "userinfo": "https://auth.dataporten.no/openid/userinfo", "guide":"https://plugins.miniorange.com/feide-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
        },
        "Freja EID": {
            "label":"Freja EID", "type":"openidconnect", "image":"frejaeid-logo.webp", "scope": "openid profile email", "authorize": "https://oidc.prod.frejaeid.com/oidc/authorize", "token": "https://oidc.prod.frejaeid.com/oidc/token", "userinfo": "", "guide":"https://plugins.miniorange.com/freja-eid-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
        },
        "ServiceNow": {
            "label":"ServiceNow", "type":"oauth", "image":"servicenow-logo.webp", "scope": "email profile", "authorize": "https://{your-servicenow-domain}/oauth_auth.do", "token": "https://{your-servicenow-domain}/oauth_token.do", "userinfo": "https://{your-servicenow-domain}/{base-api-path}?access_token=", "guide":"https://plugins.miniorange.com/servicenow-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
        },
        "IMIS": {
            "label":"IMIS", "type":"oauth", "image":"imis-logo.webp", "scope": "openid", "authorize": "https://{your-imis-domain}/sso-pages/Aurora-SSO-Redirect.aspx", "token": "https://{your-imis-domain}/token", "userinfo": "https://{your-imis-domain}/api/iqa?queryname=$/Bearer_Info_Aurora", "guide":"https://plugins.miniorange.com/imis-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
        },
        "OpenedX": {
            "label":"OpenedX", "type":"oauth", "image":"openedx-logo.webp", "scope": "email profile", "authorize": "https://{your-domain}/oauth2/authorize", "token": "https://{your-domain}/oauth2/access_token", "userinfo": "https://{your-domain}/api/mobile/v1/my_user_info", "guide":"https://plugins.miniorange.com/open-edx-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
        },
        "Elvanto": {
            "label":"Elvanto", "type":"openidconnect", "image":"elvanto-logo.webp", "scope": "ManagePeople", "authorize": "https://api.elvanto.com/oauth?", "token": "https://api.elvanto.com/oauth/token", "userinfo": "", "guide":"https://plugins.miniorange.com/elvanto-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
        },
        "DigitalOcean": {
            "label":"DigitalOcean", "type":"oauth", "image":"digitalocean-logo.webp", "scope": "read", "authorize": "https://cloud.digitalocean.com/v1/oauth/authorize", "token": "https://cloud.digitalocean.com/v1/oauth/token", "userinfo": "https://api.digitalocean.com/v2/account", "guide":"https://plugins.miniorange.com/digital-ocean-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
        },
        "UNA": {
            "label":"UNA", "type":"openidconnect", "image":"una-logo.webp", "scope": "basic", "authorize": "https://{site-url}.una.io/oauth2/authorize?", "token": "https://{site-url}.una.io/oauth2/access_token", "userinfo": "", "guide":"https://plugins.miniorange.com/una-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
        },
        "MemberClicks": {
			"label":"MemberClicks", "type":"oauth", "image":"memberclicks-logo.webp", "scope": "read write", "authorize": "https://{orgId}.memberclicks.net/oauth/v1/authorize", "token": "https://{orgId}.memberclicks.net/oauth/v1/token", "userinfo": "https://{orgId}.memberclicks.net/api/v1/profile/me", "guide":"https://plugins.miniorange.com/memberclicks-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
		},
		"MineCraft": {
			"label":"MineCraft", "type":"openidconnect", "image":"minecraft-logo.webp", "scope": "openid", "authorize": "https://login.live.com/oauth20_authorize.srf", "token": "https://login.live.com/oauth20_token.srf", "userinfo": "", "guide":"https://plugins.miniorange.com/minecraft-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
		},
		"Neon CRM": {
			"label":"Neon CRM", "type":"oauth", "image":"neon-logo.webp", "scope": "openid", "authorize": "https://{your Neon CRM organization id}.z2systems.com/np/oauth/auth", "token": "https://{your Neon CRM organization id}.z2systems.com/np/oauth/token", "userinfo": "https://api.neoncrm.com/neonws/services/api/account/retrieveIndividualAccount?accountId=", "guide":"https://plugins.miniorange.com/neoncrm-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
		},
		"Canvas": {
			"label":"Canvas", "type":"oauth", "image":"canvas-logo.webp", "scope": "openid profile", "authorize": "https://{your-site-url}/login/oauth2/auth", "token": "https://{your-site-url}/login/oauth2/token", "userinfo": "https://{your-site-url}/login/v2.1/users/self", "guide":"https://plugins.miniorange.com/canvas-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
		},
		"Ticketmaster": {
			"label":"Ticketmaster", "type":"openidconnect", "image":"ticketmaster-logo.webp", "scope": "openid email", "authorize": "https://auth.ticketmaster.com/as/authorization.oauth2", "token": "https://auth.ticketmaster.com/as/token.oauth2", "userinfo": "", "guide":"https://plugins.miniorange.com/ticketmaster-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
		},
		"Mindbody": {
			"label":"Mindbody", "type":"openidconnect", "image":"mindbody-logo.webp", "scope": "email profile openid", "authorize": "https://signin.mindbodyonline.com/connect/authorize", "token": "https://signin.mindbodyonline.com/connect/token", "userinfo": "", "guide":"https://plugins.miniorange.com/mindbody-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
		},
		"iGov": {
			"label":"iGov", "type":"openidconnect", "image":"iGov-logo.webp", "scope": "openid profile", "authorize": "https://idp.government.gov/oidc/authorization", "token": "https://idp.government.gov/token", "userinfo": "", "guide":"https://plugins.miniorange.com/igov-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
		},
		"LearnWorlds": {
			"label":"LearnWorlds", "type":"openidconnect", "image":"learnworlds-logo.webp", "scope": "openid profile", "authorize": "https://api.learnworlds.com/oauth", "token": "https://api.learnworlds.com/oauth2/access_token", "userinfo": "", "guide":"https://plugins.miniorange.com/learnworlds-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
		},
		"Otoy": {
			"label":"Otoy", "type":"oauth", "image":"otoy-logo.webp", "scope": "openid", "authorize": "https://account.otoy.com/oauth/authorize", "token": "https://account.otoy.com/oauth/token", "userinfo": "https://account.otoy.com/api/v1/user.json", "guide":"https://plugins.miniorange.com/otoy-sso-single-sign-on-into-joomla-using-oauth-openid-connect", "logo_class":"fa fa-lock"
		},
        "other": {
            "label":"Custom OAuth", "type":"oauth", "image":"customapp.png", "scope": "", "authorize": "", "token": "", "userinfo": "", "guide":"", "logo_class":"fa fa-lock"
        },
        "openidconnect": {
            "label":"Custom OpenID Connect App", "type":"openidconnect", "image":"customapp.png", "scope": "", "authorize": "", "token": "", "userinfo": "", "guide":"", "logo_class":"fa fa-lock"
        }
    }';
}

function getAppData()
{
    return '{
        "azure": {
            "0":"both","1":"Tenant"
        },
        "azureb2c": {
            "0":"both","1":"Tenant,Policy"
        },
        "cognito": {
            "0":"both","1": "Domain"
        },
        "adfs": {
            "0":"both","1":"Domain"
        },
        "whmcs": {
            "0":"both","1":"Domain"
        },
        "keycloak": {
            "0":"both","1":"Domain,Realm"
        },
        "invisioncommunity": {
            "0":"both","1":"Domain"
        },
        "bitrix24": {
            "0":"both","1":"Domain"
        },
        "wso2": {
            "0":"both","1":"Domain"
        },
        "okta": {
            "0":"header","1":"Domain"
        },
        "onelogin": {
            "0":"both","1":"Domain"
        },
        "gluu": {
            "0":"both","1": "Domain" 
        },
        "zendesk": {
            "0":"both","1":"Domain"
        },
        "laravel": {
            "0":"both","1":"Domain"
        },
        "identityserver": {
            "0":"both","1":"Domain"
        },
        "nextcloud": {
            "0":"both","1":"Domain"
        },
        "wildApricot": {
            "0":"both","1":"Domain,AccountId"
        },
        "connect2id": {
            "0":"both","1":"Domain"
        },
        "diaspora": {
            "0":"both","1":"Domain" 
        },
        "Office 365": {
            "0":"both","1":"Tenant" 
        },
        "PingFederate": {
            "0":"both","1":"Domain"
        },
        "HP": {
            "0":"both","1":"Domain"
        },
        "Neon CRM": {
            "0":"both","1":"Domain"
        },
        "Canvas": {
            "0":"both","1":"Domain"
        },
        "UNA": {
            "0":"both","1":"Domain"
        },
        "OpenedX": {
            "0":"both","1":"Domain"
        },
        "ServiceNow": {
            "0":"both","1":"Domain"
        },
        "WordPress": {
            "0":"both","1":"Domain"
        },
        "MemberClicks": {
            "0":"both","1":"Domain"
        },
        "IMIS": {
            "0":"both","1":"Domain"
        }

        
    }';
}
function selectAppByIcon()
{
    global $license_tab_link;
    $appArray = json_decode(getAppJason(),TRUE);

    $app = JFactory::getApplication();
    $get = $app->input->get->getArray();
    $attribute = getAppDetails();
    $isAppConfigured = empty($attribute['client_secret']) || empty($attribute['client_id']) || empty($attribute['custom_app'])?FALSE:TRUE;
    if( isset($get['moAuthAddApp']) && !empty($get['moAuthAddApp']) )
    {
        configuration($appArray[$get['moAuthAddApp']],$get['moAuthAddApp']);
        return;
    }
    if($isAppConfigured)
    {
        configuration($appArray[$attribute['appname']],$attribute['appname']);
        return;
    }
    $ImagePath=JURI::base().'components/com_miniorange_oauth/assets/images/';
    $imageTableHtml = "<table id='moAuthAppsTable'>";
    $i=1;
    $PreConfiguredApps = array_slice($appArray,0,count($appArray)-2);
    foreach ($PreConfiguredApps as $key => $value) {
        $img=$ImagePath.$value['image'];
        if($i%6==1){
            $imageTableHtml.='<tr>';
        }
        $imageTableHtml=$imageTableHtml."<td moAuthAppSelector='".$value['label']."'><a href='".JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&moAuthAddApp='.$key)."''><img style='max-height:60px;max-width:60px;' src='".$img."'><br><p>".$value['label']."</p></a></td>";
        if($i%6==0 || $i==count($appArray)){
            $imageTableHtml.='</tr>';
        }
        $i++;
    }
    $imageTableHtml.='</table>';
    ?> 
    <div class="mo_boot_row mo_boot_m-1 mo_boot_my-3 tab_box_style">
        <div class="mo_boot_col-sm-12 mo_boot_mt-4">
            <input type="text" style="width:100%;margin:0;height:38px;" name="appsearch" id="moAuthAppsearchInput" value="" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_SELECT_APP');?>">
            <hr> 
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_my-2">
            <h6><?php echo JText::_('COM_MINIORANGE_OAUTH_CUSTOM_APPLICATIONS');?> <span class="mo_boot_p-1 mo_boot_text-dark" style="background:#FFCCCB"><?php echo JText::_('COM_MINIORANGE_OAUTH_CUSTOM_APPLICATIONS_NOTE');?></span>
            </h6>
        </div>
        <div class="mo_boot_col-sm-6  mo_boot_my-2 mo_boot_text-center" moAuthAppSelector='moCustomOuth2App'>
            <div class=" mo_boot_border" style="background:#f6f6f6;border: 1px solid #ddd;">
                <a href="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&moAuthAddApp=other');?>"><img style='max-height:60px;max-width:60px;' alt="" src="<?php echo  $ImagePath.$appArray['other']['image']; ?>"><br><p><?php echo $appArray['other']['label'];?></p></a>
            </div>
        </div>
        <div class="mo_boot_col-sm-6  mo_boot_my-2 mo_boot_text-center"  moAuthAppSelector='moCustomOpenIdConnectApp'>
            <div class=" mo_boot_border" style="background:#f6f6f6;border: 1px solid #ddd;">
                <a href="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&moAuthAddApp=openidconnect');?>"><img style='max-height:60px;max-width:60px;' alt="" src="<?php echo  $ImagePath.$appArray['openidconnect']['image']; ?>"><br><p><?php echo $appArray['openidconnect']['label'];?></p></a>
            </div>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-2">
            <h6><?php echo JText::_('COM_MINIORANGE_OAUTH_PRE_CONFIGURED_APPLICATIONS');?>
                <div class="moAuthtooltip">
                    &ensp;
                    <img src="<?php echo  $ImagePath.'icon3.png'; ?>" alt="" style="height:18px;">
                    <span class="moAuthtooltiptext"><?php echo JText::_('COM_MINIORANGE_OAUTH_PRE_CONFIGURED_APPLICATIONS_NOTE');?></span>
                </div> 
            </h6>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-2">
            <?php
                echo $imageTableHtml;
            ?>
        </div>
        
    </div>
    <?php
}
function getAppDetails(){
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__miniorange_oauth_config'));
    $query->where($db->quoteName('id') . " = 1");
    $db->setQuery($query);
    return $db->loadAssoc();
}
function configuration($OauthApp,$appLabel)
{
    global $license_tab_link;
    $attribute = getAppDetails();
    $appJson = json_decode(getAppJason(),true);

    $appData = json_decode(getAppData(),true);
    if($appJson[$appLabel]["guide"]!="")
    {
        $guide=$appJson[$appLabel]["guide"];
    }
    else
    {
        $guide="https://plugins.miniorange.com/guide-to-enable-joomla-oauth-client";
    }
    $mo_oauth_app = $appLabel;
    $custom_app = "";
    $client_id = "";
    $client_secret = "";
    $redirecturi = JURI::root();
    $email_attr = "";
    $first_name_attr = "";
    $isAppConfigured = FALSE;
    $mo_oauth_in_header = "checked=true";
    $mo_oauth_in_body   = "";
    $login_link_check="1";

    if(isset($attribute['in_header_or_body']))
    {
        if( $attribute['in_header_or_body']=='inBody' ){
            $mo_oauth_in_header = "";
            $mo_oauth_in_body   = "checked=true";
        }
        else if($attribute['in_header_or_body']=='inHeader' ){
            $mo_oauth_in_header = "checked=true";
            $mo_oauth_in_body   = "";
        }
        else if( $attribute['in_header_or_body']=='both' ){
            $mo_oauth_in_header = "checked=true";
            $mo_oauth_in_body   = "checked=true";
        }
    }
    else
    {
        if( isset($appData[$appLabel]) && $appData[$appLabel][0]=='both' ){
            $mo_oauth_in_header = "checked=true";
            $mo_oauth_in_body   = "checked=true";
        }
        else if(isset($appData['appLabel']) && $appData['appLabel'][0]=='inBody' ){
            $mo_oauth_in_header = "";
            $mo_oauth_in_body   = "checked=true";
        }
        else if(isset($appData['appLabel']) && $appData['appLabel'][0]=='inHeader' )
        {
            $mo_oauth_in_header = "checked=true";
            $mo_oauth_in_body   = "";
        }
    }
    

    if (isset($attribute['client_id'])) {
        $mo_oauth_app = empty($attribute['appname'])?$appLabel:$attribute['appname'];
        $custom_app = $attribute['custom_app'];
        $client_id = $attribute['client_id'];
        $client_secret = $attribute['client_secret'];
        $isAppConfigured = empty($client_id) || empty($client_secret) || empty($custom_app)?FALSE:TRUE;
        $app_scope = empty($attribute['app_scope'])?$OauthApp['scope']:$attribute['app_scope'];
        $authorize_endpoint = empty($attribute['authorize_endpoint'])?NULL:$attribute['authorize_endpoint'];
        $access_token_endpoint = empty($attribute['access_token_endpoint'])?NULL:$attribute['access_token_endpoint'];
        $user_info_endpoint = empty($attribute['user_info_endpoint'])?NULL:$attribute['user_info_endpoint'];
        $email_attr = $attribute['email_attr'];
        $first_name_attr = $attribute['first_name_attr'];
        $attributesNames = $attribute['test_attribute_name'];
        $attributesNames = explode(",",$attributesNames);
    }
    ?>

    

    <div class="mo_boot_row"> 
        <div class="mo_boot_col-sm-8">
            <div class="mo_boot_row mo_boot_m-1 mo_boot_my-3 tab_box_style">
                <div class="mo_boot_col-sm-12">
                    <div class="mo_boot_row">
                        <div class="mo_boot_col-sm-7 mo_boot_mt-4">
                            <h3 style="display:inline-block;"><?php echo JText::_('COM_MINIORANGE_OAUTH_APP_CONFIGURATION'); ?></h3>
                        </div>
                        <div class="mo_boot_col-sm-5 mo_boot_mt-4 mo_boot_float-right">    
                            <?php  echo "".($isAppConfigured==FALSE?"<a href='index.php?option=com_miniorange_oauth&view=accountsetup' 
                                    class=\"mo_boot_btn mo_boot_pb-1 mo_boot_btn-secondary\">".JText::_('COM_MINIORANGE_OAUTH_CHANGE_APPLICATION')."</a>":"<a href='index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.clearConfig'
                                    class=\"mo_boot_btn mo_boot_pb-1 mo_boot_btn-danger\" style='padding:2px 5px'>".JText::_('COM_MINIORANGE_OAUTH_DELETE_APPLICATION')."</a>&emsp;");
                                ?>  
                                 <a href='index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.exportConfiguration' class="mo_boot_btn mo_boot_btn-secondary mo_boot_float-right" style='padding:2px 5px'><?php echo JText::_('COM_MINIORANGE_OAUTH_EXPORT_CONFIGURATION');?></a>     
                        </div>
                    </div>
                </div>    
                <div class="mo_boot_col-sm-12">
                    <hr>
                    <div class="mo_boot_row mo_boot_text-center"> 
                        <div class="mo_boot_col-sm-6"> 
                            <a href="<?php echo $guide;?>" target="_blank">
                                <div class="mo_boot_row mo_boot_border mo_boot_border-dark mo_boot_m-0 mo_boot_p-0">
                                    <div class="mo_boot_col-sm-4 mo_boot_p-1 mo_boot_bg-secondary">    
                                        <i class="fa fa-chrome mo_boot_text-light" ></i>
                                    </div>
                                    <div class="mo_boot_col-sm-8 mo_boot_p-1">
                                        <span><?php echo $OauthApp['label'];?></span> <?php echo JText::_('COM_MINIORANGE_OAUTH_GUIDE');?>
                                    </div>
                                </div> 
                            </a>
                        </div>
                        <div class="mo_boot_col-sm-6">  
                            <a href="https://www.youtube.com/watch?v=k2oNWqdSOTc&list=PL2vweZ-PcNpd8-9AvYGYrYx_hXn2vSIsc" target="_blank">
                                <div class="mo_boot_row mo_boot_border mo_boot_border-dark mo_boot_m-0 mo_boot_p-0">
                                    <div class="mo_boot_col-sm-4 mo_boot_p-1 mo_boot_bg-danger">
                                        <i class="fa fa-youtube mo_boot_text-light" ></i>
                                    </div>
                                    <div class="mo_boot_col-sm-8 mo_boot_p-1">
                                        <?php echo JText::_('COM_MINIORANGE_OAUTH_SETUP_VIDEOS'); ?>
                                    </div>
                                </div>  
                            </a>    
                        </div>
                    </div>
                </div>
                <div class="mo_boot_col-sm-12 mo_boot_mt-4">
                    <form id="oauth_config_form" name="oauth_config_form" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.saveConfig'); ?>">
                        <details style="padding:0;border:none!important;" open>
                            <summary style="color:#000000!important;background:#d4d4d4!important;">Step 1 :</summary>
                            <div class="mo_boot_row mo_boot_mt-3">
                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                    <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_APPLICATION');?></strong>
                                </div>
                                <div class="mo_boot_col-sm-8">
                                    <?php echo "<span style='background:#e9ecef;cursor:not-allowed;padding:2px; border:1px solid #e9ecef'>".$OauthApp['label']."</span>";?>
                                    <input type="hidden" name="mo_oauth_app_name" value="<?php echo $mo_oauth_app; ?>">
                                </div>
                            </div>
                            <div class="mo_boot_row mo_boot_mt-3">
                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                    <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_CALLBACK_URL');?></strong>
                                </div>
                                <div class="mo_boot_col-sm-7">
                                    <input class="mo_boot_form-control" id="callbackurl" type="text" readonly="true" value='<?php echo $redirecturi; ?>'>
                                </div>
                                <div class="mo_boot_col-sm-1">
                                    <em class="fa fa-pull-right fa-lg fa-copy mo_copy copytooltip" onclick="copyToClipboard('#callbackurl');" style="color:red;background:#ccc;" ;>
                                        <span class="copytooltiptext">Copied!</span>
                                    </em>
                                </div>
                                <div class="mo_boot_col-sm-12 mo_boot_mt-2">
                                    <small><?php echo JText::_('COM_MINIORANGE_OAUTH_CALLBACK_URL_NOTE');?></small>
                                </div>
                            </div>
                        </details>
                        <br>
                        <details style="padding:0;border:none!important;" open>
                            <summary style="color:#000000!important;background:#d4d4d4!important;">Step 2 :</summary>
                            <div class="mo_boot_row">
                            <div class="mo_boot_col-sm-12">
                                <input type="hidden" id="mo_oauth_custom_app_name" name="mo_oauth_custom_app_name" value='<?php echo $OauthApp['label']; ?>' required>
                            </div>
                            </div>
                            <div class="mo_boot_row mo_boot_mt-3">
                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                    <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_CLIENT_ID'); ?></strong>
                                </div>
                                <div class="mo_boot_col-sm-7">
                                    <input placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_CLIENT_ID_PLACEHOLDER');?>" class="mo_boot_form-control" required="" type="text" name="mo_oauth_client_id" id="mo_oauth_client_id" value='<?php echo $client_id; ?>'>
                                </div>
                            </div>
                            <div class="mo_boot_row mo_boot_mt-3">
                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                    <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_CLIENT_SECRET'); ?></strong>
                                </div>
                                <div class="mo_boot_col-sm-7">
                                    <input placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_CLIENT_SECRET_PLACEHOLDER');?>" class="mo_boot_form-control" type="text" id="mo_oauth_client_secret" name="mo_oauth_client_secret" value='<?php echo $client_secret; ?>'>
                                </div>
                            </div>
                            
                                <?php
                                    //DO NOT DELETE
                                    // if($mo_oauth_app =='other'||$mo_oauth_app=='openidconnect')
                                    // {
                                    //     echo '<div class="mo_boot_row mo_boot_mt-3"><div class="mo_boot_col-sm-3 mo_boot_offset-1"><strong><span style="color:#FF0000">*</span>Scopes</strong></div><div class="mo_boot_col-sm-7"><input class="mo_boot_form-control" required type="text" id="mo_oauth_scope" name="mo_oauth_scope" placeholder="Enter the scopes" value="'.$app_scope.'"></div></div>';
                                    // }
                                    // else
                                    // {
                                        echo '<div><input  type="hidden" id="mo_oauth_scope" name="mo_oauth_scope" value="'.$OauthApp["scope"].'"></div>';
                                    // }
                                ?>  
                            <?php 
                                if($authorize_endpoint==NULL)
                                {   
                                    if(isset($appData[$appLabel]))
                                    {
                                        
                                        $fields = explode(",",$appData[$appLabel]['1']);
                                        foreach($fields as $key => $value)
                                        {
                                            if($value == 'Tenant')
                                            {
                                                $placeholder = JText::_('COM_MINIORANGE_OAUTH_ENTER_THE_TENANT_ID');
                                            }
                                            else if( $value=='Domain')
                                            {
                                                $placeholder = JText::_('COM_MINIORANGE_OAUTH_ENTER_THE_DOMAIN');
                                            }
                                            else
                                            {
                                                $placeholder = JText::_('COM_MINIORANGE_OAUTH_ENTER_THE_DETAILS').$value ;
                                            }
                                            echo '<div class="mo_boot_row mo_boot_mt-3"><div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                            <strong><span class="mo_oauth_highlight">*</span>'.$value.'</strong>
                                            </div>
                                            <div class="mo_boot_col-sm-7">
                                                <input class="mo_boot_form-control" placeholder="'.$placeholder.'" type="text" id="" name="'.$value.'" value="" required>
                                            </div></div>';
                                        }
                                    }
                                    else
                                    { ?>

                                        <div class="mo_boot_row mo_boot_mt-3">
                                            
                                            <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                                <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_APP_SCOPE');?></strong>
                                            </div>
                                            <div class="mo_boot_col-sm-7">
                                                <input class="mo_boot_form-control" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_APP_SCOPE_PLACEHOLDER');?>" type="text" id="mo_oauth_scope" name="mo_oauth_scope" value='<?php echo $app_scope ?>' required>
                                            </div>
                                        </div>
                                        <div class="mo_boot_row mo_boot_mt-3">
                                            <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                                <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_AUTHORIZE_ENDPOINT');?></strong>
                                            </div>
                                            <div class="mo_boot_col-sm-7">
                                                <input class="mo_boot_form-control" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_AUTHORIZE_ENDPOINT_PLACEHOLDER');?>" type="text" id="mo_oauth_authorizeurl" name="mo_oauth_authorizeurl" value='<?php echo $appJson[$appLabel]["authorize"] ?>' required>
                                            </div>
                                            <div class="mo_boot_col-sm-1">
                                                <em class="fa fa-pull-right fa-lg fa-copy mo_copy copytooltip" ; onclick="copyToClipboard('#mo_oauth_authorizeurl');" style="color:red;background:#ccc;" ;>
                                                    <span class="copytooltiptext">Copied!</span>
                                                </em>
                                            </div>
                                        </div>
                                        <div class="mo_boot_row mo_boot_mt-3">
                                            <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                                <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_TOKEN_ENDPOINT'); ?></strong>
                                            </div>
                                            <div class="mo_boot_col-sm-7">
                                                <input class="mo_boot_form-control" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_TOKEN_ENDPOINT_PLACEHOLDER');?>" type="text" id="mo_oauth_accesstokenurl" name="mo_oauth_accesstokenurl" value='<?php echo $appJson[$appLabel]['token']; ?>' required>
                                            </div>
                                            <div class="mo_boot_col-sm-1">
                                                <em class="fa fa-pull-right fa-lg fa-copy mo_copy copytooltip" onclick="copyToClipboard('#mo_oauth_accesstokenurl');" style="color:red;background:#ccc;" ;>
                                                    <span class="copytooltiptext">Copied!</span>
                                                </em>
                                            </div>
                                        </div>
                        
                                        <?php 
                                        if(!isset($OauthApp['type']) || $OauthApp['type']=='oauth'){?>
                                            <div class="mo_boot_row mo_boot_mt-3" id="mo_oauth_resourceownerdetailsurl_div">
                                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                                    <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_INFO_ENDPOINT'); ?></strong>
                                                </div>
                                                <div class="mo_boot_col-sm-7">
                                                    <input class="mo_boot_form-control" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_INFO_ENDPOINT_PLACEHOLDER');?>" type="text" id="mo_oauth_resourceownerdetailsurl" name="mo_oauth_resourceownerdetailsurl" value='<?php echo $appJson[$appLabel]['userinfo']; ?>' required>
                                                </div>
                                                <div class="mo_boot_col-sm-1">
                                                    <em class="fa fa-pull-right fa-lg fa-copy mo_copy copytooltip" onclick="copyToClipboard('#mo_oauth_resourceownerdetailsurl');" style="color:red;background:#ccc;" ;>
                                                        <span class="copytooltiptext">Copied!</span>
                                                    </em>
                                                </div>
                                            </div>
                                        <?php }
                                    }
                                }
                                else
                                { ?>
                                    <div class="mo_boot_row mo_boot_mt-3">
                                            
                                        <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                            <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_APP_SCOPE');?></strong>
                                        </div>
                                        <div class="mo_boot_col-sm-7">
                                            <input class="mo_boot_form-control" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_APP_SCOPE_PLACEHOLDER');?>" type="text" id="mo_oauth_scope" name="mo_oauth_scope" value='<?php echo $app_scope ?>' required>
                                        </div>
                                    </div>
                                    <div class="mo_boot_row mo_boot_mt-3">
                                        <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                            <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_AUTHORIZE_ENDPOINT'); ?></strong>
                                        </div>
                                        <div class="mo_boot_col-sm-7">
                                            <input class="mo_boot_form-control" type="text" id="mo_oauth_authorizeurl" name="mo_oauth_authorizeurl" value='<?php echo $authorize_endpoint; ?>' required>
                                        </div>
                                        <div class="mo_boot_col-sm-1">
                                            <em class="fa fa-pull-right fa-lg fa-copy mo_copy copytooltip" ; onclick="copyToClipboard('#mo_oauth_authorizeurl');" style="color:red;background:#ccc;" ;>
                                                <span class="copytooltiptext">Copied!</span>
                                            </em>
                                        </div>
                                    </div>
                                    <div class="mo_boot_row mo_boot_mt-3">
                                        <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                            <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_TOKEN_ENDPOINT'); ?></strong>
                                        </div>
                                        <div class="mo_boot_col-sm-7">
                                            <input class="mo_boot_form-control" type="text" id="mo_oauth_accesstokenurl" name="mo_oauth_accesstokenurl" value='<?php echo $access_token_endpoint; ?>' required>
                                        </div>
                                        <div class="mo_boot_col-sm-1">
                                            <em class="fa fa-pull-right fa-lg fa-copy mo_copy copytooltip" onclick="copyToClipboard('#mo_oauth_accesstokenurl');" style="color:red;background:#ccc;" ;>
                                                <span class="copytooltiptext">Copied!</span>
                                            </em>
                                        </div>
                                    </div>
                                    <?php 
                                        if(!isset($OauthApp['type']) || $OauthApp['type']=='oauth'){?>
                                            <div class="mo_boot_row mo_boot_mt-3" id="mo_oauth_resourceownerdetailsurl_div">
                                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                                    <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_INFO_ENDPOINT'); ?></strong>
                                                </div>
                                                <div class="mo_boot_col-sm-7">
                                                    <input class="mo_boot_form-control" type="text" id="mo_oauth_resourceownerdetailsurl" name="mo_oauth_resourceownerdetailsurl" value='<?php echo $user_info_endpoint; ?>' required>
                                                </div>
                                                <div class="mo_boot_col-sm-1">
                                                    <em class="fa fa-pull-right fa-lg fa-copy mo_copy copytooltip" onclick="copyToClipboard('#mo_oauth_resourceownerdetailsurl');" style="color:red;background:#ccc;" ;>
                                                        <span class="copytooltiptext">Copied!</span>
                                                    </em>
                                                </div>
                                            </div>
                                    <?php }
                                }
                                ?>    
                                <div class="mo_boot_row mo_boot_mt-3">
                                    <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                        <small><b><?php echo JText::_('COM_MINIORANGE_OAUTH_SET_CLIENT_CREDENTIALS');?></b></small>
                                    </div>

                                    <div class="mo_boot_col-sm-7">
                                        <input type="checkbox" style='vertical-align: -2px;' name="mo_oauth_in_header" value="1" <?php echo " ".$mo_oauth_in_header; ?>>&nbsp;<?php echo JText::_('COM_MINIORANGE_OAUTH_SET_CREDENTIAL_IN_HEADER');?>
                                        <input type="checkbox" style='vertical-align: -2px;' class="mo_table_textbox" name="mo_oauth_body" value="1" <?php echo " ".$mo_oauth_in_body; ?> >&nbsp; <?php echo JText::_('COM_MINIORANGE_OAUTH_SET_CREDENTIAL_IN_BODY');?>
                                    </div>
                                </div>
                                <div class="mo_boot_row mo_boot_my-4 mo_boot_text-center">
                                    <div class="mo_boot_col-sm-12">
                                        <input type="hidden" name="moOauthAppName" value="<?php echo $appLabel; ?>">
                                        <input type="submit" name="send_query"  value='<?php echo JText::_('COM_MINIORANGE_OAUTH_SAVE_SETTINGS_BUTTON'); ?>' class="mo_boot_btn mo_boot_btn-success"/>&nbsp;&nbsp;
                                        <input type="button" id="test_config_button"
                                                title='<?php echo JText::_('COM_MINIORANGE_OAUTH_TEST_CONFIGURATION_MESSAGE'); ?>'
                                                class="mo_boot_btn mo_boot_btn-primary"
                                                value='<?php echo JText::_('COM_MINIORANGE_OAUTH_TEST_CONFIGURATION_BUTTON'); ?>'
                                                onclick="testConfiguration()">
                                    </div>
                                </div>
                        </details>
                    </form>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                    <script>
                    function testConfiguration() {
                        var appname = "<?php echo $custom_app; ?>";
                        var winl = ( screen.width - 400 ) / 2,
                            wint = ( screen.height - 800 ) / 2,
                            winprops = 'height=' + 600 +
                                ',width=' + 800 +
                                ',top=' + wint +
                                ',left=' + winl +
                                ',scrollbars=1'+
                                ',resizable';
                        var myWindow = window.open('<?php echo JURI::root();?>' + '?morequest=testattrmappingconfig&app=' + appname, "Test Attribute Configuration", winprops);
                        var timer = setInterval(function() {   
                            if(myWindow.closed) {  
                                clearInterval(timer);  
                                location.reload();
                            }  
                        }, 1); 
                    }
                    </script> 
                </div>
                <div class="mo_boot_col-sm-12 mo_boot_mt-3" id="performAttrMapping">
                    <details style="padding:0;border:none!important;" open>
                        <summary style="color:#000000!important;background:#d4d4d4!important;">Step 3 :</summary>
                        <form id="oauth_mapping_form" name="oauth_config_form" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.saveMapping'); ?>">
                            <div class="mo_boot_row mo_boot_mt-2">
                                <div class="mo_boot_col-sm-12">
                                    <h3><?php echo JText::_('COM_MINIORANGE_OAUTH_ATTRIBUTE_MAPPING'); ?></h3>
                                    <hr>
                                    <h6><?php echo JText::_('COM_MINIORANGE_OAUTH_ATTRIBUTE_MAPPING_MESSAGE'); ?></h6>
                                </div>
                            </div>
                            <div class="mo_boot_row mo_boot_mt-2">
                                <div class="mo_boot_col-sm-4">
                                    <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_EMAIL_ATTR'); ?></strong>
                                </div>
                                <div class="mo_boot_col-sm-7">
                                    <select required class="mo_boot_form-control mo_boot_h-100" name="mo_oauth_email_attr" id="mo_oauth_email_attr">
                                        <option value="none" selected><?php echo JText::_('COM_MINIORANGE_OAUTH_EMAIL_ATTR_NOTE');?></option>
                                        <?php
                                            foreach($attributesNames as $key => $value)
                                            {
                                                if($value == $email_attr)
                                                {
                                                    $checked = "selected";
                                                }
                                                else
                                                {
                                                    $checked = "";
                                                }
                                                if($value!="")
                                                    echo"<option ".$checked." value='".$value."'>".$value."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mo_boot_row mo_boot_mt-2">
                                <div class="mo_boot_col-sm-4">
                                    <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_FIRST_NAME_ATTR'); ?></strong>
                                </div>
                                <div class="mo_boot_col-sm-7">
                                    <select required class="mo_boot_form-control mo_boot_h-100" name="mo_oauth_first_name_attr" id="mo_oauth_first_name_attr">
                                        <option value="none" selected><?php echo JText::_('COM_MINIORANGE_OAUTH_FIRST_NAME_ATTR_NOTE');?></option>
                                        <?php
                                            foreach($attributesNames as $key => $value)
                                            {
                                                if($value == $first_name_attr)
                                                {
                                                    $checked = "selected";
                                                }
                                                else
                                                {
                                                    $checked = "";
                                                }
                                                if($value!="")
                                                    echo"<option ".$checked." value='".$value."'>".$value."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mo_boot_row mo_boot_my-5 mo_boot_text-center">
                                <div class="mo_boot_col-sm-12">
                                    <input type="submit" name="send_query"  value='<?php echo JText::_('COM_MINIORANGE_OAUTH_SAVE_MAPPING_BUTTON'); ?>' class="mo_boot_btn mo_boot_btn-success"/>
                                </div>
                            </div>
                        </form>
                    </details>
                </div>  
                <div class="mo_boot_col-sm-12 mo_boot_mt-3">
                    <details style="padding:0;border:none!important;" open>
                        <summary style="color:#000000!important;background:#d4d4d4!important;">Step 4 :</summary>
                        <div class="mo_boot_row mo_boot_mt-3 mo_boot_mb-5">
                            <div class="mo_boot_col-sm-12 mo_boot_mb-3">
                                <?php echo JText::_('COM_MINIORANGE_OAUTH_LOGIN_URL_NOTE');?>
                            </div>
                            <div class="mo_boot_col-sm-3  mo_boot_offset-1">
                                <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_LOGIN_URL');?></strong>
                            </div>
                            <div class="mo_boot_col-sm-7">
                                <input class="mo_boot_form-control" id="loginUrl" type="text" readonly="true" value='<?php echo JURI::root() . '?morequest=oauthredirect&app_name=' . $mo_oauth_app; ?>'>
                            </div>
                            <div class="mo_boot_col-sm-1">
                                <em class="fa fa-pull-right fa-lg fa-copy mo_copy copytooltip" onclick="copyToClipboard('#loginUrl');" style="color:red;background:#ccc;" ;>
                                    <span class="copytooltiptext">Copied!</span>
                                </em>
                            </div>
                        </div>
                    </details>
                </div>
            </div>
        </div>
        <div class="mo_boot_col-sm-4">
            <?php echo mo_oauth_support();?>
        </div>
    </div>    
    <?php
}
function attributerole()
{
    global $license_tab_link;
    ?>
    <div class="mo_boot_row mo_boot_m-1 mo_boot_my-3 tab_box_style">
        <div class="mo_boot_col-sm-12">
            <div class="mo_boot_row mo_boot_mt-2">
                <div class="mo_boot_col-sm-12 mo_boot_mt-3">
                    <h3>
                        <?php echo JText::_('COM_MINIORANGE_OAUTH_ATTRIBUTE_MAPPING1');?><sup>
                        <small>[<a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'><strong>Standard</strong></a>, <a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'><strong>Premium</strong></a>,
                        <a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'><strong>Enterprise</strong></a>]</sup></small>
                    </h3>
                    <hr>
                    <h6><?php echo JText::_('COM_MINIORANGE_OAUTH_ATTRIBUTE_MAPPING_MESSAGE1'); ?></h6>
                </div>
            </div>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-2" id="mo_oauth_attributemapping">
            <div class="mo_boot_row mo_boot_mt-2">
                <div class="mo_boot_col-sm-3 mo_boot_offset-sm-1">
                    <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_ATTRIBUTE_MAPPING_USERNAME');?></strong>
                </div>
                <div class="mo_boot_col-sm-6">
                    <input class="mo_boot_form-control" type="text" id="mo_oauth_uname_attr" name="mo_oauth_uname_attr" value='' disabled required>
                </div>
            </div>
            <div class="mo_boot_row mo_boot_mt-2">
                <div class="mo_boot_col-sm-3 mo_boot_offset-sm-1">
                    <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_ATTRIBUTE_MAPPING_EMAIL');?></strong>
                </div>
                <div class="mo_boot_col-sm-6">
                    <input class="mo_boot_form-control" type="text" name="mo_oauth_email_attr" value='' disabled required>
                </div>
            </div>
            <div class="mo_boot_row mo_boot_mt-2">
                <div class="mo_boot_col-sm-3 mo_boot_offset-sm-1">
                    <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_ATTRIBUTE_MAPPING_DISPLAY_NAME');?></strong>
                </div>
                <div class="mo_boot_col-sm-6">
                    <input class="mo_boot_form-control" type="text"  id="mo_oauth_dname_attr" name="mo_oauth_dname_attr" value='' disabled>
                </div>
            </div>
            <div class="mo_boot_row mo_boot_mt-2">
                <div class="mo_boot_col-sm-12 mo_boot_mt-3 mo_boot_text-center">
                    <input type="submit" name="send_query" value='<?php echo JText::_('COM_MINIORANGE_OAUTH_SAVE_ATTRIBUTE_MAPPING');?>' disabled style="margin-bottom:3%;" class="mo_boot_btn mo_boot_btn-success"/>
                </div>
            </div>
        </div>
    </div>
    <div class="mo_boot_row mo_boot_m-1 mo_boot_my-3 tab_box_style">
        <div class="mo_boot_col-sm-12 mo_boot_mt-3"> 
            <h3> <?php echo JText::_('COM_MINIORANGE_OAUTH_MAP_JOOMLA_USER_PROFILE_ATTRIBUTES');?>
                <small><sup>
                <a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'>[<strong>Premium</strong></a>,
                <a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'><strong>Enterprise</strong>]</a>
                </sup></small>
            </h3>
            <hr>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-2">
            <p class="alert alert-info" style="color: #151515;"><?php echo JText::_('COM_MINIORANGE_OAUTH_MAP_JOOMLA_USER_PROFILE_ATTRIBUTES_NOTE');?> <a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'><strong>Premium </a> </strong>and <a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'> <strong>Enterprise</strong></a> versions of plugin.</p>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_my-4">
            <div class="mo_boot_row">
                <div class="mo_boot_col-sm-4">
                    <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_USER_PROFILE_ATTRIBUTE');?></strong>
                </div>
                <div class="mo_boot_col-sm-4">
                    <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_SERVER_ATTRIBUTE');?></strong>
                </div>
            </div>
            <div class="mo_boot_row mo_boot_my-3">
                <div class="mo_boot_col-sm-4">
                    <input class="mo_boot_form-control" type="text" disabled="disabled"/>
                </div>
                <div class="mo_boot_col-sm-4">
                    <input type="text"  class="mo_boot_form-control" disabled="disabled"/>
                </div>
                <div class="mo_boot_col-sm-4">
                    <input type="button" class="mo_boot_btn mo_boot_btn-primary moOauthAttributeMappingButtons" disabled="true"  value="+" />
                    <input type="button" class="mo_boot_btn mo_boot_btn-danger" disabled="true" value="-" />
                </div>
            </div>
        </div>
    </div>
    <div class="mo_boot_row mo_boot_m-1 mo_boot_my-3 tab_box_style">
        <div class="mo_boot_col-sm-12 mo_boot_mt-5">
            <h3>
                <?php echo JText::_('COM_MINIORANGE_OAUTH_MAP_JOOMLA_USER_FIELD_ATTRIBUTES');?>
                <sup><small><a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'>[<strong>Enterprise</strong>]</a></small></sup>
            </h3>
            <hr>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-2">
            <p class="alert alert-info" style="color: #151515;"><?php echo JText::_('COM_MINIORANGE_OAUTH_MAP_JOOMLA_USER_FIELD_ATTRIBUTES_NOTE');?></p>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_my-3">
            <div class="mo_boot_row mo_boot_mt-2">
                <div class="mo_boot_col-sm-4">
                    <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_USER_FIELD_ATTRIBUTE');?></strong>
                </div>
                <div class="mo_boot_col-sm-4">
                    <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_SERVER_ATTRIBUTE');?></strong>
                </div>
            </div>
            <div class="mo_boot_row mo_boot_my-3">
                <div class="mo_boot_col-sm-4">
                    <input class="mo_boot_form-control" type="text" disabled/>
                </div>
                <div class="mo_boot_col-sm-4">
                    <input class="mo_boot_form-control" type="text" disabled/>
                </div>
                <div class="mo_boot_col-sm-4">
                    <input type="button" class="mo_boot_btn mo_boot_btn-primary moOauthAttributeMappingButtons"  value="+" disabled/>
                    <input type="button" class="mo_boot_btn mo_boot_btn-danger" value="-" disabled/>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}
function roleMapping()
{
    global $license_tab_link;
    ?>
    
    <div class="mo_boot_row mo_boot_m-1 mo_boot_my-3 tab_box_style">
        <div class="mo_boot_col-sm-12">
            <div class="mo_boot_row mo_boot_my-3">
                <div class="mo_boot_col-sm-12 mo_boot_mt-3">
                    <h3><?php echo JText::_('COM_MINIORANGE_OAUTH_GROUP_MAPPING');?><sup><span size="2px" >[<a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'><strong>Standard, Premium, Enterprise</strong></a>]</span></sup></h3>
                    <hr>
                    <h6><?php echo JText::_('COM_MINIORANGE_OAUTH_GROUP_MAPPING_NOTE');?></h6>
                </div>
                
            </div>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-2">
            <input type="checkbox" name="enable_role_mapping" id="enable_role_mapping" value="1" disabled style="margin-right:10px;"/><strong><?php echo JText::_('COM_MINIORANGE_OAUTH_ENABLE_GROUP_MAPPING');?></strong>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_my-4">
            <div class="mo_boot_row">
                <div class="mo_boot_col-sm-4">
                    <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_SELECT_DEFAULT_GROUP_FOR_NEW_USER');?></strong>
                </div>
                <div class="mo_boot_col-sm-6">
                    <?php
                        $db = JFactory::getDbo();
                        $db->setQuery($db->getQuery(true)
                            ->select('*')
                            ->from("#__usergroups")
                        );
                        $groups = $db->loadRowList();

                        echo '<select class="mo_boot_form-control" name="mapping_value_default" id="default_group_mapping">';

                        foreach ($groups as $group)
                        {
                            if ($group[4] != 'Super Users'&&$group[4] != 'Public'&&$group[4] != 'Guest')
                                echo '<option selected="selected" value = "' . $group[0] . '">' . $group[4] . '</option>';
                        }
                    ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="mo_boot_row mo_boot_m-1 tab_box_style">
        <div class="mo_boot_col-sm-12 mo_boot_mt-1">
            <div class="mo_boot_row mo_boot_mt-3">
                <div class="mo_boot_col-sm-12">
                    <h3><?php echo JText::_('COM_MINIORANGE_OAUTH_ADVANCE_GROUP_MAPPING');?><sup><small>
                        [<a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'><strong>Premium</strong></a>,
                        <a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'><strong>Enterprise</strong></a>]</small>
                    </sup></h3>
                    <hr>
                </div>
            </div>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-2">
            <div class="mo_boot_row mo_boot_mt-2">
                <div class="mo_boot_col-sm-4">
                    <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_GROUP_ATTRIBUTE_NAMES');?></strong>
                </div>
                <div class="mo_boot_col-sm-8">
                    <input class="mo_boot_form-control" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_GROUP_ATTRIBUTE_NAMES_PLACEHOLDER');?>" type="text" id="mo_oauth_gname_attr" name="mo_oauth_gname_attr" value='' disabled>
                </div>

            </div>
            <hr>
            <div class="mo_boot_row mo_boot_mt-3" style="padding:10px;">
                <div class="mo_boot_col-sm-12">
                    <input type="checkbox" class="mo_oauth_custom_checkbox" name="disable_update_existing_users_role" value="1" disabled>&emsp;<?php echo JText::_('COM_MINIORANGE_OAUTH_DO_NOT_UPDATE_EXISTING_USER_GROUPS');?><br>
                    <input type="checkbox" class="mo_oauth_custom_checkbox" name="disable_update_existing_users_role" value="1"  disabled>&emsp;<?php echo JText::_('COM_MINIORANGE_OAUTH_DO_NOT_UPDATE_EXISTING_USER_GROUPS_AND_NEWLY_MAPPED_ROLES');?><br>
                    <input type="checkbox" class="mo_oauth_custom_checkbox" name="disable_create_users" value="1"  disabled>&emsp;<?php echo JText::_('COM_MINIORANGE_OAUTH_DO_NOT_AUTO_CREATE_USERS_IF_ROLES_NOT_MAPPED');?><br>
                </div>
            </div>
        </div>
        <div class=" mo_boot_m-1 mo_boot_my-2" style="background-color:lightgray;width:98.8%!important;">
            <div class="mo_boot_row mo_boot_mt-3">
                <div class="mo_boot_col-sm-4 mo_boot_offset-sm-1">
                    <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_GROUP_NAME_IN_JOOMLA');?></strong>
                </div>
                <div class="mo_boot_col-sm-6">
                    <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_GROUP_ROLE_NAME_IN_CONFIGURED_APP');?></strong>
                </div>
            </div>
            <div class="mo_boot_row mo_boot_mt-3">
                <?php
                    $user_role = array();
                    if (empty($role_mapping_key_value)) {
                        foreach ($groups as $group) {
                            if ($group[4] != 'Super Users') {
                                echo '<div class="mo_boot_col-sm-4 mo_boot_mt-2 mo_boot_offset-sm-1"><strong>' . $group[4] . '</strong></div><div class="mo_boot_col-sm-6 mo_boot_mt-2"><input class="mo_boot_form-control"  disabled type="text" id="oauth_group_attr_values' . $group[0] . '" name="oauth_group_attr_values' . $group[0] . '" value= "" placeholder="'.JText::_('COM_MINIORANGE_OAUTH_GROUP_ROLE_NAME_IN_CONFIGURED_APP_PLACEHOLDER'). $group[4] . '" "' . ' /></div>';
                            }
                        }
                    }
                    else
                    {
                        foreach ($groups as $group)
                        {
                            if ($group[4] != 'Super Users')
                            {
                                $role_value = array_key_exists($group[0], $role_mapping_key_value) ? $role_mapping_key_value[$group[0]] : "";
                                echo '<div class="mo_boot_col-sm-4 mo_boot_offset-sm-1"><strong>' . $group[4] . '</strong></div><div class="mo_boot_col-sm-6"><input  class="mo_boot_form-control"  disabled type="text" id="oauth_group_attr_values' . $group[0] . '" name="oauth_group_attr_values' . $group[0] . '" value= "' . $role_value . '" placeholder="'.JText::_('COM_MINIORANGE_OAUTH_GROUP_ROLE_NAME_IN_CONFIGURED_APP_PLACEHOLDER'). $group[4] . '" "' . ' /></div>';
                            }
                        }
                    }
                ?>
            </div>
            <div class="mo_boot_row mo_boot_mt-3">
                <div class="mo_boot_col-sm-12 mo_boot_text-center">
                    <input type="submit" name="send_query"  value='<?php echo JText::_('COM_MINIORANGE_OAUTH_SAVE_ROLE_MAPPING');?>' disabled style="margin-bottom:3%;" class="mo_boot_btn mo_boot_btn-success"/>
                </div>
            </div>
        </div>
    </div>
    
    <?php
}

function grant_type_settings() {
    global $license_tab_link;
    ?>
    <div class="mo_boot_row mo_boot_mr-1 mo_boot_my-3 tab_box_style">
        <div class="mo_boot_col-sm-12 mo_boot_mt-4">
            <h3 style="display: inline;">Grant Settings<sup><code><small><a href="<?php echo $license_tab_link;?>"  rel="noopener noreferrer">[PREMIUM,ENTERPRISE]</a></small></code></sup></h3>
            <hr>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-2">
            <h4>Select Grant Type:</h4>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-2 grant_types">
            <input checked disabled type="checkbox">&emsp;<strong>Authorization Code Grant</strong>&emsp;<code><small>[DEFAULT]</small></code>
            <blockquote>
                The Authorization Code grant type is used by web and mobile apps.<br/>
                It requires the client to exchange authorization code with access token from the server.
                <br/><small>(If you have doubt on which settings to use, you can leave this checked and disable all others.)</small>
            </blockquote>
            <input disabled type="checkbox">&emsp;<strong>Implicit Grant</strong>
            <blockquote>
                The Implicit grant type is a simplified version of the Authorization Code Grant flow.<br/>
                OAuth providers directly offer access token when using this grant type.
            </blockquote>
            <input disabled type="checkbox">&emsp;<strong>Password Grant</strong>
            <blockquote>
                Password grant is used by application to exchange user's credentials for access token.<br/>
                This, generally, should be used by internal applications.
            </blockquote>
            <input disabled type="checkbox">&emsp;<strong>Refresh Token Grant</strong>
            <blockquote>
                The Refresh Token grant type is used by clients.<br/>
                This can help in keeping user session persistent.
            </blockquote>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-2">
            <hr>
            <h3 style="display: inline;">JWT Validation<sup><code><small><a href="<?php echo $license_tab_link;?>"  rel="noopener noreferrer">[PREMIUM,ENTERPRISE]</a></small></code></sup></h3>
            <hr>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-2">
            <strong>Enable JWT Verification:</strong>
            <input type="checkbox" value="" disabled/>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-2">
            <strong>JWT Signing Algorithm:</strong>
            <select disabled>
                <option>HSA</option>
                <option>RSA</option>
            </select> 
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_my-2">
            <div class="notes">
                <hr />
                Grant Type Settings and JWT Validation are configurable in <a href="<?php echo $license_tab_link;?>" rel="noopener noreferrer">premium and enterprise</a> versions of the plugin.
            </div>
        </div>
    </div>
    <?php
}

function loginlogoutsettings()
{
    global $license_tab_link;
    ?>
    <div class="mo_boot_row mo_boot_m-1 mo_boot_my-3 tab_box_style">
        <div class="mo_boot_col-sm-12 mo_boot_mt-4">
            <h3><?php echo JText::_('COM_MINIORANGE_OAUTH_ADVANCED_SETTINGS');?></h3>
            <hr>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-3">
            <input type="checkbox" name="mo_oauth_auto_redirect" id="mo_oauth_auto_redirect" value="1" disabled style="margin-right:10px;"/>
            <span><?php echo JText::_('COM_MINIORANGE_OAUTH_RESTRICT_ANNONYMOUS_ACCESS');?></span>
            <small><sup>[<a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'><strong>Coming soon</strong></a>]</sup></small>
            
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-3">
            <input type="checkbox" name="mo_oauth_dont_auto_register" id="mo_oauth_dont_auto_register" value="1" disabled style="margin-right:10px;"/>
            <span><?php echo JText::_('COM_MINIORANGE_OAUTH_RESTRICT_SITE_FOR_NEW_USER');?></span>
            <small><sup>[<a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'><strong>Coming soon</strong></a>]</sup></small>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-4">
            <details>
                <summary>
                    <?php echo JText::_('COM_MINIORANGE_OAUTH_CUSTOMIZE_ICON');?>
                    <sup><small><a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'>[<strong>Standard , Premium ,Enterprise</strong>]</a></small></sup>
                </summary>
                <div class="mo_boot_row mo_boot_m-1 mo_boot_mt-3">
                    <div class="mo_boot_col-sm-12">
                        <p class="highlight"> <?php echo JText::_('COM_MINIORANGE_OAUTH_CUSTOMIZE_ICON_NOTE');?></p>
                    </div>
                    <div class="mo_boot_col-sm-12">
                        <div class="mo_boot_row mo_boot_my-2">
                            <div class="mo_boot_col-sm-3">
                                <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_CUSTOMIZE_ICON_WIDTH');?></strong>
                            </div>
                            <div class="mo_boot_col-sm-9">
                                <input class="mo_boot_form-control" disabled type="text" placeholder="e.g. 200px or 100%">
                            </div>
                        </div>
                        <div class="mo_boot_row mo_boot_my-2">
                            <div class="mo_boot_col-sm-3">
                                <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_CUSTOMIZE_ICON_HEIGHT');?></strong>
                            </div>
                            <div class="mo_boot_col-sm-9">
                                <input class="mo_boot_form-control" disabled type="text"  placeholder="e.g. 50px or auto">
                            </div>
                        </div>
                        <div class="mo_boot_row mo_boot_my-2">
                            <div class="mo_boot_col-sm-3">
                                <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_CUSTOMIZE_ICON_MARGINS');?></strong>
                            </div>
                            <div class="mo_boot_col-sm-9">
                                <input class="mo_boot_form-control" disabled type="text" placeholder="e.g. 2px 0px or auto">
                            </div>
                        </div>
                        <div class="mo_boot_row mo_boot_my-2">
                            <div class="mo_boot_col-sm-3">
                                <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_CUSTOMIZE_ICON_CSS');?></strong>
                            </div>
                            <div class="mo_boot_col-sm-9">
                                <textarea disabled type="text" style="resize: vertical;width:100%;"  rows="6"></textarea><br/><strong><?php echo JText::_('COM_MINIORANGE_OAUTH_CUSTOMIZE_ICON_CSS_EXAMPLE');?></strong>
                                <pre>.oauthloginbutton{background: #7272dc;height:40px;padding:8px;text-align:center;color:#fff;}</pre>
                            </div>
                        </div>
                        <div class="mo_boot_row">
                            <div class="mo_boot_col-sm-3">
                                <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_CUSTOMIZE_ICON_BUTTON');?></strong>
                            </div>
                            <div class="mo_boot_col-sm-9">
                                <input class="mo_boot_form-control" disabled type="text" style="resize: vertical;width:100%;" placeholder ="Howdy ,##user##"> <?php echo JText::_('COM_MINIORANGE_OAUTH_CUSTOMIZE_ICON_BUTTON_EXAMPLE');?>
                            </div>
                        </div>
                    </div>
                </div>
            </details>
            <details>
                <summary>
                <?php echo JText::_('COM_MINIORANGE_OAUTH_USER_ANALYTICS_AND_TRANSACTION_REPORTS');?>
                    <sup><small><a href='<?php echo $license_tab_link;?>' class='mo_oauth_coming_soon_features premium'>[<strong>Enterprise</strong>]</a></small></sup>
                </summary>
                <div class="mo_boot_row mo_boot_m-1 mo_boot_mt-3">
                    <div class="mo_boot_col-sm-12">
                        <div class="mo_boot_row mo_boot_mt-2">
                            <div class="mo_boot_col-sm-12">
                                <input disabled type="button" class="mo_boot_btn mo_boot_btn-danger" id="cleartext" value="<?php echo JText::_('COM_MINIORANGE_OAUTH_USER_ANALYTICS_AND_TRANSACTION_REPORTS_CLEAR_REPORTS');?>" style="float:right" />
                                <input disabled type="button" class="mo_boot_btn mo_boot_btn-primary" id="refreshtext" value="<?php echo JText::_('COM_MINIORANGE_OAUTH_USER_ANALYTICS_AND_TRANSACTION_REPORTS_REFRESH');?>" style="float:right;margin-right:10px;"/>
                            </div>
                        </div>
                        <div class="mo_boot_row mo_boot_mt-3">
                            <div class="mo_boot_col-sm-12 mo_boot_table-responsive">
                                <table class="mo_boot_table mo_boot_table-striped mo_boot_table-hover mo_boot_table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo JText::_('COM_MINIORANGE_OAUTH_USER_ANALYTICS_AND_TRANSACTION_REPORTS_USERNAME');?></th>
                                            <th><?php echo JText::_('COM_MINIORANGE_OAUTH_USER_ANALYTICS_AND_TRANSACTION_REPORTS_APPLICATION');?></th>
                                            <th><?php echo JText::_('COM_MINIORANGE_OAUTH_USER_ANALYTICS_AND_TRANSACTION_REPORTS_STATUS');?></th>
                                            <th><?php echo JText::_('COM_MINIORANGE_OAUTH_USER_ANALYTICS_AND_TRANSACTION_REPORTS_LOGIN_TIMESTAMP');?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </details>
            <details>
                <summary>
                    <?php echo JText::_('COM_MINIORANGE_OAUTH_DOMAIN_SETTINGS');?>
                </summary>
                <div class="mo_boot_row mo_boot_m-1 mo_boot_mt-5">
                    <div class="mo_boot_col-sm-3">
                        <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_RESTRICTED_DOMAINS');?></strong>
                    </div>
                    <div class="mo_boot_col-sm-8">
                        <input class="mo_boot_form-control" type="text" id="mo_oauth_restricted_domains" name="mo_oauth_restricted_domains" value='' disabled placeholder="domain1.com,domain2.com,....">
                        <p><em><?php echo JText::_('COM_MINIORANGE_OAUTH_RESTRICTED_DOMAINS_NOTE');?></em></p>
                    </div>
                </div>
                <div class="mo_boot_row mo_boot_m-1 mo_boot_mt-2">
                    <div class="mo_boot_col-sm-3">
                        <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_ALLOWED_DOMAINS');?></strong>
                    </div>
                    <div class="mo_boot_col-sm-8">
                        <input class="mo_boot_form-control" type="text" value='' disabled placeholder="domain1.com,domain2.com,....">
                        <p><em><?php echo JText::_('COM_MINIORANGE_OAUTH_ALLOWED_DOMAINS_NOTE');?></em></p>
                    </div>
                </div>
            </details>
            <details>
                <summary>
                <?php echo JText::_('COM_MINIORANGE_OAUTH_LOGIN_SETTINGS');?>
                </summary>
                <div class="mo_boot_row mo_boot_m-1 mo_boot_mt-5">
                    <div class="mo_boot_col-sm-3">
                        <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_LOGIN_REDIRECT_URL');?></strong>
                    </div>
                    <div class="mo_boot_col-sm-8">
                        <input class="mo_boot_form-control" type="text" value='' disabled placeholder="domain1.com,domain2.com,....">
                        <p><em><?php echo JText::_('COM_MINIORANGE_OAUTH_LOGIN_REDIRECT_URL_NOTE');?></em></p>
                    </div>
                </div>
                <div class="mo_boot_row mo_boot_m-1 mo_boot_mt-2">
                    <div class="mo_boot_col-sm-3">
                        <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_LOGOUT_REDIRECT_URL');?></strong>
                    </div>
                    <div class="mo_boot_col-sm-8">
                        <input class="mo_boot_form-control" type="text" value='' disabled placeholder="domain1.com,domain2.com,....">
                        <p><em><?php echo JText::_('COM_MINIORANGE_OAUTH_LOGOUT_REDIRECT_URL_NOTE');?></em></p>
                    </div>
                </div>
            </details>
        </div>
    </div>
    <?php


}
function support()
{
    global $license_tab_link;
    ?>
    <div class="mo_boot_row mo_boot_m-1 mo_boot_mt-3 tab_box_style">
        <div class="mo_boot_col-sm-12 mo_boot_mt-4">
            <h3>
                <?php echo JText::_('COM_MINIORANGE_OAUTH_SUPPORT_FEATURE');?>
                <span style="float:right;" id="mini-icons">
                    <a href="https://faq.miniorange.com/kb/oauth-openid-connect/" target="_blank" class="mo_boot_btn mo_boot_btn-success mo_boot_py-1"><?php echo JText::_('COM_MINIORANGE_OAUTH_FAQS');?></a>
                    <a href="https://plugins.miniorange.com/joomla-oauth-client" target="_blank" title="Website" style="padding:5px;border:1px solid lightgray;"><em style="color:#2384d3" class="fa fa-globe"></em></a>
                    <a href="https://www.miniorange.com/contact" target="_blank" title="Contact-Us" style="padding:5px;border:1px solid lightgray;"><em style="color:#2384d3" class="fa fa-comment"></em></a>
                    <a href="https://extensions.joomla.org/extension/miniorange-oauth-client/" target="_blank" title="Rate us" style="padding:5px;border:1px solid lightgray;"><em style="color:#2384d3" class="fa fa-star"></em></a>
                </span>
            </h3>
            <hr>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_mt-2">
            <details open>
                <summary><?php echo JText::_('COM_MINIORANGE_OAUTH_SUPPORT');?></summary>
                    <hr>
                    <div class="mo_boot_row mo_boot_m-2">
                        <?php
                            
                            $current_user = JFactory::getUser();
                            $result = MoOAuthUtility::getCustomerDetails();
                            $admin_email = empty(trim($result['email']))?$current_user->email:$result['email'];
                            $user_email= new MoOauthCustomer();
                            $result=$user_email->getAccountDetails();
                            if($result['contact_admin_email']!=NULL)
                            {
                                $admin_email =$result['contact_admin_email'];
                            }
                            $admin_phone = $result['admin_phone'];
                            
                        ?>
                        <form name="f" style="width:100%;" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.contactUs'); ?>">
                            <div class="mo_boot_col-sm-12">
                                <p style="background-color: #e2e6ea; padding: 10px;"><?php echo JText::_('COM_MINIORANGE_OAUTH_CONTACT_US_DETAILS');?></p>
                                <br>
                            </div>
                            <div class="mo_boot_col-sm-12">
                                <div class="mo_boot_row mo_boot_mt-2">
                                    <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                        <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_EMAIL');?>:<span class="mo_oauth_highlight">*</span></strong>
                                    </div>
                                    <div class="mo_boot_col-sm-6">
                                        <input type="email" class="mo_boot_form-control oauth-table mo_oauth_textbox" name="query_email" value="<?php echo $admin_email?>" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_EMAIL_PLACEHOLDER');?>" required />
                                    </div>
                                </div>
                                <div class="mo_boot_row mo_boot_mt-2">
                                    <div class="mo_boot_col-sm-3 mo_boot_offset-1"> <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_MOBILE_NO');?> :</strong></div>
                                    <div class="mo_boot_col-sm-6">
                                        <input type="number" class="mo_boot_form-control oauth-table mo_oauth_textbox" name="query_phone" value="<?php echo $admin_phone ?>" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_MOBILE_NO_PLACEHOLDER');?>"/>
                                    </div>
                                </div>
                                <div class="mo_boot_row mo_boot_mt-2">
                                    <div class="mo_boot_col-sm-3 mo_boot_offset-1"><strong><?php echo JText::_('COM_MINIORANGE_OAUTH_QUERY');?>:</strong><span class="mo_oauth_highlight">*</span></div>
                                    <div class="mo_boot_col-sm-6">
                                        <textarea class="mo_boot_px-2 mo_oauth_textbox" name="query" style="width:100%;height:100px;" rows="4" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_QUERY_PLACEHOLDER');?>" required></textarea>
                                    </div>
                                </div>
                                <div class="mo_boot_row mo_boot_mt-2">
									<div class="mo_boot_col-sm-3 mo_boot_offset-1"></div>
									<div class="mo_boot_col-sm-6">
										<input id="mo_oauth_query_withconfig"  type="checkbox" name="mo_oauth_query_withconfig" value="1" > <?php echo JText::_('COM_MINIORANGE_OAUTH_SEND_CONFIGURATION');?>
									</div>
								</div>
                                <div class="mo_boot_row mo_boot_my-4 mo_boot_text-center">
                                    <div class="mo_boot_col-sm-12">
                                        <input type="submit" name="send_query"  value="<?php echo JText::_('COM_MINIORANGE_OAUTH_SUBMIT_QUERY');?>" class="mo_boot_btn mo_boot_btn-success"/>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div hidden id="mo_oauth_feedback_overlay"></div>
                        <br/>              
                    </div>
            </details>
            <details>
                <summary><?php echo JText::_('COM_MINIORANGE_OAUTH_REQUEST_DEMO');?></summary>
                <hr>
                <div class="mo_boot_row mo_boot_m-2">
                    <div class="mo_boot_col-sm-12">
                        <div style="background-color: #e2e6ea; padding: 10px;">
                            <?php echo JText::_('COM_MINIORANGE_OAUTH_REQUEST_DEMO_NOTE');?>
                        </div><br>
                    </div>
                    <div class="mo_boot_col-sm-12">
                        <form id="demo_request" name="demo_request" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.requestForDemoPlan'); ?>">
                            <div class="mo_boot_row mo_boot_mt-2">
                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                    <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_REQUEST_DEMO_EMAIL');?><span class="mo_oauth_highlight">*</span></strong>
                                </div>
                                <div class="mo_boot_col-sm-6">
                                    <input required class="mo_boot_form-control mo_oauth_textbox" onblur="validateEmail(this)" type="email" name="email" placeholder="person@example.com" value="<?php echo $admin_email ?>"/>
                                    <p style="display: none;color:red" id="email_error">Invalid Email</p>
                                </div>
                            </div>

                            <div class="mo_boot_row mo_boot_mt-2 mo_boot_my-1">
                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                    <p> <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_REQUEST_FOR');?><span class="mo_oauth_highlight">*</span></strong></p>
                                </div>
                                <div class="mo_boot_col-sm-3">
                                    <label><input type="radio" name="demo" class="mo_boot_mx-2" value="Trial of 7 days" CHECKED><?php echo JText::_('COM_MINIORANGE_OAUTH_TRIAL');?></label>
                                </div>
                                <div class="mo_boot_col-sm-3">
                                    <label><input type="radio" name="demo" class="mo_boot_mx-2"  value="Demo" ><?php echo JText::_('COM_MINIORANGE_OAUTH_DEMO');?></label>
                                </div>
                            </div>
                            <div class="mo_boot_row mo_boot_mt-2">
                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                    <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_REQUEST_TRIAL_DEMO');?>:<span class="mo_oauth_highlight">*</span></strong>
                                </div>
                                <div class="mo_boot_col-sm-6">
                                    <select required class="mo_boot_form-control mo_oauth_textbox" name="plan" id="rfd_id">
                                        <option value=""><?php echo JText::_('COM_MINIORANGE_OAUTH_DEMO_SELECT');?></option>
                                        <option value="Joomla OAuth Client Standard Plugin"><?php echo JText::_('COM_MINIORANGE_OAUTH_CLIENT_STANDARD_PLUGIN');?></option>
                                        <option value="Joomla OAuth Client Premium Plugin"><?php echo JText::_('COM_MINIORANGE_OAUTH_CLIENT_PREMIUM_PLUGIN');?></option>
                                        <option value="Joomla OAuth Client Enterprise Plugin"><?php echo JText::_('COM_MINIORANGE_OAUTH_CLIENT_ENTERPRISE_PLUGIN');?></option>
                                        <option value="Not Sure"><?php echo JText::_('COM_MINIORANGE_OAUTH_NOT_SURE');?></option>
                                    </select>
                                </div>

                            </div>
                            <div class="mo_boot_row mo_boot_mt-2">
                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                    <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_DEMO_DESCRIPTION');?>:<span class="mo_oauth_highlight">*</span></strong>
                                </div>
                                <div class="mo_boot_col-sm-6">
                                    <textarea class="mo_boot_px-2 mo_oauth_textbox" required type="text" name="description" style="width:100%; height:100px;" rows="4" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_DEMO_DESCRIPTION_PLACEHOLDER');?>" value=""></textarea>
                                </div>
                            </div>
                            <div class="mo_boot_row mo_boot_my-4 mo_boot_text-center">
                                <div class="mo_boot_col-sm-12">
                                    <input type="submit" name="submit" value="<?php echo JText::_('COM_MINIORANGE_OAUTH_SUBMIT_DEMO_REQUEST');?>" class="mo_boot_btn mo_boot_btn-success"/>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </details>
            <details>
                <summary><?php echo JText::_('COM_MINIORANGE_OAUTH_SETUP_CALL');?></summary>
                <hr>
                <?php
                    $arrContextOptions=array(
                        "ssl"=>array(
                            "verify_peer"=>false,
                            "verify_peer_name"=>false,
                        ),
                    );  
                    
                    $strJsonFileContents = file_get_contents(JURI::root()."/administrator/components/com_miniorange_oauth/assets/json/timezones.json",false,stream_context_create($arrContextOptions));
                    $timezoneJsonArray = json_decode($strJsonFileContents, true);

                ?>
                <form name="f" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.callContactUs'); ?>">
                    <div class="mo_boot_row">
                        <div class="mo_boot_col-sm-12 mo_boot_px-5">
                            <p  style="background-color: #e2e6ea; padding: 10px;"><?php echo JText::_('COM_MINIORANGE_OAUTH_SETUP_CALL_NOTE');?></p>
                        </div>
                        <div class="mo_boot_col-sm-12">
                            <div class="mo_boot_row mo_boot_mt-2">
                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                    <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_SETUP_CALL_EMAIL');?></strong>
                                </div>
                                <div class="mo_boot_col-sm-6">
                                    <input class="mo_boot_form-control mo_boot_px-3 mo_oauth_textbox"  type="email" placeholder="user@example.com"  name="mo_oauth_setup_call_email" value="<?php echo $admin_email; ?>"  required>
                                </div>
                            </div>
                            <div class="mo_boot_row mo_boot_mt-2">
                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                    <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_SETUP_CALL_ISSUE');?></strong>
                                </div>
                                <div class="mo_boot_col-sm-6">
                                    <select id="issue_dropdown"  class="mo_callsetup_table_textbox mo_boot_form-control mo_oauth_textbox" name="mo_oauth_setup_call_issue" required>
                                        <option disabled selected><?php echo JText::_('COM_MINIORANGE_OAUTH_SETUP_CALL_SELECT_ISSUE');?></option>
                                        <option id="sso_setup_issue"><?php echo JText::_('COM_MINIORANGE_OAUTH_SETUP_CALL_SSO_SETUP_ISSUE');?></option>
                                        <option><?php echo JText::_('COM_MINIORANGE_OAUTH_SETUP_CALL_CUSTOM_REQUIREMENT');?></option>
                                        <option id="other_issue"><?php echo JText::_('COM_MINIORANGE_OAUTH_SETUP_OTHER');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="mo_boot_row mo_boot_mt-2">
                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                    <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_SETUP_CALL_DATE');?></td></strong>
                                </div>
                                <div class="mo_boot_col-sm-6">
                                    <input class="mo_boot_form-control mo_callsetup_table_textbox mo_oauth_textbox" name="mo_oauth_setup_call_date" type="date" id="calldate" required>
                                </div>
                            </div>
                            <div class="mo_boot_row mo_boot_mt-2">
                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                    <strong><span class="mo_oauth_highlight">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_SETUP_CALL_TIME');?></td></strong>
                                </div>
                                <div class="mo_boot_col-sm-6">
                                    <select class="mo_callsetup_table_textbox mo_boot_px-2 mo_oauth_textbox" style="width:100%;" name="mo_oauth_setup_call_timezone" id="timezone" required>
                                    <?php
                                        foreach($timezoneJsonArray as $data)
                                        {
                                            echo "<option>".$data."</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mo_boot_row mo_boot_mt-2">
                                <div class="mo_boot_col-sm-3 mo_boot_offset-1">
                                    <strong><span id="required_mark" style="display: none;color:#FF0000">*</span><?php echo JText::_('COM_MINIORANGE_OAUTH_SETUP_CALL_DESCRIPTION');?></strong>
                                </div>
                                <div class="mo_boot_col-sm-6">
                                    <textarea id="issue_description" style="width:100%; height:100px;" rows="4" class="mo_callsetup_table_textbox mo_boot_px-2 mo_oauth_textbox" name="mo_oauth_setup_call_desc" minlength="15" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_SETUP_CALL_DESCRIPTION_PLACEHOLDER');?>" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="mo_boot_row mo_boot_my-4 mo_boot_text-center">
                                <div class="mo_boot_col-sm-12">
                                    <input type="submit" name="send_query"  value="<?php echo JText::_('COM_MINIORANGE_OAUTH_SETUP_CALL_SUBMIT_QUERY');?>" class="mo_boot_btn mo_boot_btn-success">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
            </details>
            <script>
                jQuery(document).ready(function(){
                    var dtToday = new Date();
                    var month = dtToday.getMonth() + 1;
                    var day = dtToday.getDate();
                    var year = dtToday.getFullYear();
                    if(month < 10)
                        month = '0' + month.toString();
                    if(day < 10)
                        day = '0' + day.toString();
                    var maxDate = year + '-' + month + '-' + day;
                    
                    jQuery('#calldate').attr('min', maxDate);
                });
                

                
            </script>
        </div>
    </div>
    <?php
}
function mo_oauth_side_addon(){
    ?>
    <div class="mo_boot_row mo_boot_m-1 mo_boot_my-3 mo_boot_py-2 mo_boot_text center tab_box_style">
        <div class="mo_boot_col-sm-12">
            <h3 class="mo_boot_p-2 mo_boot_mt-3 mo_boot_text-center"><?php echo JText::_('COM_MINIORANGE_OAUTH_ADD_ON');?></h3>
            <hr>
        </div>
        <div class="mo_boot_col-sm-12">
            <div class="mo_boot_row mo_boot_m-1 mo_boot_p-2 add_on_box" >
                <div class="mo_boot_col-sm-4">
                    <img style="margin-top:2em;" alt="" src="<?php  echo JURI::root(); ?>administrator/components/com_miniorange_oauth/assets/images/miniorange.png" width="80px" height="80px">
                </div>
                <div class="mo_boot_col-sm-8">
                    <h3 style="margin-top:1em;"><?php echo JText::_('COM_MINIORANGE_OAUTH_KEYCLOAK_USER_SYNC_ADD_ON');?></h3>
                </div>
                <div class="mo_boot_col-sm-12 mo_boot_text-justify">
                    <p><?php echo JText::_('COM_MINIORANGE_OAUTH_KEYCLOAK_USER_SYNC_ADD_ON_DESCRIPTION');?> <a href="https://plugins.miniorange.com/user-sync-between-joomla-and-keycloak" target="_blank" style="text-decoration:none;"><?php echo JText::_('COM_MINIORANGE_OAUTH_KNOW_MORE');?></a></p>
                    
                </div>
            </div>
        </div>
        <div class="mo_boot_col-sm-12">
            <div class="mo_boot_row mo_boot_m-2 mo_boot_p-2 add_on_box">
                <div class="mo_boot_col-sm-4">
                    <img style="margin-top:2em;" alt="" src="<?php  echo JURI::root(); ?>administrator/components/com_miniorange_oauth/assets/images/discord.png" width="80px" height="80px">
                </div>
                <div class="mo_boot_col-sm-8">
                    <h3 style="margin-top:1em;"><?php echo JText::_('COM_MINIORANGE_OAUTH_DISCORD_ROLE_MAPPING_ADD_ON');?></h3>
                </div>
                <div class="mo_boot_col-sm-12 mo_boot_text-justify">
                    <p><?php echo JText::_('COM_MINIORANGE_OAUTH_DISCORD_ROLE_MAPPING_ADD_ON_DESCRIPTION');?> <a href="https://www.miniorange.com/contact" target="_blank" style="text-decoration:none;"><?php echo JText::_('COM_MINIORANGE_OAUTH_KNOW_MORE');?></a></p>
                    
                </div>
            </div>
        </div>  
        <div class="mo_boot_col-sm-12 mo_boot_my-3 mo_boot_text-center">
            <a class="mo_boot_btn mo_boot_btn-primary" href="<?php echo JURI::root().'administrator/index.php?option=com_miniorange_oauth&view=accountsetup&tab-panel=addon';?>"><?php echo JText::_('COM_MINIORANGE_OAUTH_MORE_ADD_ONS');?></a>
        </div>
    </div>
    <?php
}

function mo_oauth_addon()
{
    global $license_tab_link;
    ?>
    <div class="mo_boot_row mo_boot_my-3 tab_box_style">
        <div class="mo_boot_col-sm-12 mo_boot_text-center mo_boot_mt-3">
            <h3><?php echo JText::_('COM_MINIORANGE_OAUTH_ADD_ON');?></h3>
            <hr>
        </div>
        <div class="mo_boot_col-sm-12 mo_boot_my-3">
            <div class="mo_boot_row mo_boot_m-2">
            <div class="mo_boot_col-sm-4 mo_boot_my-2 add_on_box" style="min-height:120px!important;">
                    <div class="mo_boot_row w-100 h-100 mo_boot_text-center">
                        <div class="mo_boot_col-sm-12">
                            <img  style="margin-top:2em;" alt="" src="<?php  echo JURI::root(); ?>administrator/components/com_miniorange_oauth/assets/images/discord.png" width="100px" height="100px">
                            <h3 style="margin-top:1em;"><?php echo JText::_('COM_MINIORANGE_OAUTH_DISCORD_ROLE_MAPPING_ADD_ON');?></h3>
                            <p class="mo_boot_text-justify"><?php echo JText::_('COM_MINIORANGE_OAUTH_DISCORD_ROLE_MAPPING_ADD_ON_DESCRIPTION');?><a href="https://www.miniorange.com/contact" class= "mo_boot_py-0" target="_blank" style="text-decoration:none;"><?php echo JText::_('COM_MINIORANGE_OAUTH_KNOW_MORE');?></a></p>
                        </div>
                    </div>
                </div>
                <div class="mo_boot_col-sm-4 mo_boot_my-2 add_on_box" style="min-height:120px!important;">
                    <div class="mo_boot_row mo_boot_w-100 mo_boot_h-100 mo_boot_text-center">
                        <div class="mo_boot_col-sm-12">
                            <img style="margin-top:2em;" src="<?php echo JURI::root(); ?>administrator/components/com_miniorange_oauth/assets/images/deploy-quickly.webp" width="120px" height="100px">
                            <h3 style="margin-top:1em;"><?php echo JText::_('COM_MINIORANGE_OAUTH_AZURE_SYNC_ADD_ON');?></h3>
                            <p class="mo_boot_text-justify"><?php echo JText::_('COM_MINIORANGE_OAUTH_AZURE_SYNC_ADD_ON_DESCRIPTION');?> <a href="https://plugins.miniorange.com/joomla-user-provisioning-with-azure" target="_blank" class="mo_boot_py-0" style="text-decoration:none;"><?php echo JText::_('COM_MINIORANGE_OAUTH_KNOW_MORE');?></a></p>
                        </div>
                    </div>
                </div>
                <div class="mo_boot_col-sm-4 mo_boot_my-2 add_on_box" style="min-height:120px!important;">
                    <div class="mo_boot_row w-100 h-100 mo_boot_text-center">
                        <div class="mo_boot_col-sm-12">
                            <img style="margin-top:2em;" src="<?php echo JURI::root(); ?>administrator/components/com_miniorange_oauth/assets/images/attribute.webp" width="100px" height="100px">
                            <h3 style="margin-top:1em;"><?php echo JText::_('COM_MINIORANGE_OAUTH_KEYCLOAK_USER_SYNC_ADD_ON');?></h3>
                            <p class="mo_boot_text-justify"><?php echo JText::_('COM_MINIORANGE_OAUTH_KEYCLOAK_USER_SYNC_ADD_ON_DESCRIPTION');?> <a href="https://plugins.miniorange.com/user-sync-between-joomla-and-keycloak" target="_blank" class="mo_boot_py-0" style="text-decoration:none;"><?php echo JText::_('COM_MINIORANGE_OAUTH_KNOW_MORE');?></a></p>
                        </div>
                    </div>
                </div>
                <div class="mo_boot_col-sm-4 mo_boot_my-2 add_on_box" style="min-height:120px!important;">
                    <div class="mo_boot_row w-100 h-100 mo_boot_text-center">
                        <div class="mo_boot_col-sm-12">
                            <img style="margin-top:2em;" alt="" src="<?php  echo JURI::root(); ?>administrator/components/com_miniorange_oauth/assets/images/miniorange.png" width="100px" height="100px">
                            <h3 style="margin-top:1em;"><?php echo JText::_('COM_MINIORANGE_OAUTH_SWEET_ALERT_ADD_ON');?></h3>
                            <p class="mo_boot_text-justify"><?php echo JText::_('COM_MINIORANGE_OAUTH_SWEET_ALERT_ADD_ON_DESCRIPTION');?> <a href="https://plugins.miniorange.com/joomla-sweet-alert" class="mo_boot_py-0" target="_blank" style="text-decoration:none;"><?php echo JText::_('COM_MINIORANGE_OAUTH_KNOW_MORE');?></a></p>              
                        </div>
                    </div>
                </div>
            
                <div class="mo_boot_col-sm-4 mo_boot_my-2 add_on_box" style="min-height:120px!important;">
                    <div class="mo_boot_row w-100 h-100 mo_boot_text-center">
                        <div class="mo_boot_col-sm-12">
                            <img style="margin-top:2em;" src="<?php  echo JURI::root(); ?>administrator/components/com_miniorange_oauth/assets/images/scim-icon.png" width="100px" height="100px">
                            <h3 style="margin-top:1em;"><?php echo JText::_('COM_MINIORANGE_OAUTH_SCIM_ADD_ON');?></h3>
                            <p class="mo_boot_text-justify"><?php echo JText::_('COM_MINIORANGE_OAUTH_SCIM_ADD_ON_DESCRIPTION');?> <a href="https://plugins.miniorange.com/joomla-scim-user-provisioning" class="mo_boot_py-0" target="_blank" style="text-decoration:none;"><?php echo JText::_('COM_MINIORANGE_OAUTH_KNOW_MORE');?></a></p>
                        </div>
                    </div>
                </div>
                <div class="mo_boot_col-sm-4 mo_boot_my-2 add_on_box" style="min-height:120px!important;">
                    <div class="mo_boot_row w-100 h-100 mo_boot_text-center">
                        <div class="mo_boot_col-sm-12">
                            <img style="margin-top:2em;" src="<?php echo JURI::root(); ?>administrator/components/com_miniorange_oauth/assets/images/page-restriction.png" width="100px" height="100px">
                            <h3 style="margin-top:1em;"><?php echo JText::_('COM_MINIORANGE_OAUTH_PAGE_AND_ARTICLE_RESTRICTION_ADD_ON');?></h3>
                            <p class="mo_boot_text-justify"><?php echo JText::_('COM_MINIORANGE_OAUTH_PAGE_AND_ARTICLE_RESTRICTION_DESCRIPTION');?> <a href="https://plugins.miniorange.com/page-and-article-restriction-for-joomla" target="_blank" class="mo_boot_py-0" style="text-decoration:none;"><?php echo JText::_('COM_MINIORANGE_OAUTH_KNOW_MORE');?></a></p>
                        </div>
                    </div>
                </div>
                <div class="mo_boot_col-sm-4 mo_boot_my-2 add_on_box" style="min-height:120px!important;">
                    <div class="mo_boot_row w-100 h-100 mo_boot_text-center">
                        <div class="mo_boot_col-sm-12">
                            <img style="margin-top:2em;" src="<?php echo JURI::root(); ?>administrator/components/com_miniorange_oauth/assets/images/attribute.webp" width="100px" height="100px">
                            <h3 style="margin-top:1em;"><?php echo JText::_('COM_MINIORANGE_OAUTH_ROLE_BASED_RESTRICTION_ADD_ON');?></h3>
                            <p class="mo_boot_text-justify"><?php echo JText::_('COM_MINIORANGE_OAUTH_ROLE_BASED_RESTRICTION_ADD_ON_DESCRIPTION');?> <a href="https://plugins.miniorange.com/role-based-redirection-for-joomla" target="_blank" class="mo_boot_py-0" style="text-decoration:none;"><?php echo JText::_('COM_MINIORANGE_OAUTH_KNOW_MORE');?></a></p>
                        </div>
                    </div>
                </div>
                <div class="mo_boot_col-sm-4 mo_boot_my-2 add_on_box" style="min-height:120px!important;">
                    <div class="mo_boot_row  w-100 h-100 mo_boot_text-center">
                        <div class="mo_boot_col-sm-12">
                            <img style="margin-top:2em;" src="<?php echo JURI::root(); ?>administrator/components/com_miniorange_oauth/assets/images/session-management-addon.webp" width="100px" height="100px">
                            <h3 style="margin-top:1em;"><?php echo JText::_('COM_MINIORANGE_OAUTH_SESSION_MANAGEMENT_ADD_ON');?></h3>
                            <p class="mo_boot_text-justify"><?php echo JText::_('COM_MINIORANGE_OAUTH_SESSION_MANAGEMENT_ADD_ON_DESCRIPTION');?> <a href="https://plugins.miniorange.com/joomla-session-management" target="_blank" class="mo_boot_py-0" style="text-decoration:none;"><?php echo JText::_('COM_MINIORANGE_OAUTH_KNOW_MORE');?></a></p>  
                        </div>
                    </div>
                </div>
                <div class="mo_boot_col-sm-4 mo_boot_my-2 add_on_box" style="min-height:120px!important;">
                    <div class="mo_boot_row w-100 h-100 mo_boot_text-center">
                        <div class="mo_boot_col-sm-12">
                            <img style="margin-top:2em;" src="<?php echo JURI::root(); ?>administrator/components/com_miniorange_oauth/assets/images/login-audit-addon.webp" width="100px" height="100px">
                            <h3 style="margin-top:1em;"><?php echo JText::_('COM_MINIORANGE_OAUTH_LOGIN_AUDIT_ADD_ON');?></h3>
                            <p class="mo_boot_text-justify"><?php echo JText::_('COM_MINIORANGE_OAUTH_LOGIN_AUDIT_ADD_ON_DESCRIPTION');?> <a href="https://plugins.miniorange.com/joomla-login-audit-login-activity-report" target="_blank" class="mo_boot_py-0" style="text-decoration:none;"><?php echo JText::_('COM_MINIORANGE_OAUTH_KNOW_MORE');?></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} 

function mo_oauth_support($buttonIndex = "")
{
    global $license_tab_link;
    ?>
    <div class="mo_boot_row mo_boot_mr-1 mo_boot_mb-3 mo_boot_mt-3 tab_box_style">
        <?php
            $current_user = JFactory::getUser();
            $result = MoOAuthUtility::getCustomerDetails();
            $admin_email = empty(trim($result['email']))?$current_user->email:$result['email'];
            $user_email= new MoOauthCustomer();
            $result=$user_email->getAccountDetails();
            if($result['contact_admin_email']!=NULL)
            {
                $admin_email =$result['contact_admin_email'];
            }
            $admin_phone = $result['admin_phone'];
        ?>
        <form name="f" style="width:100%;" method="post" action="<?php echo JRoute::_('index.php?option=com_miniorange_oauth&view=accountsetup&task=accountsetup.contactUs'); ?>">
            <div class="mo_boot_col-sm-12 mo_boot_mt-3">
                <h3><?php echo JText::_('COM_MINIORANGE_OAUTH_CONTACT_US');?></h3>
                <hr>
            </div>
            <div class="mo_boot_col-sm-12 mo_boot_mt-3">
                <p style="background-color: #e2e6ea; padding: 10px;"><?php echo JText::_('COM_MINIORANGE_OAUTH_CONTACT_US_DETAILS');?></p>
                <br>
            </div>
            <div class="mo_boot_col-sm-12">
                <div class="mo_boot_row">
                    <div class="mo_boot_col-sm-3">
                        <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_EMAIL');?>:<span style="color: red;">*</span></strong>
                    </div>
                    <div class="mo_boot_col-sm-9">
                        <input type="email" class="mo_boot_form-control oauth-table mo_oauth_textbox" style="width:100%" name="query_email" value="<?php echo $admin_email; ?>" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_EMAIL_PLACEHOLDER');?>" required />
                    </div>
                </div>
                <div class="mo_boot_row mo_boot_mt-3">
                    <div class="mo_boot_col-sm-3"> <strong><?php echo JText::_('COM_MINIORANGE_OAUTH_MOBILE_NO');?>:</strong></div>
                    <div class="mo_boot_col-sm-9">
                        <input type="number" class="mo_boot_form-control oauth-table mo_oauth_textbox" style="width:100%" name="query_phone" value="<?php echo $admin_phone; ?>" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_MOBILE_NO_PLACEHOLDER');?>"/>
                    </div>
                </div>
                <div class="mo_boot_row mo_boot_mt-3">
                    <div class="mo_boot_col-sm-3"><strong><?php echo JText::_('COM_MINIORANGE_OAUTH_QUERY');?></strong><span style="color: red;">*</span></div>
                    <div class="mo_boot_col-sm-9">
                        <textarea name="query" class="mo_oauth_textbox" style="width:100%" cols="52" rows="6" placeholder="<?php echo JText::_('COM_MINIORANGE_OAUTH_QUERY_PLACEHOLDER');?>" required></textarea>
                    </div>
                </div>
                <div class="mo_boot_row mo_boot_mt-2">
					<div class="mo_boot_col-sm-3"></div>
						<div class="mo_boot_col-sm-9">
							<input id="mo_oauth_query_withconfig"  type="checkbox" name="mo_oauth_query_withconfig" value="1" > <?php echo JText::_('COM_MINIORANGE_OAUTH_SEND_CONFIGURATION');?>
					</div>
				</div>
                <div class="mo_boot_row mo_boot_my-3 mo_boot_text-center">
                    <div class="mo_boot_col-sm-12">
                        <input type="submit" name="send_query" value="<?php echo JText::_('COM_MINIORANGE_OAUTH_SUBMIT_QUERY');?>" class="mo_boot_btn mo_boot_btn-success"/>
                    </div>
                </div>
            </div>
        </form>
        <div hidden id="mo_oauth_feedback_overlay"></div>
        <br/>
    </div>
    <?php
}

function mo_oauth_licensing_plan()
{
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from($db->quoteName('#__miniorange_oauth_customer'));
    $query->where($db->quoteName('id')." = 1");
    $db->setQuery($query);
    $useremail = $db->loadAssoc();
    global $license_tab_link;

    if(isset($useremail))
        $user_email =$useremail['email'];
    else
        $user_email="xyz";
	?>
    <div id="myModal" class="modal">
        <div class="modal-content mo_boot_text-center">
            <span class="close" onclick="upgradeClose()">&times;</span><br><br><br>
            <p style="font-size:20px;line-height:30px;">You Need to Login / Register in Account Setup tab to Upgrade your License </p>
            <br><br>
            <a href="<?php echo JURI::base()?>index.php?option=com_miniorange_oauth&view=accountsetup&tab-panel=account" class="btn btn-primary">LOGIN / REGISTER</a>
        </div>
    </div>

    <div class="mo_boot_row" style="background-color:#e0e0d8 ">
	    <div class="mo_boot_row mo_boot_m-1 mo_boot_my-4 mo_OAuth_box">
	        <div class="mo_boot_col-sm-12 mo_boot_my-4">
 		        <div id="mo_oauth_liciensing_table_wrapper" class="mo_boot_my-4" style="background: #dff8d9;">
			        <h2 class="mo_oauth_feature_comparision mo_boot_py-2" id="mo_oauth_target_license"><?php echo JText::_('COM_MINIORANGE_OAUTH_UPGRADE_PLANS');?></h2>
		        </div>
            	<br>
		        <div class="mo_oauth_pricing_wrapper">
                    <div class="mo_oauth_pricing_table">
                        <div class="mo_oauth_pricing_table_content">
        	                <div class="mo_oauth_pricing_table_price">
                                <h4 class="mo_boot_my-3 mo_boot_py-1"><strong>Basic Plan</strong></h4>
                            </div>    
                            <div class="mo_oauth_pricing_table_head mo_boot_my-4">
                                <p style="color:red;height:120px" class="mo_oauth_pricing_table_title" style='height:100px'>END OF YEAR OFFER<br>+<br>UNLIMITED USER AUTHENTICATION <br><br></p>
                            </div> 
                            <div class="mo_oauth_pricing_table_price_value">   
                                <h4 class="mo_boot_my-4"><strong>$99</strong></h4>
                            </div>
                        
                            <ul><?php echo JText::_('COM_MINIORANGE_FEATURE_COMPARISION_BASIC_PLAN_FEATURES');?></ul>
                            <div class="mo_oauth_sign-up">
					            <input type="button" onclick= "window.open('https://www.miniorange.com/contact')" target="_blank" value="Buy Now"  class="btn bordered radius" />
                            </div>
                        </div>
                    </div>
                    <div class="mo_oauth_pricing_table">
                        <div class="mo_oauth_pricing_table_content">
        	                <div class="mo_oauth_pricing_table_price">
                                <h4 class="mo_boot_my-3 mo_boot_py-1"><strong><?php echo JText::_('COM_MINIORANGE_FEATURE_COMPARISION_STANDARD_PLAN');?></strong></h4>
                            </div>    
                            <div class="mo_oauth_pricing_table_head mo_boot_my-4">
                                <p style="color:red; height:120px" class="mo_oauth_pricing_table_title">BASIC ATTRIBUTE MAPPING<br>+<br>UNLIMITED USER AUTHENTICATION <br><br></p>
                            </div> 
                            <div class="mo_oauth_pricing_table_price_value">   
                                <h4 class="mo_boot_my-4"><strong><?php echo JText::_('COM_MINIORANGE_STANDARD');?></strong></h4>
                            </div>
                        
                            <ul><?php echo JText::_('COM_MINIORANGE_FEATURE_COMPARISION_STANDARD_PLAN_FEATURES');?></ul>
                            <div class="mo_oauth_sign-up">
					            <input type="button" onclick= "window.open('https://login.xecurify.com/moas/login?redirectUrl=https://login.xecurify.com/moas/initializepayment&requestOrigin=joomla_oauth_client_standard_plan')" target="_blank" value="Buy Now"  class="btn bordered radius" />
                            </div>
                        </div>
                    </div>
 
                    <div class="mo_oauth_pricing_table">
                        <div class="mo_oauth_pricing_table_content">
        	                <div class="mo_oauth_pricing_table_price">
                                <h4 class="mo_boot_my-3 mo_boot_py-1"><strong><?php echo JText::_('COM_MINIORANGE_FEATURE_COMPARISION_PREMIUM_PLAN');?></strong></h4>
                            </div>    
                            <div class="mo_oauth_pricing_table_head mo_boot_my-4">
                                <p style="color:red; height:120px" class="mo_oauth_pricing_table_title">ADVANCED ATTRIBUTE MAPPING<br>+<br>ADVANCED GROUP MAPPING<br><br></p>
                            </div> 
                            <div class="mo_oauth_pricing_table_price_value">   
                                <h4 class="mo_boot_my-4"><strong><?php echo JText::_('COM_MINIORANGE_FEATURE_COMPARISION_PREMIUM_COST');?></strong></h4>
                            </div>
                        
                            <ul><?php echo JText::_('COM_MINIORANGE_FEATURE_COMPARISION_PREMIUM_FEATURES');?></ul>
                            <div class="mo_oauth_sign-up">
                            <input type="button" onclick="window.open('https://login.xecurify.com/moas/login?redirectUrl=https://login.xecurify.com/moas/initializepayment&requestOrigin=joomla_oauth_client_premium_plan')" target="_blank" value="Buy Now"  class="btn bordered radius" />
                            </div>
                        </div>
                    </div>
 
 
                    <div class="mo_oauth_pricing_table">   
                        <div class="mo_oauth_pricing_table_content">
        	                <div class="mo_oauth_pricing_table_price">
                                <h4 class="mo_boot_my-3 mo_boot_py-1"><strong><?php echo JText::_('COM_MINIORANGE_FEATURE_COMPARISION_ENTERPRISE_PLAN');?></strong></h4>
                            </div>    
                            <div class="mo_oauth_pricing_table_head mo_boot_my-4">
                                <p style="color:red;height:120px" class="mo_oauth_pricing_table_title" style='height:100px'>MULTIPLE GRANT TYPES<br>+<br>ADD ONS<br><br></p>
                            </div> 
                            <div class="mo_oauth_pricing_table_price_value">   
                                <h4 class="mo_boot_my-4"><strong><?php echo JText::_('COM_MINIORANGE_FEATURE_COMPARISION_ENTERPRISE_PLAN_COST');?></strong></h4>
                            </div>
                        
                            <ul><?php echo JText::_('COM_MINIORANGE_FEATURE_COMPARISION_ENTERPRISE_FEATURES');?></ul>
                            <div class="mo_oauth_sign-up">
                                <input type="button" onclick= "window.open('https://login.xecurify.com/moas/login?redirectUrl=https://login.xecurify.com/moas/initializepayment&requestOrigin=joomla_oauth_client_enterprise_plan')" target="_blank" value="Buy Now"  class="btn bordered radius" />
                            </div>
                        </div>         
                    </div>         
                </div>
	            <br><br>
                
                <div style="background: #dff8d9;">
			        <br><h2 style="text-align:center"><?php echo JText::_('COM_MINIORANGE_UPGRADE_TO_PREMIUM');?></h2><hr>
			        <section id="mo_oauth_section-steps" >
            	        <div class="mo_boot_col-sm-12 mo_boot_row ">
                	        <div class=" mo_boot_col-sm-6 mo_oauth_works-step" style="padding-left: 40px">
                    	        <div style="padding-top:1%"><strong>1</strong></div>
                                <p><?php echo JText::_('COM_MINIORANGE_UPGRADE_STEP1');?></p>
                            </div>
                            <div class="mo_boot_col-sm-6 mo_oauth_works-step">
                                <div style="padding-top:1%"><strong>4</strong></div>
                                <p><?php echo JText::_('COM_MINIORANGE_UPGRADE_STEP4');?></p>
                            </div>            
                        </div>

                        <div class="mo_boot_col-sm-12 mo_boot_row">
                            <div class=" mo_boot_col-sm-6 mo_oauth_works-step" style="padding-left: 40px">
                                <div style="padding-top:1%"><strong>2</strong></div>
                                <p> <?php echo JText::_('COM_MINIORANGE_UPGRADE_STEP2-1');?> 
						        <a href="<?php echo JURI::base()?>index.php?option=com_miniorange_oauth&view=accountsetup&tab-panel=account">
						        <?php echo JText::_('COM_MINIORANGE_HERE');?> </a>
						        <?php echo JText::_('COM_MINIORANGE_UPGRADE_STEP2-2');?></p>
                            </div>
                            <div class="mo_boot_col-sm-6 mo_oauth_works-step">
                                <div style="padding-top:1%"><strong>5</strong></div>
                                <p><?php echo JText::_('COM_MINIORANGE_UPGRADE_STEP5');?> </p>
                            </div>         
                        </div>

                        <div class="mo_boot_col-sm-12 mo_boot_row ">
                            <div class="mo_boot_col-sm-6 mo_oauth_works-step" style="padding-left: 40px">
                                <div style="padding-top:1%"><strong>3</strong></div>
                                <p><?php echo JText::_('COM_MINIORANGE_UPGRADE_STEP3');?></p>
                            </div>
                            <div class=" mo_boot_col-sm-6 mo_oauth_works-step">
                                <div style="padding-top:1%"><strong>6</strong></div>
                                <p><?php echo JText::_('COM_MINIORANGE_UPGRADE_STEP6');?></p>
                            </div>       
                        </div> 
                    </section>        
                </div>
    	
		        <div class="mo_oauth-plan-title" id="mo_oauth_instance">
			        <?php echo JText::_('COM_MINIORANGE_INSTANCE');?>
		        </div>
	
		        <div class="mo_boot_my-4 mo_boot_py-1" style="background:white;">
			        <h2 style="text-align:center; font-family: 'Comfortaa', sans-serif;"><?php echo JText::_('COM_MINIORANGE_PAYMENT_METHODS');?></h2><hr>
			        <div class="mo_boot_row mo_boot_my-4" style="margin-left:8%">							
				        <div class="mo_boot_mx-4 mo_oauth_payment_options mo_boot_col-sm-3">
            		        <div class="mo_oauth_adv_table-header" style="color:black" >
                		        <em style="font-size:40px;" class="fa fa-cc-amex" aria-hidden="true"></em>
                		        <em style="font-size:40px;" class="mo_boot_mx-2 fa fa-cc-visa" aria-hidden="true"></em>
						        <em style="font-size:40px;" class="fa fa-cc-mastercard" aria-hidden="true"></em>
					        </div>
					        <p class="mo_boot_py-4"><?php echo JText::_('COM_MINIORANGE_PAYMENT_METHODS_CARD_DETAILS');?></p>
            		        <br><br>
        		        </div>

				        <div class="mo_boot_mx-4 mo_oauth_payment_options mo_boot_col-sm-3">
            		        <div class="mo_oauth_adv_table-header" >
                                <img class="payment-images"  src="<?php echo JUri::base();?>/components/com_miniorange_oauth/assets/images/paypal.png" alt="" style="width:50px;height:50px;">
					        </div>
					        <p class="mo_boot_py-4"><?php echo JText::_('COM_MINIORANGE_PAYMENT_METHODS_PAYPAL_DETAILS');?></p>
            		        <br><br>
        		        </div>

				        <div class="mo_boot_mx-4 mo_oauth_payment_options mo_boot_col-sm-3">
            		        <div class="mo_oauth_adv_table-header" >
						        <img class="mo_oauth_payment-images card-image" src="" alt=""> 
            			        <em style="font-size:30px;color:black;" class="fa fa-university" aria-hidden="true"><span style="font-size: 20px;font-weight:500;">&nbsp;&nbsp;	<?php echo JText::_('COM_MINIORANGE_PAYMENT_METHODS_BANK_TRANSFER');?></span></em>                             
					        </div>
					        <p class="mo_boot_py-4"><?php echo JText::_('COM_MINIORANGE_PAYMENT_METHODS_BANK_TRANSFER_DETAILS');?></p>
            		        <br><br>
        		        </div>
			        </div>
		        </div> 
			
		
		        <div class="mo_oauth-plan-title ">	
			        <h3><?php echo JText::_('COM_MINIORANGE_END_TO_END_INTEGRATION');?></h3><hr>
                    <?php echo JText::_('COM_MINIORANGE_SET_UP_CALL');?>	
		        </div>

		        <div class="mo_oauth-plan-title ">
			        <h3><?php echo JText::_('COM_MINIORANGE_RETURN_POLICY');?></h3><hr>
                    <section class="return-policy">
                        <p style="font-size:16px;">	<?php echo JText::_('COM_MINIORANGE_RETURN_POLICY_DETAILS');?></p>    
                    </section>
		        </div>
            </div>
        </div>	
    </div>	
	<?php
}
