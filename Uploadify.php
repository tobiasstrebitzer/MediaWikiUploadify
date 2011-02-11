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
$wgSpecialPages['UploadifyHandler'] = 'UploadifyHandler';
$wgAutoloadClasses['UploadifyHandler'] = $dir . "UploadifyHandler.php";
$wgExtensionMessagesFiles['Uploadify'] = $dir . 'Uploadify.i18n.php';

function tsUploadifyBox( $skin, &$bar ) {
  	global $wgScriptPath, $wgOut;

	// Add Scripts
	$wgOut->addScript("<script language='javascript' type='text/javascript' src='$wgScriptPath/extensions/Uploadify/public/jquery-1.5.min.js'></script>");
	$wgOut->addScript("<script language='javascript' type='text/javascript' src='$wgScriptPath/extensions/Uploadify/public/swfobject.js'></script>");
	$wgOut->addScript("<script language='javascript' type='text/javascript' src='$wgScriptPath/extensions/Uploadify/public/jquery.uploadify.v2.1.4.min.js'></script>");
	$wgOut->addScript("<script language='javascript' type='text/javascript' src='$wgScriptPath/extensions/Uploadify/public/init.js'></script>");
	
	// Add Css
	$wgOut->addScript("<link rel='stylesheet' type='text/css' href='$wgScriptPath/extensions/Uploadify/public/uploadify.css' media='all'>");

	$out = "<div style='padding: 12px 6px;'>";
	$out .= "<input id='uploadify' name='uploadify' type='file' />";
	$out .= '</div>';
	$out .= "<div class='uploadify-file-list-link'><a href='/Special:ListFiles' target='_parent'>uploadify-file-list</a>";
 
	$bar['Upload'] = $out;
	return true;
}

?>