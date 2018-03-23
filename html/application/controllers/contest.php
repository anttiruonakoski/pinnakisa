<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contest extends CI_Controller {

	// ------------------------------------------------------------------------
	
	public function index()
	{
		if (!$this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('login', 'Hakemasi sivu on vain ylläpitäjille.');
			redirect('welcome/index');
		}

		$this->load->model('contest_model');
		$viewdata['contests'] = $this->contest_model->listing();
		
		$this->load->view('contest_index', $viewdata);
	}
	
	// ------------------------------------------------------------------------
	
	public function edit($id = FALSE)
	{
		// Restrict this page only for admins
		if (!$this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('login', 'Hakemasi sivu on vain ylläpitäjille.');
			redirect('welcome/index');
		}
		
		// Preparations
		$this->load->model('contest_model');
		$viewdata['editableData'] = FALSE;
		
		// FETCH THE DATA
		if ("POST" == $_SERVER['REQUEST_METHOD'])
		{
//			echo "CASE1 ";
			// Editing a document, existing or new;
			// data comes from POST
			$viewdata['editableData'] = $this->input->post();
			
			// If editing existing, fetch the id
			if ($id)
			{
				$viewdata['editableData']['id'] = $id;
			}
		}
		elseif ($id)
		{
//			echo "CASE2 ";
			// Starting to edit existing document, or editing document just put into database;
			// load data from database based on id
			$viewdata['editableData'] = $this->contest_model->load($id);
		}
		else
		{
//			echo "CASE3 ";
			// Blank form;
			// no data
			$viewdata['editableData'] = NULL;
		}
	
		// VALIDATE THE DATA
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Nimi', 'required|max_length[128]');
		$this->form_validation->set_rules('description', 'Kuvaus', 'required|max_length[1024]');
		$this->form_validation->set_rules('date_begin', 'Alkupäivämäärä', 'required');
		$this->form_validation->set_rules('date_end', 'Loppupäivämäärä', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required|max_length[256]');
		$this->form_validation->set_rules('comparison', 'Vertailu', 'max_length[128]');
		$this->form_validation->set_rules('status', 'Kisan tila', 'required');
		$this->form_validation->set_rules('location_list', 'Kilpailualueen rajaus', '');

		// DO SOMETHING WITH THE DATA
		if ($this->form_validation->run() == FALSE)
		{
//			echo "CASE B 1";
			// Validation not run or not passed; go to form

			// Load location list
			include "includes/locationarray.php";
			$locationArrayHeadings = array_keys($locationArray);
			$viewdata['locationArrayHeadings'][0] = 'Vapaamuotoinen'; // first element is empty
			foreach ($locationArrayHeadings as $number => $name)
			{
				$viewdata['locationArrayHeadings'][$name] = $name;
			}
			
			$this->load->view('contest_edit', $viewdata);
		}
		else
		{
			// If handling old data, update document
			if ($id)
			{
				unset($viewdata['editableData']['id']); // driver doesn't allow id when updating
				$result = $this->contest_model->update($viewdata['editableData'], $id);
			}
			// If handling new data, insert document
			else
			{
				// Inserting returns an ID for the document
				$id = $this->contest_model->insert($viewdata['editableData']);
			}
			
			// Go to form with id
			$this->session->set_flashdata("flash", "Tiedot tallennettiin onnistuneesti");
			redirect("/contest/edit/$id");
		}
	}
	
	// ------------------------------------------------------------------------

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */