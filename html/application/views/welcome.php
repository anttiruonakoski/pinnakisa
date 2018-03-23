<?php
$title = "Pinnakisa";
include "page_elements/header.php";
?>

<h1>Pinnakisapalvelu</h1>
<p style="margin-top: -10px;">Täällä voit osallistua erilaisiin pinnakisoihin.

<?php

if (! $this->ion_auth->logged_in())
{
	echo " <a href=\"" . site_url("/auth/login") . "\">Kirjaudu ensin sisään</a> osallistuaksesi.";
}

?>


</p>

<?php

echo $this->session->flashdata('login');

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
//		echo "<p class=\"takePart\">Kirjaudu sisään ja osallistu</p>";

	}
	echo "<h4>" . @$array['name'] . "</h4>
		<p class='results'>$resultsLink</p>
		<p class='contestTime'>Kilpailuaika: " . @$array['date_begin'] . " &ndash; " . @$array['date_end'] . "</p>
		<p class='description'>" . str_replace("\n", "<p>", @$array['description']) . "</p>
		<p class='infoURL'><a href='" . @$array['url'] . "'>" . @$array['url'] . "</a></p>
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
		<p class='contestTime'>Kilpailuaika: " . @$array['date_begin'] . " &ndash; " . @$array['date_end'] . "</p>
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
Jos haluat perustaa uuden kisan, ota yhteyttä osoitteeseen 
<script type="text/javascript">
//<![CDATA[
<!--
var x="function f(x){var i,o=\"\",l=x.length;for(i=l-1;i>=0;i--) {try{o+=x.c" +
"harAt(i);}catch(e){}}return o;}f(\")\\\"function f(x,y){var i,o=\\\"\\\\\\\""+
"\\\\,l=x.length;for(i=0;i<l;i++){if(i==52)y+=i;y%=127;o+=String.fromCharCod" +
"e(x.charCodeAt(i)^(y++));}return o;}f(\\\"\\\\PZUBU\\\\\\\\\\\\\\\\TO\\\\\\" +
"\\022JLV4$.-lgz&h!8.*p\\\\\\\\022m=0;? :l<1*;/\\\\\\\\034),6\\\\\\\\016\\\\" +
"\\\\006\\\\\\\\003M\\\\\\\\002\\\\\\\\014:E=jvTMG\\\\\\\\036x\\\\\\\\007z\\" +
"\\\\\\005\\\\\\\\026BCXMYn[BX\\\\\\\\\\\\\\\\TU\\\\\\\\033P^\\\\\\\\004\\\\" +
"\\\\026[\\\\\\\\005\\\\\\\\036\\\\\\\\024\\\\\\\\005\\\\\\\\017{\\\"\\\\,52" +
")\\\"(f};)lo,0(rtsbus.o nruter};)i(tArahc.x=+o{)--i;0=>i;1-l=i(rof}}{)e(hct" +
"ac};l=+l;x=+x{yrt{)35=!)31/l(tAedoCrahc.x(elihw;lo=l,htgnel.x=lo,\\\"\\\"=o" +
",i rav{)x(f noitcnuf\")"                                                     ;
while(x=eval(x));
//-->
//]]>
</script>
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

<?php
include "page_elements/footer.php";
?>