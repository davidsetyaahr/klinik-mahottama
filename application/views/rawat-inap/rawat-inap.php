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
        // function selectAlkes(thisAttr){
        //     var stok = thisAttr.find(':selected').data('stok')
        //     var dataId = thisAttr.closest('.loop-kamar').attr('data-no')
        //     $(".loop-kamar[data-no='"+dataId+"'] .stokAlkes option").remove();
        //     var option = "";
        //     if(stok==0){
        //         option = "<option value=''>Habis</option>";
        //     }
        //     else{
        //         for (let s = 1; s <= stok; s++) {
        //             option+="<option>"+s+"</option>";
        //         }
        //     }
        //     $(".loop-kamar[data-no='"+dataId+"'] .stokAlkes").append(option);
        // }

        // $(".selectAlkes").change(function(){
        //     selectAlkes($(this))            
        // })
        
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
    })
</script>