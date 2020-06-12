<?php
defined('BASEPATH') or exit('');

class Login_gds extends CI_Controller{


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
        $this->load->view('gds/login/login');
    }

    public function verification(){
        $where=array(
            'username'=>$this->input->post('username'),
            'password'=>$this->input->post('password'),
            'level_akun'=>'gds'
            );
        $cek=$this->m_point_pelanggaran->select('admin','*',$where,'id_admin','asc')->num_rows();
        
        if($cek > 0){
            $akun=$this->m_point_pelanggaran->select('admin','*',$where,'id_admin','asc')->result();
            foreach($akun as $a){
                $id_gds=$a->id_admin;
                $nama=$a->nama_admin;
                $user=$a->username;
                $pass=$a->password;
                $status_akun=$a->status_akun;
            }
            if($status_akun=='aktif'){
                $data_session = array(
                    'id_akun_gds'=>$id_gds,
                    'nama_akun_gds'=>$nama,
                    'username_gds'=>$user,
                    'password_gds'=>$pass,
                    'status_gds'=>"login"
                    );
                $this->session->set_userdata($data_session);
                $this->session->set_userdata('pesan_aktifitas','b');
                redirect('dashboard_gds/index');
            }else{
                $this->session->set_userdata('pesan_aktifitas','ta');
                redirect('dashboard_gds/index');
            }
        }else{
            $this->session->set_userdata('pesan_aktifitas','t');
            redirect('dashboard_gds/index');
        }
    }
    public function logout(){
        $this->session->userdata('username_gds')==' ';
        $this->session->userdata('password_gds')==' ';
        $this->session->userdata('status_gds')==' ';
        $this->session->sess_destroy();
        redirect('login_gds/index');
    }

    
}

?>