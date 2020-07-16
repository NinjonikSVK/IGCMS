<?php

	include("../layout/header.php");

	$stmt = $db->prepare('SELECT pageID, pageTitle FROM pages');
	$stmt->execute(array());
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$stmt->execute()) {
		print_r($stmt->errorInfo());
	}

	$permis = getperm('canmanagepages')["canmanagepages"];
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
            <h1><?php echo $dbd["sites"] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $l["home"] ?></a></li>
              <li class="breadcrumb-item active"><?php echo $dbd["sites"] ?></li>
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
                      <th><?php echo $dbd["page_name"] ?></th>
					  	<th><?php echo $dbd["actions"] ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							echo "<tr>";
							echo "<th> " . $row["pageID"]. "</th>";
							echo "<th> " . $row["pageTitle"]. "</th>";
							echo '<td class="td-actions">';
							echo'<a class="btn btn-info btn-sm" href="../../materialkit/pages/viewpage?id='.$row["pageID"].'">
								<i class="fas fa-pencil-alt">
								</i>
								'.$actions["show"].'
							</a>
							<a class="btn btn-danger btn-sm" href="actions.php?id='.$row["pageID"].'&action=deletep">
								<i class="fas fa-trash">
								</i>
								'.$actions["delete"].'
							</a>
							<a class="btn btn-warning btn-sm" href="editpage?id='.$row["pageID"].'">
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
