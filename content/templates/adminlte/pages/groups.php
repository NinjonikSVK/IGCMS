<?php

	include("../layout/header.php");

	$stmt = $db->prepare('SELECT * FROM groups');
	$stmt->execute(array());
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$stmt->execute()) {
		print_r($stmt->errorInfo());
	}

	$permis = getperm('canmanagegroups')["canmanagegroups"];
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
            <h1><?php echo $dbd["groups"] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $l['home']; ?></a></li>
              <li class="breadcrumb-item active"><?php echo $dbd["groups"] ?></li>
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
              <td><a href="creategroup?step=1">
                  <button type="button" class="btn btn-block btn-primary"><?php echo $dbd["group_add"]; ?></button>
              </a></td>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th><?php echo $dbd["group"]; ?></th>
					  					<th><?php echo $dbd["actions"]; ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
														echo "<tr>";
														echo "<th> ".$row["id"]. "</th>";
														echo "<th> ".$row["title"]. "</th>";
														echo '<td class="td-actions">';
														echo '
														<a class="btn btn-danger btn-sm" href="actions.php?id='.$row["id"].'&action=deleteg">
															<i class="fas fa-trash">
															</i>
															'.$actions["delete"].'
														</a>
														<a class="btn btn-warning btn-sm" href="creategroup?step=2&id='.$row["id"].'">
															<i class="fas fa-pencil-alt">
															</i>
															'.$actions["edit"].'
														</a>
														</td>
													</tr>';
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
