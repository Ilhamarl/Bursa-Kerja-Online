<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class job_industry
{
	/**
	 * account status ('not_activated', etc ...)
	 *
	 * @var string
	 **/
	protected $status;

	public $_extra_where = array();
	
	public $_extra_set = array();
	
	public $_cache_user_in_group;
	
	public function __construct()
	{
		$this->config->load('job_industry', TRUE);
		$this->load->library(array('email'));
		$this->lang->load('job_industry');
		$this->load->helper(array('cookie','language','url'));

		$this->load->library('session');

		$this->load->model('job_industry_model');

		$this->_cache_user_in_group =& $this->job_industry_model->_cache_user_in_group;

		$email_config = $this->config->item('email_config', 'job_industry');

		if ($this->config->item('use_ci_email', 'job_industry') && isset($email_config) && is_array($email_config))
		{
			$this->email->initialize($email_config);
		}

		$this->job_industry_model->trigger_events('library_constructor');
	}

	/**
	 * __call
	 *
	 * Acts as a simple way to call model methods without loads of stupid alias'
	 *
	 * @param $method
	 * @param $arguments
	 * @return mixed
	 * @throws Exception
	 */
	public function __call($method, $arguments)
	{
		if (!method_exists( $this->job_industry_model, $method) )
		{
			throw new Exception('Undefined method job_industry::' . $method . '() called');
		}
		if($method == 'create_user')
		{
			return call_user_func_array(array($this, 'register'), $arguments);
		}
		if($method=='update_user')
		{
			return call_user_func_array(array($this, 'update'), $arguments);
		}
		return call_user_func_array(array($this->job_industry_model, $method), $arguments);
	}

	/**
	 * __get
	 *
	 * Enables the use of CI super-global without having to define an extra variable.
	 *
	 * I can't remember where I first saw this, so thank you if you are the original author. -Militis
	 *
	 * @access	public
	 * @param	$var
	 * @return	mixed
	 */
	public function __get($var)
	{
		return get_instance()->$var;
	}

	/**register
	 *
	 * @param $identity
	 * @param $password
	 * @param $email
	 * @param array $additional_data
	 * @param array $group_ids
	 * @author Mathew
	 * @return bool
	 */
	 /*
	public function register($identity, $password, $email, $additional_data = array(), $group_ids = array()) //need to test email activation
	{
		$this->job_industry_model->trigger_events('pre_account_creation');

		$email_activation = $this->config->item('email_activation', 'job_industry');

		$id = $this->job_industry_model->register($identity, $password, $email, $additional_data, $group_ids);

		if (!$email_activation)
		{
			if ($id !== FALSE)
			{
				$this->set_message('account_creation_successful');
				$this->job_industry_model->trigger_events(array('post_account_creation', 'post_account_creation_successful'));
				return $id;
			}
			else
			{
				$this->set_error('account_creation_unsuccessful');
				$this->job_industry_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
				return FALSE;
			}
		}
		else
		{
			if (!$id)
			{
				$this->set_error('account_creation_unsuccessful');
				return FALSE;
			}

			// deactivate so the user much follow the activation flow
			$deactivate = $this->job_industry_model->deactivate($id);

			// the deactivate method call adds a message, here we need to clear that
			$this->job_industry_model->clear_messages();


			if (!$deactivate)
			{
				$this->set_error('deactivate_unsuccessful');
				$this->job_industry_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
				return FALSE;
			}

			$activation_code = $this->job_industry_model->activation_code;
			$identity        = $this->config->item('identity', 'job_industry');
			$user            = $this->job_industry_model->user($id)->row();

			$data = array(
				'identity'   => $user->{$identity},
				'id'         => $user->id,
				'email'      => $email,
				'activation' => $activation_code,
			);
			if(!$this->config->item('use_ci_email', 'job_industry'))
			{
				$this->job_industry_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
				$this->set_message('activation_email_successful');
				return $data;
			}
			else
			{
				$message = $this->load->view($this->config->item('email_templates', 'job_industry').$this->config->item('email_activate', 'job_industry'), $data, true);

				$this->email->clear();
				$this->email->from($this->config->item('admin_email', 'job_industry'), $this->config->item('site_title', 'job_industry'));
				$this->email->to($email);
				$this->email->subject($this->config->item('site_title', 'job_industry') . ' - ' . $this->lang->line('email_activation_subject'));
				$this->email->message($message);

				if ($this->email->send() == TRUE)
				{
					$this->job_industry_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
					$this->set_message('activation_email_successful');
					return $id;
				}

			}

			$this->job_industry_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful', 'activation_email_unsuccessful'));
			$this->set_error('activation_email_unsuccessful');
			return FALSE;
		}
	}
	
	/**
	 * logout
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function logout()
	{
		$this->job_industry_model->trigger_events('logout');

		$identity = $this->config->item('identity', 'job_industry');

                if (substr(CI_VERSION, 0, 1) == '2')
		{
			$this->session->unset_userdata( array($identity => '', 'id' => '', 'user_id' => '') );
                }
                else
                {
                	$this->session->unset_userdata( array($identity, 'id', 'user_id') );
                }

		// delete the remember me cookies if they exist
		if (get_cookie($this->config->item('identity_cookie_name', 'job_industry')))
		{
			delete_cookie($this->config->item('identity_cookie_name', 'job_industry'));
		}
		if (get_cookie($this->config->item('remember_cookie_name', 'job_industry')))
		{
			delete_cookie($this->config->item('remember_cookie_name', 'job_industry'));
		}

		// Destroy the session
		$this->session->sess_destroy();

		//Recreate the session
		if (substr(CI_VERSION, 0, 1) == '2')
		{
			$this->session->sess_create();
		}
		else
		{
			if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
				session_start();
			}
			$this->session->sess_regenerate(TRUE);
		}

		$this->set_message('logout_successful');
		return TRUE;
	}

	/**
	 * logged_in
	 *
	 * @return bool
	 * @author Mathew
	 **/
	public function logged_in()
	{
		$this->job_industry_model->trigger_events('logged_in');

        return $this->job_industry_model->recheck_session();
	}

	/**
	 * logged_in
	 *
	 * @return integer
	 * @author jrmadsen67
	 **/
	public function get_user_id()
	{
		$user_id = $this->session->userdata('user_id');
		if (!empty($user_id))
		{
			return $user_id;
		}
		return null;
	}


	/**
	 * is_admin
	 *
	 * @return bool
	 * @author Ben Edmunds
	 **/
	public function is_admin($id = FALSE)
	{
		$this->job_industry_model->trigger_events('is_admin');

		$admin_group = $this->config->item('admin_group', 'job_industry');

		return $this->in_group($admin_group, $id);
	}

	/**in_group
	 *
	 * @param mixed group(s) to check
	 * @param bool user id
	 * @param bool check if all groups is present, or any of the groups
	 *
	 * @return bool
	 * @author Phil Sturgeon
	 **/
	public function in_group($check_group, $id=false, $check_all = false)
	{
		$this->job_industry_model->trigger_events('in_group');

		$id || $id = $this->session->userdata('user_id');

		if (!is_array($check_group))
		{
			$check_group = array($check_group);
		}

		if (isset($this->_cache_user_in_group[$id]))
		{
			$groups_array = $this->_cache_user_in_group[$id];
		}
		else
		{
			$users_groups = $this->job_industry_model->get_users_groups($id)->result();
			$groups_array = array();
			foreach ($users_groups as $group)
			{
				$groups_array[$group->id] = $group->name;
			}
			$this->_cache_user_in_group[$id] = $groups_array;
		}
		foreach ($check_group as $key => $value)
		{
			$groups = (is_string($value)) ? $groups_array : array_keys($groups_array);

			/**
			 * if !all (default), in_array
			 * if all, !in_array
			 */
			if (in_array($value, $groups) xor $check_all)
			{
				/**
				 * if !all (default), true
				 * if all, false
				 */
				return !$check_all;
			}
		}

		/**
		 * if !all (default), false
		 * if all, true
		 */
		return $check_all;
	}
	
	public function in_catagory($check_catagory, $id=false, $check_all = false)
	{
		$this->job_industry_model->trigger_events('in_catagory');

		//$id || $id = $this->session->userdata('user_id');

		if (!is_array($check_catagory))
		{
			$check_catagory = array($check_catagory);
		}

		if (isset($this->_cache_user_in_catagory[$id]))
		{
			$catagories_array = $this->_cache_user_in_catagory[$id];
		}
		else
		{
			$users_catagories = $this->job_industry_model->get_users_catagories($id)->result();
			$catagories_array = array();
			foreach ($users_catagories as $catagory)
			{
				$catagories_array[$catagory->id] = $catagory->name;
			}
			$this->_cache_user_in_catagory[$id] = $catagories_array;
		}
		foreach ($check_catagory as $key => $value)
		{
			$catagories = (is_string($value)) ? $catagories_array : array_keys($catagories_array);

			/**
			 * if !all (default), in_array
			 * if all, !in_array
			 */
			if (in_array($value, $catagories) xor $check_all)
			{
				/**
				 * if !all (default), true
				 * if all, false
				 */
				return !$check_all;
			}
		}

		/**
		 * if !all (default), false
		 * if all, true
		 */
		return $check_all;
	}
}