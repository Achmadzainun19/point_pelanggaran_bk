
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Guru</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12 data-tables">
                        <div class="white-box">
                            <h3 class="box-title dataTable">Data Guru</h3>
                            <button data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-danger">Tambah</button>
                            <button data-toggle="modal" data-target="#import" class="btn btn-sm btn-danger">Import data</button>
                            <a href="<?php echo base_url();?>guru/download_file" class="btn btn-sm btn-danger">Download Format Import data</a>
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
                                    $jum_upload=$this->session->userdata('jum_data');
                                    $pesan=$jum_upload." data berhasil ditambahkan";
                                    $warna="alert-success";
                                    $this->session->set_userdata('pesan','');
                                    $this->session->set_userdata('jum_data','');
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
                                            <th>Nama Guru</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Username</th>
                                            <th>NIP</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        foreach($guru as $g){
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $g->nama_guru; ?></td>
                                            <td><?php echo $g->mata_pelajaran; ?></td>
                                            <td><?php echo $g->username; ?></td>
                                            <td><?php echo $g->nip; ?></td>
                                            <td>
                                            <a href="<?php echo base_url();?>guru/hapus/<?php echo $g->id_guru; ?>" class="btn btn-xs btn-danger">hapus</a>
                                            <button class="btn btn-xs btn-warning view_detail" relid="<?php echo $g->id_guru;  ?>">edit</button>
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
                    <h4 class="modal-title">Tambah Guru</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo base_url();?>/guru/tambah" method="post">
                <!-- Modal body -->
                    <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="email">Nama Guru:</label>
                            <input type="text" class="form-control" id="" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="email">NIP:</label>
                            <input type="text" class="form-control" id="" name="nip" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Mata Pelajaran:</label>
                            <input type="text" class="form-control" id="" name="mata_pelajaran" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Username:</label>
                            <input type="text" class="form-control" id="" name="usename" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Password:</label>
                            <input type="text" class="form-control" id="" name="password" required>
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

        
         <!-- modal edit -->
         <div class="modal" id="modal_edit">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Guru</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo base_url();?>/guru/edit" method="post">
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Nama Guru:</label>
                            <input type="hidden" class="form-control" id="id_guru" name="id_guru" required>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="email">NIP:</label> 
                            <input type="text" class="form-control" id="nip" name="nip" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Mata Pelajaran:</label> 
                            <input type="text" class="form-control" id="matapelajaran" name="mata_pelajaran" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Password:</label>
                            <input type="text" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Status Akun:</label>
                            <select name="status_akun" id="status_akun" class="form-control" required>
                                <option value="aktif" >aktif</option>
                                <option value="tidak aktif">tidak aktif</option>
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
        <!-- modal edit -->

        <div class="modal" id="import">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Import Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo base_url();?>guru/import_data" method="post" enctype="multipart/form-data">
                <!-- Modal body -->
                    <div class="modal-body">
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


<script type="text/javascript">
// load data for edit
    $(document).ready(function() {
        $('.view_detail').click(function(){
            var id = $(this).attr('relid'); //get the attribute value
            $.ajax({
                url : "<?php echo base_url(); ?>guru/get_data_guru_edit",
                data:{id : id},
                method:'GET',
                dataType:'json',
                success:function(response) {
                $.each(response, function(i, item){
                    $('#id_guru').val(response[i].id_guru);
                    $('#nama').val(response[i].nama_guru); //hold the response in id and show on popup
                    $('#nip').val(response[i].nip);
                    $('#matapelajaran').val(response[i].mata_pelajaran);
                    $('#username').val(response[i].username);
                    $('#password').val(response[i].password);
                    $('#status_akun').val(response[i].status_akun);
                    $('#modal_edit').modal({backdrop: 'static', keyboard: true, show: true});
                });
            }
            });
        });
    });
</script>
       