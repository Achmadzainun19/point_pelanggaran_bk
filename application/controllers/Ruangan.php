<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Ruangan extends CI_Controller{


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
        $data['judul_halaman']='Ruangan';
        $data['ruangan']=$this->m_inventaris->select('ruangan','*','','kode_ruangan','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/ruangan/ruangan');
        $this->load->view('super_admin/footer');
    }

    public function import(){
        $data['judul_halaman']='Ruangan';
        $data['ruangan']=$this->m_inventaris->select('ruangan','*','','kode_ruangan','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/ruangan/import');
        $this->load->view('super_admin/footer');
    }

    public function tambah(){
        $kode=$this->input->post('kode');
        $nama=$this->input->post('nama');
        $nilai=array(
            'id_ruangan'=>'',
            'kode_ruangan'=>$kode,
            'nama_ruangan'=>$nama
        );
        $this->m_inventaris->insert('ruangan',$nilai);
        $this->session->set_userdata('pesan','t');
        redirect('ruangan');
    }

    public function edit(){
        $id=$this->uri->segment('3');
        $kode=$this->input->post('kode');
        $nama=$this->input->post('nama');
        $nilai=array(
            'kode_ruangan'=>$kode,
            'nama_ruangan'=>$nama
        );
        $where=array(
            'id_ruangan'=>$id
        );
        $this->m_inventaris->update('ruangan',$nilai,$where);
        $this->session->set_userdata('pesan','e');
        redirect('ruangan');
    }

    public function hapus(){
        $id=$this->uri->segment('3');
        $where=array(
            'id_ruangan'=>$id
        );
        $this->m_inventaris->delete('ruangan',$where);
        $this->session->set_userdata('pesan','h');
        redirect('ruangan');
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
				for($row=12; $row<=$highestRow; $row++)
				{
					$kode_ruang = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$nama_ruang = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					
					$data[] = array(
                        "id_ruangan"=> '',
                        "kode_ruangan"=>$kode_ruang,
                        "nama_ruangan"=>$nama_ruang,
					);
				}
			}
            $this->m_inventaris->insert_ruang_import($data);
            
            $jum_uplod=$this->m_inventaris->select('ruangan','*','','id_ruangan','desc')->num_rows();
            $this->session->set_userdata('pesan',"b");
            $this->session->set_userdata('jum_data',"$jum_uplod");
            redirect('ruangan/import');
		}
        
    }

    public function download_format(){
        force_download("excel/data_ruang.xlsx",null);
    }
}

?>