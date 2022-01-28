<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA DESA</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
                <table class='table table-bordered'>  
                    <tr><td width='200'>Kabupaten</td><td>
                    <select name="id_kabupaten" class="form-control select2" id="kabupaten">
                        <option value="">---Pilih Kabupaten--</option>
                        <?php 
                            foreach ($kabupaten as $key => $value) {
                                $s = $value->id==$id_kabupaten ? 'selected' : '';
                                echo "<option value='".$value->id."' $s>".$value->kabupaten."</option>";
                            }  
                        ?>
                    </select>
                    </td></tr>
                    <tr><td width='200'>Kecamatan <?php echo form_error('id_kecamatan') ?></td><td>
                        <select name="id_kecamatan" class="form-control select2" id="kecamatan">
                            <option value="">---Pilih Kecamatan--</option>
                            <?php 
                                if($id_kecamatan!=""){
                                    $getKecamatan = $this->db->get_where("tbl_kecamatan",['id_kabupaten' => $id_kabupaten])->result();
                                    foreach ($getKecamatan as $key => $value) {
                                        $s = $value->id==$id_kecamatan ? 'selected' : '';
                                        echo "<option value='".$value->id."' $s>".$value->kecamatan."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </td></tr>
                    <tr><td width='200'>Desa <?php echo form_error('desa') ?></td><td><input type="text" class="form-control" name="desa" id="desa" placeholder="Desa" value="<?php echo $desa; ?>" /></td></tr>
                    
                    <tr><td></td><td>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                        <a href="<?php echo site_url('desa') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table>
                </form>        
            </div>
    </section>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script>
    $(document).ready(function() {
        $("#kabupaten").change(function(){
            var thisVal = $(this).val()
            $("#kecamatan").prop('disabled','true')

            $.ajax({
                type : "get",
                data : {id_kabupaten:thisVal},
                url : "<?= base_url()."kecamatan/kecamatanByKab" ?>",
                dataType : 'json',
                success : function(res){
                    $("#kecamatan").removeAttr('disabled')
                    $("#kecamatan option[value!='']").remove()
                    $("#desa option[value!='']").remove()
                    $("#dusun option[value!='']").remove()
                    $.each(res,function(i,v){
                        $("#kecamatan").append(`<option value='${v.id}'>${v.kecamatan}</option>`)
                    })
                    $(".select2").select2()
                }
            })
        })
        $("#kecamatan").change(function(){
            var thisVal = $(this).val()
            $("#desa").prop('disabled','true')

            $.ajax({
                type : "get",
                data : {id_kecamatan:thisVal},
                url : "<?= base_url()."desa/desaByKec" ?>",
                dataType : 'json',
                success : function(res){
                    $("#desa").removeAttr('disabled')
                    $("#desa option[value!='']").remove()
                    $("#dusun option[value!='']").remove()
                    $.each(res,function(i,v){
                        $("#desa").append(`<option value='${v.id}'>${v.desa}</option>`)
                    })
                    $(".select2").select2()
                }
            })
        })
    })
</script>