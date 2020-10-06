<?php 
  require_once("../layout/header.php");
  
  $id = $_GET['id'];

	if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
		header('Location: index.php?action=noid');
	}

	$row = getfromDBw("username, email, description, skills, location, memberID, notes, avatar, groupID, bg", "members", "memberid", $id);
	
	if ($row['avatar'] == "gravatar") {
		$email = $row['email'];;
		$default = "".$siteurl."img/default.png";
		$size = 200;

		$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
	} else {
		$grav_url = '../../../uploads/ua/'.$row['avatar'].'';
	}
	
	$usergroupIDp = $row['groupID'];

	if($usergroupIDp == 0){
		$lvlp = $l["user"];
	} else {
		$stmtgi = $db->prepare('SELECT * FROM groups WHERE id=:id');
		$stmtgi->execute(array(':id' => $usergroupIDp));
		$rogi = $stmtgi->fetch(PDO::FETCH_ASSOC);

		$grn = $rogi['title'];
		$grc = $rogi['color'];
		$lvlp = '<span style="color:'.$grc.'">'.$grn.'</span>';
	}
?>
<main role="main" class="container">
<div class="container">
	<div class="fb-profile">
        <img align="left" class="fb-image-lg" src="../../../uploads/bg/<?php echo $row["bg"]; ?>" alt="Profile image example" width="850" height="280"/>
        <img align="left" class="fb-image-profile thumbnail rounded-circle" src="<?php echo $grav_url; ?>" alt="Profile image example"/>
        <div class="fb-profile-text">
            <h1><?php echo $lvlp.' '.$row["username"]; ?> <?php if($row["username"] == $_SESSION["username"]){ echo '<a href="changebg"><i class="fas fa-edit"></i></a>'; }?></h1>
            <p><i class="fas fa-file-alt"></i> <? echo $row['description']; ?></p>
			<p><i class="fas fa-map-marker-alt"></i> <? echo $row['location']; ?></p>
			<p><? echo $row['skills']; ?></p>
			<?php

			if ($_SESSION['username'] == $row['username']) {
				echo '
					<p><span style="color:gray">'.$row["notes"].'</span></p>
				';
			}

			?>
        </div>
    </div>
</div>
<?php 
  require_once("../layout/footer.php");
?>