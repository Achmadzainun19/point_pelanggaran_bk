<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/plugins/images/favicon.png">
    <title>Ample Admin Template - The Ultimate Multipurpose admin template</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url();?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url();?>assets/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4" style="margin-top:80px; ">
                    <div class="white-box" style="border-top:3px solid #9C27B0; box-shadow: 1px 0px 4px 1px #00000087;">
                        <div class="text-center">
                            <img src="<?php echo base_url();?>assets/smkn1.png" style="width:150px;">
                        </div>
                        <h3 class="box-title" style="font-size:14px; text-align:center; margin-bottom:0px;">SELAMAT DATANG DI LOGIN GURU</h3>
                        <h4 style="font-size:12px; text-align:center; margin:0px; margin-bottom:20px;">APLIKASI REKAM POIN PELANGGARAN SISWA </h4>
                        <div>
                            <!-- <form action="<?php echo base_url(); ?>login_guru/verification" method="post" enctype="multipart/form-data"> -->
                                <?php
                                if($this->session->userdata('pesan_aktifitas')=='t'){
                                ?>
                                <div class="alert alert-danger">
                                    periksa kembali username dan password anda
                                </div>
                                <?php  
                                $this->session->set_userdata('pesan_aktifitas','');
                                }elseif($this->session->userdata('pesan_aktifitas')=='ta'){
                                ?>
                                <div class="alert alert-danger">
                                    status akun anda sedang dinonaktifkan
                                </div>
                                <?php
                                $this->session->set_userdata('pesan_aktifitas','');
                                }
                                ?>
                                
                                <div class="form-group">
                                    <label for="email">Username</label>
                                    <input class="form-control" type="text" required name="username" id="username">
                                </div>
                                <div class="form-group">
                                    <label for="email">Password</label>
                                    <input class="form-control" type="password" required name="password" id="password">
                                </div>
                                <button onclick="login()" class="btn btn-block btn-primary">Login</button>
                                
                            <br>
                            <button onclick="check()" class="btn btn-block btn-danger">Cek Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<body>
<script src="<?php echo base_url();?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
</html>

<script>
function check(){
    var localuser = localStorage.getItem("username");
    var localpw = localStorage.getItem("password");

    if(localuser=='' && localpw==''){
        alert("anda harus memasukkan username dan password");
    } else{
        $.ajax({
            url: '<?php echo base_url(); ?>login_guru/verification',
            type: 'POST',
            // dataType: 'json',
            data: {username:localuser,password:localpw},
            success: function(response){
                window.location.href = "<?php echo base_url();?>/dashboard_guru/";  
            },
            error: function () {
                alert("anda harus memasukkan username dan password");
            },
        })
    }
    
}

function login(){
    var localuser = document.getElementById("username").value;
    var localpw = document.getElementById("password").value;

    if(localuser=='' && localpw=='' ){
        alert("anda harus memasukkan username dan password");
    } else{
        $.ajax({
            url: '<?php echo base_url(); ?>login_guru/verification',
            type: 'POST',
            // dataType: 'json',
            data: {username:localuser,password:localpw},
            success: function(response){
                localStorage.setItem("username", localuser);
                localStorage.setItem("password", localpw);
                window.location.href = "<?php echo base_url();?>/dashboard_guru/";  
            },
            error: function () {
                alert("anda harus memasukkan username dan password");
            },
        })
    }
    
}
</script>