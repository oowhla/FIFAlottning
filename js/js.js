$('.dropdown-toggle').dropdown();
$('#aktivitet li').on('click', function() {
	$('#aktivitetKnapp').html($(this).find('a').html() + "   <span class='caret'></span>");
	if($.trim($(this).find('a').html()) == "FIFA") {
		document.getElementById("pokerdiv").style.display = "none";
		document.getElementById("fifadiv").style.display = "inline-block";
		$(".pokervinst").each(function() {
			$(this).val("0");
		});
	} else if ($.trim($(this).find('a').html()) == "Poker") {
		document.getElementById("fifadiv").style.display = "none";
		document.getElementById("pokerdiv").style.display = "inline-block";
		$(".fifavinst").each(function() {
			$(this).val("0");
		});
	} 
});