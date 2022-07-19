<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        * {
            font-family : "Arial";
            font-size:14px;
            margin: 0px;
            padding: 0px;
        }

        .a5 {
            /* height: 559.37007874px;
            width: 793.7007874px; */
            background: yellow;
            margin: auto;
            width:737.00787402px;
            height:514.01574803px;
            /* padding: 4px; */
            display:inline-block;
            padding:4.8px;
        }

        .row {
            display:flex;
        }

        .row:last-child {
            margin-bottom: 0px;
        }

        .row .label {
            /* height: 115.2px;
            width: 238.11023622px; */
            height: calc(514.01574803px / 4 - 4.8px);
            width: calc(100%/3);
            font-size: 15px;
            /* width: 204.09448819px; */
            background: white;
            display: inline-block;
            margin-right:4.8px;
            margin-bottom:4.8px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }
        .row .label p:first-child,.row .label p:last-child{
            margin-top:5px;
        }
        .row .label p{
            font-weight:bold;
            padding:3px 15px;
        }
        .row .label:last-child {
            margin-right:0px;
        }
    </style>
    <style media="print">
        * {
            font-family : "Arial";
            font-size:14px;
            margin: 0px;
            padding: 0px;
        }

        .a5 {
            /* height: 559.37007874px;
            width: 793.7007874px; */
            background: yellow;
            margin: auto;
            width:737.00787402px;
            height:514.01574803px;
            /* padding: 4px; */
            display:inline-block;
            padding:4.8px;
        }

        .row {
            display:flex;
        }

        .row:last-child {
            margin-bottom: 0px;
        }

        .row .label {
            /* height: 115.2px;
            width: 238.11023622px; */
            height: calc(514.01574803px / 4 - 4.8px);
            width: calc(100%/3);
            font-size: 15px;
            /* width: 204.09448819px; */
            background: white;
            display: inline-block;
            margin-right:4.8px;
            margin-bottom:4.8px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }
        .row .label p:first-child,.row .label p:last-child{
            margin-top:5px;
        }
        .row .label p{
            font-weight:bold;
            padding:3px 15px;
        }
        .row .label:last-child {
            margin-right:0px;
        }
    </style>
    <div class="a5">
        <div class="row">
            <div class="label">
                <p><?= $pasien->no_rekam_medis ?></p>
                <p><?= $pasien->nama_lengkap ?></p>
                <p><?= $pasien->tanggal_lahir ?></p>
                <p><?= $pasien->nik ?></p>
                <p><?= $pasien->alamat ?></p>
            </div>
            <div class="label">
                <p><?= $pasien->no_rekam_medis ?></p>
                <p><?= $pasien->nama_lengkap ?></p>
                <p><?= $pasien->tanggal_lahir ?></p>
                <p><?= $pasien->nik ?></p>
                <p><?= $pasien->alamat ?></p>
            </div>
            <div class="label">
                <p><?= $pasien->no_rekam_medis ?></p>
                <p><?= $pasien->nama_lengkap ?></p>
                <p><?= $pasien->tanggal_lahir ?></p>
                <p><?= $pasien->nik ?></p>
                <p><?= $pasien->alamat ?></p>
            </div>
        </div>
        <div class="row">
            <div class="label">
                <p><?= $pasien->no_rekam_medis ?></p>
                <p><?= $pasien->nama_lengkap ?></p>
                <p><?= $pasien->tanggal_lahir ?></p>
                <p><?= $pasien->nik ?></p>
                <p><?= $pasien->alamat ?></p>
            </div>
            <div class="label">
                <p><?= $pasien->no_rekam_medis ?></p>
                <p><?= $pasien->nama_lengkap ?></p>
                <p><?= $pasien->tanggal_lahir ?></p>
                <p><?= $pasien->nik ?></p>
                <p><?= $pasien->alamat ?></p>
            </div>
            <div class="label">
                <p><?= $pasien->no_rekam_medis ?></p>
                <p><?= $pasien->nama_lengkap ?></p>
                <p><?= $pasien->tanggal_lahir ?></p>
                <p><?= $pasien->nik ?></p>
                <p><?= $pasien->alamat ?></p>
            </div>
            <!-- <div class="label">
                <p>Nama: <span>Galih</span></p>
            </div>
            <div class="label">
                <p>Nama: <span>Galih</span></p>
            </div>
            <div class="label">
                <p>Nama: <span>Galih</span></p>
            </div> -->
        </div>
        <div class="row">
            <div class="label">
                <p><?= $pasien->no_rekam_medis ?></p>
                <p><?= $pasien->nama_lengkap ?></p>
                <p><?= $pasien->tanggal_lahir ?></p>
                <p><?= $pasien->nik ?></p>
                <p><?= $pasien->alamat ?></p>
            </div>
            <div class="label">
                <p><?= $pasien->no_rekam_medis ?></p>
                <p><?= $pasien->nama_lengkap ?></p>
                <p><?= $pasien->tanggal_lahir ?></p>
                <p><?= $pasien->nik ?></p>
                <p><?= $pasien->alamat ?></p>
            </div>
            <div class="label">
                <p><?= $pasien->no_rekam_medis ?></p>
                <p><?= $pasien->nama_lengkap ?></p>
                <p><?= $pasien->tanggal_lahir ?></p>
                <p><?= $pasien->nik ?></p>
                <p><?= $pasien->alamat ?></p>
            </div>
        </div>
        <div class="row">
            <div class="label">
                <p><?= $pasien->no_rekam_medis ?></p>
                <p><?= $pasien->nama_lengkap ?></p>
                <p><?= $pasien->tanggal_lahir ?></p>
                <p><?= $pasien->nik ?></p>
                <p><?= $pasien->alamat ?></p>
            </div>
            <div class="label">
                <p><?= $pasien->no_rekam_medis ?></p>
                <p><?= $pasien->nama_lengkap ?></p>
                <p><?= $pasien->tanggal_lahir ?></p>
                <p><?= $pasien->nik ?></p>
                <p><?= $pasien->alamat ?></p>
            </div>
            <div class="label">
                <p><?= $pasien->no_rekam_medis ?></p>
                <p><?= $pasien->nama_lengkap ?></p>
                <p><?= $pasien->tanggal_lahir ?></p>
                <p><?= $pasien->nik ?></p>
                <p><?= $pasien->alamat ?></p>
            </div>
        </div>
    </div>
</body>

</html>