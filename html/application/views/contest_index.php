<?php
$title = "Pinnakisa";
include "page_elements/header.php";
?>

<h1>Kisat (admin view)</h1>

<?php
echo $this->session->flashdata('flash');

//echo "<pre>"; print_r ($contests); echo "</pre>"; // debug

?>

<table class="listTable">
	<tr>
		<th>Nimi</th>
<!--		<th>Kuvaus</th> -->
		<th>URL</th>
		<th>PVM</th>
		<th>Tila</th>
		<th>Luotu</th>
		<th>Muokattu</th>
		<th>Toiminnot</th>
	</tr>
<?php
foreach ($contests as $rowNumber => $array)
{
	echo "
	<tr>
		<td>" . @$array['name'] . "</td>
<!--		<td><abbr title=\"" . @$array['description'] . "\">" . substr(@$array['description'], 0, 50) . "&hellip;</abbr></td> -->
		<td><abbr title=\"" . @$array['url'] . "\">" . substr(@$array['url'], 7, 20) . "&hellip;</abbr></td>
		<td>" . @$array['date_begin'] . "&hellip;" . @$array['date_end'] . "</td>
		<td>" . @$array['status'] . "</td>
		<td>" . $array['meta_created'] . " by user " . $array['meta_created_user'] . "</td>
		<td>" . $array['meta_edited'] . " by user " . $array['meta_edited_user'] . "</td>
		<td><a href=\"" . site_url("contest/edit") . "/" . $array['id'] . "\">muokkaa</td>
	</tr>	
	";
}
?>
</table>

<?php
include "page_elements/footer.php";
?>