<?php
//header('Content-Type: text/html; charset=utf-8');

// TODO: siirrä controlleriin
if (! empty($participation))
{
	$speciesList = $participation[0]['species_finnish'];
	arsort($speciesList);

	echo "<h4 id=\"participant\">" . htmlspecialchars($participation[0]['name'], ENT_COMPAT, 'UTF-8') . " <span>(" . htmlspecialchars($participation[0]['meta_edited'], ENT_COMPAT, 'UTF-8') . ")</span></h4>";

	echo "<table id=\"tickTable\">\n";
	echo "<tr><th>Laji</th><th>Päivä</th></tr>\n";
	foreach ($speciesList as $abbr => $date)
	{
			echo "<tr><td>" . htmlspecialchars($abbr, ENT_COMPAT, 'UTF-8') . "</td>\n<td>" . htmlspecialchars($date, ENT_COMPAT, 'UTF-8') . "</td>\n</tr>\n";
	}
	echo "</table>\n";
}

?>

