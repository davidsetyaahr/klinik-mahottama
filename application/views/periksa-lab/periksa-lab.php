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
                        <h3 class="box-title">PERIKSA LAB</h3>
                    </div>
                    <div class="box-body">
                        <div class="row col-md-12">
                        <form action="<?= base_url()."periksamedis/save_periksa_lab" ?>" method="post">
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
                            <div class="form-group" id="row-lab" data-row='<?= validation_errors()!="" ? count($_POST['periksa_lab'])-1 : 0 ?>'>
                                <?php 
                                    $totalBiayaLab = 0;
                                    if(validation_errors()!=""){
                                        for ($i=0; $i < count($_POST['periksa_lab']) ; $i++) { 
                                            $totalBiayaLab+=$_POST['harga_periksa_lab'][$i];
                                            $this->load->view('periksa-lab/loop-pilihan-lab',['no' => $i]);
                                        }
                                    }
                                    else{
                                        $this->load->view('periksa-lab/loop-pilihan-lab',['no' => 0]);
                                    }
                                    ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <a href="" class="btn btn-info btn-sm" id="addItemLab"><span class="fa fa-plus"></span> Tambah Item</a>
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
                            <div class="form-group" id="row-biaya" data-row='<?= validation_errors()!="" ? count($_POST['id_biaya'])-1 : 0 ?>'>
                                    <?php
                                    $totalBiayaLainnya = 0;
                                    if(validation_errors()!=""){
                                        for ($i=0; $i < count($_POST['id_biaya']) ; $i++) { 
                                            $totalBiayaLainnya+=$_POST['subtotal_biaya'][$i];
                                            $this->load->view('rawat-inap/loop-pilihan-biaya', ['no' => $i]);
                                        }
                                    }
                                    else{
                                        $this->load->view('rawat-inap/loop-pilihan-biaya', ['no' => 0]);
                                    }
                                    ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <a href="" class="btn btn-info btn-sm" id="addItemBiaya"><span class="fa fa-plus"></span> Tambah Item</a>
                                </div>
                            </div>
                            <div class="form-group" id="row-tindakan" data-row='<?= validation_errors()!="" ? count($_POST['tindakan'])-1 : 0 ?>'>
                                <?php 
                                    $totalBiayaTindakan = 0;
                                    if(validation_errors()!=""){
                                        for ($i=0; $i < count($_POST['tindakan']) ; $i++) { 
                                            $totalBiayaTindakan+=$_POST['subtotal_tindakan'][$i];
                                            $this->load->view('loop/loop-pilihan-tindakan',['no' => $i]);
                                        }
                                    }
                                    else{
                                        $this->load->view('loop/loop-pilihan-tindakan',['no' => 0]);
                                    }
                                ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <a href="" class="btn btn-info btn-sm" id="addItemTindakan"><span class="fa fa-plus"></span> Tambah Item</a>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <div class="col-sm-2">Total Biaya Periksa Lab</div>
                                <div class="col-sm-10"> -->
                                    <input type="hidden" id="totalLab" name="totalLab" class="form-control" value='<?= $totalBiayaLab ?>' readonly>
                                <!-- </div>
                            </div> -->
                            <!-- <div class="form-group row">
                                <div class="col-sm-2">Total Biaya Obat</div>
                                <div class="col-sm-10"> -->
                                    <input type="hidden" id="totalObat" name="totalObat" class="form-control" value='<?= $totalBiayaObat ?>' readonly>
                                <!-- </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">Total Biaya BMHP</div>
                                <div class="col-sm-10"> -->
                                    <input type="hidden" id="totalAlkes" name="totalAlkes" class="form-control" value='<?= $totalBiayaAlkes ?>' readonly>
                                <!-- </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">Total Biaya Tindakan</div>
                                <div class="col-sm-10"> -->
                                    <input type="hidden" id="totalTindakan" name="totalTindakan" class="form-control" value='<?= $totalBiayaTindakan ?>' readonly>
                                <!-- </div>
                            </div>
                            <div class="form-group row">
                                    <div class="col-sm-2">Total Biaya Lainnya</div>
                                    <div class="col-sm-10"> -->
                                        <input type="hidden" id="totalBiaya" name="totalBiaya" class="form-control" value='<?= $totalBiayaLainnya ?>' readonly>
                                    <!-- </div>
                                </div>
                            <div class="form-group row">
                                <div class="col-sm-2">Grand Total</div>
                                <div class="col-sm-10"> -->
                                    <input type="hidden" id="grandTotal" name="grandTotal" class="form-control" value='0' readonly>
                                <!-- </div>
                            </div> -->
                            <hr>
                            <div class="form-group row">
							<div class="col-sm-2">Pemeriksaan Selanjutnya</div>
							<div class="col-sm-10">
                                <select name="pemeriksaan_selanjutnya" id="" style="width:100%" class="select2 form-control">
                                        <option value="0">Pemeriksaan Selesai</option>
                                        <option value="4">Tetap Di Laboratorium</option>
                                        <option value="2">Rawat Inap</option>
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
    $(document).ready(function(){
        grandTotal()
        function getHargaLab(thisAttr){
            var getHarga = thisAttr.find(':selected').data('harga')
            var dataId = thisAttr.closest('.loop-lab').attr('data-no')
            $(".loop-lab[data-no='"+dataId+"'] .total").val(getHarga);
        }
        $(".periksaLab").change(function(){
            getHargaLab($(this))
            totalPeriksaLab()
        })

        function totalPeriksaLab(){
            var totalLab = 0
            $(".loop-lab .total").each(function(i,v){
                var subtotal = parseInt(v.value)
                totalLab+=subtotal
            })
            $("#totalLab").val(totalLab)
            grandTotal()
        }

        function grandTotal(){
            var totalObat = parseInt($("#totalObat").val())
            var totalAlkes = parseInt($("#totalAlkes").val())
            var totalTindakan = parseInt($("#totalTindakan").val())
            var totalLab = parseInt($("#totalLab").val())
            var totalBiaya = parseInt($("#totalBiaya").val())

            var grandTotal = totalObat + totalAlkes + totalTindakan + totalLab + totalBiaya
            $("#grandTotal").val(grandTotal)
        }

        $("#addItemLab").click(function(e){
            e.preventDefault();
            var dataRow = parseInt($('#row-lab').attr('data-row'))
            $.ajax({
                type : 'get',
                url : '<?= base_url().'periksamedis/newItemLab' ?>',
                data : {no : dataRow+1},
                success : function(data){
                    $('#row-lab').append(data)
                    $('#row-lab').attr('data-row',dataRow + 1)
                    // $(".select2").select2()
                    $(".selectAlkes").change(function(){
                        selectAlkes($(this))
                    })

                    $(".remove-lab").click(function(e){
                        e.preventDefault();
                        var dataNo = $(this).attr('data-no')
                        var dataRow = parseInt($('#row-lab').attr('data-row'))
                        $('.loop-lab[data-no="'+dataNo+'"]').remove()
                        $('#row-lab').attr('data-row',dataRow-1)
                        totalPeriksaLab()

                    })
                    $(".select2").select2()
                    
                    $(".periksaLab").change(function(){
                        getHargaLab($(this))
                        totalPeriksaLab()
                    })

                }
            })
        })
        <?php 
            $this->load->view('template/periksaJS');
        ?>
    })
</script>
