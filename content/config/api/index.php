<?php 

$url = "https://admin.igportals.tk/cmsapi/api/index.php";
$data = file_get_contents($url);
$JSON = json_decode($data, true, JSON_UNESCAPED_UNICODE);

$id = $JSON['id'];
$title = $JSON['title'];
$version = $JSON['version'];
$changelog = $JSON['changelog'];
$isnewest = $JSON['isnewest'];
$file = $JSON['file'];

echo "<b>ID:</b> ".$id."<br><b>TITLE:</b> ".$title."<br><b>VERSION:</b> ".$version."<br><b>CHANGELOG:</b> ".$changelog. "<br><b>ISNEWEST:</b> ".$isnewest." <br><b>File:</b> ".$file."";