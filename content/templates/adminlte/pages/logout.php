<?php require_once("../../../config/config.php");

$notType = 2;			
$notDate = time();
$stmt = $db->prepare('INSERT INTO notifications (notUser,notType,notDate) VALUES (:notUser, :notType, :notDate)');
$stmt->execute(array(
	':notUser' => $_SESSION['username'],
	':notType' => $notType,
	':notDate' => $notDate
));

//logout
$user->logout(); 

//logged in return to index page
header('Location: index.php');
exit;
?>