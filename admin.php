<?php
include_once "include/top.php";
$db = DB::getInstance();
$passwordOK = true;
$inputOK = false;
if(Input::exists()) {
	if(isset($_POST["fifavinst"])) {
		if($_POST['password'] == "fifapuggow") {
			foreach($_POST["name"] as $key => $namn) {
				$db->query("update Players set winmoneyfifa = winmoneyfifa + " .  $_POST["fifavinst"][$key] . " where name='" . $namn ."'");
				$db->query("update Players set roundsplayed = roundsplayed + 1 where name='" . $namn . "'");
			}
			$inputOK = true;
		} else $passwordOK = false;
	}
	if (isset($_POST["pokervinst"])) {
		if($_POST['password'] == "fifapuggow") {
			foreach($_POST["name"] as $key => $namn) {
				$db->query("update Players set winmoneypoker = winmoneypoker + " . $_POST["pokervinst"][$key] . " where name='" . $namn ."'");
				$db->query("update Players set roundsplayed = roundsplayed + 1 where name='" . $namn . "'");
			}
			$inputOK = true;
		} else $passwordOK = false;
	}	
} 
?>

<div class='container'>
<hr>
<?php if(!$passwordOK) echo $messages['danger'] . "Fel lösenord!" . $messages['end'];?>
<?php if($inputOK) echo $messages['success'] . "Resultat sparat!" . $messages['end'];?>
	
	<br>
	<div class="row">
		<div id="fifadiv" class="col-sm-4 col-sm-offset-1">
			<form id="FIFA" method="post">
				<table class="table table-striped table-bordered">
					<tr>
						<td class='data' colspan="3">
							<strong>FIFA</strong>
						</td>
					</tr>
					<tr>
						<td class='data'><strong>Deltog</strong></td>
						<td class='data'><strong>Namn</strong></td>
						<td class='data'><strong>Vinst</strong></td>
					</tr>
					<?php
					$players = $db->query("select name from players where active = 1");
					$pos = 1;
					foreach($players->results() as $player) {
						echo "<tr>
						<td class='data'><input name='name[".$player->name."]' type='checkbox' value='"  . $player->name . "' checked></td>
						<td class='data'><label>" . $player->name ."</label></td>
						<td class='data'><input class='fifavinst' name='fifavinst[".$player->name."]' type='text' value='0'></td>
						</tr>";
						$pos++;
					}
					?>
				</table>
				<input name="password" type="password" placeholder="Lösenord">
				<button type="submit">Bekräfta</button>
			</form>
		</div>
		<div id="pokerdiv" class="col-sm-4 col-sm-offset-2">
			<form id="Poker" method="POST">
				<table class="table table-striped table-bordered">
					<tr>
						<td class='data' colspan="3">
							<strong>Poker</strong>
						</td>
					</tr>
					<tr>
						<td class='data'><strong>Deltog</strong></td>
						<td class='data'><strong>Namn</strong></td>
						<td class='data'><strong>Vinst</strong></td>
					</tr>
					<?php
					$players = $db->query("select name from players where active = 1");
					$pos = 1;
					foreach($players->results() as $player) {
						echo "<tr>
						<td class='data'><input name='name[".$player->name."]' type='checkbox' value='"  . $player->name . "' checked></td>
						<td class='data'><label>" . $player->name ."</label></td>
						<td class='data'><input class='pokervinst' name='pokervinst[".$player->name."]' type='text' value='0'></td>
						</tr>";
						$pos++;
					}
					?>
				</table>
				<input name="password" type="password" placeholder="Lösenord">
				<button type="submit">Bekräfta</button>
			</form>
		
		</div>

		<?php
		include_once "include/bottom.php";
		?>

		<script src="js/js.js"></script>
	