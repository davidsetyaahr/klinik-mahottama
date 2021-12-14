<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">RAWAT INAP</h3>
                    </div>
                    <div class="box-body">
                        <div class="row col-md-12">
                            <form action="<?= base_url() . "periksamedis/save_periksa_radiologi" ?>" method="post">
                                <div class="form-group row">
                                    <div class="col-md-2">No Periksa </div>
                                    <div class="col-md-10">
                                        <input type="text" name="no_periksa" value="<?= $no_periksa ?>" readonly id="" class="form-control">
                                    </div>
                                </div>
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
                                <!-- START: input kamar -->
                                <div id="input_fields_wrap_kamar">
                                    <div class="form-group" id="row-kamar" data-row='0'>
                                        <?php
                                        $this->load->view('rawat-inap/loop-pilihan-kamar', ['no' => 0])
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <!-- <button id="addItemKamar" class="btn btn-info btn-md"><i class="fa fa-plus"> Tambah item</i></button> -->
                                        <a href="" class="btn btn-info btn-sm" id="addItemKamar"><span class="fa fa-plus"></span> Tambah Item</a>
                                    </div>
                                </div>
                                <!-- END: input kamar -->
                                <div class="form-group" id="row-biaya" data-row='0'>
                                    <?php
                                    $this->load->view('rawat-inap/loop-pilihan-biaya', ['no' => 0])
                                    ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <a href="" class="btn btn-info btn-sm" id="addItemBiaya"><span class="fa fa-plus"></span> Tambah Item</a>
                                    </div>
                                </div>
                                <div class="form-group" id="row-obat" data-row='0'>
                                    <?php
                                    $this->load->view('loop/loop-pilihan-obat', ['no' => 0])
                                    ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <a href="" class="btn btn-info btn-sm" id="addItemObat"><span class="fa fa-plus"></span> Tambah Item</a>
                                    </div>
                                </div>
                                <div class="form-group" id="row-alkes" data-row='0'>
                                    <?php
                                    $this->load->view('loop/loop-pilihan-alkes', ['no' => 0])
                                    ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <a href="" class="btn btn-info btn-sm" id="addItemAlkes"><span class="fa fa-plus"></span> Tambah Item</a>
                                    </div>
                                </div>
                                <div class="form-group" id="row-tindakan" data-row='0'>
                                    <?php
                                    $this->load->view('loop/loop-pilihan-tindakan', ['no' => 0])
                                    ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">Total Biaya Kamar</div>
                                    <div class="col-sm-10">
                                        <input type="text" id="totalKamar" name="totalKamar" class="form-control" value='0' readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">Total Biaya</div>
                                    <div class="col-sm-10">
                                        <input type="text" id="totalBiaya" name="totalBiaya" class="form-control" value='0' readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">Total Biaya Obat</div>
                                    <div class="col-sm-10">
                                        <input type="text" id="totalObat" name="totalObat" class="form-control" value='0' readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">Total Biaya BMHP</div>
                                    <div class="col-sm-10">
                                        <input type="text" id="totalAlkes" name="totalAlkes" class="form-control" value='0' readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">Total Biaya Tindakan</div>
                                    <div class="col-sm-10">
                                        <input type="text" id="totalTindakan" name="totalTindakan" class="form-control" value='0' readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">Grand Total</div>
                                    <div class="col-sm-10">
                                        <input type="text" id="grandTotal" name="grandTotal" class="form-control" value='0' readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-2">Pemeriksaan Selanjutnya</div>
                                    <div class="col-sm-10">
                                        <select name="pemeriksaan_selanjutnya" id="" style="width:100%" class="select2 form-control">
                                            <option value="0">Pemeriksaan Selesai</option>
                                            <option value="2">Tetap Di Rawat Inap</option>
                                            <option value="3">Operasi</option>
                                            <option value="4">Laboratorium</option>
                                            <option value="5">Radiologi</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <br>
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <button type="reset" class="btn btn-default"><span class="fa fa-times"></span> Batal</button>
                                            <button type="submit" class="btn btn-warning"><span class="fa fa-save"></span> Periksa</button>
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
        function subTotalKamar(dataNo) {
            var qty = parseInt($(".loop-kamar[data-no='" + dataNo + "'] .hari").val())
            var harga = parseInt($(".loop-kamar[data-no='" + dataNo + "'] .harga").val())
            var subtotal = isNaN(qty * harga) ? 0 : qty * harga
            $(".loop-kamar[data-no='" + dataNo + "'] .subtotal").val(subtotal)
        }
        $(".loop-kamar .hari").keyup(function() {
            var dataNo = $(this).closest('.loop-kamar').attr('data-no')
            if($(".loop-kamar[data-no='"+dataNo+"'] .idKamar").val()!=''){
                subTotalKamar(dataNo)
                totalKamar()
            }
        })
        $(".idKamar").change(function(){
            var dataNo = $(this).closest('.loop-kamar').attr('data-no')
            var thisVal = $(this).val()

            if(thisVal!=''){
                $(".loop-kamar[data-no='" + dataNo + "'] .hari").val(1)
                subTotalKamar(dataNo)
                totalKamar()
            }
        })
        function getKamar(param){
            var dataNo = param.closest('.loop-kamar').attr('data-no')
            var thisVal = param.val()
            $(".loop-kamar[data-no='" + dataNo + "'] .hari").val('')
            $.ajax({
                url : "<?= base_url()."periksamedis/getKamarByKategori" ?>",
                type : 'get',
                data : {id_kategori : thisVal},
                success : function(res){
                    res = JSON.parse(res)
                    $(".loop-kamar[data-no='"+dataNo+"'] .idKamar option").remove()
                    $(".loop-kamar[data-no='"+dataNo+"'] .idKamar").append(`
                        <option value=''>---Pilih Kamar---</option>
                    `);
                    $.each(res,function(i,v){
                        $(".loop-kamar[data-no='"+dataNo+"'] .idKamar").append(`
                            <option value='${v.id_kamar}'>${v.no_kamar}</option>
                        `);
                    })
                }
            })
            subTotalKamar(dataNo)
            totalKamar()
        }
        $(".tipe-kamar").change(function() {
            getKamar($(this))
        })

        function getHarga(thisParam) {
            var harga = thisParam.find(":selected").attr('data-harga')
            var getNo = thisParam.closest('.loop-kamar').attr('data-no')
            $(".loop-kamar[data-no='" + getNo + "'] .harga").val(harga)
        }
        $(".getHarga").change(function() {
            getHarga($(this))
        })

        $("#addItemKamar").click(function(e) {
            e.preventDefault();
            var dataRow = parseInt($('#row-kamar').attr('data-row'))
            $.ajax({
                type: 'get',
                url: '<?= base_url() . 'periksamedis/newItemRawatInap' ?>',
                data: {
                    no: dataRow + 1
                },
                success: function(data) {
                    $('#row-kamar').append(data)
                    $('#row-kamar').attr('data-row', dataRow + 1)
                    $(".getHarga").change(function() {
                        getHarga($(this))
                    })
                    $(".loop-kamar .qty").keyup(function() {
                        var dataNo = $(this).closest('.loop-kamar').attr('data-no')
                        subTotalKamar(dataNo)
                        totalKamar()
                    })
                    $(".tipe-kamar").change(function() {
                        getKamar($(this))
                    })
                    $(".loop-kamar .hari").keyup(function() {
                        var dataNo = $(this).closest('.loop-kamar').attr('data-no')
                        if($(".loop-kamar[data-no='"+dataNo+"'] .idKamar").val()!=''){
                            subTotalKamar(dataNo)
                            totalKamar()
                        }
                    })
                    $(".idKamar").change(function(){
                        var dataNo = $(this).closest('.loop-kamar').attr('data-no')
                        var thisVal = $(this).val()

                        if(thisVal!=''){
                            $(".loop-kamar[data-no='" + dataNo + "'] .hari").val(1)
                            subTotalKamar(dataNo)
                            totalKamar()
                        }
                    })




                    $(".remove-kamar").click(function(e) {
                        e.preventDefault();
                        var dataNo = $(this).attr('data-no')
                        var dataRow = parseInt($('#row-kamar').attr('data-row'))
                        $('.loop-kamar[data-no="' + dataNo + '"]').remove()
                        $('#row-kamar').attr('data-row', dataRow - 1)
                        subTotalKamar(dataNo)
                        totalKamar()

                    })
                    $(".select2").select2()
                }
            })
        })

        function totalKamar() {
            var totalKamar = 0
            $(".loop-kamar .subtotal").each(function(i, v) {
                var subTotal = parseInt(v.value)
                totalKamar += subTotal
            })
            $("#totalKamar").val(totalKamar)
            grandTotal()
        }

        function grandTotal() {
            var totalKamar = parseInt($("#totalKamar").val())
            var totalBiaya = parseInt($("#totalBiaya").val())
            var totalObat = parseInt($("#totalObat").val())
            var totalAlkes = parseInt($("#totalAlkes").val())
            var totalTindakan = parseInt($("#totalTindakan").val())

            var grandTotal = totalObat + totalAlkes + totalTindakan + totalKamar + totalBiaya
            $("#grandTotal").val(grandTotal)
        }
        <?php 
            $this->load->view('template/periksaJS');
        ?>
    })
</script>