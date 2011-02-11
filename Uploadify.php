<?php

$wgExtensionCredits["other"][] = array(
	"name" => "Uploadify Extension",
	"author" => "Tobias Strebitzer",
	"version" => "0.2.0",
	"url" => "http://www.strebitzer.at",
	"description" => "uploadify-desc"
 );

$wgHooks['SkinBuildSidebar'][] = 'tsUploadifyBox';

$dir = dirname(__FILE__) . '/';
$wgAvailableRights[] = 'uploadify';
$wgSpecialPages['UploadifyHandler'] = 'UploadifyHandler';
$wgAutoloadClasses['UploadifyHandler'] = $dir . "UploadifyHandler.php";
$wgExtensionMessagesFiles['Uploadify'] = $dir . 'Uploadify.i18n.php';


function tsUploadifyBox( $skin, &$bar ) {
  	global $wgScriptPath, $wgOut, $wgUser;

	if ( !$wgUser->isAllowed( 'uploadify' ) ) {
		return true;
	}

	// Add Scripts
	$wgOut->addScript("<script language='javascript' type='text/javascript' src='$wgScriptPath/extensions/Uploadify/public/jquery-1.5.min.js'></script>");
	$wgOut->addScript("<script language='javascript' type='text/javascript' src='$wgScriptPath/extensions/Uploadify/public/swfobject.js'></script>");
	$wgOut->addScript("<script language='javascript' type='text/javascript' src='$wgScriptPath/extensions/Uploadify/public/jquery.uploadify.v2.1.4.min.js'></script>");
	
	// Add Init Script

	$script  = "$(document).ready(function() {";
	$script .= "$('#uploadify').uploadify({";
	$script .= "'uploader'  : '/extensions/Uploadify/public/uploadify.swf',";
	$script .= "'cancelImg' : '/extensions/Uploadify/public/cancel.png',";
	$script .= "'script'    : '/Special:UploadifyHandler',";
	$script .= "'folder'    : '/uploads',";
	$script .= "'auto'      : true,";
	$script .= "'multi'     : true,";
	$script .= "'buttonText': '" . wfMsg('uploadify-button-text') . "',";
	$script .= "'removeCompleted': false,";
	$script .= "'scriptData': { 'username': wgUserName },";
	$script .= "'onComplete': function(event, id, fileObj, response, data) { $(\"div#uploadify\"+id).html(\"<div class='uploadify-mediawiki-result'>\" + response + \"</div>\"); }";
	$script .= "});";
	$script .= "});";
	
	$wgOut->addScript("<script language='javascript' type='text/javascript'>$script</script>");

	
	// Add Css
	$wgOut->addScript("<link rel='stylesheet' type='text/css' href='$wgScriptPath/extensions/Uploadify/public/uploadify.css' media='all'>");

	$out  = "<div style='padding: 12px 6px;'>";
	$out .= "<input id='uploadify' name='uploadify' type='file' />";
	$out .= '</div>';
	$out .= "<div class='uploadify-file-list-link'><a href='/Special:ListFiles' target='_parent'>";
	$out .= wfMsg('uploadify-file-list');
	$out .= "</a>";
 
	$bar['Upload'] = $out;
	return true;
}

?>