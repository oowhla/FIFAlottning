<?php

include_once "include/top.php";
?>

<div class='container'>

<?php
$db = DB::getInstance();

$winmoney = $db->query("select name, winmoneyfifa, winmoneypoker, winmoneyfifa+winmoneypoker as winmoneytotal, total from players");
?>

<div class="row">
	<div class="col-sm-2 col-sm-offset-1 rubrik">
		Namn
	</div>
	<div class="col-sm-2 rubrik">
		FIFA
	</div>
	<div class="col-sm-2 rubrik">
		Poker
	</div>
	<div class="col-sm-2 rubrik">
		Vinstpengar
	</div>
	<div class="col-sm-2 rubrik">
		Efter insats
	</div>
</div>
<?php
foreach($winmoney->results() as $winnings) {
	echo "<div class='row rad'>
	<div class='col-sm-2 col-sm-offset-1 cell'>" . $winnings->name ."</div>
	<div class='col-sm-2 cell'>" . $winnings->winmoneyfifa . "</div>
	<div class='col-sm-2 cell'>" . $winnings->winmoneypoker ."</div>
	<div class='col-sm-2 cell'>" . $winnings->winmoneytotal ."</div>
	<div class='col-sm-2 cell'>" . $winnings->total ."</div>
	</div>";
}
echo "</table>";





include_once "include/bottom.php";

?>

