<?php
	require("../layout/header.php");

	$pocetuserov = $db->query("SELECT count(*) FROM members")->fetchColumn();
	$pocetactive = $db->query("SELECT count(*) FROM members WHERE active='Yes'")->fetchColumn();
	$pocetstranok = $db->query("SELECT count(*) FROM pages")->fetchColumn();
	$pocetnoviniek = $db->query("SELECT count(*) FROM news")->fetchColumn();
	$poceticketov = $db->query("SELECT count(*) FROM tickets")->fetchColumn();
	$pocetsuborov = $db->query("SELECT count(*) FROM files")->fetchColumn();
	$pocetskupin = $db->query("SELECT count(*) FROM groups")->fetchColumn();
	$pocetfor = $db->query("SELECT count(*) FROM forums")->fetchColumn();
	$pocetticket = $db->query("SELECT count(*) FROM tickets WHERE ticketStatus='1'")->fetchColumn();

	$stmt = $db->prepare('SELECT username, email, description, skills, location, memberID, Level, notes FROM members WHERE username=:username');
	$stmt->execute(array(':username' => $usern));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$url = "https://admin.igportals.tk/cmsapi/api/index.php";
	$data = file_get_contents($url);
	$JSON = json_decode($data, true, JSON_UNESCAPED_UNICODE);

	$id = $JSON['id'];
	$title = $JSON['title'];
	$version = $JSON['version'];
	$changelog = $JSON['changelog'];
	$isnewest = $JSON['isnewest'];
	$file = $JSON['file'];
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $dbd["main"] ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index"><?php echo $l["home"] ?></a></li>
              <li class="breadcrumb-item active"><?php echo $dbd["main"] ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
	  <hr>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
		<h2><?php echo $dbd["welcome"] ?> <b><?php echo $lvl; ?></b>, <?php echo $usern; ?></h2>
		<br>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $pocetuserov; ?></h3>

                <p><?php echo $dbd["users"] ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
               <a href="members.php" class="small-box-footer"><?php echo $dbd["total_active_users"] .' '.$pocetactive; ?></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $pocetticket; ?></h3>

                <p><?php echo $dbd["tickets_opened"] ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-laptop"></i>
              </div>
              <a href="atickets.php" class="small-box-footer"><?php echo $dbd["total_tickets_count"].' '.$poceticketov; ?></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $pocetstranok; ?></h3>

                <p><?php echo $dbd["sites"] ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-document-text"></i>
              </div>
               <a href="pages.php" class="small-box-footer"><?php echo $dbd["site_count"].' '.$pocetstranok; ?></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $pocetnoviniek; ?></h3>

                <p><?php echo $l["news"] ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
               <a href="news.php" class="small-box-footer"><?php echo $dbd["total_posts"].' '.$pocetnoviniek; ?></a>
            </div>
          </div>
          <!-- ./col -->
		  <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $pocetsuborov; ?></h3>

                <p><?php echo $dbd["total_files"] ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-document"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $pocetskupin; ?></h3>

                <p><?php echo $dbd["total_groups"] ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $pocetfor; ?></h3>

                <p><?php echo $dbd["total_forums"] ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-document-text"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $JSON['version']; ?></h3>

                <p><?php echo $dbd["newest_version"] ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-plus"></i>
              </div>
			  <a href="../../../../update.php?filename=<?php echo $file; ?>" class="small-box-footer"><?php echo $dbd["total_version"].': '.$vcms; ?></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
		<br>
		<div><h2><?php echo $dbd["my_notes"] ?></h2> <p><?php echo $row["notes"]; ?></p></div>
		</div>
		<!-- /.card -->
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php
	require("../layout/footer.php");
?>
