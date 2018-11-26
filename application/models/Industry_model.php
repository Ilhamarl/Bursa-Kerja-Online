<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Industry_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();

		$this->tbl_industry = 'industri';
	}
	
	/*
	 * daftar group
	 * 
	 * @return mix
	 */
	function lists_industry()
	{
		$result = $this->db->order_by('id', 'desc')->get($this->tbl_industry);

		if ($result->num_rows() > 0) 
		{
			return $result->result();
		}
		else 
		{
			return FALSE;
		}
	}

//------------------------------------------------------------

	/*
	 * Edit industry by id
	 * 
	 * @param integer
	 * @return mix
	 */

	function edit_industry($id) {

		$result = $this->job_industry->group( $id );

		if ($result->num_rows() > 0) 
		{
			return $result->row_array();
		} 
		else 
		{
			return FALSE;
		}		
	}
	
	function update_foto($id,$foto,$thumb_foto)
	{
		// Menggunakan id sebagai referensi key update
		$this->db->where('id', $id);
		// Update data menggunakan active record, $params merupakan data array yang dikirim dari controller ke model ini		
		$result = $this->db->update($this->tbl_industry, $foto, $thumb_foto);
		return $result;
	}

//------------------------------------------------------------

	/*
	 * Hapus daftar industry by id
	 *
	 * @param integer
	 * @return mix
	 */
	function delete_industry( $id ) {

		if( $id != 1 || $id != 2 ) {

			$array_where = array(
				'id' => $id
				);

			$this->db->limit(1);
			$result = $this->db->delete($this->tbl_industry, $array_where );

			return $this->db->affected_rows();				

		} else {

			return FALSE;

		}
	}
}