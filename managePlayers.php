<?php

include_once "include/top.php";
$db = DB::getInstance();
$exists = false;
$added = false;
if(Input::exists()) {
	if(isset($_POST["playerName"])) {
		$playerName = $_POST["playerName"];
		$players = $db->query("select name from players");
		foreach($players->results() as $player) {
			if($player->name == $playerName) {
				$exists = true;
			}
		}
		if(!$exists) {
			$db->query("insert into Players (name) values ('" . $playerName . "')");
			$added = true;
		}
	}
}
if(isset($_POST["inactivate"])) {
	$playerName = $_POST["inactivate"];
	$db->query("update Players set active = 0 where name = '" . $playerName . "'");
} 
if(isset($_POST["activate"])) {
	$playerName = $_POST["activate"];
	$db->query("update Players set active = 1 where name = '" . $playerName . "'");
} 
?>

<div class='container'>
<hr>
<?php if($exists) echo $messages['danger'] . "Spelaren finns redan!" . $messages['end'];?>
<?php if($added) echo $messages['success'] . "Spelaren tillagd!" . $messages['end'];?>
	<div class='row'>
		<div class='col-md-4 col-md-offset-1'>
			<?php
			$players = $db->query("select name from players where active = 1");
			foreach($players->results() as $player) {
				echo "
				<form id='inactivatePlayer' method='post'>
					<div class='input-group'>
						<input name='inactivate' class='form-control' value='". $player->name . "' readonly>
				 		<span class='input-group-btn'>
							<button class='btn btn-default inactivate' type='submit'>Inaktivera</button>
						</span>
					</div>
				</form>";
			}

			?>
		</div>
		<div class='col-md-4 col-md-offset-1'>
			<?php
			$players = $db->query("select name from players where active = 0");
			foreach($players->results() as $player) {
				echo "
					<form id='activatePlayer' method='post'>
					<div class='input-group'>
						<input name='activate' class='form-control' value='". $player->name . "' readonly>
				 		<span class='input-group-btn'>
							<button class='btn btn-default activate' type='submit'>Aktivera</button>
						</span>
					</div>
				</form>";
			}

			?>
		</div>
	</div>
	<br><hr><br>

	<?php 
	if($players->count() == 0) {
		?>
		<div class='row'>
		<div class='col-md-4 col-md-offset-1'>
			<form id="addPlayer" method="post">
					<div class='input-group'>
						<input name='add' class='form-control' placeholder='Spelare att lägga till'>
				 		<span class='input-group-btn'>
							<button class='btn btn-default add1' type='submit'>Lägg till</button>
						</span>
					</div>
			</form>
		</div>
	</div>
	<?php
	}
	else {
	?>
	<div class='row'>
		<div class='col-md-4 col-md-offset-4'>
			<form id="addPlayer" method="post">
					<div class='input-group bothActive'>
						<input name='add' class='form-control' placeholder='Spelare att lägga till'>
				 		<span class='input-group-btn'>
							<button class='btn btn-default add' type='submit'>Lägg till</button>
						</span>
					</div>
			</form>
		</div>
	</div>
	<?php } ?>	
</div>
<?php

include_once "include/bottom.php";

?>
