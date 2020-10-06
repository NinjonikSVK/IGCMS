<?php 
  require_once("../layout/header.php");
  
	if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
			header('Location: index.php'); 
		}
	
		$rid = $_GET['id'];
	
		include("../layout/navbar.php");
		
		$stmt = $db->prepare("SELECT newID, newCont, newAuthor, newTitle, newDate, filename FROM news WHERE newID='".$_GET['id']."'");
		$stmt->execute(array());
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if (!$stmt->execute()) {
			print_r($stmt->errorInfo());
		}
		
		$stmtr = $db->prepare('SELECT * FROM news_r WHERE newID=:newID ORDER BY rTime DESC');
		$stmtr->execute(array(':newID' => $_GET['id']));
		$rowr = $stmtr->fetch(PDO::FETCH_ASSOC);
		
		if (!$stmtr->execute()) {
			print_r($stmtr->errorInfo());
		}
		
	if(isset($_POST['submit'])){

		$rCont = $_POST['rCont'];
		$author = $_SESSION['username'];

		$date = time();			
			
			//insert into database with a prepared statement
				$stmt = $db->prepare('INSERT INTO news_r (newID,rCont,rAuthor,rTime) VALUES (:newID, :rCont, :respAuthor, :rTime)');
				$stmt->execute(array(
						':newID' => $rid,
						':rCont' => $rCont,
						':respAuthor' => $author,
						':rTime' => $date
				));
			
			header("Location: viewnew?id=".$rid."&action=respcreated");	

	}
?>
<main role="main" class="container">
	<div class="container py-5 text-center">
		<div class="jumbotron text-white jumbotron-image shadow" style="background-image: url(/assets/img/bg0.jpg">
			<h2 class="mb-4">
				<?php echo $siteTitle; ?>
			</h2>
			<p class="mb-4">
				<?php echo $l["post"] ?>
			</p>
		</div>
	</div>
	<div class="container">
	 <div id="blog" class="row"> 
	 <?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{

    $email = $row2['email'];;
    $default = "cms.igportals.tk/img/default.png";
    $size = 100;

    $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;

    $date = date("d.m.Y H:i", $row["newDate"]);

    $likes = $db->query("SELECT count(*) FROM likes WHERE newID='" . $row['newID'] . "'")->fetchColumn();
	echo '
		<div class="col-md-10 blogShort">
				 <h1>' . substr($row['newTitle'], 0, 50) . '</h1> <h3>' . $row['rubrika'] . '</h3>
				 <img src="../../../uploads/nt/igcmslogo.png" alt="post img" class="img-fluid" width="300" height="200">
				 <article><p>
					' . substr($row['newCont'], 0, 1000) . '...   
					 </p></article>
				 <a class="btn btn-blog pull-right marginBottom10" href="action.php?action=liken&id='.$row['newID'].'">'.$likes.' <i class="far fa-thumbs-up"></i></a> 
            </div>
		';
    }
?>
	 <div class="message-chat">
                    <div class="chat-body">
					<p align="center"><h1><?php echo $mk["commments"]; ?></h1></p>
		<?php
			if($user->is_logged_in() ){
												echo '
												<p>
												<div class="chat-footer">
														<form method="post">
															<textarea class="send-message-text" name="rCont"></textarea>
															<button name="submit" type="submit" class="send-message-button btn-info"> <i class="fa fa-send"></i> </button>
														</form>
													</div>
													</p>
												';
												} else {
													echo '';
												}
												
												while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)) {
														
														$stmta = $db->prepare('SELECT email, avatar FROM members WHERE username=:username');
														$stmta->execute(array(':username' => $rowr["rAuthor"]));
														$rowa = $stmta->fetch(PDO::FETCH_ASSOC);
														
														if ($rowa['avatar'] == "gravatar") {
															
															$emailr = $rowa['email'];;
															$default = "".$siteurl."img/default.png";
															$size = 100;
															
															$grav_urlr = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emails ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
															
														} else {
															
															$grav_urlr = '../../../uploads/ua/'.$rowa['avatar'].'';
															
														}
														
														$ra = $rowr["rAuthor"];
														
														$rdate = date("d.m.Y H:i", $rowr["rTime"]);
														echo '
														<div class="message info">
														<img alt="" class="img-circle medium-image" src="'.$grav_urlr.'">

														<div class="message-body">
															<div class="message-info">
																<h4> '.$rowr["rAuthor"].'</h4>
																<h5> <i class="fa fa-clock-o"></i> '.$rdate.' </h5>
															</div>
															<hr>
															<div class="message-text">
																'.$rowr["rCont"].'
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