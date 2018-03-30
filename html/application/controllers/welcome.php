<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->helper('pinna_helper');
		$viewdata = Array();
		
		if ($this->ion_auth->logged_in())
		{
			$this->load->model('participation_model');
			$viewdata['participations'] = $this->participation_model->my_listing();
		}
		
		$this->load->model('contest_model');
		
		// TODO: integrate these two?
		// Needed for participations
		$viewdata['allContests'] = $this->contest_model->setIdAsKey($this->contest_model->listing("all"));
		
		// Needed for published contests
		$viewdata['publishedContests'] = $this->contest_model->listing("published");

		$viewdata['archivedContests'] = $this->contest_model->listing("archived");
		
		$this->load->view('welcome', $viewdata);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */