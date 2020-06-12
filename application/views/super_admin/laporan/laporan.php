
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Laporan</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                <div  class="col-sm-12" style="padding-bottom:20px;">
                <a href="<?php echo base_url();?>laporan/index" class="btn btn-danger">10 siswa point tertinggi</a>
                <a href="<?php echo base_url();?>laporan/siswa" class="btn btn-success">laporan rekap siswa</a>
                <a href="<?php echo base_url();?>laporan/grafik" class="btn btn-warning">grafik pelanggaran</a>
                <a href="<?php echo base_url();?>laporan/pelanggaran?p=semua&taw=<?php echo date('Y-m-d');?>&tak=<?php echo date('Y-m-d');?>" class="btn btn-info">laporan pelanggaran</a>
                </div>
                    <div class="col-sm-12 data-tables">
                        <div class="white-box">
                            <h3 class="box-title dataTable">Laporan Pelanggaran Siswa</h3>
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
                            <div class="text-center">10 Siswa dengan Point Pelanggaran Tertinggi</div>
                            <div class="table-responsive" style="padding-top:20px;">
                                <table class="table" id="datatables8">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>No Induk</th>
                                            <th>Kelas</th>
                                            <th>Jumlah Point</th>
                                            <th>Keputusan</th>
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
                                                <?php
                                                foreach($ketentuan as $kp){
                                                    if($jumlah_point>=$kp->point_pelanggaran_rendah and $jumlah_point<=$kp->point_pelanggaran_tinggi){ 
                                                        echo $kp->nama_ketentuan;
                                                    }else{
                                                        echo " ";
                                                    }
                                                }
                                                ?>
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

