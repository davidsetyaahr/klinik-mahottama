<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">PERIKSA RADIOLOGI</h3>
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
                            <div class="form-group" id="row-radiologi" data-row='0'>
                                <?php 
                                    $this->load->view('periksa-radiologi/loop-pilihan-radiologi',['no' => 0])
                                ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <a href="" class="btn btn-info btn-sm" id="addItemRadiologi"><span class="fa fa-plus"></span> Tambah Item</a>
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
                            <div class="form-group row">
                                <div class="col-sm-2">Total Biaya Periksa Radiologi</div>
                                <div class="col-sm-10">
                                    <input type="text" id="totalRadiologi" class="form-control" value='0' readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">Total Biaya Obat</div>
                                <div class="col-sm-10">
                                    <input type="text" id="totalObat" class="form-control" value='0' readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">Total Biaya BMHP</div>
                                <div class="col-sm-10">
                                    <input type="text" id="totalAlkes" class="form-control" value='0' readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">Total Biaya Tindakan</div>
                                <div class="col-sm-10">
                                    <input type="text" id="totalTindakan" class="form-control" value='0' readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">Grand Total</div>
                                <div class="col-sm-10">
                                    <input type="text" id="grandTotal" class="form-control" value='0' readonly>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
							<div class="col-sm-2">Pemeriksaan Selanjutnya</div>
							<div class="col-sm-10">
                                <select name="pemeriksaan_selanjutnya" id="" style="width:100%" class="select2 form-control">
                                        <option value="0">Tidak Ada</option>
                                        <option value="1">Rawat Inap</option>
                                        <option value="2">Laboratorium</option>
                                        <option value="3">Radiologi</option>
                                </select>
							</div>
						</div>
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

        function getHargaRadiologi(thisAttr){
            var getHarga = thisAttr.find(':selected').data('harga')
            var dataId = thisAttr.closest('.loop-radiologi').attr('data-no')
            $(".loop-radiologi[data-no='"+dataId+"'] .total").val(getHarga);
        }
        $(".periksaRadiologi").change(function(){
            getHargaRadiologi($(this))
            totalPeriksaRadiologi()
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
        $(".loop-obat .qty").change(function(){
            var dataNo = $(this).closest('.loop-obat').attr('data-no')
            subTotalObat(dataNo)    
            totalObat()        
        })
        $(".loop-obat .obat").change(function(){
            var dataNo = $(this).closest('.loop-obat').attr('data-no')
            subTotalObat(dataNo)   
            totalObat()         
        })

        function subTotalAlkes(dataNo){
            var qty = parseInt($(".loop-alkes[data-no='"+dataNo+"'] .qty").val())
            var harga = parseInt($(".loop-alkes[data-no='"+dataNo+"'] .harga").val())
            var subtotal = isNaN(qty*harga) ? 0 : qty*harga 
            $(".loop-alkes[data-no='"+dataNo+"'] .total").val(subtotal)
        }
        $(".loop-alkes .qty").change(function(){
            var dataNo = $(this).closest('.loop-alkes').attr('data-no')
            subTotalAlkes(dataNo)     
            totalAlkes()       
        })
        $(".alkes").change(function(){
            var dataNo = $(this).closest('.loop-alkes').attr('data-no')
            subTotalAlkes(dataNo)    
            totalAlkes()          
        })

        $("#addItemRadiologi").click(function(e){
            e.preventDefault();
            var dataRow = parseInt($('#row-radiologi').attr('data-row'))
            $.ajax({
                type : 'get',
                url : '<?= base_url().'periksamedis/newItemradiologi' ?>',
                data : {no : dataRow+1},
                success : function(data){
                    $('#row-radiologi').append(data)
                    $('#row-radiologi').attr('data-row',dataRow + 1)
                    $(".periksaRadiologi").change(function(){
                        getHargaRadiologi($(this))
                        totalPeriksaRadiologi()
                    })
                    $(".remove-radiologi").click(function(e){
                        e.preventDefault();
                        var dataNo = $(this).attr('data-no')
                        var dataRow = parseInt($('#row-radiologi').attr('data-row'))
                        $('.loop-radiologi[data-no="'+dataNo+'"]').remove()
                        $('#row-radiologi').attr('data-row',dataRow-1)
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
                    $(".loop-obat .qty").change(function(){
                        var dataNo = $(this).closest('.loop-obat').attr('data-no')
                        subTotalObat(dataNo)    
                        totalObat()        
                    })
                    $(".loop-obat .obat").change(function(){
                        var dataNo = $(this).closest('.loop-obat').attr('data-no')
                        subTotalObat(dataNo)   
                        totalObat()         
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
                    $(".loop-alkes .qty").change(function(){
                        var dataNo = $(this).closest('.loop-alkes').attr('data-no')
                        subTotalAlkes(dataNo) 
                        totalAlkes()             
                    })
                    $(".alkes").change(function(){
                        var dataNo = $(this).closest('.loop-alkes').attr('data-no')
                        subTotalAlkes(dataNo)  
                        totalAlkes()            
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
        
        $("#addItemTindakan").click(function(e){
            e.preventDefault();
            var dataRow = parseInt($('#row-tindakan').attr('data-row'))
            $.ajax({
                type : 'get',
                url : '<?= base_url().'periksamedis/newItemLoopTindakan' ?>',
                data : {no : dataRow+1},
                success : function(data){
                    $('#row-tindakan').append(data)
                    $('#row-tindakan').attr('data-row',dataRow + 1)


                    $(".remove-tindakan").click(function(e){
                        e.preventDefault();
                        var dataNo = $(this).attr('data-no')
                        var dataRow = parseInt($('#row-tindakan').attr('data-row'))
                        $('.loop-tindakan[data-no="'+dataNo+'"]').remove()
                        $('#row-tindakan').attr('data-row',dataRow-1)
                    })
                    $(".select2").select2()
                }
            })
        })

        function totalPeriksaRadiologi(){
            var totalRadiologi = 0
            $(".loop-radiologi .total").each(function(i,v){
                var subtotal = parseInt(v.value)
                totalRadiologi+=subtotal
            })
            $("#totalRadiologi").val(totalRadiologi)
            grandTotal()
        }

        function totalObat() {
            var totalObat = 0
            $(".loop-obat .total").each(function(i,v){
                var subTotal = parseInt(v.value)
                totalObat+=subTotal
            })
            $("#totalObat").val(totalObat)
            grandTotal()
        }

        $(".tindakan").change(function(){
            var totalTindakan = 0
            var valTindakan = $(this).val()
            if(valTindakan!=null){
                $.each(valTindakan, function(i,v){
                    var harga = parseInt($(".tindakan option[value='"+v+"']").attr('data-harga'))
                    totalTindakan+=harga
                })
            }
            $("#totalTindakan").val(totalTindakan)
            grandTotal()
        })

        function totalAlkes(){
            var totalAlkes = 0
            $(".loop-alkes .total").each(function(i,v){
                var subtotal = parseInt(v.value)
                totalAlkes+=subtotal
            })
            $("#totalAlkes").val(totalAlkes)
            grandTotal()
        }

        function grandTotal(){
            var totalObat = parseInt($("#totalObat").val())
            var totalAlkes = parseInt($("#totalAlkes").val())
            var totalTindakan = parseInt($("#totalTindakan").val())
            var totalRadiologi = parseInt($("#totalRadiologi").val())

            var grandTotal = totalObat + totalAlkes + totalTindakan + totalRadiologi
            $("#grandTotal").val(grandTotal)
        }
    })
</script>