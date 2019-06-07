<?php session_start() ?>
<?php include 'game.php' ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Rock - Paper - Scissors</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" title="np title">
</head>
<body>

	<?php if( isset($_SESSION['username']) == FALSE ) : ?>
<form method="post">
	<h3>Please supply a username to play</h3>
	<label for="username">Username:</label>
	<input type="text" name="username" id="username"/>
	<input type="submit" name="submit" value="Let's Play"/>
</form>
	<?php else : ?>
		<div id="game">
		<h3>Welcome Back<?= $_SESSION['username'] ?> <span><a href="?Logout=true">Okinam:)</a></span></h3>
		<?php game() ?>		
	</div>
	<?php endif; ?>

</body>
</html>