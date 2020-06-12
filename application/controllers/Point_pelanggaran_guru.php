<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Point_pelanggaran_guru extends CI_Controller{


    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('m_point_pelanggaran');
        // $this->load->library('excel');
        if($this->session->userdata('status_guru')!='login'){
            redirect('login/index');
        }
        
    }

    public function index(){
        $data['judul_halaman']='Point Pelanggaran';
        $data['pelanggaran']=$this->m_point_pelanggaran->select('pelanggaran,jenis_pelanggaran','*','jenis_pelanggaran.id_jenis_pelanggaran=pelanggaran.id_jenis_pelanggaran','id_pelanggaran','asc')->result();
        $this->load->view('guru/header',$data);
        $this->load->view('guru/sidebar');
        $this->load->view('guru/navbar');
        $this->load->view('guru/point_pelanggaran/point_pelanggaran');
        $this->load->view('guru/footer');
    }

}
?>