<?php

	include("../layout/header.php");

	$stmt = $db->prepare('SELECT newID, newTitle, newAuthor, newDate FROM news');
	$stmt->execute(array());
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$stmt->execute()) {
		print_r($stmt->errorInfo());
	}

	$permis = getperm('canmanagenews')["canmanagenews"];
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
            <h1><?php echo $l["news"] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $l["home"] ?></a></li>
              <li class="breadcrumb-item active"><?php echo $l["news"] ?></li>
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
					  <th><?php echo $dbd["autor"] ?></th>
					  <th><?php echo $dbd["time"] ?></th>
					  <th><?php echo $dbd["actions"] ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							$date = date("d.m.Y H:i", $row["newDate"]);
							echo "<tr>";
							echo "<th class='text-center'> " . $row["newID"]. "</th>";
							echo "<th class='text-center'> " . $row["newTitle"]. "</th>";
							echo "<th class='text-center'> " . $row["newAuthor"]. "</th>";
							echo "<th class='text-center'> " . $date. "</th>";
							echo "<td><a href='viewnew.php?id=".$row["newID"]."'>".$actions["jump"]."</a></td>";
							echo '<td><a href="actions.php?id='.$row["newID"].'&action=deleten">'.$actions["delete"].'</a></td>';
							echo '<td><a href="editnew.php?id='.$row["newID"].'">'.$actions["edit"].'</a></td>';
							echo "</tr>";
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
