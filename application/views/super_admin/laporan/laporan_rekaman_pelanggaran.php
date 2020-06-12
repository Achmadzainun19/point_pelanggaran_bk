
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
                            <div class="text-center">Laporan Pelanggaran Siswa berdasarkan " <?php echo $nama_pelanggaran; ?>"</div>
                            <div class="text-center">Tertanggal  " <?php echo $keterangan_tanggal; ?>"</div>
                            <div class="box-white">
                                </div>
                                <button data-toggle="modal" data-target="#modal_cari" class="btn btn-primary">cari laporan</button>
                                <div>
                                </div>
                                    <div class="table-responsive" style="padding-top:20px;">
                                        <table class="table" id="datatables8">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Siswa</th>
                                                    <th>No Induk</th>
                                                    <th>Kelas</th>
                                                    <th>Tanggal Pelanggaran</th>
                                                    <th>Pelanggaran</th>
                                                    <th>Nama Pelapor</th>
                                                    <th>Level Pelapor</th>
                                                    <th>Point</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no=1;
                                                foreach($pelanggaran_detail as $p){
                                                    
                                                ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $p->nama_siswa; ?></td>
                                                    <td><?php echo $p->no_induk; ?></td>
                                                    <td><?php echo $p->nama_kelas; ?></td>
                                                    <td><?php echo $p->tanggal_pelanggaran; ?></td>
                                                    <td><?php echo $p->nama_pelanggaran; ?></td>
                                                    <td>
                                                    <?php 
                                                        if($p->level_pelapor=='guru'){
                                                            foreach($guru as $g){
                                                                if($g->id_guru==$p->id_pelapor){
                                                                    echo $g->nama_guru;
                                                                    break;
                                                                }
                                                            }
                                                        }elseif($p->level_pelapor=='gds'){
                                                            foreach($gds as $gd){
                                                                if($gd->id_admin==$p->id_pelapor){
                                                                    echo $g->nama_admin;
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                    </td>
                                                    <td><?php echo $p->level_pelapor; ?></td>
                                                    <td><?php echo $p->point; ?></td>
                                                </tr>
                                                <?php $no++; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2019 &copy; SMKN 1 BANYUWANGI IT DEVELOPMENT </footer>
        </div>



         <!-- modal tambah -->
         <div class="modal" id="modal_cari">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Cari Laporan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo base_url();?>laporan/pelanggaran" method="get">
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Pelanggaran:</label>
                            <select class="form-control" name="p" required>
                                <option value="semua">-- semua pelanggaran --</option>
                                <?php foreach($pelanggaran as $g){ ?>
                                <option value="<?php echo $g->id_pelanggaran; ?>" ><?php echo $g->nama_pelanggaran; ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Tanggal Awal:</label>
                            <input type="date" class="form-control"  name="taw" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Point Tinggi:</label>
                            <input type="date" class="form-control"  name="tak" required>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Cari</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- modal tambah -->

