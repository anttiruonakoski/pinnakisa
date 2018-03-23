<?php
$title = "TEST";
include "page_elements/header.php";
?>

<h1>TEST</h1>

<?php

echo $this->session->flashdata('login');

// ---------------------------------------------------------
// Admin menu

/*
if ($this->ion_auth->logged_in())
{
	if ($this->ion_auth->is_admin())
	{
		echo "
		<div id=\"adminTools\">
		<h3>Ylläpitäjän työkalut</h3>
		<ul>
		";
		echo "<li><a href=\"" . base_url("contest/edit") . "\">Lisää uusi kisa</a></li>";
		echo "<li><a href=\"" . base_url("contest") . "\">Kaikki kisat</a></li>";
		echo "<li style=\"margin-top: 1em;\"><a href=\"" . base_url("auth") . "\">Käyttäjät</a></li>";
		echo "
		</ul>
		</div>
		";
	}
}
*/
?>

<?php
include "page_elements/footer.php";
?>