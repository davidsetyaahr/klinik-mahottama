<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA BIAYA</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_biaya" value="<?= $id_biaya ?>">
                <table class='table table-bordered'>        
                        <tr><td width='200'>Nama Biaya <?php echo form_error('nama_biaya') ?></td><td><input type="text" class="form-control" name="nama_biaya" id="nama_biaya" placeholder="Nama Biaya" value="<?php echo $nama_biaya; ?>" /></td></tr>
                        <tr><td width='200'>Kategori Biaya <?php echo form_error('id_kategori_biaya') ?></td><td>
                            <select name="id_kategori_biaya" id="id_kategori_biaya" class="form-control select2">
                                <option value="0">Pilih Kategori Biaya</option>
                                <?php 
                                    foreach ($item as $key => $value) {
                                        $s = $value->id_kategori_biaya == $id_kategori_biaya ? 'selected' : '';
                                        echo "<option  value='".$value->id_kategori_biaya."' $s>".$value->item."</option>";
                                    }
                                ?>
                            </select>
                        </td></tr> 
                        <tr><td width='200'>Tipe Biaya <?php echo form_error('tipe_biaya') ?></td><td>
                            <select name="tipe_biaya" id="tipe_biaya" class="form-control select2">
                                <option value="1" <?= $tipe_biaya=='1' ? 'selected' : '' ?>>Biaya Fix</option>
                                <option value="2" <?= $tipe_biaya=='2' ? 'selected' : '' ?>>Persentase</option>
                            </select>
                        </td></tr> 
                        <tr id="row-persentase" <?= $tipe_biaya=='1' ? 'style="display:none"' : '' ?> ><td width='200'>Jumlah Persentase <?php echo form_error('persentase') ?></td><td>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="number" step="0.01" class="form-control" name="persentase" id="persentase" value="<?= $presentase ?>">
                                    <span class="input-group-addon">%</span>
                                </div>                        
                            </div>                                    
                            <div class="col-md-6">
                                <select name="id_biaya_persentase" id="id_biaya_persentase" class="form-control select2" style="width:100%">
                                    <option value="">Pilih Biaya</option>
                                    <?php
                                        foreach ($biayaFix as $key => $value) {
                                            $s = $id_biaya_presentase==$value->id_biaya ? 'selected' : '';
                                            echo "<option data-biaya='".$value->biaya."' value='".$value->id_biaya."' $s>".$value->nama_biaya." (".$value->biaya.")</option>";
                                        }
                                    ?>
                                </select>
                            </div>                                    
                        </div>
                        </td></tr> 
                        <tr><td width='200'>Biaya <?php echo form_error('biaya') ?></td><td><input type="int" class="form-control" name="biaya" id="biaya" placeholder="Biaya" value="<?php echo $biaya; ?>" <?= $tipe_biaya=='2' ? 'readonly' : '' ?> /></td></tr>
                        <tr><td width='200'>Untuk Dokter<?php echo form_error('is_id_dokter') ?></td><td>
                            <select name="is_id_dokter" id="is_id_dokter" class="form-control select2">
                                <option value="" <?= $is_id_dokter=='' ? 'selected' : '' ?>>Tidak Ada</option>
                                <?php
                                    foreach ($dokter as $key => $value) {
                                        $s = $is_id_dokter==$value->id_dokter ? 'selected' : '';
                                        echo "<option value='".$value->id_dokter."' $s>".$value->nama_dokter."</option>";
                                    }
                                ?>
                            </select>
                        </td></tr> 
                        <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('biaya') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table>
                </form>        
            </div>
</div>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script>
    $(document).ready(function(){
        $("#tipe_biaya").change(function(){
            var thisVal = $(this).val()
            if(thisVal==2){
                $("#row-persentase").show()
                $("#biaya").prop('readonly',true);
            }
            else{
                $("#row-persentase").hide()
                $("#biaya").prop('readonly',false);
            }
        })
        function getTtlBiaya(){
            var persentase = $("#persentase").val();
            var biaya = parseInt($("#id_biaya_persentase").find(':selected').data('biaya'));
            var ttl = persentase / 100 * biaya 
            ttl = isNaN(ttl) ? 0 : ttl
            $("#biaya").val(ttl)
        }
        $("#persentase").keyup(function(){
            getTtlBiaya()
        })
        $("#id_biaya_persentase").change(function(){
            getTtlBiaya()
        })

    })
</script>