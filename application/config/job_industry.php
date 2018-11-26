<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Tables.
| -------------------------------------------------------------------------
| Database table names.
*/
$config['tables']['lowongan']			= 'lowongan';
$config['tables']['industri']			= 'industri';
$config['tables']['katagori']			= 'katagori';


$config['tables']['lowongan_industri']	= 'lowongan_industri';
$config['tables']['lowongan_katagori']	= 'lowongan_katagori';

/*
 | Users table column and Group table column you want to join WITH.
 |
 | Joins from users.id
 | Joins from groups.id
 */
$config['join']['lowongan']  = 'lowongan_id';
$config['join']['industri'] =  'industri_id';
$config['join']['katagori'] =  'katagori_id';

/*
 | -------------------------------------------------------------------------
 | Authentication options.
 | -------------------------------------------------------------------------
 | maximum_login_attempts: This maximum is not enforced by the library, but is
 | used by $this->ion_auth->is_max_login_attempts_exceeded().
 | The controller should check this function and act
 | appropriately. If this variable set to 0, there is no maximum.
 */
$config['site_title']                 = "Example.com";       // Site Title, example.com
$config['admin_email']                = "admin@example.com"; // Admin Email, admin@example.com
$config['default_group']              = 'members';           // Default group, use name
$config['admin_group']                = 'admin';             // Default administrators group, use name
$config['identity']                   = 'name';             // You can use any unique column in your table as identity column. The values in this column, alongside password, will be used for login purposes

$config['min_password_length']        = 8;                   // Minimum Required Length of Password
$config['max_password_length']        = 20;                  // Maximum Allowed Length of Password
$config['email_activation']           = FALSE;               // Email Activation for registration
$config['manual_activation']          = FALSE;               // Manual Activation for registration
$config['remember_users']             = TRUE;                // Allow users to be remembered and enable auto-login
$config['user_expire']                = 86500;               // How long to remember the user (seconds). Set to zero for no expiration
$config['user_extend_on_login']       = FALSE;               // Extend the users cookies every time they auto-login
$config['track_login_attempts']       = FALSE;               // Track the number of failed login attempts for each user or ip.
$config['track_login_ip_address']     = TRUE;                // Track login attempts by IP Address, if FALSE will track based on identity. (Default: TRUE)
$config['maximum_login_attempts']     = 3;                   // The maximum number of failed login attempts.
$config['lockout_time']               = 600;                 // The number of seconds to lockout an account due to exceeded attempts
$config['forgot_password_expiration'] = 0;                   // The number of milliseconds after which a forgot password request will expire. If set to 0, forgot password requests will not expire.
$config['recheck_timer']              = 0;                   /* The number of seconds after which the session is checked again against database to see if the user still exists and is active.
							           Leave 0 if you don't want session recheck. if you really think you need to recheck the session against database, we would
								   recommend a higher value, as this would affect performance */


/*
 | -------------------------------------------------------------------------
 | Cookie options.
 | -------------------------------------------------------------------------
 | remember_cookie_name Default: remember_code
 | identity_cookie_name Default: identity
 */
$config['remember_cookie_name'] = 'remember_code';
$config['identity_cookie_name'] = 'identity';


/*
 | -------------------------------------------------------------------------
 | Message Delimiters.
 | -------------------------------------------------------------------------
 */
$config['delimiters_source']       = 'config'; 	// "config" = use the settings defined here, "form_validation" = use the settings defined in CI's form validation library
$config['message_start_delimiter'] = '<p>'; 	// Message start delimiter
$config['message_end_delimiter']   = '</p>'; 	// Message end delimiter
$config['error_start_delimiter']   = '<p>';		// Error message start delimiter
$config['error_end_delimiter']     = '</p>';	// Error message end delimiter

/* End of file ion_auth.php */
/* Location: ./application/config/ion_auth.php */
