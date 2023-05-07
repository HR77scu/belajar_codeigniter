<?php 
function is_logged_in(){
    $a = get_instance();
    if(!$a->session->userdata('email')){
        redirect('auth');
    }else{
        $role = $a->session->userdata('role_id');
        $menu = $a->uri->segment(1);

        $queryM = $a->db->get_where('user_menu',['menu' => $menu])->row_array();
        $menuId = $queryM['id'];
        $userAccess = $a->db->get_where('user_access_menu',['role_id'=> $role, 'menu_id'=> $menuId]);
        if($userAccess->num_rows() < 1){
            redirect('auth/blocked');
        }
    }
}


function check_access($roleId, $menuId){
    $a = get_instance();
    $a->db->where('role_id',$roleId);
    $a->db->where('menu_id',$menuId);
    $result = $a->db->get('user_access_menu');

    if($result->num_rows() > 0){
        return "checked='checked'";
    }
}