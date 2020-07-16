<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

file_put_contents("test_im.zip", fopen("https://admin.igportals.tk/ud/uploads/languages.zip", 'r'));

// assuming file.zip is in the same directory as the executing script.
$file = 'test_im.zip';

// get the absolute path to $file
$path = pathinfo(realpath($file), PATHINFO_DIRNAME);

$zip = new ZipArchive;
$res = $zip->open('test_im.zip');
if ($res === TRUE) {
    $zip->extractTo($path);
    $zip->close();
    echo 'ok';
	unlink("test_im.zip");
} else {
    echo 'failed';
}

