<?php

	include("../layout/header.php");

	$stmt = $db->prepare('SELECT * FROM forums');
	$stmt->execute(array());
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$stmt->execute()) {
		print_r($stmt->errorInfo());
	}

	$permis = getperm('canmanageforum')["canmanageforum"];
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
            <h1><?php echo $dbd["forum_forums"] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $l['home']; ?></a></li>
              <li class="breadcrumb-item active"><?php echo $dbd["forum_forums"] ?></li>
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
              <td><a href="createforum?step=1">
                  <button type="button" class="btn btn-block btn-primary"><?php echo $dbd["forum_add"]; ?></button>
              </a></td>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th><?php echo $dbd["forum_name"]; ?></th>
					  <th><?php echo $dbd["forum_desc"]; ?></th>
					  <th><?php echo $dbd["forum_order"]; ?></th>
					  <th><?php echo $dbd["forum_icon"]; ?></th>
					  <th><?php echo $dbd["forum_parent"]; ?></th>
					  <th><?php
					  echo $dbd["type"] ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
														echo "<tr>";
														echo "<th> ".$row["id"]. "</th>";
														echo "<th> ".$row["name"]. "</th>";
														echo "<th> ".$row["descr"]. "</th>";
														echo "<th> ".$row["sortn"]. "</th>";
														echo "<th> ".$row["icon"]. "</th>";
														echo "<th> ".$row["parent"]. "</th>";
														if ($row["type"] == 0){
															$type = $dbd["forum_category"];
															$typ = 'c';
														} else if ($row["type"] == 1){
															$type = $dbd["forum_forum"];
															$typ = 'f';
														} else {
															echo 'Error: Forum type is not existing!';
														}
														echo "<th> ".$type. "</th>";
														echo '<td class="td-actions">';
														echo '
														<a class="btn btn-danger btn-sm" href="actions.php?id='.$row["id"].'&action=deletef">
															<i class="fas fa-trash">
															</i>
															'.$actions["delete"].'
														</a>
														<a class="btn btn-warning btn-sm" href="editforum?step=2&id='.$row["id"].'&type='.$typ.'">
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
