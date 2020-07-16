<?php
	require_once("../../../config/config.php");
	
	$id = $_GET['id'];
	
		$stmt = $db->prepare("SELECT fileID, fileName FROM files WHERE fileID='".$_GET['id']."'");
		$stmt->execute(array());
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if (!$stmt->execute()) {
			print_r($stmt->errorInfo());
		}
		
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$fID = $row["fileID"];
			$fN = $row["fileName"];
		}
		
	$url = '../../../uploads/'.$fN.'';
	header("Content-Type: application/octet-stream");
	header("Content-Transfer-Encoding: Binary");
	header("Content-disposition: attachment; filename=\"".$fN."\""); 
	echo readfile($url);
		
		//insert into database with a prepared statement
				$stmt22 = $db->prepare('UPDATE files SET fileDL=fileDL + 1 WHERE fileID=:fileID');
				$stmt22->execute(array(
					':fileID' => $fID
				));	
	
?>
