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
                            <div class="form-group" id="row-kamar" data-row='0'>
                                <?php 
                                    $this->load->view('rawat-inap/loop-pilihan-kamar',['no' => 0])
                                ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <a href="" class="btn btn-info btn-sm" id="addItemKamar"><span class="fa fa-plus"></span> Tambah Item</a>
                                </div>
                            </div>
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
        function selectAlkes(thisAttr){
            var stok = thisAttr.find(':selected').data('stok')
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
        }

        $(".selectAlkes").change(function(){
            selectAlkes($(this))            
        })

        function selectObat(thisAttr){
            var stok = thisAttr.find(':selected').data('stok')
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
        }

        $(".selectObat").change(function(){
            selectObat($(this))            
        })
        
        function getHarga(thisParam){
            var harga = thisParam.find(":selected").attr('data-harga')
            var getNo = thisParam.closest('.loop-kamar').attr('data-no')
            $(".box-body[data-no='"+getNo+"'] .harga").val(harga)
            // $(".box-body[data-no='"+getNo+"'] .jumlah option").remove()
            // for (let index = stok; index > 0; index--) {
            //     $(".box-body[data-no='"+getNo+"'] .jumlah").append("<option>"+index+"</option>")
            // }
        }
        $(".getHarga").change(function(){
            getHarga($(this))
        })

        function selectBiaya(thisAttr){
            var harga = thisParam.find(":selected").attr('data-harga')
            var getNo = thisParam.closest('.loop-biaya').attr('data-no')
            $(".box-body[data-no='"+getNo+"'] .harga").val(harga)
            
        }

        $(".selectBiaya").change(function(){
            selectBiaya($(this))            
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
                    // $(".select2").select2()
                    $(".selectAlkes").change(function(){
                        selectAlkes($(this))
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
                    // $(".select2").select2()
                    $(".selectAlkes").change(function(){
                        selectAlkes($(this))
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
                    // $(".select2").select2()
                    $(".selectAlkes").change(function(){
                        selectAlkes($(this))
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