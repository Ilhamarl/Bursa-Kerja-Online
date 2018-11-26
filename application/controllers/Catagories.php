<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Catagories extends Public_Controller
{
	//Construct
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('job_industry_model');
		$this->load->library(array('session','job_industry','form_validation'));
		$this->load->helper(array('url','language','form','time_helper'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'job_industry'), $this->config->item('error_end_delimiter', 'job_industry'));

		$this->load->model('catagory_job_model');
		$this->data['katagori'] = $this->catagory_job_model->users()->result();
		foreach ($this->data['katagori'] as $k => $user)
		{
			$this->data['katagori'][$k]->groups = $this->catagory_job_model->get_users_groups($user->id)->result();
		}
	}

	public function index()
	{
		$this->data['title'] 	= 'Katagori';
		// set the flash data error message if there is one
		$this->data['message']	= (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		//list the Groups
		$this->data['catagories']	= $this->job_industry->catagories()->result();
		if ($this->ion_auth->is_admin())
		{
			$this->dashboard_admin('catagories/lists-group', $this->data);
		}
		else if ($this->ion_auth->is_user())
		{
			$this->dashboard_user('catagories/lists-industry', $this->data);
		}
		else
		{
			$this->load->top_nav('catagories/lists-industry', $this->data);
		}
	}


	public function add()
	{
		$this->data['title'] = 'Tambah Katagori';

		$config = array(
			array(
				'field' => 'catagory_name',
				'label' => 'catagory_name',
				'rules' => 'required'
			),
			array(
				'field' => 'description',
				'label' => 'description',
				//'rules' => 'required|trim'
			)
		);
		// check validation
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() === TRUE)
		{
			$name 			= $this->input->post('catagory_name');
			$description 	= $this->input->post('description');

			$additional_data = array(
				'description'	=> $this->input->post('description')
			);

			$new_catagory_id = $this->job_industry->create_catagory($name,$description,$additional_data);

			if ($new_catagory_id)
			{
				// check to see if we are creating the catagory
				$this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil tambah katagori</div>');
				redirect('catagories');
			}
		}
		else
		{
			// display the create catagory form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->job_industry->errors() ? $this->job_industry->errors() : $this->session->flashdata('message')));

			$this->data['catagory_name'] = array(
				'name'  => 'catagory_name',
				'id'    => 'catagory_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('catagory_name'),
				'class' => 'form-control'
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
				'class'	=> 'form-control'
			);

			if ($this->ion_auth->is_admin())
			{
				$this->dashboard_admin('catagories/add-group', $this->data);
			}
			else if ($this->ion_auth->is_user())
			{
				redirect('dashboard','refresh');
			}
			else
			{
				redirect('dashboard','refresh');
			}
		}
	}

	public function edit($id)
	{
		$this->data['title'] = 'Edit Katagori';

		// bail if no catagory id given
		if ($id == NULL)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-info">Group tidak ada</div>');

			redirect('catagories', 'refresh');
		}

		$catagory = $this->job_industry->catagory($id)->row();

		$config = array(
			array(
				'field' => 'catagory_name',
				'label' => 'description',
				'rules' => 'required'
			),
			array(
				'field' => 'catagory_description',
				'label' => 'description'
				//'rules' => 'required|trim'
			)
		);

		// set valldation
		$this->form_validation->set_rules($config);

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$catagory_update = $this->job_industry->update_catagory($id, $_POST['catagory_name'], $_POST['catagory_description']);

				if ($catagory_update)
				{
					$this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil update katagori</div>');
				}
				else
				{
					$this->session->set_flashdata('message', '<div class="alert alert-warning">Gagal update katagori</div>');
				}
				redirect('catagories');
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->job_industry->errors() ? $this->job_industry->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['catagory'] = $catagory;

		$this->data['catagory_name'] = array(
			'name'		=> 'catagory_name',
			'id'		=> 'catagory_name',
			'type'		=> 'text',
			'value'		=> $this->form_validation->set_value('catagory_name', $catagory->name),
			'class'		=> 'form-control'
		);
		$this->data['catagory_description'] = array(
			'name'  => 'catagory_description',
			'id'    => 'catagory_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('catagory_description', $catagory->description),
			'class'	=> 'form-control'
		);

		if ($this->ion_auth->is_admin())
		{
			$this->dashboard_admin('catagories/edit-group', $this->data);
		}
		else if ($this->ion_auth->is_user())
		{
			redirect('dashboard','refresh');
		}
		else
		{
			redirect('dashboard','refresh');
		}
	}


	public function data_catagory($id)
	{
		$this->data['title'] = 'Data Katagori';
		/* Data */
		$id = (int) $id;
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->data['catagories'] = $this->job_industry->catagory($id)->result();

		/* Load Template */
		if ($this->ion_auth->is_admin())
		{
			$this->dashboard_admin('catagories/profile_industry', $this->data);
		}
		else if ($this->ion_auth->is_user())
		{
			$this->dashboard_user('catagories/profile_industry', $this->data);
		}
		else
		{
			$this->load->top_nav('catagories/profile_industry', $this->data);
		}
	}

	public function catagories()
	{
		$this->data['title'] = 'Daftar Katagori';
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

		//list the users
		$this->data['users'] = $this->catagory_job_model->users()->result();
		foreach ($this->data['users'] as $k => $user)
		{
			$this->data['users'][$k]->groups = $this->catagory_job_model->get_users_groups($user->id)->result();
		}

		$this->dashboard_admin('admin/list_catagory', $this->data);
	}

	public function catagory($id)
	{
		$this->data['title'] =  'Katagori';

		/* Data */
		$id = (int) $id;
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->data['users'] = $this->catagory_job_model->user($id)->result();
		foreach ($this->data['users'] as $k => $user)
		{
			$this->data['users'][$k]->groups = $this->catagory_job_model->get_users_groups($user->id)->result();
		}

		// Show data to View
		if ($this->ion_auth->is_admin())
		{
			$this->dashboard_admin('admin/profile_catagory', $this->data);
		}
		else if ($this->ion_auth->is_user())
		{
			$this->dashboard_user('admin/profile_catagory', $this->data);
		}
		else
		{
			$this->load->top_nav('admin/profile_catagory', $this->data);
		}

	}

	public function delete_catagory ($id)
	{
		$delete = $this->job_industry_model->delete_catagory($id);
		if($delete)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil hapus katagori</div>');
		}
		else
		{
			$this->session->set_flashdata('message', '<div class="alert alert-warning">Gagal hapus katgori</div>');
		}
		redirect('catagories');
	}
}
