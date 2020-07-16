<?php

	require_once("../../../config/config.php");

	$active = "Yes";

	$id = $_GET['id'];
	$action = $_GET['action'];

	if ($action == 'delallchat'){

		$permis = getperm('canmoderatechat')["canmoderatechat"];
		if ($permis == 0) {
			header("Location: index?type=notenoughpermissions");
		} else if ($permis == 1) {
			echo '';
		} else {
			echo 'Error, group permission error.';
		}

		echo "delallchat";

		$stmt = $db->prepare("DELETE FROM chat");
		$stmt->execute();
		if (!$stmt->execute()) {
			print_r($stmt->errorInfo());
		}
		header("Location: chat.php?action=chatdeleted");
	}
	else if ($action == 'lock'){

		$permis = getperm('canmoderateforum')["canmoderateforum"];
		if ($permis == 0) {
			header("Location: index?type=notenoughpermissions");
		} else if ($permis == 1) {
			echo '';
		} else {
			echo 'Error, group permission error.';
		}

		$type = $_GET["type"];
		if($type == "1"){
			$stmt = $db->prepare("UPDATE topics SET locked = :locked WHERE id = :id");
			$stmt->execute(array(
				':id' => $id,
				':locked' => 1
			));
		} else {
			$stmt = $db->prepare("UPDATE topics SET locked = :locked WHERE id = :id");
			$stmt->execute(array(
				':id' => $id,
				':locked' => 0
			));
		}

		header("Location: viewtopic?action=topicunorlocked&id=".$id."");
	}
	else if ($action == 'pin'){

		$permis = getperm('canmoderateforum')["canmoderateforum"];
		if ($permis == 0) {
			header("Location: index?type=notenoughpermissions");
		} else if ($permis == 1) {
			echo '';
		} else {
			echo 'Error, group permission error.';
		}

		$type = $_GET["type"];
		if($type == "1"){
			$stmt = $db->prepare("UPDATE topics SET pinned = :pinned WHERE id = :id");
			$stmt->execute(array(
				':id' => $id,
				':pinned' => 1
			));
		} else {
			$stmt = $db->prepare("UPDATE topics SET pinned = :pinned WHERE id = :id");
			$stmt->execute(array(
				':id' => $id,
				':pinned' => 0
			));
		}

		header("Location: viewtopic?action=topicunorpinned&id=".$id."");
	}
	else {
		echo "nothing";
	}


?>
