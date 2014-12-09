<?php

include_once "include/top.php";
?>

<div class='container'>

	<?php
	$db = DB::getInstance();

	$winmoney = $db->query("select name, winmoneyfifa, winmoneypoker, winmoneyfifa+winmoneypoker as winmoneytotal, (winmoneyfifa+winmoneypoker-(100*roundsplayed)) as total, roundsplayed from players order by winmoneytotal desc");
	?>

	<table class="table table-striped table-bordered">
		<tr>
			<td class='nummer'><strong>#</strong></td>
			<td class='data'><strong>Namn</strong></td>
			<td class='data'><strong>Spelade omgångar</strong></td>
			<td class='data'><strong>FIFA</strong></td>
			<td class='data'><strong>Poker</strong></td>
			<td class='data'><strong>Totalt</strong></td>
			<td class='data'><strong>Resultat inkl insats</strong></td>
		</tr>
		<?php


		$pos = 1;
		foreach($winmoney->results() as $winnings) {
			echo "<tr>
			<td class='nummer'>" . $pos . "</td>
			<td class='data'><strong>" . $winnings->name ."</strong></td>
			<td class='data'>" . $winnings->roundsplayed ."</td>
			<td class='data'>" . $winnings->winmoneyfifa . "</td>
			<td class='data'>" . $winnings->winmoneypoker ."</td>
			<td class='data'>" . $winnings->winmoneytotal ."</td>
			<td class='data'>" . $winnings->total ."</td>
			</tr>";
			$pos++;
		}
	echo "</table>";





	include_once "include/bottom.php";

	?>

