<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Catagory_job_model extends CI_Model
	{
		public $tables = array();

		public $activation_code;

		public $forgotten_password_code;

		/**
			* new password
			*
			* @var string
		*/
		public $new_password;

		/**
			* Identity
			*
			* @var string
		*/
		public $identity;

		/**
			* Where
			*
			* @var array
		*/
		public $_ion_where = array();

		/**
			* Select
			*
			* @var array
		*/
		public $_ion_select = array();

		/**
			* Like
			*
			* @var array
		*/
		public $_ion_like = array();
		/**
			* Limit
			*
			* @var string
		*/
		public $_ion_limit = NULL;

		/**
			* Offset
			*
			* @var string
		*/
		public $_ion_offset = NULL;

		/**
			* Order By
			*
			* @var string
		*/
		public $_ion_order_by = NULL;

		/**
			* Order
			*
			* @var string
		*/
		public $_ion_order = NULL;

		/**
			* Hooks
			*
			* @var object
		*/
		protected $_ion_hooks;

		/**
			* Response
			*
			* @var string
		*/
		protected $response = NULL;

		/**
			* message (uses lang file)
			*
			* @var string
		*/
		protected $messages;

		/**
			* error message (uses lang file)
			*
			* @var string
		*/
		protected $errors;

		/**
			* error start delimiter
			*
			* @var string
		*/
		protected $error_start_delimiter;

		/**
			* error end delimiter
			*
			* @var string
		*/
		protected $error_end_delimiter;

		/**
			* caching of users and their groups
			*
			* @var array
		*/
		public $_cache_user_in_group = array();

		/**
			* caching of groups
			*
			* @var array
		*/
		protected $_cache_groups = array();

		/**
			* Database object
			* @var object
		*/
		protected $db;

		public function __construct()
		{
			$this->load->database();
			$this->config->load('catagory_job', TRUE);

			$this->load->helper('cookie');
			$this->load->helper('date');
			$this->lang->load('ion_auth');

			// initialize the database
			$this->db = $this->load->database($this->config->item('database_group_name', 'catagory_job'), TRUE, TRUE);

			// initialize db tables data
			$this->tables = $this->config->item('tables', 'catagory_job');

			// initialize data
			$this->identity_column = $this->config->item('identity', 'catagory_job');
			$this->store_salt = $this->config->item('store_salt', 'catagory_job');
			$this->salt_length = $this->config->item('salt_length', 'catagory_job');
			$this->join = $this->config->item('join', 'catagory_job');

			// initialize hash method options (Bcrypt)
			$this->hash_method = $this->config->item('hash_method', 'catagory_job');
			$this->default_rounds = $this->config->item('default_rounds', 'catagory_job');
			$this->random_rounds = $this->config->item('random_rounds', 'catagory_job');
			$this->min_rounds = $this->config->item('min_rounds', 'catagory_job');
			$this->max_rounds = $this->config->item('max_rounds', 'catagory_job');

			// initialize messages and error
			$this->messages    = array();
			$this->errors      = array();
			$delimiters_source = $this->config->item('delimiters_source', 'catagory_job');

			// load the error delimeters either from the config file or use what's been supplied to form validation
			if ($delimiters_source === 'form_validation')
			{
				// load in delimiters from form_validation
				// to keep this simple we'll load the value using reflection since these properties are protected
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
				$this->message_start_delimiter = $this->config->item('message_start_delimiter', 'catagory_job');
				$this->message_end_delimiter = $this->config->item('message_end_delimiter', 'catagory_job');
				$this->error_start_delimiter = $this->config->item('error_start_delimiter', 'catagory_job');
				$this->error_end_delimiter = $this->config->item('error_end_delimiter', 'catagory_job');
			}

			// initialize our hooks object
			$this->_ion_hooks = new stdClass;

			// load the bcrypt class if needed
			if ($this->hash_method == 'bcrypt')
			{
				if ($this->random_rounds)
				{
					$rand = rand($this->min_rounds,$this->max_rounds);
					$params = array('rounds' => $rand);
				}
				else
				{
					$params = array('rounds' => $this->default_rounds);
				}

				$params['salt_prefix'] = $this->config->item('salt_prefix', 'catagory_job');
				$this->load->library('bcrypt',$params);
			}

			$this->trigger_events('model_constructor');
		}
		/**
			* Generates a random salt value.
			*
			* Salt generation code taken from https://github.com/ircmaxell/password_compat/blob/master/lib/password.php
			*
			* @return bool|string
			* @author Anthony Ferrera
		*/
		public function salt()
		{
			$raw_salt_len = 16;

			$buffer = '';
			$buffer_valid = FALSE;

			if (function_exists('random_bytes'))
			{
				$buffer = random_bytes($raw_salt_len);
				if ($buffer)
				{
					$buffer_valid = TRUE;
				}
			}

			if (!$buffer_valid && function_exists('mcrypt_create_iv') && !defined('PHALANGER'))
			{
				$buffer = mcrypt_create_iv($raw_salt_len, MCRYPT_DEV_URANDOM);
				if ($buffer)
				{
					$buffer_valid = TRUE;
				}
			}

			if (!$buffer_valid && function_exists('openssl_random_pseudo_bytes'))
			{
				$buffer = openssl_random_pseudo_bytes($raw_salt_len);
				if ($buffer)
				{
					$buffer_valid = TRUE;
				}
			}

			if (!$buffer_valid && @is_readable('/dev/urandom'))
			{
				$f = fopen('/dev/urandom', 'r');
				$read = strlen($buffer);
				while ($read < $raw_salt_len)
				{
					$buffer .= fread($f, $raw_salt_len - $read);
					$read = strlen($buffer);
				}
				fclose($f);
				if ($read >= $raw_salt_len)
				{
					$buffer_valid = TRUE;
				}
			}

			if (!$buffer_valid || strlen($buffer) < $raw_salt_len)
			{
				$bl = strlen($buffer);
				for ($i = 0; $i < $raw_salt_len; $i++)
				{
					if ($i < $bl)
					{
						$buffer[$i] = $buffer[$i] ^ chr(mt_rand(0, 255));
					}
					else
					{
						$buffer .= chr(mt_rand(0, 255));
					}
				}
			}

			$salt = $buffer;

			// encode string with the Base64 variant used by crypt
			$base64_digits = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
			$bcrypt64_digits = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			$base64_string = base64_encode($salt);
			$salt = strtr(rtrim($base64_string, '='), $base64_digits, $bcrypt64_digits);

			$salt = substr($salt, 0, $this->salt_length);

			return $salt;
		}

		/**
			* Validates and removes activation code.
			*
			* @param int|string $id
			* @param bool       $code
			*
			* @return bool
			* @author Mathew
		*/
		public function activate($id, $code = FALSE)
		{
			$this->trigger_events('pre_activate');

			if ($code !== FALSE)
			{
				$query = $this->db->select($this->identity_column)
				->where('activation_code', $code)
				->where('id', $id)
				->limit(1)
				->order_by('id', 'desc')
				->get($this->tables['users']);

				$query->row();

				if ($query->num_rows() !== 1)
				{
					$this->trigger_events(array('post_activate', 'post_activate_unsuccessful'));
					$this->set_error('activate_unsuccessful');
					return FALSE;
				}

				$data = array(
			    'activation_code' => NULL,
			    'active'          => 1
				);

				$this->trigger_events('extra_where');
				$this->db->update($this->tables['users'], $data, array('id' => $id));
			}
			else
			{
				$data = array(
			    'activation_code' => NULL,
			    'active'          => 1
				);

				$this->trigger_events('extra_where');
				$this->db->update($this->tables['users'], $data, array('id' => $id));
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

		/**
			* Updates a users row with an activation code.
			*
			* @param int|string|null $id
			*
			* @return bool
			* @author Mathew
		*/
		public function deactivate($id = NULL)
		{
			$this->trigger_events('deactivate');

			if (!isset($id))
			{
				$this->set_error('deactivate_unsuccessful');
				return FALSE;
			}
			else if ($this->catagory_job->logged_in() && $this->user()->row()->id == $id)
			{
				$this->set_error('deactivate_current_user_unsuccessful');
				return FALSE;
			}

			$activation_code = sha1(md5(microtime()));
			$this->activation_code = $activation_code;

			$data = array(
		    'activation_code' => $activation_code,
		    'active'          => 0
			);

			$this->trigger_events('extra_where');
			$this->db->update($this->tables['users'], $data, array('id' => $id));

			$return = $this->db->affected_rows() == 1;
			if ($return)
			{
				$this->set_message('deactivate_successful');
			}
			else
			{
				$this->set_error('deactivate_unsuccessful');
			}

			return $return;
		}

		/**
			* Checks email
			*
			* @param string $email
			*
			* @return bool
			* @author Mathew
		*/
		public function email_check($email = '')
		{
			$this->trigger_events('email_check');

			if (empty($email))
			{
				return FALSE;
			}

			$this->trigger_events('extra_where');

			return $this->db->where('email', $email)
			->limit(1)
			->count_all_results($this->tables['users']) > 0;
		}

		/**
			* Identity check
			*
			* @return bool
			* @author Mathew
		*/
		public function identity_check($identity = '')
		{
			$this->trigger_events('identity_check');

			if (empty($identity))
			{
				return FALSE;
			}

			return $this->db->where($this->identity_column, $identity)
			->limit(1)
			->count_all_results($this->tables['users']) > 0;
		}

		/**
			* Register
			*
			* @param    string $identity
			* @param    string $password
			* @param    string $email
			* @param    array  $additional_data
			* @param    array  $groups
			*
			* @return    bool
			* @author    Mathew
		*/
		public function register($identity, $password, $email, $additional_data = array(), $groups = array())
		{
			$this->trigger_events('pre_register');

			$manual_activation = $this->config->item('manual_activation', 'catagory_job');

			if ($this->identity_check($identity))
			{
				$this->set_error('account_creation_duplicate_identity');
				return FALSE;
			}
			else if (!$this->config->item('default_group', 'catagory_job') && empty($groups))
			{
				$this->set_error('account_creation_missing_default_group');
				return FALSE;
			}

			// check if the default set in config exists in database
			$query = $this->db->get_where($this->tables['groups'], array('name' => $this->config->item('default_group', 'catagory_job')), 1)->row();
			if (!isset($query->id) && empty($groups))
			{
				$this->set_error('account_creation_invalid_default_group');
				return FALSE;
			}

			// capture default group details
			$default_group = $query;

			// IP Address
			$ip_address = $this->_prepare_ip($this->input->ip_address());
			$salt = $this->store_salt ? $this->salt() : FALSE;
			$password = $this->hash_password($password, $salt);

			// Users table.
			$data = array(
			$this->identity_column => $identity,
			'username' => $identity,
			'password' => $password,
			'email' => $email,
			'ip_address' => $ip_address,
			'created_on' => date("Y-m-d H:i:s"),
			'active' => ($manual_activation === FALSE ? 1 : 0)
			);

			if ($this->store_salt)
			{
				$data['salt'] = $salt;
			}

			// filter out any data passed that doesnt have a matching column in the users table
			// and merge the set user data and the additional data
			$user_data = array_merge($this->_filter_data($this->tables['users'], $additional_data), $data);

			$this->trigger_events('extra_set');

			$this->db->insert($this->tables['users'], $user_data);

			$id = $this->db->insert_id($this->tables['users'] . '_id_seq');

			// add in groups array if it doesn't exists and stop adding into default group if default group ids are set
			if (isset($default_group->id) && empty($groups))
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

			$this->trigger_events('post_register');

			return (isset($id)) ? $id : FALSE;
		}

		/**
			* Verifies if the session should be rechecked according to the configuration item recheck_timer. If it does, then
			* it will check if the user is still active
			* @return bool
		*/
		public function recheck_session()
		{
			$recheck = (NULL !== $this->config->item('recheck_timer', 'catagory_job')) ? $this->config->item('recheck_timer', 'catagory_job') : 0;

			if ($recheck !== 0)
			{
				$last_login = $this->session->userdata('last_check');
				if ($last_login + $recheck < time())
				{
					$query = $this->db->select('id')
					->where(array($this->identity_column => $this->session->userdata('identity'), 'active' => '1'))
					->limit(1)
					->order_by('id', 'desc')
					->get($this->tables['users']);
					if ($query->num_rows() === 1)
					{
						$this->session->set_userdata('last_check', time());
					}
					else
					{
						$this->trigger_events('logout');

						$identity = $this->config->item('identity', 'catagory_job');

						if (substr(CI_VERSION, 0, 1) == '2')
						{
							$this->session->unset_userdata(array($identity => '', 'id' => '', 'user_id' => ''));
						}
						else
						{
							$this->session->unset_userdata(array($identity, 'id', 'user_id'));
						}
						return FALSE;
					}
				}
			}

			return (bool)$this->session->userdata('identity');
		}

		/**
			* @deprecated This function is now only a wrapper for is_max_login_attempts_exceeded() since it only retrieve
			*             attempts within the given period.
			*
			* @param string      $identity   User's identity
			* @param string|null $ip_address IP address
			*                                Only used if track_login_ip_address is set to TRUE.
			*                                If NULL (default value), the current IP address is used.
			*                                Use get_last_attempt_ip($identity) to retrieve a user's last IP
			*
			* @return boolean Whether an account is locked due to excessive login attempts within a given period
		*/
		public function is_time_locked_out($identity, $ip_address = NULL)
		{
			return $this->is_max_login_attempts_exceeded($identity, $ip_address);
		}

		/**
			* @deprecated This function is now only a wrapper for is_max_login_attempts_exceeded() since it only retrieve
			*             attempts within the given period.
			*
			* @param string      $identity   User's identity
			* @param string|null $ip_address IP address
			*                                Only used if track_login_ip_address is set to TRUE.
			*                                If NULL (default value), the current IP address is used.
			*                                Use get_last_attempt_ip($identity) to retrieve a user's last IP
			*
			* @return int The time of the last login attempt for a given IP-address or identity
		*/
		public function get_last_attempt_time($identity, $ip_address = NULL)
		{
			if ($this->config->item('track_login_attempts', 'catagory_job'))
			{
				$this->db->select('time');
				$this->db->where('login', $identity);
				if ($this->config->item('track_login_ip_address', 'catagory_job'))
				{
					if (!isset($ip_address))
					{
						$ip_address = $this->_prepare_ip($this->input->ip_address());
					}
					$this->db->where('ip_address', $ip_address);
				}
				$this->db->order_by('id', 'desc');
				$qres = $this->db->get($this->tables['login_attempts'], 1);

				if ($qres->num_rows() > 0)
				{
					return $qres->row()->time;
				}
			}

			return 0;
		}

		/**
			* Get the IP address of the last time a login attempt occured from given identity
			*
			* @param string $identity User's identity
			*
			* @return string
		*/
		public function get_last_attempt_ip($identity)
		{
			if ($this->config->item('track_login_attempts', 'catagory_job') && $this->config->item('track_login_ip_address', 'catagory_job'))
			{
				$this->db->select('ip_address');
				$this->db->where('login', $identity);
				$this->db->order_by('id', 'desc');
				$qres = $this->db->get($this->tables['login_attempts'], 1);

				if ($qres->num_rows() > 0)
				{
					return $qres->row()->ip_address;
				}
			}

			return '';
		}

		/**
			* @param int $limit
			*
			* @return static
		*/
		public function limit($limit)
		{
			$this->trigger_events('limit');
			$this->_ion_limit = $limit;

			return $this;
		}

		/**
			* @param int $offset
			*
			* @return static
		*/
		public function offset($offset)
		{
			$this->trigger_events('offset');
			$this->_ion_offset = $offset;

			return $this;
		}

		/**
			* @param array|string $where
			* @param null|string  $value
			*
			* @return static
		*/
		public function where($where, $value = NULL)
		{
			$this->trigger_events('where');

			if (!is_array($where))
			{
				$where = array($where => $value);
			}

			array_push($this->_ion_where, $where);

			return $this;
		}

		/**
			* @param string      $like
			* @param string|null $value
			* @param string      $position
			*
			* @return static
		*/
		public function like($like, $value = NULL, $position = 'both')
		{
			$this->trigger_events('like');

			array_push($this->_ion_like, array(
			'like'     => $like,
			'value'    => $value,
			'position' => $position
			));

			return $this;
		}

		/**
			* @param array|string $select
			*
			* @return static
		*/
		public function select($select)
		{
			$this->trigger_events('select');

			$this->_ion_select[] = $select;

			return $this;
		}

		/**
			* @param string $by
			* @param string $order
			*
			* @return static
		*/
		public function order_by($by, $order='desc')
		{
			$this->trigger_events('order_by');

			$this->_ion_order_by = $by;
			$this->_ion_order    = $order;

			return $this;
		}

		/**
			* @return object|mixed
		*/
		public function row()
		{
			$this->trigger_events('row');

			$row = $this->response->row();

			return $row;
		}

		/**
			* @return array|mixed
		*/
		public function row_array()
		{
			$this->trigger_events(array('row', 'row_array'));

			$row = $this->response->row_array();

			return $row;
		}

		/**
			* @return mixed
		*/
		public function result()
		{
			$this->trigger_events('result');

			$result = $this->response->result();

			return $result;
		}

		/**
			* @return array|mixed
		*/
		public function result_array()
		{
			$this->trigger_events(array('result', 'result_array'));

			$result = $this->response->result_array();

			return $result;
		}

		/**
			* @return int
		*/
		public function num_rows()
		{
			$this->trigger_events(array('num_rows'));

			$result = $this->response->num_rows();

			return $result;
		}

		/**
			* users
			*
			* @param array|null $groups
			*
			* @return static
			* @author Ben Edmunds
		*/
		public function users($groups = NULL)
		{
			$this->trigger_events('users');

			if (isset($this->_ion_select) && !empty($this->_ion_select))
			{
				foreach ($this->_ion_select as $select)
				{
					$this->db->select($select);
				}

				$this->_ion_select = array();
			}
			else
			{
				// default selects
				$this->db->select(array(
			    $this->tables['users'].'.*',
			    $this->tables['users'].'.id as id',
			    $this->tables['users'].'.id as user_id'
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
				    $this->tables['users_groups'],
				    $this->tables['users_groups'].'.'.$this->join['users'].'='.$this->tables['users'].'.id',
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
					$this->db->join($this->tables['groups'], $this->tables['users_groups'] . '.' . $this->join['groups'] . ' = ' . $this->tables['groups'] . '.id', 'inner');
					$this->db->where_in($this->tables['groups'] . '.name', $group_names);
				}
				if(!empty($group_ids))
				{
					$this->db->{$or_where_in}($this->tables['users_groups'].'.'.$this->join['groups'], $group_ids);
				}
			}

			$this->trigger_events('extra_where');

			// run each where that was passed
			if (isset($this->_ion_where) && !empty($this->_ion_where))
			{
				foreach ($this->_ion_where as $where)
				{
					$this->db->where($where);
				}

				$this->_ion_where = array();
			}

			if (isset($this->_ion_like) && !empty($this->_ion_like))
			{
				foreach ($this->_ion_like as $like)
				{
					$this->db->or_like($like['like'], $like['value'], $like['position']);
				}

				$this->_ion_like = array();
			}

			if (isset($this->_ion_limit) && isset($this->_ion_offset))
			{
				$this->db->limit($this->_ion_limit, $this->_ion_offset);

				$this->_ion_limit  = NULL;
				$this->_ion_offset = NULL;
			}
			else if (isset($this->_ion_limit))
			{
				$this->db->limit($this->_ion_limit);

				$this->_ion_limit  = NULL;
			}

			// set the order
			if (isset($this->_ion_order_by) && isset($this->_ion_order))
			{
				$this->db->order_by($this->_ion_order_by, $this->_ion_order);

				$this->_ion_order    = NULL;
				$this->_ion_order_by = NULL;
			}

			$this->response = $this->db->order_by('id', 'desc')->get($this->tables['users']);

			return $this;
		}

		/**
			* user
			*
			* @param int|string|null $id
			*
			* @return static
			* @author Ben Edmunds
		*/
		public function user($id = NULL)
		{
			$this->trigger_events('user');

			// if no id was passed use the current users id
			$id = isset($id) ? $id : $this->session->userdata('user_id');

			$this->limit(1);
			$this->order_by($this->tables['users'].'.id', 'desc');
			$this->where($this->tables['users'].'.id', $id);

			$this->users();

			return $this;
		}

		/**
			* get_users_groups
			*
			* @param int|string|bool $id
			*
			* @return CI_DB_result
			* @author Ben Edmunds
		*/
		public function get_users_groups($id = FALSE)
		{
			$this->trigger_events('get_users_group');

			// if no id was passed use the current users id
			$id || $id = $this->session->userdata('user_id');

			return $this->db->select($this->tables['users_groups'].'.'
			.$this->join['groups'].' as id, '
			.$this->tables['groups'].'.name, '
			.$this->tables['groups'].'.description, '
			.$this->tables['groups'].'.type, '
			.$this->tables['groups'].'.requirement, '
			.$this->tables['groups'].'.sallary, '
			.$this->tables['groups'].'.date_expired, '
			.$this->tables['groups'].'.date_modify, '
			.$this->tables['groups'].'.active, '
			.$this->tables['groups'].'.created_on, '
			.$this->tables['groups'].'.filedoc')
			->where($this->tables['users_groups'].'.'.$this->join['users'], $id)
			->join($this->tables['groups'], $this->tables['users_groups'].'.'.$this->join['groups'].'='.$this->tables['groups'].'.id')
			->get($this->tables['users_groups']);
		}

		/**
			* add_to_group
			*
			* @param array|int|float|string $group_ids
			* @param bool|int|float|string  $user_id
			*
			* @return int
			* @author Ben Edmunds
		*/
		public function add_to_group($group_ids, $user_id = FALSE)
		{
			$this->trigger_events('add_to_group');

			// if no id was passed use the current users id
			$user_id || $user_id = $this->session->userdata('user_id');

			if(!is_array($group_ids))
			{
				$group_ids = array($group_ids);
			}

			$return = 0;

			// Then insert each into the database
			foreach ($group_ids as $group_id)
			{
				// Cast to float to support bigint data type
				if ($this->db->insert(
				$this->tables['users_groups'],
				array(
				$this->join['groups'] => (float)$group_id,
				$this->join['users']  => (float)$user_id
				)
				)
				)
				{
					if (isset($this->_cache_groups[$group_id]))
					{
						$group_name = $this->_cache_groups[$group_id];
					}
					else
					{
						$group = $this->group($group_id)->result();
						$group_name = $group[0]->name;
						$this->_cache_groups[$group_id] = $group_name;
					}
					$this->_cache_user_in_group[$user_id][$group_id] = $group_name;

					// Return the number of groups added
					$return++;
				}
			}

			return $return;
		}

		/**
			* remove_from_group
			*
			* @param array|int|float|string|bool $group_ids
			* @param int|float|string|bool $user_id
			*
			* @return bool
			* @author Ben Edmunds
		*/
		public function remove_from_group($group_ids = FALSE, $user_id = FALSE)
		{
			$this->trigger_events('remove_from_group');

			// user id is required
			if (empty($user_id))
			{
				return FALSE;
			}

			// if group id(s) are passed remove user from the group(s)
			if (!empty($group_ids))
			{
				if (!is_array($group_ids))
				{
					$group_ids = array($group_ids);
				}

				foreach ($group_ids as $group_id)
				{
					// Cast to float to support bigint data type
					$this->db->delete(
					$this->tables['users_groups'],
					array($this->join['groups'] => (float)$group_id, $this->join['users'] => (float)$user_id)
					);
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
				// Cast to float to support bigint data type
				if ($return = $this->db->delete($this->tables['users_groups'], array($this->join['users'] => (float)$user_id)))
				{
					$this->_cache_user_in_group[$user_id] = array();
				}
			}
			return $return;
		}

		/**
			* groups
			*
			* @return static
			* @author Ben Edmunds
		*/
		public function groups()
		{
			$this->trigger_events('groups');

			// run each where that was passed
			if (isset($this->_ion_where) && !empty($this->_ion_where))
			{
				foreach ($this->_ion_where as $where)
				{
					$this->db->where($where);
				}
				$this->_ion_where = array();
			}

			if (isset($this->_ion_like) && !empty($this->_ion_like))
			{
				foreach ($this->_ion_like as $like)
				{
					$this->db->or_like($like['like'], $like['value'], $like['position']);
				}

				$this->_ion_like = array();
			}

			if (isset($this->_ion_limit) && isset($this->_ion_offset))
			{
				$this->db->limit($this->_ion_limit, $this->_ion_offset);

				$this->_ion_limit  = NULL;
				$this->_ion_offset = NULL;
			}
			else if (isset($this->_ion_limit))
			{
				$this->db->limit($this->_ion_limit);

				$this->_ion_limit  = NULL;
			}

			// set the order
			if (isset($this->_ion_order_by) && isset($this->_ion_order))
			{
				$this->db->order_by($this->_ion_order_by, $this->_ion_order);
				$this->_ion_order    = NULL;
				$this->_ion_order_by = NULL;
			}

			$this->response = $this->db->order_by('id', 'desc')->get($this->tables['groups']);

			return $this;
		}

		/**
			* group
			*
			* @param int|string|null $id
			*
			* @return static
			* @author Ben Edmunds
		*/
		public function group($id = NULL)
		{
			$this->trigger_events('group');

			if (isset($id))
			{
				$this->where($this->tables['groups'].'.id', $id);
			}

			$this->limit(1);
			$this->order_by('id', 'desc');

			return $this->groups();
		}

		/**
			* update
			*
			* @param int|string $id
			* @param array      $data
			*
			* @return bool
			* @author Phil Sturgeon
		*/
		public function update($id, array $data)
		{
			$this->trigger_events('pre_update_user');

			$user = $this->user($id)->row();

			$this->db->trans_begin();

			if (array_key_exists($this->identity_column, $data) && $this->identity_check($data[$this->identity_column]) && $user->{$this->identity_column} !== $data[$this->identity_column])
			{
				$this->db->trans_rollback();
				$this->set_error('account_creation_duplicate_identity');

				$this->trigger_events(array('post_update_user', 'post_update_user_unsuccessful'));
				$this->set_error('update_unsuccessful');

				return FALSE;
			}

			// Filter the data passed
			$data = $this->_filter_data($this->tables['users'], $data);

			if (array_key_exists($this->identity_column, $data) || array_key_exists('password', $data) || array_key_exists('email', $data))
			{
				if (array_key_exists('password', $data))
				{
					if( ! empty($data['password']))
					{
						$data['password'] = $this->hash_password($data['password'], $user->salt);
					}
					else
					{
						// unset password so it doesn't effect database entry if no password passed
						unset($data['password']);
					}
				}
			}

			$this->trigger_events('extra_where');
			$this->db->update($this->tables['users'], $data, array('id' => $user->id));

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

		/**
			* delete_user
			*
			* @param int|string $id
			*
			* @return bool
			* @author Phil Sturgeon
		*/
		public function delete_user($id)
		{
			$this->trigger_events('pre_delete_user');

			$this->db->trans_begin();

			// remove user from groups
			$this->remove_from_group(NULL, $id);

			// delete user from users table should be placed after remove from group
			$this->db->delete($this->tables['users'], array('id' => $id));

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

		/**
			* set_session
			*
			* @param object $user
			*
			* @return bool
			* @author jrmadsen67
		*/
		public function set_session($user)
		{
			$this->trigger_events('pre_set_session');

			$session_data = array(
		    'identity'             => $user->{$this->identity_column},
		    $this->identity_column => $user->{$this->identity_column},
			'email'                => $user->email,
		    'user_id'              => $user->id, //everyone likes to overwrite id so we'll use user_id
		    'old_last_login'       => $user->last_login,
		    'last_check'           => time(),
			);

			$this->session->set_userdata($session_data);

			$this->trigger_events('post_set_session');

			return TRUE;
		}


		/**
			* create_group
			*
			* @param string|bool $group_name
			* @param string      $group_description
			* @param array       $additional_data
			*
			* @return int|bool The ID of the inserted group, or FALSE on failure
			* @author aditya menon
		*/
		public function create_group($group_name = FALSE, $group_description = '', $additional_data = array())
		{
			// bail if the group name was not passed
			if(!$group_name)
			{
				$this->set_error('group_name_required');
				return FALSE;
			}

			// bail if the group name already exists
			$existing_group = $this->db->get_where($this->tables['groups'], array('name' => $group_name))->num_rows();
			if($existing_group !== 0)
			{
				$this->set_error('group_already_exists');
				return FALSE;
			}

			$data = array('name'=>$group_name,'description'=>$group_description);

			// filter out any data passed that doesnt have a matching column in the groups table
			// and merge the set group data and the additional data
			if (!empty($additional_data)) $data = array_merge($this->_filter_data($this->tables['groups'], $additional_data), $data);

			$this->trigger_events('extra_group_set');

			// insert the new group
			$this->db->insert($this->tables['groups'], $data);
			$group_id = $this->db->insert_id($this->tables['groups'] . '_id_seq');

			// report success
			$this->set_message('group_creation_successful');
			// return the brand new group id
			return $group_id;
		}

		/**
			* update_group
			*
			* @param int|string|bool $group_id
			* @param string|bool     $group_name
			* @param string|array    $additional_data IMPORTANT! This was string type $description; strings are still allowed
			*                                         to maintain backward compatibility. New projects should pass an array of
			*                                         data instead.
			*
			* @return bool
			* @author aditya menon
		*/
		public function update_group($group_id = FALSE, $group_name = FALSE, $additional_data = array())
		{
			if (empty($group_id))
			{
				return FALSE;
			}

			$data = array();

			if (!empty($group_name))
			{
				// we are changing the name, so do some checks

				// bail if the group name already exists
				$existing_group = $this->db->get_where($this->tables['groups'], array('name' => $group_name))->row();
				if (isset($existing_group->id) && $existing_group->id != $group_id)
				{
					$this->set_error('group_already_exists');
					return FALSE;
				}

				$data['name'] = $group_name;
			}

			// restrict change of name of the admin group
			$group = $this->db->get_where($this->tables['groups'], array('id' => $group_id))->row();
			if ($this->config->item('admin_group', 'catagory_job') === $group->name && $group_name !== $group->name)
			{
				$this->set_error('group_name_admin_not_alter');
				return FALSE;
			}

			// TODO Third parameter was string type $description; this following code is to maintain backward compatibility
			if (is_string($additional_data))
			{
				$additional_data = array('description' => $additional_data);
			}

			// filter out any data passed that doesnt have a matching column in the groups table
			// and merge the set group data and the additional data
			if (!empty($additional_data))
			{
				$data = array_merge($this->_filter_data($this->tables['groups'], $additional_data), $data);
			}

			$this->db->update($this->tables['groups'], $data, array('id' => $group_id));

			$this->set_message('group_update_successful');

			return TRUE;
		}

		/**
			* delete_group
			*
			* @param int|string|bool $group_id
			*
			* @return bool
			* @author aditya menon
		*/
		public function delete_group($group_id = FALSE)
		{
			// bail if mandatory param not set
			if(!$group_id || empty($group_id))
			{
				return FALSE;
			}
			$group = $this->group($group_id)->row();
			if($group->name == $this->config->item('admin_group', 'catagory_job'))
			{
				$this->trigger_events(array('post_delete_group', 'post_delete_group_notallowed'));
				$this->set_error('group_delete_notallowed');
				return FALSE;
			}

			$this->trigger_events('pre_delete_group');

			$this->db->trans_begin();

			// remove all users from this group
			$this->db->delete($this->tables['users_groups'], array($this->join['groups'] => $group_id));
			// remove the group itself
			$this->db->delete($this->tables['groups'], array('id' => $group_id));

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

		/**
			* @param string $event
			* @param string $name
			* @param string $class
			* @param string $method
			* @param array $arguments
		*/
		public function set_hook($event, $name, $class, $method, $arguments)
		{
			$this->_ion_hooks->{$event}[$name] = new stdClass;
			$this->_ion_hooks->{$event}[$name]->class     = $class;
			$this->_ion_hooks->{$event}[$name]->method    = $method;
			$this->_ion_hooks->{$event}[$name]->arguments = $arguments;
		}

		/**
			* @param string $event
			* @param string $name
		*/
		public function remove_hook($event, $name)
		{
			if (isset($this->_ion_hooks->{$event}[$name]))
			{
				unset($this->_ion_hooks->{$event}[$name]);
			}
		}

		/**
			* @param string $event
		*/
		public function remove_hooks($event)
		{
			if (isset($this->_ion_hooks->$event))
			{
				unset($this->_ion_hooks->$event);
			}
		}

		/**
			* @param string $event
			* @param string $name
			*
			* @return bool|mixed
		*/
		protected function _call_hook($event, $name)
		{
			if (isset($this->_ion_hooks->{$event}[$name]) && method_exists($this->_ion_hooks->{$event}[$name]->class, $this->_ion_hooks->{$event}[$name]->method))
			{
				$hook = $this->_ion_hooks->{$event}[$name];

				return call_user_func_array(array($hook->class, $hook->method), $hook->arguments);
			}

			return FALSE;
		}

		/**
			* @param string|array $events
		*/
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
				if (isset($this->_ion_hooks->$events) && !empty($this->_ion_hooks->$events))
				{
					foreach ($this->_ion_hooks->$events as $name => $hook)
					{
						$this->_call_hook($events, $name);
					}
				}
			}
		}

		/**
			* set_message_delimiters
			*
			* Set the message delimiters
			*
			* @param string $start_delimiter
			* @param string $end_delimiter
			*
			* @return true
			* @author Ben Edmunds
		*/
		public function set_message_delimiters($start_delimiter, $end_delimiter)
		{
			$this->message_start_delimiter = $start_delimiter;
			$this->message_end_delimiter   = $end_delimiter;

			return TRUE;
		}

		/**
			* set_error_delimiters
			*
			* Set the error delimiters
			*
			* @param string $start_delimiter
			* @param string $end_delimiter
			*
			* @return true
			* @author Ben Edmunds
		*/
		public function set_error_delimiters($start_delimiter, $end_delimiter)
		{
			$this->error_start_delimiter = $start_delimiter;
			$this->error_end_delimiter   = $end_delimiter;

			return TRUE;
		}

		/**
			* set_message
			*
			* Set a message
			*
			* @param string $message The message
			*
			* @return string The given message
			* @author Ben Edmunds
		*/
		public function set_message($message)
		{
			$this->messages[] = $message;

			return $message;
		}

		/**
			* messages
			*
			* Get the messages
			*
			* @return string
			* @author Ben Edmunds
		*/
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

		/**
			* messages as array
			*
			* Get the messages as an array
			*
			* @param bool $langify
			*
			* @return array
			* @author Raul Baldner Junior
		*/
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

		/**
			* clear_messages
			*
			* Clear messages
			*
			* @return true
			* @author Ben Edmunds
		*/
		public function clear_messages()
		{
			$this->messages = array();

			return TRUE;
		}

		/**
			* set_error
			*
			* Set an error message
			*
			* @param string $error The error to set
			*
			* @return string The given error
			* @author Ben Edmunds
		*/
		public function set_error($error)
		{
			$this->errors[] = $error;

			return $error;
		}

		/**
			* errors
			*
			* Get the error message
			*
			* @return string
			* @author Ben Edmunds
		*/
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

		/**
			* errors as array
			*
			* Get the error messages as an array
			*
			* @param bool $langify
			*
			* @return array
			* @author Raul Baldner Junior
		*/
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

		/**
			* clear_errors
			*
			* Clear Errors
			*
			* @return true
			* @author Ben Edmunds
		*/
		public function clear_errors()
		{
			$this->errors = array();

			return TRUE;
		}

		/**
			* @param string $table
			* @param array  $data
			*
			* @return array
		*/
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

		/**
			* @deprecated Now just returns the given string for backwards compatibility reasons
			* @param string $ip_address The IP address
			*
			* @return string The given IP address
		*/
		protected function _prepare_ip($ip_address) {
			return $ip_address;
		}

		/**
			* Regenerate the session without losing any data
			*
		*/
		protected function _regenerate_session() {

			if (substr(CI_VERSION, 0, 1) == '2')
			{
				// Save sess_time_to_update and set it temporarily to 0
				// This is done in order to forces the sess_update method to regenerate
				$old_sess_time_to_update = $this->session->sess_time_to_update;
				$this->session->sess_time_to_update = 0;

				// Call the sess_update method to actually regenerate the session ID
				$this->session->sess_update();

				// Restore sess_time_to_update
				$this->session->sess_time_to_update = $old_sess_time_to_update;
			}
			else
			{
				$this->session->sess_regenerate(FALSE);
			}
		}
	}
