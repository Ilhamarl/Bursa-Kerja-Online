<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Depnaker extends Public_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('catagory_job_model');
			$this->data['katagori'] = $this->catagory_job_model->users()->result();
			foreach ($this->data['katagori'] as $k => $user)
			{
				$this->data['katagori'][$k]->groups = $this->catagory_job_model->get_users_groups($user->id)->result();
			}
		}

		public function index()
		{
			$this->data['title'] = 'Lowongan Depnaker';
			if ($this->ion_auth->is_admin())
			{
				$this->dashboard_admin('depnaker', $this->data);
			}
			else if ($this->ion_auth->is_user())
			{
				$this->dashboard_user('depnaker', $this->data);
			}
			else
			{
				$this->load->top_nav('depnaker', $this->data);
			}
		}

		public function yogyakarta()
		{
			$this->data['title'] = 'Lowongan Depnaker wilayah Yogyakarta';

			if ($this->ion_auth->is_admin())
			{
				$this->dashboard_admin('depnaker_jogja', $this->data);
			}
			else if ($this->ion_auth->is_user())
			{
				$this->dashboard_user('depnaker_jogja', $this->data);
			}
			else
			{
				$this->load->top_nav('depnaker_jogja', $this->data);
			}
		}
	}
