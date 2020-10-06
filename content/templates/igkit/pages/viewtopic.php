<?php

include("../layout/header.php");

$stmt = $db->prepare('UPDATE topics SET views=views + 1 WHERE id=:id');
$stmt->execute(array(':id' => $_GET["id"]));

$stmtf = $db->prepare('SELECT * FROM topics WHERE id=:id');
$stmtf->execute(array(':id' => $_GET["id"]));
$rowf = $stmtf->fetch(PDO::FETCH_ASSOC);

if (!$stmtf->execute()) {
	print_r($stmtf->errorInfo());
}

$stmtc = $db->prepare('SELECT * FROM forums WHERE id=:id');
$stmtc->execute(array(':id' => $rowf["forumID"]));
$rowc = $stmtc->fetch(PDO::FETCH_ASSOC);

if (!$stmtc->execute()) {
	print_r($stmtc->errorInfo());
}

$stmttt = $db->prepare('SELECT * FROM topics_r WHERE topicID=:id');
$stmttt->execute(array(':id' => $_GET["id"]));
$rowt = $stmttt->fetch(PDO::FETCH_ASSOC);

if (!$stmttt->execute()) {
	print_r($stmttt->errorInfo());
}

if (empty($_GET["id"])){
	header("Location: forums.php?action=idnotfound");
}

if(isset($_POST['submit'])){
	if (empty($_POST['descr'])) {
			return header("Location: viewtopic.php?action=emptymessage&id=".$_GET["id"]."");
		}
	$descr = $_POST['descr'];
	$date = time();

		$idget2 = insertDB("topics_r", "topicID,authorID,descr,time", "'".$_GET["id"]."', '".$_SESSION["memberID"]."', '".$descr."', '".$date."'");

		header("Location: viewtopic?action=respcreated&id=".$_GET['id']."");

}

?>
<main role="main" class="container">

	<div class="container py-5 text-center">
    <div class="jumbotron text-white jumbotron-image shadow" style="background-image: url(/assets/img/bg0.jpg">
      <h2 class="mb-4">
        <?php echo $siteTitle; ?>
      </h2>
      <p class="mb-4">
        <?php echo $dbd["forum_forum"]; ?>
      </p>
    </div>
  </div>

