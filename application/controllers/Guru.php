<?php
error_reporting(0);
defined('BASEPATH') or exit('');

class Guru extends CI_Controller{


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
        $data['judul_halaman']='Guru';
        $data['guru']=$this->m_point_pelanggaran->select('guru','*','','id_guru','asc')->result();
        $this->load->view('super_admin/header',$data);
        $this->load->view('super_admin/sidebar');
        $this->load->view('super_admin/navbar');
        $this->load->view('super_admin/guru/guru');
        $this->load->view('super_admin/footer');
    }

    public function tambah(){
        $nama=$this->input->post('nama');
        $nip=$this->input->post('nip');
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $mata_pelajaran=$this->input->post('mata_pelajaran');
        $nilai=array(
            'id_guru'=>'',
            'nama_guru'=>$nama,
            'nip'=>$nip,
            'mata_pelajaran'=>$mata_pelajaran,
            'username'=>$username,
            'password'=>$password,
            'status_akun'=>'tidak aktif',
        );
        $this->m_point_pelanggaran->insert('guru',$nilai);
        $this->session->set_userdata('pesan','t');
        redirect('guru');
    }

    public function edit(){
        $id=$this->input->post('id_guru');
        $nama=$this->input->post('nama');
        $nip=$this->input->post('nip');
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $mata_pelajaran=$this->input->post('mata_pelajaran');
        $status_akun=$this->input->post('status_akun');
        $nilai=array(
            'nama_guru'=>$nama,
            'nip'=>$nip,
            'mata_pelajaran'=>$mata_pelajaran,
            'username'=>$username,
            'password'=>$password,
            'status_akun'=>$status_akun,
        );
        $where=array(
            'id_guru'=>$id
        );
        $this->m_point_pelanggaran->update('guru',$nilai,$where);
        $this->session->set_userdata('pesan','e');
        redirect('guru');
    }

    public function hapus(){
        $id=$this->uri->segment('3');
        $where=array(
            'id_guru'=>$id
        );
        $this->m_point_pelanggaran->delete('guru',$where);
        $this->session->set_userdata('pesan','h');
        redirect('guru');
    }

    function get_data_guru_edit(){
        $id_guru = $this->input->get('id');
        $get_guru = $this->m_point_pelanggaran->select('guru','*',"id_guru='$id_guru'",'id_guru','desc')->result();
        echo json_encode($get_guru); 
        
    }

    public function import_data(){
        if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $no=1;
				for($row=3; $row<=$highestRow; $row++)
				{
					$nama_guru = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$nip = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$mata_pelajaran = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $username = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $password = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$data[] = array(
                        "id_guru"=> '',
                        "nama_guru"=>$nama_guru,
                        'nip'=>$nip,
                        'mata_pelajaran'=>$mata_pelajaran,
                        'username'=>$username,
                        'password'=>$password,
                        'status_akun'=>'aktif',
                    );
                    $no++; 
				}
			}
            $this->m_point_pelanggaran->insert_guru_import($data);
            
            $this->session->set_userdata('pesan',"b");
            $this->session->set_userdata('jum_data',"$no");
            redirect('guru/index');
        }
        
    }

    public function download_file(){
        force_download('assets/download/format_import_guru.xlsx',NULL);
        redirect("guru/index");
    }

}
?>