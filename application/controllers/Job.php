<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Job extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();

		need_login();
		$this->load->model( 'job_model', 'job' );
		$this->load->library(array('session','job_industry','form_validation','pagination'));
		$this->load->helper(array('url','language','form','time_helper','text'));
		$this->data['users'] = $this->ion_auth->users()->result();
	}

	public function index()
	{
		$data = array(
			'title'		=> 'Daftar Lowongan',
			'result'	=> $this->job->lists_job()
		);

		if ($this->ion_auth->is_admin())
		{
			$this->dashboard_admin('job/lists', $data );
		}
		else
		{
			$this->dashboard_user('job/lists-job', $data );
		}
	}

	//---------------------------------------------------------

	public function data_job($id)
	{
		$this->data['title'] = 'Data Profile User';

		/* Data dari id */
		$id = (int) $id;

		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->data['users'] = $this->job_industry->user($id)->result();
		foreach ($this->data['users'] as $k => $user)
		{
			$this->data['users'][$k]->groups = $this->job_industry->get_users_groups($user->id)->result();
			$this->data['users'][$k]->catagories = $this->job_industry->get_users_catagories($user->id)->result();
		}

		if ($this->ion_auth->is_admin())
		{
			$this->dashboard_admin('job/profile_job', $this->data);
		}
		else
		{
			$this->dashboard_user('job/profile_job', $this->data);
		}

	}

	//-- Master Lowongan add

	public function add()
	{
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
				'rules' => 'required')
			);

			// set config rules
			$this->form_validation->set_rules($config);
			// tampilkan form
			if($this->form_validation->run() === FALSE)
			{
				$data = array(
					'title'		=> 'Tambah Lowongan',
					'menu'		=> 'master',
					'submenu'	=> 'pengguna'
				);

				if ($this->ion_auth->is_admin())
				{
					$this->dashboard_admin('job/add', $data );
				}
				else
				{
					redirect('job','refresh');
				}
			}
			else
			{
				$upload_data = $this->_upload_files();
				$file_name = $upload_data['file_name'];

				$email   	 	= $this->input->post('name');
				$level_user 	= $this->input->post('level_user');
				$level_catagory = $this->input->post('level_catagory');
				$additional_data = array(
					'catagory'	=> $this->input->post('catagory'),
					'description'	=> $this->input->post('description'),
					'type'   	 	=> $this->input->post('type'),
					'requirement' 	=> $this->input->post('requirement'),
					'sallary'    	=> $this->input->post('sallary'),
					'date_expired'	=> tanggal_db($this->input->post('date_expired')),
					'date_created' 	=> $this->input->post('date_created'),
					'filedoc' => $file_name
				);
				$register_user = $this->job_industry->register( $email, $additional_data, $level_user, $level_catagory);
				$this->session->set_flashdata('message', '<div class="alert alert-success">Tambah data berhasil</div>');
				redirect('job','refresh');
			}
		}

		/** Master Lowongan Edit
		*/
		public function edit($id)
		{
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

			// tampilkan form
			if ($this->form_validation->run() === FALSE)
			{

				$type = array(
					'id'			=> 'type',
					'name'			=> 'type',
					'class'			=> 'form-control'
				);

				$type_option = array(
					'Full Time'			=> 'Full Time',
					'Part Time'			=> 'Part TIme',
					'Kontrak'			=> 'Kontrak',
					'Freelance'			=> 'Freelance'
				);

				$data = array(
					'title'			=> 'Edit Lowongan',
					'job'			=> $this->job_industry->user($id)->row(),

					'type' => $type,
					'type_option' => $type_option,
					'type_value'	=> $this->job_industry->user($id)->row()->type,

					'filedoc'			=> $this->job_industry->user($id)->row()->filedoc,
					'current_level'	=> $this->job_industry->get_users_groups($id)->row()->id,
					'current_catagory'=> $this->job_industry->get_users_catagories($id)->row()->id
				);

				if ($this->ion_auth->is_admin())
				{
					$this->dashboard_admin('job/edit', $data, $this->data);
				}
				else
				{
					redirect('job');
				}
			}
			else
			{
				$row = $this->job_industry->get_by_id($id);

				if ($_FILES AND $_FILES['filedoc']['name'])
				{
					$config['upload_path']		= './uploads/';
					$config['allowed_types']	= 'pdf|doc|docx|txt';

					// Memanggil library upload disertai dengan paramter $config array
					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('filedoc'))
					{
						$this->session->set_flashdata('message', "<div style='color:#ff0000;'>" . $this->upload->display_errors() . "</div>");
					}
					else
					{
						// Remove old image in folder 'images' using unlink() unlink() use for delete files like image.
						unlink('uploads/'.$row->filedoc);

						// Upload file nya
						$uploaded_data = $this->upload->data();
						$file_name = $uploaded_data['file_name'];

						$get_level_user = $this->input->post('level_user');
						$get_level_catagory = $this->input->post('level_catagory');

						$data = array(
							'name'   	 	=> $this->input->post('name'),
							'catagory'	=> $this->input->post('catagory'),
							'description' 	=> $this->input->post('description'),
							'requirement'  	=> $this->input->post('requirement'),
							'type'		   	=> $this->input->post('type'),
							'sallary'      	=> $this->input->post('sallary'),
							'date_expired'	=> tanggal_db($this->input->post('date_expired')),

							'date_modify' 	=> $this->input->post('date_modify'),
							'level_user' 	=> $get_level_user,
							'level_catagory'=> $get_level_catagory,
							'filedoc'		=> $file_name
						);

						// update level user
						if (isset($get_level_user) && !empty($get_level_user)) {

							// remove current group
							$this->job_industry->remove_from_group('', $id);

							// update group
							foreach ($get_level_user as $level) {
								$this->job_industry->add_to_group($level, $id);
							}

						}

						// update level user
						if (isset($get_level_catagory) && !empty($get_level_catagory)) {

							// remove current group
							$this->job_industry->remove_from_catagory('', $id);

							// update group
							foreach ($get_level_catagory as $level) {
								$this->job_industry->add_to_catagory($level, $id);
							}

						}

						// check to see if we are updating the user
						if($this->job_industry->update($id, $data))
						{
							$this->session->set_flashdata('message', '<div class="alert alert-info">Update info berhasil</div>');

							redirect('job','refresh');
						}
						else
						{
							$this->session->set_flashdata('message', '<div class="alert alert-info">Update info gagal</div>');

							redirect('job','refresh');
						}
					}
				}
				else
				{
					$get_level_user = $this->input->post('level_user');
					$get_level_catagory = $this->input->post('level_catagory');

					$data = array(
						'name'   	 	=> $this->input->post('name'),
						'catagory'	=> $this->input->post('catagory'),
						'description' 	=> $this->input->post('description'),
						'requirement'  	=> $this->input->post('requirement'),
						'type'		   	=> $this->input->post('type'),
						'sallary'      	=> $this->input->post('sallary'),
						'date_expired'	=> tanggal_db($this->input->post('date_expired')),

						'date_modify' 	=> $this->input->post('date_modify'),
						'level_user' 	=> $get_level_user,
						'level_catagory'=> $get_level_catagory
					);

					// update level user
					if (isset($get_level_user) && !empty($get_level_user)) {

						// remove current group
						$this->job_industry->remove_from_group('', $id);

						// update group
						foreach ($get_level_user as $level) {
							$this->job_industry->add_to_group($level, $id);
						}

					}

					// update level user
					if (isset($get_level_catagory) && !empty($get_level_catagory)) {

						// remove current group
						$this->job_industry->remove_from_catagory('', $id);

						// update group
						foreach ($get_level_catagory as $level) {
							$this->job_industry->add_to_catagory($level, $id);
						}

					}

					// check to see if we are updating the user
					if($this->job_industry->update($id, $data))
					{
						$this->session->set_flashdata('message', '<div class="alert alert-info">Update info berhasil</div>');

						redirect('job');
					}
					else
					{
						$this->session->set_flashdata('message', '<div class="alert alert-info">Update info gagal</div>');

						redirect( 'job');
					}
				}
			}
		}

		//---------------------------------------------------------
		/* Lowongan Delete */
		public function delete($id)
		{
			if($id != 1 )
			{
				$delete_user = $this->job->delete_job($id);
				$this->session->set_flashdata('action_status', '<div class="alert alert-info">Hapus data berhasil</div>');
			}
			else
			{
				if($id == 1)
				{
					$this->session->set_flashdata('action_status', '<div class="alert alert-danger">Superadmin tidak dapat di hapus</div>');
				}
				else
				{
					$this->session->set_flashdata('action_status', '<div class="alert alert-danger">Hapus data gagal</div>');
				}
			}

			redirect('job');
		}

		/*  Activate pengguna */
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
				$this->session->set_flashdata('action_status', '<div class="alert alert-info">'.$this->job_industry->messages().'</div>');
				redirect( 'job' );
			}
			else
			{
				// redirect them to the forgot password page
				$this->session->set_flashdata('action_status', $this->job_industry->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}

		/** Deactivate pengguna */
		public function deactivate($id = NULL)
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

				$this->load->template('job/deactivate', $this->data);
			}

			if (isset($_POST) && !empty($_POST))
			{
				// do we really want to deleste?
				//if ($this->input->post('confirm') == 'yes')
				//{
				// do we have the right userlevel?
				//if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				//{
				$this->job_industry->deactivate($id);
				//}
				//}
				$this->session->set_flashdata('action_status', '<div class="alert alert-info">'.$this->job_industry->messages().'</div>');
				// redirect them back to the auth page
				redirect( 'job' );
			}
		}

		public function _upload_files()
		{
			// Setup folder upload path
			$config['upload_path']		= './uploads/';

			// Setup file yang di izinkan
			$config['allowed_types']	= 'pdf|doc|docx|txt';

			// Memanggil library upload disertai dengan paramter $config array
			$this->load->library('upload', $config);
			//$this->upload->initialize($config);
			// jika upload gagal, return false
			if($this->upload->do_upload('filedoc') == FALSE)
			{
				//return FALSE;
				$this->session->set_flashdata('message', "<div style='color:#ff0000;'>" . $this->upload->display_errors() . "</div>");
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

		public function _update_upload_files()
		{

		}
	}
