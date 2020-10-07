<?php 
  require_once("../layout/header.php");
  
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

	if(isset($_POST['submit'])){

		$respCont = $_POST['respCont'];
		$author = $_SESSION['username'];

		if (empty($respCont)) {
			return header("Location: viewticket.php?action=fillallfields&id=".$_GET["id"]."");
		}
		
		$date = time();

			//insert into database with a prepared statement
				$stmt = $db->prepare('INSERT INTO ticketr (ticketID,respCont,respAuthor,respTime,type) VALUES (:ticketID, :respCont, :respAuthor, :respTime, :type)');
				$stmt->execute(array(
						':ticketID' => $tid,
						':respCont' => $respCont,
						':respAuthor' => $author,
						':respTime' => $date,
						':type' => '0'
				));

			header("Location: viewticket.php?id=".$tid."&action=respcreated");

	}
?>
<main role="main" class="container">
	<div class="container py-5 text-center">
		<div class="jumbotron text-white jumbotron-image shadow" style="background-image: url('../../../../assets/img/bg0.jpg');>
			<h2 class="mb-4">
				<?php echo $siteTitle; ?>
			</h2>
			<p class="mb-4">
				<?php echo $mk["support-tickets"] ?>
			</p>
		</div>
	</div>
	<div class="container">
		<div id="blog" class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="mytable" class="table table-bordred table-striped">
						<thead>
						<th><?php echo $dbd["created"] ?></th>
						<th><?php echo $dbd["title"] ?></th>
						<th><?php echo $dbd["preferated_administrator"] ?></th>
						<th><?php echo $dbd["status"] ?></th>
						<th><?php echo $dbd["actions"] ?></th>
						</thead>
						<tbody>
						<?php 
							while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
								
								if ($row["ticketAuthor"] == $_SESSION['username']){
									echo "";
								} else {
									header("Location: index.php");
								}

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
								
								$date = date("d.m.Y H:i", $row["ticketTime"]);

								if ($row["ticketStatus"] == '1'){
									$status = '<span class="label label-success">'.$statuses["opened"].'</span>';
								}
								else if ($row["ticketStatus"]== '2'){
									$status = '<span class="label label-default">'.$statuses["working_on"].'</span>';
								}
								else if ($row["ticketStatus"] == '3'){
									$status = '<span class="label label-danger">'.$statuses["closed"].'</span>';
								}
								else if ($row["ticketStatus"] == '4'){
									$status = '<span class="label label-rose">'.$statuses["stored"].'</span>';
								}
								else {
									$status = '<span class="label label-danger">'.$statuses["error"].'</span>';
								}
								
								echo '
								<tr>

									<td>'.$row["ticketID"].'</td>
									<td>'.$date.'</td>
									<td>'.$row["ticketTitle"].'</td>
									<td>'.$status.'</td>
									<td>
											<a href="viewticket?id='.$row["ticketID"].'"><button class="btn btn-primary btn-sm" data-title="Edit" data-toggle="modal" data-target="#edit" >
												<i class="fas fa-eye"></i>
											</button></a>
											<a href="action?id='.$row["ticketID"].'&action=deletet"><button class="btn btn-danger btn-sm" data-title="Edit" data-toggle="modal" data-target="#edit" >
												<i class="fas fa-close"></i>
											</button></a>
									</td>
								</tr>';
								echo '</tbody>
									</table>';
									
								echo '
								
								<div class="message-chat">
                    <div class="chat-body">
                        <div class="message info">
                            <img alt="" class="img-circle medium-image" src="'.$grav_urlt.'">

                            <div class="message-body">
                                <div class="message-info">
                                    <h4> '.$row["ticketAuthor"].' - '.$l["subject"].'</h4>
                                    <h5> <i class="fa fa-clock-o"></i> '.$date.' </h5>
                                </div>
                                <hr>
                                <div class="message-text">
                                    '.$row["ticketCont"].'
                                </div>
                            </div>
                            <br>
                        </div>

                    
								
								';
							   
							}
							
							while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)) {
								
								$stmta = $db->prepare('SELECT email, avatar FROM members WHERE username=:username');
								$stmta->execute(array(':username' => $rowr["respAuthor"]));
								$rowa = $stmta->fetch(PDO::FETCH_ASSOC);

								if ($rowa['avatar'] == "gravatar") {
									$emailt = $rowr['email'];;
									$default = "".$siteurl."img/default.png";
									$size = 100;

									$grav_urlr = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emailt ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
								} else {
									$grav_urlr = '../../../uploads/ua/'.$rowa['avatar'].'';
								}

								$ra = $rowr["respAuthor"];

								$rdate = date("d.m.Y H:i", $rowr["respTime"]);
								if ($rowr['type'] == '0'){
									echo '<div class="message info">';
								}
								else {
									echo '<div class="message my-message">';
								}
								
								echo '
								
									<img alt="" class="img-circle medium-image" src="'.$grav_urlr.'">

									<div class="message-body">
										<div class="message-info">
											<h4> '.$rowr["respAuthor"].' </h4>
											<h5> <i class="fa fa-clock-o"></i> '.$rdate.' </h5>
										</div>
										<hr>
										<div class="message-text">
											'.$rowr["respCont"].'
										</div>
									</div>
									<br>
								</div>
								
								';
							}
							
							?>
                </div>
							
				</div>
				<div class="chat-footer">
						<form method="post">
							<textarea class="send-message-text" name="respCont"></textarea>
							<button name="submit" type="submit" class="send-message-button btn-info"> <i class="fa fa-send"></i> </button>
						</form>
                    </div>
			</div>
		</div>
	</div>
</div>

    
    
    
<?php 
  require_once("../layout/footer.php");
?>