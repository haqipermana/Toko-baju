<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_user()
    {
        $arr=$this->db->get('user')->result();
        return $arr;

        if($query->num_rows() > 0)
        {
            $session = array('username'  =>$username,
                             'password'  => md5($password),
                             'login_status'=> TRUE
        );
        $this->session->set_userdata($session);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function add_user()
    {
        
        $arr['nama'] =$this->input->post('nama');
        $arr['username'] =$this->input->post('username');
        $arr['password'] = md5($this->input->post("password"));

        $ql_masuk=$this->db->insert('user',$arr);
        return $ql_masuk;
    }
    public function hapus_user($id){
        $this->db->where('id_user', $id)
                 ->delete('user');

        if($this->db->affected_rows() > 0){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function get_data_user_by_id($id)
    {
        return $this->db->where('id_user', $id)
                        ->get('user')
                        ->row();
        
    }
    public function edit()
    {
        $user = array(
            'id_user' => $this->input->post('id_user_edit'),
            'nama' => $this->input->post('nama_user_edit'),
            'username' => $this->input->post('username_edit'),
            'password' => $this->input->post('password_edit')
        );

        $this->db->where('id_user', $this->input->post('id_user_edit'))
                 ->update('user', $user);

        if ($this->db->affected_rows() > 0) {
            
            return TRUE;

        } else {

            return FALSE;
        }
    }

}


