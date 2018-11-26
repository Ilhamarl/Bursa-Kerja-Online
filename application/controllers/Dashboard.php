<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends MY_Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->data['title'] = 'Home';
			if (!$this->ion_auth->logged_in())
			{
				// redirect them to the login page
				redirect('jobs', 'refresh');
			}
		}

		public function index()
		{
			//(!$this->ion_auth->is_admin()) --- tanda " ! " berarti bukan is_admin
			if ($this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
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
			else if ($this->ion_auth->is_user())
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
			else
			{
				$this->load->top_nav('jobs', $this->data);
			}
		}
	}
