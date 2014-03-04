<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Results extends CI_Controller {

	public function summary($contest_id)
	{
		$viewdata = Array();

		// Basic data about the contest
		$this->load->model('contest_model');
		$viewdata['contest'] = $this->contest_model->load($contest_id);
		
		// Results...
		$this->load->model('results_model');
		
		// Ticks per participant
		$viewdata['summary'] = $this->results_model->summary($contest_id);

		// Location ticks
//		$viewdata['locations'] = $this->results_model->areaTicks();

		
		$this->load->view('results_summary', $viewdata);
	}
	
	// ------------------------------------------------------
	// Shows the total species list of a contest
	
	public function species($contest_id)
	{
		$viewdata = Array();
		$this->load->helper('pinna');

		// Basic data about the contest
		$this->load->model('contest_model');
		$viewdata['contest'] = $this->contest_model->load($contest_id);
		
		// Results...
		$this->load->model('results_model');
		
		// Get & count species
		$summary = $this->results_model->summary($contest_id);
		
//echo "<pre>"; print_r ($summary); echo "</pre>"; // debug
		
		$species = Array();
		$participantCount = 0;
		foreach ($summary as $participationNumber => $participation)
		{
			$partSpecies = json_decode($participation['species_json'], TRUE);
			foreach ($partSpecies as $abbr => $date)
			{
				@$species[$abbr]['count']++;
				$species[$abbr]['oneObserver'] = $participation['name']; // Set the observer name to array, replacing previous one. This data should only be used for species observed by only one person. 
			}
			$participantCount++;
		}
		
		$species = abbrKeys2Finnish($species);
		arsort($species);
		
		$viewdata['species'] = $species;
		$viewdata['participantCount'] = $participantCount;
		
		// Get my species
		if ($this->ion_auth->logged_in())
		{
			$myParticipationSummary = $this->results_model->user_summary($contest_id, $this->ion_auth->user()->row()->id);
			if (! empty($myParticipationSummary)) // if I have participated
			{
				$mySpeciesList = json_decode($myParticipationSummary[0]['species_json'], TRUE);
				$viewdata['mySpeciesAbbrs'] = $mySpeciesList; // todo: sisältää nyt countin ja henkilöänimen, näitä ei tarvita
				$mySpeciesList = abbrKeys2Finnish($mySpeciesList);
				$viewdata['mySpecies'] = $mySpeciesList;
			}
		}
		else
		{
			$viewdata['mySpecies'] = Array();
		}
		
		$this->load->view('results_species', $viewdata);
	}
	
	// ------------------------------------------------------
	// Shows a species list of one participant from a contest
	
	public function participation_html($participation_id)
	{
		$viewdata = Array();
		$this->load->model('results_model');
		$this->load->helper('pinna');
		
		$participation = $this->results_model->participation_summary($participation_id);
		
		$viewdata['participation'] = participationAbbrs2Finnish($participation);
		
		$this->load->view('results_participation_html', $viewdata);
	}
	
	// ------------------------------------------------------
	// Shows a graph of species accumulation
	
	public function graph($contest_id, $top)
	{
		$viewdata = Array();
		$this->load->model('results_model');
		$this->load->helper('pinna');
		
		// Basic data about the contest
		$this->load->model('contest_model');
		$viewdata['contest'] = $this->contest_model->load($contest_id);
		$viewdata['top'] = $top;

		$viewdata['scriptData'] = $this->results_model->ticks_js_data($contest_id, $top);
		
//		echo "<pre>";	print_r ($viewdata); // debug
		
		$this->load->view('results_graph', $viewdata);
	}

	// ------------------------------------------------------
	// Shows comparison to previous years
	
	public function comparison($contest_id)
	{
		$viewdata = Array();
		$this->load->model('results_model');
		$this->load->helper('pinna');
		
		// Basic data about the contest
		$this->load->model('contest_model');
		$viewdata['contest'] = $this->contest_model->load($contest_id);

		// 2013 data
		$this->load->model('kisa2013_model');
//		$dataArray2013 = $this->kisa2013_model->loadParticipation($this->ion_auth->user()->row()->id);

		$data2013 = $this->kisa2013_model->speciesArraysOfUser($this->ion_auth->user()->row()->id);
		$speciesArray2013 = $data2013['speciesArray2013'];
		$dailyTicksArray2013 = $data2013['dailyTicksArray2013'];

		/*
	    [10] => Array
	        (
	            [paiva] => 2013-01-01
	            [Lyhenne] => CORMON
	            [Suomi] => Naakka
	        )
		*/

		// This year's data
		$contestDataArrayThisyear = $this->results_model->comparison_js_data($contest_id, $this->ion_auth->user()->row()->id);
		$speciesArrayThisyear = json_decode($contestDataArrayThisyear[0]['species_json'], TRUE);
		$dailyTicksArrayThisyear = json_decode($contestDataArrayThisyear[0]['ticks_day_json'], TRUE);

/*
		echo "<pre>"; // debug
//		print_r ($dataArray2013);

		print_r ($speciesArray2013);
		print_r ($dailyTicksArray2013);
		print_r ($speciesArrayThisyear);
		print_r ($dailyTicksArrayThisyear);

		exit("DEBUG END");
*/

		$cumulativeTicks = 0;
		$singleDateData = "";
		$fullDateData = "";
		ksort($dailyTicksArray2013);
		foreach ($dailyTicksArray2013 as $date => $ticks)
		{
			$cumulativeTicks = $cumulativeTicks + $ticks;
//			$yearUTC = substr($date, 0, 4);
			$yearUTC = 2014; // to display the charts on top of each other
			$monthUTC = substr($date, 5, 2) - 1;
			$dateUTC = substr($date, 8, 2);

			$singleDateData = "[Date.UTC($yearUTC, $monthUTC, $dateUTC), $cumulativeTicks], ";
			$fullDateData = $fullDateData . $singleDateData;
		}

		$viewdata['fullData2013'] = "
		{
			name: '2013',			
			data: [ $fullDateData ]
		},
		";


		$cumulativeTicks = 0;
		$singleDateData = "";
		$fullDateData = "";
		ksort($dailyTicksArrayThisyear);
		foreach ($dailyTicksArrayThisyear as $date => $ticks)
		{
			$cumulativeTicks = $cumulativeTicks + $ticks;
			$yearUTC = substr($date, 0, 4);
			$monthUTC = substr($date, 5, 2) - 1;
			$dateUTC = substr($date, 8, 2);

			$singleDateData = "[Date.UTC($yearUTC, $monthUTC, $dateUTC), $cumulativeTicks], ";
			$fullDateData = $fullDateData . $singleDateData;
		}

		$viewdata['fullDataThisyear'] = "
		{
			name: '2014',			
			data: [ $fullDateData ]
		},
		";

		/*
		// Target data style:

		{
			name: 'Inka Plit',			
			data: [ [Date.UTC(2014, 0, 10), 4], [Date.UTC(2014, 0, 11), 21], [Date.UTC(2014, 0, 15), 22], ]
		},

		*/
		
		$this->load->view('results_comparison', $viewdata);
	}
}


/* End of file */