
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
                            <h3 class="box-title">Form Input  Data Pelanggaran Siswa</h3>
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
                                }elseif($this->session->userdata('pesan')=='sd'){
                                    $pesan="pelanggaran sudah terdaftar pada tanggal sekarang";
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
                                        Nama Siswa : <?php echo $s->nama_siswa; ?><br>
                                        NIS Siswa : <?php echo $s->nis; ?><br>
                                        Kelas Siswa : <?php echo $s->nama_kelas; ?><br>

                                        <?php } ?>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="email">Masukkan Kata Kunci Pelanggaran Siswa :</label>
                                    <input type="text" class="form-control" name="search_text" id="search_text" required>
                                </div>
                                <!-- <button type="submit" class="btn btn-danger">Cari</button> -->
                            
                            <div id="result"></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2019 &copy; SMKN 1 BANYUWANGI IT DEVELOPMENT </footer>
        </div>



        <!--  -->
        <script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>pelanggaran_siswa_gds/cari_pelanggaran/<?php echo $this->uri->segment('3');?>/<?php echo $id_kelas; ?>",
   method:"POST",
   data:{query:query},
   success:function(data){
    $('#result').html(data);
   }
  })
 }

 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>

        <!--  -->