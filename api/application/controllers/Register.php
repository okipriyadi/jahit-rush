<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }


    function login_post(){
      if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
  			$login = $this->register_model->login($this->input->post('email'), $this->input->post('password'));
        $email["asd"] = $this->input->post('email');
  			if($login->num_rows() > 0){
            $jsn["success"] = 'Selamat datang '.$login->result_array()[0]["first_name"];
            echo json_encode($jsn);
  			}else{
  				  $jsn["error"] = "Periksa Kembali Username dan Password";
            echo json_encode($jsn);
  			}
  			
  		}
    }

    function create(){
      if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $data = array(
          'first_name'=>$this->input->post('first_name'),
          'last_name'=>$this->input->post('last_name'),
          'email' => $this->input->post('email'),
          'phone_number' => $this->input->post('phone_number'),
          'password' => md5($this->input->post('password')),
          'alamat' => $this->input->post('alamat')
        );
        $res = $this->register_model->create($data);
        if($res > 0){
            $jsn["success"] = 'Data registrasi berhasil disimpan';
            echo json_encode($jsn);
  			}else{
  				  $jsn["error"] = "Periksa Kembali data - data anda";
            echo json_encode($jsn);
  			}
  		}
    }


}
?>
