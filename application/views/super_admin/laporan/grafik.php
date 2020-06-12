
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
                    <div class="col-md-12">
                        <div class="white-box" id="grafik_pengunjung">
                            <button data-toggle="modal" data-target="#search"  class="btn btn-primary">cari grafik</button><br>
                            <div id="container" style="min-width: 310px; height: 400px; padding-top:10px; margin: 0 auto"></div>
                        </div>
                    </div>
                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2019 &copy; SMKN 1 BANYUWANGI IT DEVELOPMENT </footer>
        </div>


        <!-- modal tambah -->
        <div class="modal" id="search">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Cari Grafik</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="<?php echo base_url();?>laporan/cari_grafik" method="post">
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Pelanggaran:</label>
                            <select class="form-control" name="pelanggaran" required>
                                <option value="semua">-- semua pelanggaran --</option>
                                <?php foreach($pelanggaran as $g){ ?>
                                <option value="<?php echo $g->id_pelanggaran; ?>" ><?php echo $g->nama_pelanggaran; ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Tanggal Awal:</label>
                            <input type="date" class="form-control"  name="tanggal_awal" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Point Tinggi:</label>
                            <input type="date" class="form-control"  name="tanggal_akhir" required>
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

        <!-- script chart grafik pengunjung pasien -->
<script>
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Jumlah Siswa Pelanggar Peraturan Sekolah'
        },
        subtitle: {
            text: 'berdasarkan pelanggaran <?php echo $nama_pelanggaran; ?> ( terhitung tanggal <?php echo $keterangan_tanggal; ?> )'
        },
        xAxis: {
            categories: <?php echo $tanggal;?> ,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'pelanggaran'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.f} pelanggaran</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'pelanggaran',
            data: <?php echo $jumlah; ?>       
            
        }]
    });
</script>


