
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Pelanggaran</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12 data-tables">
                        <div class="white-box">
                            <h3 class="box-title dataTable">Tentang Kami</h3>
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
                            <?php
                            }
                            ?>
                            <div>
                                <p>
                                versi aplikasi 1.0 beta dan merupakan aplikasi yang masih dalam tahap pengembangan. harap bersabar kami akan hadir dengan tampilkan yang expresif dan komunikatif untuk anda<br>
                                masukkan saran pengembangan untuk aplikasi ini 
                                </p>
                                <?php foreach($tentang_kami as $tk){ 
                                ?>
                                <form action="<?php echo base_url();?>/tentang_kami/edit/<?php echo $tk->id_tentang_kami; ?>" method="post">
                                
                                    <div class="">
                                        <div class="form-group">
                                            <label for="email">Saran dan Pengembangan:</label>
                                            <textarea class="form-control" row="10" name="deskripsi" required><?php echo $tk->deskripsi; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </form>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2019 &copy; SMKN 1 BANYUWANGI IT DEVELOPMENT </footer>
        </div>