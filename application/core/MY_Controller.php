<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class MY_Controller extends CI_Controller
	{
		public $data = [];

		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->model(array('ion_auth_model','catagory_job_model'));
			$this->load->library(array('session','ion_auth','form_validation'));
			$this->load->helper(array('url','language','form'));
			$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
			$this->lang->load('auth');
			$this->lang->load('ion_auth');

			if($this->session->userdata('logged_in')!= FALSE)
			{
				$this->load->helper('url');
				$this->session->set_userdata('last_page', current_url());
				redirect('auth','refresh');
			}
		}

		public function redirectUser()
		{
			if ($this->ion_auth->is_admin())
			{
				redirect('dashboard', 'refresh');
			}
			redirect('/', 'refresh');
		}

		/** @return array A CSRF key-value pair
		*/
		public function _get_csrf_nonce()
		{
			$this->load->helper('string');
			$key 	= random_string('alnum', 8);
			$value	= random_string('alnum', 20);
			$this->session->set_flashdata('csrfkey', $key);
			$this->session->set_flashdata('csrfvalue', $value);
			return array($key => $value);
		}

		/**@return bool Whether the posted CSRF token matches
		*/
		public function _valid_csrf_nonce()
		{
			$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
			if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue'))
			{
				if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue'))
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
		}
		/** Load View
		*/
		public function _render_page($view, $data = NULL, $returnhtml = FALSE)//I think this makes more sense
		{

			$this->viewdata = (empty($data)) ? $this->data : $data;

			$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

			// This will return html on 3rd argument being true
			if ($returnhtml)
			{
				return $view_html;
			}
		}

		public function dashboard_admin($view, $data = NULL, $returnhtml = FALSE)//I think this makes more sense
		{

			$this->viewdata = (empty($data)) ? $this->data : $data;

			$view_html = $this->load->admin_template($view, $this->viewdata, $returnhtml);

			// This will return html on 3rd argument being true
			if ($returnhtml)
			{
				return $view_html;
			}
		}

		public function login_render($view, $data = NULL, $returnhtml = FALSE)//I think this makes more sense
		{

			$this->viewdata = (empty($data)) ? $this->data : $data;

			$view_html = $this->load->login_template($view, $this->viewdata, $returnhtml);

			// This will return html on 3rd argument being true
			if ($returnhtml)
			{
				return $view_html;
			}
		}

		public function dashboard_user($view, $data = NULL, $returnhtml = FALSE)//I think this makes more sense
		{

			$this->viewdata = (empty($data)) ? $this->data : $data;

			$view_html = $this->load->user_template($view, $this->viewdata, $returnhtml);

			// This will return html on 3rd argument being true
			if ($returnhtml)
			{
				return $view_html;
			}
		}

	}

	class Admin_Controller extends MY_Controller
	{
		public function __construct()
		{
			parent::__construct();

			// Users and Admin
			$this->data['users'] = $this->ion_auth->user()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

		}
	}

	class Public_Controller extends MY_Controller
	{
		public function __construct()
		{
			parent::__construct();

				//list the users ALL
				$this->data['users'] = $this->ion_auth->user()->result();
				foreach ($this->data['users'] as $k => $user)
				{
					$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
				}
		}
	}
