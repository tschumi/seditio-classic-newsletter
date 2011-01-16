<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/newsletter/lang/newsletter.uk.lang.php
Version=100
Updated=2006-jul-09
Type=Plugin
Author=riptide
Description=A classic newsletter plugin (unbound to the LDU user system)
[END_SED]

==================== */

$L['plu_title']             = "Newsletter";
$L['plu_intro']             = "You want to stay informed?<br /><br />Feel free to join our newsletter. You'll receive all interesting news via email for free.<br />To get our newsletter, just fill out the form below...";
$L['plu_email']             = "Email";
$L['plu_email_activated']   = "Your emailadress has been successfully activated.<br />Now you'll receive our newsletter.";
$L['plu_joined']            = "Thank you for your interest in our newsletter.<br />For safety reasons, we sent a mail with an activationlink to your emailadress.";
$L['plu_canceled']          = "Too bad you don't want our newsletter anymore.<br />For safety reasons, we sent a mail with an deactivationlink to your emailadress.";
$L['plu_deleted']           = "Die Emailadresse wurde aus unsere Datenbank entfernt.<br />Ab sofort werden Sie unseren Newsletter nicht mehr erhalten.";
$L['plu_email_cancelfailed']= "We coulden't find your emailadress in our DB - remove failed !";
$L['plu_email_exists']      = "The emailadress you've entered is allready member of our newsletter !";
$L['plu_email_notexists']   = "The emailadress you've entered is no member of our newsletter !";
$L['plu_email_invalid']     = "This emailadress is not valid !";
$L['plu_join']              = "Join";
$L['plu_cancel']            = "Cancel";
$L['plu_newnewsletter']     = "Create a new newsletter";
$L['plu_newnewsletter_hint']= "This is the place to write the newsletter. The newsletter will be sent to all <u>active</u> members.";
$L['plu_form_totalmembers'] = "Total members of the newsletter";
$L['plu_form_totalinactive']= "Total inactive members of the newsletter";
$L['plu_showreceivers']     = "(show)";
$L['plu_showinactive']      = "(show)";
$L['plu_hidereceivers']     = "(hide)";
$L['plu_hideinactive']      = "(hide)";
$L['plu_form_title']        = "Titel";
$L['plu_form_message']      = "Message";
$L['plu_form_sendbutton']   = "Send";
$L['plu_form_sent']         = "The newsletter has been sent successfully.";
$L['plu_newsletter_body']   = "\n\n\nIf you don't want our newsletter anymore, just click the following link:\n%1\$s\n";
$L['plu_addorremove']     	= "Add or remove a member of the newsletter";
$L['plu_addorremove_hint']	= "This is the place to add or remove members to the newsletter without the need of validation via email.";
$L['plu_add']              	= "Add";
$L['plu_remove']            = "Remove";
$L['plu_email_added']      	= "Emailadress has been added.";
$L['plu_email_removed']     = "Emailadress has been removed.";
$L['plu_noaccess']          = "Access denied.";

//Mails
$L['plu_amail_subject']     = "Newsletter - Activation mail";
$L['plu_amail_body']        = "Hi\n\nIf you receive this mail, you've joined our newsletter on our website.\n\nTo finish the registration, please click on the following link:\n%1\$s\n\nIf you don't want to receive our newsletter, just delete this mail.";
$L['plu_cmail_subject']     = "Newsletter - Deactivation mail";
$L['plu_cmail_body']        = "Hi\n\nIf you receive this mail, you've canceld your newsletter membership.\n\nTo confirm this, please click on the following link:\n%1\$s\n\nIf you stil want to receive our newsletter, just delete this mail.";

//Index
$L['plu_index_intro']		= "Order our newsletter...";
$L['plu_index_linktext']	= "Join now!";

?>
