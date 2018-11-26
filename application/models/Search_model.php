<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search_model Extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  function search($keyword)
  {
    $this->db->like('name',$keyword);
    $this->db->or_like('type', $keyword);
    $this->db->or_like('description', $keyword);
    $this->db->or_like('requirement', $keyword);
    $this->db->or_like('sallary', $keyword);

    $result = $this->job_industry->users()->result();
    foreach ($result as $k => $user)
    {
      $result[$k]->groups = $this->job_industry->get_users_groups($user->id)->result();
      $result[$k]->catagories = $this->job_industry->get_users_catagories($user->id)->result();
    }
    return $result;
  }

  function catagory($keyword)
  {
    $this->db->like('catagory', $keyword);

    $result = $this->job_industry->users()->result();
    foreach ($result as $k => $user)
    {
      $result[$k]->groups = $this->job_industry->get_users_groups($user->id)->result();
      $result[$k]->catagories = $this->job_industry->get_users_catagories($user->id)->result();
    }
    return $result;
  }
}
