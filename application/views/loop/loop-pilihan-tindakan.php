<div class="row loop-tindakan" data-no="<?= $no ?>">
<br>
<div class="col-md-2">Pilih Tindakan</div>
<div class="col-md-10">
        <select name="tindakan[]" multiple="multiple" style="width:100%" class="select2 form-control tindakan">
            <?php 
            // print_r($selected);
                foreach ($tindakan as $key => $value) {
                    $s = in_array($value->kode_tindakan, array_column($selected['value'], 'kode_tindakan')) ? 'selected' : '';
                    // $s = isset($selected) && $selected['value']->kode_tindakan == $value->kode_tindakan ? 'selected' : ''; 
                    echo "<option value='".$value->kode_tindakan."' data-harga='".$value->biaya."' $s>".$value->tindakan."</option>";
                }
            ?>
        </select>
    </div>
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <a href="" class="btn btn-danger btn-sm remove-tindakan" data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
</div>