<?php

	require_once("../../../config/config.php");

	$permis = getperm('canviewdashboard')["canviewdashboard"];
	if ($permis == 0) {
		header("Location: index?type=notenoughpermissions");
	} else if ($permis == 1) {
		echo '';
	} else {
		echo 'Error, group permission error.';
	}

	$active = "Yes";

	$id = $_GET['id'];
	$action = $_GET['action'];

	if ($action == 'deletep'){
		echo "deletep";
		$permis = getperm('canmanagepages')["canmanagepages"];
		if ($permis == 0) {
			header("Location: index?type=notenoughpermissions");
		} else if ($permis == 1) {
			echo '';
		} else {
			echo 'Error, group permission error.';
		}
		$stmt = $db->prepare("DELETE FROM pages WHERE pageID=:pageID");
			$stmt->execute(array(
				':pageID' => $id
			));
		echo $id;
		header("Location: pages.php?action=pagedeleted");
	}
	if ($action == 'deleteg'){
		echo "deleteg";
		$permis = getperm('canmanagegroups')["canmanagegroups"];
		if ($permis == 0) {
			header("Location: index?type=notenoughpermissions");
		} else if ($permis == 1) {
			echo '';
		} else {
			echo 'Error, group permission error.';
		}
		$stmt = $db->prepare("DELETE FROM groups WHERE id=:id");
			$stmt->execute(array(
				':id' => $id
			));
		echo $id;
		header("Location: groups.php?action=groupdeleted");
	}
	if ($action == 'deletef'){
		echo "deleteg";
		$permis = getperm('canmanageforum')["canmanageforum"];
		if ($permis == 0) {
			header("Location: index?type=notenoughpermissions");
		} else if ($permis == 1) {
			echo '';
		} else {
			echo 'Error, group permission error.';
		}
		$stmt = $db->prepare("DELETE FROM forums WHERE id=:id");
			$stmt->execute(array(
				':id' => $id
			));
		echo $id;
		header("Location: forums.php?action=forumdeleted");
	}
	if ($action == 'file'){

		$permis = getperm('canmanagefiles')["canmanagefiles"];
		if ($permis == 0) {
			header("Location: index?type=notenoughpermissions");
		} else if ($permis == 1) {
			echo '';
		} else {
			echo 'Error, group permission error.';
		}

		$stmto = $db->prepare('SELECT fileName FROM files WHERE fileID=:fileID');
		$stmto->execute(array(':fileID' => $id));
		$ro = $stmto->fetch(PDO::FETCH_ASSOC);

		if (!$stmto->execute()) {
			print_r($stmto->errorInfo());
		}

		$subor = '../../../uploads/'.$ro['fileName'].'';
		unlink($subor);

		$stmt = $db->prepare("DELETE FROM files WHERE fileID=:fileID");
			$stmt->execute(array(
				':fileID' => $id
			));
		header("Location: files?action=filedeleted");
	}
	else if ($action == 'deleten'){
		echo "deleten";
		$permis = getperm('canmanagenews')["canmanagenews"];
		if ($permis == 0) {
			header("Location: index?type=notenoughpermissions");
		} else if ($permis == 1) {
			echo '';
		} else {
			echo 'Error, group permission error.';
		}
		$stmt = $db->prepare("DELETE FROM news WHERE newID=:id");
			$stmt->execute(array(
				':id' => $id
			));
		echo $id;
		header("Location: news.php?action=newdeleted");
	}
	else if ($action == 'deleteu'){
		$permis = getperm('canmanageusers')["canmanageusers"];
		if ($permis == 0) {
			header("Location: index?type=notenoughpermissions");
		} else if ($permis == 1) {
			echo '';
		} else {
			echo 'Error, group permission error.';
		}
		echo "deleteu";
		$stmt = $db->prepare("DELETE FROM members WHERE memberID=:id");
			$stmt->execute(array(
				':id' => $id
			));
		echo $id;
		header("Location: members.php?action=userdeleted");
	}
	else if ($action == 'verifyu'){
		$permis = getperm('canmanageusers')["canmanageusers"];
		if ($permis == 0) {
			header("Location: index?type=notenoughpermissions");
		} else if ($permis == 1) {
			echo '';
		} else {
			echo 'Error, group permission error.';
		}
		echo "verifyu";
		$stmt = $db->prepare("UPDATE members SET active = :active WHERE memberID = :id");
			$stmt->execute(array(
				':id' => $id,
				':active' => $active
			));
		echo $id;
		header("Location: members.php?action=userverified");
	}
	else if ($action == 'deletet'){
		echo "deleteu";
		$permis = getperm('canmanagetickets')["canmanagetickets"];
		if ($permis == 0) {
			header("Location: index?type=notenoughpermissions");
		} else if ($permis == 1) {
			echo '';
		} else {
			echo 'Error, group permission error.';
		}
		$stmt = $db->prepare("DELETE FROM tickets WHERE ticketID=:id AND ticketAdmin=:ticketAdmin");
			$stmt->execute(array(
				':id' => $id,
				':ticketAdmin' => $_SESSION['username']
			));
		$notType = 6;
		$notDate = time();
		$stmt = $db->prepare('INSERT INTO notifications (notUser,notType,notDate) VALUES (:notUser, :notType, :notDate)');
		$stmt->execute(array(
			':notUser' => $_SESSION['username'],
			':notType' => $notType,
			':notDate' => $notDate
		));
		echo $id;
		header("Location: atickets.php?action=ticketdeleted");
	}
	else {
		echo "nothing";
	}


?>
