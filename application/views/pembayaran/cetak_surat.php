<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Kwitansi Pembayaran</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">-->

  <!-- Load paper.css for happy printing -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">-->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/paper-css/paper.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: "Arial";
      /* font-family: Consolas; */
    }

    .header,
    .header .left {
      display: flex;
    }

    .header .left {
      width: 55%;
    }

    .header .right {
      width: 45%;
      padding-left: 40px;
      padding-top: 30px;
    }
  </style>

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <!--<style>
  @page { size: A5 landscape }
  </style>-->
  <style>
    @page {
      size: A5
    }
  </style>

</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<!-- <body class="A5 landscape" onload="window.print()"> -->

<body class="A5 landscape" onload="window.print()">

  <?php
  function penyebut($nilai)
  {
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
      $temp = penyebut($nilai - 10) . " Belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai / 10) . " Puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " Seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai / 100) . " Ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " Seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai / 1000) . " Ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai / 1000000) . " Juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai / 1000000000) . " Milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai / 1000000000000) . " Trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
  }

  function terbilang($nilai)
  {
    if ($nilai < 0) {
      $hasil = "Minus " . trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }
    return $hasil;
  }



  ?>

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">


    <div class="header">
      <div class="left">
        <div class="img">
          <img src="<?php echo base_url() . "assets/images/" . getInfoRS('logo') ?>" alt="logo" width="70" />
        </div>
        <div class="address" style="margin-left:15px">
          <h2 style="font-family:times-new-roman;margin-top:0;margin-bottom:0px"><?= getInfoRS('nama_rumah_sakit') ?></h2>
          <p style="margin-top:5px;margin-bottom:0px"><?= getInfoRS('alamat') ?></p>
          <p style="margin-top:5px;margin-bottom:0px"><?= getInfoRS('no_telpon') ?></p>
        </div>
      </div>
      <div class="right">
        <table>
          <tr>
            <td>Number</td>
            <td>:</td>
            <td><u><?= $id_transaksi ?></u></td>
          </tr>
          <tr>
            <td>Date</td>
            <td>:</td>
            <td><u><?= date('d-m-Y') ?></u></td>
          </tr>
        </table>
      </div>
      <!--<h4 style="text-align: left;">Ruko Atrani 24 - Sukorahayu - Wagir - Telp. (0341) 806305</h4>-->
    </div>
    <h3 style="text-align: center;margin-bottom:0px"><span style="text-decoration: underline;"><i>BILL</i></span></h3>
    <center>
      <table width="90%">
        <tr>
          <td width="50%">
            <h3 style="margin-bottom:5px"><u>IDENTITY</u></h3>
            <table>
              <tr>
                <td>Name &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
                <td>:</td>
                <td><?= $nama_pasien ?></td>
              </tr>
              <tr>
                <td>Age</td>
                <td>:</td>
                <td><?= $umur ?></td>
              </tr>
              <tr>
                <td>Address</td>
                <td>:</td>
                <td><?= $alamat ?></td>
              </tr>
            </table>
          </td>
          <td width="5%"></td>
          <td width="45%">
            <table style="margin-top:30px">
              <tr>
                <td>Sex &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
                <td>:</td>
                <td><?= $jk == 'P' ? 'Perempuan' : 'Laki-Laki' ?></td>
              </tr>
              <tr>
                <td>Nationality</td>
                <td>:</td>
                <td>.....</td>
              </tr>
              <tr>
                <td>Room Number</td>
                <td>:</td>
                <td>.....</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </center>
    <center>
      <table width="90%" style="font-family: Consolas;">
        <tr>
          <td width="45%">
            <h3 style="margin-bottom:5px"><u>FOR PAYMENT</u></h3>
            <table width="100%">
              <td>
                <div style="margin-bottom: 5px"><strong><br>Administrasi</strong></div>
              </td>
              <tr>
                <?php if ($isPasien == 1) {
                  echo "<td>Pasien Baru</td>";
                  $admin = 45000;
                  // echo "<td>:</td>";
                  echo "<td>" . "Rp." . number_format($admin, 2, ',', '.') . "</td>";
                } else {
                  echo "<td>Pasien Lama</td>";
                  $admin = 25000;
                  // echo "<td>:</td>";
                  echo "<td>" . "Rp." . number_format($admin, 2, ',', '.') . "</td>";
                }
                ?>
              </tr>
              <?php
              $total_transaksi = 0;
              $i = 1;
              $tipe = "";
              $caption = ['', '<td><div style="margin-bottom: 5px"><strong><br>Poli</strong></div></td>', '<td align="left"><div style="margin-bottom: 5px"><strong><br>Rawat Inap</strong></div></td>', '<td align="left"><div style="margin-bottom: 5px"><strong><br>Operasi</strong></div></td>', '<td align="left"><div style="margin-bottom: 5px"><strong><br>Laboratorium</strong></div></td>', '<td align="left"><div style="margin-bottom: 5px"><strong><br>Radiologi</strong></div></td>', '<td align="left"><div style="margin-bottom: 5px"><strong><br>UGD</strong></div></td>'];
              foreach ($transaksi_d as $data) {
                if (strpos($data->deskripsi, 'Pembayaran Biaya Medis') === false) {
                  if ($data->amount_transaksi > 0) {
                    if ($caption[$data->tipe_periksa] != $tipe) {
                      echo $caption[$data->tipe_periksa];
                    }
                    $tipe = $caption[$data->tipe_periksa];
              ?>
                    <?php if ($data->deskripsi == "Biaya Lainnya") {
                      $biaya_d = $this->Transaksi_model->get_detail_biaya($data->no_transaksi);
                      foreach ($biaya_d as $db) {
                    ?>
                        <tr>
                          <td><?= $db->nama_biaya ?></td>
                          <!-- <td>:</td> -->
                          <td>Rp.<?= number_format($db->biaya, 2, ',', '.'); ?></td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td>
                          <?= $data->deskripsi; ?>
                        </td>
                        <!-- <td>:</td> -->
                        <td>
                          Rp.<?= number_format($data->amount_transaksi, 2, ',', '.') ?>
                        </td>
                      </tr>
                    <?php } ?>
              <?php
                    $i++;
                  }
                  if ($data->dc == 'd')
                    $total_transaksi += $data->amount_transaksi;
                  else
                    $total_transaksi -= $data->amount_transaksi;
                }
              }
              ?>
              <tr><?php
                  $subsidi = 0;
                  if ($cekSubsidi == 1) {
                    $subsidi = $getSubsidi->amount_transaksi;
                    echo "<td>Subsidi</td>";
                    // echo "<td>:</td>";
                    echo "<td>Rp." . number_format($subsidi, 2, '.', '.') . "</td>";
                    // $cekSubsidi->;
                  }
                  ?></tr>
              <tr>
                <td colspan="3">
                  <hr>
                </td>
              </tr>
              <tr>
                <td><b>Amount</b></td>
                <td><b>Rp.<?php echo number_format($total_transaksi + $admin - $subsidi, 2, ',', '.'); ?></b></td>
                <!-- <td width="85%"><b>Amount</b></td>
                <td width="10%"><b>Rp</b></td>
                <td width="35%"><b><?php echo number_format($total_transaksi + $admin - $subsidi, 2, ',', '.'); ?></b></td> -->
              </tr>
              <tr>
                <td><b>Terbilang</b></td>
                <td width="20%">
                  <b>
                    <i>
                      <?php
                      // $angka = number_format($total_transaksi + $admin - $subsidi, 2, ',', '.');
                      $angka = $total_transaksi + $admin - $subsidi;
                      echo terbilang($angka) . " Rupiah";
                      ?>
                    </i>
                  </b>
                </td>
              </tr>
            </table>
          </td>
          <!-- <td width="10%"></td> -->
          <!-- <td width="45%">
            <table width="100%">
              <tr>
                <td><span style="margin-left:50px"></span> Banyuwangi, <?php echo $tgl_cetak; ?></td>
              </tr>
            </table>
          </td> -->
        </tr>
      </table>
      <br>
    </center>
    <br>
    <div class="" style="float:right">
      <div class="" style="margin-bottom:80px;">
        Banyuwangi, <?php echo $tgl_cetak; ?>
      </div>
      <div style="width:100%;margin-left:auto">
        <span>(<?= $this->session->userdata('full_name'); ?>)</span>
        <!-- <span style="margin-left:100px">(<?= $atas_nama ?>)</span> -->
        <span style="margin-left:80px">(............................)</span>
      </div>
    </div>
  </section>

</body>

</html>