<div class="container">
	<div id="blog" class="row"> 
		<div class="col-md-12">
			<h4><?php echo $rowf["name"]; ?></h4>
			<span><a href="forums"><?php echo $mk["forum"]; ?></a> / <a href="viewforum?id=<?php echo $rowc["id"]; ?>"><?php echo $rowc["name"]; ?></a> / <?php echo $rowf["name"]; ?></span>
			<br><br>
			<?php
				$permis = getperm('canmoderateforum')["canmoderateforum"];
				if ($permis == 0) {
					echo '';
				} else if ($permis == 1) {
					if($rowf["locked"] == 0){
						echo '<a href="actions?action=lock&id='.$_GET["id"].'&type=1"><button type="button" class="btn btn-danger">'.$actions["close"].'</button></a>';
					} else {
						echo '<a href="actions?action=lock&id='.$_GET["id"].'&type=0"><button type="button" class="btn btn-success">'.$actions["open"].'</button></a>';
					}
					if($rowf["pinned"] == 0){
						echo ' <a href="actions?action=pin&id='.$_GET["id"].'&type=1"><button type="button" class="btn btn-primary">'.$actions["mark"].'</button></a>';
					} else {
						echo ' <a href="actions?action=pin&id='.$_GET["id"].'&type=0"><button type="button" class="btn btn-warning">'.$actions["unmark"].'</button></a>';
					}
				} else {
				echo 'Error, group permission error.';
				}
			?>
			<br /><br />
			<?php
			while ($rowt = $stmttt->fetch(PDO::FETCH_ASSOC)) {
				$stmta = $db->prepare('SELECT email, avatar, username, groupID FROM members WHERE memberID=:memberID');
				$stmta->execute(array(':memberID' => $rowt["authorID"]));
				$rowa = $stmta->fetch(PDO::FETCH_ASSOC);

				$usergroupIDt = $rowa["groupID"];

				if($usergroupIDt == 0){
					$lvl = $l["user"];
				} else {
					$stmtgr3 = $db->prepare('SELECT * FROM groups WHERE id=:id');
					$stmtgr3->execute(array(':id' => $usergroupIDt));
					$rowgr3 = $stmtgr3->fetch(PDO::FETCH_ASSOC);

					$grrn3 = $rowgr3['title'];
					$grrc3 = $rowgr3['color'];
					$lvl3 = '<span style="color:'.$grrc3.'">'.$grrn3.'</span>';
				}

				if ($rowa['avatar'] == "gravatar") {

					$emailr = $rowa['email'];;
					$default = "".$siteurl."img/default.png";
					$size = 100;

					$grav_urlr = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emails ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

				} else {

					$grav_urlr = '../../../uploads/ua/'.$rowa['avatar'].'';

				}
				
				$rdate = date("d.m.Y H:i", $rowt["time"]);
			
				echo '
					<div class="message">
                            <img alt="" class="img-circle medium-image" src="'.$grav_urlr.'">

                            <div class="message-body">
                                <div class="message-info">
                                    <h4> '.$lvl3.' '.$rowa["username"].'</h4>
                                    <h5> <i class="fa fa-clock-o"></i> '.$rdate.' </h5>
                                </div>
                                <hr>
                                <div class="message-text">
                                    '.$rowt["descr"].'
                                </div>
                            </div>
							<a href="viewtopic?id='.$_GET["id"].'&action=citate&cid='.$rowt["id"].'"><button class="btn btn-info pull-right" style="margin-top:10px">'.$l["citate"].'</button></a>
                            <br>
                        </div>
				';
			}
			?>
			<?php 
				if($user->is_logged_in()){
					if($_GET["action"] == 'citate'){
					 $stmtci = $db->prepare('SELECT * FROM topics_r WHERE id=:id');
					 $stmtci->execute(array(':id' => $_GET["cid"]));
					 $rowci = $stmtci->fetch(PDO::FETCH_ASSOC);

					 $stmtcim = $db->prepare('SELECT * FROM members WHERE memberID=:id');
					 $stmtcim->execute(array(':id' => $rowci["authorID"]));
					 $rowcim = $stmtcim->fetch(PDO::FETCH_ASSOC);

					 $r2mdate = date("d.m.Y H:i", $rowci["time"]);

					 $citate = '
					 <div style="background:#eeeeee; border:1px solid #cccccc; padding:5px 10px"><em>'.$rowcim["username"].' '.$mk["said_on"].'  '.$r2mdate.'</em></div>

					 <div style="background:#eeeeee; border:1px solid #cccccc; padding:5px 10px"><em>'.$rowci["descr"].'</em></div>

					 ';
				 } else {
					 $citate = '';
				 }
				 if($rowf["locked"] == 1){
					$textarea = '<p>'.$l["topiclocked"].'</p>';
				} else {
					$textarea = '
					
						<textarea name="descr" id="editor1" rows="10" cols="80" class="send-message-text">
							'.$citate.'
						</textarea>
						<script>
								// Replace the <textarea id="editor1"> with a CKEditor 4
								// instance, using default configuration.
								CKEDITOR.replace( "editor1" );
						</script>
					
					
					<button name="submit" type="submit" class="send-message-button btn-info"> <i class="fa fa-send"></i> </button>
					';
				}

				echo '
				<p>
				<div class="chat-footer">
						<form method="post">
							'.$textarea.'
						</form>
                    </div>
					</p>';
				}
			?>
		</div>
	</div>
</div>
  
<?php 
  require_once("../layout/footer.php");
?>