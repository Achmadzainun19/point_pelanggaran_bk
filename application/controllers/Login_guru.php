<?php
defined('BASEPATH') or exit('');

class Login_guru extends CI_Controller{


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
        $this->load->view('guru/login/login');
    }

    public function verification(){
        $where=array(
            'username'=>$this->input->post('username'),
            'password'=>$this->input->post('password')
            );
        $cek=$this->m_point_pelanggaran->select('guru','*',$where,'id_guru','asc')->num_rows();
        
        if($cek > 0){
            $akun=$this->m_point_pelanggaran->select('guru','*',$where,'id_guru','asc')->result();
            foreach($akun as $a){
                $id_guru=$a->id_guru;
                $nama=$a->nama_guru;
                $user=$a->username;
                $pass=$a->password;
                $status_akun=$a->status_akun;
            }
            if($status_akun=='aktif'){
                $data_session = array(
                    'id_akun_guru'=>$id_guru,
                    'nama_akun_guru'=>$nama,
                    'username_guru'=>$user,
                    'password_guru'=>$pass,
                    'status_guru'=>"login"
                    );
                $this->session->set_userdata($data_session);
                $this->session->set_userdata('pesan_aktifitas','b');
                redirect('dashboard_guru/index');
            }else{
                $this->session->set_userdata('pesan_aktifitas','ta');
                redirect('dashboard_guru/index');
            }
        }else{
            $this->session->set_userdata('pesan_aktifitas','t');
            redirect('dashboard_guru/index');
        }
    }
    public function logout(){
        $this->session->userdata('username_guru')==' ';
        $this->session->userdata('password_guru')==' ';
        $this->session->userdata('status_guru')==' ';
        $this->session->sess_destroy();
        redirect('login_guru/index');
    }

    
}

?>