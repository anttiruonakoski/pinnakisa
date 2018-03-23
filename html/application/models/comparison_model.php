<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comparison_model extends CI_Model {
	
	var $user_id = FALSE;
	var $old_contest_id = FALSE;

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	public function loadData($old_contest_id, $user_id)
	{
		// Setup
		$this->user_id = $user_id;
		$this->old_contest_id = $old_contest_id;

		// Get old contest data
		$query_array = array(
			'contest_id' => $this->old_contest_id,
			'meta_edited_user' => $this->user_id
			);

		$query = $this->db->get_where('kisa_participations', $query_array);
		
		if (! isset($query))
		{
			exit("Tietokantavirhe 2A. Ota yhteyttä webmasteriin.");
		}

		$data = $query->row_array(); // return one row as an associative array

		// Ticks from JSON
		$data['ticks_day'] = json_decode($data['ticks_day_json'], TRUE);
		unset($data['ticks_day_json']);

		// Species from JSON
		$data['species'] = json_decode($data['species_json'], TRUE);
		unset($data['species_json']);

//		print_r ($data); // debug
//		echo "$old_contest_id, $user_id"; // DEBUG
//		exit("\n\n<p>DEBUG END");
//		print_r ($data2['name']); exit("DEBUG 2");
		
		$data['contest_name'] = $this->returnOldContestName($old_contest_id);

		return $data;
	}

	// ------------------------------------------------------------------------
	
	public function returnOldContestName()
	{
		$query_array = array(
			'id' => $this->old_contest_id,
			);

		$query = $this->db->get_where('kisa_contests', $query_array);
		
		if (! isset($query))
		{
			exit("Tietokantavirhe 2B. Ota yhteyttä webmasteriin.");
		}

		$data = $query->row_array(); // return one row as an associative array

		return $data['name'];
	}

	// ------------------------------------------------------------------------


}

/* End of file */
