<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');

    }


    public function index()
    {
        if($this->session->userdata('login_status') == TRUE){

        $data['content_view'] ="User_view";
        $this->load->model('User_model');
        $data['arr']= $this->User_model->get_user();
        $this->load->view('template', $data, FALSE);
        } else{
            redirect('Login');
        }

       

    }
    public function add_user()
    {
         $this->form_validation->set_rules('nama','nama','trim|required',
    array('required' => 'Nama User Harus di isi' ));

    $this->form_validation->set_rules('username','username','trim|required',
    array('required' => 'Username Harus di isi' ));

    $this->form_validation->set_rules('password','password','trim|required',
    array('required' => 'Password harus di isi' ));

    

            if($this->form_validation->run() == TRUE)
            {
                $this->load->model('User_model','bar');
                $masuk=$this->bar->add_user();

                if($masuk==TRUE){
                $this->session->set_flashdata('pesan', 'sukses masuk');

                } else{
                $this->session->set_flashdata('pesan', 'gagal masuk');

            }
            redirect(base_url('index.php/User'),'refresh');

            }
            else{
                $this->session->set_flashdata('pesan', validation_errors());
                redirect(base_url('index.php/User'),'refresh');

        }
      }
    public function hapus()
    {
        if($this->session->userdata('login_status') == TRUE){
            $id_user = $this->uri->segment(3);

            if($this->User_model->hapus_user($id_user)){
                $this->session->set_flashdata('pesan','Hapus User berhasil!');
                
                redirect('User');
                
            }
            else {
                $this->session->set_flashdata('pesan','Hapus User Gagal!');
                redirect('User');
            }
            
        }
    }
        public function json_user_by_id(){
            if($this->session->userdata('login_status') == TRUE){
                $id_user = $this->uri->segment(3);
    
                $data = $this->User_model->get_data_user_by_id($id_user);
                echo json_encode($data);      
            }
            else{
                redirect('Login');
            }
        }

        public function Ubah(){

            if ($this->session->userdata('login_status') == TRUE) {
                //validasi form
                
                $this->form_validation->set_rules('nama_user_edit','nama','trim|required');
                $this->form_validation->set_rules('username_edit','username','trim|required');
                $this->form_validation->set_rules('password_edit','password','trim|required');

                if ($this->form_validation->run() == TRUE) {
                    
                    if ($this->User_model->edit() == TRUE) {
                        
                        $this->session->set_flashdata('pesan','Ubah User berhasil!!!');
                        redirect('User');
                    } else {
                        $this->session->set_flashdata('pesan','Ubah User Gagal!!!');
                        redirect('User');


                    }
                } else {
                    $this->session->set_flashdata('pesan', validation_errors());
                    redirect('User');
                }
            } else {
                redirect('login');
            }
        }
    }

