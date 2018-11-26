<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_industry_model extends CI_Model
{
	public $tables = array();

	public $identity;

	public $_job_where = array();

	public $_job_select = array();

	public $_job_like = array();

	public $_job_limit = NULL;

	public $_job_offset = NULL;

	public $_job_order_by = NULL;

	public $_job_order = NULL;

	protected $_job_hooks;

	protected $response = NULL;

	protected $messages;

	protected $errors;

	protected $error_start_delimiter;

	protected $error_end_delimiter;

	public $_cache_user_in_group = array();

	protected $_cache_groups = array();

	public $_cache_user_in_catagory = array();

	protected $_cache_catagories = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->config->load('job_industry', TRUE);
		$this->load->helper(array('cookie','date'));
		//$this->load->helper('date');

		$this->lang->load('job_industry');

		// initialize db tables data
		$this->tables  			= $this->config->item('tables','job_industry');
		$this->identity_column	= $this->config->item('identity','job_industry');
		$this->store_salt		= $this->config->item('store_salt','job_industry');
		$this->salt_length		= $this->config->item('salt_length','job_industry');
		$this->join				= $this->config->item('join', 'job_industry');

		// initialize messages and error
		$this->messages    		= array();
		$this->errors      		= array();
		$delimiters_source 		= $this->config->item('delimiters_source', 'job_industry');

		// load the error delimeters either from the config file or use what's been supplied to form validation
		if ($delimiters_source === 'form_validation')
		{
			// load in delimiters from form_validation to keep this simple we'll load the value using reflection since these properties are protected
			$this->load->library('form_validation');
			$form_validation_class = new ReflectionClass("CI_Form_validation");

			$error_prefix = $form_validation_class->getProperty("_error_prefix");
			$error_prefix->setAccessible(TRUE);
			$this->error_start_delimiter = $error_prefix->getValue($this->form_validation);

			$this->message_start_delimiter = $this->error_start_delimiter;
			$error_suffix = $form_validation_class->getProperty("_error_suffix");
			$error_suffix->setAccessible(TRUE);
			$this->error_end_delimiter = $error_suffix->getValue($this->form_validation);
			$this->message_end_delimiter = $this->error_end_delimiter;
		}
		else
		{
			// use delimiters from config
			$this->message_start_delimiter = $this->config->item('message_start_delimiter', 'job_industry');
			$this->message_end_delimiter   = $this->config->item('message_end_delimiter', 'job_industry');
			$this->error_start_delimiter   = $this->config->item('error_start_delimiter', 'job_industry');
			$this->error_end_delimiter     = $this->config->item('error_end_delimiter', 'job_industry');
		}

		// initialize our hooks object
		$this->_job_hooks = new stdClass;


		$this->trigger_events('model_constructor');
	}


	//-----------------------------------------------------------------------

	public function get_catagories_users($id)
	{
		//$id || $id = $this->session->userdata('lowongan_id');
		return $this->db->select($this->tables['katagori']. '.name,' .$this->tables['katagori']. '.description,'.$this->tables['lowongan'].'.name')
		->from($this->tables['katagori'])
		->join($this->tables['lowongan_katagori'], $this->tables['katagori'].'.id'.'='.$this->tables['lowongan_katagori']. '.' .$this->join['katagori'])
		->join($this->tables['lowongan'], $this->tables['lowongan_katagori'].'.'.$this->join['lowongan'].'='.$this->tables['lowongan'].'.id')
		->where($this->tables['katagori'], $id)
		->get($this->tables['lowongan']);
	}

	//------------------------------------------------------------------------
	public function get_users_catagories($id=FALSE)
	{
		$this->trigger_events('get_users_catagory');

		//$id || $id = $this->session->userdata('lowongan_id');

		return $this->db->select($this->tables['lowongan_katagori'].'.'

		.$this->join['katagori'].' as id,'.

		$this->tables['katagori'].'.name,'.
		$this->tables['katagori'].'.description')

		->where($this->tables['lowongan_katagori'].'.'.$this->join['lowongan'], $id)
		->join($this->tables['katagori'], $this->tables['lowongan_katagori'].'.'.$this->join['katagori'].'='.$this->tables['katagori'].'.id')
		->get($this->tables['lowongan_katagori']);
	}

	public function add_to_catagory($catagory_ids, $user_id=false)
	{

		// if no id was passed use the current users id
		$user_id || $user_id = $this->session->userdata('lowongan_id');

		if(!is_array($catagory_ids))
		{
			$catagory_ids = array($catagory_ids);
		}
		$return = 0;

		// Then insert each into the database
		foreach ($catagory_ids as $catagory_id)
		{
			if ($this->db->insert($this->tables['lowongan_katagori'], array($this->join['katagori'] => (float)$catagory_id, $this->join['lowongan'] => (float)$user_id)))
			{
				if (isset($this->_cache_catagories[$catagory_id]))
				{
					$catagory_name = $this->_cache_catagories[$catagory_id];
				}
				else
				{
					$catagory = $this->catagory($catagory_id)->result();
					$catagory_name = $catagory[0]->name;
					$this->_cache_catagories[$catagory_id] = $catagory_name;
				}
				$this->_cache_user_in_catagory[$user_id][$catagory_id] = $catagory_name;

				// Return the number of catagories added
				$return += 1;
			}
		}

		return $return;
	}


	public function remove_from_catagory($catagory_ids=false, $user_id=false)
	{
		$this->trigger_events('remove_from_catagory');

		// user id is required
		if(empty($user_id))
		{
			return FALSE;
		}

		// if catagory id(s) are passed remove user from the catagory(s)
		if( ! empty($catagory_ids))
		{
			if(!is_array($catagory_ids))
			{
				$catagory_ids = array($catagory_ids);
			}

			foreach($catagory_ids as $catagory_id)
			{
				$this->db->delete($this->tables['lowongan_katagori'], array($this->join['katagori'] => (float)$catagory_id, $this->join['lowongan'] => (float)$user_id));
				if (isset($this->_cache_user_in_catagory[$user_id]) && isset($this->_cache_user_in_catagory[$user_id][$catagory_id]))
				{
					unset($this->_cache_user_in_catagory[$user_id][$catagory_id]);
				}
			}

			$return = TRUE;
		}
		// otherwise remove user from all catagories
		else
		{
			if ($return = $this->db->delete($this->tables['lowongan_katagori'], array($this->join['lowongan'] => (float)$user_id))) {
				$this->_cache_user_in_catagory[$user_id] = array();
			}
		}
		return $return;
	}

	// -------- MY CONFIG ----------------------------------------------------

	public function catagories()
	{
		// run each where that was passed
		if (isset($this->_job_where) && !empty($this->_job_where))
		{
			foreach ($this->_job_where as $where)
			{
				$this->db->where($where);
			}
			$this->_job_where = array();
		}

		if (isset($this->_job_limit) && isset($this->_job_offset))
		{
			$this->db->limit($this->_job_limit, $this->_job_offset);

			$this->_job_limit  = NULL;
			$this->_job_offset = NULL;
		}
		else if (isset($this->_job_limit))
		{
			$this->db->limit($this->_job_limit);

			$this->_job_limit  = NULL;
		}

		// set the order
		if (isset($this->_job_order_by) && isset($this->_job_order))
		{
			$this->db->order_by($this->_job_order_by, $this->_job_order);
		}

		$this->response = $this->db->order_by('id', 'desc')->get($this->tables['katagori']);

		return $this;
	}


	public function catagory($id = NULL)
	{
		$this->trigger_events('catagory');

		if (isset($id))
		{
			$this->where($this->tables['katagori'].'.id', $id);
		}

		$this->limit(1);
		$this->order_by('id', 'desc');

		return $this->catagories();
	}


	/** create_catagory
	* @author aditya menon
	*/
	public function create_catagory($catagory_name = FALSE, $catagory_description = '', $additional_data = array())
	{
		// bail if the catagory name already exists
		$existing_catagory = $this->db->get_where($this->tables['katagori'], array('name' => $catagory_name))->num_rows();
		if($existing_catagory !== 0)
		{
			$this->set_error('catagory_already_exists');
			return FALSE;
		}

		$data = array
		(
			'name'=>$catagory_name,
			'description'=>$catagory_description
		);

		// Filter out any data passed that doesnt have a matching column in the catagories table And merge the set catagory data and the additional data
		if (!empty($additional_data)) $data = array_merge($this->_filter_data($this->tables['katagori'], $additional_data), $data);

		$this->trigger_events('extra_catagory_set');

		// insert the new catagory
		$this->db->insert($this->tables['katagori'], $data);
		$catagory_id = $this->db->insert_id();

		// report success
		$this->set_message('industry_creation_successful');
		// return the brand new catagory id
		return $catagory_id;
	}

	/** update_catagory
	* @return bool
	* @author aditya menon
	**/
	public function update_catagory($catagory_id = FALSE, $catagory_name = FALSE, $additional_data = array())
	{
		if (empty($catagory_id))
		{
			return FALSE;
		}

		$data = array();

		if (!empty($catagory_name))
		{
			// we are changing the name, so do some checks / bail if the catagory name already exists
			$existing_catagory = $this->db->get_where($this->tables['katagori'], array('name' => $catagory_name))->row();
			if(isset($existing_catagory->id) && $existing_catagory->id != $catagory_id)
			{
				$this->set_error('catagory_already_exists');
				return FALSE;
			}

			$data['name'] = $catagory_name;
		}

		// restrict change of name of the admin catagory
		$catagory = $this->db->get_where($this->tables['katagori'], array('id' => $catagory_id))->row();
		if($this->config->item('admin_catagory', 'job_industry') === $catagory->name && $catagory_name !== $catagory->name)
		{
			$this->set_error('industry_name_admin_not_alter');
			return FALSE;
		}


		// IMPORTANT!! Third parameter was string type $description; this following code is to maintain backward compatibility
		// New projects should work with 3rd param as array
		if (is_string($additional_data))
		{
			$additional_data = array('description' => $additional_data);
		}

		// filter out any data passed that doesnt have a matching column in the catagories table
		// and merge the set catagory data and the additional data
		if (!empty($additional_data))
		{
			$data = array_merge($this->_filter_data($this->tables['katagori'], $additional_data), $data);
		}

		$this->db->update($this->tables['katagori'], $data, array('id' => $catagory_id));

		$this->set_message('industry_update_successful');

		return TRUE;
	}

	/** delete_catagory
	* @return bool
	* @author aditya menon
	**/
	public function delete_catagory($catagory_id = FALSE)
	{
		// bail if mandatory param not set
		if(!$catagory_id || empty($catagory_id))
		{
			return FALSE;
		}
		$catagory = $this->catagory($catagory_id)->row();
		if($catagory->name == $this->config->item('admin_catagory', 'job_industry'))
		{
			$this->trigger_events(array('post_delete_catagory', 'post_delete_catagory_notallowed'));
			$this->set_error('catagory_delete_notallowed');
			return FALSE;
		}

		$this->trigger_events('pre_delete_catagory');

		$this->db->trans_begin();

		// remove all users from this catagory
		$this->db->delete($this->tables['lowongan_katagori'], array($this->join['katagori'] => $catagory_id));
		// remove the catagory itself
		$this->db->delete($this->tables['katagori'], array('id' => $catagory_id));

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->trigger_events(array('post_delete_catagory', 'post_delete_catagory_unsuccessful'));
			$this->set_error('catagory_delete_unsuccessful');
			return FALSE;
		}

		$this->db->trans_commit();

		$this->trigger_events(array('post_delete_catagory', 'post_delete_catagory_successful'));
		$this->set_message('catagory_delete_successful');
		return TRUE;
	}


	//-------- ACTIVATE & DEACTIVATE  -----------------------------------------
	public function activate($id, $code = false)
	{
		$this->trigger_events('pre_activate');

		if ($code !== FALSE)
		{
			$query = $this->db->select($this->identity_column)
			->where('activation_code', $code)
			->where('id', $id)
			->limit(1)
			->order_by('id', 'desc')
			->get($this->tables['lowongan']);

			$result = $query->row();

			if ($query->num_rows() !== 1)
			{
				$this->trigger_events(array('post_activate', 'post_activate_unsuccessful'));
				$this->set_error('activate_unsuccessful');
				return FALSE;
			}

			$data = array(
				'active'          => 1
			);

			$this->trigger_events('extra_where');
			$this->db->update($this->tables['lowongan'], $data, array('id' => $id));
		}
		else
		{
			$data = array(
				'active'          => 1
			);


			$this->trigger_events('extra_where');
			$this->db->update($this->tables['lowongan'], $data, array('id' => $id));
		}


		$return = $this->db->affected_rows() == 1;
		if ($return)
		{
			$this->trigger_events(array('post_activate', 'post_activate_successful'));
			$this->set_message('activate_successful');
		}
		else
		{
			$this->trigger_events(array('post_activate', 'post_activate_unsuccessful'));
			$this->set_error('activate_unsuccessful');
		}
		return $return;
	}

	public function deactivate($id)
	{
		$this->trigger_events('deactivate');

		if (!isset($id))
		{
			$this->set_error('deactivate_unsuccessful');
			return FALSE;
		}

		$activation_code       = sha1(md5(microtime()));
		$this->activation_code = $activation_code;

		$data = array(
			'activation_code' => $activation_code,
			'active'          => 0
		);

		$this->trigger_events('extra_where');
		$this->db->update($this->tables['lowongan'], $data, array('id' => $id));

		$return = $this->db->affected_rows() == 1;
		if ($return)
		$this->set_message('deactivate_successful');
		else
		$this->set_error('deactivate_unsuccessful');

		return $return;
	}

	//--------------------------------------------------------------------------


	//------- USERS / LOWONGAN -------------------------------------------

	public function users($groups = NULL, $catagories = NULL)
	{
		$this->trigger_events('lowongan');

		if (isset($this->_job_select) && !empty($this->_job_select))
		{
			foreach ($this->_job_select as $select)
			{
				$this->db->select($select);
			}

			$this->_job_select = array();
		}
		else
		{
			//default selects
			$this->db->select(array(
				$this->tables['lowongan'].'.*',
				$this->tables['lowongan'].'.id as id',
				$this->tables['lowongan'].'.id as lowongan_id'
			));
		}

		// filter by group id(s) if passed
		if (isset($groups))
		{
			// build an array if only one group was passed
			if (!is_array($groups))
			{
				$groups = Array($groups);
			}

			// join and then run a where_in against the group ids
			if (isset($groups) && !empty($groups))
			{
				$this->db->distinct();
				$this->db->join(
					$this->tables['lowongan_industri'],
					$this->tables['lowongan_industri'].'.'.$this->join['lowongan'].'='.$this->tables['lowongan'].'.id',
					'inner'
				);
			}

			// verify if group name or group id was used and create and put elements in different arrays
			$group_ids = array();
			$group_names = array();
			foreach($groups as $group)
			{
				if(is_numeric($group)) $group_ids[] = $group;
				else $group_names[] = $group;
			}
			$or_where_in = (!empty($group_ids) && !empty($group_names)) ? 'or_where_in' : 'where_in';
			// if group name was used we do one more join with groups
			if(!empty($group_names))
			{
				$this->db->join($this->tables['industri'], $this->tables['lowongan_industri'] . '.' . $this->join['industri'] . ' = ' . $this->tables['industri'] . '.id', 'inner');
				$this->db->where_in($this->tables['industri'] . '.name', $group_names);
			}
			if(!empty($group_ids))
			{
				$this->db->{$or_where_in}($this->tables['lowongan_industri'].'.'.$this->join['industri'], $group_ids);
			}
		}

		if (isset($catagories))
		{
			// build an array if only one group was passed
			if (!is_array($catagories))
			{
				$catagories = Array($catagories);
			}

			// join and then run a where_in against the group ids
			if (isset($catagories) && !empty($catagories))
			{
				$this->db->distinct();
				$this->db->join(
					$this->tables['lowongan_katagori'],
					$this->tables['lowongan_katagori'].'.'.$this->join['lowongan'].'='.$this->tables['lowongan'].'.id',
					'inner'
				);
			}

			// verify if group name or group id was used and create and put elements in different arrays
			$catagories_ids = array();
			$catagories_names = array();
			foreach($catagories as $catagory)
			{
				if(is_numeric($catagory)) $catagory_ids[] = $catagory;
				else $group_names[] = $group;
			}
			$or_where_in = (!empty($catagory_ids) && !empty($catagory_names)) ? 'or_where_in' : 'where_in';
			// if group name was used we do one more join with groups
			if(!empty($catagory_names))
			{
				$this->db->join($this->tables['katagori'], $this->tables['lowongan_katagori'] . '.' . $this->join['katagori'] . ' = ' . $this->tables['katagori'] . '.id', 'inner');
				$this->db->where_in($this->tables['katagori'] . '.name', $catagory_names);
			}
			if(!empty($catagory_ids))
			{
				$this->db->{$or_where_in}($this->tables['lowongan_katagori'].'.'.$this->join['katagori'], $catagory_ids);
			}
		}

		$this->trigger_events('extra_where');

		// run each where that was passed
		if (isset($this->_job_where) && !empty($this->_job_where))
		{
			foreach ($this->_job_where as $where)
			{
				$this->db->where($where);
			}

			$this->_job_where = array();
		}

		if (isset($this->_job_like) && !empty($this->_job_like))
		{
			foreach ($this->_job_like as $like)
			{
				$this->db->or_like($like['like'], $like['value'], $like['position']);
			}

			$this->_job_like = array();
		}

		if (isset($this->_job_limit) && isset($this->_job_offset))
		{
			$this->db->limit($this->_job_limit, $this->_job_offset);

			$this->_job_limit  = NULL;
			$this->_job_offset = NULL;
		}
		else if (isset($this->_job_limit))
		{
			$this->db->limit($this->_job_limit);

			$this->_job_limit  = NULL;
		}

		// set the order
		if (isset($this->_job_order_by) && isset($this->_job_order))
		{
			$this->db->order_by($this->_job_order_by, $this->_job_order);

			$this->_job_order    = NULL;
			$this->_job_order_by = NULL;
		}

		$this->response = $this->db->order_by('created_on', 'desc')->get($this->tables['lowongan']);

		return $this;
	}

	/** Lowongan $id
	* @return object
	**/
	public function user($id = NULL)
	{
		$this->trigger_events('user');

		// if no id was passed use the current users id
		$id = isset($id) ? $id : $this->session->userdata('lowongan_id');

		$this->limit(1);
		$this->order_by($this->tables['lowongan'].'.id', 'desc');
		$this->where($this->tables['lowongan'].'.id', $id);

		$this->users();

		return $this;
	}

	public function get_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('lowongan')->row();
	}

	public function register($identity, $additional_data = array(), $groups = array(), $catagories = array())
	{
		$this->trigger_events('pre_register');

		$manual_activation = $this->config->item('manual_activation', 'job_industry');

		$data = array(
			$this->identity_column	=> $identity,
			'created_on'	=> date("Y-m-d H:i:s"),
			'active'			=> ($manual_activation === FALSE ? 1 : 0)
		);

		// filter out any data passed that doesnt have a matching column in the users table  and merge the set user data and the additional data
		if (!empty($additional_data)) $user_data = array_merge($this->_filter_data($this->tables['lowongan'], $additional_data), $data);

		$this->trigger_events('extra_set');
		$this->db->insert($this->tables['lowongan'], $user_data);
		$id = $this->db->insert_id();

		// add in groups array if it doesn't exists and stop adding into default group if default group ids are set
		if( isset($default_group->id) && empty($groups) )
		{
			$groups[] = $default_group->id;
		}

		if (!empty($groups))
		{
			// add to groups
			foreach ($groups as $group)
			{
				$this->add_to_group($group, $id);
			}
		}


		if( isset($default_group->id) && empty($catagories) )
		{
			$catagories[] = $default_group->id;
		}

		if (!empty($catagories))
		{
			// add to groups
			foreach ($catagories as $catagory)
			{
				$this->add_to_catagory($catagory, $id);
			}
		}

		$this->trigger_events('post_register');

		return $id;
		//return (isset($id)) ? $id : FALSE;
	}


	public function update($id, array $data)
	{
		$this->trigger_events('pre_update_user');

		$user = $this->user($id)->row();

		$this->db->trans_begin();

		// Filter the data passed
		$data = $this->_filter_data($this->tables['lowongan'], $data);


		$this->trigger_events('extra_where');
		$this->db->update($this->tables['lowongan'], $data, array('id' => $user->id));

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();

			$this->trigger_events(array('post_update_user', 'post_update_user_unsuccessful'));
			$this->set_error('update_unsuccessful');
			return FALSE;
		}

		$this->db->trans_commit();

		$this->trigger_events(array('post_update_user', 'post_update_user_successful'));
		$this->set_message('update_successful');
		return TRUE;
	}


	public function delete_user($id)
	{
		$this->trigger_events('pre_delete_user');

		$this->db->trans_begin();

		// remove user from groups
		$this->remove_from_group(NULL, $id);

		// delete user from users table should be placed after remove from group
		$this->db->delete($this->tables['lowongan'], array('id' => $id));


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->trigger_events(array('post_delete_user', 'post_delete_user_unsuccessful'));
			$this->set_error('delete_unsuccessful');
			return FALSE;
		}

		$this->db->trans_commit();

		$this->trigger_events(array('post_delete_user', 'post_delete_user_successful'));
		$this->set_message('delete_successful');
		return TRUE;
	}


	//==================== JOIN USER GROUPS====================================================

	public function get_users_groups($id=FALSE)
	{
		$this->trigger_events('get_users_group');

		//$id || $id = $this->session->userdata('lowongan_id');

		return $this->db->select($this->tables['lowongan_industri'].'.'

		.$this->join['industri'].' as id,'.

		$this->tables['industri'].'.name,'.
		$this->tables['industri'].'.description,'.
		$this->tables['industri'].'.about,'.
		$this->tables['industri'].'.website,'.
		$this->tables['industri'].'.phone,'.
		$this->tables['industri'].'.location,'.
		$this->tables['industri'].'.address,'.
		$this->tables['industri'].'.foto,'.
		$this->tables['industri'].'.thumb_foto')

		->where($this->tables['lowongan_industri'].'.'.$this->join['lowongan'], $id)
		->join($this->tables['industri'], $this->tables['lowongan_industri'].'.'.$this->join['industri'].'='.$this->tables['industri'].'.id')
		->get($this->tables['lowongan_industri']);
	}


	public function add_to_group($group_ids, $user_id=false)
	{
		$this->trigger_events('add_to_group');

		// if no id was passed use the current users id
		$user_id || $user_id = $this->session->userdata('lowongan_id');

		if(!is_array($group_ids))
		{
			$group_ids = array($group_ids);
		}

		$return = 0;

		// Then insert each into the database
		foreach ($group_ids as $group_id)
		{
			if ($this->db->insert($this->tables['lowongan_industri'], array( $this->join['industri'] => (float)$group_id, $this->join['lowongan'] => (float)$user_id)))
			{
				if (isset($this->_cache_groups[$group_id])) {
					$group_name = $this->_cache_groups[$group_id];
				}
				else {
					$group = $this->group($group_id)->result();
					$group_name = $group[0]->name;
					$this->_cache_groups[$group_id] = $group_name;
				}
				$this->_cache_user_in_group[$user_id][$group_id] = $group_name;

				// Return the number of groups added
				$return += 1;
			}
		}

		return $return;
	}


	public function remove_from_group($group_ids=false, $user_id=false)
	{
		$this->trigger_events('remove_from_group');

		// user id is required
		if(empty($user_id))
		{
			return FALSE;
		}

		// if group id(s) are passed remove user from the group(s)
		if( ! empty($group_ids))
		{
			if(!is_array($group_ids))
			{
				$group_ids = array($group_ids);
			}

			foreach($group_ids as $group_id)
			{
				$this->db->delete($this->tables['lowongan_industri'], array($this->join['industri'] => (float)$group_id, $this->join['lowongan'] => (float)$user_id));
				if (isset($this->_cache_user_in_group[$user_id]) && isset($this->_cache_user_in_group[$user_id][$group_id]))
				{
					unset($this->_cache_user_in_group[$user_id][$group_id]);
				}
			}

			$return = TRUE;
		}
		// otherwise remove user from all groups
		else
		{
			if ($return = $this->db->delete($this->tables['lowongan_industri'], array($this->join['lowongan'] => (float)$user_id))) {
				$this->_cache_user_in_group[$user_id] = array();
			}
		}
		return $return;
	}

	//==================== JOIN LOWONGAN_KATAGORI ====================================================




	//-------------------- GROUPS   ---------------------------------------------------------

	public function groups()
	{
		$this->trigger_events('industri');

		// run each where that was passed
		if (isset($this->_job_where) && !empty($this->_job_where))
		{
			foreach ($this->_job_where as $where)
			{
				$this->db->where($where);
			}
			$this->_job_where = array();
		}

		if (isset($this->_job_limit) && isset($this->_job_offset))
		{
			$this->db->limit($this->_job_limit, $this->_job_offset);

			$this->_job_limit  = NULL;
			$this->_job_offset = NULL;
		}
		else if (isset($this->_job_limit))
		{
			$this->db->limit($this->_job_limit);

			$this->_job_limit  = NULL;
		}

		// set the order
		if (isset($this->_job_order_by) && isset($this->_job_order))
		{
			$this->db->order_by($this->_job_order_by, $this->_job_order);
		}

		$this->response = $this->db->order_by('id', 'desc')->get($this->tables['industri']);

		return $this;
	}

	/**group id
	* @return object
	**/
	public function group($id = NULL)
	{
		$this->trigger_events('group');

		if (isset($id))
		{
			$this->where($this->tables['industri'].'.id', $id);
		}

		$this->limit(1);
		$this->order_by('id', 'desc');

		return $this->groups();
	}

	/** create_group
	* @author aditya menon
	*/
	public function create_group($group_name = FALSE, $group_description = '', $additional_data = array())
	{
		/* bail if the group name was not passed
		if(!$group_name)
		{
		$this->set_error('group_name_required');
		return FALSE;
	}*/

	// bail if the group name already exists
	$existing_group = $this->db->get_where($this->tables['industri'], array('name' => $group_name))->num_rows();
	if($existing_group !== 0)
	{
		$this->set_error('group_already_exists');
		return FALSE;
	}

	$data = array
	(
		'name'=>$group_name,
		'description'=>$group_description
	);

	// Filter out any data passed that doesnt have a matching column in the groups table And merge the set group data and the additional data
	if (!empty($additional_data)) $data = array_merge($this->_filter_data($this->tables['industri'], $additional_data), $data);

	$this->trigger_events('extra_group_set');

	// insert the new group
	$this->db->insert($this->tables['industri'], $data);
	$group_id = $this->db->insert_id();

	// report success
	$this->set_message('industry_creation_successful');
	// return the brand new group id
	return $group_id;
}

