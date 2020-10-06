<?php

	require_once("../../../config/config.php");

	$active = "Yes";

	$id = $_GET['id'];
	$action = $_GET['action'];

	if ($action == 'deleteno'){
		echo "deletep";
		$stmt = $db->prepare("DELETE FROM notifications WHERE notID=:notID AND notUser=:notUser");
			$stmt->execute(array(
				':notID' => $id,
				':notUser' => $_SESSION['username']
			));
		echo $id;
		header("Location: notifications.php?action=notificationdeleted");
	}
	else if ($action == 'delallno'){
		echo "deleten";
		$stmt = $db->prepare("DELETE FROM notifications WHERE notUser=:notUser");
			$stmt->execute(array(
				':notUser' => $_SESSION['username']
			));
		echo $id;
		header("Location: notifications.php?action=notificationsdeleted");
	}
	else if ($action == 'deletet'){
		echo "deleteu";
		$stmt = $db->prepare("DELETE FROM tickets WHERE ticketID=:id AND ticketAuthor=:ticketAuthor");
			$stmt->execute(array(
				':id' => $id,
				':ticketAuthor' => $_SESSION['username']
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
		header("Location: mytickets.php?action=ticketdeleted");
	}
	else if ($action == 'liken'){
		if(!$user->is_logged_in() ){
			header('Location: index');
		} else {
			$stmtr = $db->prepare('SELECT newID FROM likes WHERE likeAuthor=:likeAuthor AND newID=:newID');
			$stmtr->execute(array(':likeAuthor' => $_SESSION['username'], ':newID' => $id));
			$rowr = $stmtr->fetch(PDO::FETCH_ASSOC);

			if(empty($rowr['newID'])){
						echo "follow3";
						$stmtl = $db->prepare('INSERT INTO likes (newID,likeAuthor) VALUES (:newID, :likeAuthor)');
						$stmtl->execute(array(
							':newID' => $id,
							':likeAuthor' => $_SESSION['username'],
						));

						$notType = 7;
						$notDate = time();
						$stmt = $db->prepare('INSERT INTO notifications (notUser,notType,notDate) VALUES (:notUser, :notType, :notDate)');
						$stmt->execute(array(
							':notUser' => $_SESSION['username'],
							':notType' => $notType,
							':notDate' => $notDate
						));

						header("Location: index.php?action=newliked");
			} else {
					$stmtd = $db->prepare("DELETE FROM likes WHERE newID=:newID AND likeAuthor=:likeAuthor");
					$stmtd->execute(array(
						':newID' => $id,
						':likeAuthor' => $_SESSION['username']
					));
				$notType = 8;
				$notDate = time();
				$stmt = $db->prepare('INSERT INTO notifications (notUser,notType,notDate) VALUES (:notUser, :notType, :notDate)');
				$stmt->execute(array(
					':notUser' => $_SESSION['username'],
					':notType' => $notType,
					':notDate' => $notDate
				));
				header ("Location: index.php?action=postunliked");
			}
			}

	}
	else if ($action == 'tag'){
		$tag = $_GET['tag'];
		if(!$user->is_logged_in() ){
			header('Location: index.php');
		} else {
			$stmtc = $db->prepare('SELECT sAuthor, '.$tag.' FROM servers WHERE serverID=:serverID');
			$stmtc->execute(array(':serverID' => $id));
			$rowc = $stmtc->fetch(PDO::FETCH_ASSOC);
			if (!$stmtc->execute()) {
				print_r($stmtc->errorInfo());
			}
			if ($rowc["sAuthor"] == $_SESSION["username"]) {
				if ($rowc["".$tag.""] == 0) {
					$stmtl = $db->prepare('UPDATE servers SET '.$tag.'=:'.$tag.' WHERE serverID=:serverID');
					$stmtl->execute(array(
						':'.$tag.'' => 1,
						':serverID' => $id
					));
					header ("Location: viewserver.php?id=".$id."&action=".$tag."set");
				} else {
					$stmtl = $db->prepare('UPDATE servers SET '.$tag.'=:'.$tag.' WHERE serverID=:serverID');
					$stmtl->execute(array(
						':'.$tag.'' => 0,
						':serverID' => $id,
					));
					header ("Location: viewserver.php?id=".$id."&action=".$tag."");
			}
			} else {
				header("Location: index.php");
			}
			}

	}
	else if ($action == 'deleterev'){
		echo "deletep";
		$stmt = $db->prepare("DELETE FROM servers_r WHERE serverID=:serverID AND recAuthor=:recAuthor");
			$stmt->execute(array(
				':serverID' => $id,
				':recAuthor' => $_SESSION['username']
			));
		echo $id;
		header("Location: viewserver.php?id=".$id."&action=reviewdeleted");
	}
	else if ($action == 'delst'){
		echo "deletep";
		$stmt = $db->prepare("DELETE FROM stocks WHERE stockID=:stockID AND creator=:creator");
			$stmt->execute(array(
				':stockID' => $id,
				':creator' => $_SESSION['username']
			));
		echo $id;
		header("Location: stocks?id=".$id."&action=stockremoved");
	}
	else {
		echo "nothing";
	}


?>
