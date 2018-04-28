<?php

class Category extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->data['title'] = '';
        $this->data['section_title'] = 'User';

        $this->data['topmenu'] = $this->load->view('topmenu', $this->data, true);
        $this->data['leftmenu'] = $this->load->view('leftmenu', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);

        $this->load->model('categorymodel');
    }
    
    public function index() {

        $this->load->database();
        //load the model  
        $this->load->model('categorymodel');
        //load the method of model  
        $data['h'] = $this->categorymodel->select();
        //return the data in view  
        $this->load->view('categorylist', $data);
    }
    
    public function addcategory() {
        $this->load->view('addcategoryform');
    }
    
    public function addcat() {

            $data = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender')
            );

            $result = $this->categorymodel->insert_data($data, 'user');
            if ($result) {
                $this->session->set_flashdata('success', 'Record Successfully Inserted.');
                redirect('user', 'refresh');
            } else {
                $this->session->set_flashdata('danger', 'Error While Insert.');
                redirect('user', 'refresh');
            }
        }
    }

    
}


?>