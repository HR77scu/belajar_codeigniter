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
        $this->load->library('form_validation');
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
        
        $this->form_validation->set_rules('name','Name', 'required',[
            'required' => 'Nama tidak boleh kosong',
        ]);
        if($this->form_validation->run() == false){
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar',$data);
            $this->load->view('template/navbar',$data);
            $this->load->view('users/edit',$data);
            $this->load->view('template/footer',$data);
        }else{
            // echo 'Hello bro';
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            $uploadImage = $_FILES['image'];
            if($uploadImage){
                $config['allowed_types'] = 'svg|gif|jpeg|jpg|png';
                $config['max_size'] = '2024';
                $config['upload_path'] = './assets/admin/img/';
                $this->load->library('upload',$config);
                if($this->upload->do_upload('image')){
                    $oldImage = $data['user']['image'];
                    if($oldImage != 'undraw_profile_1.svg'){
                        unlink(FCPATH.'assets/admin/img/'.$oldImage);
                    }
                    $newImage = $this->upload->data('file_name');
                    $this->db->set('image',$newImage);
                }else{
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name',$name);
            $this->db->where('email',$email);
            $this->db->update('users');

            $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert" >Profil kamu berhasil di edit!</div>');
            redirect('users/edit');
        }
    }
    public function changePassword(){
        $data['title'] = "Change Password";
        $data['user'] = $this->db->get_where('users',['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password','Current Password','required|trim');
        $this->form_validation->set_rules('new_password1','New Password','required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2','Confirm New Password','required|trim|min_length[6]|matches[new_password2]');
        if($this->form_validation->run() == false){
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar',$data);
            $this->load->view('template/navbar',$data);
            $this->load->view('users/changepassword',$data);
            $this->load->view('template/footer');
        }else{
            $currentPassword = $this->input->post('current_password');
            $newPassword = $this->input->post('new_password1');
            if(!password_verify($currentPassword, $data['user']['password'])){
                $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert" >Wrong current password!</div>');
                redirect('users/changepassword');
            }else{
                if($currentPassword == $newPassword){
                    $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert" >Password baru tidak boleh sama dengan password lama!</div>');
                    redirect('users/changepassword');
                }else{
                    $password_hash = password_hash($newPassword, PASSWORD_DEFAULT);
                    
                    $this->db->set('password',$password_hash);
                    $this->db->where('email',$this->session->userdata('email'));
                    $this->db->update('users');
                    $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert" >Password berhasil di ubah!</div>');
                    redirect('users/changepassword');
                }
            }
        }
    }
}