<?php 
  require_once("../layout/header.php");
  
	//check if already logged in move to home page
	if( $user->is_logged_in() ){ header('Location: index.php'); exit(); }

?>
<main role="main" class="container">
	<div class="container py-5 text-center">
		<div class="jumbotron text-white jumbotron-image shadow" style="background-image: url('../../../../assets/img/bg0.jpg');>
			<h2 class="mb-4">
				<?php echo $siteTitle; ?>
			</h2>
			<p class="mb-4">
				<?php echo $l["registerpage"] ?>
			</p>
		</div>
	</div>
<div class="container">
	<div class="text-center"> 
		<form class="form-signin" role="form" method="post" action="" autocomplete="off">
		  <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
		  <h1 class="h3 mb-3 font-weight-normal"><?php echo $l["registerpage"] ?></h1>
		  <?php
			
			if(isset($_POST['submit'])){

												if (!isset($_POST['username'])) $error[] = $l['pleasefillalla'];
												if (!isset($_POST['email'])) $error[] = $l['pleasefillalla'];
												if (!isset($_POST['password'])) $error[] = $l['pleasefillalla'];

												$username = $_POST['username'];

												//very basic validation
												if(!$user->isValidUsername($username)){
													$error[] = $l['3chara'];
												} else {
													$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
													$stmt->execute(array(':username' => $username));
													$row = $stmt->fetch(PDO::FETCH_ASSOC);

													if(!empty($row['username'])){
														$error[] = $l['usernameused'];
													}

												}

												if(strlen($_POST['password']) < 3){
													$error[] = $l['3charapass'];
												}

												if(strlen($_POST['passwordConfirm']) < 3){
													$error[] = $l['3charapass'];
												}

												if($_POST['password'] != $_POST['passwordConfirm']){
													$error[] = $l['passesnotsame'];
												}

												//email validation
												$email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
												if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
													$error[] = $l['notvalidemail'];
												} else {
													$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
													$stmt->execute(array(':email' => $email));
													$row = $stmt->fetch(PDO::FETCH_ASSOC);

													if(!empty($row['email'])){
														$error[] = $l['emailused'];
													}

												}

												//if no errors have been created carry on
												if(!isset($error)){

													//hash the password
													$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

													if(empty($siteemail)){
														$activasion = 'Yes';
													} 
													else {
														$activasion = md5(uniqid(rand(),true));
													}
													

													$date = time();

													try {

														//insert into database with a prepared statement
														$stmt = $db->prepare('INSERT INTO members (username,password,email,active,Level,avatar,time) VALUES (:username, :password, :email, :active, 0, :avatar, :time)');
														$stmt->execute(array(
															':username' => $username,
															':password' => $hashedpassword,
															':email' => $email,
															':active' => $activasion,
															':avatar' => 'gravatar',
															':time' => $date
														));
														$id = $db->lastInsertId('memberID');

														//send email
														$to = $_POST['email'];
														$subject = $l['regcompl'];
														$message = '
														<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
														<html style="width:100%;font-family:lato, helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;">
														<head>
														<meta charset="UTF-8">
														<meta content="width=device-width, initial-scale=1" name="viewport">
														<meta name="x-apple-disable-message-reformatting">
														<meta http-equiv="X-UA-Compatible" content="IE=edge">
														<meta content="telephone=no" name="format-detection">
														<title>New email</title>
														<!--[if (mso 16)]>
														<style type="text/css">
														a {text-decoration: none;}
														</style>
														<![endif]-->
														<!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
														<!--[if !mso]><!-- -->
														<link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i" rel="stylesheet">
														<!--<![endif]-->
														<style type="text/css">
														@media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:16px!important; line-height:150%!important } h1 { font-size:30px!important; text-align:center; line-height:120%!important } h2 { font-size:26px!important; text-align:center; line-height:120%!important } h3 { font-size:20px!important; text-align:center; line-height:120%!important } h1 a { font-size:30px!important } h2 a { font-size:26px!important } h3 a { font-size:20px!important } .es-menu td a { font-size:16px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button { font-size:20px!important; display:block!important; border-width:15px 25px 15px 25px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } .es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }
														#outlook a {
														padding:0;
														}
														.ExternalClass {
														width:100%;
														}
														.ExternalClass,
														.ExternalClass p,
														.ExternalClass span,
														.ExternalClass font,
														.ExternalClass td,
														.ExternalClass div {
														line-height:100%;
														}
														.es-button {
														mso-style-priority:100!important;
														text-decoration:none!important;
														}
														a[x-apple-data-detectors] {
														color:inherit!important;
														text-decoration:none!important;
														font-size:inherit!important;
														font-family:inherit!important;
														font-weight:inherit!important;
														line-height:inherit!important;
														}
														.es-desk-hidden {
														display:none;
														float:left;
														overflow:hidden;
														width:0;
														max-height:0;
														line-height:0;
														mso-hide:all;
														}
														</style>
														</head>
														<body style="width:100%;font-family:lato, helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;">
														<div class="es-wrapper-color" style="background-color:#F4F4F4;">
														<!--[if gte mso 9]>
														<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
														<v:fill type="tile" color="#f4f4f4"></v:fill>
														</v:background>
														<![endif]-->
														<table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
														<tr class="gmail-fix" height="0" style="border-collapse:collapse;">
														<td style="padding:0;Margin:0;">
														<table width="600" cellspacing="0" cellpadding="0" border="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
														<tr style="border-collapse:collapse;">
														<td cellpadding="0" cellspacing="0" border="0" style="padding:0;Margin:0;line-height:1px;min-width:600px;" height="0"><img src="https://esputnik.com/repository/applications/images/blank.gif" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;max-height:0px;min-height:0px;min-width:600px;width:600px;" alt width="600" height="1"></td>
														</tr>
														</table></td>
														</tr>
														<tr style="border-collapse:collapse;">
														<td valign="top" style="padding:0;Margin:0;">
														<table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;">
														<tr style="border-collapse:collapse;">
														<td align="center" style="padding:0;Margin:0;">
														<table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
														<tr style="border-collapse:collapse;">
														<td align="left" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:15px;padding-bottom:15px;">
														<!--[if mso]><table width="580" cellpadding="0" cellspacing="0"><tr><td width="282" valign="top"><![endif]-->
														<table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;">
														<tr style="border-collapse:collapse;">
														<td width="282" align="left" style="padding:0;Margin:0;">
														 <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
														   <tr style="border-collapse:collapse;">
														    <td class="es-infoblock es-m-txt-c" align="left" style="padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:arial, helvetica, sans-serif;line-height:14px;color:#CCCCCC;"><br></p></td>
														   </tr>
														 </table></td>
														</tr>
														</table>
														<!--[if mso]></td><td width="20"></td><td width="278" valign="top"><![endif]-->
														<table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;">
														<tr style="border-collapse:collapse;">
														<td width="278" align="left" style="padding:0;Margin:0;">
														 <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
														   <tr style="border-collapse:collapse;">
														    <td align="right" class="es-infoblock es-m-txt-c" style="padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:lato, helvetica, arial, sans-serif;line-height:14px;color:#CCCCCC;"><a href="https://viewstripo.email" class="view" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, helvetica, sans-serif;font-size:12px;text-decoration:underline;color:#CCCCCC;">Stripo</a></p></td>
														   </tr>
														 </table></td>
														</tr>
														</table>
														<!--[if mso]></td></tr></table><![endif]--></td>
														</tr>
														</table></td>
														</tr>
														</table>
														<table class="es-header" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:#FFA73B;background-repeat:repeat;background-position:center top;">
														<tr style="border-collapse:collapse;">
														<td align="center" style="padding:0;Margin:0;">
														<table class="es-header-body" width="600" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
														<tr style="border-collapse:collapse;">
														<td align="left" style="Margin:0;padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:20px;">
														<table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
														<tr style="border-collapse:collapse;">
														<td width="580" valign="top" align="center" style="padding:0;Margin:0;">
														 <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
														   <tr style="border-collapse:collapse;">
														    <td align="center" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:25px;padding-bottom:25px;font-size:0;"><img src="https://fzzscn.stripocdn.email/content/guids/CABINET_3df254a10a99df5e44cb27b842c2c69e/images/7331519201751184.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="40"></td>
														   </tr>
														 </table></td>
														</tr>
														</table></td>
														</tr>
														</table></td>
														</tr>
														</table>
														<table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;">
														<tr style="border-collapse:collapse;">
														<td style="padding:0;Margin:0;background-color:#FFA73B;" bgcolor="#ffa73b" align="center">
														<table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
														<tr style="border-collapse:collapse;">
														<td align="left" style="padding:0;Margin:0;">
														<table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
														<tr style="border-collapse:collapse;">
														<td width="600" valign="top" align="center" style="padding:0;Margin:0;">
														 <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FFFFFF;border-radius:4px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" role="presentation">
														   <tr style="border-collapse:collapse;">
														    <td align="center" style="Margin:0;padding-bottom:5px;padding-left:30px;padding-right:30px;padding-top:35px;"><h1 style="Margin:0;line-height:58px;mso-line-height-rule:exactly;font-family:lato, helvetica, arial, sans-serif;font-size:48px;font-style:normal;font-weight:normal;color:#111111;">'.$siteTitle.'</h1></td>
														   </tr>
														   <tr style="border-collapse:collapse;">
														    <td bgcolor="#ffffff" align="center" style="Margin:0;padding-top:5px;padding-bottom:5px;padding-left:20px;padding-right:20px;font-size:0;">
														     <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
														       <tr style="border-collapse:collapse;">
														        <td style="padding:0;Margin:0px;border-bottom:1px solid #FFFFFF;background:rgba(0, 0, 0, 0) none repeat scroll 0% 0%;height:1px;width:100%;margin:0px;"></td>
														       </tr>
														     </table></td>
														   </tr>
														 </table></td>
														</tr>
														</table></td>
														</tr>
														</table></td>
														</tr>
														</table>
														<table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;">
														<tr style="border-collapse:collapse;">
														<td align="center" style="padding:0;Margin:0;">
														<table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
														<tr style="border-collapse:collapse;">
														<td align="left" style="padding:0;Margin:0;">
														<table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
														<tr style="border-collapse:collapse;">
														<td width="600" valign="top" align="center" style="padding:0;Margin:0;">
														 <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:4px;background-color:#FFFFFF;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" role="presentation">
														   <tr style="border-collapse:collapse;">
														    <td class="es-m-txt-l" bgcolor="#ffffff" align="left" style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:30px;padding-right:30px;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, helvetica, arial, sans-serif;line-height:27px;color:#666666;">'.$l["regcomple"].' '.$siteTitle.' <b>'.$username.'</b>!</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, helvetica, arial, sans-serif;line-height:27px;color:#666666;">'.$l["youmustactivate"].'</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, helvetica, arial, sans-serif;line-height:27px;color:#666666;"></p></td>
														   </tr>
														   <tr style="border-collapse:collapse;">
														    <td align="center" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:35px;padding-bottom:35px;"><span class="es-button-border" style="border-style:solid;border-color:#FFA73B;background:1px;border-width:1px;display:inline-block;border-radius:2px;width:auto;"><a href="'.$siteurl.'content/templates/materialkit/pages/activate.php?x='.$id.'&y='.$activasion.'" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, arial, verdana, sans-serif;font-size:20px;color:#FFFFFF;border-style:solid;border-color:#FFA73B;border-width:15px 30px;display:inline-block;background:#FFA73B;border-radius:2px;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center;"> '.$l["verifyaccount"].'</a></span></td>
														   </tr>
														   <tr style="border-collapse:collapse;">
														    <td class="es-m-txt-l" align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:30px;padding-right:30px;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, helvetica, arial, sans-serif;line-height:27px;color:#666666;">'.$l["buttonnotworking"].'</p></td>
														   </tr>
														   <tr style="border-collapse:collapse;">
														    <td class="es-m-txt-l" align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:30px;padding-right:30px;"><a target="_blank" href="'.$siteurl.'content/templates/materialkit/pages/activate.php?x='.$id.'&y='.$activasion.'" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:lato, helvetica, arial, sans-serif;font-size:18px;text-decoration:underline;color:#FFA73B;">'.$siteurl.'content/templates/materialkit/pages/activate.php?x='.$id.'&y='.$activasion.'</a></td>
														   </tr>
														   <tr style="border-collapse:collapse;">
														    <td class="es-m-txt-l" align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:30px;padding-right:30px;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, helvetica, arial, sans-serif;line-height:27px;color:#666666;">'.$l["if_you_bla"].'</p></td>
														   </tr>
														   <tr style="border-collapse:collapse;">
														    <td class="es-m-txt-l" align="left" style="Margin:0;padding-top:20px;padding-left:30px;padding-right:30px;padding-bottom:40px;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, helvetica, arial, sans-serif;line-height:27px;color:#666666;">'.$l["regards"].',</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, helvetica, arial, sans-serif;line-height:27px;color:#666666;">'.$siteTitle.' '.$l["team"].'.</p></td>
														   </tr>
														 </table></td>
														</tr>
														</table></td>
														</tr>
														</table></td>
														</tr>
														</table>
														<table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;">
														<tr style="border-collapse:collapse;">
														<td align="center" style="padding:0;Margin:0;">
														<table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" width="600" cellspacing="0" cellpadding="0" align="center">
														<tr style="border-collapse:collapse;">
														<td align="left" style="padding:0;Margin:0;">
														<table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
														<tr style="border-collapse:collapse;">
														<td width="600" valign="top" align="center" style="padding:0;Margin:0;">
														 <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
														   <tr style="border-collapse:collapse;">
														    <td align="center" style="Margin:0;padding-top:10px;padding-bottom:20px;padding-left:20px;padding-right:20px;font-size:0;">
														     <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
														       <tr style="border-collapse:collapse;">
														        <td style="padding:0;Margin:0px;border-bottom:1px solid #F4F4F4;background:rgba(0, 0, 0, 0) none repeat scroll 0% 0%;height:1px;width:100%;margin:0px;"></td>
														       </tr>
														     </table></td>
														   </tr>
														 </table></td>
														</tr>
														</table></td>
														</tr>
														</table></td>
														</tr>
														</table></td>
														</tr>
														</table>
														</div>
														</body>
														</html>
														';

														// Always set content-type when sending HTML email
														$headers = "MIME-Version: 1.0" . "\r\n";
														$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

														// More headers
														$headers .= 'From: <'.$siteemail.'>' . "\r\n";

														mail($to,$subject,$message,$headers);

														//redirect to index page
														header('Location: index.php?action=joined');
														exit;

													//else catch the exception and show the error.
													} catch(PDOException $e) {
														$error[] = $e->getMessage();
													}

												}

											}


										if(isset($error)){
											foreach($error as $error){
												echo '<p class="bg-danger">'.$error.'</p>';
											}
										}

										//if action is joined show sucess
										if(isset($_GET['action']) && $_GET['action'] == 'joined'){
											echo "<h2 class='bg-success'>".$l["register_done"]."</h2>";
										}
			
			?>
		  <div class="form-group">
			<label for="topicname"><?php echo $l["username"]; ?></label>
			<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="" id="topicname" name="username">
		  </div>
		  <div class="form-group">
			<label for="topicname"><?php echo $l["email-adress"]; ?></label>
			<input type="email" class="form-control" aria-describedby="emailHelp" placeholder="" id="topicname" name="email">
		  </div>
		  <div class="form-group">
			<label for="topicname"><?php echo $l["password"]; ?></label>
			<input type="password" class="form-control" aria-describedby="emailHelp" placeholder="" id="topicname" name="password">
		  </div>
		  <div class="form-group">
			<label for="topicname"><?php echo $l["passwordc"]; ?></label>
			<input type="password" class="form-control" aria-describedby="emailHelp" placeholder="" id="topicname" name="passwordConfirm">
		  </div>
		  <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit"><?php echo $l["registerpage"] ?></button>
		</form>
    </div>
</div>

    
    
    
<?php 
  require_once("../layout/footer.php");
?>