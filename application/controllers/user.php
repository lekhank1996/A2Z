<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->data['title'] = '';
        $this->data['section_title'] = 'User';

        $this->data['topmenu'] = $this->load->view('topmenu', $this->data, true);
        $this->data['leftmenu'] = $this->load->view('leftmenu', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);

        $this->load->model('userlistmodel');
    }

    public function index() {

        $this->load->database();
        //load the model  
        $this->load->model('userlistmodel');
        //load the method of model  
        $data['h'] = $this->userlistmodel->select();
        //return the data in view  
        $this->load->view('userslist', $data);
    }

    public function adduser() {
        $this->load->view('adduserform');
    }

    public function add() {

        $config = array(
            'upload_path' => "./upload_file/",
            'allowed_types' => "gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp",
            'overwrite' => False,
            'max_size' => "102400000", // Can be set to particular file size , here it is 10 MB(2048 Kb)
                //'encrypt_name' => TRUE
        );
        $this->upload->initialize($config);
        if ($this->upload->do_upload('file')) {
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $file_name = $upload_data['file_name'];

            $data = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'image' => $file_name
            );

            $result = $this->userlistmodel->insert_data($data, 'user');
            if ($result) {
                $this->session->set_flashdata('success', 'Record Successfully Inserted.');
                redirect('user', 'refresh');
            } else {
                $this->session->set_flashdata('danger', 'Error While Insert.');
                redirect('user', 'refresh');
            }
        }
    }

    public function edit($id) {
        //echo $id;die;
        $result = $this->userlistmodel->select_database_id('user', 'user_id', $id, $data = '*');
        $this->data['user_data'] = $result;
        $this->load->view('edituserform', $this->data);
    }

    public function update() {
        $id = $this->input->post('user_id');

        $config = array(
            'upload_path' => "./upload_file/",
            'allowed_types' => "gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp",
            'overwrite' => False,
            'max_size' => "102400000", // Can be set to particular file size , here it is 10 MB(2048 Kb)
                //'encrypt_name' => TRUE
        );

        $this->upload->initialize($config);

        if ($this->upload->do_upload('file')) {
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $file_name = $upload_data['file_name'];

            $data = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('username')),
                'firstname' => $this->input->post('firstname'),
                'lastname' => ($this->input->post('lastname')),
                'gender' => $this->input->post('gender'),
                'image' => $file_name
            );

            $result = $this->userlistmodel->update_data($data, 'user', 'user_id', $id);
            if ($result) {
                //die('a');
                $this->session->set_flashdata('success', 'Record Successfully Updated.');
                redirect('user', 'refresh');
            } else {
                //die('b');
                $this->session->set_flashdata('danger', 'Error While Update.');
                redirect('user', 'refresh');
            }
        }
    }

    public function delete($id) {
        // echo $id;die;
        $this->db->delete('user', array('user_id' => $id));

        $this->session->set_flashdata('danger', 'Record Successfully Deleted.');
        redirect('user', 'refresh');
    }

}

?>