<div class="row loop-radiologi" data-no="<?= $no ?>">
<br>
    <div class="col-md-6">
    <div>
            <?= form_error("periksa_radiologi[$no]"); ?>
        </div>
        <select name="periksa_radiologi[<?= $no ?>]" class="form-control select2 periksaRadiologi" style="width:100%">
        <option value="">---Pilih Pemeriksaan Radiologi---</option>
        <?php 
                foreach ($periksa_radiologi as $key => $value) {
                    $selected = set_value("periksa_radiologi[$no]")==$value->id_tipe ? 'selected' : '';
                    echo "<option value='".$value->id_tipe."' data-harga='".$value->harga."'$selected>".$value->item."</option>";
                }
                ?>
        </select>
    </div>
    <!-- <div class="col-md-2"> -->
        <input type="hidden" name="harga_periksa_radiologi[]" class="form-control total" value="<?= form_error("harga_periksa_radiologi[$no]")=="" ? 0 : form_error("harga_periksa_radiologi[$no]") ?>" placeholder="Harga" id="" readonly>
    <!-- </div> -->
    <div class="<?= $no!=0 ? 'col-md-5' : 'col-md-6' ?>">
        <div>
            <?= form_error("hasil[$no]"); ?>    
        </div>
        <input type="text" name="hasil[<?= $no ?>]" value="<?= set_value("hasil[$no]") ?>" class="form-control" placeholder="Hasil" id="" style="<?php echo ($no!=0) ? 'margin-right:10px' : '' ?>">
    </div>
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <a href="" class="btn btn-danger btn-sm remove-radiologi" data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
    
</div>