
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Pelanggaran Siswa</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row ">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="white-box">
                            <h3 class="box-title">Review Data Pelanggaran Siswa</h3>
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
                                <div>
                                    <p>
                                        <?php 
                                        foreach($siswa as $s){
                                            $id_kelas=$s->id_kelas;
                                        ?>
                                        <?php
                                            foreach($ketentuan_point as $kp){
                                                if($s->total_point>=$kp->point_pelanggaran_rendah and $s->total_point<=$kp->point_pelanggaran_tinggi){
                                                    $ketentuan=$kp->nama_ketentuan;
                                                }
                                            }
                                        ?>
                                        Nama Siswa : <?php echo $s->nama_siswa; ?><br>
                                        NIS Siswa : <?php echo $s->nis; ?><br>
                                        Kelas Siswa : <?php echo $s->nama_kelas; ?><br>
                                        Total Point Pelanggaran : <?php echo $s->total_point; ?><br>
                                        Keputusan Pelanggaran : diberikan <?php echo $ketentuan; ?>
                                        <?php } ?>
                                    </p>
                                </div>
                               <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggaran</th>
                                    <th>Tanggal Pelanggaran</th>
                                    <th>Nama Pelapor</th>
                                    <th>Level Pelapor</th>
                                    <th>Point</th>
                                    <th>Opsi</th>
                                    </tr>
                                    <?php
                                        $no=1;
                                        foreach($pelanggaran_siswa as $ps){    
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $ps->nama_pelanggaran;?></td>
                                            <td><?php echo date('d F Y',strtotime($ps->tanggal_pelanggaran)); ?></td>
                                            <td>
                                            <?php 
                                                if($ps->level_pelapor=='guru'){
                                                    foreach($guru as $g){
                                                        if($g->id_guru==$ps->id_pelapor){
                                                            echo $g->nama_guru;
                                                            break;
                                                        }
                                                    }
                                                }elseif($ps->level_pelapor=='gds'){
                                                    foreach($gds as $gd){
                                                        if($gd->id_admin==$ps->id_pelapor){
                                                            echo $g->nama_admin;
                                                            break;
                                                        }
                                                    }
                                                }
                                            ?>
                                            </td>
                                            <td><?php echo $ps->level_pelapor; ?></td>
                                            <td><?php echo $ps->point; ?></td>
                                            <td>
                                            <?php
                                            if($ps->id_pelapor==$this->session->userdata('id_akun_gds') and $ps->level_pelapor=='gds'){
                                            ?>
                                            <a href="<?php echo base_url();?>pelanggaran_siswa_gds/hapus_pelanggaran/<?php echo $this->uri->segment('3');?>/<?php echo $ps->id_pelanggaran_siswa; ?>" class="btn btn-xs btn-danger">hapus</a>
                                            <?php  
                                            }else{
                                            echo '';
                                            }
                                            ?>
                                                
                                            </td>
                                        </tr>
                                    <?php $no++; } ?>
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

