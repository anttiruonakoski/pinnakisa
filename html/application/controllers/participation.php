<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Participation extends CI_Controller {

	// ------------------------------------------------------------------------
	
	public function index()
	{

	}
	
	// ------------------------------------------------------------------------
	
	public function edit($id = FALSE)
	{
		// TODO: (?) Jos contest_id:n jättää pois uuteen kisaan ilmoittautuessa, tuloksana kasa CI:n virheilmoituksia
	
		// Restrict this page only for logged in users
		if (!$this->ion_auth->logged_in())
		{
			$this->session->set_flashdata('login', 'Kirjaudu sisään osallistuaksesi kisaan.');
			redirect('welcome/index');
		}
		/*
		// This redirect to welcome when saving a participation for the first time
		if (!$id && !$this->input->get('contest_id'))
		{
			redirect('welcome/index');
		}
		*/

		// Preparations
		$this->load->model('participation_model');
		$viewdata['editableData'] = FALSE;
		
		// FETCH THE DATA
		if ("POST" == $_SERVER['REQUEST_METHOD'])
		{
//			echo "CASE1 ";
			// Returning to the form after save to re-edit a document, existing or new (that has not been saved to the db because of missing mandatory data);
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
			$viewdata['editableData'] = $this->participation_model->load($id);

			// CHECK IF CORRECT USER
			$user = $this->ion_auth->user()->row();
			if ($viewdata['editableData']['meta_created_user'] !== $user->id) {
				exit("Editing this participation is not allowed for user " . $user->id);
			}				
		}
		else
		{
//			echo "CASE3 ";
			// Blank form;
			// no data
			$viewdata['editableData']['contest_id'] = $this->input->get('contest_id');
		}
	
		// VALIDATE THE DATA
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Nimi', 'required');
		$this->form_validation->set_rules('location', 'Kilpailualue', 'required');
		$this->form_validation->set_rules('contest_id', 'Kisan tunniste', 'required');
		$this->form_validation->set_rules('form_loaded', 'Lomake ei ollut latautunut kokonaan ennen kuin tallensit sen. Jos käytät hidasta verkkoyhteyttä, odota hetki pidempään ennen kuin yrität tallennusta uudelleen.', 'required', 'form_loaded_check');

		// DO SOMETHING WITH THE DATA

		// Validation error
		if ($this->form_validation->run() == FALSE)
		{
//			echo "CASE B 1";
			$this->session->set_flashdata("flash", "Täytä kaikki pakolliset kentät");
			
			// Get contest data
			$this->load->model('contest_model');
			$viewdata['contest'] = $this->contest_model->load($viewdata['editableData']['contest_id']);
			
			if (! $id)
			{
				// Check my previous participations in this contest
				$viewdata['alreadyTakenPart'] = $this->participation_model->alreadyTakenPart($viewdata['editableData']['contest_id']);
			}
			
			// if location has controlled vocabulary
			if ($viewdata['contest']['location_list'] != "0")
			{
				include "includes/locationarray.php";
				$viewdata['locationArray'][''] = ""; // first row is empty
				foreach ($locationArray[$viewdata['contest']['location_list']] as $name => $notes)
				{
					$viewdata['locationArray'][$name] = $name . " " . $notes;
				}
			}
			
			// Validation not run or not passed; go to form
			$this->load->view('participation_edit', $viewdata);
		}

		// Validation ok
		else
		{
			unset($viewdata['editableData']['form_loaded']);

			// If handling old data, update document
			if ($id)
			{
				unset($viewdata['editableData']['id']); // driver doesn't allow id when updating
				$result = $this->participation_model->update($viewdata['editableData'], $id);
			}
			// If handling new data, insert document
			else
			{
				// Inserting returns an ID for the document
				$id = $this->participation_model->insert($viewdata['editableData']);
			}
			
			// Go to form with id
			$this->session->set_flashdata("flash", "Tiedot tallennettiin onnistuneesti");
			redirect("/participation/edit/$id");
		}

	}

	// ------------------------------------------------------------------------
	
	public function delete($id = FALSE)
	{
//		print_r ($this->ion_auth->user()->row()); // debug: show user info


		// Restrict this page only for logged in users
		if (!$this->ion_auth->logged_in())
		{
			redirect('welcome/index');
		}
		if (!$id)
		{
			redirect('welcome/index');
		}

		// Preparations
		$this->load->model('participation_model');
		
		// FETCH THE DATA
		$viewdata['editableData'] = $this->participation_model->load($id);

//		print_r ($viewdata); // debug: view participation info
		$user = $this->ion_auth->user()->row();
		if ($viewdata['editableData']['meta_created_user'] !== $user->id) {
			exit("Editing this participation is not allowed for user " . $user->id);
		}

		// View
		$this->load->view('participation_delete', $viewdata);
	}

	// ------------------------------------------------------------------------
	
	public function confirmdeletion($id = FALSE)
	{
		// Restrict this page only for logged in users
		if (!$this->ion_auth->logged_in())
		{
			redirect('welcome/index');
		}
		if (!$id)
		{
			redirect('welcome/index');
		}

		// Preparations
		$this->load->model('participation_model');

		// FETCH THE DATA
		// AND CHECK IF DELETION ALLOWED
		$viewdata['editableData'] = $this->participation_model->load($id);
		$user = $this->ion_auth->user()->row();
		if ($viewdata['editableData']['meta_created_user'] !== $user->id) {
			exit("Editing this participation is not allowed for user " . $user->id);
		}
		
		// DELETE THE DATA
		$deletedId = $this->participation_model->delete($id);
		if ($deletedId === $id)
		{
			$this->session->set_flashdata("login", "Osallistuminen poistettu.");
			redirect('welcome/index');
		}
		else 
		{
			exit("Poisto epäonnistui");
		}

		// View
		$this->load->view('participation_delete', $viewdata);
	}

	// ------------------------------------------------------------------------

}

/* End of file */