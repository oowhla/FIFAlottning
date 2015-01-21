<?php

include_once "include/top.php";
?>

<div class='container'>
<hr><br>
	<?php
	$db = DB::getInstance();
	
	// select default
	$sortDefault = 'winmoneytotal'; 

// select array
	$sortColumns = array('name','winmoneyfifa', 'winmoneypoker', 'winmoneytotal', 'total', 'roundsplayed');

// select query
	$sort = isset($_GET['sort']) && in_array($_GET['sort'], $sortColumns) ? $_GET['sort'] : $sortDefault; 


	$winmoney = $db->query("select name, winmoneyfifa, winmoneypoker, winmoneyfifa+winmoneypoker as winmoneytotal, 
							(winmoneyfifa+winmoneypoker-(100*roundsplayed)) as total, roundsplayed from players where active = 1 order by ". $sort ." desc");
	?>

	<table class="table table-striped table-bordered">
		<tr>
			<td class='nummer'><strong>#</strong></td>
			<td class='data'><a href='?sort=name'><strong>Namn</strong></a></td>
			<td class='data'><a href='?sort=roundsplayed'><strong>Spelade omgångar</strong></a></td>
			<td class='data'><a href='?sort=winmoneyfifa'><strong>FIFA</strong></a></td>
			<td class='data'><a href='?sort=winmoneypoker'><strong>Poker</strong></a></td>
			<td class='data'><a href='?sort=winmoneytotal'><strong>Totalt</strong></a></td>
			<td class='data'><a href='?sort=total'><strong>Resultat inkl insats</strong></a></td>
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
		?>

	</table>
</div>

<?php
	include_once "include/bottom.php";
?>

