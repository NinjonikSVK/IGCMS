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
		<div class="jumbotron text-white jumbotron-image shadow" style="background-image: url(/assets/img/bg0.jpg">
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
                <div class="message-chat">
                    <div class="chat-body">
                        <div class="message info">
                            <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png">

                            <div class="message-body">
                                <div class="message-info">
                                    <h4> Elon Musk </h4>
                                    <h5> <i class="fa fa-clock-o"></i> 2:25 PM </h5>
                                </div>
                                <hr>
                                <div class="message-text">
                                    I've seen your new template, Dauphin, it's amazing !
                                </div>
                            </div>
                            <br>
                        </div>

                        <div class="message my-message">
                            <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png">

                            <div class="message-body">
                                <div class="message-body-inner">
                                    <div class="message-info">
                                        <h4> Dennis Novac </h4>
                                        <h5> <i class="fa fa-clock-o"></i> 2:28 PM </h5>
                                    </div>
                                    <hr>
                                    <div class="message-text">
                                        Thanks, I think I will use this for my next dashboard system.
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>

                        <div class="message info">
                            <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png">

                            <div class="message-body">
                                <div class="message-info">
                                    <h4> Elon Musk </h4>
                                    <h5> <i class="fa fa-clock-o"></i> 2:32 PM </h5>
                                </div>
                                <hr>
                                <div class="message-text">
                                    Hah, too late, I already bought it and my team is impleting the new design right now.
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>

                    <div class="chat-footer">
                        <textarea class="send-message-text"></textarea>
                        <label class="upload-file">
                            <input type="file" required="">
                            <i class="fa fa-paperclip"></i>
                        </label>
                        <button type="button" class="send-message-button btn-info"> <i class="fa fa-send"></i> </button>
                    </div>
                </div>
        </div>
    </div>


    
    
    
<?php 
  require_once("../layout/footer.php");
?>