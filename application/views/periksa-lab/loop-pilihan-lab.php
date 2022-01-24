<div class="row loop-lab" data-no="<?= $no ?>">
<br>
    <div class="col-md-6">
        <div>
            <?= form_error("periksa_lab[$no]"); ?>
        </div>
        <select name="periksa_lab[<?= $no ?>]" class="form-control select2 periksaLab" style="width:100%">
        <option value="">---Pilih Pemeriksaan LAB---</option>
            <?php 
                foreach ($periksa_lab as $key => $value) {
                    $selected = set_value("periksa_lab[$no]")==$value->id_tipe ? 'selected' : '';
                    echo "<option value='".$value->id_tipe."' data-harga='".$value->harga."' $selected>".$value->item."</option>";
                }
            ?>
        </select>
    </div>
    <!-- <div class="col-md-2"> -->
        <input type="hidden" name="harga_periksa_lab[]" value="<?= set_value("harga_periksa_lab[$no]")=="" ? 0 : set_value("harga_periksa_lab[$no]") ?>" class="form-control total" placeholder="Harga" id="" readonly>
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
            <a href="" class="btn btn-danger btn-sm remove-lab" data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
</div>