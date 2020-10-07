<?php 
  require_once("../layout/header.php");
  
	$stmtr = $db->prepare('SELECT * FROM chat ORDER BY chatTime DESC LIMIT 10');
	$stmtr->execute(array(':ticketID' => $tid));
	$rowr = $stmtr->fetch(PDO::FETCH_ASSOC);

	if (!$stmtr->execute()) {
		print_r($stmtr->errorInfo());
	}
	
	if(isset($_POST['submit'])){

		if (empty($_POST['chatCont'])) {
			return header("Location: chat.php?action=emptymessage");
		}

		$chatCont = $_POST['chatCont'];
		$author = $_SESSION['username'];

		$date = time();



			//insert into database with a prepared statement
				$stmt3 = $db->prepare('INSERT INTO chat (chatCont,chatAuthor,chatTime) VALUES (:chatCont, :chatAuthor, :chatTime)');
				$stmt3->execute(array(
						':chatCont' => $chatCont,
						':chatAuthor' => $author,
						':chatTime' => $date
				));

			header("Location: chat.php?id=".$tid."&action=chatcreated");

	}
?>
<main role="main" class="container">
	<div class="container py-5 text-center">
		<div class="jumbotron text-white jumbotron-image shadow" style="background-image: url('../../../../assets/img/bg0.jpg');>
			<h2 class="mb-4">
				<?php echo $siteTitle; ?>
			</h2>
			<p class="mb-4">
				<?php echo $l["chat"] ?>
			</p>
		</div>
	</div>
	<div class="container">
	 <div id="blog" class="row"> 
	 <div class="message-chat">
                    <div class="chat-body">
	 <?php 
					$permis = getperm('canmoderatechat')["canmoderatechat"];
					if ($permis == 0) {
						echo '';
					} else if ($permis == 1) {
						echo '<p><a href="actions.php?id=0&action=delallchat">'.$dbd["delete_all_chat"].'</a></p>';
					} else {
						echo 'Error, group permission error.';
					}
		
				?>
		<?php
			if($user->is_logged_in()){
				echo '
				<p>
				<div class="chat-footer">
						<form method="post">
							<textarea class="send-message-text" name="chatCont"></textarea>
							<button name="submit" type="submit" class="send-message-button btn-info"> <i class="fa fa-send"></i> </button>
						</form>
                    </div>
					</p>';
			}
			 ?>
				<?php
					while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)) {
						$stmta = $db->prepare('SELECT email, avatar FROM members WHERE username=:username');
						$stmta->execute(array(':username' => $rowr["chatAuthor"]));
						$rowa = $stmta->fetch(PDO::FETCH_ASSOC);

						if ($rowa['avatar'] == "gravatar") {

							$emailr = $rowa['email'];;
							$default = "".$siteurl."img/default.png";
							$size = 100;

							$grav_urlr = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emails ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

						} else {

							$grav_urlr = '../../../uploads/ua/'.$rowa['avatar'].'';

						}

						$ra = $rowr["chatAuthor"];
						
						$rdate = date("d.m.Y H:i", $rowr["chatTime"]);
						echo '
                        <div class="message info">
                            <img alt="" class="img-circle medium-image" src="'.$grav_urlr.'">

                            <div class="message-body">
                                <div class="message-info">
                                    <h4> '.$rowr["chatAuthor"].'</h4>
                                    <h5> <i class="fa fa-clock-o"></i> '.$rdate.' </h5>
                                </div>
                                <hr>
                                <div class="message-text">
                                    '.$rowr["chatCont"].'
                                </div>
                            </div>
                            <br>
                        </div>
						
						';
					}
					?>
             </div>
</div>

    
    
    
<?php 
  require_once("../layout/footer.php");
?>