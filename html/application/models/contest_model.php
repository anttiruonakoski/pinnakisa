<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contest_model extends CI_Model {

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	public function insert($data)
	{
		// Generate id
		$data['id'] = sha1($data['name'] . $data['description'] . rand());
	
		// Add metadata
		$userData = $this->ion_auth->user()->row();
		$data['meta_edited_user'] = $userData->id;
		$data['meta_edited'] = date("Y-m-d H:i:s");
		$data['meta_created_user'] = $userData->id;
		$data['meta_created'] = date("Y-m-d H:i:s");

		// Insert document
		$this->db->insert('kisa_contests', $data);
	
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
		
		// Add metadata
		$userData = $this->ion_auth->user()->row();
		$data['meta_edited_user'] = $userData->id;
		$data['meta_edited'] = date("Y-m-d H:i:s");
		
		// Update document
		$this->db->where('id', $id);
		$this->db->update('kisa_contests', $data); 
	
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
		$query = $this->db->get_where('kisa_contests', array('id' => $id));
		
		if (! isset($query))
		{
			exit("Tietokantavirhe 2. Ota yhteyttä webmasteriin.");
		}
		
		return $query->row_array(); // return one row as an associative array
	}

	// ------------------------------------------------------------------------

	public function listing($status = "all")
	{
		if ($status == "all")
		{
			// List all
			$query = $this->db->get('kisa_contests');
		}
		elseif ($status == "published")
		{
			$query = $this->db->get_where('kisa_contests', array('status' => 'published'));
		}
		elseif ($status == "archived")
		{
			$query = $this->db->get_where('kisa_contests', array('status' => 'archived'));
		}
		
		if (! isset($query))
		{
			exit("Tietokantavirhe 2. Ota yhteyttä webmasteriin.");
		}
		
		return $query->result_array();
	}

	// ------------------------------------------------------------------------
	// Sets contest_id as the array key 
	
	public function setIdAsKey($ret)
	{
		foreach ($ret as $number => $array)
		{
			$ret[$array['id']] = $array;
			unset($ret[$number]);
		}
		
		return $ret;
	}
	
	// ------------------------------------------------------------------------

}

/* End of file */
