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
        var max_fields      = 10; //maximum input boxes allowed
        var add_button_kamar = $("#addItemKamar");
        var add_button_biaya = $("#addItemBiaya");
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
            $(".loop-kamar[data-no='"+getNo+"'] .harga").val(harga)
            $("#qty").keyup(function(){
                var a = parseInt($("#qty").val());
                var b = parseInt($("#harga_kamar").val());
                var c = a*b;
            $("#total_harga").val(c);
            })
            $("#harga_kamar").keyup(function(){
                var a = parseInt($("#qty").val());
                var b = parseInt($("#harga_kamar").val());
                var c = a*b;
                $("#total_harga").val(c);
            })
            // $(".box-body[data-no='"+getNo+"'] .jumlah option").remove()
            // for (let index = stok; index > 0; index--) {
            //     $(".box-body[data-no='"+getNo+"'] .jumlah").append("<option>"+index+"</option>")
            // }
        }
        $(".getHarga").change(function(){
            getHarga($(this))
        })

        // function getBiaya(thisParam){
        //     var harga = thisParam.find(":selected").attr('data-harga')
        //     var getNo = thisParam.closest('.loop-biaya').attr('data-no')
        //     $(".loop-biaya[data-no='"+getNo+"'] .harga").val(harga)
        //     // $(".box-body[data-no='"+getNo+"'] .jumlah option").remove()
        //     // for (let index = stok; index > 0; index--) {
        //     //     $(".box-body[data-no='"+getNo+"'] .jumlah").append("<option>"+index+"</option>")
        //     // }
        // }
        // $(".getBiaya").change(function(){
        //     getBiaya($(this))
        // })

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
                    $(".getHarga").change(function(){
                        getHarga($(this))
                    })
                    
                    $("#qty").keyup(function(){
                        var a = parseInt($("#qty").val());
                        var b = parseInt($("#harga_kamar").val());
                        var c = a*b;
                        $("#total_harga").val(c);
                    })
                    $("#harga_kamar").keyup(function(){
                        var a = parseInt($("#qty").val());
                        var b = parseInt($("#harga_kamar").val());
                        var c = a*b;
                        $("#total_harga").val(c);
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

        var x = 1 //initlal text box count 

        // $(add_button_kamar).click(function(e){
        //     e.preventDefault();

        //     var option_kamar = '<option value="">---Pilih Kamar---</option>'
        //     var kamar_option_js = ;
        //     for (i=1;i<kamar_option_js;i++){
        //         option_kamar += '<option value="'+kamar_option_js[i].value+'">'+kamar_option_js[i].label+'</option>'
        //     }

        //     var input_kamar = '<select id="kamar[]" name="kamar[]" class="form-control select2">'+option_kamar+'</select>';
        //     var input_qty_kamar = '<input id="qty[]" name="qty[]" type="text" class="form-control"';
        //     var sub_total_kamar = '<input id="harga_kamar[]" name="harga_kamar[]" type="text" value="" class="form-control" readonly="readonly" style="text-align:left;" />';

        //     if(x < max_fields){
        //         x++;
        //         ()
        //     }
        // });
        function getBiaya(thisParam){
            var biaya = thisParam.find(":selected").attr('data-biaya')
            var getNo = thisParam.closest('.loop-biaya').attr('data-no')
            $(".loop-biaya[data-no='"+getNo+"'] .biaya").val(biaya)
            $("#biaya").keyup(function(){
                var d = parseInt($("#qty_biaya").val());
                var e = parseInt($("#biaya").val());
                var f = d*e;
                $("#total_biaya").val(f);
            })
            $("#qty_biaya").keyup(function(){
                var d = parseInt($("#qty_biaya").val());
                var e = parseInt($("#biaya").val());
                var f = d*e;
                $("#total_biaya").val(f);
            })
            
        }

        $(".getBiaya").change(function(){
            getBiaya($(this))            
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
                    $(".getBiaya").change(function(){
                        getBiaya($(this))
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