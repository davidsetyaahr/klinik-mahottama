<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Cetak Laporan Periksa</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">-->

  <!-- Load paper.css for happy printing -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">-->
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/paper-css/paper.css">
  
  <style>
	  body{
      font-family : "Arial";
	  }
	  .header, .header .left{
		  display: flex;
          justify-content: center;
	  }
    .header .left{
      /* width:55%; */
    }
	  .header .right{
		  width: 45%;
      padding-left:40px;
      padding-top:30px;
	  }
  </style>

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <!--<style>
  @page { size: A5 landscape }
  </style>-->
  <style>@page { size: A5 }</style>

</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<!-- <body class="A5 landscape" onload="window.print()"> -->
<body class="A4" onload="window.print()">
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

	<div class="header">
		<div class="left">
      <div class="img" style="margin-top: -30px;">
        <img src="<?php echo base_url()."assets/images/".getInfoRS('logo')?>" alt="logo" width="150px" />
      </div>
      <div class="left" style="margin-left: 15px;">
          <div class="left" style="border-right: 6px solid #22396c;height: 65px;"></div>
      </div>
      <div class="address" style="margin-left:15px">
          <!-- <h2 style="font-family:times-new-roman;margin-top:0;margin-bottom:0px"><?= getInfoRS('nama_rumah_sakit') ?></h2> -->
          <p style="margin-top:0px;margin-bottom:0px;color:#3b5171"><?= getInfoRS('alamat') ?></p>
          <p style="margin-top:5px;margin-bottom:0px;color:#3b5171"><?= getInfoRS('no_telpon') ?></p>
          <p style="margin-top:5px;margin-bottom:0px;color:#3b5171">Email : klinikmahottama@gmail.com</p>
      </div>
	</div>
	  <!-- <div class="right">
      <table>
        <tr>
          <td>Number</td>
          <td>:</td>
          <td><u>id trx</u></td>
        </tr>
        <tr>
          <td>Date</td>
          <td>:</td>
          <td><u><?= date('d-m-Y') ?></u></td>
        </tr>
      </table>
		</div> -->
	</div>
<center style="margin-top: 20px;">
    <table width="100%">
      <tr>
        <td>
            <table>
                <tr>
                    <td><b>KEPADA,</b></td>
                </tr>
            <tr>
              <td><b><?= $nama_pasien ?></b></td>
            </tr>
            <tr>
              <td><b><?= $alamat ?></b></td>
            </tr>
          </table>
        </td>
        <td width="5%"></td>
        <td width="45%">
        <table style="margin-left:20px">
            <tr>
              <td>Invoice No &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
              <td>:</td>
              <td><?= $id_transaksi ?></td>
            </tr>
            <tr>
              <td>No RM</td>
              <td>:</td>
              <td><?= $no_rm ?></td>
            </tr>
            <!-- <tr>
              <td>Penerimaan Masuk</td>
              <td>:</td>
              <td><?= $tgl_masuk ?></td>
            </tr> -->
            <!-- <tr>
              <td>Pulang</td>
              <td>:</td>
              <td>Sudah Pulang</td>
            </tr> -->
            <tr>
              <td>Tanggal Cetak</td>
              <td>:</td>
              <td><?php echo $tgl_cetak?></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
</center>
<div>
    <hr style="border-bottom:1px solid black; border-top:1px solid black">
        <h4 style="margin-top: 5px; margin-bottom: 5px;">Keterangan Layanan</h4>
    <hr style="border-bottom:1px solid black; border-top:1px solid black">
</div>
<center>
    <table>
        <tr></tr>
    </table>
</center>

<table style="border-collapse:collapse; text-align:center;" width="100%">
	<tr style="border-bottom:1px solid black; border-bottom:1px solid black">
        <th align="left"><i>Layanan</i></th>
        <th align="right"><i>Yang Dibayarkan (IDR)</i></th>
	</tr>
    <?php
            $total_transaksi = 0;
            $i = 1;
            $tipe = "";
            $caption = ['','<td align="left"><div style="margin-bottom: 5px"><strong><br><i>Poli</i></strong></div></td>','<td align="left"><div style="margin-bottom: 5px"><strong><br><i>Rawat Inap</i></strong></div></td>','<td align="left"><div style="margin-bottom: 5px"><strong><br><i>Operasi</i></strong></div></td>','<td align="left"><div style="margin-bottom: 5px"><strong><br><i>Laboratorium</i></strong></div></td>','<td align="left"><div style="margin-bottom: 5px"><strong><br><i>Radiologi</i></strong></div></td>'];
            foreach($transaksi_d as $data){
              if(strpos($data->deskripsi, 'Pembayaran Biaya Medis') === false){
                if($data->amount_transaksi > 0){
                  if($caption[$data->tipe_periksa]!=$tipe){
                    echo $caption[$data->tipe_periksa];
                }
                $tipe = $caption[$data->tipe_periksa];
    ?>
                    <tr style="border-bottom:1px solid black; border-bottom:1px solid black">
                      <td align="left"><?php echo $data->deskripsi;?></td>
                      <!-- <br> -->
                        <td align="right">Rp.<?php echo $data->dc == 'd' ? number_format($data->amount_transaksi,2,',','.') : ($data->amount_transaksi != 0 ? '-'.number_format($data->amount_transaksi,2,',','.') : number_format(0,2,',','.'));?></td>
                    </tr>
                <?php 
                    $i++;
                }
                    if($data->dc == 'd')
                    $total_transaksi += $data->amount_transaksi;
                    else
                    $total_transaksi -= $data->amount_transaksi;
                }
            }
    ?>
    <tr style="border-bottom:1px solid black; border-bottom:1px solid black">
      <?php 
          $subsidi = 0;
                if($cekSubsidi == 1){
                  $subsidi = $getSubsidi->amount_transaksi;
                  echo "<th align='left'><i>Subsidi</i></th>";
                  echo "<th align='right'>Rp. ".number_format($subsidi, 0, '.', '.')."</th>";
                }                
              ?>
    </tr>
	<tr style="border-bottom:1px solid black; border-bottom:1px solid black">
		<th align="left"><i>Total</i></th>
		<th align="right">Rp. <?=number_format($total_transaksi-$subsidi, 0, '.', '.')?></th>
	</tr>
</table>
</div>
      <td width="45%">
        <table width="100%">
          <tr>
            <!-- <td><span style="margin-left:500px"></span> Banyuwangi, </td> -->
            <br>
            <td><span style="margin-left:450px"></span> Dicetak Oleh: <?= $this->session->userdata('full_name'); ?> , <?= $tgl_cetak;?></td>
          </tr>
        </table>
<div style="width:40%;margin-left:auto; margin-top: 80px;">
  <!-- <span>(<?= $this->session->userdata('full_name'); ?>)</span> -->
  <span style="margin-left:100px">(<?= $atas_nama ?>)</span>
</div>
</section>

</body>

</html>

