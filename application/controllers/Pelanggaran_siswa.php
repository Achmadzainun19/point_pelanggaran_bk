<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Pelanggaran_siswa extends CI_Controller{


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
        $data['judul_halaman']='Pelanggaran Siswa';
        // $data['admin']=$this->m_point_pelanggaran->select('admin','*','','id_admin','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/pelanggaran_siswa/cari_siswa');
        $this->load->view('super_admin/footer');
    }

    function cari_siswa(){
        $output = '';
        $query = '';
        if($this->input->post('query'))
        {
        $query = $this->input->post('query');
        }
        $data = $this->m_point_pelanggaran->cari_siswa($query);
        $output .= '
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
            <tr>
            <th>Nama Siswa</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th>Opsi</th>
            </tr>
        ';
        if($data->num_rows() > 0)
        {
        foreach($data->result() as $row)
        {
            $output .= '
            <tr>
            <td>'.$row->nama_siswa.'</td>
            <td>'.$row->nis.'</td>
            <td>'.$row->nama_kelas.'</td>
            <td><a href="'.base_url().'pelanggaran_siswa/input_pelanggaran/'.$row->id_siswa.'" class="btn btn-danger btn-sm">proses</a></td>
            </tr>
            ';
        }
        }
        else
        {
        $output .= '<tr>
            <td colspan="5">Data Tidak Ditemukan</td>
            </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

    public function input_pelanggaran(){
        $data['judul_halaman']='Pelanggaran Siswa';
        $id_siswa=$this->uri->segment('3');
        $data['siswa']=$this->m_point_pelanggaran->select('siswa,kelas','*',"siswa.id_kelas=kelas.id_kelas and siswa.id_siswa='$id_siswa'",'siswa.id_siswa','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/pelanggaran_siswa/input_pelanggaran');
        $this->load->view('super_admin/footer');
    }

    function cari_pelanggaran(){
        $output = '';
        $query = '';
        $id_siswa=$this->uri->segment('3');
        $id_kelas=$this->uri->segment('4');
        if($this->input->post('query'))
        {
        $query = $this->input->post('query');
        }
        $data = $this->m_point_pelanggaran->cari_pelanggaran($query);
        $output .= '
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
            <tr>
            <th>Nama Pelanggaran</th>
            <th>Jenis Pelanggaran</th>
            <th>Point</th>
            <th>Opsi</th>
            </tr>
        ';
        if($data->num_rows() > 0)
        {
        foreach($data->result() as $row)
        {
            $output .= '
            <tr>
            <td>'.$row->nama_pelanggaran.'</td>
            <td>'.$row->nama_jenis_pelanggaran.'</td>
            <td>'.$row->point_pelanggaran.'</td>
            <td><a href="'.base_url().'pelanggaran_siswa/input_pelanggaran_siswa/'.$id_siswa.'/'.$row->id_pelanggaran.'/'.$id_kelas.'/'.$row->point_pelanggaran.'" class="btn btn-danger btn-sm">proses</a></td>
            </tr>
            ';
        }
        }
        else
        {
        $output .= '<tr>
            <td colspan="5">Data Tidak Ditemukan</td>
            </tr>';
        }
        $output .= '</table>';
        echo $output;
    }
    
    public function input_pelanggaran_siswa(){
        $id_siswa=$this->uri->segment('3');
        $id_pelanggaran_siswa=$this->uri->segment('4');
        $id_kelas=$this->uri->segment('5');
        $point=$this->uri->segment('6');
        $nilai=array(
            'id_pelanggaran_siswa'=>'',  
            'id_pelanggaran'=>$id_pelanggaran_siswa,  
            'id_siswa'=>$id_siswa,
            'id_kelas'=>$id_kelas,
            'id_admin'=>$this->session->userdata('id_akun'),
            'tanggal_pelanggaran'=>date('Y-m-d H:i:s'),
            'point'=>$point,
        );
        $tanggal_sekarang=date('Y-m-d');
        $where_cek="id_pelanggaran='$id_pelanggaran_siswa' and tanggal_pelanggaran BETWEEN '$tanggal_sekarang 00:00:00' AND '$tanggal_sekarang 23:59:59' and id_siswa='$id_siswa'";
        $cek_pelanggaran_siswa=$this->m_point_pelanggaran->select('pelanggaran_siswa','*',"$where_cek",'id_pelanggaran_siswa','asc')->num_rows();
        if($cek_pelanggaran_siswa==0){
            $this->m_point_pelanggaran->insert('pelanggaran_siswa',$nilai);
            redirect("pelanggaran_siswa/hasil_input/$id_siswa");
        }elseif($cek_pelanggaran_siswa>0){
            $this->session->set_userdata('pesan','sd');
            redirect("pelanggaran_siswa/input_pelanggaran/$id_siswa");
        }
    
    }
    
    public function hasil_input(){
        $data['judul_halaman']='Pelanggaran Siswa';
        $id_siswa=$this->uri->segment('3');
        $data['siswa']=$this->m_point_pelanggaran->join_siswa_pelanggaran_custom($id_siswa)->result();
        $data['pelanggaran_siswa']=$this->m_point_pelanggaran->select('pelanggaran_siswa,pelanggaran','*',"pelanggaran_siswa.id_pelanggaran=pelanggaran.id_pelanggaran and pelanggaran_siswa.id_siswa='$id_siswa'",'pelanggaran_siswa.id_pelanggaran_siswa','desc')->result();
        $data['ketentuan_point']=$this->m_point_pelanggaran->select('ketentuan_point','*',"",'id_ketentuan_point','desc')->result();
        $data['gds']=$this->m_point_pelanggaran->select('admin','*',"",'id_admin','desc')->result();
        $data['guru']=$this->m_point_pelanggaran->select('guru','*',"",'id_guru','desc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/pelanggaran_siswa/hasil_input_pelanggaran');
        $this->load->view('super_admin/footer');
    }

    public function hapus_pelanggaran(){
        $id_siswa=$this->uri->segment('3');
        $id_pelanggaran=$this->uri->segment('4');
        $where=array(
            'id_pelanggaran_siswa'=>$id_pelanggaran,
        );
        $this->m_point_pelanggaran->delete('pelanggaran_siswa',$where);
        redirect('pelanggaran_siswa/hasil_input/'.$id_siswa);
    }

    public function data_siswa(){
        $data['judul_halaman']='Siswa';
        $data_kelas=$this->m_point_pelanggaran->select('kelas','*','','id_kelas','desc')->result();
        foreach($data_kelas as $dk){
            $id_kelas=$dk->id_kelas;
            $data['nama_kelas']=$dk->nama_kelas;
        }
        $data['siswa']=$this->m_point_pelanggaran->join_siswa_pelanggaran_kelas($id_kelas)->result();
        $data['kelas']=$this->m_point_pelanggaran->select('kelas','*','','id_kelas','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/pelanggaran_siswa/data_pelanggaran_siswa');
        $this->load->view('super_admin/footer');
    }

    public function cari_kelas(){
        $kelas=$this->input->post('kelas');
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
        $this->load->view('super_admin/pelanggaran_siswa/data_pelanggaran_siswa');
        $this->load->view('super_admin/footer');
    }

}

?>