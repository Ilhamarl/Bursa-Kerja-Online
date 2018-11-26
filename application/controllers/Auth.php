<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

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
			redirect('dashboard', 'refresh');
		}
	}

	public function login()
	{
		$this->data['title'] = $this->lang->line('login_heading');

		// validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() === TRUE)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool)$this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('dashboard', 'refresh');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? '<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-ban"></i> Alert !</h4>' . validation_errors() . '</div>' : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
			'name'			=> 'identity',
			'id'			=> 'identity',
			'type'			=> 'email',
			'value'			=> $this->form_validation->set_value('identity'),
			'class'			=> 'form-control',
			'placeholder'	=> $this->lang->line('login_identity_label')
		);
		$this->data['password'] = array('name' => 'password',
		'name'			=> 'password',
		'id' 			=> 'password',
		'type'			=> 'password',
		'class'			=> 'form-control',
		'placeholder'	=> $this->lang->line('login_password_label')
	);
	$this->load->login_template('auth/login', $this->data);
}
}

public function logout()
{
	// log the user out
	$logout = $this->ion_auth->logout();
	// redirect them to the login page
	$this->session->set_flashdata('message', $this->ion_auth->messages());
	redirect('Jobs', 'refresh');
}

public function register_user()
{
	$tables = $this->config->item('tables', 'ion_auth');
	$identity_column = $this->config->item('identity', 'ion_auth');
	$this->data['identity_column'] = $identity_column;

	// validate form input
	$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required');
	$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'trim|required');

	if ($identity_column !== 'email')
	{
		$this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
	}
	else
	{
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
	}

	$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
	$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

	if ($this->form_validation->run() === TRUE)
	{
		$email = strtolower($this->input->post('email'));
		$identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
		$password = $this->input->post('password');

		$additional_data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
		);
	}
	if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data))
	{
		// check to see if we are creating the user
		// redirect them back to the admin page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect("auth/login", 'refresh');
	}
	else
	{
		// display the create user form
		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? '<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-ban"></i> Alert !</h4>' . validation_errors() . '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		$this->data['first_name'] = array(
			'name' => 'first_name',
			'id' => 'first_name',
			'type' => 'text',
			'value' => $this->form_validation->set_value('first_name'),
			'class'			=> 'form-control',
			'placeholder'	=> $this->lang->line('create_user_validation_fname_label')
		);
		$this->data['last_name'] = array(
			'name' => 'last_name',
			'id' => 'last_name',
			'type' => 'text',
			'value' => $this->form_validation->set_value('last_name'),
			'class'			=> 'form-control',
			'placeholder'	=> $this->lang->line('create_user_validation_lname_label')
		);
		$this->data['identity'] = array(
			'name' => 'identity',
			'id' => 'identity',
			'type' => 'text',
			'value' => $this->form_validation->set_value('identity'),
			'class'		=> 'form-control',
			'placeholder'	=> $this->lang->line('create_user_validation_identity_label')
		);
		$this->data['email'] = array(
			'name' => 'email',
			'id' => 'email',
			'type' => 'email',
			'value' => $this->form_validation->set_value('email'),
			'class'		=> 'form-control',
			'placeholder'	=> $this->lang->line('create_user_validation_email_label')
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id' => 'password',
			'type' => 'password',
			'value' => $this->form_validation->set_value('password'),
			'class'			=> 'form-control',
			'placeholder'	=> $this->lang->line('create_user_validation_password_label')
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id' => 'password_confirm',
			'type' => 'password',
			'value' => $this->form_validation->set_value('password_confirm'),
			'class'			=> 'form-control',
			'placeholder'	=> $this->lang->line('create_user_validation_password_confirm_label')
		);

		$this->login_render('auth/registration', $this->data);
	}
}
}
