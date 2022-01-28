<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Cetak Kartu ID</title>
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">

</head>

<style>
    .box{
        width: 342px;
        height: 220px;
        position: relative;
    }

    .box-back{
        width: 342px;
        height: 220px;
        position: relative;
        margin-left : 20px;
    }

    .text{
        bottom: 35%;
        left: 5%;
        position: absolute;
        color: #000000;
    }

    .text-back{
        bottom: 4%;
        left: 11%;
        position: absolute;
        color: #000000;
    }

    .title-rm{
        color: #332C2B;
        font-size: 12px;
        font-family: Consolas,monaco,monospace; 
    }

    .no-rm{
        font-size: 11px;
        font-weight: bold;
        font-family: Consolas,monaco,monospace; 
    }

    .name{
        font-size: 11px;
        font-weight: bold;
        font-family: Consolas,monaco,monospace; 
    }

    .nik{
        font-size: 11px;
        font-weight: bold;
        font-family: Consolas,monaco,monospace; 
    }

    .buttonDownload{
        margin-top: 475px;
    }

    .buttonDownload-old{
        margin-top: 25px;
    }

    .img-back{
        left: 150%;
        bottom: 100%;
        position: relative;
    }

    .img-back-old{
        left: 150%;
        bottom: 100%;
        position: relative;
    }

    .qr-code{
        bottom: 74%;
        position: absolute;
        color: #000000;
    }
    
    .qr{
        width:16%;
        margin-left:80%;
    }

    .title-header{
        font-family: Consolas,monaco,monospace; 
        font-size: 10px;
    }

    .title-content{
        font-family: Consolas,monaco,monospace; 
        font-size: 8px;
        text-align: justify;
    }
    body{
        display:flex;
        justify-content : center;
        align-items : center;
        height : 100vh;
    }
</style>

<body>
    <div>
    <div class="box">
        <img src="<?php echo base_url() ?>assets/images/kartu_id_pasien/id_pasien.png" alt="">
        <!-- <img src="<?php echo base_url() ?>assets/images/kartu_id_pasien/id_pasien_belakang.png" alt="" class="img-back"> -->
        <div class="text">
            <div class="title-rm">No.RM.</div>
            <?php foreach ($pasien as $data) { ?>
                <div class="no-rm"><?= $data->no_rekam_medis; ?></div>
                <div class="name"><?= $data->nama_lengkap ?></div>
                <div class="nik"><?= $data->nik ?></div>
            <?php } ?>
        </div>
    </div>
    <br>
    <center>
        <a href="" id="download" data-rm="<?= $detail->no_rekam_medis ?>"><button>Download</button></a>
    </center>
    </div>
    <!-- <a href="<?php echo base_url() ?>assets/images/kartu_id_pasien/id_pasien.png" class="btn btn-primary buttonDownload">Download</a> -->
    <div>
    <div class="box-back">
        <img src="<?php echo base_url() ?>assets/images/kartu_id_pasien/id_pasien_belakang.png" alt="">
        <div class="qr-code">
            <img src="<?= base_url()."assets/images/qr_code/".$detail->no_rekam_medis.".png" ?>" alt="" srcset="" class="qr">
        </div>
        <div class="text-back">
            <div class="title-header">Perhatian : </div>
            <div class="title-content">
                Kartu ini adalah milik <b><i>MAHOTTAMA KLINIK UTAMA BEDAH</i></b> dan harus<br>
                dikembalikan jika sewaktu waktu diminta/dipinjam.  Bila kartu<br>
                ini ditemukan harap dikembalikan ke Management <b><i>MAHOTTAMA KLINIK<br> 
                UTAMA BEDAH.</i></b><br>
                Setiap melakukan transaksi, yang bersangkutan harus menunjukkan<br>
                Kartu medis ini dan management tidak bisa melayani semua <br>
                bentuk transaksi bila tidak ada. <br/>
                <br>
                <center>TTD</center>
                <center>Management</center>
            </div>
        </div>
    </div>
    <br>
        <center>
            <a href="" id="download2" data-rm="<?= $detail->no_rekam_medis ?>"><button>Download</button></a>
        </center>
    </div>
    <div id="preview" style="display:none"></div>
    <div id="preview2" style="display:none"></div>
    <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/canvas.js') ?>"></script>

    <script>
        $(document).ready(function(){
            var element = $(".box")
            var element2 = $(".box-back")
            var getCanvas;  
            html2canvas(element, { 
            onrendered: function(canvas) { 
                    $("#preview").append(canvas); 
                    getCanvas = canvas; 
                } 
            }); 
            var getCanvas2;  
            html2canvas(element2, { 
            onrendered: function(canvas) { 
                    $("#preview2").append(canvas); 
                    getCanvas2 = canvas; 
                } 
            }); 
            $("#download").on('click', function() { 
                var imgageData =  
                    getCanvas.toDataURL("image/png",1); 
                var rm = $(this).data('rm')
                // Now browser starts downloading  
                // it instead of just showing it 
                var newData = imgageData.replace( 
                /^data:image\/png/, "data:application/octet-stream"); 
                var fileName = 'ID-RM-'+rm
                $("#download").attr(
                "download", fileName+".png").attr( 
                    "href", newData); 
            });                     
            $("#download2").on('click', function() { 
                var imgageData =  
                    getCanvas2.toDataURL("image/png",1); 
                var rm = $(this).data('rm')
                // Now browser starts downloading  
                // it instead of just showing it 
                var newData = imgageData.replace( 
                /^data:image\/png/, "data:application/octet-stream"); 
                var fileName = 'ID-RM-'+rm
                $("#download2").attr(
                "download", fileName+".png").attr( 
                    "href", newData); 
            });                     
        })
    </script>

</body>

</html>

