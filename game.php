<?php

$con = mysqli_connect('localhost', 'root', '')
	or die(mysqli_error());

// mysqli_select_db('rps', $con)
// 	or die(mysqli_error());

	$con->select_db('rock_paper_scissors');

if( isset($_POST['submit']) ==  TRUE) :

	//Hold a variable
	$username = trim(mysqli_real_escape_string(strip_tags(stripcslashes($_POST['username']))));

	//store our session
	$_SESSION['username'] = $username;

	//Redirect the user
	header("Location:/");

endif;

if( isset($_GET['logout']) == TRUE ){
	session_destroy();
	header("Location: ./");
}

function display_items($item = null) {

	$items = array(
		"rock" => '<a href="?item=rock"><img src="img/rock.png" width="135" height="135" alt="Rock"></a>',
		"paper" => '<a href="?item=paper"><img src="img/paper.png" width="135" height="135" alt="Paper"></a>',
		"scissors" => '<a href="?item=Scissors"><img src="img/Scissors.png" width="135" height="135" alt="Scissors"></a>',

	);

			if( $item == null ):
				foreach ($items as $item => $value) :
					echo $value;
				endforeach;
			else :
				//echo $items[$item];

				echo str_replace("?item={$item}", "#", $items[$item]);
			endif;				
}
function game(){
		global $con;
		if( isset($_GET['item']) ==TRUE ) :

			//Valid Items
			$items = array('rock' , 'paper' , 'scissors');

			//User's Item
			$user_item = strtolower ($_GET['item']);

			//Computer's Item
			$comp_item = $items[rand(0,2)];

			//User's item isn't valid
			if( in_array($user_item, $items) == FALSE ) :
				echo '<div id="xxxx">You must choose either a Rock | Paper | Scissors.</div>';
				die;
			endif;

			//Scissors > Paper
			//Paper > Rock
			//Rock > Scissors

			if( $user_item == 'scissors' && $comp_item == 'paper' ||
				$user_item == 'paper' && $comp_item == 'rock' ||
				$user_item == 'rock' && $comp_item == 'scissors' ) :
					echo '<h1>You Win!</h1>';
					$outcome = 'yes';

			endif;

			if( $comp_item == 'scissors' && $user_item == 'paper' ||
				$comp_item == 'paper' && $user_item == 'rock' ||
				$comp_item == 'rock' && $user_item == 'scissors' ) :
					echo '<h1>You Lose!</h1>';
					$outcome = 'no';

			endif;

			if( $user_item == $comp_item ):
				echo '<h1>Tie!</h1>';
				$outcome = 'tie';
			endif;

			//User's item
			echo '<div id="img1">';
			display_items($user_item);
			echo '</div>';
			//Computer's item\
			echo '<div id="img2">';
			display_items($comp_item);
			echo '</div>';
			//add a go back link
			echo '<div id="again"><a href="./"><h3>Play Again!</h3></a></div>';

			$sql = "INSERT INTO `rock_paper_scissors` (`id`, `username`, `win`) VALUES ('null', '". $_SESSION['username']."', '$outcome')";
			
		else :

			display_items();

		endif;

}

?>		