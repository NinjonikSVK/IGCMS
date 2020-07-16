<?php

/*-------------------------------------------------------+
| Content Management System
| http://www.phphelptutorials.com/
+--------------------------------------------------------+
| Author: David Carr  Email: dave@daveismyname.co.uk
+--------------------------------------------------------+*/

if (!defined('included')){
die('You cannot access this file directly!');
}

//log user in ---------------------------------------------------
function login($user, $pass){

   //strip all tags from varible
   $user = strip_tags(mysql_real_escape_string($user));
   $pass = strip_tags(mysql_real_escape_string($pass));

   $pass = md5($pass);

   // check if the user id and password combination exist in database
   $sql = "SELECT * FROM members WHERE username = '$user' AND password = '$pass'";
   $result = mysql_query($sql) or die('Query failed. ' . mysql_error());

   if (mysql_num_rows($result) == 1) {
      // the username and password match,
      // set the session
	  $_SESSION['authorized'] = true;

	  // direct to admin
      header('Location: '.DIRADMIN);
	  exit();
   } else {
	// define an error message
	$_SESSION['error'] = 'Sorry, wrong username or password';
   }
}

// Authentication
function logged_in() {
	if($_SESSION['authorized'] == true) {
		return true;
	} else {
		return false;
	}
}

function login_required() {
	if(logged_in()) {
		return true;
	} else {
		header('Location: '.DIRADMIN.'login.php');
		exit();
	}
}

function logout(){
	unset($_SESSION['authorized']);
	header('Location: '.DIRADMIN.'login.php');
	exit();
}

// Render error messages
function messages() {
    $message = '';
    if($_SESSION['success'] != '') {
        $message = '<div class="msg-ok">'.$_SESSION['success'].'</div>';
        $_SESSION['success'] = '';
    }
    if($_SESSION['error'] != '') {
        $message = '<div class="msg-error">'.$_SESSION['error'].'</div>';
        $_SESSION['error'] = '';
    }
    echo "$message";
}

function errors($error){
	if (!empty($error))
	{
			$i = 0;
			while ($i < count($error)){
			$showError.= "<div class=\"msg-error\">".$error[$i]."</div>";
			$i ++;}
			echo $showError;
	}// close if empty errors
} // close function

// FUNKCIE

function getfromDB($data, $table) {
	global $db;

	$stmt = $db->prepare('SELECT '.$data.' FROM '.$table.'');
	$stmt->execute(array());
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$stmt->execute()) {
		print_r($stmt->errorInfo());
	}

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result = $row;
		return $result;
	}

	// $row = getfromDB("pageID, pageTitle", "pages");

}

function getfromDBw($data, $table, $where, $what) {
	global $db;

	$stmt = $db->prepare('SELECT '.$data.' FROM '.$table.' WHERE '.$where.'='.$what.'');
	$stmt->execute(array());
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$stmt->execute()) {
		print_r($stmt->errorInfo());
	}

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		return $row;
	}

	// $row = getfromDBw("pageID, pageTitle", "pages", "pageID", $id);

}

function getperm($perm) {
	global $db;
	global $usergroupID;

	$stmtg = $db->prepare('SELECT '.$perm.' FROM groups WHERE id="'.$usergroupID.'"');
	$stmtg->execute(array());
	$rowg = $stmtg->fetch(PDO::FETCH_ASSOC);

	if (!$stmtg->execute()) {
		print_r($stmtg->errorInfo());
	}

	while ($rowg = $stmtg->fetch(PDO::FETCH_ASSOC)) {
		return $rowg;
	}

	// $row = getfromDBw("pageID, pageTitle", "pages", "pageID", $id);

}

function insertDB($table, $data, $values2) {
	global $db;

	$stmt = $db->prepare('INSERT INTO '.$table.' ('.$data.') VALUES ('.$values2.')');
	$stmt->execute(array());
	$idget = $db->lastInsertId();
	return $idget;

}

function updateDB($table, $values, $where) {
	global $db;

	$stmt = $db->prepare('UPDATE '.$table.' SET '.$values.' WHERE '.$where.'');
	$stmt->execute(array());

	// $row = getfromDBw("pageID, pageTitle", "pages", "pageID", $id);

}

?>
