<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kisa2013_model extends CI_Model {

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	public function loadParticipation($user_id)
	{
		// Get users's old_id
		$userData = $this->userData($user_id);

		$json = file_get_contents("http://biomi.kapsi.fi/tools/tringa-eko/json.php?id=" . $userData['old_id']);

		return json_decode($json, TRUE);
	}

	// ------------------------------------------------------------------------

	public function userData($user_id)
	{
		$query = $this->db->get_where('kisa_users', array('id' => $user_id));
		
		if (! isset($query))
		{
			exit("Tietokantavirhe 3. Ota yhteyttä webmasteriin.");
		}
		
		return $query->row_array(); // return one row as an associative array
	}

	// ------------------------------------------------------------------------

	public function speciesArraysOfUser($user_id)
	{
		$dataArray2013 = $this->kisa2013_model->loadParticipation($user_id);

		foreach ($dataArray2013 as $tickNumber => $tickArray)
		{
			$speciesArray2013[$tickArray['Lyhenne']] = $tickArray['paiva'];
			@$dailyTicksArray2013[$tickArray['paiva']]++;
		}

		$ret['speciesArray2013'] = $speciesArray2013;
		$ret['dailyTicksArray2013'] = $dailyTicksArray2013;

		return $ret;
	}

	// ------------------------------------------------------------------------

}

/* End of file */
