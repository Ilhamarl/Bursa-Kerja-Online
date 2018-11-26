<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Job_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();

	}
	/*
	 * Lists tabel pengguna limit and offset
	 * @return array
	 */
	function lists_job()
	{
		$result = $this->job_industry->users()->result();
		foreach ($result as $k => $user)
		{
			$result[$k]->groups = $this->job_industry->get_users_groups($user->id)->result();
			$result[$k]->catagories = $this->job_industry->get_users_catagories($user->id)->result();
		}
		return $result;
	}

	function lists_catgories()
	{
		$result = $this->job_industry->catagories()->result();
		return $result;
	}

	function record_count()
	{
       return $this->db->count_all("lowongan");
	}

	function fetch_jobs($limit, $start)
	{
       $this->db->limit($limit, $start);
       $query = $this->db->get("lowongan");

       if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
   }

	/*
	 * Remove data pengguna by id
	 * @return integer
	 */
	function delete_job( $id )
	{
		$this->db->trans_start();
		$result = $this->job_industry->delete_user($id);
		$this->db->trans_complete();
		return $result;
	}
}
