<?php 
  require_once("../layout/header.php");
  
  $stmt = $db->prepare('SELECT newID, newTitle, newAuthor, newDate, newCont, filename, rubrika, likes, dislikes FROM news ORDER BY newDate DESC LIMIT 2');
$stmt->execute(array());
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $db->prepare('SELECT username, email FROM members WHERE username="' . $row['newAuthor'] . '"');
$stmt2->execute(array());
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

if (!$stmt->execute())
{
	print_r($stmt->errorInfo());
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
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="ibox-content forum-container">
			<?php
$stmtc = $db->prepare('SELECT * FROM forums WHERE type=:type ORDER BY sortn');
$stmtc->execute(array(
    ':type' => 0
));
$rowc = $stmtc->fetch(PDO::FETCH_ASSOC);

if (!$stmtc->execute())
{
    print_r($stmtc->errorInfo());
}
while ($rowc = $stmtc->fetch(PDO::FETCH_ASSOC))
{
    echo '
							<div class="forum-title">
                    <h3>' . $rowc["name"] . '</h3>
                </div>
                ';

    $stmtf = $db->prepare('SELECT * FROM forums WHERE type=:type AND parent=:parent ORDER BY sortn');
    $stmtf->execute(array(
        ':type' => 1,
        ':parent' => $rowc["id"]
    ));
    $rowf = $stmtf->fetch(PDO::FETCH_ASSOC);

    if (!$stmtf->execute())
    {
        print_r($stmtf->errorInfo());
    }
    while ($rowf = $stmtf->fetch(PDO::FETCH_ASSOC))
    {

        $stmtti = $db->prepare('SELECT id FROM topics WHERE forumID=:forumID');
        $stmtti->execute(array(
            ':forumID' => $rowf["id"]
        ));
        $rowti = $stmtti->fetch(PDO::FETCH_ASSOC);
        if (!$stmtti->execute())
        {
            print_r($stmtti->errorInfo());
        }
        $pochet = 0;
        while ($rowti = $stmtti->fetch(PDO::FETCH_ASSOC))
        {
            foreach ($rowti as $valueid)
            {
                $pocetposts = $db->query("SELECT COUNT(*) FROM topics_r WHERE topicID='" . $valueid . "'")->fetchColumn();
                $pochet = $pochet + $pocetposts;
            }
        }
        $stmttif = $db->prepare('SELECT id FROM forums WHERE parent=:forumID');
        $stmttif->execute(array(
            ':forumID' => $rowf["id"]
        ));
        $rowtif = $stmttif->fetch(PDO::FETCH_ASSOC);
        if (!$stmttif->execute())
        {
            print_r($stmttif->errorInfo());
        }

        $pocetviews1 = $db->query("SELECT SUM(views) FROM topics WHERE forumID='" . $rowf["id"] . "'")->fetchColumn();
        $pocettopics1 = $db->query("SELECT count(*) FROM topics WHERE forumID='" . $rowf["id"] . "'")->fetchColumn();

        $pochet3 = 0;
        $pochet4 = 0;

        while ($rowtif = $stmttif->fetch(PDO::FETCH_ASSOC))
        {
            foreach ($rowtif as $valueid3)
            {
                $pocetviews2 = $db->query("SELECT SUM(views) FROM topics WHERE forumID='" . $valueid3 . "'")->fetchColumn();
                $pochet3 = $pochet3 + $pocetviews2;
            }
            foreach ($rowtif as $valueid9)
            {
                $pocettopics2 = $db->query("SELECT count(*) FROM topics WHERE forumID='" . $valueid9 . "'")->fetchColumn();
                $pochet4 = $pochet4 + $pocettopics2;
            }
            foreach ($rowtif as $valueid3)
            {
                $stmtti2 = $db->prepare('SELECT id FROM topics WHERE forumID=:forumID');
                $stmtti2->execute(array(
                    ':forumID' => $valueid3
                ));
                $rowti2 = $stmtti2->fetch(PDO::FETCH_ASSOC);
                if (!$stmtti2->execute())
                {
                    print_r($stmtti2->errorInfo());
                }
                while ($rowti2 = $stmtti2->fetch(PDO::FETCH_ASSOC))
                {
                    foreach ($rowti2 as $valueid2)
                    {
                        $pocetposts2 = $db->query("SELECT COUNT(*) FROM topics_r WHERE topicID='" . $valueid2 . "'")->fetchColumn();
                        $pochet2 = $pochet2 + $pocetposts2;
                    }
                }
            }
        }

        $pochet2 = 0;
        $pocetviews = $pocetviews1 + $pochet3;
        $pocettopics = $pocettopics1 + $pochet4;

        $pochet3 = $pochet + $pochet2;
        echo '
					<div class="forum-item active">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="fa fa-' . $rowf["icon"] . '"></i>
                            </div>
                            <a href="viewforum?id=' . $rowf["id"] . '" class="forum-item-title">' . $rowf["name"] . '</a>
                            <div class="forum-sub-title">' . $rowf["descr"] . '</div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                ' . $pocetviews . '
                            </span>
                            <div>
                                <small>' . $mk["forum_views"] . '</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                ' . $pocettopics . '
                            </span>
                            <div>
                                <small>' . $mk["forum_topics"] . '</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                ' . $pochet3 . '
                            </span>
                            <div>
                                <small>' . $mk["forum_posts"] . '</small>
                            </div>
                        </div>
                    </div>
					</div>
				';
    }

}
?>


            </div>
        </div>
    </div>
</div>
</div>
<?php 
  require_once("../layout/footer.php");
?>