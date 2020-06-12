<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Dashboard_gds extends CI_Controller{


    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('m_point_pelanggaran');
        if($this->session->userdata('status_gds')!='login'){
            redirect('login_gds/index');
        }
        
    }

    public function index(){
        $data['judul_halaman']='Dashboard';
        $this->load->view('gds/header',$data);
        $this->load->view('gds/sidebar');
        $this->load->view('gds/navbar');
        $this->load->view('gds/dashboard/dashboard');
        $this->load->view('gds/footer');
    }
}

?>