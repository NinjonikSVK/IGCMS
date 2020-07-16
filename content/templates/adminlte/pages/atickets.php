 <?php

	include("../layout/header.php");

	$stmt = $db->prepare('SELECT * FROM tickets ORDER BY ticketTime DESC');
	$stmt->execute(array(':ticketAuthor' => $usern));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$stmt->execute()) {
		print_r($stmt->errorInfo());
	}
    $permis = getperm('canmanagetickets')["canmanagetickets"];
	if ($permis == 0) {
		header("Location: index?type=notenoughpermissions");
	} else if ($permis == 1) {
		echo '';
	} else {
		echo 'Error, group permission error.';
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
    </section>

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

    if ($row["ticketStatus"] == '1'){
      $status = '<a href="editticket?id='.$row["id"].'"><button type="button" class="btn btn-block btn-success btn-xs">'.$statuses["opened"].'</button></a>';
    }
    else if ($row["ticketStatus"]== '2'){
      $status = '<a href="editticket?id='.$row["id"].'"><button type="button" class="btn btn-block btn-default btn-xs">'.$statuses["working_on"].'</button></a>';
    }
    else if ($row["ticketStatus"] == '3'){
      $status = '<a href="editticket?id='.$row["id"].'"><button type="button" class="btn btn-block btn-danger btn-xs">'.$statuses["closed"].'</button></a>';
    }
    else if ($row["ticketStatus"] == '4'){
      $status = '<a href="editticket?id='.$row["id"].'"><button type="button" class="btn btn-block btn-warning btn-xs">'.$statuses["stored"].'</button></a>';
    }
    else {
      $status = '<span class="label label-danger">'.$statuses["error"].'</span>';
    }

			echo '
					<tr>';
						echo '<td class="text-center">'.$row["ticketID"].'</td>';
						echo '<td>'.$date.'</td>';
						echo '<td>'.$row["ticketTitle"].'</td>';
						echo '<td>'.$row["ticketAdmin"].'</td>';
						echo '<td class="text-right">'.$status.'</td>';
						echo '<td class="td-actions text-right">';
						echo '<a href="viewticket.php?id='.$row["ticketID"].'">';
						echo'<a class="btn btn-info btn-sm" href="addticketr.php?id='.$row["ticketID"].'">
						  <i class="fas fa-pencil-alt">
						  </i>
						  '.$actions["add_answer"].'
					  </a>
					  <a class="btn btn-danger btn-sm" href="actions.php?id='.$row["ticketID"].'&action=deletet">
						  <i class="fas fa-trash">
						  </i>
						  '.$actions["delete"].'
					  </a>
					  <a class="btn btn-info btn-sm" href="viewticket.php?id='.$row["ticketID"].'">
						  <i class="fas fa-pencil-alt">
						  </i>
						  '.$actions["show"].'
					  </a>
						</td>
					</tr>
			';
						}
					?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
	</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
	include("../layout/footer.php");
?>
