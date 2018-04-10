<?php
$title = "Havaitut lajit - 100 lintulajia";
include "page_elements/header.php";

//echo "<pre>"; print_r ($species); echo "</pre>"; // debug

echo "<h1><a href=\"" . site_url("/results/summary/" . $contest['id']) . "\">&laquo;</a> " . htmlspecialchars($contest['name'], ENT_COMPAT, 'UTF-8') . "</h1>";

echo "<h3>Kaikkien havaitsemat lajit</h3>";

if (!empty($species))
{
	if ($this->ion_auth->logged_in())
	{
		echo "<p>Havaitsemasi lajit on <span class=\"onMyList\">korostettu</span>";
	}

	echo "<table class=\"resultTable\" id=\"speciesTable\">";
	echo "<tr>";
	echo "	<th></th>";
	echo "	<th>Laji</th>";
	echo "	<th>Havainnut</th>";
	echo "	<th>%</th>";
	echo "</tr>";

	$rank = 1;
	$previousObsCount = 0;
	
	foreach ($species as $speciesFinnish => $arr)
	{
		// Row begins
		if (isset($mySpecies[$speciesFinnish]))
		{
			echo "<tr class=\"onMyList\">";
		}
		else
		{
			echo "<tr>";
		}

		// Rank
		if ($previousObsCount == $arr['count'])
		{
			echo "<td>&nbsp;</td>";
		}
		else
		{
			echo "<td>$rank.</td>";
		}
		
		// Species name
		echo "	<td>" . htmlspecialchars($speciesFinnish, ENT_COMPAT, 'UTF-8') . "</td>";
		
		// Observation count & percentage
		if (1 == $arr['count'])
		{
			echo "	<td class=\"assa\">1</td>";
			echo "	<td>" . htmlspecialchars($arr['oneObserver'], ENT_COMPAT, 'UTF-8') . "</td>";
		}
		else
		{
			echo "	<td>" . htmlspecialchars($arr['count'], ENT_COMPAT, 'UTF-8') . "</td>";
			echo "	<td>" . htmlspecialchars(round(($arr['count'] / $participantCount * 100), 0), ENT_COMPAT, 'UTF-8') . " %</td>";
		}
		
		// Row ends
		echo "</tr>";
		
		// Row data to memory
		$previousObsCount = $arr['count'];
		$rank++;
	}
	
	
	echo "</table>";

	echo "<p id=\"totalSpecies\">Yhteensä " . ($rank - 1) . " lajia ja " . htmlspecialchars($participantCount, ENT_COMPAT, 'UTF-8') . " osallistujaa</p>";

}
else
{
	echo "<p>Kukaan ei ole vielä osallistunut.</p>";
}


include "page_elements/footer.php";
?>