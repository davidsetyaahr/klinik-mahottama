<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <?php 
            if($this->session->flashdata('message')){
                if($this->session->flashdata('message_type') == 'danger')
                    echo alert('alert-danger', 'Perhatian', $this->session->flashdata('message'));
                else if($this->session->flashdata('message_type') == 'success')
                    echo alert('alert-success', 'Sukses', $this->session->flashdata('message')); 
                else
                    echo alert('alert-info', 'Info', $this->session->flashdata('message')); 
            }
            ?>
            </div>
            <div class="col-md-12">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">OPERASI</h3>
                    </div>
                    <div class="box-body">
                        <div class="row col-md-12">
                            <form action="<?= base_url() . "periksamedis/save_periksa_operasi" ?>" method="post">
                                <div class="form-group row">
                                    <div class="col-md-2">Nama Lengkap</div>
                                    <div class="col-md-10">
                                        <input type="text" name="nama_lengkap" value="<?= isset($nama_lengkap) ? $nama_lengkap : '' ?>" readonly id="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">Alamat</div>
                                    <div class="col-md-10">
                                        <textarea name="alamat" class="form-control" rows="6" readonly><?= isset($alamat) ? $alamat : '' ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row opr">
                                    <div class="col-md-2">Pilih Jenis Operasi <?= form_error("periksa_operasi"); ?></div>
                                    <div class="col-md-10">
                                        <select name="periksa_operasi" id="jenis_operasi" data-row="0" class="form-control select2 periksaLab selectOpr getOk" style="width:100%">
                                            <option value="">---Pilih Jenis Operasi---</option>
                                                <?php 
                                                    foreach ($jenis as $key => $value) {
                                                        $s = set_value("periksa_operasi")!="" && set_value("periksa_operasi")==$value->id_jenis_operasi ? 'selected' : '';
                                                        echo "<option data-id-jenis-opr='".$value->id_jenis_operasi."' data-biaya-ok='".$value->biaya_ok."' value='".$value->id_jenis_operasi."' $s>".$value->nama_jenis_operasi."</option>";
                                                    }
                                                ?>

                                                
                                        </select>
                                    </div>
                                    <div class="col-md-2"><input type="hidden" class="form-control biayaopr"></div>
                                    <div class="col-md-2"><input name="biaya_ok" type="hidden" class="form-control ok"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">Pilih Ruangan Operasi <?= form_error("ruangan"); ?></div>
                                    <div>
                                        
                                    </div>
                                    <div class="col-md-10">
                                        <select name="ruangan" id="ruangan" data-row="0" class="form-control select2 " style="width:100%">
                                            <option value="">---Pilih Ruangan Operasi---</option>
                                            <?php 
                                                foreach ($ruangan as $key => $value) {
                                                    $s = set_value("ruangan")!="" && set_value("ruangan")==$value->id ? 'selected' : '';
                                                    echo "<option value='".$value->id."' $s>".$value->nama."</option>";
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="row-alat" data-row='<?= validation_errors()!="" ? count($_POST['id_alat'])-1 : 0 ?>'>
                                <?php 
                                    if(validation_errors()!=""){
                                        for ($i=0; $i < count($_POST['id_alat']) ; $i++) { 
                                            $this->load->view('loop/loop-pilihan-alat-operasi',['no' => $i]);
                                        }
                                    }
                                    else{
                                        $this->load->view('loop/loop-pilihan-alat-operasi',['no' => 0]);
                                    }
                                ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <a href="" class="btn btn-info btn-sm" id="addItemAlat"><span class="fa fa-plus"></span> Tambah Item</a>
                                    </div>
                                </div>
                                <div class="form-group" id="row-biaya" data-row='<?= validation_errors()!="" ? count($_POST['id_biaya'])-1 : 0 ?>'>
                                <?php 
                                    $totalBiayaLainnya = 0;
                                    if(validation_errors()!=""){
                                        $selectedBiaya = [];
                                        if(set_value('periksa_operasi')!=''){
                                            $this->db->select('id_biaya');
                                            $jenisBiayaSelected = $this->db->get_where('tbl_biaya_jenis_operasi',['id_jenis_operasi' => set_value('periksa_operasi')])->result();
                                            foreach ($jenisBiayaSelected as $key => $value) {
                                                array_push($selectedBiaya,$value->id_biaya);
                                            }
                                        }
                                        for ($i=0; $i < count($_POST['id_biaya']) ; $i++) { 
                                            $totalBiayaLainnya+=$_POST['subtotal_biaya'][$i];
                                            $classBiaya = in_array($_POST['id_biaya'][$i],$selectedBiaya) ? "biaya-auto" : "";
                                            $this->load->view('rawat-inap/loop-pilihan-biaya', ['no' => $i,"classBiaya" => $classBiaya]);
                                        }
                                    }
                                    else{
                                        $this->load->view('rawat-inap/loop-pilihan-biaya',['no' => 0,'operasi' => true]);
                                    }
                                ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <a href="" class="btn btn-info btn-sm" id="addItemBiaya"><span class="fa fa-plus"></span> Tambah Item</a>
                                    </div>
                                </div>
                                <div class="form-group" id="row-obat" data-row='<?= validation_errors()!="" ? count($_POST['kode_obat'])-1 : 0 ?>'>
                                    <?php
                                    $totalBiayaObat = 0;
                                    if(validation_errors()!=""){
                                        for ($i=0; $i < count($_POST['kode_obat']) ; $i++) { 
                                            $totalBiayaObat+=$_POST['subtotal_obat'][$i];
                                            $this->load->view('loop/loop-pilihan-obat',['no' => $i]);
                                        }
                                    }
                                    else{
                                        $this->load->view('loop/loop-pilihan-obat',['no' => 0]);
                                    }
                                    ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <a href="" class="btn btn-info btn-sm" id="addItemObat"><span class="fa fa-plus"></span> Tambah Item</a>
                                    </div>
                                </div>
                                <div class="form-group" id="row-alkes" data-row='<?= validation_errors()!="" ? count($_POST['kode_alkes'])-1 : 0 ?>'>
                                    <?php
                                    $totalBiayaAlkes = 0;
                                    if(validation_errors()!=""){
                                        for ($i=0; $i < count($_POST['kode_alkes']) ; $i++) { 
                                            $totalBiayaAlkes+=$_POST['subtotal_alkes'][$i];
                                            $this->load->view('loop/loop-pilihan-alkes',['no' => $i]);;
                                        }
                                    }
                                    else{
                                        $this->load->view('loop/loop-pilihan-alkes',['no' => 0]);
                                    }
                                    ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <a href="" class="btn btn-info btn-sm" id="addItemAlkes"><span class="fa fa-plus"></span> Tambah Item</a>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                <div class="col-md-2">Biaya OK</div>
                                    <div class="col-md-10"> -->
                                    <?php $totalBiayaOk = isset($_POST['totalBiayaOk']) ? $_POST['totalBiayaOk'] : 0; ?>
                                        <input type="hidden" id="totalBiayaOk" value="<?= $totalBiayaOk ?>" name="totalBiayaOk" class="form-control" readonly>
                                    <!-- </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">Total Biaya</div>
                                    <div class="col-sm-10"> -->
                                        <input type="hidden" name="totalBiaya" id="totalBiaya" class="form-control" value='<?= $totalBiayaLainnya ?>' readonly>
                                    <!-- </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">Total Biaya Obat</div>
                                    <div class="col-sm-10"> -->
                                        <input type="hidden" name="totalObat" id="totalObat" class="form-control" value='<?= $totalBiayaObat ?>' readonly>
                                    <!-- </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">Total Biaya BMHP</div>
                                    <div class="col-sm-10"> -->
                                        <input type="hidden" name="totalAlkes" id="totalAlkes" class="form-control" value='<?= $totalBiayaAlkes ?>' readonly>
                                    <!-- </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">Grand Total</div>
                                    <div class="col-sm-10"> -->
                                        <input type="hidden" name="grandTotal" id="grandTotal" class="form-control" value='0' readonly>
                                    <!-- </div>
                                </div> -->
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-2">Pemeriksaan Selanjutnya</div>
                                    <div class="col-sm-10">
                                        <select name="pemeriksaan_selanjutnya" id="" style="width:100%" class="select2 form-control">
                                            <option value="3">Tetap Di Operasi</option>
                                            <option value="0">Pemeriksaan Selesai</option>
                                            <option value="2">Rawat Inap</option>
                                            <option value="4">Laboratorium</option>
                                            <option value="5">Radiologi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <br>
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <button type="reset" class="btn btn-default"><span class="fa fa-times"></span> Batal</button>
                                            <button type="submit" class="btn btn-warning" onclick="return confirm('Yakin Simpan?')"><span class="fa fa-save"></span> Periksa</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        <?php 
            $this->load->view('template/periksaJS');
        ?>


// function getOpr(thisParam){
//             var biaya = thisParam.find(":selected").attr('data-biaya')
//             var nama = thisParam.find(":selected").attr('data-nama-biaya')
//             var idBiaya = thisParam.find(":selected").attr('data-id-biaya')
//             var idJenisOpr = thisParam.find(":selected").attr('data-id-jenis-opr')

//             $(".opr .biayaopr").val(biaya)
//             $("#row-biaya").append(`
//                 <div class="opr-biaya" data-no="">
//                     <div class='col-md-5'>
//                             <input id="biaya" name="id_biaya[]" class="form-control" style="width:100%" placeholder="" value="${nama}" readonly>
//                     </div>
//                         <div class='col-md-2'>
//                             <input id="qty" name="qty_biaya[]" value="1" type="number" class="form-control qty_biaya" placeholder="Kuantitas">
//                         </div>
//                         <div class='col-md-2'>
//                             <input id="biaya" name="biaya[]" value="${biaya}" type="number" class="form-control biaya" placeholder="Harga" readonly>
//                         </div>
//                         <div class='col-md-3'>
//                             <input id="total_biaya" name="subtotal_biaya[]" value="" type="number" class="form-control total_biaya" placeholder="Sub Total" readonly>
//                         </div>
//                 </div>
//                 <br>
//             `)
//         }

//         $(".getOpr").change(function() {
//             getOpr($(this))
//             subTotalBiayaOpr()
//             totalBiaya()
//         })

//         $(".qty_biaya").keyup(function() {
//             var qty = $(this).closest('.opr').attr('data-no')
//             var dataNo = $(this).closest('.opr-biaya').attr('data-no')
//             console.log(dataNo);
//             subTotalBiayaOpr(qty)
//             // totalBiaya()
//         })

        // function subTotalBiayaOpr() {
        //     var qty_biaya = parseInt($(".opr-biaya .qty_biaya").val())
        //     var biaya = parseInt($(".opr-biaya .biaya").val())
        //     var subtotal = isNaN(qty_biaya * biaya) ? 0 : qty_biaya * biaya
        //     $(".opr-biaya .total_biaya").val(subtotal)
        // }

        // <div class="opr-biaya">
        //                     <div class='col-md-5'>
        //                             <input id="biaya" name="id_biaya[]" class="form-control" style="width:100%" placeholder="" value="" readonly>
        //                     </div>
        //                         <div class='col-md-2'>
        //                             <input id="qty" name="qty_biaya[]" value="1" type="number" class="form-control qty_biaya" placeholder="Kuantitas">
        //                         </div>
        //                         <div class='col-md-2'>
        //                             <input id="biaya" name="biaya[]" value="" type="number" class="form-control biaya" placeholder="Harga" readonly>
        //                         </div>
        //                         <div class='col-md-3'>
        //                             <input id="total_biaya" name="subtotal_biaya[]" value="" type="number" class="form-control total_biaya" placeholder="Sub Total" readonly>
        //                         </div>
        //                 </div>


        // $('#biayaOk').on('keyup', function()
        // {
        //     // console.log($(this).val())
        //     $(this).val()
        //     grandTotal()
        // });
        grandTotal()

        function grandTotal() {
            var totalObat = parseInt($("#totalObat").val())
            var totalAlkes = parseInt($("#totalAlkes").val())
            var biayaOk = parseInt($("#totalBiayaOk").val())
            var totalBiaya = parseInt($("#totalBiaya").val())
            var grandTotal = totalObat + totalAlkes + totalBiaya + biayaOk
            $("#grandTotal").val(grandTotal)
        }
    })
</script>