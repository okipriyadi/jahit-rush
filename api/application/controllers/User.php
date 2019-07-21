<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class User extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('telepon')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('telepon')->result();
        }

    		//echo "hallo";
    		//var_dump($kontak);
        $this->response($kontak, 200);

    		//var_dump($tar);
    }

	//Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    'id' => $this->post('id'),
                    'name' => $this->post('nama'),
                    'address' => $this->post('nomor'),
                    'gender' => $this->post('gender'),
                    'phone_number' => $this->post('phone_number'),
                  );
        $insert = $this->db->insert('user', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function login(){
      if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
  			$login = $this->user_model->login($this->input->post('username'), $this->input->post('password'));
  			if($login->num_rows() > 0){
  				$this->session->set_userdata('login',TRUE);
  				$data = $login->row_array();
  				$this->session->set_userdata('user_id',$data['user_id']);
  				$this->session->set_userdata('role',$data['role']);
  				$this->session->set_userdata('unit_kerja',$data['unit_kerja']);
  				$this->session->set_userdata('nip',$data['nip']);
  				$this->session->set_userdata('ses_nama',$data['nama']);
  				redirect('dashboard');
  			}else{
  				$component = array(
  					"pesan" => "Periksa Kembali Username dan Password"
  				);
  				$this->load->view('login', $component);
  			}
  		}else{
  			$this->load->view('login');
  		}
    }

    //Masukan function selanjutnya disini
}
?>
