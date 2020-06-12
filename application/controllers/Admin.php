<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Admin extends CI_Controller{


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
        $data['judul_halaman']='Admin';
        $data['admin']=$this->m_point_pelanggaran->select('admin','*','','id_admin','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/admin/admin');
        $this->load->view('super_admin/footer');
    }

    public function tambah(){
        $nama=$this->input->post('nama');
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $level=$this->input->post('level');
        $status=$this->input->post('status');
        $nilai=array(
            'id_admin'=>'',
            'nama_admin'=>$nama,
            'username'=>$username,
            'password'=>$password,
            'level_akun'=>$level,
            'status_akun'=>$status,
        );
        $this->m_point_pelanggaran->insert('admin',$nilai);
        $this->session->set_userdata('pesan','t');
        redirect('admin');
    }

    public function edit(){
        $id=$this->uri->segment('3');
        $nama=$this->input->post('nama');
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $level=$this->input->post('level');
        $status=$this->input->post('status');
        $nilai=array(
            'nama_admin'=>$nama,
            'nama_admin'=>$nama,
            'username'=>$username,
            'password'=>$password,
            'level_akun'=>$level,
            'status_akun'=>$status,
        );
        $where=array(
            'id_admin'=>$id
        );
        $this->m_point_pelanggaran->update('admin',$nilai,$where);
        $this->session->set_userdata('pesan','e');
        redirect('admin');
    }

    public function hapus(){
        $id=$this->uri->segment('3');
        $where=array(
            'id_admin'=>$id
        );
        $this->m_point_pelanggaran->delete('admin',$where);
        $this->session->set_userdata('pesan','h');
        redirect('admin');
    }

}
?>