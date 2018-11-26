<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		need_login();
		need_admin();
		$this->load->database();
		$this->load->model('job_industry_model');
		$this->load->library(array('session','job_industry','form_validation'));
		$this->load->helper(array('url','language','form','time_helper'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'job_industry'), $this->config->item('error_end_delimiter', 'job_industry'));
	}

	public function index()
	{
		if ($this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['users'] = $this->ion_auth->user()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}
			$this->dashboard_admin('admin/index', $this->data);
		}
	}

public function settings()
{
	if ($this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
	{
		$this->data['title'] = 'Data Profile Admin';
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

		//list the users
		$this->data['users'] = $this->ion_auth->user()->result();
		foreach ($this->data['users'] as $k => $user)
		{
			$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}

		$this->dashboard_admin('admin/profile_admin', $this->data);
	}
	else
	{
		$this->data['title'] = 'Data Profile User';
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

		//list the users
		$this->data['users'] = $this->ion_auth->users()->result();
		foreach ($this->data['users'] as $k => $user)
		{
			$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}

		$this->dashboard_admin('admin/index', $this->data);
	}
}

public function data_user($id)
{
	$this->data['title'] =  $this->lang->line('index_heading');

	/* Data */
	$id = (int) $id;
	$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
	$this->data['users'] = $this->ion_auth->user($id)->result();
	foreach ($this->data['users'] as $k => $user)
	{
		$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
	}
	/* Load Template */
	$this->dashboard_admin('admin/profile_user', $this->data);

}


public function users()
{
	$this->data['title'] = $this->lang->line('index_heading');
	// set the flash data error message if there is one
	$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

	//list the users
	$this->data['users'] = $this->ion_auth->users()->result();
	foreach ($this->data['users'] as $k => $user)
	{
		$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
	}

	$this->dashboard_admin('admin/list_user', $this->data);
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
	else if (!$this->ion_auth->is_user())
	{
		$this->dashboard_user('admin/profile_catagory', $this->data);
	}
	else
	{
		$this->load->top_nav('admin/profile_catagory', $this->data);
	}
}

public function catagory_add()
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
			$this->session->set_flashdata('message', 'Berhasil tambah katagori');
			redirect('admin/catagories');
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

public function catagory_edit($id)
{
	$this->data['title'] = 'Edit Katagori';

	// bail if no catagory id given
	if ($id == NULL)
	{
		$this->session->set_flashdata('message', '<div class="alert alert-info">Group tidak ada</div>');

		redirect('admin/catagories', 'refresh');
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
				$this->session->set_flashdata('message', 'Katagori berhasil diupdate');
			}
			else
			{
				$this->session->set_flashdata('message', 'Katagori gagal di update');
			}
			redirect('admin/catagories');
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

public function delete_catagory($id)
{
	if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
	{
		// redirect them to the home page because they must be an administrator to view this
		return show_error('You must be an administrator to view this page.');
	}

	$id = (int)$id;

	$this->load->library('form_validation');
	$this->form_validation->set_rules('confirm', $this->lang->line('delete_user_validation_confirm_label'), 'required');
	$this->form_validation->set_rules('id', $this->lang->line('delete_user_validation_user_id_label'), 'required|alpha_numeric');

	if ($this->form_validation->run() === FALSE)
	{
		// insert csrf check
		$this->data['csrf'] = $this->_get_csrf_nonce();
		$this->data['user'] = $this->catagory_job_model->user($id)->row();

		$this->load->view('admin/delete_catagory', $this->data);
	}
	if (isset($_POST) && !empty($_POST))
	{
		// do we really want to delete?
		//if ($this->input->post('confirm') == 'yes')
		//{
		// do we have the right userlevel?
		//if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
		//{
		$this->catagory_job_model->delete_user($id);
		//}
		//}

		$this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil hapus katagori</div>');
		// redirect them back to the auth page
		redirect('catagories', 'refresh');
	}
}

/** Create a new user
*/
public function create_user()
{
	$this->data['title'] 	= $this->lang->line('create_user_heading');
	$this->data['sub_title'] = $this->lang->line('create_user_subheading');

	if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
	{
		redirect('auth', 'refresh');
	}

	$tables 			= $this->config->item('tables', 'ion_auth');
	$identity_column 	= $this->config->item('identity', 'ion_auth');
	$this->data['identity_column'] = $identity_column;

	// Validate form input
	$this->form_validation->set_rules('first_name',	$this->lang->line('create_user_validation_fname_label'), 'trim|required');
	$this->form_validation->set_rules('last_name',	$this->lang->line('create_user_validation_lname_label'), 'trim|required');

	// Validate Email
	if ($identity_column !== 'email')
	{
		$this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
	}
	else
	{
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
	}

	$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
	$this->form_validation->set_rules('address', $this->lang->line('create_user_validation_address_label'), 'trim');
	$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
	$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

	if ($this->form_validation->run() === TRUE)
	{
		$email = strtolower($this->input->post('email'));
		$identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
		$password = $this->input->post('password');

		$additional_data = array(
			'first_name'	=> $this->input->post('first_name'),
			'last_name' 	=> $this->input->post('last_name'),
			'address'		=> $this->input->post('address'),
			'phone' 		=> $this->input->post('phone'),
		);
	}
	if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data))
	{
		// Check to see if we are creating the user & Redirect them back to the admin page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('admin/users', 'refresh');
	}
	else
	{
		// display the create user form
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		$this->data['first_name'] = array(
			'name'			=> 'first_name',
			'id'			=> 'first_name',
			'type'			=> 'text',
			'value'			=> $this->form_validation->set_value('first_name'),
			'class'			=> 'form-control',
			'placeholder'	=> ('Nama Depan')
		);
		$this->data['last_name'] = array(
			'name' => 'last_name',
			'id' => 'last_name',
			'type' => 'text',
			'value' => $this->form_validation->set_value('last_name'),
			'class'			=> 'form-control',
			'placeholder'	=> ('Nama Belakang')
		);
		$this->data['identity'] = array(
			'name' => 'identity',
			'id' => 'identity',
			'type' => 'text',
			'value' => $this->form_validation->set_value('identity'),
			'class'		=> 'form-control',
			'placeholder'	=> ('Username')
		);
		$this->data['email'] = array(
			'name' => 'email',
			'id' => 'email',
			'type' => 'email',
			'value' => $this->form_validation->set_value('email'),
			'class'		=> 'form-control',
			'placeholder'	=> ('Email')
		);
		$this->data['address'] = array(
			'name' => 'address',
			'id' => 'address',
			'type' => 'text',
			'value' => $this->form_validation->set_value('address'),
			'class'			=> 'form-control',
			'placeholder'	=> ('Alamat')
		);
		$this->data['phone'] = array(
			'name' => 'phone',
			'id' => 'phone',
			'type' => 'text',
			'value' => $this->form_validation->set_value('phone'),
			'class'			=> 'form-control',
			'placeholder'	=> ('No. Handphone')
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id' => 'password',
			'type' => 'password',
			'value' => $this->form_validation->set_value('password'),
			'class'			=> 'form-control',
			'placeholder'	=> ('Password')
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id' => 'password_confirm',
			'type' => 'password',
			'value' => $this->form_validation->set_value('password_confirm'),
			'class'			=> 'form-control',
			'placeholder'	=> ('Konfirmasi Password')
		);

		$this->dashboard_admin('admin/create_user', $this->data);
	}
}

