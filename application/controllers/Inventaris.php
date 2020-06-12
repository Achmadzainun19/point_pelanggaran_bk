<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Inventaris extends CI_Controller{


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
        $data['judul_halaman']='Inventaris';
        $kode_ruang=$this->uri->segment(3);
        $data['ruangan']=$this->m_inventaris->select('ruangan','*','','kode_ruangan','asc')->result();
        $where_inven=array(
            'kode_ruang'=>$kode_ruang,
        );
        $this->session->set_flashdata('kode_ruang_pilih', $kode_ruang);
        $data['inventaris']=$this->m_inventaris->select('inventaris','*',$where_inven,'no_urut','asc')->result();
        $ruangan=$this->m_inventaris->select('ruangan','*',"kode_ruangan='$kode_ruang'",'id_ruangan','desc')->result();
        foreach($ruangan as $r){
            $nama_ruangan=$r->nama_ruangan;
        }
        $jum_uplod=$this->m_inventaris->select('inventaris','*',$where_inven,'id_inventaris','desc')->num_rows();
        if($this->session->userdata('pesan')!=''){

        }else{
            $this->session->set_userdata('pesan',"b");
        }
        $this->session->set_userdata('jum_data',"$jum_uplod");
        $this->session->set_userdata('nama_ruang',"$nama_ruangan");$this->load->view('super_admin/header',$data);
        
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/inventaris/data');
        $this->load->view('super_admin/footer');
    }

    public function cari_data(){
        $data['judul_halaman']='Inventaris';
        $kode_ruang=$this->input->post('kode');
        $data['ruangan']=$this->m_inventaris->select('ruangan','*','','kode_ruangan','asc')->result();
        $where_inven=array(
            'kode_ruang'=>$kode_ruang,
        );
        $this->session->set_flashdata('kode_ruang_pilih', $kode_ruang);
        $data['inventaris']=$this->m_inventaris->select('inventaris','*',$where_inven,'no_urut','asc')->result();
        $ruangan=$this->m_inventaris->select('ruangan','*',"kode_ruangan='$kode_ruang'",'id_ruangan','desc')->result();
        foreach($ruangan as $r){
            $nama_ruangan=$r->nama_ruangan;
        }
        $jum_uplod=$this->m_inventaris->select('inventaris','*',$where_inven,'id_inventaris','desc')->num_rows();
        $this->session->set_userdata('pesan',"b");
        $this->session->set_userdata('jum_data',"$jum_uplod");
        $this->session->set_userdata('nama_ruang',"$nama_ruangan");$this->load->view('super_admin/header',$data);
        redirect("inventaris/index/".$kode_ruang);
    }

    public function import(){
        $data['judul_halaman']='Inventaris';
        $data['ruangan']=$this->m_inventaris->select('ruangan','*','','kode_ruangan','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/inventaris/import');
        $this->load->view('super_admin/footer');
    }

    public function label(){
        $data['judul_halaman']='Inventaris';
        $data['ruangan']=$this->m_inventaris->select('ruangan','*','','kode_ruangan','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/inventaris/label');
        $this->load->view('super_admin/footer');
    }

    public function cari_data_label(){
        $data['judul_halaman']='Inventaris';
        $kode_ruang=$this->input->post('kode');
        $data['ruangan']=$this->m_inventaris->select('ruangan','*','','kode_ruangan','asc')->result();
        $where_inven=array(
            'kode_ruang'=>$kode_ruang,
        );
        $data['kode_ruang_pilih']=$kode_ruang;
        $data['inventaris']=$this->m_inventaris->select('inventaris','*',$where_inven,'no_urut','asc')->result();
        $ruangan=$this->m_inventaris->select('ruangan','*',"kode_ruangan='$kode_ruang'",'id_ruangan','desc')->result();
        foreach($ruangan as $r){
            $nama_ruangan=$r->nama_ruangan;
        }
        $jum_uplod=$this->m_inventaris->select('inventaris','*',$where_inven,'id_inventaris','desc')->num_rows();
        $this->session->set_userdata('pesan',"b");
        $this->session->set_userdata('jum_data',"$jum_uplod");
        $this->session->set_userdata('nama_ruang',"$nama_ruangan");$this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/inventaris/label');
        $this->load->view('super_admin/footer');
    }

    public function print_label(){
        $data['judul_halaman']='Inventaris';
        $kode_ruang=$this->uri->segment(3);
        $data['ruangan']=$this->m_inventaris->select('ruangan','*','','kode_ruangan','asc')->result();
        $where_inven=array(
            'kode_ruang'=>$kode_ruang,
        );
        $data['kode_ruang_pilih']=$kode_ruang;
        $data['inventaris']=$this->m_inventaris->select('inventaris','*',$where_inven,'no_urut','asc')->result();
        $ruangan=$this->m_inventaris->select('ruangan','*',"kode_ruangan='$kode_ruang'",'id_ruangan','desc')->result();
        foreach($ruangan as $r){
            $nama_ruangan=$r->nama_ruangan;
        }
        $jum_uplod=$this->m_inventaris->select('inventaris','*',$where_inven,'id_inventaris','desc')->num_rows();
        $this->session->set_userdata('pesan',"b");
        $this->session->set_userdata('jum_data',"$jum_uplod");
        $this->session->set_userdata('nama_ruang',"$nama_ruangan");$this->load->view('super_admin/header',$data);
        
        $this->load->view('super_admin/inventaris/print_label',$data);
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
					$nomor_urut = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$kode_bidang = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$nama_barang = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$merek = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$type = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $tahun = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $jumlah = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $kondisi = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $asal = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $nomor_urut_asal = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					$data[] = array(
                        "id_inventaris"=> '',
                        "kode_ruang"=>$kode_ruang,
                        "no_urut"=>$nomor_urut,
                        "kode_bidang"=>$kode_bidang,
                        "uraian_barang"=>$nama_barang,
                        "merek_barang"=>$merek,
                        "type_barang"=>$type,
                        "tahun"=>$tahun,
                        "jumlah"=>$jumlah,
                        "kondisi"=>$kondisi,
                        "asal"=>$asal,
                        "nomor_urut_asal"=>$nomor_urut_asal,
					);
				}
			}
            $this->m_inventaris->insert_inven_import($data);
            $where_upload=array(
                'kode_ruang'=>$kode_ruang,
            );
            $ruangan=$this->m_inventaris->select('ruangan','*',"kode_ruangan='$kode_ruang'",'id_ruangan','desc')->result();
            foreach($ruangan as $r){
                $nama_ruangan=$r->nama_ruangan;
            }
            $jum_uplod=$this->m_inventaris->select('inventaris','*',$where_upload,'id_inventaris','desc')->num_rows();
            $this->session->set_userdata('pesan',"b");
            $this->session->set_userdata('jum_data',"$jum_uplod");
            $this->session->set_userdata('nama_ruang',"$nama_ruangan");
            redirect('inventaris/import');
		}
        
    }

    public function download_format(){
        force_download("excel/format_excel.xlsx",null);
    }

    public function tambah_manual(){
        $kode_ruang=$this->input->post('kode_ruang');
        $nomor_urut = $this->input->post('no_urut');
        $kode_bidang = $this->input->post('kode');
        $nama_barang = $this->input->post('uraian');
        $merek = $this->input->post('merek');
        $type = $this->input->post('type');
        $tahun = $this->input->post('tahun');
        $jumlah = $this->input->post('jumlah');
        $kondisi = $this->input->post('kondisi');
        $asal = $this->input->post('asal');
        $nomor_urut_asal = $this->input->post('nomor_urut_asal');

        $nilai=array(
            "id_inventaris"=> '',
            "kode_ruang"=>$kode_ruang,
            "no_urut"=>$nomor_urut,
            "kode_bidang"=>$kode_bidang,
            "uraian_barang"=>$nama_barang,
            "merek_barang"=>$merek,
            "type_barang"=>$type,
            "tahun"=>$tahun,
            "jumlah"=>$jumlah,
            "kondisi"=>$kondisi,
            "asal"=>$asal,
            "nomor_urut_asal"=>$nomor_urut_asal,
        );
        if($kode_ruang==''){
            $this->session->set_userdata('pesan','gt');
        }elseif($kode_ruang!=''){
            
            $this->m_inventaris->insert('inventaris',$nilai);
            $this->session->set_userdata('pesan','bt');
            $this->session->set_userdata('uraian',$nama_barang);
            $this->session->set_flashdata('kode_ruang_pilih', $kode_ruang);
        }
        redirect("inventaris/index/".$kode_ruang);
					
    }

    public function edit_manual(){
        $id_inventaris=$this->uri->segment('3');
        $kode_ruang=$this->input->post('kode_ruang');
        $nomor_urut = $this->input->post('no_urut');
        $kode_bidang = $this->input->post('kode');
        $nama_barang = $this->input->post('uraian');
        $merek = $this->input->post('merek');
        $type = $this->input->post('type');
        $tahun = $this->input->post('tahun');
        $jumlah = $this->input->post('jumlah');
        $kondisi = $this->input->post('kondisi');
        $asal = $this->input->post('asal');
        $nomor_urut_asal = $this->input->post('nomor_urut_asal');

        $nilai=array(
            "kode_ruang"=>$kode_ruang,
            "no_urut"=>$nomor_urut,
            "kode_bidang"=>$kode_bidang,
            "uraian_barang"=>$nama_barang,
            "merek_barang"=>$merek,
            "type_barang"=>$type,
            "tahun"=>$tahun,
            "jumlah"=>$jumlah,
            "kondisi"=>$kondisi,
            "asal"=>$asal,
            "nomor_urut_asal"=>$nomor_urut_asal,
        );
        $where=array(
            'id_inventaris'=>$id_inventaris,
            'kode_ruang'=>$kode_ruang,
        );
        if($kode_ruang==''){
            $this->session->set_userdata('pesan','gu');
            $this->session->set_userdata('nomor_urut',$no_urut);
        }elseif($kode_ruang!=''){
            $this->m_inventaris->update('inventaris',$nilai,$where);
            $this->session->set_userdata('pesan','bu');
            $this->session->set_userdata('nomor_urut',$nomor_urut);
            $this->session->set_flashdata('kode_ruang_pilih', $kode_ruang);
        }
        redirect("inventaris/index/".$kode_ruang);
					
    }

    public function hapus_manual(){
        $id_inventaris=$this->uri->segment('3');
        $kode_ruang=$this->uri->segment('4');
        $where=array(
            'id_inventaris'=>$id_inventaris,
            'kode_ruang'=>$kode_ruang,
        );
        if($kode_ruang==''){
            $this->session->set_userdata('pesan','gh');
            $this->session->set_userdata('nomor_urut',$no_urut);
        }elseif($kode_ruang!=''){
            $this->m_inventaris->delete('inventaris',$where);
            $this->session->set_userdata('pesan','bh');
            $this->session->set_userdata('nomor_urut',$nomor_urut);
            $this->session->set_flashdata('kode_ruang_pilih', $kode_ruang);
        }
        redirect("inventaris/index/".$kode_ruang);
    }
}

?>