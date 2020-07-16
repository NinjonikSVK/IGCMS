 <?php

	if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
		header('Location: '.DIRADMIN);
	}

	include("../layout/header.php");

	$tid = $_GET['id'];

	$stmt = $db->prepare('SELECT * FROM tickets WHERE ticketID=:ticketID ORDER BY ticketTime DESC');
	$stmt->execute(array(':ticketID' => $tid));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$stmt->execute()) {
		print_r($stmt->errorInfo());
	}

	$stmtr = $db->prepare('SELECT * FROM ticketr WHERE ticketID=:ticketID ORDER BY respTime DESC');
	$stmtr->execute(array(':ticketID' => $tid));
	$rowr = $stmtr->fetch(PDO::FETCH_ASSOC);

	if (!$stmtr->execute()) {
		print_r($stmtr->errorInfo());
	}
    $permis = getperm('canmanagetickets')["canmanagetickets"];
	if ($permis == 0) {
		header("Location: index?type=notenoughpermissions");
	} else if ($permis == 1) {
		echo '';
	} else {
		echo 'Error, group permission error.';
	}

  $contenthtml = '
  <div class="card direct-chat direct-chat-primary">
            <div class="card-header">
              <h3 class="card-title">'.$dbd["messages"].'</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages">
  ';

  if(isset($_POST['submit'])){

    $respCont = $_POST['message'];
    $author = $_SESSION['username'];
	if (empty($respCont)) {
		return header("Location: viewticket.php?action=fillallfields&id=".$_GET["id"]."");
	}

    $daterr = time();

      //insert into database with a prepared statement
        $stmt = $db->prepare('INSERT INTO ticketr (ticketID,respCont,respAuthor,respTime,type) VALUES (:ticketID, :respCont, :respAuthor, :respTime, :type)');
        $stmt->execute(array(
            ':ticketID' => $tid,
            ':respCont' => $respCont,
            ':respAuthor' => $author,
            ':respTime' => $daterr,
            ':type' => '1'
        ));

      header("Location: viewticket.php?id=".$tid."&action=respcreated");

  }

 ?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $dbd["tickets"] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $l["home"] ?></a></li>
              <li class="breadcrumb-item active"><?php echo $dbd["tickets"] ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

 <!-- Main content -->
    <section class="content">
	<div class="container-fluid">
         <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body table-responsive p-0">
			  <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th><?php echo $dbd["id"] ?></th>
                      <th><?php echo $dbd["created"] ?></th>
					  <th><?php echo $dbd["title"] ?></th>
					  <th><?php echo $dbd["preferated_administrator"] ?></th>
					  <th><?php echo $dbd["status"] ?></th>
					  <th><?php echo $dbd["actions"] ?></th>
                    </tr>
                  </thead>
                  <tbody>
			  <?php
               while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $date = date("d.m.Y H:i", $row["ticketTime"]);

        						$stmtt = $db->prepare('SELECT username, email, description, skills, location, memberID, Level, notes, avatar FROM members WHERE username=:username');
        						$stmtt->execute(array(':username' => $row['ticketAuthor']));
        						$rowt = $stmtt->fetch(PDO::FETCH_ASSOC);

        						if ($rowt['avatar'] == "gravatar") {
        							$emailt = $rowt['email'];;
        							$default = "".$siteurl."img/default.png";
        							$size = 100;

        							$grav_urlt = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emailt ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
        						} else {
        							$grav_urlt = '../../../uploads/ua/'.$rows['avatar'].'';
        						}

        						if ($row["ticketStatus"] == '1'){
        							$status = '<span class="badge badge-primary">'.$statuses["working_on"].'</span>';
        						}
        						else if ($row["ticketStatus"]== '2'){
        							$status = '<span class="badge badge-success">'.$statuses["opened"].'</span>';
        						}
        						else if ($row["ticketStatus"] == '3'){
        							$status = '<span class="badge badge-danger">'.$statuses["closed"].'</span>';
        						}
        						else if ($row["ticketStatus"] == '4'){
        							$status = '<span class="badge badge-secondary">'.$statuses["stored"].'</span>';
        						}
        						else {
        							$status = '<span class="badge badge-warning">'.$statuses["error"].'</span>';
        						}

        						echo '
        								<tr>';
        									echo '<td class="text-center">'.$row["ticketID"].'</td>';
        									echo '<td>'.$date.'</td>';
        									echo '<td>'.$row["ticketTitle"].'</td>';
        									echo '<td>'.$row["ticketAdmin"].'</td>';
        									echo '<td>'.$status.'</td>';
        									echo '<td class="td-actions text-right">';
        									echo '<a href="viewticket.php?id='.$row["ticketID"].'">';
        									echo'<td>
        								  <a class="btn btn-danger btn-sm" href="actions.php?id='.$row["ticketID"].'&action=deletet">
        									  <i class="fas fa-trash">
        									  </i>
        									  '.$actions["delete"].'
        								  </a>
        								  <a class="btn btn-info btn-sm" href="editticket.php?id='.$row["ticketID"].'">
        									  <i class="fas fa-pencil-alt">
        									  </i>
        									  '.$actions["edit"].'
        								  </a>
        							  </td>
        										</a>
        									</td>
        								</tr>
        								</tbody>
        							</table>
        						  </div>
        						';
        echo $contenthtml;
        					echo '
        <div class="direct-chat-msg">
        <div class="direct-chat-infos clearfix">
        <span class="direct-chat-name float-left">'.$row["ticketAuthor"].'</span>
        <span class="direct-chat-timestamp float-right">'.$date.' - Predmet</span>
        </div>
        <!-- /.direct-chat-infos -->
        <img class="direct-chat-img" src="'.$grav_urlt.'" alt="message user image">
        <!-- /.direct-chat-img -->
        <div class="direct-chat-text">
        '.$row["ticketCont"].'
        </div>
        <!-- /.direct-chat-text -->
        </div>
        ';
        					}
        																?>
        																<?php
        			while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)) {

        					$date2 = date("d.m.Y H:i", $rowr["respTime"]);

        						$stmta = $db->prepare('SELECT email, avatar FROM members WHERE username=:username');
        						$stmta->execute(array(':username' => $rowr["respAuthor"]));
        						$rowa = $stmta->fetch(PDO::FETCH_ASSOC);

        						if ($rowa['avatar'] == "gravatar") {
        							$emailt = $rowa['email'];;
        							$default = "".$siteurl."img/default.png";
        							$size = 100;

        							$grav_urlr = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emailt ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
        						} else {
        							$grav_urlr = '../../../uploads/ua/'.$rowa['avatar'].'';
        						}
        if ($rowr['type'] == 1) {
        $obsah = '
        <div class="direct-chat-msg right">
        <div class="direct-chat-infos clearfix">
          <span class="direct-chat-name float-right">'.$rowr["respAuthor"].'</span>
          <span class="direct-chat-timestamp float-left">'.$date2.'</span>
        </div>
        <!-- /.direct-chat-infos -->
        <img class="direct-chat-img" src="'.$grav_urlr.'" alt="message user image">
        <!-- /.direct-chat-img -->
        <div class="direct-chat-text">
          '.$rowr["respCont"].'
        </div>
        <!-- /.direct-chat-text -->
        </div>
        ';
        						} else {
        $obsah = '
        <div class="direct-chat-msg">
        <div class="direct-chat-infos clearfix">
          <span class="direct-chat-name float-left">'.$rowr["respAuthor"].'</span>
          <span class="direct-chat-timestamp float-right">'.$date2.'</span>
        </div>
        <!-- /.direct-chat-infos -->
        <img class="direct-chat-img" src="'.$grav_urlr.'" alt="message user image">
        <!-- /.direct-chat-img -->
        <div class="direct-chat-text">
          '.$rowr["respCont"].'
        </div>
        <!-- /.direct-chat-text -->
        </div>
        ';
        						}
        echo $obsah;
        					}
																								?>

      <!-- /.card -->
    </div>
    <!--/.direct-chat-messages-->

    <!-- Contacts are loaded here -->

    <!-- /.card-body -->
    <div class="card-footer">
    <form action="" method="post">
      <div class="input-group">
        <input type="text" name="message" placeholder="<?php echo $dbd["type_you_message_here"] ?>" class="form-control">
        <span class="input-group-append">
          <button name="submit" type="submit" class="btn btn-primary"><?php echo $actions["send"] ?></button>
        </span>
      </div>
    </form>
    </div>
    <!-- /.card-footer-->
    </div>
    </section>

                   <!-- Message. Default to the left -->
                   <!-- /.direct-chat-msg -->

                   <!-- Message to the right -->
                   <!-- /.direct-chat-msg -->

    <!-- /.content -->
	</div>
<?php
	include("../layout/footer.php");
?>
