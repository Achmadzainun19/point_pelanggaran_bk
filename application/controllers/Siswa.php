<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Siswa extends CI_Controller{


    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('m_point_pelanggaran');
        $this->load->library('excel');
        if($this->session->userdata('status')!='login'){
            redirect('login/index');
        }
        
    }

    public function index(){
        $data['judul_halaman']='Siswa';
        $data_kelas=$this->m_point_pelanggaran->select('kelas','*','','id_kelas','desc')->result();
        foreach($data_kelas as $dk){
            $id_kelas=$dk->id_kelas;
            $data['nama_kelas']=$dk->nama_kelas;
        }
        $data['siswa']=$this->m_point_pelanggaran->select('kelas,siswa,guru','*',"kelas.id_wali_kelas=guru.id_guru and kelas.id_kelas=siswa.id_kelas and siswa.id_kelas='$id_kelas'",'siswa.id_kelas','asc')->result();
        $data['kelas']=$this->m_point_pelanggaran->select('kelas','*','','id_kelas','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/siswa/siswa');
        $this->load->view('super_admin/footer');
    }

    public function cari_kelas(){
        $kelas=$this->input->post('kelas');
        $data['kelas']=$this->m_point_pelanggaran->select('kelas','*','','id_kelas','asc')->result();
        $data['siswa']=$this->m_point_pelanggaran->select('kelas,siswa,guru','*',"kelas.id_wali_kelas=guru.id_guru and kelas.id_kelas=siswa.id_kelas and siswa.id_kelas='$kelas'",'siswa.id_kelas','asc')->result();
        $data_kelas=$this->m_point_pelanggaran->select('kelas','*',"id_kelas='$kelas'",'id_kelas','asc')->result();
        foreach($data_kelas as $dk){
            $data['nama_kelas']=$dk->nama_kelas;
        }
        $data['id_kelas']=$kelas;
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/siswa/siswa');
        $this->load->view('super_admin/footer');
    }

    public function tambah(){
        $nama=$this->input->post('nama');
        $nis=$this->input->post('nis');
        $alamat=$this->input->post('alamat');
        $kelas=$this->input->post('kelas');
        $tanggal_input=date('Y-m-d H:i:s');
        $nilai=array(
            'id_siswa'=>'',
            'nama_siswa'=>$nama,
            'nis'=>$nis,
            'alamat'=>$alamat,
            'id_kelas'=>$kelas,
            'tanggal_input'=>$tanggal_input
        );
        $this->m_point_pelanggaran->insert('siswa',$nilai);
        $this->session->set_userdata('pesan','t');
        redirect('siswa');
    }

    public function edit(){
        $id=$this->input->post('id_siswa');
        $nama=$this->input->post('nama');
        $nis=$this->input->post('nis');
        $alamat=$this->input->post('alamat');
        $kelas=$this->input->post('kelas');
        $nilai=array(
            'nama_siswa'=>$nama,
            'nis'=>$nis,
            'alamat'=>$alamat,
            'id_kelas'=>$kelas,
        );
        $where=array(
            'id_siswa'=>$id
        );
        $this->m_point_pelanggaran->update('siswa',$nilai,$where);
        $this->session->set_userdata('pesan','e');
        redirect('siswa');
    }

    public function hapus(){
        $id=$this->uri->segment('3');
        $where=array(
            'id_siswa'=>$id
        );
        $this->m_point_pelanggaran->delete('siswa',$where);
        $this->session->set_userdata('pesan','h');
        redirect('siswa');
    }

    public function import_data(){
        $kelas=$this->input->post('kelas');
        if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=3; $row<=$highestRow; $row++)
				{
					$nama_siswa = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$no_induk = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$jenis_kelamin = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$alamat = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$data[] = array(
                        "id_siswa"=> '',
                        "nama_siswa"=>$nama_siswa,
                        'no_induk'=>$no_induk,
                        'alamat'=>$alamat,
                        'jenis_kelamin'=>$jenis_kelamin,
                        'id_kelas'=>$kelas,
                        'tanggal_input'=>date('Y-m-d H:i:s'),
					);
				}
			}
            $this->m_point_pelanggaran->insert_siswa_import($data);
            $where_upload=array(
                'id_kelas'=>$kelas,
            );
            $kelas=$this->m_point_pelanggaran->select('kelas','*',"id_kelas='$kelas'",'id_kelas','desc')->result();
            foreach($kelas as $k){
                $nama_kelas=$k->nama_kelas;
            }
            $jum_uplod=$this->m_point_pelanggaran->select('siswa','*',$where_upload,'id_siswa','desc')->num_rows();
            $this->session->set_userdata('pesan',"b");
            $this->session->set_userdata('jum_data',"$jum_uplod");
            $this->session->set_userdata('nama_kelas',"$nama_kelas");
            redirect('siswa/index');
        }
        
    }

    function get_data_siswa_edit(){
        $id_siswa = $this->input->get('id');
        $get_siswa = $this->m_point_pelanggaran->select_siswa('siswa','*',"id_siswa='$id_siswa'",'id_siswa','desc')->result();
        echo json_encode($get_siswa); 
        
    }

    public function download_file(){
        force_download('assets/download/format_import_siswa.xlsx',NULL);
        redirect("guru/index");
    }

}
?>