/** Edit a user
* @param int|string $id
*/

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
	$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'));
	$this->form_validation->set_rules('address', $this->lang->line('edit_user_validation_address_label'));

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
				'first_name'=> $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'location' 	=> $this->input->post('location'),
				'birthdate' => $this->input->post('birthdate'),
				'address'	=> $this->input->post('address'),
				'phone'		=> $this->input->post('phone'),
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
					redirect('admin/users', 'refresh');
				}
				else
				{
					redirect('/', 'refresh');
				}
				$this->redirectUser();
			}
			else
			{
				// redirect them back to the admin page if admin, or to the base url if non admin
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				if ($this->ion_auth->is_admin())
				{
					redirect('admin/users', 'refresh');
				}
				else
				{
					redirect('/', 'refresh');
				}
				$this->redirectUser();
			}
		}
	}
	// display the edit user form
	$this->data['csrf'] = $this->_get_csrf_nonce();
	// set the flash data error message if there is one
	$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
	$this->data['error'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
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
		'placeholder' => $this->lang->line('edit_user_validation_fname_label')
	);
	$this->data['last_name'] = array(
		'name'  => 'last_name',
		'id'    => 'last_name',
		'type'  => 'text',
		'value' => $this->form_validation->set_value('last_name', $user->last_name),
		'class'	=> 'form-control',
		'placeholder' => $this->lang->line('edit_user_validation_lname_label')
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
		'value' => $this->form_validation->set_value('birthdate', $user->birthdate),
		'type'  => 'date',
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
		'placeholder' => $this->lang->line('edit_user_validation_phone_label')
	);
	$this->data['password'] = array(
		'name' => 'password',
		'id'   => 'password',
		'type' => 'password',
		'class'	=> 'form-control',
		'placeholder' => $this->lang->line('edit_user_validation_password_label')
	);
	$this->data['password_confirm'] = array(
		'name' => 'password_confirm',
		'id'   => 'password_confirm',
		'type' => 'password',
		'class'	=> 'form-control',
		'placeholder' => $this->lang->line('edit_user_validation_password_confirm_label')
	);

	$this->dashboard_admin('admin/edit_user', $this->data);
}

