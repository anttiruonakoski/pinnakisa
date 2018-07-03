<?php
$title = "Pinnakisa";
include "page_elements/header.php";
?>

<h1>Pinnakisapalvelu</h1>
<p style="margin-top: -10px;">Täällä voit osallistua erilaisiin pinnakisoihin.

<?php

// $flash = $this->session->flashdata('login');
// if (! empty($flash))
// {
// 	echo "<div id=\"infoMessage\">" . $flash . "</div>";
// }

if (! $this->ion_auth->logged_in())
{
	echo " <a href=\"" . site_url("/auth/login") . "\"> Kirjaudu ensin sisään</a> osallistuaksesi.";
}

?>

</p>
<?php

//echo "<pre>"; print_r ($participations); echo "</pre>"; // debug

// -----
// TODO: tämä elegantimmin modelilla
/*
foreach ($publishedContests as $rowNumber => $array)
{
	$helper[$array['id']] = @$array['name'];
}
*/

$htmlPublished = "";
$htmlOther = "";

if (! empty($participations))
{
	foreach ($participations as $rowNumber => $array)
	{
		$temp = "
		<div class=\"participation\">
			<p><a href=\"" . site_url("participation/edit/" . $array['id']) . "\">" . $allContests[$array['contest_id']]['name'] . "</a><br /> " . $array['location'] . "<br /> " . $array['name'] . "</p>
		</div>
		";

		if ("published" == $allContests[$array['contest_id']]["status"])
		{
			$htmlPublished .= $temp;
		}
		else
		{
			$htmlOther .= $temp;
		}
	//	echo $rowNumber . " / " . $array["status"] . "<br />";
		$temp = "";
	}
}

// --------------------------------------------
// Open participarions

if ($this->ion_auth->logged_in())
{
	if (! empty($htmlPublished))
	{
		echo "<div class=\"participationsCol active\" id=\"active\">";

		// Published
		echo "<h3>Käynnissä olevat osallistumiseni</h3>";
		echo $htmlPublished;

		echo "</div>";
	}
	else
	{
		echo "<p>Et ole osallistunut käynnissä oleviin kisoihin.</p>";
	}
}

// --------------------------------------------
// Open contests

echo "<div class=\"contestsCol active\">";
echo "<h3>Meneillään olevat kisat</h3>";

foreach ($publishedContests as $rowNumber => $array)
{
//	print_r ($array); continue; // debug

	// Tulospalvelulinkki
	if ($array['location_list'])
	{
		$resultsLink = "
			<a href=\"" . site_url("results/area/" . $array['id']) . "\">Kuntien pinnat</a>
			|
			<a href=\"" . site_url("results/summary/" . $array['id']) . "\">Osallistujat</a>
		";
	}
	else
	{
		$resultsLink = "<a href=\"" . site_url("results/summary/" . $array['id']) . "\">Tulokset</a>";
	}


	echo "
	<div class=\"contest\">
	";
	if ($this->ion_auth->logged_in())
	{
		$temp = "participation/edit/?contest_id=" . $array['id'];
		echo "<p class=\"takePart\"><a href=\"" . site_url($temp) . "\">osallistu</a></p>";
	}
	else
	{
		// echo "<p class=\"notLoggedIn\"><a href=\"" . site_url("/auth/login") . "\">Kirjaudu sisään</a> tai <a href=\"" . site_url("/auth/create_user") . "\">rekisteröidy</a> osallistuaksesi</p>";

	}

	echo "<h4>" . @$array['name'] . "</h4>
		<p class='results'>$resultsLink</p>
		<p class='contestTime'>Kilpailuaika: " . date2Fin(@$array['date_begin']) . " &ndash; " . date2Fin(@$array['date_end']) . "</p>
		<p class='description'>" . str_replace("\n", "<p>", @$array['description']) . "</p>
		<p class='infoURL'>Lisää tietoa osoitteesta <a href='" . @$array['url'] . "'>" . @$array['url'] . "</a></p>
	</div>
	";

	$helper[$array['id']] = @$array['name'];
}
echo "</div>";

// --------------------------------------------
// Old contests

echo "<div class=\"contestsCol passive\">";
echo "<h3>Päättyneet kisat</h3>";

foreach ($archivedContests as $rowNumber => $array)
{
	echo "<div class=\"contest\">";
	echo "<h4>" . @$array['name'] . "</h4>
		<p class='results'><a href=\"" . site_url("results/summary/" . $array['id']) . "\">Tulospalvelu</a></p>
		<p class='contestTime'>Kilpailuaika: " . date2Fin(@$array['date_begin']) . " &ndash; " . date2Fin(@$array['date_end']) . "</p>
		<p class='infoURL'><a href='" . @$array['url'] . "'>" . @$array['url'] . "</a></p>
	</div>
	";

	$helper[$array['id']] = @$array['name'];
}

echo "</div>";

// --------------------------------------------
// Old participarions

if ($this->ion_auth->logged_in())
{
	if (! empty($htmlOther))
	{
		echo "<div class=\"participationsCol passive\" id=\"passive\">";

		// Drafts and archived
		echo "<h3>Päättyneet osallistumiseni</h3>";
		echo $htmlOther;

		echo "</div>";
	}
}




?>

<p>
Jos haluat perustaa uuden kisan, ota yhteyttä osoitteeseen <a class="inactiveLink" href="">web<span style="display:none">foo</span>master@lly.fi</a>
</p>

<?php

// ---------------------------------------------------------
// Admin menu

if ($this->ion_auth->logged_in())
{
	if ($this->ion_auth->is_admin())
	{
		echo "
		<div id=\"adminTools\">
		<h3>Ylläpitäjän työkalut</h3>
		<ul>
		";
		echo "<li><a href=\"" . site_url("contest/edit") . "\">Lisää uusi kisa</a></li>";
		echo "<li><a href=\"" . site_url("contest") . "\">Kaikki kisat</a></li>";
		echo "<li style=\"margin-top: 1em;\"><a href=\"" . site_url("auth") . "\">Käyttäjät</a></li>";
		echo "
		</ul>
		</div>
		";
	}
}
?>

<p id="logos">
   <a href="https://www.lly.fi/"><img src="<?php echo base_url(); ?>application/views/page_elements/lly_logo.gif"></a>
</p>

<?php
include "page_elements/footer.php";
?>