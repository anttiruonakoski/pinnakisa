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

		// My participation
		if (! empty($this->ion_auth->user()->row()->id))
		{
			$myParticipationSummary = $this->results_model->user_summary($contest_id, $this->ion_auth->user()->row()->id);
			$viewdata['myParticipationSummary'] = $myParticipationSummary;
		}

//		print_r($viewdata); exit("FB");
	
		$this->load->view('results_summary', $viewdata);
	}
	
	public function area($contest_id)
	{
		$viewdata = Array();

		// Basic data about the contest
		$this->load->model('contest_model');
		$viewdata['contest'] = $this->contest_model->load($contest_id);
		
		// Results...
		$this->load->model('results_model');

		// Location ticks
		$this->results_model->summary($contest_id);
		$viewdata['locations'] = $this->results_model->areaTicks();
		$this->load->view('results_area', $viewdata);
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
		$this->load->model('contest_model');
		$this->load->helper('pinna');

		$myUserId = $this->ion_auth->user()->row()->id;
		
//		$compareTo = $viewdata['contest']['comparison'];
		$viewdata['contest'] = $this->contest_model->load($contest_id);
		$compareToArray = explode(",", $viewdata['contest']['comparison']);

//		echo "<pre>"; print_r ($viewdata['contest']); exit("DEBUG END"); // debug

		/*
		// Comparison data
		// 2013 data: this and associated model can be removed in 2/2014, after removing eko2013 from production database. Then refactor variable names here.
		$this->load->model('comparison_model');
		$data2013 = $this->comparison_model->loadData($compareTo, $this->ion_auth->user()->row()->id);

//		print_r ($data2013); exit("\n\nDATA DEBUG END"); // debug

		$speciesArray2013 = $data2013['species'];
		$dailyTicksArray2013 = $data2013['ticks_day'];
		*/

		$n = 0;
		
		// This year's data
//		print_r ($viewdata['contest']); exit(); // debug

		$data = $this->results_model->comparison_js_data($contest_id, $myUserId);
		$ticks[$n]['speciesArray'] = json_decode($data[0]['species_json'], TRUE);
		$ticks[$n]['dailyTicksArray'] = json_decode($data[0]['ticks_day_json'], TRUE);

		$viewdata['fullData'][$n] = cumulativeTickJSdata($ticks[$n]['dailyTicksArray'], $viewdata['contest']['name'], "naturalEnd", 0);

		$n++;

		// Last year's data
		foreach ($compareToArray as $number => $compareId) {
			$contestData = $this->contest_model->load($compareId);

			$data = $this->results_model->comparison_js_data($compareId, $myUserId);
			$ticks[$n]['speciesArray'] = json_decode($data[0]['species_json'], TRUE);
			$ticks[$n]['dailyTicksArray'] = json_decode($data[0]['ticks_day_json'], TRUE);

			$viewdata['fullData'][$n] = cumulativeTickJSdata($ticks[$n]['dailyTicksArray'], $contestData['name'], "naturalEnd", $n);

			$n++;
		}

/*
		echo "<pre>"; // debug

		print_r ($speciesArray2013);
		print_r ($dailyTicksArray2013);
		print_r ($speciesArrayThisyear);
		print_r ($dailyTicksArrayThisyear);

		exit("DEBUG END");
*/

		/*
		if (! empty($dailyTicksArrayLastyear))
		{
			$viewdata['fullDataLastyear'] = cumulativeTickJSdata($dailyTicksArrayLastyear, "Last year", "naturalEnd", 1);
		}
		if (! empty($dailyTicksArrayThisyear))
		{
			$viewdata['fullDataThisyear'] = cumulativeTickJSdata($dailyTicksArrayThisyear, $viewdata['contest']['name'], "today");
		}
		*/

		if (! empty($dailyTicksArrayThisyear))
		{
			$viewdata['takenPartThisyear'] = TRUE;
		}
		else
		{
			$viewdata['takenPartThisyear'] = FALSE;
		}

		$viewdata['takenPartThisyear'] = TRUE; // TEMPORARY FIX

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