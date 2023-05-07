<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        // if(!$this->session->userdata('email')){
        //     redirect('auth');
        // }
        is_logged_in();
    }
    private function validateMenu(){
        $this->form_validation->set_rules('menu','Menu','required',[
            'required' => 'Menu tidak boleh kosong', 
        ]);
    }
    private function validateSubMenu(){
        $this->form_validation->set_rules('title','Title','required',[
            'required' => 'Title sub menu tidak boleh kososnng',
        ]);
        $this->form_validation->set_rules('menu_id','Menu_id','required',[
            'required' => 'Menu tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('url','Url','required',[
            'required' => 'Url tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('icon','Icon','required',[
            'required' => 'Icon tidak boleh kosong',
        ]);
    }
    public function index(){
        $data['user'] = $this->db->get_where('users',['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Menu Management';
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->validateMenu();
        if($this->form_validation->run() == false){
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar',$data);
            $this->load->view('template/navbar',$data);
            $this->load->view('menu/index',$data);
            $this->load->view('template/footer');
        }else{
            // echo "hello ";
            $inputMenu = $this->input->post('menu');
            $this->db->insert('user_menu',['menu'=>$inputMenu]);
            $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Data berhasil di tambahkan!</div>');
            redirect('menu');
        }

    }
    public function subMenu(){
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('users',['email' => $this->session->userData('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->model('Menu_model','menu');
        $data['submenu'] = $this->menu->getSubMenu();

        $this->validateSubMenu();
        if($this->form_validation->run() == false){
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar',$data);
            $this->load->view('template/navbar',$data);
            $this->load->view('menu/submenu',$data);
            $this->load->view('template/footer');
        }else{
            $dataGet = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),
            ];
            $this->db->insert('user_sub_menu',$dataGet);
            $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Data berhasil di tambahkan!</div>');
            redirect('menu/submenu');
        }
    }
}