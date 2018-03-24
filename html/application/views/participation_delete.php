<?php

$title = "Poista osallistuminen - 100 lajia";
include "page_elements/header.php";
?>

<p><strong>
Haluatko varmasti poistaa osallistumisesi?
</strong></p>



<?php
echo "<p>Osallistuja: " . $editableData['name'];
echo "<br>Paikkakunta: " . $editableData['location'];
echo "<br>Lajimäärä: " . $editableData['species_count'];
echo "</p>";

echo "<p>";
echo "<a href=\"" . site_url("participation/confirmdeletion") . "/" . $editableData['id'] . "\" id='deleteParticipation'>Poista</a> ";
echo "<a href=\"" . site_url("participation/edit") . "/" . $editableData['id'] . "\" id='cancel'>Peruuta</a>";
echo "</p>";

include "page_elements/footer.php";
?>