<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Aktifitas_gds extends CI_Controller{


    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('m_point_pelanggaran');
        // $this->load->library('excel');
        if($this->session->userdata('status_gds')!='login'){
            redirect('login/index');
        }
        
    }

    public function index(){
        $data['judul_halaman']='Aktifitas GDS';
        $id_gds=$this->session->userdata('id_akun_gds');
        $where="pelanggaran_siswa.id_siswa=siswa.id_siswa and pelanggaran_siswa.id_pelanggaran=pelanggaran.id_pelanggaran and pelanggaran_siswa.id_kelas=kelas.id_kelas and pelanggaran_siswa.id_pelapor='$id_gds' and pelanggaran_siswa.level_pelapor='gds'";
        $data['aktifitas']=$this->m_point_pelanggaran->select('pelanggaran_siswa,siswa,kelas,pelanggaran','*',$where,'pelanggaran_siswa.id_pelanggaran_siswa','desc')->result();
        $this->load->view('gds/header',$data);
        $this->load->view('gds/sidebar');
        $this->load->view('gds/navbar');
        $this->load->view('gds/aktifitas/aktifitas');
        $this->load->view('gds/footer');
    }
}
?>