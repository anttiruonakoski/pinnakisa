<?php
header('Content-Type: text/html; charset=utf-8');

// TODO: siirrä controlleriin
$speciesList = $participation[0]['species_finnish'];
arsort($speciesList);

echo "<h4 id=\"participant\">" . $participation[0]['name'] . " (" . $participation[0]['meta_edited'] . ")</h4>";

echo "<table id=\"tickTable\">\n";
echo "<tr><th>Laji</th><th>Päivä</th></tr>\n";
foreach ($speciesList as $abbr => $date)
{
		echo "<tr><td>$abbr</td>\n<td>$date</td>\n</tr>\n";
}
echo "</table>\n";

?>

