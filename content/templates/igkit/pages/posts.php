<?php 
  require_once("../layout/header.php");
  
  $stmt = $db->prepare('SELECT newID, newTitle, newAuthor, newDate, newCont, filename, rubrika, likes, dislikes FROM news ORDER BY newDate DESC LIMIT 2');
$stmt->execute(array());
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $db->prepare('SELECT username, email FROM members WHERE username="' . $row['newAuthor'] . '"');
$stmt2->execute(array());
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

if (!$stmt->execute())
{
	print_r($stmt->errorInfo());
}
?>
<main role="main" class="container">

	<div class="container py-5 text-center">
    <div class="jumbotron text-white jumbotron-image shadow" style="background-image: url(/assets/img/bg0.jpg">
      <h2 class="mb-4">
        <?php echo $siteTitle; ?>
      </h2>
      <p class="mb-4">
        <?php
                        use MinecraftServerStatus\MinecraftServerStatus;

                        require 'vendor/autoload.php';

                        $response = MinecraftServerStatus::query($serverIP, $serverPort);

                        if (!$response)
                        {
                            echo $mk["server_is_currently_offline"];
                        }
                        else
                        {
                            echo $mk["people_on_server_currently"] . ': ' . $response['players'] . ' ' . $mk["of"] . ' ' . $response['max_players'] . ' ' . $mk["players"];
                        }
                        ?>
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
				 <a class="btn btn-blog pull-left marginBottom10" href="viewnew?id='.$row["newID"].'">'.$mk["readmore"].'</a>
				 <div><a class="btn btn-blog pull-right marginBottom10" href="action.php?action=liken&id='.$row['newID'].'">'.$likes.' <i class="far fa-thumbs-up"></i></a></div>
            </div>
			<div class="col-md-12 gap10"></div>
		';
    }
?>
    </div>
</div>
<?php 
  require_once("../layout/footer.php");
?>