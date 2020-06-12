<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Laporan extends CI_Controller{


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
        $data['judul_halaman']='Laporan';
        $data['ketentuan']=$this->m_point_pelanggaran->select('ketentuan_point','*','','id_ketentuan_point','desc')->result();
        $data['siswa']=$this->m_point_pelanggaran->join_siswa_pelanggaran_tertinggi('10')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/laporan/laporan');
        $this->load->view('super_admin/footer');
    }

    public function grafik(){
        $pelanggaran='';
        $tanggal_awal=date('Y-m-d');
        $tanggal_akhir=date('Y-m-d');
        $tanggal=array();
        $jumlah=array();
        
        
        $where="date(tanggal_pelanggaran) between '$tanggal_awal' and '$tanggal_akhir'";
        $data=$this->m_point_pelanggaran->select('pelanggaran_siswa','date(tanggal_pelanggaran) as tanggal_pelanggaran,count(id_pelanggaran_siswa) as jumlah_pelanggaran',$where,'id_pelanggaran_siswa','desc')->result();
        foreach($data as $d){
            $jum_pelanggaran=$d->jumlah_pelanggaran;
        }
            $tanggal[]=$tanggal_awal;
            $jumlah[]=(int)$jum_pelanggaran;
        
        $data['nama_pelanggaran']='semua pelanggaran';
        if($tanggal_awal==$tanggal_akhir){
            $data['keterangan_tanggal']= "tanggal grafik ".date('d-m-Y',strtotime($tanggal_awal));
        }elseif($tanggal_awal!=$tanggal_akhir){
            $data['keterangan_tanggal']= date('d-m-Y',strtotime($tanggal_awal))." sampai dengan ".date('d-m-Y',strtotime($tanggal_akhir));
            
        }
        $data['tanggal']=json_encode($tanggal);
        $data['jumlah']=json_encode($jumlah);
        $data['pelanggaran']=$this->m_point_pelanggaran->select('pelanggaran,jenis_pelanggaran','*','jenis_pelanggaran.id_jenis_pelanggaran=pelanggaran.id_jenis_pelanggaran','id_pelanggaran','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/laporan/grafik');
        $this->load->view('super_admin/footer');
    }

    public function cari_grafik(){
        $pelanggaran=$this->input->post('pelanggaran');
        $tanggal_awal=$this->input->post('tanggal_awal');
        $tanggal_akhir=$this->input->post('tanggal_akhir');
        $tanggal=array();
        $jumlah=array();
        if($pelanggaran=='semua'){
            for($a=$tanggal_awal; $a<=$tanggal_akhir; $a++){
                $where=" date(tanggal_pelanggaran) between '$a' and '$a'";
                $data=$this->m_point_pelanggaran->select('pelanggaran_siswa','date(tanggal_pelanggaran) as tanggal_pelanggaran,count(id_pelanggaran_siswa) as jumlah_pelanggaran',$where,'id_pelanggaran_siswa','desc')->result();
                foreach($data as $d){
                    $tanggal[]=$a;
                    $jumlah[]=(int)$d->jumlah_pelanggaran;
                }
            }
            $data['nama_pelanggaran']="semua jenis pelanggaran";
        }else{
            for($a=$tanggal_awal; $a<=$tanggal_akhir; $a++){
                $where="id_pelanggaran='$pelanggaran' and date(tanggal_pelanggaran) between '$a' and '$a'";
                $data=$this->m_point_pelanggaran->select('pelanggaran_siswa','date(tanggal_pelanggaran) as tanggal_pelanggaran,count(id_pelanggaran_siswa) as jumlah_pelanggaran',$where,'id_pelanggaran_siswa','desc')->result();
                foreach($data as $d){
                    $tanggal[]=$a;
                    $jumlah[]=(int)$d->jumlah_pelanggaran;
                }
            }
            $where_pelanggaran="id_pelanggaran='$pelanggaran'";
            $dp=$this->m_point_pelanggaran->select('pelanggaran','*',$where_pelanggaran,'id_pelanggaran','desc')->result();
            foreach($dp as $d){
                $nama_pelanggaran=$d->nama_pelanggaran;
            }
            $data['nama_pelanggaran']=$nama_pelanggaran;
        }

        
        if($tanggal_awal==$tanggal_akhir){
            $data['keterangan_tanggal']= "tanggal grafik ".date('d-m-Y',strtotime($tanggal_awal));
        }elseif($tanggal_awal!=$tanggal_akhir){
            $data['keterangan_tanggal']= date('d-m-Y',strtotime($tanggal_awal))." sampai dengan ".date('d-m-Y',strtotime($tanggal_akhir));
            
        }
        $data['tanggal']=json_encode($tanggal);
        $data['jumlah']=json_encode($jumlah);
        $data['pelanggaran']=$this->m_point_pelanggaran->select('pelanggaran,jenis_pelanggaran','*','jenis_pelanggaran.id_jenis_pelanggaran=pelanggaran.id_jenis_pelanggaran','id_pelanggaran','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/laporan/grafik');
        $this->load->view('super_admin/footer');
    }

    public function siswa(){
        $data['judul_halaman']='Laporan';
        $data['ketentuan']=$this->m_point_pelanggaran->select('ketentuan_point','*','','id_ketentuan_point','desc')->result();
        $data['kelas']=$this->m_point_pelanggaran->select('kelas','*','','id_kelas','asc')->result();
        $data['siswa']=$this->m_point_pelanggaran->join_siswa_pelanggaran_tertinggi('10')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/laporan/laporan_siswa');
        $this->load->view('super_admin/footer');
    }


    public function cari_kelas(){
        $kelas=$this->input->post('kelas');
        $data['ketentuan']=$this->m_point_pelanggaran->select('ketentuan_point','*','','id_ketentuan_point','desc')->result();
        $data['kelas']=$this->m_point_pelanggaran->select('kelas','*','','id_kelas','asc')->result();
        $data['siswa']=$this->m_point_pelanggaran->join_siswa_pelanggaran_kelas($kelas)->result();
        $data_kelas=$this->m_point_pelanggaran->select('kelas','*',"id_kelas='$kelas'",'id_kelas','asc')->result();
        foreach($data_kelas as $dk){
            $data['nama_kelas']=$dk->nama_kelas;
        }
        $data['id_kelas']=$kelas;
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/laporan/laporan_siswa');
        $this->load->view('super_admin/footer');
    }

    // public function pelanggaran(){
    //     $data['judul_halaman']='Laporan';
    //     $data['ketentuan']=$this->m_point_pelanggaran->select('ketentuan_point','*','','id_ketentuan_point','desc')->result();
    //     $data['pelanggaran']=$this->m_point_pelanggaran->select('pelanggaran','*','','id_pelanggaran','desc')->result();
    //     $where="kelas.id_kelas=pelanggaran_siswa.id_kelas and siswa.id_siswa=pelanggaran_siswa.id_siswa and pelanggaran_siswa.id_pelanggaran=pelanggaran.id_pelanggaran and date(pelanggaran_siswa.tanggal_pelanggaran) between '".date('Y-m-d')."' and '".date('Y-m-d')."'";
    //     $data['pelanggaran_detail']=$this->m_point_pelanggaran->select('pelanggaran_siswa,siswa,kelas,pelanggaran','*',$where,'pelanggaran_siswa.id_pelanggaran_siswa','desc')->result();
    //     $this->load->view('super_admin/header',$data);
    //     $this->load->view('super_admin/sidebar');
    //     $this->load->view('super_admin/navbar');
    //     $this->load->view('super_admin/laporan/laporan_rekaman_pelanggaran');
    //     $this->load->view('super_admin/footer');
    // }

    public function pelanggaran(){
        $pelanggaran=$_GET['p'];
        $tanggal_awal=$_GET['taw'];
        $tanggal_akhir=$_GET['tak'];
        $tanggal=array();
        $jumlah=array();
        if($pelanggaran=='semua'){
            $where="kelas.id_kelas=pelanggaran_siswa.id_kelas and siswa.id_siswa=pelanggaran_siswa.id_siswa and pelanggaran_siswa.id_pelanggaran=pelanggaran.id_pelanggaran and date(pelanggaran_siswa.tanggal_pelanggaran) between '$tanggal_awal' and '$tanggal_akhir'";
            $data['pelanggaran_detail']=$this->m_point_pelanggaran->select('pelanggaran_siswa,siswa,kelas,pelanggaran','*',$where,'pelanggaran_siswa.id_pelanggaran_siswa','desc')->result();
             
            $data['nama_pelanggaran']="semua jenis pelanggaran";
        }else{
            
            $where="pelanggaran_siswa.id_pelanggaran='$pelanggaran' and kelas.id_kelas=pelanggaran_siswa.id_kelas and siswa.id_siswa=pelanggaran_siswa.id_siswa and pelanggaran_siswa.id_pelanggaran=pelanggaran.id_pelanggaran and date(pelanggaran_siswa.tanggal_pelanggaran) between '$tanggal_awal' and '$tanggal_akhir'";
            $data['pelanggaran_detail']=$this->m_point_pelanggaran->select('pelanggaran_siswa,siswa,kelas,pelanggaran','*',$where,'pelanggaran_siswa.id_pelanggaran_siswa','desc')->result();
                
            $where_pelanggaran="id_pelanggaran='$pelanggaran'";
            $dp=$this->m_point_pelanggaran->select('pelanggaran','*',$where_pelanggaran,'id_pelanggaran','desc')->result();
            foreach($dp as $d){
                $nama_pelanggaran=$d->nama_pelanggaran;
            }
            $data['nama_pelanggaran']=$nama_pelanggaran;
        }

        
        if($tanggal_awal==$tanggal_akhir){
            $data['keterangan_tanggal']= date('d-m-Y',strtotime($tanggal_awal));
        }elseif($tanggal_awal!=$tanggal_akhir){
            $data['keterangan_tanggal']= date('d-m-Y',strtotime($tanggal_awal))." sampai dengan ".date('d-m-Y',strtotime($tanggal_akhir));
            
        }
        $data['gds']=$this->m_point_pelanggaran->select('admin','*',"",'id_admin','desc')->result();
        $data['guru']=$this->m_point_pelanggaran->select('guru','*',"",'id_guru','desc')->result();
        $data['pelanggaran']=$this->m_point_pelanggaran->select('pelanggaran,jenis_pelanggaran','*','jenis_pelanggaran.id_jenis_pelanggaran=pelanggaran.id_jenis_pelanggaran','id_pelanggaran','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/laporan/laporan_rekaman_pelanggaran');
        $this->load->view('super_admin/footer');
    }

}
?>