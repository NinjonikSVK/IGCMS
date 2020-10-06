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
<body class="index-page">
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<?
		include("../layout/navbar.php");
	?>

  <!-- Content Wrapper. Contains page content -->
  	<div class="page-header header-filter clear-filter" style="background-image: url('assets/img/bg0.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1><?php echo $siteTitle; ?>
						</h1>

						<h3 class="title"><?php echo $rowf["name"]; ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="main main-raised">
		<div class="contact-content">
    		<div class="container">
				<div class="row">
				<!-- Dizajn pre fórum -->
					<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
					<link href="test.css" rel="stylesheet">
<div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
			<div class="ibox-content forum-container">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="p-xs">
                    <h2><?php echo $rowf["name"]; ?></h2>
                    <span><a href="forums">Fórum</a> / <a href="viewforum?id=<?php echo $rowc["id"]; ?>"><?php echo $rowc["name"]; ?></a> / <?php echo $rowf["name"]; ?></span>
                </div>
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
											echo '<a href="actions?action=pin&id='.$_GET["id"].'&type=1"><button type="button" class="btn btn-primary">'.$actions["mark"].'</button></a>';
										} else {
											echo '<a href="actions?action=pin&id='.$_GET["id"].'&type=0"><button type="button" class="btn btn-warning">'.$actions["unmark"].'</button></a>';
										}
									} else {
									echo 'Error, group permission error.';
									}
								?>
            </div>
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
					<div class="media">
				<a class="pull-left" href="#pablo">
					<div class="avatar">
						<img class="media-object" src="'.$grav_urlr.'" alt="..."/>
					</div>
				</a>
				<div class="media-body">
					'.$lvl3.'<h4 class="media-heading">'.$rowa["username"].' <small>&middot; '.$rdate.'</small></h4>
					<h6 class="text-muted"></h6>

					<p>'.$rowt["descr"].'</p>
				</div>
				<div class="media-footer">
					<a href="viewtopic?id='.$_GET["id"].'&action=citate&cid='.$rowt["id"].'" class="btn btn-primary btn-simple pull-right" rel="tooltip" title="Citovať tento príspevok">
						<i class="material-icons">reply</i> '.$l["citate"].'
					</a>
				</div>
			</div>
				';
			}
			?>
			</div>
			<?php
		  if($user->is_logged_in())
			{
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
				<p>
									<textarea name="descr" id="editor1" rows="10" cols="80" class="form-control">
										'.$citate.'
									</textarea>
									<script>
											// Replace the <textarea id="editor1"> with a CKEditor 4
											// instance, using default configuration.
											CKEDITOR.replace( "editor1" );
									</script>
				</p>
				<div class="media-footer">
					<button class="btn btn-primary btn-round" name="submit">
						<i class="material-icons">edit</i> Odoslať
					</button>
				</div>
				';
			}
			echo '
			<form method="post">
			<div class="ibox-content forum-container">
			<div class="media">
				<a class="pull-left" href="#pablo">
					<div class="avatar">
						<img class="media-object" src="'.$grav_urls.'" alt="..."/>
					</div>
				</a>
				<div class="media-body">
					<h6 class="text-muted"></h6>

					'.$textarea.'
				</div>
			</div>
			</div>
			</form>';
			}
			else {
				echo '';
			}
			?>
        </div>
    </div>
</div>
</div>
               </div>
            </div>
		</div>
    </div>

  <!-- /.content-wrapper -->

<?php

include("../layout/footer.php");

?>
