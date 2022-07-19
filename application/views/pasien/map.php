<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAP</title>
</head>
<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap');
        body{
            font-family: "Poppins", sans-serif;
        }
        .row{
            display:flex;
        }
        .row .item{
            width : 816.20409449px;
            height : 1141.9653543px;
            position:relative;
        }
        /* Create two unequal columns that floats next to each other */
        .column {
            float: left;
            /* padding: 10px; */
            height: 1141.9653543px; /* Should be removed. Only for demonstration */
        }

        .left {
            width: 50%;
        }

        .right {
            width: 50%;
        }
        .box-paper{
            width : 1.632.5px;
            height : 1141.9653543px;
        }
        /* Clear floats after the columns */
    
        .map-bottom{
            width : 816.20409449px;
            height : 1141.9653543px;
            display:flex;
            align-items:end;
        }
        .map-box{
            margin : auto;
            width : 816.20409449px;
            height : 1141.9653543px;
            background : url('<?= base_url()."assets/images/map-rm-bg.png" ?>');
            background-size : cover;
            position : absolute;
        }

        .img-back{
            position: absolute; 
            margin: auto;
            bottom: 0; 
            right: 0;
            width : 816.2px;
            height : 476.31px;
        }
        .map-box-back{
            margin : auto;
            width : 816.20409449px;
            height : 1141.9653543px;
            right: 50%;
            position: absolute;
            background-color: white;
        }
        .body{
            width : 100%;
            height : 55%;
            position : absolute;
            bottom : 0;
        }
        .body .top{
            width : 100%;
            height : 80%;
            display : flex;
        }
        .body .top .left{
            width : 30%;
            position : relative;
        }
        .body .top .left .content{
            width : 98%;
            height : 100%;
            position : absolute;
            z-index : 2;
        }
        .body .top .left .content .content-top{
            text-align : right;
            height : 70%;
        }
        .body .top .left .content .content-top p{
            color : #214193;
            margin-top : 5%;
            margin-bottom : 5%;
            font-weight : 600;
            font-size : 21px;
        }
        .body .top .left .content .content-bottom{
            height : 30%;
            padding-left : 9%;
        }
        .body .top .left .content .content-bottom p{
            color : #de302b;
            font-weight : 800;
            font-size : 20px;
            margin : 0px;
        }
        .body .top .left .content .content-bottom .output-alergi{
            height : 50%;
            border : 3px solid #f69200;
            border-radius : 10px;
            padding : 7px;
            word-wrap : break-word;
            font-size : 13px;
        }
        .body .top .center{
            width : 50%;
            padding-left : 5%;
            padding-right : 5%;
        }
        .body .top .center .output{
            margin-top : 3%;
            margin-bottom : 3%;
            display : block;
            background : white;
            transform: skew(-20deg);
            -webkit-transform: skew(-20deg);
            -o-transform: skew(-20deg);
            -moz-transform: skew(-20deg);
            display : flex;
            align-items : center;
            height : 30px;
            padding-left : 10px;
            border : 1px solid #ddd;
        }
        .body .top .right{
            width : 20%;
        }
        .body .top .bg-left{
            background-image: linear-gradient(to top, rgb(104, 251, 27,0.9), rgb(255,255,255,0.5));
            -webkit-background-image: linear-gradient(to top, #68FB1B, #fdfdfb);
            width : 30%;
            height : 100%;
            position : absolute;
            z-index : 1;
        }
        .body .top .bg-left .border-left{
            position : absolute;
            right : 0px;
            height : 100%;
            width : 3%;
            background : #4a5449;
        }
        .body .top .bg-left .border-left::before,.body .top .bg-left .border-left::after{
            content : "";
            top : 0;
            width : 40%;
            height : 100%;
            position : absolute;
            background : #8a8e86;
        }
        .body .top .bg-left .border-left::before{
            left : 0px;
            transform : translateX(-50%);
            -webkit-transform : translateX(-50%);
            -moz-transform : translateX(-50%);
            -o-transform : translateX(-50%);
        }
        .body .top .bg-left .border-left::after{
            transform : translateX(50%);
            -webkit-transform : translateX(50%);
            -moz-transform : translateX(50%);
            -o-transform : translateX(50%);
            right : 0px;
        }
        .body .bottom{
            width : 100%;
            height : 20%;
            background : rgb(255,255,255,0.8);
            z-index : 2;
            border-top : 5px solid #b9b8b9;
            position : absolute;
            display : flex;
        }
        .body .bottom .left{
            width : 40%;
            padding : 2%;
            font-weight : 600;
            display : flex;
            align-items : center;
            justify-content : center;
            color : #032651;
        }
        .body .bottom .left span:first-child{
            font-size : 50px;
            line-height : 0px;
        }

        .body .bottom .left #rm{
            font-size : 45px;
            line-height : 0.9;
            color : black;
            border-top : 5px solid #032651;
            border-bottom : 5px solid #032651;
            padding-left : 20px;
            padding-bottom :5px;
            margin-top : 10px;
        }
        .body .bottom .right{
            width : 60%;
            display : flex;
            align-items : center;
            padding-left : 2%;
            padding-right : 2%;
            flex-direction : column;
            justify-content : center;
        }
        .body .bottom .right .rahasia{
            width : 100%;
            border : 7px solid #e62028;
            text-align : center;
            color : #e62028;
            font-weight : 600;
            letter-spacing : 1px;
            font-size : 35px;
            line-height : 1;
            position : relative;
            padding-bottom : 5px;
        }
        .body .bottom .right .rahasia::before,.body .bottom .right .rahasia::after{
            content : "";
            position : absolute;
            width : 7px;
            height : 50%;
            top : 50%;
        }
        .body .bottom .right .rahasia::before{
            content : "";
            border-left : 0.5px solid #f9f9f9;
            left : 0px;
            background : #f9f9f9;
            transform : translate(-100%,-50%);
            -webkit-transform : translate(-100%,-50%);
            -o-transform : translate(-100%,-50%);
            -moz-transform : translate(-100%,-50%);
        }
        .body .bottom .right .rahasia::after{
            content : "";
            background : #ffffff;
            border-left : 0.5px solid #ffffff;
            right : 0px;
            transform : translate(100%,-50%);
            -webkit-transform : translate(100%,-50%);
            -o-transform : translate(100%,-50%);
            -moz-transform : translate(100%,-50%);
        }
        .box-tahun{
            width : 80%;
            height : 100%;
            margin-left : auto;
            display: flex;
            flex-direction: column;  
            justify-content : end;
        }
        .box-tahun .tahun{
            border-top : 2px solid #322b2a;
            border-bottom : 2px solid #322b2a;
            font-size : 25px;
            font-weight : 600;
            text-align : right;
            padding-right : 20px;
            margin-bottom : 10px;
            position : relative;
        }
        .box-tahun .tahun .check{
            width : 25px;
            height : 25px;
            border : 2px solid #322b2a;
            position : absolute;
            top : 50%;
            transform : translate(-50%,-50%);
            -webkit-transform : translate(-50%,-50%);
            -o-transform : translate(-50%,-50%);
            -moz-transform : translate(-50%,-50%);
        }
        .box-tahun .tahun .check img{
            width : 230%;
            position : absolute;
            top : 50%;
            left : 50%;
            transform : translate(-50%,-60%);
            -webkit-transform : translate(-50%,-60%);
            -o-transform : translate(-50%,-60%);
            -moz-transform : translate(-50%,-60%);
        }
    </style>
    <!-- <div class="row" class="box-paper">
        <div class="column left">
            <div class="map-box-back">
            </div>
        </div>
        <div class="column right">
        </div>
    </div> -->
    <div class="row">
    <div class="item">
        <div class="map-bottom">
            <img src="<?php echo base_url(); ?>assets/images/map-rm-bg-back.png" style="width:100%" alt="">
        </div>
    </div>
    <div class="item" style="margin-left:75.590551181px">
        <div class="map-box">
            <div class="body">
                <div class="top">
                    <div class="bg-left">
                        <div class="border-left"></div>
                    </div>
                    <div class="left">
                        <div class="content">
                            <div class="content-top">
                                <p style="margin-top :10px">NAMA PASIEN</p>
                                <p>IBU KANDUNG</p>
                                <p>DUSUN</p>
                                <p>RT/RW</p>
                                <p>DESA</p>
                                <p>KEC.</p>
                                <p>KABUPATEN</p>
                                <p>TELEPON</p>
                            </div>
                            <div class="content-bottom">
                                <p>ALERGI:</p>
                                <div class="output-alergi"><?= $pasien->riwayat_alergi_obat ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="center">
                        <div class="output" style="margin-top :10px"><span><?= $pasien->nama_lengkap ?></span></div>
                        <div class="output"><span><?= $pasien->nama_orang_tua_atau_istri ?></span></div>
                        <div class="output"><span><?= $pasien->nama_dusun ?></span></div>
                        <div class="output"><span><?= $pasien->rt ?>/<?= $pasien->rw ?></span></div>
                        <div class="output"><span><?= $pasien->desa ?></span></div>
                        <div class="output"><span><?= $pasien->kecamatan ?></span></div>
                        <div class="output"><span><?= $pasien->kabupaten ?></span></div>
                        <div class="output"><span><?= $pasien->nomer_telepon ?></span></div>
                    </div>
                    <div class="right">
                        <div class="box-tahun">
                            <?php 
                                for ($i=2021; $i <= 2027 ; $i++) { 
                            ?>
                                <div class="tahun">
                                    <div class="check"><?= $i==date('Y') ? "<img src='".base_url()."assets/images/check.png'>" : "" ?></div>
                                    <span><?= $i ?></span>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="bottom">
                    <div class="left">
                        <span>RM</span>
                        <span id="rm"><?= $pasien->no_rekam_medis ?></span>
                    </div>
                    <div class="right">
                        <div class="rahasia">
                            RAHASIA <br> MEDIS
                        </div>
                        <p style="margin-top : 0px;margin-bottom : 0">SK. MEN.KES. NO.749a/ MEN.KES.PER/ XII/ 1998</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <br>
    <center>
        <a href="" id="download" data-rm="<?= $pasien->no_rekam_medis ?>"><button>Download</button></a>
    </center>
    <br>
    <div id="preview" style="display:none"></div>
    <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/canvas.js') ?>"></script>

    <script>
        $(document).ready(function(){
            var element = $(".row")
            var getCanvas;  
            html2canvas(element, { 
            onrendered: function(canvas) { 
                    $("#preview").append(canvas); 
                    getCanvas = canvas; 
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
                var fileName = 'RM-'+rm
                $("#download").attr(
                "download", fileName+".png").attr( 
                    "href", newData); 
            });                     
        })
    </script>
</body>
</html>