/** update_group
* @return bool
* @author aditya menon
**/
public function update_group($group_id = FALSE, $group_name = FALSE, $additional_data = array())
{
	if (empty($group_id)) return FALSE;

	$data = array(
		'about'   	 	=> $this->input->post('about'),
		'website'		=> $this->input->post('website'),
		'phone'    		=> $this->input->post('phone'),
		'location'		=> $this->input->post('location'),
		'address'		=> $this->input->post('address'),
	);

	if (!empty($group_name))
	{
		// we are changing the name, so do some checks
		// bail if the group name already exists
		$existing_group = $this->db->get_where($this->tables['industri'], array('name' => $group_name))->row();
		if(isset($existing_group->id) && $existing_group->id != $group_id)
		{
			$this->set_error('group_already_exists');
			return FALSE;
		}

		$data['name'] = $group_name;
	}

	// restrict change of name of the admin group
	$group = $this->db->get_where($this->tables['industri'], array('id' => $group_id))->row();
	if($this->config->item('admin_group', 'job_industry') === $group->name && $group_name !== $group->name)
	{
		$this->set_error('industry_name_admin_not_alter');
		return FALSE;
	}


	// IMPORTANT!! Third parameter was string type $description; this following code is to maintain backward compatibility
	// New projects should work with 3rd param as array
	if (is_string($additional_data)) $additional_data = array('description' => $additional_data);


	// filter out any data passed that doesnt have a matching column in the groups table
	// and merge the set group data and the additional data
	if (!empty($additional_data)) $data = array_merge($this->_filter_data($this->tables['industri'], $additional_data), $data);


	$this->db->update($this->tables['industri'], $data, array('id' => $group_id));

	$this->set_message('industry_update_successful');

	return TRUE;
}

