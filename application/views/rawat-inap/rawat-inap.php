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
                        <form action="<?= base_url()."periksamedis/save_periksa_radiologi" ?>" method="post">
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
                                        $this->load->view('rawat-inap/loop-pilihan-kamar',['no' => 0])
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
                                    $this->load->view('rawat-inap/loop-pilihan-biaya',['no' => 0])
                                ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <a href="" class="btn btn-info btn-sm" id="addItemBiaya"><span class="fa fa-plus"></span> Tambah Item</a>
                                </div>
                            </div>
                            <div class="form-group" id="row-obat" data-row='0'>
                                <?php 
                                    $this->load->view('loop/loop-pilihan-obat',['no' => 0])
                                ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <a href="" class="btn btn-info btn-sm" id="addItemObat"><span class="fa fa-plus"></span> Tambah Item</a>
                                </div>
                            </div>
                            <div class="form-group" id="row-alkes" data-row='0'>
                                <?php 
                                    $this->load->view('loop/loop-pilihan-alkes',['no' => 0])
                                ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <a href="" class="btn btn-info btn-sm" id="addItemAlkes"><span class="fa fa-plus"></span> Tambah Item</a>
                                </div>
                            </div>
                            <div class="form-group" id="row-tindakan" data-row='0'>
                                <?php 
                                    $this->load->view('loop/loop-pilihan-tindakan',['no' => 0])
                                ?>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-md-5 pull-right">
                                    <input type="text" class="form-control grandtotal" placeholder="Grand Total" readonly>
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
    $(document).ready(function(){
        function get_kamar(selectObject = null, isCheckJml = false){

        }
        function selectAlkes(thisAttr){
            var stok = thisAttr.find(':selected').data('stok')
            var harga = thisAttr.find(':selected').data('harga')
            var dataId = thisAttr.closest('.loop-alkes').attr('data-no')
            $(".loop-alkes[data-no='"+dataId+"'] .stokAlkes option").remove();
            var option = "";
            if(stok==0){
                option = "<option value=''>Habis</option>";
            }
            else{
                for (let s = 1; s <= stok; s++) {
                    option+="<option>"+s+"</option>";
                }
            }
            $(".loop-alkes[data-no='"+dataId+"'] .stokAlkes").append(option);
            $(".loop-alkes[data-no='"+dataId+"'] .harga").val(harga)
        }

        $(".selectAlkes").change(function(){
            selectAlkes($(this))            
        })

        function selectObat(thisAttr){
            var stok = thisAttr.find(':selected').data('stok')
            var harga = thisAttr.find(':selected').data('harga')
            var dataId = thisAttr.closest('.loop-obat').attr('data-no')
            $(".loop-obat[data-no='"+dataId+"'] .stokObat option").remove();
            var option = "";
            if(stok==0){
                option = "<option value=''>Habis</option>";
            }
            else{
                for (let s = 1; s <= stok; s++) {
                    option+="<option>"+s+"</option>";
                }
            }
            $(".loop-obat[data-no='"+dataId+"'] .stokObat").append(option);
            $(".loop-obat[data-no='"+dataId+"'] .harga").val(harga);
        }

        $(".selectObat").change(function(){
            selectObat($(this))            
        })

        function subTotalObat(dataNo){
            var qty = parseInt($(".loop-obat[data-no='"+dataNo+"'] .qty").val())
            var harga = parseInt($(".loop-obat[data-no='"+dataNo+"'] .harga").val())
            var subtotal = isNaN(qty*harga) ? 0 : qty*harga 
            $(".loop-obat[data-no='"+dataNo+"'] .total").val(subtotal)
        }
        $(".qty").change(function(){
            var dataNo = $(this).closest('.loop-obat').attr('data-no')
            subTotalObat(dataNo)            
        })
        $(".obat").change(function(){
            var dataNo = $(this).closest('.loop-obat').attr('data-no')
            subTotalObat(dataNo)            
        })

        function subTotalAlkes(dataNo){
            var qty = parseInt($(".loop-alkes[data-no='"+dataNo+"'] .qty").val())
            var harga = parseInt($(".loop-alkes[data-no='"+dataNo+"'] .harga").val())
            var subtotal = isNaN(qty*harga) ? 0 : qty*harga 
            $(".loop-alkes[data-no='"+dataNo+"'] .total").val(subtotal)
        }
        $(".qty").change(function(){
            var dataNo = $(this).closest('.loop-alkes').attr('data-no')
            subTotalAlkes(dataNo)            
        })
        $(".alkes").change(function(){
            var dataNo = $(this).closest('.loop-alkes').attr('data-no')
            subTotalAlkes(dataNo)            
        })

        function subTotalKamar(dataNo){
            var qty = parseInt($(".loop-kamar[data-no='"+dataNo+"'] .qty").val())
            var harga = parseInt($(".loop-kamar[data-no='"+dataNo+"'] .harga").val())
            var subtotal = isNaN(qty*harga) ? 0 : qty*harga 
            $(".loop-kamar[data-no='"+dataNo+"'] .total").val(subtotal)
        }
        $(".qty").keyup(function(){
            var dataNo = $(this).closest('.loop-kamar').attr('data-no')
            subTotalKamar(dataNo)            
        })
        $(".tipe-kamar").change(function(){
            var dataNo = $(this).closest('.loop-kamar').attr('data-no')
            subTotalKamar(dataNo)            
        })

        function getHarga(thisParam){
            var harga = thisParam.find(":selected").attr('data-harga')
            var getNo = thisParam.closest('.loop-kamar').attr('data-no')
            $(".loop-kamar[data-no='"+getNo+"'] .harga").val(harga)
            }
            $(".getHarga").change(function(){
                getHarga($(this))
            })

        $("#addItemKamar").click(function(e){
            e.preventDefault();
            var dataRow = parseInt($('#row-kamar').attr('data-row'))
            $.ajax({
                type : 'get',
                url : '<?= base_url().'periksamedis/newItemRawatInap' ?>',
                data : {no : dataRow+1},
                success : function(data){
                    $('#row-kamar').append(data)
                    $('#row-kamar').attr('data-row',dataRow + 1)
                    $(".getHarga").change(function(){
                        getHarga($(this))
                    })
                    $(".qty").keyup(function(){
                        var dataNo = $(this).closest('.loop-kamar').attr('data-no')
                        subTotalKamar(dataNo)            
                    })
                    $(".tipe-kamar").change(function(){
                        var dataNo = $(this).closest('.loop-kamar').attr('data-no')
                        subTotalKamar(dataNo)            
                    })

                    $(".remove-kamar").click(function(e){
                        e.preventDefault();
                        var dataNo = $(this).attr('data-no')
                        var dataRow = parseInt($('#row-kamar').attr('data-row'))
                        $('.loop-kamar[data-no="'+dataNo+'"]').remove()
                        $('#row-kamar').attr('data-row',dataRow-1)
                    })
                    $(".select2").select2()
                }
            })
        })

        function subTotalBiaya(dataNo){
            var qty_biaya = parseInt($(".loop-biaya[data-no='"+dataNo+"'] .qty_biaya").val())
            var biaya = parseInt($(".loop-biaya[data-no='"+dataNo+"'] .biaya").val())
            var subtotal = isNaN(qty_biaya*biaya) ? 0 : qty_biaya*biaya 
            $(".loop-biaya[data-no='"+dataNo+"'] .total_biaya").val(subtotal)
        }

        $(".qty_biaya").keyup(function(){
            var dataNo = $(this).closest('.loop-biaya').attr('data-no')
            subTotalBiaya(dataNo)            
        })
        $(".tipe-biaya").change(function(){
            var dataNo = $(this).closest('.loop-biaya').attr('data-no')
            subTotalBiaya(dataNo)            
        })

        function getBiaya(thisParam){
            var biaya = thisParam.find(":selected").attr('data-biaya')
            var getNo = thisParam.closest('.loop-biaya').attr('data-no')
            $(".loop-biaya[data-no='"+getNo+"'] .biaya").val(biaya)
        }

        $(".getBiaya").change(function(){
            getBiaya($(this))
        })

        function grandTotal(){
            var x = subTotalBiaya(dataNo)+subTotalBiaya(dataNo)
            console.log(x);
        }

        $("#addItemBiaya").click(function(e){
            e.preventDefault();
            var dataRow = parseInt($('#row-biaya').attr('data-row'))
            $.ajax({
                type : 'get',
                url : '<?= base_url().'periksamedis/newItemRawatInapBiaya' ?>',
                data : {no : dataRow+1},
                success : function(data){
                    $('#row-biaya').append(data)
                    $('#row-biaya').attr('data-row',dataRow + 1)
                    $(".getBiaya").change(function(){
                        getBiaya($(this))
                    })
                    $(".qty_biaya").keyup(function(){
                        var dataNo = $(this).closest('.loop-biaya').attr('data-no')
                        subTotalBiaya(dataNo)            
                    })
                    $(".tipe-biaya").change(function(){
                        var dataNo = $(this).closest('.loop-biaya').attr('data-no')
                        subTotalBiaya(dataNo)            
                    })
                    $(".remove-biaya").click(function(e){
                        e.preventDefault();
                        var dataNo = $(this).attr('data-no')
                        var dataRow = parseInt($('#row-biaya').attr('data-row'))
                        $('.loop-biaya[data-no="'+dataNo+'"]').remove()
                        $('#row-biaya').attr('data-row',dataRow-1)
                    })
                    $(".select2").select2()
                }
            })
        })
        $("#addItemObat").click(function(e){
            e.preventDefault();
            var dataRow = parseInt($('#row-obat').attr('data-row'))
            $.ajax({
                type : 'get',
                url : '<?= base_url().'periksamedis/newItemLoopObat' ?>',
                data : {no : dataRow+1},
                success : function(data){
                    $('#row-obat').append(data)
                    $('#row-obat').attr('data-row',dataRow + 1)
                    $(".selectObat").change(function(){
                        selectObat($(this))            
                    })
                    $(".qty").change(function(){
                        var dataNo = $(this).closest('.loop-obat').attr('data-no')
                        subTotalObat(dataNo)            
                    })
                    $(".obat").change(function(){
                        var dataNo = $(this).closest('.loop-obat').attr('data-no')
                        subTotalObat(dataNo)            
                    })
                    $(".remove-obat").click(function(e){
                        e.preventDefault();
                        var dataNo = $(this).attr('data-no')
                        var dataRow = parseInt($('#row-obat').attr('data-row'))
                        $('.loop-obat[data-no="'+dataNo+'"]').remove()
                        $('#row-obat').attr('data-row',dataRow-1)
                    })
                    $(".select2").select2()
                }
            })
        })

        $("#addItemAlkes").click(function(e){
            e.preventDefault();
            var dataRow = parseInt($('#row-alkes').attr('data-row'))
            $.ajax({
                type : 'get',
                url : '<?= base_url().'periksamedis/newItemLoopAlkes' ?>',
                data : {no : dataRow+1},
                success : function(data){
                    $('#row-alkes').append(data)
                    $('#row-alkes').attr('data-row',dataRow + 1)
                    $(".selectAlkes").change(function(){
                        selectAlkes($(this))
                    })
                    $(".qty").change(function(){
                        var dataNo = $(this).closest('.loop-alkes').attr('data-no')
                        subTotalAlkes(dataNo)            
                    })
                    $(".alkes").change(function(){
                        var dataNo = $(this).closest('.loop-alkes').attr('data-no')
                        subTotalAlkes(dataNo)            
                    })
                    $(".remove-alkes").click(function(e){
                        e.preventDefault();
                        var dataNo = $(this).attr('data-no')
                        var dataRow = parseInt($('#row-alkes').attr('data-row'))
                        $('.loop-alkes[data-no="'+dataNo+'"]').remove()
                        $('#row-alkes').attr('data-row',dataRow-1)
                    })
                    $(".select2").select2()
                }
            })
        })
    })
</script>