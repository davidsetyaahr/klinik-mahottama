<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>STRUK</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">-->

  <!-- Load paper.css for happy printing -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">-->
  
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/paper-css/paper.css">
  
  <style>
      body{
          width : 273.6px;
          /* width : 320px; */
      }
  </style>

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <!--<style>@page { size: A4 }</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body>
<!-- <body style="font-size:9px"> -->

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet" style="padding : 20px">

    <!-- Write HTML just like a web page -->
    <!--<article>This is an A5 document.</article>-->
	<div class="header">
		<div class="left">
      <div class="img">
          <center>
              <img src="<?php echo base_url()."assets/images/".getInfoRS('logo')?>" alt="logo" width="50px" />
            </center>
      </div>
      <div class="address" style="margin-left:15px;text-align:center;margin-top:10px">
          <h2 style="font-family:times-new-roman;margin-top:0;margin-bottom:0px"><?= getInfoRS('nama_rumah_sakit') ?></h2>
          <p style="margin-top:5px;margin-bottom:0px"><?= getInfoRS('alamat') ?></p>
          <p style="margin-top:5px;margin-bottom:0px"><?= getInfoRS('no_telpon') ?></p>
          <p style="margin-top:5px;margin-bottom:0px"><b><?= $id_transaksi ?></b></p>
      </div>
		</div>
	  <!-- <div class="right">
      <table>
        <tr>
          <td>Number</td>
          <td>:</td>
          <td><u><?= $id_transaksi ?></u></td>
        </tr>
        <tr>
          <td>Date</td>
          <td>:</td>
          <td><u><?= date('d--Y') ?></u></td>
        </tr>
      </table>
		</div> -->
	  <!--<h4 style="text-align: left;">Ruko Atrani 24 - Sukorahayu - Wagir - Telp. (0341) 806305</h4>-->
	</div>
<hr />
<table width="100%" style="padding:0px 0px">
	<thead>
		<tr>
			<td align="left"><?= date('d F Y') ?></td>
		</tr>
		<tr>
             <td align="left" style="text-align:left"><?= $nama_pasien ?> </td>
		</tr>
	</thead>
</table>
<br>
<style type="text/css">
	/*#table th, td{
		border-bottom:1px solid black; 
		border-bottom:1px solid black
	}*/
</style>
<table style="border-collapse:collapse; text-align:center;" width="100%">
	<tr style="border-bottom:1px solid black; border-bottom:1px solid black">
        <th align="left">Item</th>
        <th align="right">Jumlah</th>
	</tr>
  <tr>
      <td align="left"><div style="margin-bottom: 5px"><strong><br>Administrasi</strong></div></td>
  </tr>
    <tr>
      <td align="left" style="border-bottom:1px solid black; border-bottom:1px solid black">
      <?php if($isPasien==1)
          echo "Pasien Baru";
          else
          echo "Pasien Lama";
           ?>
      </td>
      <td align="right" style="border-bottom:1px solid black; border-bottom:1px solid black">
          <?php if($isPasien==1){
          // echo "Pasien Baru";
          $admin = 45000;
          echo "Rp.".number_format($admin,2,',','.');
          }else{
          // echo "Pasien Lama";
          $admin = 25000;
          echo "Rp.".number_format($admin,2,',','.');
          } ?>
        </td>
    </tr>
    <?php
            $total_transaksi = 0;
            $i = 1;
            $tipe = "";
            $caption = ['','<td align="left"><div style="margin-bottom: 5px"><strong><br>Poli</strong></div></td>','<td align="left"><div style="margin-bottom: 5px"><strong><br>Rawat Inap</strong></div></td>','<td align="left"><div style="margin-bottom: 5px"><strong><br>Operasi</strong></div></td>','<td align="left"><div style="margin-bottom: 5px"><strong><br>Laboratorium</strong></div></td>','<td align="left"><div style="margin-bottom: 5px"><strong><br>Radiologi</strong></div></td>','<td align="left"><div style="margin-bottom: 5px"><strong><br>UGD</strong></div></td>'];
            foreach($transaksi_d as $data){
              if(strpos($data->deskripsi, 'Pembayaran Biaya Medis') === false){
                if($data->amount_transaksi > 0){
                  if($caption[$data->tipe_periksa]!=$tipe){
                    echo $caption[$data->tipe_periksa];
                }
                $tipe = $caption[$data->tipe_periksa];
    ?>
              <?php if($data->deskripsi == "Biaya Lainnya"){
                  $biaya_d = $this->Transaksi_model->get_detail_biaya($data->no_transaksi);                            
                  foreach ($biaya_d as $db){
              ?>
              <tr style="border-bottom:1px solid black; border-bottom:1px solid black">
                  <td align="left"><?= $db->nama_biaya ?></td>
                  <td align="right">Rp.<?= number_format($db->biaya,2,',','.'); ?></td>
              <tr></tr>
              <?php
                  }
              }else{
                  ?>
                  <tr style="border-bottom:1px solid black; border-bottom:1px solid black">
                    <td align="left">
                        <?= $data->deskripsi; ?>
                    </td>
                    <td align="right">
                        Rp.<?= number_format($data->amount_transaksi,2,',','.') ?>
                    </td>
                  </tr>
                  <?php } ?>
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
                  echo "<th align='left'>Subsidi</th>";
                  echo "<th align='right'>Rp. ".number_format($subsidi, 0, '.', '.')."</th>";
                }                
              ?>
    </tr>
	<tr style="border-bottom:1px solid black; border-bottom:1px solid black">
		<th align="left">Total</th>
		<th align="right">Rp. <?=number_format($total_transaksi+$admin-$subsidi, 0, '.', '.')?></th>
	</tr>
</table>
<br>
<!-- <table width="100%">
<thead>
	<tr>
		<td align="right" colspan="2">Denpasar, <?php echo date('d-m-Y');?><br><br></td>
	</tr>
	<tr>
		<td align="left">Guest Signature<br><br><br><br><br></td>
		<td align="right">Attending Physician<br><br><br><br><br></td>
	</tr>
	<tr style="margin-top:20pxs">
		<td align="left">(...................)</td>
		<td align="right">(...................)</td>
	</tr>
</thead>
</table>
 -->  </section>

</body>

</html>
<script type="text/javascript">
     window.print();
// window.onmousemove = function() {
//   window.close();
// }
  </script>