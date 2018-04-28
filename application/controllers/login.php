<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Login extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        // Your own constructor code
        //Setting Page Title and Comman Variable
        $this->data['title'] = 'Administrator Log-in';
        $this->data['section_title'] = 'User Log-in';

        //Load leftsidemenu and save in variable
        //Load header and save in variable
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
    }

    public function index() {
        $this->load->view('login');

        //Loads login Model file
        $this->load->model('userlogin');
        //query the database
        $result = $this->userlogin->logincheck($username, $password);
    }

    public function logout() {

        if (isset($this->session->userdata['userdetails'])) {
            $this->session->unset_userdata('userdetails');
            $this->session->sess_destroy();
            redirect('login', 'refresh');
        } else {
            $this->session->unset_userdata('userdetails');
            $this->session->sess_destroy();
            redirect('login', 'refresh');
        }
    }

}
