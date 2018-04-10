<?php
$title = "Tunnista 100 lintulajia";
include "page_elements/header.php";
?>

<h1>Tunnista ja havaitse 100 lintulajia vuoden 2018 aikana!</h1>

<p>Saavutatko sinä 100 lajin rajapyykin? Haasta myös kaverisi mukaan!</p>


<?php

$flash = $this->session->flashdata('login');
if (! empty($flash))
{
	echo "<div id=\"infoMessage\">" . $flash . "</div>";
}

/*
if (! $this->ion_auth->logged_in())
{
	echo " <a href=\"" . site_url("/auth/login") . "\">Kirjaudu ensin sisään</a> osallistuaksesi.";
}
*/

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

/*
NOTE: THIS EXPECTS THAT THERE IS ONLY ONE COMPETITION !!
alreadyParticipated
*/

if (! empty($participations))
{
	$alreadyParticipated = true;
	foreach ($participations as $rowNumber => $array)
	{
		$temp = "
		<div class=\"participation\">
		<p>" . $array['name'] . ", " . $array['location'] . "</p>
		<p class=\"takePart\"><a href=\"" . site_url("participation/edit/" . $array['id']) . "\">Päivitä omaa lajiluetteloa<!--" . $allContests[$array['contest_id']]['name'] . "--></a></p>
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
else {
	$alreadyParticipated = false;
}

// --------------------------------------------
// Open participarions

if ($this->ion_auth->logged_in())
{
	if (! empty($htmlPublished))
	{
		echo "<div class=\"participationsCol active\" id=\"active\">";
		
		// Published
		echo "<h3><!--Osallistumiseni--></h3>";
		echo $htmlPublished;

		echo "</div>";
	}
	else
	{
		echo "<p>Et ole vielä osallistunut.</p>";
	}
}

// --------------------------------------------
// Open contests

echo "<div class=\"contestsCol active\">";

echo "<!--<h3>Osallistu tästä</h3>-->";

if (! $alreadyParticipated) {

	foreach ($publishedContests as $rowNumber => $array)
	{
	//	print_r ($array); continue; // debug

		echo "
		<div class=\"contest\">
		";
		if ($this->ion_auth->logged_in())
		{
			$temp = "participation/edit/?contest_id=" . $array['id'];
			echo "<p class=\"takePart\"><a href=\"" . site_url($temp) . "\">Osallistu haasteeseen</a></p>";
		}
		else
		{
			echo "<p class=\"notLoggedIn\"><a href=\"" . site_url("/auth/login") . "\">Kirjaudu sisään</a> tai <a href=\"" . site_url("/auth/create_user") . "\">rekisteröidy</a> osallistuaksesi</p>";

		}
		$helper[$array['id']] = @$array['name'];
	}
	echo "</div>";

}

foreach ($publishedContests as $rowNumber => $array)
{

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
		$resultsLink = "
			<a href=\"" . site_url("results/summary/" . $array['id']) . "\">100 lajia ylittäneet</a>
			<a href=\"" . site_url("results/species/" . $array['id']) . "\">Kokonaislajiluettelo</a>
		";
	}

	echo "<!--<h4>" . @$array['name'] . "</h4>-->
		<p class='description'>" . str_replace("\n", "<p>", @$array['description']) . "</p>
		<p class='contestTime'>Osallistumisaika: " . date2Fin(@$array['date_begin']) . " &ndash; " . date2Fin(@$array['date_end']) . "</p>
		<p class='infoURL'>Lisää tietoa osoitteesta <a href='" . @$array['url'] . "'>" . @$array['url'] . "</a></p>
		<p class='results'>$resultsLink</p>
	</div>
	";

}

// --------------------------------------------
// Old contests
/*
echo "<div class=\"contestsCol passive\">";
echo "<h3>Päättyneet kisat</h3>";

foreach ($archivedContests as $rowNumber => $array)
{
	echo "<div class=\"contest\">";
	echo "<h4>" . @$array['name'] . "</h4>
		<p class='results'><a href=\"" . site_url("results/summary/" . $array['id']) . "\">Tulospalvelu</a></p>
		<p class='contestTime'>Kilpailuaika: " . @$array['date_begin'] . " &ndash; " . @$array['date_end'] . "</p>
		<p class='infoURL'><a href='" . @$array['url'] . "'>" . @$array['url'] . "</a></p>
	</div>
	";
	
	$helper[$array['id']] = @$array['name'];
}

echo "</div>";
*/
// --------------------------------------------
// Old participarions
/*
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
*/


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
    <a href="https://www.birdlife.fi/"><img src="<?php echo base_url(); ?>application/views/page_elements/birdlife.png"></a>
    <a href="https://www.birdlife.fi/100lintulajia"><img src="<?php echo base_url(); ?>application/views/page_elements/100lajia.jpg"></a>
</p>

<?php
include "page_elements/footer.php";
?>