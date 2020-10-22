<?php
ob_start();
session_start();

error_reporting(0);

//set timezone
date_default_timezone_set('Europe/London');

require_once("version.php");
require_once("settings.php");

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";charset=utf8mb4;dbname=".DBNAME, DBUSER, DBPASS);
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);//Suggested to uncomment on production websites
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}


//include the user class, pass in the database connection
include('classes/user.php');
include('classes/phpmailer/mail.php');
$user = new User($db);

//define include checker
define('included', 1);

include('functions.php');

$stmt = $db->prepare('SELECT username, email, description, skills, location, memberID, Level, notes, groupID FROM members WHERE username=:username');
$stmt->execute(array(':username' => $_SESSION['username']));
$rl = $stmt->fetch(PDO::FETCH_ASSOC);

$Level = $rl['Level'];

$usergroupID = $rl["groupID"];

if($usergroupID == 0){
	$lvl = $l["user"];
} else {
	$stmtgr = $db->prepare('SELECT * FROM groups WHERE id=:id');
	$stmtgr->execute(array(':id' => $usergroupID));
	$rowgr = $stmtgr->fetch(PDO::FETCH_ASSOC);

	$grrn = $rowgr['title'];
	$grrc = $rowgr['color'];
	$lvl = '<span style="color:'.$grrc.'">'.$grrn.'</span>';
	$lvl2 = $rowgr['title'];
	$lvl2color = $rowgr['color'];
}


$stmt = $db->prepare('SELECT siteTitle, slogan, ip, port FROM settings WHERE siteID=1');
$stmt->execute(array());
$site = $stmt->fetch(PDO::FETCH_ASSOC);

$siteTitle = $site['siteTitle'];
$sl = $site['slogan'];
$serverIP = $site["ip"];
$serverPort = $site["port"];

date_default_timezone_set("Europe/Bratislava");

$stmts = $db->prepare('SELECT username, email, description, skills, location, memberID, Level, notes, avatar FROM members WHERE username=:username');
				$stmts->execute(array(':username' => $_SESSION['username']));
				$rows = $stmts->fetch(PDO::FETCH_ASSOC);

								if ($rows['avatar'] == "gravatar") {
									$emails = $rows['email'];;
									$default = "".$siteurl."img/default.png";
									$size = 160;

									$grav_urls = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emails ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
								} else {
									$grav_urls = '../../../uploads/ua/'.$rows['avatar'].'';
								}

$usern = $_SESSION['username'];

// LANGUAGE

if(isset($_GET['lang']))
{
	$lang = $_GET['lang'];
	$_SESSION['lang'] = $lang;
	setcookie("lang", $lang, time() + (3600 * 24 * 30));
}
else if(isset($_SESSION['lang']))
{
	$lang = $_SESSION['lang'];
}
else if(isset($_COOKIE['lang']))
{
	$lang = $_COOKIE['lang'];
}
else
{
	$lang = 'en';
}

switch ($lang) {
  case 'cs':
  $lang_file = 'cs.php';
  break;

  case 'sk':
  $lang_file = 'sk.php';
  break;

  default:
  $lang_file = 'en.php';

}

include_once 'languages/'.$lang_file;
?>