/** delete_group
* @return bool
* @author aditya menon
**/
public function delete_group($group_id = FALSE)
{
	// bail if mandatory param not set
	if(!$group_id || empty($group_id))
	{
		return FALSE;
	}
	$group = $this->group($group_id)->row();
	if($group->name == $this->config->item('admin_group', 'job_industry'))
	{
		$this->trigger_events(array('post_delete_group', 'post_delete_group_notallowed'));
		$this->set_error('group_delete_notallowed');
		return FALSE;
	}

	$this->trigger_events('pre_delete_group');

	$this->db->trans_begin();

	// remove all users from this group
	$this->db->delete($this->tables['lowongan_industri'], array($this->join['industri'] => $group_id));
	// remove the group itself
	$this->db->delete($this->tables['industri'], array('id' => $group_id));

	if ($this->db->trans_status() === FALSE)
	{
		$this->db->trans_rollback();
		$this->trigger_events(array('post_delete_group', 'post_delete_group_unsuccessful'));
		$this->set_error('group_delete_unsuccessful');
		return FALSE;
	}

	$this->db->trans_commit();

	$this->trigger_events(array('post_delete_group', 'post_delete_group_successful'));
	$this->set_message('group_delete_successful');
	return TRUE;
}


// -----------------------------------------------------------------------------

