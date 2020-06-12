
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Siswa</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title dataTable">Cari Kelas</h3>
                            <form action="<?php echo base_url();?>siswa/cari_kelas" method="post">
                                <div class="form-group">
                                    <label for="email">Nama Kelas:</label>
                                    <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" name="kelas" required>
                                        <option>-- pilih kelas --</option>
                                        <?php foreach($kelas as $k){ ?>
                                        <option  value="<?php echo $k->id_kelas; ?>" ><?php echo $k->nama_kelas; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div>
                                <button type="submit" class="btn btn-danger">Cari</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-sm-12 data-tables">
                        <div class="white-box">
                            <h3 class="box-title dataTable">Data Siswa</h3>
                            <button data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-danger">Tambah</button>
                            <button data-toggle="modal" data-target="#import" class="btn btn-sm btn-danger">Import data</button>
                            <a href="<?php echo base_url();?>siswa/download_file" class="btn btn-sm btn-danger">Download Format Import data</a>
                            <?php
                            if($this->session->userdata('pesan')==true){
                                if($this->session->userdata('pesan')=='t'){
                                    $pesan="data berhasil ditambahkan";
                                    $warna="alert-success";
                                    $this->session->set_userdata('pesan','');
                                }elseif($this->session->userdata('pesan')=='e'){
                                    $pesan="data berhasil diedit";
                                    $warna="alert-success";
                                    $this->session->set_userdata('pesan','');
                                }elseif($this->session->userdata('pesan')=='h'){
                                    $pesan="data berhasil dihapus";
                                    $warna="alert-success";
                                    $this->session->set_userdata('pesan','');
                                }elseif($this->session->userdata('pesan')=='b'){
                                    $pesan=$this->session->userdata('jum_data')." siswa kelas ".$this->session->userdata('nama_kelas')." berhasil diupload ";
                                    $warna="alert-success";
                                    $this->session->set_userdata('pesan','');
                                    $this->session->set_userdata('jum_data','');
                                    $this->session->set_userdata('nama_kelas','');
                                }
                            ?>
                            <br>
                            <div class="alert <?php echo $warna; ?> alert-dismissible" style="margin-top:10px;">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo $pesan; ?>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="table-responsive" style="padding-top:20px;">
                                <table class="table" id="datatables8">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>No Induk</th>
                                            <th>Kelas</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Input</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        foreach($siswa as $k){
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $k->nama_siswa; ?></td>
                                            <td><?php echo $k->no_induk; ?></td>
                                            <td><?php echo $k->nama_kelas; ?></td>
                                            <td><?php echo $k->jenis_kelamin; ?></td>
                                            <td><?php echo date('d F Y',strtotime($k->tanggal_input)); ?></td>
                                            <td>
                                            <a href="<?php echo base_url();?>siswa/hapus/<?php echo $k->id_siswa; ?>" class="btn btn-xs btn-danger">hapus</a>
                                            <button class="btn btn-xs btn-warning view_detail" relid="<?php echo $k->id_siswa;  ?>">edit</button>
                                            </td>
                                        </tr>
                                        <?php $no++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2019 &copy; SMKN 1 BANYUWANGI IT DEVELOPMENT </footer>
        </div>

        <!-- modal tambah -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Siswa</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo base_url();?>/siswa/tambah" method="post">
                <!-- Modal body -->
                    <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="email">Nama Siswa :</label>
                            <input type="text" class="form-control" id="" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="email">NIS :</label>
                            <input type="text" class="form-control" id="" name="nis" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Alamat :</label>
                            <input type="text" class="form-control" id="" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Jenis Kelamin :</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="L">LAKI - LAKI</option>
                                <option value="P">PEREMPUAN</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Kelas :</label>
                            <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="kelas" required>
                                <option>-- pilih kelas --</option>
                                <?php foreach($kelas as $k){ ?>
                                <option data-subtext="<?php echo $k->nama_kelas; ?>" value="<?php echo $k->id_kelas; ?>" ><?php echo $k->nama_kelas; ?></option>
                                <?php }?>
                            </select>
                        </div>
                        
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- modal tambah -->

        <!-- modal import -->
        <div class="modal" id="import">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Import Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo base_url();?>siswa/import_data" method="post" enctype="multipart/form-data">
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Kelas :</label>
                            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="kelas" required>
                                <option>-- pilih kelas --</option>
                                <?php 
                                foreach($kelas as $k){ 
                                    $where="id_kelas='$k->id_kelas'";
                                    $data=$this->m_point_pelanggaran->select('siswa','*',$where,'id_kelas','desc')->num_rows();
                                
                                ?>
                                <option  value="<?php echo $k->id_kelas; ?>" ><?php echo $k->nama_kelas; ?> ( <?php echo $data; ?> )</option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">File  :</label>
                            <input type="file" class="form-control"  name="file" required>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- modal import -->

        <?php
        // $no=1;
        // foreach($siswa as $s){
        ?>
         <!-- modal tambah -->
         <div class="modal" id="modal_edit">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Siswa</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo base_url();?>/siswa/edit" method="post">
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Nama Siswa :</label>
                            <input type="hidden" class="form-control" id="id_siswa"  name="id_siswa" required>
                            <input type="text" class="form-control" id="nama"  name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="email">NIS :</label>
                            <input type="text" class="form-control" id="nis"  name="nis" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Alamat :</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Jenis Kelamin :</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                <option value="L">LAKI - LAKI</option>
                                <option value="P">PEREMPUAN</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Kelas :</label> 
                            <select class="form-control" name="kelas" id="kelas" required>
                                <option>-- pilih kelas --</option>
                                <?php foreach($kelas as $k){ ?>
                                <option value="<?php echo $k->id_kelas; ?>" <?php if($s->id_kelas==$k->id_kelas){ echo "selected";} ?>><?php echo $k->nama_kelas; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- modal tambah -->
        <?php  
        // $no++; } 
        ?>



<script type="text/javascript">
// load data for edit
    $(document).ready(function() {
        $('.view_detail').click(function(){
            var id = $(this).attr('relid'); //get the attribute value
            $.ajax({
                url : "<?php echo base_url(); ?>siswa/get_data_siswa_edit",
                data:{id : id},
                method:'GET',
                dataType:'json',
                success:function(response) {
                $.each(response, function(i, item){
                    $('#id_siswa').val(response[i].id_siswa);
                    $('#nama').val(response[i].nama_siswa); //hold the response in id and show on popup
                    $('#nis').val(response[i].nis);
                    $('#alamat').val(response[i].alamat);
                    $('#kelas').val(response[i].id_kelas);
                    $('#jenis_kelamin').val(response[i].jenis_kelamin);
                    $('#modal_edit').modal({backdrop: 'static', keyboard: true, show: true});
                });
            }
            });
        });
    });
</script>