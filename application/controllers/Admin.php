<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        // if(!$this->session->userdata('email')){
        //     redirect('auth');
        // }
        $this->load->library('form_validation');
        is_logged_in();
    } 
    public function index(){
        $data['user'] = $this->db->get_where('users',['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Dashboard';
        $this->load->view('template/header',$data); 
        $this->load->view('template/sidebar',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('admin/index',$data);
        $this->load->view('template/footer');
    }
    public function role(){
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('users',['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('admin/role',$data);
        $this->load->view('template/footer');
    }
    public function roleAccess($id){
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('users',['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role',['id' => $id])->row_array();
        // $this->db->where('id !=',1);
        $data['menu']  = $this->db->get('user_menu')->result_array();
        
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('admin/role_access',$data);
        $this->load->view('template/footer');
    }
    public function changeAccess(){
        $menuId = $this->input->post('menuId');
        $roleId = $this->input->post('roleId');
        $data = [
            'role_id' => $roleId,
            'menu_id' => $menuId,
        ];
        $result = $this->db->get_where('user_access_menu',$data);
        if($result->num_rows() < 1){
            $this->db->insert('user_access_menu',$data);
        }else{
            $this->db->delete('user_access_menu',$data);
        }
        $this->session->set_flashdata('message',"<div class='alert alert-success' role='alert' >Akses berhasil di ubah</div>");
    }
}