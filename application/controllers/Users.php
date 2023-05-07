<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct(){
        parent::__construct();
        // if(!$this->session->userdata('email')){
        //     redirect('auth');
        // }
        is_logged_in();
        $this->load->helper('form');
    } 
    public function index(){
        $data['user'] = $this->db->get_where('users',['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'My Profile';
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('users/index',$data);
        $this->load->view('template/footer');
    }
    public function edit(){
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('users',['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('users/edit',$data);
        $this->load->view('template/footer',$data);
    }
}