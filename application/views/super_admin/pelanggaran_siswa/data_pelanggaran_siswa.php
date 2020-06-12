
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Data Pelanggaran Siswa</h4>
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
                            <form action="<?php echo base_url();?>pelanggaran_siswa/cari_kelas" method="post">
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
                            <h3 class="box-title dataTable">Data Pelanggaran Siswa</h3>
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
                                            <th>Nama Siswa</th>
                                            <th>No Induk</th>
                                            <th>Kelas</th>
                                            <th>Jumlah Point</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        foreach($siswa as $k){
                                            if($k->jumlah_point==null or $k->jumlah_point==0){
                                                $jumlah_point=0;
                                            }else{
                                                $jumlah_point=$k->jumlah_point;
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $k->nama_siswa; ?></td>
                                            <td><?php echo $k->no_induk; ?></td>
                                            <td><?php echo $k->nama_kelas; ?></td>
                                            <td><?php echo $jumlah_point; ?></td>
                                            <td>
                                            <a href="<?php echo base_url();?>pelanggaran_siswa/hasil_input/<?php echo $k->id_siswa; ?>" class="btn btn-xs btn-danger">lihat</a>
                                            
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

