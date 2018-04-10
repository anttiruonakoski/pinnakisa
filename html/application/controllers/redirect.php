<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Redirect extends CI_Controller {

	// ------------------------------------------------------------------------
	
	public function participation()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('welcome/index');
        }
        else {
            $this->load->model('participation_model');
            $participations = $this->participation_model->my_listing();

            // if no participations
            if (!isset($participations[0])) {
                redirect('welcome/index');                
            }

            $participation100lajiaLink = 'participation/edit/' . $participations[0]['id'];
			redirect($participation100lajiaLink);
        }
	}

	// ------------------------------------------------------------------------
	
	public function results()
	{
        $this->load->model('contest_model');
        $allContests = $this->contest_model->listing("all");

        $results100lajiaLink = 'results/summary/' . $allContests[0]['id'];
        redirect($results100lajiaLink);
	}

    // ------------------------------------------------------------------------

}

/* End of file */