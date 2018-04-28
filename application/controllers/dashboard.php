<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	 public function __construct() {
        parent::__construct();
        

        $this->data['title'] = 'Administrator Dashboard';
        $this->data['section_title'] = 'Dashboard';
        $this->load->model('common');
        $this->load->model('dashboardmodel');

	$this->data['topmenu'] = $this->load->view('topmenu',$this->data, true);
        $this->data['leftmenu'] = $this->load->view('leftmenu',$this->data, true);
        $this->data['header'] = $this->load->view('header',$this->data,  true);
        $this->data['footer'] = $this->load->view('footer',$this->data, true);
        $this->load->library('upload');
    }

  public function index() {

       /* if (isset($this->session->userdata['userdetails'])) {
            $session_data = $this->session->userdata('userdetails');
            
            $adminid = $session_data['adminid'];*/
            
            $this->load->view('dashboard', $this->data);
        /*} else {
            redirect('login', 'refresh');
        }*/
    }

     
}