public function identity_check($identity = '')
{
	$this->trigger_events('identity_check');

	if (empty($identity))
	{
		return FALSE;
	}

	return $this->db->where($this->identity_column, $identity)->count_all_results($this->tables['lowongan']) > 0;
}

public function recheck_session()
{
	$recheck = (null !== $this->config->item('recheck_timer', 'job_industry')) ? $this->config->item('recheck_timer', 'job_industry') : 0;

	if($recheck!==0)
	{
		$last_login = $this->session->userdata('last_check');
		if($last_login+$recheck < time())
		{
			$query = $this->db->select('id')
			->where(array($this->identity_column=>$this->session->userdata('identity'),'active'=>'1'))
			->limit(1)
			->order_by('id', 'desc')
			->get($this->tables['lowongan']);
			if ($query->num_rows() === 1)
			{
				$this->session->set_userdata('last_check',time());
			}
			else
			{
				$this->trigger_events('logout');

				$identity = $this->config->item('identity', 'job_industry');

				if (substr(CI_VERSION, 0, 1) == '2')
				{
					$this->session->unset_userdata( array($identity => '', 'id' => '', 'lowongan_id' => '') );
				}
				else
				{
					$this->session->unset_userdata( array($identity, 'id', 'lowongan_id') );
				}
				return false;
			}
		}
	}

	return (bool) $this->session->userdata('identity');
}

