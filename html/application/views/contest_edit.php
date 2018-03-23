<?php
$title = "Pinnakisa";
$script = "
<script>
	//	$.datepicker.formatDate('ISO_8601', date, settings)
	$(function() {
		$.datepicker.setDefaults( $.datepicker.regional[ 'fi' ] );
		$('.datepicker').datepicker({

		});
	});

	$(function() {
	  $('.datepicker').click(function() {
		$(this).css('border', 'none');
		$(this).parent().find('.del').css('display', 'inline');
		$(this).parent().find('.sp').css('font-weight', 'bold');
	  });
	});
 </script>
";
include "page_elements/header.php";
?>

<h1>Muokkaus</h1>

<?php
echo "<div id=\"infoMessage\">" . $this->session->flashdata('flash') . " " . validation_errors() . "</div>";

//echo "<pre>ARRAY: "; print_r ($editableData); echo "</pre>"; // debug
?>

<?php echo form_open("contest/edit/" . @$editableData['id']); ?>

<h4>Kisan nimi (yksilöivä, esim. 'Ekopinnakisa 2014')</h4>
<input type="text" name="name" class="required" value="<?php echo $editableData['name']; ?>" size="50" />

<h4>Lyhyt kuvaus</h4>
<textarea name="description" rows="10" cols="100" class="required">
<?php echo $editableData['description']; ?>
</textarea>

<?php // TODO: jQuery date tool: validation, no overlapping dates ?>
<h4>Alku- ja loppupäivämäärä (muodossa vvvvkkpp)</h4>
<input type="text" name="date_begin" class="datepicker required" value="<?php echo $editableData['date_begin']; ?>" size="10" /> ... 
<input type="text" name="date_end" class="datepicker required" value="<?php echo $editableData['date_end']; ?>" size="10" />

<h4>Lisätieto-www-osoite (aloita http...)</h4>
<input type="text" name="url" class="required" value="<?php echo $editableData['url']; ?>" size="100" />

<h4>Vertailu aiempaan kisaan (jätä tyhjäksi)</h4>
<input type="text" name="comparison" value="<?php echo $editableData['comparison']; ?>" size="30" />

<h4>Kisan tila</h4>
<?php

$options = array(
                  'draft'  => 'Luonnos',
                  'published'  => 'Julkaistu',
                  'archived'  => 'Arkistoitu',
                );

echo form_dropdown('status', $options, $editableData['status']);

?>

<h4>Kilpailualueiden rajaus</h4>
<?php

echo form_dropdown('location_list', $locationArrayHeadings, $editableData['location_list']);

?>

<p><input type="submit" value="Tallenna" /></p>

</form>

<?php
include "page_elements/footer.php";
?>