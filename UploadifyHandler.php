<?php

class UploadifyHandler extends SpecialPage {
	function __construct() {
		parent::__construct( 'UploadifyHandler', 'UploadifyHandler' );
	}

	function execute( $par ) {
		
		global $wgRequest, $wgOut, $wgFileExtensions, $wgUploadDirectory, $wgMaxUploadFiles;

		// Plain output
		$wgOut->setArticleBodyOnly(true);
		
		// Check if there are Files for upload
		if (!empty($_FILES)) {

			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetFile = dirname(__FILE__) . "/upload/" . $_FILES['Filedata']['name'];
			$fileParts  = pathinfo($_FILES['Filedata']['name']);
			$userName = $_POST["username"];
			
			// Check if extension is valid
			if (in_array($fileParts['extension'],$wgFileExtensions)) {

				// Copy File
				move_uploaded_file($tempFile, $targetFile);
				
				// Import File
				$result = shell_exec("php maintenance/importImages.php --user=\"$userName\" " . dirname(__FILE__) . "/upload/" . " " . implode(" ", $wgFileExtensions));
				
				// Delete File
				unlink($targetFile);				

				// Check if file exists
				if(stripos($result, "exists, skipping") !== false) {
					$wgOut->addHTML("File already exists.");
				}else{
					// Report success
					$wgOut->addHTML("<input onclick='this.select();' class='uploadify-result' type='text' value='[[File:" . ucfirst($_FILES['Filedata']['name']) . "]]' />");
				}

			} else {
				$wgOut->addHTML("Invalid file type.");
			}

		}

	}
}
