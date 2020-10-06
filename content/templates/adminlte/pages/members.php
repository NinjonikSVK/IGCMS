<?php

	include("../layout/header.php");

	$permis = getperm('canmanageusers')["canmanageusers"];
	if ($permis == 0) {
		header("Location: index?type=notenoughpermissions");
	} else if ($permis == 1) {
		echo '';
	} else {
		echo 'Error, group permission error.';
	}
	$stmt = $db->prepare('SELECT * FROM members');
	$stmt->execute(array());
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if (!$stmt->execute()) {
		print_r($stmt->errorInfo());
	}

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $dbd["users"] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $l["home"] ?></a></li>
              <li class="breadcrumb-item active"><?php echo $dbd["users"] ?></li>
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
                      <th><?php echo $dbd["user_name"] ?></th>
					  <th><?php echo $dbd["email"] ?></th>
					  <th><?php echo $dbd["actions"] ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							echo "<tr>";
							echo "<th class='text-center'> " . $row["memberID"]. "</th>";
							echo "<td> " . $row["username"]. "</td>";
							echo "<td> " . $row["email"]. "</td>";
							echo "<td><a href='../../materialkit/pages/profile.php?id=".$row["memberID"]."'>".$actions["jump_on_profile"]."</a></td>";
							echo '<td><a href="actions.php?id='.$row["memberID"].'&action=deleteu">'.$actions["delete"].'</a></td>';
							echo '<td><a href="actions.php?id='.$row["memberID"].'&action=verifyu">'.$actions["verify"].'</a></td>';
							echo '<td><a href="editgroup.php?id='.$row["memberID"].'">'.$dbd["group"].'</a></td>';
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
