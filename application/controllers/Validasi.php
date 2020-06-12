<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Validasi extends CI_Controller{


    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('m_inventaris');
        $this->load->library('excel');
        if($this->session->userdata('status')!='login'){
            redirect('login/index');
        }
        
    }

    public function index(){
        $data['judul_halaman']='Validasi';
        $data['ruangan']=$this->m_inventaris->select('ruangan','*','','kode_ruangan','asc')->result();
        $data['validasi']=$this->m_inventaris->select('validasi','*','','no_p2d','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/validasi/data');
        $this->load->view('super_admin/footer');
    }

    public function label(){
        $data['judul_halaman']='Validasi';
        $data['validasi']=$this->m_inventaris->select('validasi','*','','id_validasi','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/validasi/label');
        $this->load->view('super_admin/footer');
    }

    public function print_label(){
        $data['judul_halaman']='Validasi';
        $data['validasi']=$this->m_inventaris->select('validasi','*','','id_validasi','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/validasi/print_label');
        $this->load->view('super_admin/footer');
    }

    public function import(){
        $data['judul_halaman']='Validasi';
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/validasi/import');
        $this->load->view('super_admin/footer');
    }

    public function import_data(){
        $kode_ruang=$this->input->post('kode');
        if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$no_p2d = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$kode_ruang = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$uraian = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$jumlah = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$kode_barang = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $nama_ruangan = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    
                    $data[] = array(
                        "id_validasi"=> '',
                        "no_p2d"=>$no_p2d,
                        "kode_ruang"=>$kode_ruang,
                        "kode_barang"=>$kode_barang,
                        "uraian"=>$uraian,
                        "jumlah"=>$jumlah,
                        'nama_ruangan'=>$nama_ruangan,
					);
				}
			}
            $this->m_inventaris->insert_validasi_import($data);
            $jum_uplod=$this->m_inventaris->select('validasi','*','','id_validasi','desc')->num_rows();
            $this->session->set_userdata('pesan',"b");
            $this->session->set_userdata('jum_data',"$jum_uplod");
            // $this->session->set_userdata('nama_ruang',"$nama_ruangan");
            redirect('validasi/import');
		}
        
    }

}
?>