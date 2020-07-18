<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("content/config/config.php");

	$permis2 = getperm('canmanagesite')["canmanagesite"];
	if ($permis2 == 0) {
		header("Location: ../../materialkit/pages/index?type=notenoughpermissions");
	} else if ($permis2 == 1) {
		echo '';
	} else {
		echo 'Error, group permission error.';
	}

file_put_contents("version.zip", fopen("https://admin.igportals.tk/cmsapi/uploads/".$_GET['filename']."", 'r'));

// assuming file.zip is in the same directory as the executing script.
$file = 'version.zip';

// get the absolute path to $file
$path = pathinfo(realpath($file), PATHINFO_DIRNAME);

$zip = new ZipArchive;
$res = $zip->open('version.zip');
if ($res === TRUE) {
    $zip->extractTo($path);
    $zip->close();
    echo 'ok';
	unlink("version.zip");
	header("Location: content/templates/adminlte/pages/index");
} else {
    echo 'failed';
}

