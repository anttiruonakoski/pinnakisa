<?php

// Format max javascript date for datepicker
$dateBeginParts = explode("-", $contest['date_begin']);
$dateBeginJS = "new Date(" . $dateBeginParts[0] . "," . ($dateBeginParts[1] - 1) . "," . $dateBeginParts[2] . ")";

//echo "<pre>"; print_r ($contest); echo "</pre>"; // debug


$title = "100 lajia";
$script = "
<script>
	//	$.datepicker.formatDate('ISO_8601', date, settings)
	$(function() {
		$.datepicker.setDefaults( $.datepicker.regional[ 'fi' ] );
		$('.datepicker').datepicker({
			minDate: " . $dateBeginJS . ",
			maxDate: '0'
		});
	});
	// DATE FIELD: datepicker
	$(function() {
	  $('.datepicker').click(function() {
		$(this).css('border', 'none');
		$(this).parent().find('.del').css('display', 'inline');
		$(this).parent().find('.sp').css('font-weight', 'bold');
		event.preventDefault(); // Prevents keyboard in mobile; this has to be the last rule b/c Firefox 24.0 won't apply (CSS) rules after this.
	  });
	});
	// SPECIES NAME: today's date
	$(function() {
	  $('.sp').click(function() {
		$(this).parent().find('.datepicker').datepicker('setDate', new Date()).css('border', 'none');
		$(this).parent().find('.del').css('display', 'inline');
		$(this).parent().find('.sp').css('font-weight', 'bold');
	  });
	});
	// DELETE: remove date
	$(function() {
	  $('.del').click(function() {
		$(this).parent().find('.datepicker').val('').css('border', '1px solid #ccc');
		$(this).parent().find('.del').css('display', 'none');
		$(this).parent().find('.sp').css('font-weight', 'normal');
	  });
	});


	$(document).ready(function() {

		// Add action to form so that submit works
		$('#participation-form').attr({
		  action: '" . base_url() . "index.php/participation/edit/" . @$editableData['id'] . "'
		});

		// Enable submit button
		$('.submit-button').prop('disabled', false);

	});





 </script>
";
include "page_elements/header.php";
?>

<div id="contestToTakePart">

<h1>
<em>Osallistuminen </em> 
<?php
echo $contest['name'];
echo " <em>-haasteeseen ";
echo " <span>(<a href=\"" . site_url("results/summary") . "/" . $contest['id'] . "\">Haasteen tulokset</a>)</span></em>";

?>
</h1>

<p class="tip">Vinkki: tallenna tämä sivu selaimesi kirjanmerkkeihin, niin pääset helposti lisäämään lajeja.</p>

<?php
if (@$alreadyTakenPart)
{
	echo "<p id=\"alreadyParticipated\">HUOM! Olet jo osallistunut. Voit kuitenkin tallentaa tässä osallistumisen toisen henkilön puolesta (esim. perheenjäsenen).</p>";
}
?>

<p>
<?php
// echo "Kilpailuaika: " . $contest['date_begin'] . "&ndash;" . $contest['date_end'];
// echo "<a href=\"" . $contest['url'] . "\" target=\"_blank\">Lue lisää &raquo;</a>";
?>
 
</p>

<?php
$flash = $this->session->flashdata('flash');
if (! empty($flash))
{
	$validation_errors = validation_errors();
	if (empty($validation_errors))
	{
		$class = "validation-ok";
	}
	else
	{
		$class = "validation-errors";
	}
	echo "<div id=\"infoMessage\" class=\"$class\">" . $flash . " " . $validation_errors . "</div>";
}
?>

</div>

<?php
// echo "<pre>ARRAY: "; print_r ($editableData); echo "</pre>"; // debug

$submitButton = "";
if ("published" == $contest['status'])
{
//	echo form_open("foo", array('id' => 'participation-form'));
	echo "<form action method=\"post\" accept-charset=\"utf-8\" id=\"participation-form\"> ";

	$submitButton = "<p><input type=\"submit\" class=\"submit-button\" value=\"Tallenna\"  disabled=\"disabled\" /></p>";
}
elseif ("archived" == $contest['status'])
{
	echo "<p id=\"notification\">Osallistumisaika on päättynyt, eikä tietoja voi enää muokata.</p>";
}
else
{
	echo "<p id=\"notification\">Osallistuminen ei ole nyt käynnissä, eikä tietoja voi muokata.</p>";
}

?> 

<input type="hidden" name="contest_id" value="<?php echo @$editableData['contest_id']; ?>" />

<p class="required">Nimesi (Etu- ja sukunimi)</p>
<input type="text" name="name" class="required" value="<?php echo @$editableData['name']; ?>" size="50" />

<p class="required">Paikkakunta (ei tarkkaa osoitetta)</p>

<?php
if (@$locationArray)
{
	$dropdown = form_dropdown('location', $locationArray, @$editableData['location']);
	echo str_replace("<select", "<select class=\"required\"", $dropdown);
}
else
{
	echo "<input type=\"text\" name=\"location\" value=\"" . @$editableData['location'] . "\" size=\"30\" />";
}

echo $submitButton;

echo "<h4>Havaitsemasi lajit ";
if (isset($editableData['species_count']))
{
	echo "(yhteensä " . $editableData['species_count'] . ")";
}
echo "</h4>";
echo "<p>Klikkaa lajin nimeä jos havaitsit lajin tänään, tai päivämääräkenttää jos havaitsit sen aiemmin.</p>";
echo "<p id='rarityVisibility'><span id='showRarities'>Näytä myös harvinaiset</span> <span id='hideRarities'>Piilota harvinaiset</span></p>";


// Species list begins

include "application/views/includes/birds.php";
echo "<div id=\"speciesList\">\n";
echo "<div class=\"col\">";
foreach ($bird as $key => $arr)
{
	if (@$arr['sc']) // If is species, and not higher taxon
	{
		$setClass = "";
		if (@$arr['rarity']) // If is marked as rare
		{
			$setClass .= " rare rarity" . $arr['rarity'];
		}

		if (!empty($editableData['species'][$arr['abbr']])) // TODO: pitäisikö tyhjät solut kokonaan poistaa (modelissa)
		{
			$setClass .= " isSet";
		}
		// Column breakpoints
		if ("CHAASI" == $arr['abbr'] || "ANTCAM" == $arr['abbr']) {
			echo "</div>\n<div class=\"col\">";
		}
		echo "<p class=\"$setClass\"><em class=\"sp\">" . $arr['fi'];
		$vn = "species[" . $arr['abbr'] . "]";
		echo "</em> <input type=\"text\" class=\"datepicker\" name=\"$vn\" value=\""	. set_value($vn, @$editableData['species'][$arr['abbr']]) . "\" size=\"8\" readonly />";
		echo "<span class=\"del\">X</span>\n";
		echo "</p>\n";
	}
	else // If is higher taxon
	{
		echo "<h5>" . $arr['abbr'] . "</h5>";
	}
}
echo "</div>"; // col
echo "</div>";
// Species list ends


echo "<input type=\"hidden\" name=\"form_loaded\" id=\"form_loaded\" value=\"true\">";

echo $submitButton;
if ("published" == $contest['status'])
{
	echo "</form>";
}

include "page_elements/footer.php";
?>