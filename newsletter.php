<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/newsletter/newsletter.php
Version=100
Updated=2006-jul-09
Type=Plugin
Author=riptide
Description=A classic newsletter plugin (unbound to the LDU user system)
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=newsletter
Part=main
File=newsletter
Hooks=standalone
Order=10
Tags=
[END_SED_EXTPLUGIN]

==================== */

if ( !defined('SED_CODE') ) { die("Wrong URL."); }

$a = sed_import('a','P','TXT');
$m = sed_import('m','G','TXT');
$nletter_email = sed_import('nletter_email','P','TXT');
$activate = sed_import('activate','G','ALP');
$cancel = sed_import('cancel','G','ALP');
$email = sed_import('email','G','TXT');

$plugin_title = "<a href=\"plug.php?e=newsletter\">".$L['plu_title']."</a>";

//clean the inactive registrations (after the time specified in the config panel)
$clean_date = $sys['now_offset'] - ($cfg['plugin']['newsletter']['cleandelay'] * 86400);
$sql = sed_sql_query("DELETE FROM sed_newsletter WHERE nletter_date < '".$clean_date."' AND nletter_active = '0'");
//

if ($activate != "")
	{
	$sql = sed_sql_query("UPDATE sed_newsletter SET nletter_active = '1' WHERE nletter_activation = '".$activate."' AND nletter_email = '".$email."'");
	$plugin_body  = "<p style=\"text-align:center;\">".$L['plu_email_activated']."</p>";
	}

if ($cancel != "")
	{
	$sql = sed_sql_query("DELETE FROM sed_newsletter WHERE nletter_activation = '".$cancel."' AND nletter_email = '".$email."'");
	$plugin_body  = "<p style=\"text-align:center;\">".$L['plu_deleted']."</p>";
	}

if ($a == $L['plu_join'])
	{
	$nletter_email = strtolower($nletter_email);
	$nletter_activation =  md5(microtime());

	$sql = sed_sql_query("SELECT nletter_activation, nletter_active FROM sed_newsletter WHERE nletter_email='".$nletter_email."'");
	$exist = sed_sql_numrows($sql);

	if  ($exist > 0)
		{ $row =  sed_sql_fetcharray($sql); }

	$error_string .= (strlen($nletter_email)<4 || !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$",$nletter_email)) ? $L['plu_email_invalid']."<br />" : '';
	$error_string .= ($row['nletter_active'] == 1) ? $L['plu_email_exists']."<br />" : '';

	if (empty($error_string))
		{
        if (isset($row['nletter_active']))
            {
            $nletter_activation = $cfg['mainurl']."/plug.php?e=newsletter&email=".$nletter_email."&activate=".$row['nletter_activation'];
            }
        else
            {
            $sql = sed_sql_query("INSERT INTO sed_newsletter (nletter_email, nletter_date, nletter_activation) values ('$nletter_email', '".$sys['now']."', '$nletter_activation')");

            $nletter_activation = $cfg['mainurl']."/plug.php?e=newsletter&email=".$nletter_email."&activate=".$nletter_activation;
            }

        $nlsubject = $L['plu_amail_subject'];
        $nlbody = sprintf($L['plu_amail_body'], $nletter_activation);
        sed_mail ($nletter_email, $nlsubject, $nlbody);

        $plugin_body  = "<p style=\"text-align:center;\">".$L['plu_joined']."</p>";
		}
	}
elseif ($a == $L['plu_cancel'])
	{
	$sql = sed_sql_query("SELECT nletter_activation FROM sed_newsletter WHERE nletter_email='$nletter_email' LIMIT 1");

	$error_string .= (sed_sql_numrows($sql) != 1) ? $L['plu_email_cancelfailed']."<br />" : '';

	if (empty($error_string))
		{
        $row=sed_sql_fetcharray($sql);

        $nletter_cancel = $cfg['mainurl']."/plug.php?e=newsletter&email=".$nletter_email."&cancel=".$row['nletter_activation'];

        $nlsubject = $L['plu_cmail_subject'];
        $nlbody = sprintf($L['plu_cmail_body'], $nletter_cancel);
        sed_mail ($nletter_email, $nlsubject, $nlbody);

        $plugin_body  = "<p style=\"text-align:center;\">".$L['plu_canceled']."</p>";
		}
	}
	
if (empty($plugin_body))
	{
	$plugin_body .= $L['plu_intro'];
	$plugin_body .= ($error_string) ? "<p><span style=\"color:red;\">".$error_string."</span></p>" : "";
	$plugin_body .= "<form name='newsletter' action='plug.php?e=newsletter' method='post'>";
	$plugin_body .= "<p>".$L['plu_email'].":<input type=\"text\" name=\"nletter_email\" value=\"\" size=\"36\" maxlength=\"64\">";
	$plugin_body .= "<input type='submit' name='a' value='".$L['plu_join']."'>";
	$plugin_body .= "<input type='submit' name='a' value='".$L['plu_cancel']."'></p>";
	$plugin_body .= "</form>";
	}

?>
