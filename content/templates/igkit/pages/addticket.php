<?php 
  require_once("../layout/header.php");
  

if($user->is_logged_in())
	{
		echo '';
	} else {
		header("Location: login.php");
	}

if(isset($_POST['submit'])){

	$Title = $_POST['ticketTitle'];
	$Cont = $_POST['ticketCont'];
	$Admin = $_POST['ticketAdmin'];
	$author = $_SESSION['username'];

	$date = time();




		//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO tickets (ticketTitle,ticketCont,ticketAuthor,ticketTime,ticketAdmin,ticketStatus) VALUES (:ticketTitle, :ticketCont, :ticketAuthor, :ticketDate, :ticketAdmin, 1)');
			$stmt->execute(array(
					':ticketTitle' => $Title,
					':ticketCont' => $Cont,
					':ticketAuthor' => $author,
					':ticketDate' => $date,
					':ticketAdmin' => $Admin
			));

		$notType = 5;
		$notDate = time();
		$stmt = $db->prepare('INSERT INTO notifications (notUser,notType,notDate) VALUES (:notUser, :notType, :notDate)');
		$stmt->execute(array(
			':notUser' => $_SESSION['username'],
			':notType' => $notType,
			':notDate' => $notDate
		));

		header("Location: mytickets.php?action=ticketcreated");

}

?>
<main role="main" class="container">
	<div class="container py-5 text-center">
		<div class="jumbotron text-white jumbotron-image shadow" style="background-image: url(/assets/img/bg0.jpg">
			<h2 class="mb-4">
				<?php echo $siteTitle; ?>
			</h2>
			<p class="mb-4">
				<?php echo $mk["support-create-ticket"] ?>
			</p>
		</div>
	</div>
<div class="container">
	<div id="blog" class="row"> 
		<div class="col-md-10">
		<form action="" method="post">
		  <div class="form-group">
			<label><?php echo $mk["ticket_name"] ?></label>
			<input type="text" class="form-control" name="ticketTitle">
		  </div>
		  <div class="form-group">
			<label><?php echo $dbd["preferated_administrator"].' *' ?></label>
			<input type="text" class="form-control" name="ticketAdmin">
		  </div>
		  <div class="form-group">
			<label><?php echo $mk["ticket_index"] ?></label>
			<textarea class="form-control" rows="9" name="ticketCont"></textarea>
		  </div>
		  <p><button name="submit" value="submit" class="btn btn-danger btn-round"><?php echo $actions["send"] ?></button></p>
		</form>
		<div class="col-md-10">
	</div>
</div>

    
    
    
<?php 
  require_once("../layout/footer.php");
?>