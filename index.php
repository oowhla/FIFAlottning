<?php

include_once "include/top.php";
$db = DB::getInstance();
$playerNames = array();
$takenNumbers = array();
$raffleOK = false;
$players = $db->query("select name from players where active = 1");
$passwordOK = true;
foreach($players->results() as $player) {
	$playerNames[] = $player->name;
}
if(count($playerNames) & 1) {
	$playerNames[] = "Vakant";
}
?>

<div class='container'>


<hr><br>

<?php

if(isset($_POST["lottningsknapp"])) {
	if($_POST['password'] == "fifapuggow") {
		$j = 0;
		$teams = $db->query("select player1, player2 from teams");
		$teamsOK = false;
		while(!$teamsOK && $j < 500) {
			$takenNumbers = array();			
			for($i = 0; $i < count($playerNames); $i++) {
				$randomOK = false;
				while(!$randomOK) {
					$check = true;
					$playerIndex = rand(0, count($playerNames) - 1);
					foreach($takenNumbers as $number) {
						if($playerIndex == $number) {
							$check = false;
						}
					}
					if($check) {
						$randomOK = true;
						$takenNumbers[] = $playerIndex;
					}
				}
			}
			$check = true;
			for($i = 0; $i < count($playerNames); $i = $i+2) {
				foreach($teams->results() as $team) {
					if($team->player1 == $playerNames[$takenNumbers[$i]]) {
						if($team->player2 == $playerNames[$takenNumbers[$i + 1]]) {
							$check = false;
						}
					}
					if($team->player2 == $playerNames[$takenNumbers[$i]]) {
						if($team->player1 == $playerNames[$takenNumbers[$i + 1]]) {
							$check = false;
						}
					}
				}
			}
			if($check) {
				$teamsOK = true;
			} else {
				$j++;
			}		
		}

		if($teamsOK) {
			$rounds = $db->query("select max(round) as round from teams");
			$round = $rounds->first()->round + 1;

			for($i = 0; $i < count($playerNames); $i = $i+2) {
				$db->query("insert into teams(player1, player2, round) values('" . $playerNames[$takenNumbers[$i]] . "', '" . $playerNames[$takenNumbers[$i + 1]] . "', " . $round . ")");
			}
			$raffleOK = true;
		}
		
		if(!$raffleOK) {
			echo $messages['danger'] . "Inga möjliga lag hittades!" . $messages['end'];
		}
	}
	else {
		$passwordOK = false;
	}
}

if(!$passwordOK) echo $messages['danger'] . "Fel lösenord!" . $messages['end'];
?>	
<div id="lottningsdiv" class="col-sm-4 col-sm-offset-1">
		<form id="Spelare" method="POST">
			<table class="table table-striped table-bordered">
				<tr>
					<td class='data' colspan='1'><strong>Aktiva spelare</strong></td>
				</tr>
				<?php
				$players = $db->query("select name from players where active = 1");
				foreach($players->results() as $player) {
					echo "<tr>
					<td class='data'>" . $player->name ."</td>
					</tr>";
				}
				?>
			</table>
			<div class='input-group'>
				<input name='password' class='form-control' type="password" placeholder="Lösenord">
		 		<span class='input-group-btn'>
					<button name='lottningsknapp' class='btn btn-default confirm' type='submit'>Slumpa lag</button>
				</span>
			</div>
		</form>
</div>

<?php
if(isset($_POST["lottningsknapp"]) && $raffleOK) {
?>
<div id="lagdiv" class="col-sm-4 col-sm-offset-2">
		<form id="Lag" method="POST">
			<table class="table table-striped table-bordered">
				<tr>
					<td class='data' colspan='2'><strong>Slumpade lag</strong></td>
				</tr>
				<tr>
					<td class='data' colspan='1'><strong>Lagkapten</strong></td>
					<td class='data' colspan='1'><strong>Medspelare</strong></td>
				</tr>
				<?php
				for($i = 0; $i < count($playerNames); $i = $i+2) {
					echo "<tr>
					<td class='data'>" . $playerNames[$takenNumbers[$i]] ."</td>
					<td class='data'>" . $playerNames[$takenNumbers[$i + 1]] ."</td>
					</tr>";
				}
			?>
			</table>
		</form>
</div>

<?php
}
?>


<?php
include_once "include/bottom.php";

?>

