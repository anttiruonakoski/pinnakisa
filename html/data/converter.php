<?php

/*
$bird[1]['abbr'] = "Anseriformes - Sorsalinnut";

$bird[2]['abbr'] = "CYGOLO";
$bird[2]['sc'] = "Cygnus olor";
$bird[2]['fi'] = "Kyhmyjoutsen";
$bird[2]['sv'] = "Knölsvan";
$bird[2]['en'] = "Mute Swan";
*/

$speciesList = file_get_contents("species_list.csv");
$lines = explode("\n", $speciesList);

$birds = Array();
$birdNro = 0;

foreach ($lines as $lineNro => $line) {
    $line = trim($line);
    $cells = explode("\t", $line);

    // Order
    if ("Lahko" === trim($cells[2])) {
        $birds[$birdNro]['abbr'] = $cells[4];
    }
    // Species
    else {
        $birds[$birdNro]['abbr'] = $cells[2];
        $birds[$birdNro]['sc'] =  $cells[3];
        $birds[$birdNro]['fi'] =  $cells[4];
        $birds[$birdNro]['sv'] =  $cells[5];
        $birds[$birdNro]['en'] =  $cells[6];
        if ($cells[1]) {
            $birds[$birdNro]['rarity'] = 2;
        }
    }

    $birdNro++;
}

$json = json_encode($birds);
file_put_contents("../backups/birds2.json", $json);

print_r ($birds);