public function set_lang($lang = 'en')
{
	$this->trigger_events('set_lang');

	// if the user_expire is set to zero we'll set the expiration two years from now.
	if($this->config->item('user_expire', 'job_industry') === 0)
	{
		$expire = (60*60*24*365*2);
	}
	// otherwise use what is set
	else
	{
		$expire = $this->config->item('user_expire', 'job_industry');
	}

	set_cookie(array(
		'name'   => 'lang_code',
		'value'  => $lang,
		'expire' => $expire
	));

	return TRUE;
}

// ------- FUNGSI AMBIL DATA KE DATABASE ---------------------------

public function limit($limit)
{
	$this->trigger_events('limit');
	$this->_job_limit = $limit;
	return $this;
}

public function offset($offset)
{
	$this->trigger_events('offset');
	$this->_job_offset = $offset;
	return $this;
}

public function where($where, $value = NULL)
{
	$this->trigger_events('where');
	if (!is_array($where))
	{
		$where = array($where => $value);
	}
	array_push($this->_job_where, $where);
	return $this;
}

public function like($like, $value = NULL, $position = 'both')
{
	$this->trigger_events('like');
	array_push($this->_job_like, array(
		'like'     => $like,
		'value'    => $value,
		'position' => $position
	));
	return $this;
}

