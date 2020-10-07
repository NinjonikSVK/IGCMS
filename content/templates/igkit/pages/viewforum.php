<?php 
if (empty($_GET["id"])){
	header("Location: forums.php?action=idnotfound");
}

include("../layout/header.php");

$stmtf = $db->prepare('SELECT * FROM forums WHERE id=:id ORDER BY sortn');
$stmtf->execute(array(':id' => $_GET["id"]));
$rowf = $stmtf->fetch(PDO::FETCH_ASSOC);

if (!$stmtf->execute()) {
	print_r($stmtf->errorInfo());
}
?>
<main role="main" class="container">

	<div class="container py-5 text-center">
    <div class="jumbotron text-white jumbotron-image shadow" style="background-image: url('../../../../assets/img/bg0.jpg');>
      <h2 class="mb-4">
        <?php echo $siteTitle; ?>
      </h2>
      <p class="mb-4">
        <?php echo $dbd["forum_forum"]; ?>
      </p>
    </div>
  </div>

<div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
				<div class="forum-title">
                    <h3><?php echo $rowf["name"]; ?></h3>
										<a href="createtopic?id=<?php echo $_GET["id"]; ?>"><button class="btn btn-primary btn-round">
										  <?php echo $mk["forum_create_topic"]; ?>
										</button></a>
                </div>
				<?php
					$stmtp = $db->prepare('SELECT * FROM forums WHERE parent=:id ORDER BY sortn');
					$stmtp->execute(array(':id' => $_GET["id"]));
					$rowp = $stmtp->fetch(PDO::FETCH_ASSOC);

					if (!$stmtp->execute()) {
						print_r($stmtp->errorInfo());
					}
					while ($rowp = $stmtp->fetch(PDO::FETCH_ASSOC)) {
						$pocetviews = $db->query("SELECT SUM(views) FROM topics WHERE forumID='".$rowp["id"]."'")->fetchColumn();
						$pocettopics = $db->query("SELECT count(*) FROM topics WHERE forumID='".$rowp["id"]."'")->fetchColumn();

						$stmtti = $db->prepare('SELECT id FROM topics WHERE forumID=:forumID');
						$stmtti->execute(array(':forumID' => $rowp["id"]));
						$rowti = $stmtti->fetch(PDO::FETCH_ASSOC);
						if (!$stmtti->execute()) {
							print_r($stmtti->errorInfo());
						}
						$pochet = 0;
						while ($rowti = $stmtti->fetch(PDO::FETCH_ASSOC)) {
							foreach ($rowti as $valueid){
								$pocetposts = $db->query("SELECT COUNT(*) FROM topics_r WHERE topicID='".$valueid."'")->fetchColumn();
								$pochet = $pochet + $pocetposts;
							}
						}
						$stmttif = $db->prepare('SELECT id FROM forums WHERE parent=:forumID');
						$stmttif->execute(array(':forumID' => $rowp["id"]));
						$rowtif = $stmttif->fetch(PDO::FETCH_ASSOC);
						if (!$stmttif->execute()) {
							print_r($stmttif->errorInfo());
						}
						$pocetviews1 = $db->query("SELECT SUM(views) FROM topics WHERE forumID='".$rowp["id"]."'")->fetchColumn();
						$pocettopics1 = $db->query("SELECT count(*) FROM topics WHERE forumID='".$rowp["id"]."'")->fetchColumn();

						$pochet2 = 0;
						$pochet3 = 0;
						$pochet4 = 0;

						while ($rowtif = $stmttif->fetch(PDO::FETCH_ASSOC)) {
							foreach ($rowtif as $valueid3){
								$pocetviews2 = $db->query("SELECT SUM(views) FROM topics WHERE forumID='".$valueid3."'")->fetchColumn();
								$pochet3 = $pochet3 + $pocetviews2;
							}
							foreach ($rowtif as $valueid9){
								$pocettopics2 = $db->query("SELECT count(*) FROM topics WHERE forumID='".$valueid9."'")->fetchColumn();
								$pochet4 = $pochet4 + $pocettopics2;
							}
							foreach ($rowtif as $valueid3){
								$stmtti2 = $db->prepare('SELECT id FROM topics WHERE forumID=:forumID');
								$stmtti2->execute(array(':forumID' => $valueid3));
								$rowti2 = $stmtti2->fetch(PDO::FETCH_ASSOC);
								if (!$stmtti2->execute()) {
									print_r($stmtti2->errorInfo());
								}
								while ($rowti2 = $stmtti2->fetch(PDO::FETCH_ASSOC)) {
									foreach ($rowti2 as $valueid2){
										$pocetposts2 = $db->query("SELECT COUNT(*) FROM topics_r WHERE topicID='".$valueid2."'")->fetchColumn();
										$pochet2 = $pochet2 + $pocetposts2;
									}
								}
							}
						}
						$pocetviews = $pocetviews1 + $pochet3;
						$pocettopics = $pocettopics1 + $pochet4;
						$pochet3 = $pochet + $pochet2;
			echo '
					<div class="forum-item active">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="fa fa-'.$rowp["icon"].'"></i>
                            </div>
                            <a href="viewforum?id='.$rowp["id"].'" class="forum-item-title">'.$rowp["name"].'</a>
                            <div class="forum-sub-title">'.$rowp["descr"].'</div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                '.$pocetviews.'
                            </span>
                            <div>
                                <small>Views</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                '.$pocettopics.'
                            </span>
                            <div>
                                <small>Topics</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                '.$pochet3.'
                            </span>
                            <div>
                                <small>Posts</small>
                            </div>
                        </div>
                    </div>
					</div>
				';
			}
			$stmtr = $db->prepare('SELECT * FROM topics WHERE forumID=:id ORDER BY pinned DESC, locked ,date DESC');
					$stmtr->execute(array(':id' => $_GET["id"]));
					$rowr = $stmtr->fetch(PDO::FETCH_ASSOC);

					if (!$stmtr->execute()) {
						print_r($stmtr->errorInfo());
					}
			while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)) {
						$pocetview2s = $db->query("SELECT views FROM topics WHERE id='".$rowr["id"]."'")->fetchColumn();
						$pocetposts2 = $db->query("SELECT COUNT(*) FROM topics_r WHERE topicID='".$rowr["id"]."'")->fetchColumn();
						$icon = null;
						if ($rowr["pinned"]) {
							$icon = "thumb-tack";
						} else {
							$icon = "comment";
						}
			echo '
					<div class="forum-item active">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="fa fa-'.$icon.'"></i>
                            </div>
                            <a href="viewtopic?id='.$rowr["id"].'" class="forum-item-title">'.$rowr["name"].'</a>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                '.$pocetview2s.'
                            </span>
                            <div>
                                <small>Views</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                '.$pocetposts2.'
                            </span>
                            <div>
                                <small>Posts</small>
                            </div>
                        </div>
                    </div>
					</div>
				';
			}
		?>

        </div>
    </div>
</div>
</div>
  
<?php 
  require_once("../layout/footer.php");
?>