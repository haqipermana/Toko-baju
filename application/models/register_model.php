<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model {

	public function get_register(){
		return $this->db->get('user')
						->result();
	}

	public function get_data_register_by_id($id)
	{
		return $this->db->where('id_user', $id)
						->get('user')
						->row();
	}

	public function tambah($data = array())
	{
		return $this->db->insert('user', $data);
	}
}