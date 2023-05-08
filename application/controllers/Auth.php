<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function validation(){
        $this->form_validation->set_rules('name','Name','trim|required',[
            'required' => 'nama tida boleh kosong',
        ]);
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]',[
            'reqiured' => 'email tidak boleh kosong',
            'valid_email' => 'Email tidak valid',
            'is_unique' => 'Email sudah tersedia',
        ]);
        $this->form_validation->set_rules('password','Password','required|trim|min_length[6]|matches[confirm_password]',[
            'matches' => 'Password tida sama',
            'min_length' => 'Password minimal 6 karakter atau lebih',
        ]);
        $this->form_validation->set_rules('confirm_password','Confirm_password','required|trim|matches[password]');
    }
    private function __login(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('users',['email' => $email])->row_array();
        if($user){
            if($user['is_active'] == 1){
                if(password_verify($password, $user['password'])){
                    $data  = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                    ];
                    $this->session->set_userdata($data);
                    if($user['role_id'] == 1){
                        redirect('admin');
                    }else{
                        redirect('users');
                    }
                }else{
                    $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Password salah!</div>');
                    redirect('auth');
                }
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Akun tidak aktif!</div>');
                redirect('auth');
            }
        }else{
            $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Akun tidak ditemukan!</div>');
            redirect('auth');
        }
    }
    public function index(){
        if($this->session->userdata('email')){
            redirect('users');
        }
        $this->form_validation->set_rules('email','Email','trim|required|valid_email',[
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email tidak valid',
        ]);
        $this->form_validation->set_rules('password','Password','trim|required|min_length[6]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password minimal 6 karakter atau lebih',
        ]);
        if($this->form_validation->run() == false){
            $data['title'] = 'Halaman Login';        
            $this->load->view('auth/part/header', $data);
            $this->load->view('auth/login');
            $this->load->view('auth/part/footer');
        }else{
            $this->__login();
        }
    }
    public function register(){
        if($this->session->userdata('email')){
            redirect('users');
        }
        $this->validation();
        if($this->form_validation->run() == false){
            $data['title']  = 'Halaman Register';
            $this->load->view('auth/part/header',$data);
            $this->load->view('auth/register');
            $this->load->view('auth/part/footer');
        }else{
            $data = [
                'name' => htmlspecialchars($this->input->post('name')),
                'email' => htmlspecialchars($this->input->post('email')),
                'image' => 'img/undraw_profile_1.svg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT), // password hash
                'role_id' => 2,
                'is_active' => 1,
                'date_create' => time(),
            ];
            $this->db->insert('users',$data);
            $this->_sendEmail();
            $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Register Success</div>');
            redirect('auth');
        }
    }
    private function _sendEmail(){
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => '',
            'smtp_pass' => '',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];
        $this->load->library('email',$config);
        $this->email->from('');
        $this->email->to('');
        $this->email->subject('Testing');
        $this->email->message('Hello worlds');
        // $this->email->send();
        if($this->email->send()){
            return true;
        }else{
            echo $this->email->print_debugger();
            die;
        }
    }
    public function logout(){
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert" >Anda berhasil logout!</div>');
        redirect('auth');
    }
    public function blocked(){
        // echo 'access blocked!';
        $this->load->view('auth/blocked');
    }
}