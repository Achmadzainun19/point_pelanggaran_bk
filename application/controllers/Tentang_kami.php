<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Tentang_kami extends CI_Controller{


    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('m_point_pelanggaran');
        // $this->load->library('excel');
        if($this->session->userdata('status')!='login'){
            redirect('login/index');
        }
        
    }

    public function index(){
        $data['judul_halaman']='Ketentuan';
        $data['tentang_kami']=$this->m_point_pelanggaran->select('tentang_kami','*','','id_tentang_kami','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/tentang_kami/tentang_kami');
        $this->load->view('super_admin/footer');
    }

    public function edit(){
        $id=$this->uri->segment('3');
        $deskripsi=$this->input->post('deskripsi');
        $nilai=array(
            'deskripsi'=>$deskripsi,
        );
        $where=array(
            'id_tentang_kami'=>$id
        );
        $this->m_point_pelanggaran->update('tentang_kami',$nilai,$where);
        $this->session->set_userdata('pesan','e');
        redirect('tentang_kami');
    }


}
?>