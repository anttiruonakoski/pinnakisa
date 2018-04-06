<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

function participationAbbrs2Finnish($participation)
{
	if (! isset($participation[0]))
	{
		return FALSE;
	}
	
	$abbrArray = json_decode($participation[0]['species_json'], TRUE);
	
	$finnishArray = abbrKeys2Finnish($abbrArray);
	
	// remove abbr, fill in finnish
	unset($participation[0]['species_json']);
	$participation[0]['species_finnish'] = $finnishArray;
	
	return $participation;
}

function abbrKeys2Finnish($abbrArray)
{
	// Generate reference list
	// TODO: species list into database, or a fast reference list
	require "application/views/includes/birds.php";
	$birdList = Array();
	
	foreach ($bird as $speciesNumber => $arr)
	{
		if (isset($arr['sc'])) // if species
		{
			$birdList[$arr['abbr']] = $arr['fi'];
		}
	}
		
	
	$finnishArray = Array();
	foreach ($abbrArray as $abbr => $something)
	{
		$finnishArray[$birdList[$abbr]] = $something;
	}
	
	
	return $finnishArray;

}

/**
* Problem: required .git repository online
*/
/*
function gitLastCommitInfo($gitLocation)
{
	$commitArray = file($gitLocation);
	$lastCommit = array_pop($commitArray);
	$lastCommitArray = explode("\t", $lastCommit);
	$lastCommitArray2 = explode(" ", $lastCommitArray[0]);
	$pop = array_pop($lastCommitArray2);
	return date("Y-m-d", array_pop($lastCommitArray2));
}
*/

/**
*
*/
function cumulativeTickJSdata($dailyTicksArray, $label, $draw2 = FALSE, $addYear = 0)
{
		$cumulativeTicks = 0;
		$singleDateData = "";
		$fullDateData = "";
		ksort($dailyTicksArray);
		foreach ($dailyTicksArray as $date => $ticks)
		{
			$cumulativeTicks = $cumulativeTicks + $ticks;
			$yearUTC = substr($date, 0, 4) + $addYear;
//			$yearUTC = substr($date, 5, 2); // to display the charts on top of each other
			$monthUTC = substr($date, 5, 2) - 1;
			$dateUTC = substr($date, 8, 2);

			$singleDateData = "[Date.UTC($yearUTC, $monthUTC, $dateUTC), $cumulativeTicks], ";
			$fullDateData = $fullDateData . $singleDateData;
		}

		if ("today" == $draw2)
		{
			$fullDateData = $fullDateData . "[Date.UTC(" . date("Y") . ", " . (date("m") - 1) . ", " . date("d") . "), $cumulativeTicks], ";
		}
		elseif ("endOfYear" == $draw2)
		{
			$fullDateData = $fullDateData . "[Date.UTC(" . date("Y") . ", 11, 31), $cumulativeTicks], "; // 11 = December, since month numbering starts from 0
		}
		elseif ("naturalEnd" == $draw2)
		{
			
		}

		$fullData = "
		{
			name: '$label',			
			data: [ $fullDateData ]
		},
		";

		return $fullData;
}

function date2Fin($date) {
	if ($date) { 
		$dateParts = explode("-", $date);
		$ret = ltrim($dateParts[2], '0') . "." . ltrim($dateParts[1], '0') . "." . $dateParts[0];

	return $ret;
	}
}


