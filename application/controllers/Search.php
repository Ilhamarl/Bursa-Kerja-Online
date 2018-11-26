<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Search Extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Load model
		$this->load->model('job_industry_model');
		$this->load->model('search_model');
		$this->load->library(array('session','job_industry','form_validation','pagination'));
		$this->load->helper(array('url','language','form','time_helper','text'));

		$data['industries'] = $this->job_industry_model->groups()->result();

		$this->load->model('catagory_job_model');
		$data['katagori'] = $this->catagory_job_model->users()->result();
		foreach ($data['katagori'] as $k => $user)
		{
			$data['katagori'][$k]->groups = $this->catagory_job_model->get_users_groups($user->id)->result();
		}

	}

	public function index()
	{
		$keyword			=   $this->input->post('keyword');
		$data['users']		=   $this->search_model->search($keyword);
		$data['title'] 		= 'Hasil Pencarian';
		$data['industries'] = $this->job_industry_model->groups()->result();

		$data['katagori'] = $this->catagory_job_model->users()->result();
		foreach ($data['katagori'] as $k => $user)
		{
			$data['katagori'][$k]->groups = $this->catagory_job_model->get_users_groups($user->id)->result();
		}

		if ($this->ion_auth->is_admin())
		{
			$this->dashboard_admin('result_view',$data);
		}
		elseif ($this->ion_auth->is_user())
		{
			$this->dashboard_user('result_view',$data);
		}
		else
		{
			$this->load->top_nav('result_view',$data);
		}
	}

	public function catagory()
	{
		$keyword					=   $this->input->post('keyword');
		$data['users']		=   $this->search_model->catagory($keyword);
		$data['title'] 		= 'Hasil Pencarian';
		$data['industries'] = $this->job_industry_model->groups()->result();

		$data['katagori'] = $this->catagory_job_model->users()->result();
		foreach ($data['katagori'] as $k => $user)
		{
			$data['katagori'][$k]->groups = $this->catagory_job_model->get_users_groups($user->id)->result();
		}

		if ($this->ion_auth->is_admin())
		{
			$this->dashboard_admin('result_view',$data);
		}
		elseif ($this->ion_auth->is_user())
		{
			$this->dashboard_user('result_view',$data);
		}
		else
		{
			$this->load->top_nav('result_view',$data);
		}
	}
}
