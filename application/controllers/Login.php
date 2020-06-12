<?php
defined('BASEPATH') or exit('');

class Login extends CI_Controller{


    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('m_point_pelanggaran');
        // $this->load->model('m_klinik');
        // if($this->session->userdata('status')!='login'){
        //     redirect('login/index');
        // }
        
    }

    public function index(){
        $data['judul_halaman']="Utama";
        $this->load->view('super_admin/login/login');
    }

    public function verification(){
        $where=array(
            'username'=>$this->input->post('username'),
            'password'=>$this->input->post('password')
            );
        $cek=$this->m_point_pelanggaran->select('admin','*',$where,'id_admin','asc')->num_rows();
        if($cek > 0){
            $akun=$this->m_point_pelanggaran->select('admin','*',$where,'id_admin','asc')->result();
            foreach($akun as $a){
                $id_admin=$a->id_admin;
                $nama=$a->nama_admin;
                $user=$a->username;
                $pass=$a->password;
            }
            $data_session = array(
                            'id_akun'=>$id_admin,
                            'nama_akun'=>$nama,
                            'username'=>$user,
                            'password'=>$pass,
                            'status'=>"login"
                            );
            $this->session->set_userdata($data_session);
            $this->session->set_userdata('pesan_aktifitas','b');
            redirect('dashboard/index');
        }else{
            $this->session->set_userdata('pesan_aktifitas','t');
            redirect('dashboard/index');
        }
    }
    public function logout(){
        $this->session->userdata('username')==' ';
        $this->session->userdata('password')==' ';
        $this->session->userdata('status')==' ';
        $this->session->sess_destroy();
        redirect('login/index');
    }

    
}

?>