public function select($select)
{
	$this->trigger_events('select');

	$this->_job_select[] = $select;

	return $this;
}

public function order_by($by, $order='desc')
{
	$this->trigger_events('order_by');

	$this->_job_order_by = $by;
	$this->_job_order    = $order;

	return $this;
}

public function row()
{
	$this->trigger_events('row');

	$row = $this->response->row();

	return $row;
}

public function row_array()
{
	$this->trigger_events(array('row', 'row_array'));

	$row = $this->response->row_array();

	return $row;
}

public function result()
{
	$this->trigger_events('result');

	$result = $this->response->result();

	return $result;
}

public function result_array()
{
	$this->trigger_events(array('result', 'result_array'));

	$result = $this->response->result_array();

	return $result;
}

public function num_rows()
{
	$this->trigger_events(array('num_rows'));

	$result = $this->response->num_rows();

	return $result;
}


// -----------------------------------------------------------------------------
public function set_hook($event, $name, $class, $method, $arguments)
{
	$this->_job_hooks->{$event}[$name] = new stdClass;
	$this->_job_hooks->{$event}[$name]->class     = $class;
	$this->_job_hooks->{$event}[$name]->method    = $method;
	$this->_job_hooks->{$event}[$name]->arguments = $arguments;
}

public function remove_hook($event, $name)
{
	if (isset($this->_job_hooks->{$event}[$name]))
	{
		unset($this->_job_hooks->{$event}[$name]);
	}
}

