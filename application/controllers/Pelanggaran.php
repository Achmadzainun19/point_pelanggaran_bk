<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Pelanggaran extends CI_Controller{


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
        $data['judul_halaman']='Pelanggaran';
        $data['jenis_pelanggaran']=$this->m_point_pelanggaran->select('jenis_pelanggaran','*','','id_jenis_pelanggaran','asc')->result();
        $data['pelanggaran']=$this->m_point_pelanggaran->select('pelanggaran,jenis_pelanggaran','*','jenis_pelanggaran.id_jenis_pelanggaran=pelanggaran.id_jenis_pelanggaran','id_pelanggaran','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/pelanggaran/pelanggaran');
        $this->load->view('super_admin/footer');
    }

    public function tambah(){
        $nama=$this->input->post('nama');
        $point=$this->input->post('point');
        $jenis_pelanggaran=$this->input->post('jenis_pelanggaran');
        $nilai=array(
            'id_pelanggaran'=>'',
            'nama_pelanggaran'=>$nama,
            'point_pelanggaran'=>$point,
            'id_jenis_pelanggaran'=>$jenis_pelanggaran
        );
        $this->m_point_pelanggaran->insert('pelanggaran',$nilai);
        $this->session->set_userdata('pesan','t');
        redirect('pelanggaran');
    }

    public function edit(){
        $id=$this->input->post('id_pelanggaran');
        $nama=$this->input->post('nama');
        $point=$this->input->post('point');
        $jenis_pelanggaran=$this->input->post('jenis_pelanggaran');
        $nilai=array(
            'nama_pelanggaran'=>$nama,
            'point_pelanggaran'=>$point,
            'id_jenis_pelanggaran'=>$jenis_pelanggaran
        );
        $where=array(
            'id_pelanggaran'=>$id
        );
        $this->m_point_pelanggaran->update('pelanggaran',$nilai,$where);
        $this->session->set_userdata('pesan','e');
        redirect('pelanggaran');
    }

    public function hapus(){
        $id=$this->uri->segment('3');
        $where=array(
            'id_pelanggaran'=>$id
        );
        $this->m_point_pelanggaran->delete('pelanggaran',$where);
        $this->session->set_userdata('pesan','h');
        redirect('pelanggaran');
    }

    function get_data_pelanggaran_edit(){
        $id_p = $this->input->get('id');
        $get_p = $this->m_point_pelanggaran->select('pelanggaran','*',"id_pelanggaran='$id_p'",'id_pelanggaran ','desc')->result();
        echo json_encode($get_p); 
        
    }

}
?>