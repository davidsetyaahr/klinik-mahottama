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
                            <form action="<?= base_url() . "periksamedis/save_rawat_inap" ?>" method="post">
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
                                    <div class="form-group" id="row-kamar" data-row='<?= $edit ?  count((array)$getKamar) : 0 ?>'>
                                        <?php
                                            if($edit){
                                        ?>
                                            <input type="hidden" name="isEdit" value="true">
                                        <?php
                                                foreach ($getKamar as $key => $value) {
                                                    $data['value'] = $value;
                                                    $data['getKamarByKategori'] = $this->db->get_where('tbl_kamar',['id_kategori_kamar' => $value->id_kategori_kamar,'status' => '0'])->result();
                                                    $this->load->view('rawat-inap/loop-pilihan-kamar', ['no' => $key,'selected' => $data]);
                                                }
                                            }
                                            else{
                                                $this->load->view('rawat-inap/loop-pilihan-kamar', ['no' => 0]);
                                            }
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
                                <div class="form-group" id="row-biaya" data-row='<?= $edit ? count((array)$getBiaya) : 0 ?>'>
                                    <?php
                                        if($edit){
                                            foreach ($getBiaya as $key => $value) {
                                                $this->load->view('rawat-inap/loop-pilihan-biaya', ['no' => $key,'selected' => $value]);
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
                                <div class="form-group" id="row-obat" data-row='<?= $edit ? count((array)$getObat) : 0 ?>'>
                                    <?php
                                        if($edit){
                                            foreach ($getObat as $key => $value) {
                                                $getStok = $this->Tbl_obat_alkes_bhp_model->get_all_obat(null,false,1,$value->kode_barang);
                                                $this->load->view('loop/loop-pilihan-obat', ['no' => $key,'selected' => $value,'stok' => $getStok]);
                                            }
                                        }
                                        else{
                                            $this->load->view('loop/loop-pilihan-obat', ['no' => 0]);
                                        }
                                    ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <a href="" class="btn btn-info btn-sm" id="addItemObat"><span class="fa fa-plus"></span> Tambah Item</a>
                                    </div>
                                </div>
                                <div class="form-group" id="row-alkes" data-row='<?= $edit ? count((array)$getAlkes) : 0 ?>'>
                                    <?php
                                        if($edit){
                                            foreach ($getAlkes as $key => $value) {
                                                $getStok = $this->Tbl_obat_alkes_bhp_model->get_all_obat(null,false,2,$value->kode_barang);
                                                $this->load->view('loop/loop-pilihan-alkes', ['no' => $key,'selected' => $value,'stok' => $getStok]);
                                            }
                                        }
                                        else{
                                            $this->load->view('loop/loop-pilihan-alkes', ['no' => 0]);
                                        }
                                    ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <a href="" class="btn btn-info btn-sm" id="addItemAlkes"><span class="fa fa-plus"></span> Tambah Item</a>
                                    </div>
                                </div>
                                <div class="form-group" id="row-tindakan" data-row='<?= $edit ? count((array)$getTindakan) : 0 ?>'>
                                    <?php
                                        if($edit){
                                            // $totalBiayaTindakan = array_sum(array_column($getTindakan, 'biaya'));
                                             foreach ($getTindakan as $key => $value) {
                                                $this->load->view('loop/loop-pilihan-tindakan', ['no' => $key,'selected' => $value]);
                                            }
                                        }
                                        else{
                                            $this->load->view('loop/loop-pilihan-tindakan', ['no' => 0]);
                                        }
                                    ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <a href="" class="btn btn-info btn-sm" id="addItemTindakan"><span class="fa fa-plus"></span> Tambah Item</a>
                                    </div>
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
                                        <!-- <input type="text" id="member" onkeyup="addFields()" class="form-control" name="member" value="">Number of members: (max. 10)<br /> -->
                                        <!-- <div id="container"/> -->
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-2">Pemeriksaan Selanjutnya</div>
                                    <div class="col-sm-10">
                                        <select name="pemeriksaan_selanjutnya" id="" style="width:100%" class="select2 form-control">
                                            <option value="2">Tetap Di Rawat Inap</option>
                                            <option value="0">Pemeriksaan Selesai</option>
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
        <?php 
            if($edit){    
        ?>
            totalKamar()
            totalBiaya()
            totalObat()
            totalAlkes()
            totalTindakan()
            
            $(".oldChangeQtyHari").keyup(function(){
                var dataNo = $(this).closest('.loop-kamar').attr('data-no')
                var defaultHari = $(".loop-kamar[data-no='"+dataNo+"'] .hari").attr('data-hari')
                var newVal = $(this).val()
                var idDetail = $(".loop-kamar[data-no='"+dataNo+"']").attr('data-iddetail')

                if($(".upd_jml_hari_id[value='"+idDetail+"']").length==0 && defaultHari!=newVal && (newVal!='' && newVal!=0)){
                    $(".loop-kamar[data-no='"+dataNo+"']").append(`
                        <input type="hidden" name='upd_jml_hari_id[]' value='${idDetail}' class='upd_jml_hari_id'>
                        <input type="hidden" name='upd_jml_hari_val[]' value='${newVal}' data-id='${idDetail}' class='upd_jml_hari_val'>
                    `)
                }
                else if($(".upd_jml_hari_id[value='"+idDetail+"']").length==1 && defaultHari==newVal){
                    $(".upd_jml_hari_id[value='"+idDetail+"']").remove()
                    $(".upd_jml_hari_val[data-id='"+idDetail+"']").remove()
                }
                else if($(".upd_jml_hari_id[value='"+idDetail+"']").length==1 && newVal!=$(".upd_jml_hari_val[data-id='"+idDetail+"']").val()){
                    $(".upd_jml_hari_val[data-id='"+idDetail+"']").val(newVal)
                }
            })
            
            $(".oldChangeKamar").change(function(){
                var dataNo = $(this).closest('.loop-kamar').attr('data-no')
                var defaultIdKamar = $(".loop-kamar[data-no='"+dataNo+"'] .idKamar").attr('data-idkamar')
                var newVal = $(this).val()
                var idDetail = $(".loop-kamar[data-no='"+dataNo+"']").attr('data-iddetail')

                if($(".upd_id_kamar_id[value='"+idDetail+"']").length==0 && defaultIdKamar!=newVal && (newVal!='' && newVal!=0)){
                    $(".loop-kamar[data-no='"+dataNo+"']").append(`
                        <input type="hidden" name='upd_id_kamar_id[]' value='${idDetail}' class='upd_id_kamar_id'>
                        <input type="hidden" name='upd_id_kamar_val[]' value='${newVal}' data-id='${idDetail}' class='upd_id_kamar_val'>
                    `)
                }
                else if($(".upd_id_kamar_id[value='"+idDetail+"']").length==1 && defaultIdKamar==newVal){
                    $(".upd_id_kamar_id[value='"+idDetail+"']").remove()
                    $(".upd_id_kamar_val[data-id='"+idDetail+"']").remove()
                }
                else if($(".upd_id_kamar_id[value='"+idDetail+"']").length==1 && newVal!=$(".upd_id_kamar_val[data-id='"+idDetail+"']").val()){
                    $(".upd_id_kamar_val[data-id='"+idDetail+"']").val(newVal)
                }
            })

            $(".oldRemoveKamar").click(function(e){
                e.preventDefault()
                var dataNo = $(this).attr('data-no')
                var idDetail = $(this).attr('data-iddetail')
                
                $("#row-kamar").append(`
                    <input type="hidden" name='del_id_detail_rawat_inap[]' value='${idDetail}' class='del_id_detail_rawat_inap'>
                `)
            })

            $(".oldChangeQtyTindakan").keyup(function(){
                var dataNo = $(this).closest('.loop-tindakan').attr('data-no')
                var defaultTindakan = $(".loop-tindakan[data-no='"+dataNo+"'] .qty_tindakan").attr('data-qty')
                var newVal = $(this).val()
                var idDetail = $(".loop-tindakan[data-no='"+dataNo+"']").attr('data-iddetail')
                
                if($(".upd_qty_tindakan_id[value='"+idDetail+"']").length==0 && defaultTindakan!=newVal && (newVal!='' && newVal!=0)){
                    $(".loop-tindakan[data-no='"+dataNo+"']").append(`
                        <input type="hidden" name='upd_qty_tindakan_id[]' value='${idDetail}' class='upd_qty_tindakan_id'>
                        <input type="hidden" name='upd_qty_tindakan_val[]' value='${newVal}' data-id='${idDetail}' class='upd_qty_tindakan_val'>
                    `)
                }
                else if($(".upd_qty_tindakan_id[value='"+idDetail+"']").length==1 && defaultTindakan==newVal){
                    $(".upd_qty_tindakan_id[value='"+idDetail+"']").remove()
                    $(".upd_qty_tindakan_val[data-id='"+idDetail+"']").remove()
                }
                else if($(".upd_qty_tindakan_id[value='"+idDetail+"']").length==1 && newVal!=$(".upd_qty_tindakan_val[data-id='"+idDetail+"']").val()){
                    $(".upd_qty_tindakan_val[data-id='"+idDetail+"']").val(newVal)
                }
            })

            $(".oldRemoveTindakan").click(function(e){
                e.preventDefault()
                var dataNo = $(this).attr('data-no')
                var idDetail = $(this).attr('data-iddetail')
                
                $("#row-tindakan").append(`
                    <input type="hidden" name='del_id_detail_tindakan[]' value='${idDetail}' class='del_id_detail_tindakan'>
                `)
            })


            $(".oldChangeQtyBiaya").keyup(function(){
                var dataNo = $(this).closest('.loop-biaya').attr('data-no')
                var defaultBiaya = $(".loop-biaya[data-no='"+dataNo+"'] .qty_biaya").attr('data-qty')
                var newVal = $(this).val()
                var idDetail = $(".loop-biaya[data-no='"+dataNo+"']").attr('data-iddetail')
                
                if($(".upd_qty_biaya_id[value='"+idDetail+"']").length==0 && defaultBiaya!=newVal && (newVal!='' && newVal!=0)){
                    $(".loop-biaya[data-no='"+dataNo+"']").append(`
                        <input type="hidden" name='upd_qty_biaya_id[]' value='${idDetail}' class='upd_qty_biaya_id'>
                        <input type="hidden" name='upd_qty_biaya_val[]' value='${newVal}' data-id='${idDetail}' class='upd_qty_biaya_val'>
                    `)
                }
                else if($(".upd_qty_biaya_id[value='"+idDetail+"']").length==1 && defaultBiaya==newVal){
                    $(".upd_qty_biaya_id[value='"+idDetail+"']").remove()
                    $(".upd_qty_biaya_val[data-id='"+idDetail+"']").remove()
                }
                else if($(".upd_qty_biaya_id[value='"+idDetail+"']").length==1 && newVal!=$(".upd_qty_biaya_val[data-id='"+idDetail+"']").val()){
                    $(".upd_qty_biaya_val[data-id='"+idDetail+"']").val(newVal)
                }
            })

            $(".oldRemoveBiaya").click(function(e){
                e.preventDefault()
                var dataNo = $(this).attr('data-no')
                var idDetail = $(this).attr('data-iddetail')
                
                $("#row-biaya").append(`
                    <input type="hidden" name='del_id_detail_biaya[]' value='${idDetail}' class='del_id_detail_biaya'>
                `)
            })

            $(".oldChangeQtyObat").change(function(){
                var dataNo = $(this).closest('.loop-obat').attr('data-no')
                var defaultObat = $(".loop-obat[data-no='"+dataNo+"'] .qty").attr('data-qty')
                var newVal = $(this).val()
                var idDetail = $(".loop-obat[data-no='"+dataNo+"']").attr('data-iddetail')
                var kodeObat = $(".loop-obat[data-no='"+dataNo+"'] .obat").val()
                
                if($(".upd_qty_obat_id[value='"+idDetail+"']").length==0 && defaultObat!=newVal && (newVal!='' && newVal!=0)){
                    $(".loop-obat[data-no='"+dataNo+"']").append(`
                        <input type="hidden" name='upd_qty_obat_id[]' value='${idDetail}' class='upd_qty_obat_id'>
                        <input type="hidden" name='upd_qty_obat_val[]' data-id='${idDetail}' value='${newVal}' class='upd_qty_obat_val'>
                        <input type="hidden" name='upd_qty_obat_kode[]' value='${kodeObat}' class='upd_qty_obat_kode'>
                    `)
                }
                else if($(".upd_qty_obat_id[value='"+idDetail+"']").length==1 && defaultObat==newVal){
                    $(".upd_qty_obat_id[value='"+idDetail+"']").remove()
                    $(".upd_qty_obat_val[data-id='"+idDetail+"']").remove()
                    $(".upd_qty_obat_kode[value='"+kodeObat+"']").remove()
                }
                else if($(".upd_qty_obat_id[value='"+idDetail+"']").length==1 && newVal!=$(".upd_qty_obat_val[data-id='"+idDetail+"']").val()){
                    $(".upd_qty_obat_val[data-id='"+idDetail+"']").val(newVal)
                }
            })

            $(".oldRemoveObat").click(function(e){
                e.preventDefault()
                var dataNo = $(this).attr('data-no')
                var idDetail = $(this).attr('data-iddetail')
                var kodeObat = $(".loop-obat[data-no='"+dataNo+"'] .obat").val()
                
                $("#row-obat").append(`
                    <input type="hidden" name='del_id_detail_obat[]' value='${idDetail}' class='del_id_detail_obat'>
                    <input type="hidden" name='del_id_detail_obat_kode[]' value='${kodeObat}' class='del_id_detail_obat_kode'>
                `)
            })

            $(".oldChangeQtyAlkes").change(function(){
                var dataNo = $(this).closest('.loop-alkes').attr('data-no')
                var defaultAlkes = $(".loop-alkes[data-no='"+dataNo+"'] .qty").attr('data-qty')
                var newVal = $(this).val()
                var idDetail = $(".loop-alkes[data-no='"+dataNo+"']").attr('data-iddetail')
                var kodeAlkes = $(".loop-alkes[data-no='"+dataNo+"'] .alkes").val()
                
                if($(".upd_qty_alkes_id[value='"+idDetail+"']").length==0 && defaultAlkes!=newVal && (newVal!='' && newVal!=0)){
                    $(".loop-alkes[data-no='"+dataNo+"']").append(`
                        <input type="hidden" name='upd_qty_alkes_id[]' value='${idDetail}' class='upd_qty_alkes_id'>
                        <input type="hidden" name='upd_qty_alkes_val[]' value='${newVal}' data-id='${idDetail}' class='upd_qty_alkes_val'>
                        <input type="hidden" name='upd_qty_alkes_kode[]' value='${kodeAlkes}' class='upd_qty_alkes_kode'>
                    `)
                }
                else if($(".upd_qty_alkes_id[value='"+idDetail+"']").length==1 && defaultAlkes==newVal){
                    $(".upd_qty_alkes_id[value='"+idDetail+"']").remove()
                    $(".upd_qty_alkes_val[data-id='"+idDetail+"']").remove()
                    $(".upd_qty_alkes_kode[value='"+kodeAlkes+"']").remove()
                }
                else if($(".upd_qty_alkes_id[value='"+idDetail+"']").length==1 && newVal!=$(".upd_qty_alkes_val[data-id='"+idDetail+"']").val()){
                    $(".upd_qty_alkes_val[data-id='"+idDetail+"']").val(newVal)
                }
            })

            $(".oldRemoveAlkes").click(function(e){
                e.preventDefault()
                var dataNo = $(this).attr('data-no')
                var idDetail = $(this).attr('data-iddetail')
                var kodeAlkes = $(".loop-alkes[data-no='"+dataNo+"'] .alkes").val()
                
                $("#row-alkes").append(`
                    <input type="hidden" name='del_id_detail_alkes[]' value='${idDetail}' class='del_id_detail_alkes'>
                    <input type="hidden" name='del_id_detail_alkes_kode[]' value='${kodeAlkes}' class='del_id_detail_alkes_kode'>
                    `)
                })
                
            $(".oldChangeTindakan").change(function(){
                if($('.is_tindakan_update').length==0){
                    $("#row-tindakan").append(`
                    <input type="hidden" name='is_tindakan_update' class='is_tindakan_update' value='true'>
                    `)
                }
            })
        <?php } ?>

        function addIdKamar(){
            // for (i=0)
            var addNew = document.createElement("input")
            // input.type="text"
            createEle.innerHTML = "sd"
        }

        

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
                        removeKamar($(this))
                    })
                    
                    $(".select2").select2()
                }
            })
        })
        $(".remove-kamar").click(function(e) {
            e.preventDefault();
            removeKamar($(this))
        })

        function removeKamar(params){
            var dataNo = params.attr('data-no')
            var dataRow = parseInt($('#row-kamar').attr('data-row'))
            $('.loop-kamar[data-no="' + dataNo + '"]').remove()
            $('#row-kamar').attr('data-row', dataRow - 1)
            subTotalKamar(dataNo)
            totalKamar()

        }

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