public function remove_hooks($event)
{
	if (isset($this->_job_hooks->$event))
	{
		unset($this->_job_hooks->$event);
	}
}

protected function _call_hook($event, $name)
{
	if (isset($this->_job_hooks->{$event}[$name]) && method_exists($this->_job_hooks->{$event}[$name]->class, $this->_job_hooks->{$event}[$name]->method))
	{
		$hook = $this->_job_hooks->{$event}[$name];

		return call_user_func_array(array($hook->class, $hook->method), $hook->arguments);
	}

	return FALSE;
}

public function trigger_events($events)
{
	if (is_array($events) && !empty($events))
	{
		foreach ($events as $event)
		{
			$this->trigger_events($event);
		}
	}
	else
	{
		if (isset($this->_job_hooks->$events) && !empty($this->_job_hooks->$events))
		{
			foreach ($this->_job_hooks->$events as $name => $hook)
			{
				$this->_call_hook($events, $name);
			}
		}
	}
}

public function set_message_delimiters($start_delimiter, $end_delimiter)
{
	$this->message_start_delimiter = $start_delimiter;
	$this->message_end_delimiter   = $end_delimiter;

	return TRUE;
}

public function set_error_delimiters($start_delimiter, $end_delimiter)
{
	$this->error_start_delimiter = $start_delimiter;
	$this->error_end_delimiter   = $end_delimiter;

	return TRUE;
}


