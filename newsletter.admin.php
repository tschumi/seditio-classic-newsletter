<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/newsletter/newsletter.admin.php
Version=100
Updated=2006-jul-09
Type=Plugin
Author=riptide
Description=A classic newsletter plugin (unbound to the LDU user system)
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=newsletter
Part=admin
File=newsletter.admin
Hooks=tools
Tags=
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$plugin_title = $L['plu_title'];

$a = sed_import('a','G','ALP');
$b = sed_import('b','P','TXT');
$nletter_email = sed_import('nletter_email','P','TXT');
$nltitle = sed_import('nltitle','P','HTM');
$nlmessage = sed_import('nlmessage','P','HTM');

//Check the rights
$admin  = sed_auth('plug', 'newsletter', 'A');
$read   = sed_auth('plug', 'newsletter', 'R');
$write  = sed_auth('plug', 'newsletter', 'W');
//

require("plugins/newsletter/lang/newsletter.".$usr['lang'].".lang.php");

if ($a == "send" && $write == TRUE)
	{
	$sql = sed_sql_query("SELECT * FROM sed_newsletter WHERE nletter_active='1'");

	while ($row=sed_sql_fetcharray($sql))
		{
		$nletter_email = $row['nletter_email'];
		$nletter_activation = $row['nletter_activation'];

		$nletter_cancellink = $cfg['mainurl']."/plug.php?e=newsletter&email=".$nletter_email."&cancel=".$row['nletter_activation'];
		$nlmessage2 = $nlmessage."".sprintf($L['plu_newsletter_body'], $nletter_cancellink);

		sed_mail($nletter_email,$nltitle,$nlmessage2);

		unset($nlmessage2);
		}

	$plugin_body  .= "<p style=\"text-align:center;color:green;\">".$L['plu_form_sent']."</p>";
	}
elseif ($write == TRUE)
	{
  if ($a == "addorremove")
      {
      $sql = sed_sql_query("SELECT nletter_activation, nletter_active FROM sed_newsletter WHERE nletter_email='".$nletter_email."'");
      $exist = sed_sql_numrows($sql);

      if  ($exist > 0)
          { $row =  sed_sql_fetcharray($sql); }

      if ($b == $L['plu_add'])
          {
          $nletter_activation =  md5(microtime());

          $ar_error_string .= ($row['nletter_active'] == 1) ? $L['plu_email_exists']."<br />" : '';
          $ar_error_string .= (strlen($nletter_email)<4 || !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$",$nletter_email)) ? $L['plu_email_invalid']."<br />" : '';

          if (empty($ar_error_string))
              {
              $sql = sed_sql_query("INSERT INTO sed_newsletter (nletter_email, nletter_date, nletter_activation, nletter_active) values ('$nletter_email', '".$sys['now_offset']."', '$nletter_activation', '1')");
              $plugin_body  .= "<p style=\"text-align:center;\">".$L['plu_email_added']."</p>";
              }
          }
     elseif ($b == $L['plu_remove'])
          {
          $ar_error_string .= ($exist == 0) ? $L['plu_email_notexists']."<br />" : '';

          if (empty($ar_error_string))
              {
              $sql = sed_sql_query("DELETE FROM sed_newsletter WHERE nletter_email='$nletter_email'");
              $plugin_body  .= "<p style=\"text-align:center;\">".$L['plu_email_removed']."</p>";
              }
          }
      }

  $plugin_body .= "<hr>";
  $plugin_body .= "<p><strong>".$L['plu_newnewsletter']."</strong><br />";
  $plugin_body .= $L['plu_newnewsletter_hint']."</p>";

  $sql = sed_sql_query("SELECT COUNT(*) FROM sed_newsletter WHERE nletter_active='1'");
  $totalmembers = mysql_result($sql,0,"COUNT(*)");

  $sql = sed_sql_query("SELECT COUNT(*) FROM sed_newsletter WHERE nletter_active='0'");
  $totalinactive = mysql_result($sql,0,"COUNT(*)");

  $plugin_body .= "<p>".$L['plu_form_totalmembers'].": <strong>".$totalmembers."</strong>&nbsp;";

  $shr = ($a != "showreceivers") ? "&amp;a=showreceivers" : "";
  $shtr = ($a != "showreceivers") ? $L['plu_showreceivers'] : $L['plu_hidereceivers'];

  $plugin_body .= "<a href='admin.php?m=tools&amp;p=newsletter".$shr."'>".$shtr."</a>";  
  $plugin_body .= "</p>";

  if ($a == "showreceivers")
      {
      $sql = sed_sql_query("SELECT nletter_email FROM sed_newsletter WHERE nletter_active='1'");

      while ($row=sed_sql_fetcharray($sql))
          {
          $nletter_receivers .= $row['nletter_email'].", ";
          }

      $plugin_body  .= "<p>".substr($nletter_receivers, 0, -2)."</p>";
      }

  if ($totalinactive > '0')
      {
      $plugin_body .= "<p>".$L['plu_form_totalinactive'].": <strong>".$totalinactive."</strong>&nbsp;";
      
      $shi = ($a != "showinactive") ? "&amp;a=showinactive" : "";
      $shti = ($a != "showinactive") ? $L['plu_showinactive'] : $L['plu_hideinactive'];
      
      $plugin_body .= "<a href='admin.php?m=tools&amp;p=newsletter".$shi."'>".$shti."</a>&nbsp;";

      if ($a == "showinactive")
          {
          $sql = sed_sql_query("SELECT nletter_email FROM sed_newsletter WHERE nletter_active='0'");

          while ($row=sed_sql_fetcharray($sql))
              {
              $nletter_inactive .= $row['nletter_email'].", ";
              }

          $plugin_body  .= "<p>".substr($nletter_inactive, 0, -2)."</p>";
          }
      }

  $plugin_body .= "<form name='newsletter' action='admin.php?m=tools&amp;p=newsletter&amp;a=send' method=post>";
  $plugin_body .= "<p>".$L['plu_form_title'].":<br /><input type='text' name='nltitle' value='$nltitle' size='48' maxlength='64'></p>";
  $plugin_body .= "<p>".$L['plu_form_message'].":<br /><textarea name='nlmessage' rows='12' cols='80'>$nlmessage</textarea></p>";
  $plugin_body .= "<p><input type='submit' value=' ".$L['plu_form_sendbutton']." '></p></form>";

  $plugin_body .= "<hr>";

  $plugin_body .= "<p><strong>".$L['plu_addorremove']."</strong><br />";
  $plugin_body .= $L['plu_addorremove_hint']."</p>";
  $plugin_body .= ($ar_error_string) ? "<p><span style=\"color:red;\">".$ar_error_string."</span></p>" : "";
  $plugin_body .= "<form name='addorremove' action='admin.php?m=tools&amp;p=newsletter&amp;a=addorremove' method='post'>";
  $plugin_body .= "<p>".$L['plu_email'].":<input type=\"text\" name=\"nletter_email\" value=\"\" size=\"36\" maxlength=\"64\">";
  $plugin_body .= "<input type='submit' name='b' value='".$L['plu_add']."'>";
  $plugin_body .= "<input type='submit' name='b' value='".$L['plu_remove']."'></p>";
  $plugin_body .= "</form>";

  $plugin_body .= "<hr>";
	}
else
  {
  $plugin_body .= $L['plu_noaccess'];
  }

?>
