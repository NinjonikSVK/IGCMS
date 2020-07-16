<?php

include("../layout/header.php");

if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
	header('Location: '.DIRADMIN); 
}

if(isset($_POST['submit'])){

	$admin = $_POST['ticketAdmin'];
	if ($_POST["status"] == '1'){
		$ticketID = 1;
	}
	else if ($_POST["status"] == '2'){
		$ticketID = 2;
	}
	else if ($_POST["status"] == '3'){
		$ticketID = 3;
	}
	else if ($_POST["status"] == '4'){
		$ticketID = 4;
	}
	else {
		$ticketID = 5;
	}
	if (empty($admin)) {
		return header("Location: editticket.php?action=fillallfields&id=".$_GET['id']."");
	}
	
	//insert into database with a prepared statement
			$stmt = $db->prepare('UPDATE tickets SET ticketAdmin=:ticketAdmin, ticketStatus=:ticketStatus WHERE ticketID=:ticketID');
			$stmt->execute(array(
				':ticketAdmin' => $admin,
				':ticketStatus' => $status,
				':ticketID' => $ticketID
			));
	
	header("Location: atickets.php?action=ticketedited");

}

$stmt = $db->prepare('SELECT ticketAdmin, ticketStatus FROM tickets WHERE ticketID=:ticketID');
$stmt->execute(array(':ticketID' => $_GET['id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit ticket</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit ticket</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
	<!-- NAV -->
            <!-- /.card-header -->
			<form action="" method="post">
            <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label><?php echo $dbd["preferated_administrator"]; ?></label>
                        <input name="ticketAdmin" type="text" class="form-control" placeholder="" value="<?php echo $row['ticketAdmin']; ?>">
                      </div>
					 <label><?php echo $dbd["status"]; ?></label>
					<select name="status" class="form-control select2bs4" style="width: 100%;">
							<option value="1"><?php echo $statuses["working_on"]; ?></option>
							<option value="2"><?php echo $statuses["opened"]; ?></option>
							<option value="3"><?php echo $statuses["closed"]; ?></option>
							<option value="4"><?php echo $statuses["stored"]; ?></option>
							<option value="5"><?php echo $statuses["error"]; ?></option>
				  </select>
					  <p><button name="submit" value="Odoslať" class="btn btn-primary btn-round">Odoslať</button></p>
					  * Rada pre status: 1 = Rieši sa, 2 = Otvorený, 3 = Uzavretý, 4 = Odložený
				 </div>
				  </form>
				  </div>
				  
        <!-- /.col-->
      <!-- ./row -->
<!-- END NAV -->
    <!-- /.content -->
  <!-- /.content-wrapper -->
  
<?php

include("../layout/footer.php");

?>