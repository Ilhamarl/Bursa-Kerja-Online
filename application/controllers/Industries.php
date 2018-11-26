<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Industries extends Public_Controller
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
			$this->data['title'] 	= $this->lang->line('industry_name_label');

			// set the flash data error message if there is one
			$this->data['message']	= (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			//list the Groups
			$this->data['groups']	= $this->job_industry->groups()->result();

			if ($this->ion_auth->is_admin())
			{
				$this->dashboard_admin('industries/lists-group', $this->data);
			}
			else if ($this->ion_auth->is_user())
			{
				$this->dashboard_user('industries/lists-industry', $this->data);
			}
			else
			{
				$this->load->top_nav('industries/lists-industry', $this->data);
			}
		}


		public function add()
		{
			$this->data['title'] = $this->lang->line('create_group_title');

			$config = array(
			array(
			'field' => 'group_name',
			'label' => 'descriptionn',
			'rules' => 'required'
			),
			array(
			'field' => 'description',
			'label' => 'description',
			//'rules' => 'required|trim'
			),
			array(
			'field' => 'about',
			'label' => 'about',
			'rules' => 'required'
			//'rules' => 'required|valid_website|is_unique[frm_lowongan.website]'
			),
			array(
			'field' => 'website',
			'label' => 'website',
			//'rules' => 'required|trim'
			),
			array(
			'field' => 'phone',
			'label' => 'phone',
			'rules' => 'required'
			),
			array(
			'field' => 'location',
			'label' => 'location',
			'rules' => 'required'
			),
			array(
			'field' => 'address',
			'label' => 'address',
			'rules' => 'required'
			)
			);
			// check validation
			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
			{
				// memanggil private function untuk upload gambar
				$get_foto = $this->_upload_gambar();

				// mendapatkan nama file foto
				$foto = $get_foto['file_name'];

				// setup nama thumbnail foto
				$thumb_foto = $get_foto['raw_name'].'_thumb'.$get_foto['file_ext'];

				$name 			= $this->input->post('group_name');
				$description 	= $this->input->post('description');

				$additional_data = array(
				'description'	=> $this->input->post('description'),
				'about'   	 	=> $this->input->post('about'),
				'website'		=> $this->input->post('website'),
				'phone'    		=> $this->input->post('phone'),
				'location'		=> $this->input->post('location'),
				'address'		=> $this->input->post('address'),
				'foto'			=> $foto,
				'thumb_foto'	=> $thumb_foto
				);

				$new_group_id = $this->job_industry->create_group($name,$description,$additional_data);

				if ($new_group_id)
				{
					// check to see if we are creating the group
					$this->session->set_flashdata('message', $this->job_industry->messages());
					redirect('industries');
				}
			}
			else
			{
				// display the create group form
				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->job_industry->errors() ? $this->job_industry->errors() : $this->session->flashdata('message')));

				$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
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
					$this->dashboard_admin('industries/add-group', $this->data);
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
			$this->data['title'] = $this->lang->line('edit_group_title');

			// bail if no group id given
			if ($id == NULL)
			{
				$this->session->set_flashdata('message', '<div class="alert alert-info">Group tidak ada</div>');

				redirect('industries', 'refresh');
			}

			$group = $this->job_industry->group($id)->row();

			$config = array(
			array(
			'field' => 'group_name',
			'label' => 'descriptionn',
			'rules' => 'required'
			),
			array(
			'field' => 'group_description',
			'label' => 'description',
			//'rules' => 'required|trim'
			),
			array(
			'field' => 'about',
			'label' => 'about',
			'rules' => 'required'
			//'rules' => 'required|valid_website|is_unique[frm_lowongan.website]'
			),
			array(
			'field' => 'website',
			'label' => 'website',
			//'rules' => 'required|trim'
			),
			array(
			'field' => 'phone',
			'label' => 'phone',
			),
			array(
			'field' => 'location',
			'label' => 'location',
			'rules' => 'required'
			),
			array(
			'field' => 'address',
			'label' => 'address',
			'rules' => 'required'
			)
			);

			// set valldation
			$this->form_validation->set_rules($config);

			if (isset($_POST) && !empty($_POST))
			{
				if ($this->form_validation->run() === TRUE)
				{
					// memanggil private function untuk upload gambar
					$get_foto = $this->_upload_gambar();

					// mendapatkan nama file foto
					$foto = $get_foto['file_name'];

					// setup nama thumbnail foto
					$thumb_foto = $get_foto['raw_name'].'_thumb'.$get_foto['file_ext'];

					$data = array(
					'about'   	 	=> $this->input->post('about'),
					'website'		=> $this->input->post('website'),
					'phone'    		=> $this->input->post('phone'),
					'location'		=> $this->input->post('location'),
					'address'		=> $this->input->post('address'),
					'foto'			=> $foto,
					'thumb_foto'	=> $thumb_foto
					);

					$group_update = $this->job_industry->update_group($id, $_POST['group_name'], $_POST['group_description'],$data);

					if ($group_update)
					{
						$this->session->set_flashdata('message', $this->job_industry->messages());
					}
					else
					{
						$this->session->set_flashdata('message', $this->job_industry->errors());
					}
					redirect('industries');
				}
			}

			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->job_industry->errors() ? $this->job_industry->errors() : $this->session->flashdata('message')));

			// pass the user to the view
			$this->data['group'] = $group;

			$this->data['group_name'] = array(
			'name'		=> 'group_name',
			'id'		=> 'group_name',
			'type'		=> 'text',
			'value'		=> $this->form_validation->set_value('group_name', $group->name),
			'class'		=> 'form-control'
			);
			$this->data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
			'class'	=> 'form-control'
			);

			if ($this->ion_auth->is_admin())
			{
				$this->dashboard_admin('industries/edit-group', $this->data);
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


		public function data_industry($id)
		{
			$this->data['title'] = 'Data Profile Industry';

			/* Data */
			$id = (int) $id;
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['groups'] = $this->job_industry->group($id)->result();

			/* Load Template */
			if ($this->ion_auth->is_admin())
			{
				$this->dashboard_admin('industries/profile_industry', $this->data);
			}
			else if ($this->ion_auth->is_user())
			{
				$this->dashboard_user('industries/profile_industry', $this->data);
			}
			else
			{
				$this->load->top_nav('industries/profile_industry', $this->data);
			}

		}

		//---------------------------------------------------------

		public function delete_industry ($id)
		{
			/*
				if( $id == 1 || $id == 2 ) {
				redirect('industry/lists_industry');
				exit();
			}*/

			$delete = $this->job_industry_model->delete_group($id);

			if($delete)
			{
				$this->session->set_flashdata('message', '<div class="alert alert-info">Hapus Industri berhasil</div>');
			}
			else
			{
				$this->session->set_flashdata('message', '<div class="alert alert-warning">Hapus Industri gagal</div>');
			}

			redirect('industries');
		}

		public function _upload_gambar() {

			// Setup folder upload path
			$config['upload_path']		= './uploads/';

			// Setup file yang di izinkan
			$config['allowed_types']	= 'jpg|jpeg|png|gif';

			// Encrpt nama foto agar tidak sama
			$config['encrypt_name']		= TRUE;

			// Memanggil library upload disertai dengan paramter $config array
			$this->load->library('upload', $config);

			// jika upload gagal, return false
			if( $this->upload->do_upload( 'foto' ) == FALSE) {
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

				// Memanggil library GD 2
				$config['image_library'] = 'gd2';

				// Memanggil nama file images
				$config['source_image'] = './uploads/'.$file_name;

				// Membuat thumbnail
				$config['create_thumb'] = TRUE;

				// Mempertahankan foto berdasarkan ratio, hal ini digunakan agar foto tidak gepeng
				$config['maintain_ratio'] = TRUE;

				// Setting lebar dan tinggi
				$config['width']         = 100;
				//$config['height']       = 100;

				// Memanggil library image_lib untuk memproses images resize disertai dengan parameter $config
				$this->load->library('image_lib', $config);

				// Melakukan resize
				$this->image_lib->resize();

				// Return data
				return $uploaded_data;
			}
		}

	}