/**
* DELETE USER LANGSUNG MODAL
*/
public function delete_user($id)
{
	if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
	{
		// redirect them to the home page because they must be an administrator to view this
		return show_error('You must be an administrator to view this page.');
	}

	$id = (int)$id;

	$this->load->library('form_validation');
	$this->form_validation->set_rules('confirm', $this->lang->line('delete_user_validation_confirm_label'), 'required');
	$this->form_validation->set_rules('id', $this->lang->line('delete_user_validation_user_id_label'), 'required|alpha_numeric');

	if ($this->form_validation->run() === FALSE)
	{
		// insert csrf check
		$this->data['csrf'] = $this->_get_csrf_nonce();
		$this->data['user'] = $this->ion_auth->user($id)->row();

		$this->load->view('admin/delete_user', $this->data);
	}
	if (isset($_POST) && !empty($_POST))
	{
		// do we really want to delete?
		//if ($this->input->post('confirm') == 'yes')
		//{
		// do we have the right userlevel?
		//if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
		//{
		$this->ion_auth->delete_user($id);
		//}
		//}

		$this->session->set_flashdata('message', $this->ion_auth->messages());
		// redirect them back to the auth page
		redirect('admin/users', 'refresh');
	}
}
//----------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Activate the user
* @param int         $id   The user ID
* @param string|bool $code The activation code
*/
public function activate($id, $code = FALSE)
{
	if ($code !== FALSE)
	{
		$activation = $this->ion_auth->activate($id, $code);
	}
	else if ($this->ion_auth->is_admin())
	{
		$activation = $this->ion_auth->activate($id);
	}

	if ($activation)
	{
		// redirect them to the auth page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('admin/users', 'refresh');
	}
	else
	{
		// redirect them to the forgot password page
		$this->session->set_flashdata('message', $this->ion_auth->errors());
		redirect('auth/forgot_password', 'refresh');
	}
}

/**
* Deactivate the user LANGSUNG MODAL
*
* @param int|string|null $id The user ID
*/
public function deactivate($id = NULL)
{
	if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
	{
		// redirect them to the login page
		redirect('dashboard', 'refresh');
	}

	$id = (int)$id;

	$this->load->library('form_validation');
	$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
	$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

	if ($this->form_validation->run() === FALSE)
	{
		// insert csrf check
		$this->data['csrf'] = $this->_get_csrf_nonce();
		$this->data['user'] = $this->ion_auth->user($id)->row();

		$this->load->view('admin/deactivate_user', $this->data);
	}
	if (isset($_POST) && !empty($_POST))
	{
		// do we really want to deleste?
		//if ($this->input->post('confirm') == 'yes')
		//{
		// do we have the right userlevel?
		//if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
		//{
		$this->ion_auth->deactivate($id);
		//}
		//}
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		// redirect them back to the auth page
		redirect('admin/users');
	}
}

