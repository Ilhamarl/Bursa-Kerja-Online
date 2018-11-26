<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Fungsi untuk mendapatkan nama by session
*
* @return string
*/
if(!function_exists('get_name_by_session'))
{
	function get_name_by_session()
	{
		$ci =& get_instance();
		$get_user = $ci->ion_auth->user();
		$extract_data = $get_user->row();
		return $extract_data->first_name.' '.$extract_data->last_name;
	}
}

if(!function_exists('get_last_login'))
{
	function get_last_login()
	{
		$ci =& get_instance();
		$get_user = $ci->ion_auth->user();
		$extract_data = $get_user->row();
		return $extract_data->last_login;
	}
}

if(!function_exists('get_count_job'))
{
	function get_count_job()
	{
		$ci 		=& get_instance();
		$query 		= $ci->db->query("SELECT * FROM lowongan");
		$num_rows	= $query->num_rows();
		return $num_rows;
	}
}

if(!function_exists('get_count_industry'))
{
	function get_count_industry()
	{
		$ci 		=& get_instance();
		$query 		= $ci->db->query("SELECT * FROM industri");
		$num_rows	= $query->num_rows();
		return $num_rows;
	}
}

if(!function_exists('get_count_users'))
{
	function get_count_users()
	{
		$ci 		=& get_instance();
		$query 		= $ci->db->query("SELECT * FROM users");
		$num_rows	= $query->num_rows();
		return $num_rows;
	}
}

if(!function_exists('get_count_catagory'))
{
	function get_count_catagory()
	{
		$ci 		=& get_instance();
		$query 		= $ci->db->query("SELECT * FROM katagori");
		$num_rows	= $query->num_rows();
		return $num_rows;
	}
}

function get_enum_values($table, $field)
{
	$ci =& get_instance();
	$type = $ci->db->query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" )->row( 0 )->Type;
	preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
	$enum = explode("','", $matches[1]);
	return $enum;
}

function get_name_by_id_user( $id_user )
{
	$ci =& get_instance();
	$query 	= $ci->db->query("SELECT first_name, last_name FROM users WHERE id = ?", $id_user);
	$row 	= $query->row();
	$nama_lengkap = $row->first_name.' '.$row->last_name;
	return $nama_lengkap;
}


function get_daftar_groups(){
	$ci =& get_instance();
	$get_groups 	= $ci->job_industry->groups();
	$result_groups 	= $get_groups->result();

	$array_groups 	= array();

	foreach($result_groups as $group)
	{
		$array_groups[$group->id] = $group->name.' - '.$group->description;
	}

	return $array_groups;
}


function get_daftar_catagories(){
	$ci =& get_instance();
	$get_groups 	= $ci->job_industry->catagories();
	$result_groups 	= $get_groups->result();
	$array_groups 	= array();

	foreach($result_groups as $group)
	{
		$array_groups[$group->id] = $group->name.' ('.$group->description.')';
	}

	return $array_groups;
}


function need_login($redirect_url = 'auth')
{
	$ci =& get_instance();
	$check_login = $ci->ion_auth->logged_in();

	if($check_login === FALSE)
	{
		redirect($redirect_url);
	}
	else
	{
		return true;
	}
}

function need_admin($redirect_url = '/')
{
	$ci =& get_instance();
	$check_admin = $ci->ion_auth->is_admin();

	if($check_admin === FALSE)
	{
		$ci->session->set_flashdata('action_status', '<div class="alert alert-danger">Anda tidak memiliki priviladge !</div>');

		redirect($redirect_url);
	}
}
