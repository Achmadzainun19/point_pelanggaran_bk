<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Jenis_pelanggaran extends CI_Controller{


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
        $data['judul_halaman']='Jenis Pelanggaran';
        $data['jenis_pelanggaran']=$this->m_point_pelanggaran->select('jenis_pelanggaran','*','','id_jenis_pelanggaran','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/jenis_pelanggaran/jenis_pelanggaran');
        $this->load->view('super_admin/footer');
    }

    public function tambah(){
        $nama=$this->input->post('nama');
        $nilai=array(
            'id_jenis_pelanggaran'=>'',
            'nama_jenis_pelanggaran'=>$nama,
        );
        $this->m_point_pelanggaran->insert('jenis_pelanggaran',$nilai);
        $this->session->set_userdata('pesan','t');
        redirect('jenis_pelanggaran');
    }

    public function edit(){
        $id=$this->input->post('id_jp');
        $nama=$this->input->post('nama');
        $nilai=array(
            'nama_jenis_pelanggaran'=>$nama,
        );
        $where=array(
            'id_jenis_pelanggaran'=>$id
        );
        $this->m_point_pelanggaran->update('jenis_pelanggaran',$nilai,$where);
        $this->session->set_userdata('pesan','e');
        redirect('jenis_pelanggaran');
    }

    public function hapus(){
        $id=$this->uri->segment('3');
        $where=array(
            'id_jenis_pelanggaran'=>$id
        );
        $this->m_point_pelanggaran->delete('jenis_pelanggaran',$where);
        $this->session->set_userdata('pesan','h');
        redirect('jenis_pelanggaran');
    }

    function get_data_jenis_pelanggaran_edit(){
        $id_jp = $this->input->get('id');
        $get_jp = $this->m_point_pelanggaran->select('jenis_pelanggaran','*',"id_jenis_pelanggaran='$id_jp'",'id_jenis_pelanggaran ','desc')->result();
        echo json_encode($get_jp); 
        
    }


}
?>