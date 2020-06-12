<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Dashboard_guru extends CI_Controller{


    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('m_point_pelanggaran');
        if($this->session->userdata('status_guru')!='login'){
            redirect('login_guru/index');
        }
        
    }

    public function index(){
        $data['judul_halaman']='Dashboard';
        $this->load->view('guru/header',$data);
        $this->load->view('guru/sidebar');
        $this->load->view('guru/navbar');
        $this->load->view('guru/dashboard/dashboard');
        $this->load->view('guru/footer');
    }
}

?>