<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends Public_Controller
{
	//Construct
	public function __construct()
	{
		parent::__construct();

		//need_login();
		$this->load->database();
		$this->load->model('job_industry_model','catagory_job_model');
		$this->load->library(array('session','job_industry','form_validation','pagination'));
		$this->load->helper(array('url','language','form','time_helper','text'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'job_industry'), $this->config->item('error_end_delimiter', 'job_industry'));

		$this->data['industries'] = $this->job_industry->groups()->result();
		$user_in_group = $this->job_industry->get_users_catagories(1);
		$this->data['catagories'] = $this->job_industry->catagories($user_in_group)->result();

		$this->load->model('catagory_job_model');
		$this->data['katagori'] = $this->catagory_job_model->users()->result();
		foreach ($this->data['katagori'] as $k => $user)
		{
			$this->data['katagori'][$k]->groups = $this->catagory_job_model->get_users_groups($user->id)->result();
		}

	}

	public function index()
	{
		$this->data['title'] = 'Lowongan Pekerjaan';

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

		$config['base_url'] = base_url().'/jobs/page';
		$config['total_rows'] = $this->ion_auth->users()->num_rows();
		$config['display_pages'] = TRUE;
		$config['use_page_numbers'] = FALSE;
		$config['per_page'] = 3;
		$the_uri_segment = 3;
		$config['uri_segment'] = $the_uri_segment;

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$this->data['users'] = $this->job_industry->offset($this->uri->segment($the_uri_segment))->limit($config['per_page'], $page)->users()->result();
		foreach ($this->data['users'] as $k => $user)
		{
			$this->data['users'][$k]->groups 		= $this->job_industry->get_users_groups($user->id)->result();
			$this->data['users'][$k]->catagories 	= $this->job_industry->get_users_catagories($user->id)->result();
		}

		$this->data["links"] = $this->pagination->create_links();

		// Show data to View
		if ($this->ion_auth->is_admin())
		{
			$this->dashboard_admin('jobs/lists', $this->data);
		}
		else if ($this->ion_auth->is_user())
		{
			$this->dashboard_user('jobs/lists-job', $this->data);
		}
		else
		{
			$this->load->top_nav('jobs/lists-job', $this->data);
		}
	}

	public function page()
	{
		$this->data['title'] = 'Lowongan Pekerjaan';
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

		$config['base_url'] = base_url().'/jobs/page';
		$config['total_rows'] = $this->ion_auth->users()->num_rows();
		$config['display_pages'] = TRUE;
		$config['use_page_numbers'] = FALSE;
		$config['per_page'] = 3;
		$the_uri_segment = 3;
		$config['uri_segment'] = $the_uri_segment;

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data['users'] = $this->job_industry->offset($this->uri->segment($the_uri_segment))->limit($config['per_page'], $page)->users()->result();
		foreach ($this->data['users'] as $k => $user)
		{
			$this->data['users'][$k]->groups = $this->job_industry->get_users_groups($user->id)->result();
			$this->data['users'][$k]->catagories 	= $this->job_industry->get_users_catagories($user->id)->result();
		}

		$this->data["links"] = $this->pagination->create_links();

		// Show data to View
		if ($this->ion_auth->is_admin())
		{
			$this->dashboard_admin('jobs/lists', $this->data);
		}
		else if ($this->ion_auth->is_user())
		{
			$this->dashboard_user('jobs/lists-job', $this->data);
		}
		else
		{
			$this->load->top_nav('jobs/lists-job', $this->data);
		}
	}

	public function data_job($id)
	{
		$this->data['title'] = 'Detail Pekerjaan';

		/* Data dari id */
		$id = (int) $id;

		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->data['users'] = $this->job_industry->user($id)->result();
		foreach ($this->data['users'] as $k => $user)
		{
			$this->data['users'][$k]->groups = $this->job_industry->get_users_groups($user->id)->result();
			$this->data['users'][$k]->catagories 	= $this->job_industry->get_users_catagories($user->id)->result();
		}

		// Show data to View
		if ($this->ion_auth->is_admin())
		{
			$this->dashboard_admin('jobs/profile_job', $this->data);
		}
		else if ($this->ion_auth->is_user())
		{
			$this->dashboard_user('jobs/profile_job', $this->data);
		}
		else
		{
			$this->load->top_nav('jobs/profile_job', $this->data);
		}
	}

	public function catagory($id)
	{
		$this->data['title'] = 'Detail Pekerjaan';

		/* Data dari id */
		$id = (int) $id;

		$user_id = $this->job_industry_model->user()->result();
		$this->data['users'] = $this->job_industry_model->get_users_catagories($user_id);

		// Show data to View
		if ($this->ion_auth->is_admin())
		{
			$this->dashboard_admin('jobs/profile_job', $this->data);
		}
		else if ($this->ion_auth->is_user())
		{
			$this->dashboard_user('jobs/profile_job', $this->data);
		}
		else
		{
			$this->load->top_nav('jobs/lists-job', $this->data);
		}
	}

	public function add()
	{
		$this->data['title'] 	= $this->lang->line('create_job_heading');
		$this->data['sub_title'] = $this->lang->line('create_job_subheading');


		$tables 			= $this->config->item('tables', 'job_industry');
		$identity_column 	= $this->config->item('identity', 'job_industry');
		$this->data['identity_column'] = $identity_column;

		$config = array(
			array(
				'field' => 'description',
				'label' => 'descriptionn',
				'rules' => 'required|trim'
			),
			array(
				'field' => 'type',
				'label' => 'type',
				//'rules' => 'required|trim'
			),
			array(
				'field' => 'requirement',
				'label' => 'requirement',
				'rules' => 'required'
				//'rules' => 'required|valid_email|is_unique[frm_lowongan.email]'
			),
			array(
				'field' => 'sallary',
				'label' => 'sallary'
			),
			array(
				'field' => 'date_expired',
				'label' => 'date_expired',
				'rules' => 'required'
			)
		);

		// set config rules
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() === TRUE)
		{
			$name			= $this->input->post('name');
			$level_user 	= $this->input->post('level_user');
			$catagories 	= $this->input->post('catagories');

			$additional_data = array(
				'description'	=> $this->input->post('description'),
				'type'   	 	=> $this->input->post('type'),
				'requirement' 	=> $this->input->post('requirement'),
				'sallary'    	=> $this->input->post('sallary'),
				'date_expired'	=> tanggal_db($this->input->post('date_expired'))
			);

			$create_job = $this->job_industry->register($name,$additional_data,$level_user,$catagories);

			if ($create_job)
			{
				$this->session->set_flashdata('message', $this->job_industry->messages());
				redirect('jobs', 'refresh');
			}
		}
		else
		{
			// Display the create user form & set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->job_industry->errors() ? $this->job_industry->errors() : $this->session->flashdata('message')));

			$this->data['name'] = array(
				'name'			=> 'name',
				'id'			=> 'name',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('name'),
				'class'			=> 'form-control',
				'required'		=> 'required',
				'autofocus'		=> 'autofocus',
				'placeholder'	=> ('Nama Lowongan')
			);

			$this->data['type'] = array(
				'fulltime' 	=> 'Full Time',
				'parttime' 	=> 'Part Time',
				'freelance' => 'Freelance'
			);

			$this->data['description'] = array(
				'name' 			=> 'description',
				'id' 			=> 'textarea',
				'type' 			=> 'text',
				'value' 		=> $this->form_validation->set_value('description'),
				'class'			=> 'form-control',
				'placeholder'	=> 'Deskripsi',
				'style'			=> 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'
			);

			$this->data['requirement'] = array(
				'name'			=> 'requirement',
				'id' 			=> 'textarea1',
				'type'			=> 'text',
				'value'			=> $this->form_validation->set_value('requirement'),
				'class'			=> 'form-control',
				'placeholder' 	=> 'Persyaratan',
				'style'			=> 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'
			);

			$this->data['sallary'] = array(
				'name' 			=> 'sallary',
				'id' 			=> 'sallary',
				'type' 			=> 'number',
				'value' 		=> $this->form_validation->set_value('sallary'),
				'class'			=> 'form-control',
				'placeholder'	=> ('Gaji')
			);

			$this->data['date_expired'] = array(
				'name'			=> 'date_expired',
				'id'			=> 'date_expired',
				'type'			=> 'date',
				'value'			=> $this->form_validation->set_value('date_expired'),
				'class'			=> 'form-control',
				'required'		=> 'required',
				'placeholder'	=> ('Berlaku Hingga')
			);

			// Show data to View
			if ($this->ion_auth->is_admin())
			{
				$this->dashboard_admin('jobs/add', $this->data);
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
		$this->data['title'] = $this->lang->line('edit_job_heading');

		$user = $this->job_industry->user($id)->row();
		$groups = $this->job_industry->groups()->result_array();
		$current_level = $this->job_industry->get_users_groups($id)->row()->id;

		// setup validation rules
		$config = array(
			array(
				'field' => 'description',
				'label' => 'descriptionn',
				'rules' => 'required'
			),
			array(
				'field' => 'type',
				'label' => 'type',
				//'rules' => 'required|trim'
			),
			array(
				'field' => 'requirement',
				'label' => 'requirement',
				'rules' => 'required'
				//'rules' => 'required|valid_email|is_unique[frm_lowongan.email]'
			),
			array(
				'field' => 'sallary',
				'label' => 'sallary',
				//'rules' => 'required|trim'
			),
			array(
				'field' => 'date_expired',
				'label' => 'date_expired',
				'rules' => 'required'
			)
		);

		$this->form_validation->set_rules($config);

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$get_level_user = $this->input->post('level_user');

				$data = array(
					'name'   	 	=> $this->input->post('name'),
					'description' 	=> $this->input->post('description'),
					'requirement'  	=> $this->input->post('requirement'),
					'type'		   	=> $this->input->post('type'),
					'sallary'      	=> $this->input->post('sallary'),
					'date_expired'	=> tanggal_db($this->input->post('date_expired')),

					'date_modify' 	=> $this->input->post('date_modify'),
					'level_user' 	=> $get_level_user
				);

				// Update the groups user belongs to
				$groupData = $this->input->post('groups');

				if (isset($groupData) && !empty($groupData))
				{

					$this->job_industry->remove_from_group('', $id);

					foreach ($groupData as $grp)
					{
						$this->job_industry->add_to_group($grp, $id);
					}
				}


				// check to see if we are updating the user
				if ($this->job_industry->update($user->id, $data))
				{
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->job_industry->messages());

					redirect('jobs', 'refresh');
				}
				else
				{
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->job_industry->errors());

					redirect('jobs', 'refresh');

					//$this->redirectUser();
				}

			}
		}

		// display the edit user form$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->job_industry->errors() ? $this->job_industry->errors() : $this->session->flashdata('message')));
		$this->data['error'] = (validation_errors() ? validation_errors() : ($this->job_industry->errors() ? $this->job_industry->errors() : $this->session->flashdata('message')));


		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['current_level'] = $current_level;

		$this->data['name'] = array(
			'name'			=> 'name',
			'id'			=> 'name',
			'type'			=> 'text',
			'value'			=> $this->form_validation->set_value('name'),
			'class'			=> 'form-control',
			'required'		=> 'required',
			'autofocus'		=> 'autofocus',
			'placeholder'	=> ('Nama Lowongan')
		);

		$this->data['type'] = array(
			'fulltime' 	=> 'Full Time',
			'parttime' 	=> 'Part Time',
			'freelance' => 'Freelance'
		);

		$this->data['description'] = array(
			'name' 			=> 'description',
			'id' 			=> 'textarea',
			'type' 			=> 'text',
			'value' 		=> $this->form_validation->set_value('description'),
			'class'			=> 'form-control',
			'placeholder'	=> 'Deskripsi',
			'style'			=> 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'
		);

		$this->data['requirement'] = array(
			'name'			=> 'requirement',
			'id' 			=> 'textarea1',
			'type'			=> 'text',
			'value'			=> $this->form_validation->set_value('requirement'),
			'class'			=> 'form-control',
			'placeholder' 	=> 'Persyaratan',
			'style'			=> 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'
		);

		$this->data['sallary'] = array(
			'name' 			=> 'sallary',
			'id' 			=> 'sallary',
			'type' 			=> 'number',
			'value' 		=> $this->form_validation->set_value('sallary'),
			'class'			=> 'form-control',
			'placeholder'	=> ('Gaji')
		);

		$this->data['date_expired'] = array(
			'name'			=> 'date_expired',
			'id'			=> 'date_expired',
			'type'			=> 'date',
			'value'			=> $this->form_validation->set_value('date_expired'),
			'class'			=> 'form-control',
			'required'		=> 'required',
			'placeholder'	=> ('Berlaku Hingga')
		);

		// Show data to View
		if ($this->ion_auth->is_admin())
		{
			$this->dashboard_admin('jobs/edit', $this->data);
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

	/**
	* Lowongan Delete
	*
	*
	*/
	function delete($id)
	{
		if($id!= 1)
		{
			if ($this->ion_auth->is_admin())
			{
				$delete_user = $this->job_industry_model->delete_user($id);
			}
			else
			{
				redirect('dashboard','refresh');
			}
			$this->session->set_flashdata('message', '<div class="alert alert-info">Hapus data berhasil</div>');
		}
		else
		{
			if($id == 1)
			{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Superadmin tidak dapat di hapus</div>');
			}
			else
			{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Hapus data gagal</div>');
			}
		}

		redirect('jobs');
	}

	/*  Activate pengguna --------------
	*/
	public function activate($id, $code = FALSE)
	{
		if ($code !== false)
		{
			$activation = $this->job_industry->activate($id, $code);
		}
		else
		{
			$activation = $this->job_industry->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', ''.$this->job_industry->messages().'');
			redirect('jobs');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->job_industry->errors());
			redirect('jobs', 'refresh');
		}
	}

	//---------------------------------------------------------

	/** Deactivate pengguna
	*/
	function deactivate($id = NULL)
	{
		if (!$this->job_industry->logged_in())
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->job_industry->user($id)->row();

			$this->load->view('jobs/deactivate', $this->data);
		}

		if (isset($_POST) && !empty($_POST))
		{
			// do we really want to deleste?
			//if ($this->input->post('confirm') == 'yes')
			//{
			// do we have the right userlevel?
			//if ($this->job_industry->logged_in() && $this->job_industry->is_admin())
			//{
			$this->job_industry->deactivate($id);
			//}
			//}
			$this->session->set_flashdata('message', ''.$this->job_industry->messages().'');
			// redirect them back to the auth page
			redirect('jobs');
		}
	}

	//---------------------------------------------------------

	public function _upload_gambar(){

		// Setup folder upload path
		$config['upload_path']		= './uploads/';

		// Setup file yang di izinkan
		$config['allowed_types']	= 'pdf|doc|docx|jpg|jpeg|png|gif';

		// Encrpt nama foto agar tidak sama
		$config['encrypt_name']		= TRUE;

		// Memanggil library upload disertai dengan paramter $config array
		$this->load->library('upload', $config);

		$this->upload->initialize($config);

		// jika upload gagal, return false
		if( $this->upload->do_upload('formfile') == FALSE)
		{
			return FALSE;
			#return $this->upload->display_errors();
		}
		// jika upload berhasil, return nama file dan membuat thumbnail foto
		else
		{
			// Mengambil data yang berhasil di upload
			$uploaded_data = $this->upload->data();

			// Mendapatkan nama file
			$file_name = $uploaded_data['file_name'];

			// Return data
			return $uploaded_data;
		}
	}
}
