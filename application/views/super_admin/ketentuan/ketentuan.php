
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Ketentuan Point Pelanggaran</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12 data-tables">
                        <div class="white-box">
                            <h3 class="box-title dataTable">Data Ketentuan Point</h3>
                            <button data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-danger">Tambah</button>
                            <!-- <a href="<?php echo base_url();?>ruangan/import" class="btn btn-sm btn-danger">Import</a> -->
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
                                            <th>Nama Ketentuan</th>
                                            <th>Point Rendah</th>
                                            <th>Point Tinggi</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        foreach($ketentuan as $k){
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $k->nama_ketentuan; ?></td>
                                            <td><?php echo $k->point_pelanggaran_rendah; ?></td>
                                            <td><?php echo $k->point_pelanggaran_tinggi; ?></td>
                                            <td>
                                            <a href="<?php echo base_url();?>ketentuan/hapus/<?php echo $k->id_ketentuan_point; ?>" class="btn btn-xs btn-danger">hapus</a>
                                            <button class="btn btn-xs btn-warning view_detail" relid="<?php echo $k->id_ketentuan_point; ?>">edit</button>
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
                    <h4 class="modal-title">Tambah Ketentuan Point</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo base_url();?>/ketentuan/tambah" method="post">
                <!-- Modal body -->
                    <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="email">Nama Ketentuan Pelanggaran:</label>
                            <input type="text" class="form-control" id="" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Point Rendah:</label>
                            <input type="number" class="form-control" id="" name="point_rendah" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Point Tinggi:</label>
                            <input type="number" class="form-control" id="" name="point_tinggi" required>
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

        
         <!-- modal tambah -->
         <div class="modal" id="modal_edit">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Ketentuan Point</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo base_url();?>/ketentuan/edit" method="post">
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Nama Ketentuan Pelanggaran:</label>
                            <input type="text" class="form-control" id="nama" name="nama"  required>
                            <input type="hidden" class="form-control" id="id_ketentuan" name="id_ketentuan" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Point Rendah:</label>
                            <input type="number" class="form-control" id="point_rendah" name="point_rendah" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Point Tinggi:</label>
                            <input type="number" class="form-control" id="point_tinggi" name="point_tinggi" required>
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


        <script type="text/javascript">
// load data for edit
    $(document).ready(function() {
        $('.view_detail').click(function(){
            var id = $(this).attr('relid'); //get the attribute value
            $.ajax({
                url : "<?php echo base_url(); ?>ketentuan/get_data_ketentuan_edit",
                data:{id : id},
                method:'GET',
                dataType:'json',
                success:function(response) {
                $.each(response, function(i, item){
                    $('#id_ketentuan').val(response[i].id_ketentuan_point);
                    $('#nama').val(response[i].nama_ketentuan);
                    $('#point_rendah').val(response[i].point_pelanggaran_rendah);
                    $('#point_tinggi').val(response[i].point_pelanggaran_tinggi);
                    $('#modal_edit').modal({backdrop: 'static', keyboard: true, show: true});
                });
            }
            });
        });
    });
</script>