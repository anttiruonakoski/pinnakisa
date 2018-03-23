<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Participation_model extends CI_Model {

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	public function formatter($data)
	{
		// empties to NULL
		if ("" == $data['kms']) { $data['kms'] = NULL; }
		if ("" == $data['hours']) { $data['hours'] = NULL; }
	
		$speciesCount = 0;
		$ticksPerDay = Array();

		// Calculate stats
		foreach ($data['species'] as $sp => $value)
		{
			if (! $value)
			{
				unset($data['species'][$sp]);
			}
			else
			{
				$speciesCount++;
				@$ticksPerDay[$value]++;
			}
		}
		
		// sort by date
		ksort($ticksPerDay);
		
		$data['species_count'] = $speciesCount;
		$data['ticks_day_json'] = json_encode($ticksPerDay);
		
		// Species into JSON
		$data['species_json'] = json_encode($data['species']);
		unset($data['species']);
		
		return $data;
	}

	public function insert($data)
	{
		$data = $this->formatter($data);
					
		// Generate id
		$data['id'] = sha1($data['name'] . $data['location'] . rand());
		
		// Add metadata
		$userData = $this->ion_auth->user()->row();
		$data['meta_edited_user'] = $userData->id;
		$data['meta_edited'] = date("Y-m-d H:i:s");
		$data['meta_created_user'] = $userData->id;
		$data['meta_created'] = date("Y-m-d H:i:s");
		
		// Insert document
		$this->db->insert('kisa_participations', $data);

		$this->backup($data);
	
	/*
	// TODO: try catch exception
		if (! isset($_id))
		{
			exit("Tietokantavirhe 1. Ota yhteyttä webmasteriin.");
		}
	*/
		
		return $data['id'];
	}
	
	// ------------------------------------------------------------------------

	public function update($data, $id = FALSE)
	{
		if (! $id)
		{
			exit("id has to be set when updating a document.");
		}
		
		$data = $this->formatter($data);
		
		// Add metadata
		$userData = $this->ion_auth->user()->row();
		$data['meta_edited_user'] = $userData->id;
		$data['meta_edited'] = date("Y-m-d H:i:s");
		
		// Update document
		$this->db->where('id', $id);
		$this->db->update('kisa_participations', $data); 

		$this->backup($data, $id);
		
	/*
	// TODO: try catch exception
		if (! isset($id))
		{
			exit("Tietokantavirhe 3. Ota yhteyttä webmasteriin.");
		}
		*/
		
		return $id;
	}

	// ------------------------------------------------------------------------

	public function load($id)
	{
		$query = $this->db->get_where('kisa_participations', array('id' => $id));
		
		if (! isset($query))
		{
			exit("Tietokantavirhe 2. Ota yhteyttä webmasteriin.");
		}

		$data = $query->row_array(); // return one row as an associative array
		
		// Species from JSON
		$data['species'] = json_decode($data['species_json'], TRUE);
		unset($data['species_json']);
		
		return $data;
	}

	// ------------------------------------------------------------------------

	public function my_listing()
	{
		$userData = $this->ion_auth->user()->row();
		$query = $this->db->get_where('kisa_participations', array('meta_edited_user' => $userData->id)); // based on last edited user
		
		if (! isset($query))
		{
			exit("Tietokantavirhe 2. Ota yhteyttä webmasteriin.");
		}
		
		return $query->result_array();
	}

	// ------------------------------------------------------------------------

	public function alreadyTakenPart($contest_id)
	{
		$userData = $this->ion_auth->user()->row();
		
		$this->db->where('contest_id', $contest_id);
		$this->db->where('meta_edited_user', $userData->id); // based on last edited user
		$query = $this->db->get('kisa_participations');
		
		if (! isset($query))
		{
			exit("Tietokantavirhe 2. Ota yhteyttä webmasteriin.");
		}
		
		$oneParticipation = $query->row_array();
		
		if (@$oneParticipation['id'])
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	// ------------------------------------------------------------------------

	public function backup($data, $id = "new")
	{
//		echo "<pre>BACKUP  \n"; print_r($data); // debug

		$json = json_encode($data);
		$time = date("Ymd-His");

		$directory = "backups/" . date("Y-m");
		if (! file_exists($directory))
		{
    		mkdir($directory, 0777, true);
		}

		$filename = $directory . "/" . $id . "-" . $time . "-" . md5($json) . ".json";

		$bytesSaved = file_put_contents($filename, $json);
		return $bytesSaved;
	}

	// ------------------------------------------------------------------------

}

/* End of file */