//------------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Create a new group
*/
public function create_group()
{
	$this->data['title'] = $this->lang->line('create_group_title');

	if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
	{
		redirect('auth', 'refresh');
	}

	// validate form input
	$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'trim|required|alpha_dash');

	if ($this->form_validation->run() === TRUE)
	{
		$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
		if ($new_group_id)
		{
			// check to see if we are creating the group
			// redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('admin/list_groups');
		}
	}
	else
	{
		// display the create group form
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		$this->data['group_name'] = array(
			'name'  => 'group_name',
			'id'    => 'group_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_name'),
			'placeholder'=> $this->lang->line('create_group_validation_name_label'),
			'class'	=> 'form-control'
		);
		$this->data['description'] = array(
			'name'  => 'description',
			'id'    => 'description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('description'),
			'placeholder'=> $this->lang->line('create_group_validation_desc_label'),
			'class'	=> 'form-control'
		);

		$this->dashboard_admin('admin/create_group', $this->data);
	}
}

public function list_groups()
{
	$this->data['title'] = $this->lang->line('create_group_validation_name_label');

	// set the flash data error message if there is one
	$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
	//list the Groups
	$this->data['groups'] = $this->ion_auth->groups()->result();

	$this->dashboard_admin('admin/list_groups', $this->data);
}

/**
* Edit a group
* @param int|string $id
*/
public function edit_group($id)
{
	// bail if no group id given
	if (!$id || empty($id))
	{
		redirect('dashboard', 'refresh');
	}

	$this->data['title'] = $this->lang->line('edit_group_title');

	if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
	{
		redirect('auth', 'refresh');
	}

	$group = $this->ion_auth->group($id)->row();

	// validate form input
	$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

	if (isset($_POST) && !empty($_POST))
	{
		if ($this->form_validation->run() === TRUE)
		{
			$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

			if ($group_update)
			{
				$this->session->set_flashdata('message', $this->ion_auth->messages());
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
			}
			redirect('admin/list_groups');
		}
	}

	// set the flash data error message if there is one
	$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

	// pass the user to the view
	$this->data['group'] = $group;

	$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';
	$readonly1 = $this->config->item('default_group', 'ion_auth') === $group->name ? 'readonly' : '';
	$this->data['group_name'] = array(
		'name'		=> 'group_name',
		'id'		=> 'group_name',
		'type'		=> 'text',
		'value'		=> $this->form_validation->set_value('group_name', $group->name),
		$readonly 	=> $readonly,
		$readonly1	=> $readonly1,
		'class'		=> 'form-control'
	);
	$this->data['group_description'] = array(
		'name'  => 'group_description',
		'id'    => 'group_description',
		'type'  => 'text',
		'value' => $this->form_validation->set_value('group_description', $group->description),
		'class'	=> 'form-control'
	);

	$this->dashboard_admin('admin/edit_group', $this->data);
}

/* DELETE GROUPS */
public function delete_group($id)
{
	if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
	{
		// redirect them to the home page because they must be an administrator to view this
		return show_error('You must be an administrator to view this page.');
	}

	$id = (int)$id;

	$this->load->library('form_validation');
	$this->form_validation->set_rules('confirm', $this->lang->line('delete_group_validation_confirm_label'), 'required');
	$this->form_validation->set_rules('id', $this->lang->line('delete_group_validation_user_id_label'), 'required|alpha_numeric');

	if ($this->form_validation->run() === FALSE)
	{
		// insert csrf check
		$this->data['csrf'] = $this->_get_csrf_nonce();
		$this->data['group'] = $this->ion_auth->group($id)->row();

		$this->load->view('admin/delete_group', $this->data);
	}
	if (isset($_POST) && !empty($_POST))
	{
		// do we really want to delete?
		//if ($this->input->post('confirm') == 'yes'){
		// do we have the right userlevel?
		//if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
		//{
		$this->ion_auth->delete_group($id);
		//}
		//}

		$this->session->set_flashdata('message', $this->ion_auth->messages());
		// redirect them back to the auth page
		redirect('admin/list_groups');
	}
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
		$this->data['message'] = (validation_errors()) ?
		'<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-ban"></i> Alert !</h4>' . validation_errors() . '</div>' : $this->session->flashdata('message');

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
		$this->dashboard_admin('admin/change_password', $this->data);
	}
	else
	{
		$identity = $this->session->userdata('identity');

		$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

		if ($change)
		{
			//if the password was successfully changed
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('admin/change_password', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect('dashboard', 'refresh');
		}
	}
}
}
