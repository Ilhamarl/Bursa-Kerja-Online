<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		//need_login(); function from app_helper
		need_login();
	}

	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else
		{
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->user()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->dashboard_user('user/index', $this->data);
		}
	}

	public function data_user()
	{
		$this->data['title'] = 'Data User';
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		else if ($this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->user()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->dashboard_admin('admin/index', $this->data);
		}
		else
		{
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->user()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->dashboard_user('user/profile_user', $this->data);
		}
	}

	public function edit_user($id)
	{
		$this->data['title'] = $this->lang->line('edit_user_heading');

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'trim|required');

		$this->form_validation->set_rules('location', 'Location', 'trim|required');
		$this->form_validation->set_rules('birthdate', 'Tanggal Lahir', 'trim|required');

		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'trim|required');
		$this->form_validation->set_rules('address', $this->lang->line('edit_user_validation_address_label'));
		$this->form_validation->set_rules('sex', 'Jenis kelamin');
		$this->form_validation->set_rules('religion', 'Jenis kelamin');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'location' => $this->input->post('location'),
					'birthdate' => $this->input->post('birthdate'),
					'phone' => $this->input->post('phone'),
					'address' => $this->input->post('address'),
					'sex' => $this->input->post('sex'),
					'religion' => $this->input->post('religion'),
					'skill' => $this->input->post('skill')
				);

				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}

				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					// Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData))
					{

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp)
						{
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
				}

				// check to see if we are updating the user
				if ($this->ion_auth->update($user->id, $data))
				{
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('user/data_user', 'refresh');
					}
					$this->redirectUser();
				}
				else
				{
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('user/data_user', 'refresh');
					}
					$this->redirectUser();
				}

			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
			'class'	=> 'form-control',
			'placeholder' => ('Nama Depan')
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
			'class'	=> 'form-control',
			'placeholder' => ('Nama Belakang')
		);
		$this->data['location'] = array(
			'name'  => 'location',
			'id'    => 'location',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('location', $user->location),
			'class'	=> 'form-control',
			'placeholder' => ('Tempat Lahir')
		);
		$this->data['birthdate'] = array(
			'name'  => 'birthdate',
			'id'    => 'birthdate',
			'type'  => 'date',
			'value' => $this->form_validation->set_value('birthdate', $user->birthdate),
			'class'	=> 'form-control',
			'placeholder' => ('Tanggal Lahir')
		);
		$this->data['address'] = array(
			'name'  => 'address',
			'id'    => 'address',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('address', $user->address),
			'class'	=> 'form-control',
			'placeholder' => ('Alamat')
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
			'class'	=> 'form-control',
			'data-inputmask' => '"mask": "(999) 999-9999" data-mask',
			'placeholder' => ('No.Handphone')
		);

		$this->data['skill'] = array(
			'name'  => 'skill',
			'id'    => 'skill',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('skill', $user->skill),
			'class'	=> 'form-control',
			'placeholder' => ('Kemampuan yang dimiliki')
		);

//--------
		$this->data['sex'] = array(
			'name'  => 'sex',
			'id'    => 'sex',
			'class'	=> 'form-control'
		);
		$this->data['sex_option'] = array(
			'Laki-laki'	=> 'Laki-laki',
			'Perempuan'	=> 'Perempuan'
		);
		$this->data['sex_value'] = array(
			$this->form_validation->set_value('sex', $user->sex)
		);
//----------
		$this->data['religion'] = array(
			'name'  => 'religion',
			'id'    => 'religion',
			'class'	=> 'form-control'
		);
		$this->data['religion_option'] = array(
			'Islam'	=> 'Islam',
			'Hindu'	=> 'Hindu',
			'Budha'	=> 'Budha',
			'Kristen'	=> 'Kristem',
			'Katolik'	=> 'Katolik',
			'Konghucu'	=> 'Konghucu',
		);
		$this->data['religion_value'] = array(
			$this->form_validation->set_value('religion', $user->religion)
		);
//----------
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password',
			'class'	=> 'form-control',
			'placeholder' => ('Password')
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password',
			'class'	=> 'form-control',
			'placeholder' => ('Konfirmasi Password')
		);

		$this->dashboard_user('user/edit_profile_user', $this->data);
	}

	public function change_password()
	{
		$this->data['title'] = $this->lang->line('change_password_heading');

		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() === FALSE)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id' => 'old',
				'type' => 'password',
				'class'	=> 'form-control',
				'placeholder' => $this->lang->line('change_password_validation_old_password_label')
			);
			$this->data['new_password'] = array(
				'name' => 'new',
				'id' => 'new',
				'type' => 'password',
				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				'class'	=> 'form-control',
				'placeholder' => $this->lang->line('change_password_validation_old_password_label')
			);
			$this->data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id' => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				'class'	=> 'form-control',
				'placeholder' => $this->lang->line('change_password_validation_new_password_confirm_label')
			);
			$this->data['user_id'] = array(
				'name' => 'user_id',
				'id' => 'user_id',
				'type' => 'hidden',
				'value' => $user->id,
			);

			// render
			$this->dashboard_user('user/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('user/change_password', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('dashboard', 'refresh');
			}
		}
	}

	public function change_email()
	{
		$password = $this->input->post('password');
		$identity = $user->{$this->config->item('identity', 'ion_auth')};


		// if return 0 rows $user2 = FALSE; if return 1 $user2 = TRUE;
		if($this->ion_auth->login($identity, $password)){
			$data = array('email'=>$this->input->post('email'));
			if ($this->ion_auth->update($user2->id, $data))
			{
				// redirect them back to the admin page if admin, or to the base url if non admin
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('/', 'refresh');
			}
		}
		else {
			// wrong password message
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			$this->load->view('change_email_user');
		}
	}

}
