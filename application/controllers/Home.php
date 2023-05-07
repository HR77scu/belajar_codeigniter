<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function index(){
        $data['title'] = 'Dashboard Admin';
        $data['user'] = $this->db->get_where('users',['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('home/dashboard',$data);
    }
}