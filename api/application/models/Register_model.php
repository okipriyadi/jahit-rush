<?php
class Register_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function login($email, $password){
        $query = $this->db->get_where('register',array('email'=>$email,'password'=>md5($password)));
		    return $query;
    }

    public function create($data){
        $query = $this->db->insert('register',$data);
        return $query;
    }

    public function get_user_by_role($role){
        $this->db->select('*');
        $query = $this->db->get_where('user',array('role'=>$role));
		return $query->result_array();
    }

    public function get_user_by_id($id_user){
        $this->db->select('*');
        $query = $this->db->get_where('user',array('user_id'=>$id_user));
		return $query->row_array();
    }
}
