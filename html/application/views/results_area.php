<?php
$title = "Pinnakisa";
include "page_elements/header.php";

echo "<h1>" . $contest['name'] . "</h1>";

//echo $this->session->flashdata('login');



// Location contests
if (! empty($locations['speciesCounts']))
{
	// ---------------------------------------------------------------------------------
	// Alueet


	echo "<table class=\"resultTable\">";
	echo "<tr>";
	echo "	<th>Alue</th>";
	echo "	<th>Pinnat</th>";
	echo "</tr>";

	foreach ($locations['speciesCounts'] as $loc => $count)
	{
		echo "<tr>";
		echo "	<td>" . $loc . "</td>";
		echo "	<td>" . $count . "</td>";
		echo "</tr>";
	}

	echo "</table>";



	// ---------------------------------------------------------------------------------
	// Lajit

	require "includes/birds.php";

	echo "<table class=\"resultTable locations\">";
	echo "<tr>";
	echo "	<th>Laji</th>";
	foreach ($locations['locations'] as $loc => $tickArr)
	{
		echo "<th class=\"locationHeader\">$loc</th>";
	}
	echo "	<th>Yht.</th>";
	echo "</tr>";

	$ticksTotal = 0;
	foreach ($bird as $number => $birdArr)
	{
		$row = "";
		if (@$birdArr['sc'])
		{
			$row .= "<tr>
						<td>" . $birdArr['fi'] . "</td>";

			$ticksTotal = 0;
			foreach ($locations['locations'] as $loc => $tickArr)
			{
				if (1 == @$tickArr[$birdArr['abbr']])
				{
					$row .= "<td>X</td>";
					$ticksTotal++;
				}
				else
				{
					$row .= "<td>&nbsp;</td>";
				}
			}
			
			$row .= "	<td>" . $ticksTotal . "</td>";
			$row .= "</tr>";
		}
		
		// Print only rows with observation(s)
		if ($ticksTotal > 0)
		{
			if (1 == $ticksTotal)
			{
				$row = str_replace("<tr", "<tr class=\"ace\"", $row);
			}
			echo $row;
		}
	}

	echo "</table>";
	
}
else
{
	echo "<p>Kukaan ei ole vielä osallistunut tähän kisaan.</p>";
}


// echo "<pre>"; print_r ($locations); echo "</pre>"; // DEBUG

include "page_elements/footer.php";
?>