public function set_message($message)
{
	$this->messages[] = $message;

	return $message;
}

public function messages()
{
	$_output = '';
	foreach ($this->messages as $message)
	{
		$messageLang = $this->lang->line($message) ? $this->lang->line($message) : '' . $message . '';
		$_output .= '
		<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-info"></i> Alert !</h4>'. $this->message_start_delimiter . $messageLang . $this->message_end_delimiter .
		'</div>';
	}

	return $_output;
}

public function messages_array($langify = TRUE)
{
	if ($langify)
	{
		$_output = array();
		foreach ($this->messages as $message)
		{
			$messageLang = $this->lang->line($message) ? $this->lang->line($message) : '' . $message . '';
			$_output .= '
			<div class="alert alert-info alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-info"></i> Alert !</h4>'. $this->message_start_delimiter . $messageLang . $this->message_end_delimiter .
			'</div>';
		}
		return $_output;
	}
	else
	{
		return $this->messages;
	}
}

public function clear_messages()
{
	$this->messages = array();

	return TRUE;
}

public function set_error($error)
{
	$this->errors[] = $error;

	return $error;
}

public function errors()
{
	$_output = '';
	foreach ($this->errors as $error)
	{
		$errorLang = $this->lang->line($error) ? $this->lang->line($error) : '' . $error . '';
		$_output .= '
		<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-ban"></i> Alert !</h4>' . $this->error_start_delimiter . $errorLang . $this->error_end_delimiter .
		'</div>';
	}

	return $_output;
}

public function errors_array($langify = TRUE)
{
	if ($langify)
	{
		$_output = array();
		foreach ($this->errors as $error)
		{
			$errorLang = $this->lang->line($error) ? $this->lang->line($error) : '' . $error . '';
			$_output .= '
			<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-ban"></i> Alert !</h4>'. $this->error_start_delimiter . $errorLang . $this->error_end_delimiter .
			'</div>';
		}
		return $_output;
	}
	else
	{
		return $this->errors;
	}
}

public function clear_errors()
{
	$this->errors = array();

	return TRUE;
}

protected function _filter_data($table, $data)
{
	$filtered_data = array();
	$columns = $this->db->list_fields($table);

	if (is_array($data))
	{
		foreach ($columns as $column)
		{
			if (array_key_exists($column, $data))
			$filtered_data[$column] = $data[$column];
		}
	}

	return $filtered_data;
}
}
