<?php
include_once "include/top.php";
$db = DB::getInstance();
$passwordOK = true;
if(Input::exists()) {
	if(isset($_POST["fifavinst"])) {
		if($_POST['password'] == "fifapuggow") {
			$vinster = $_POST["fifavinst"];
			$names = $_POST["name"];
			foreach($names as $key => $namn) {
				$db->query("update Players set winmoneyfifa = winmoneyfifa + " . $vinster[$key] . " where name='" . $namn ."'");
				$db->query("update Players set roundsplayed = roundsplayed + 1 where name='" . $namn . "'");
			}
		} else $passwordOK = false;
	}
	if (isset($_POST["pokervinst"])) {
		echo "hej";
		if($_POST['password'] == "fifapuggow") {
			$vinster = $_POST["pokervinst"];
			$names = $_POST["name"];
			foreach($names as $key => $namn) {
				$db->query("update Players set winmoneypoker = winmoneypoker + " . $vinster[$key] . " where name='" . $namn ."'");
				$db->query("update Players set roundsplayed = roundsplayed + 1 where name='" . $namn . "'");
			}
		} else $passwordOK = false;
	}	
} 
?>

<div class='container'>
<?php if(!$passwordOK) echo $messages['danger'] . "Fel lösenord!" . $messages['end'];?>
	<div class="row">
		<div class="col-sm-3">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" name="aktivitetKnapp" id="aktivitetKnapp"> 
				Välj aktivitet <span class='caret'></span>
			</button>
			<ul class="dropdown-menu" role="menu" ID="aktivitet">
				<li><a href='#'>FIFA</a></li>
				<li><a href='#'>Poker</a></li>
			</ul>
		</div>
	</div>
	<br>
	<br>
	<div class="row">
		<div id="fifadiv" class="col-sm-4">
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
					$players = $db->query("select name from players");
					$pos = 1;
					foreach($players->results() as $player) {
						echo "<tr>
						<td class='data'><input name='name[]' type='checkbox' value='"  . $player->name . "' checked></td>
						<td class='data'><label>" . $player->name ."</label></td>
						<td class='data'><input class='fifavinst' name='fifavinst[]' type='text' value='0'></td>
						</tr>";
						$pos++;
					}
					?>
				</table>
				<input name="password" type="password" placeholder="Lösenord">
				<button type="submit">Bekräfta</button>
			</form>
		</div>
		<div id="pokerdiv" class="col-sm-4">
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
					$players = $db->query("select name from players");
					$pos = 1;
					foreach($players->results() as $player) {
						echo "<tr>
						<td class='data'><input name='name[]' type='checkbox' value='"  . $player->name . "' checked></td>
						<td class='data'><label>" . $player->name ."</label></td>
						<td class='data'><input class='pokervinst' name='pokervinst[]' type='text' value='0'></td>
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
		<script>
			document.getElementById("pokerdiv").style.display = "none";
			document.getElementById("fifadiv").style.display = "none";
		</script>