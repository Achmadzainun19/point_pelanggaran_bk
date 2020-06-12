<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Kelas extends CI_Controller{


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
        $data['judul_halaman']='Kelas';
        $data['kelas']=$this->m_point_pelanggaran->select('kelas,guru','*','kelas.id_wali_kelas=guru.id_guru','kelas.id_kelas','asc')->result();
        $data['guru']=$this->m_point_pelanggaran->select('guru','*','','id_guru','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/kelas/kelas');
        $this->load->view('super_admin/footer');
    }

    public function tambah(){
        $nama=$this->input->post('nama');
        $wali_kelas=$this->input->post('wali_kelas');
        $nilai=array(
            'id_kelas'=>'',
            'nama_kelas'=>$nama,
            'id_wali_kelas'=>$wali_kelas
        );
        $this->m_point_pelanggaran->insert('kelas',$nilai);
        $this->session->set_userdata('pesan','t');
        redirect('kelas');
    }

    public function edit(){
        $id=$this->input->post('id_kelas');
        $nama=$this->input->post('nama');
        $wali_kelas=$this->input->post('wali_kelas');
        $nilai=array(
            'nama_kelas'=>$nama,
            'id_wali_kelas'=>$wali_kelas
        );
        $where=array(
            'id_kelas'=>$id
        );
        $this->m_point_pelanggaran->update('kelas',$nilai,$where);
        $this->session->set_userdata('pesan','e');
        redirect('kelas');
    }

    public function hapus(){
        $id=$this->uri->segment('3');
        $where=array(
            'id_kelas'=>$id
        );
        $this->m_point_pelanggaran->delete('kelas',$where);
        $this->session->set_userdata('pesan','h');
        redirect('kelas');
    }


    function get_data_kelas_edit(){
        $id_kelas = $this->input->get('id');
        $get_kelas = $this->m_point_pelanggaran->select('kelas,guru','*',"guru.id_guru=kelas.id_wali_kelas and kelas.id_kelas='$id_kelas'",'kelas.id_kelas ','desc')->result();
        echo json_encode($get_kelas); 
        
    }

}
?>