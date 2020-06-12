
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
                            <h3 class="box-title">Form Pencarian Data Siswa</h3>
                            
                                <!-- <div class="form-group">
                                    <label for="email">Nama Siswa / No Induk / Nama Kelas :</label>
                                    <input type="text" class="form-control" name="search_text" id="search_text" required>
                                </div> -->
                                <form action="<?php echo base_url();?>pelanggaran_siswa_guru/cari_kelas" method="post">
                                    <div class="form-group">
                                        <label for="email">Nama Kelas:</label>
                                        <select class="selectpicker form-control" data-live-search="true" name="kelas" required>
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
                                
                                <!-- <button type="submit" class="btn btn-danger">Cari</button> -->
                            
                            <!-- <div id="result"></div> -->
                            <div>
                            <br>
                            <?php
                            // if($this->uri->segment('3')=='cari_kelas'){
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>No Induk</th>
                                        <th>Kelas</th>
                                        <th>Opsi</th>
                                    </tr>
                                    <?php $no=1; foreach($siswa as $row){ ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $row->nama_siswa; ?></td>
                                        <td><?php echo $row->no_induk; ?></td>
                                        <td><?php echo $row->nama_kelas; ?></td>
                                        <td><a href="<?php echo base_url(); ?>pelanggaran_siswa_guru/input_pelanggaran/<?php echo $row->id_siswa; ?>" class="btn btn-danger btn-sm">proses</a></td>
                                    </tr>    
                                    <?php $no++; } ?>       
                                </table>
                            </div>
                            <?php 
                        // } 
                        ?>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2019 &copy; SMKN 1 BANYUWANGI IT DEVELOPMENT </footer>
        </div>



        <!--  -->
        <!-- <script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>pelanggaran_siswa_guru/cari_siswa",
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
</script> -->

        <!--  -->