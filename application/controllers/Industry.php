<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Industry extends Public_Controller
	{
		//Construct
		public function __construct()
		{
			parent::__construct();

			$this->load->model('industry_model', 'industry');
			$this->load->helper(array('time_helper'));

			if (!$this->ion_auth->logged_in())
			{
				// redirect them to the login page
				redirect('auth/login', 'refresh');
			}
		}

		function index()
		{
			if ($this->ion_auth->is_admin())
			{
				redirect('industry/lists');
			}
			else
			{
				redirect('industry/lists_industry');
			}
		}

		/**
			* Daftar group
		*/

		function lists() {
			$data = array(
			'title'				=> 'Daftar Group',
			'menu'				=> 'pengguna',
			'submenu'			=> 'group',
			'result'			=> $this->industry->lists_industry()
			);
			$this->dashboard_admin('industry/lists-industry', $data );
		}

		function lists_industry() {
			$data = array(
			'title'				=> 'Daftar Group',
			'menu'				=> 'pengguna',
			'submenu'			=> 'group',
			'result'			=> $this->industry->lists_industry()
			);
			$this->dashboard_user('industry/lists-industry', $data );
		}

		function data_industry($id)
		{
			$this->data['title'] = 'Data Profile Industry';

			/* Data */
			$id = (int) $id;
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['groups'] = $this->job_industry->group($id)->result();

			/* Load Template */
			if ($this->ion_auth->is_admin())
			{
				$this->dashboard_admin('industry/profile_industry', $this->data);
			}
			else
			{
				$this->dashboard_user('industry/profile_industry', $this->data);
			}

		}

		//---------------------------------------------------------

		/**
			* tambah group
		*/
		function add()
		{
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

			// jika false, tampilkan form
			if($this->form_validation->run() === FALSE)
			{
				$data = array(
				'title'			=> 'Tambah Group',
				'menu'			=> 'pengguna',
				'submenu'		=> 'group'
				);

				$this->dashboard_admin( 'industry/add-group', $data );
			}
			else
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
				'website'		 	=> $this->input->post('website'),
				'phone'    		=> $this->input->post('phone'),
				'location'		=> $this->input->post('location'),
				'address'		=> $this->input->post('address'),
				'foto'			=> $foto,
				'thumb_foto'	=> $thumb_foto
				);

				// tambah group baru
				$add_group = $this->job_industry->create_group($name,$description,$additional_data);

				// set session messange untuk hasil result add_group dan redirect
				if($add_group != FALSE)
				{
					$this->session->set_flashdata('action_status', '<div class="alert alert-info">Tambah group berhasil</div>');
				}
				else
				{
					$this->session->set_flashdata('action_status', '<div class="alert alert-danger">Tambah group gagal</div>');
				}

				// redirect ke list group
				redirect('industry/lists');
			}
		}

		//---------------------------------------------------------

		/**
			* edit group
			* @param integer $id
			* @return view
		*/
		function edit($id)
		{
			// jika group null, redirect
			if($id == NULL) {
				$this->session->set_flashdata('action_status', '<div class="alert alert-info">Group tidak ada</div>');

				redirect('industry/lists_industry');
			}

			/* ID 1 dan 2 untuk admin dan member tidak dapat di edit
				if($id == 1 || $id == 2)
				{
				$this->session->set_flashdata('action_status', '<div class="alert alert-info">Group Admin dan member tidak dapat di edit</div>');

				redirect('industry/lists_industry');

				exit();
			} */

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
			// tampilkan form
			if ($this->form_validation->run() === FALSE)
			{
				$data = array(
				'title'			=> 'Edit Group',
				'menu'			=> 'pengguna',
				'submenu'		=> 'group',
				'row'			=> $this->industry->edit_industry($id)
				);

				$this->dashboard_admin('industry/edit-group', $data );
			}
			else
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
				// update group
				$group_update = $this->job_industry->update_group($id, $_POST['group_name'], $_POST['group_description'], $data);

				if($group_update === TRUE)
				{
					$this->session->set_flashdata('action_status', '<div class="alert alert-info">Update group berhasil</div>');

					redirect("industry/lists");
				}
			}
		}

		//---------------------------------------------------------

		function delete_industry ($id)
		{
			/*
				if( $id == 1 || $id == 2 ) {
				redirect('industry/lists_industry');
				exit();
			}*/

			$delete = $this->industry->delete_industry( $id );

			if( $delete != 0 ) {

				$this->session->set_flashdata( 'action_status', '<div class="alert alert-info">Hapus data berhasil</div>' );

				} else {

				$this->session->set_flashdata( 'action_status', '<div class="alert alert-warning">Hapus data gagal</div>' );

			}

			redirect('industry/lists');
		}

		public function _upload_gambar()
		{
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
