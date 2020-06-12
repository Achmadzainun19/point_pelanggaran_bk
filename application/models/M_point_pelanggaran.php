<?php
defined('BASEPATH') or exit('');

class M_point_pelanggaran extends CI_Model{
    
    public function insert($table,$where){
        $this->db->insert($table,$where);
    }
    
    public function update($table,$value,$where){
        $this->db->where($where);
        $this->db->update($table,$value);
    }

    public function delete($table,$where){
        $this->db->delete($table,$where);
    }

    public function select($table,$select,$where,$order,$by){
        $this->db->select($select);
        $this->db->from($table);
        if($where==null){
        }elseif($where!=null){
            $this->db->where($where);
        }
        if($order==null and $by==null){
        }elseif($order!=null and $by!=null){
            $this->db->order_by($order,$by);
        }
        return $this->db->get();
    }

    public function select_siswa($table,$select,$where,$order,$by){
        $this->db->select($select);
        $this->db->from($table);
        if($where==null){
        }elseif($where!=null){
            $this->db->where($where);
        }
        if($order==null and $by==null){
        }elseif($order!=null and $by!=null){
            $this->db->order_by($order,$by);
        }
        return $this->db->get();
    }

    public function select_limit($table,$select,$where,$order,$by,$max_limit){
        $this->db->select($select);
        $this->db->from($table);
        if($where==null){
        }elseif($where!=null){
            $this->db->where($where);
        }
        if($order==null and $by==null){
        }elseif($order!=null and $by!=null){
            $this->db->order_by($order,$by);
        }
        $this->db->limit($max_limit);
        return $this->db->get();
    }

    public function select_group($table,$select,$where,$order,$by,$group,$by1){
        $this->db->select($select);
        $this->db->from($table);
        if($where==null){
        }elseif($where!=null){
            $this->db->where($where);
        }
        if($order==null and $by==null){
        }elseif($order!=null and $by!=null){
            $this->db->order_by($order,$by);
        }
        if($group==null and $by1==null){
        }elseif($group!=null and $by1!=null){
            $this->db->group_by($group,$by1);
        }
        return $this->db->get();
    }

    public function select_sort_2_field($table,$select,$where,$order1,$order2,$by){
        return $this->db->query(
            "SELECT $select FROM $table where $where order by $order1 $by , $order2 $by, tanggal_daftar asc"
        );
        
    }

    public function insert_inven_import($data){
		$this->db->insert_batch('inventaris', $data);
    }

    public function insert_siswa_import($data){
		$this->db->insert_batch('siswa', $data);
    }

    public function insert_guru_import($data){
		$this->db->insert_batch('guru', $data);
    }

    public function insert_validasi_import($data){
		$this->db->insert_batch('validasi', $data);
    }
    
    public function insert_ruang_import($data){
		$this->db->insert_batch('ruangan', $data);
    }
    
    function cari_siswa($query){
        if($query != ''){
        $this->db->select("*");
        $this->db->from("siswa");
        $this->db->like('siswa.nama_siswa', $query);
        $this->db->or_like('siswa.no_induk', $query);
        $this->db->or_like('kelas.nama_kelas', $query);
        $this->db->JOIN("kelas","siswa.id_kelas=kelas.id_kelas","left");
        $this->db->order_by('siswa.id_kelas', 'DESC');
        return $this->db->get();
        }
    
    }

    function cari_pelanggaran($query){
        $this->db->select("*");
        $this->db->from("pelanggaran");
        if($query != ''){
            $this->db->like('pelanggaran.nama_pelanggaran', $query);
            $this->db->or_like('jenis_pelanggaran.nama_jenis_pelanggaran', $query);
            $this->db->JOIN("jenis_pelanggaran","pelanggaran.id_jenis_pelanggaran=jenis_pelanggaran.id_jenis_pelanggaran","left");
            $this->db->order_by('pelanggaran.id_pelanggaran', 'DESC');
            return $this->db->get();
        }else{
            $this->db->JOIN("jenis_pelanggaran","pelanggaran.id_jenis_pelanggaran=jenis_pelanggaran.id_jenis_pelanggaran","left");
            $this->db->order_by('pelanggaran.id_pelanggaran', 'DESC');
            return $this->db->get();
        }
        
    
    }

    function join_siswa_pelanggaran(){
        $this->db->select("siswa.nama_siswa,kelas.nama_kelas,siswa.no_induk,siswa.id_siswa,sum(pelanggaran_siswa.point) as jumlah_point");
        $this->db->from("pelanggaran_siswa");
        $this->db->join('siswa','pelanggaran_siswa.id_siswa=siswa.id_siswa','right');
        $this->db->join('kelas','kelas.id_kelas=siswa.id_kelas','left');
        // $this->db->where("kelas.id_wali_kelas=guru.id_guru and kelas.id_kelas=siswa.id_kelas");
        // $this->db->order_by('siswa.id_kelas','asc');
        $this->db->group_by('siswa.id_siswa','asc');
        return $this->db->get();
    }

    function join_siswa_pelanggaran_custom($id){
        $this->db->select("siswa.nama_siswa,kelas.nama_kelas,siswa.no_induk,siswa.id_siswa,sum(pelanggaran_siswa.point) as jumlah_point");
        $this->db->from("pelanggaran_siswa");
        $this->db->join('siswa','pelanggaran_siswa.id_siswa=siswa.id_siswa','right');
        $this->db->join('kelas','kelas.id_kelas=siswa.id_kelas','left');
        $this->db->where("siswa.id_siswa='$id'");
        // $this->db->order_by('siswa.id_kelas','asc');
        $this->db->group_by('siswa.id_siswa','asc');
        return $this->db->get();
    }

    function join_siswa_pelanggaran_tertinggi($limit){
        $this->db->select("siswa.nama_siswa,siswa.no_induk,kelas.nama_kelas,siswa.id_siswa,sum(pelanggaran_siswa.point) as jumlah_point");
        $this->db->from("pelanggaran_siswa");
        $this->db->join('siswa','pelanggaran_siswa.id_siswa=siswa.id_siswa','right');
        $this->db->join('kelas','kelas.id_kelas=siswa.id_kelas','left');
        $this->db->order_by('jumlah_point','desc');
        $this->db->group_by('siswa.id_siswa','asc');
        $this->db->limit($limit);
        return $this->db->get();
    }

    function join_siswa_pelanggaran_kelas($kelas){
        $this->db->select("siswa.nama_siswa,siswa.no_induk,kelas.nama_kelas,siswa.id_siswa,sum(pelanggaran_siswa.point) as jumlah_point");
        $this->db->from("pelanggaran_siswa");
        $this->db->join('siswa','pelanggaran_siswa.id_siswa=siswa.id_siswa','right');
        $this->db->join('kelas','kelas.id_kelas=siswa.id_kelas','left');
        $this->db->where("siswa.id_kelas='$kelas'");
        // $this->db->where("kelas.id_wali_kelas=guru.id_guru and kelas.id_kelas=siswa.id_kelas and siswa.id_kelas='$kelas'");
        $this->db->order_by('siswa.id_kelas','asc');
        $this->db->group_by('siswa.id_siswa','asc');
        return $this->db->get();
    }
}
?>