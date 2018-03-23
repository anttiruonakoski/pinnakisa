<?php
$title = "Pinnakisa";
include "page_elements/header.php";

//echo "<pre>"; print_r ($species); echo "</pre>"; // debug

echo "<h1><a href=\"" . site_url("/results/summary/" . $contest['id']) . "\">&laquo;</a> " . htmlspecialchars($contest['name'], ENT_COMPAT, 'UTF-8') . "</h1>";

echo "<h3>Havaitut lajit</h3>";

if (!empty($species))
{
	if ($this->ion_auth->logged_in())
	{
		echo "<p>Havaitsemasi lajit on <span class=\"onMyList\">korostettu</span>.</p>";
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
			echo "	<td class=\"assa\">Ässä</td>";
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

	if ($this->ion_auth->logged_in() && ! empty($mySpeciesAbbrs))
	{
		$tiiraString = "";
		foreach ($mySpeciesAbbrs as $abbr => $data)
		{
			$tiiraString = $tiiraString . $abbr . "%2C+";
		}

		// Tiira-haku-string
	//	$tiiraString = $tiiraString . "%2C+" . urlencode($speciesFinnish); // controlleriin, lyhenteillä
		
		echo "<p><a href=\"http://tiira.fi/index.php?toiminto=29&laji=" . htmlspecialchars($tiiraString, ENT_COMPAT, 'UTF-8') . "&alue=0&kunta=&kerutoim=1&order1=pvm1&suunta1=desc&order2=syst_ord&suunta2=asc&limit=100&tilat=kaikki&yksmaara=&negahaku=on&paivamaara=2&paivamaara_a=&paivamaara_l=&aikaalue1=&aikaalue2=&haku=Hae\" target=\"_blank\">Tiira-haku puuttuvista lajeista</a> (kirjaudu ensin Tiiraan)</p>";
	}


	echo "<p id=\"totalSpecies\">Yhteensä " . ($rank - 1) . " lajia ja " . htmlspecialchars($participantCount, ENT_COMPAT, 'UTF-8') . " osallistujaa</p>";

}
else
{
	echo "<p>Kukaan ei ole vielä osallistunut tähän kisaan.</p>";
}


include "page_elements/footer.php";
?>