<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Ketentuan extends CI_Controller{


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
        $data['ketentuan']=$this->m_point_pelanggaran->select('ketentuan_point','*','','id_ketentuan_point','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/ketentuan/ketentuan');
        $this->load->view('super_admin/footer');
    }

    public function tambah(){
        $nama=$this->input->post('nama');
        $point_rendah=$this->input->post('point_rendah');
        $point_tinggi=$this->input->post('point_tinggi');
        $nilai=array(
            'id_ketentuan_point'=>'',
            'nama_ketentuan'=>$nama,
            'point_pelanggaran_rendah'=>$point_rendah,
            'point_pelanggaran_tinggi'=>$point_tinggi,
        );
        $this->m_point_pelanggaran->insert('ketentuan_point',$nilai);
        $this->session->set_userdata('pesan','t');
        redirect('ketentuan');
    }

    public function edit(){
        $id=$this->input->post('id_ketentuan');
        $nama=$this->input->post('nama');
        $point_rendah=$this->input->post('point_rendah');
        $point_tinggi=$this->input->post('point_tinggi');
        $nilai=array(
            'nama_ketentuan'=>$nama,
            'point_pelanggaran_rendah'=>$point_rendah,
            'point_pelanggaran_tinggi'=>$point_tinggi,
        );
        $where=array(
            'id_ketentuan_point'=>$id
        );
        $this->m_point_pelanggaran->update('ketentuan_point',$nilai,$where);
        $this->session->set_userdata('pesan','e');
        redirect('ketentuan');
    }

    public function hapus(){
        $id=$this->uri->segment('3');
        $where=array(
            'id_ketentuan_point'=>$id
        );
        $this->m_point_pelanggaran->delete('ketentuan_point',$where);
        $this->session->set_userdata('pesan','h');
        redirect('ketentuan');
    }

    function get_data_ketentuan_edit(){
        $id_k = $this->input->get('id');
        $get_k = $this->m_point_pelanggaran->select('ketentuan_point','*',"id_ketentuan_point='$id_k'",'id_ketentuan_point','desc')->result();
        echo json_encode($get_k); 
        
    }

}
?>