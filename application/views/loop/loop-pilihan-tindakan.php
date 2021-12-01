<div class="row loop-tindakan" data-no="<?= $no ?>">
<br>
<div class="col-md-2">Pilih Tindakan</div>
<div class="<?= $no!=0 ? 'col-md-9' : 'col-md-10' ?>">
        <select name="kode_tindakan[]" class="form-control select2" at multiple="multiple">
        <?php 
            foreach ($tindakan as $key => $value) {
                    echo "<option value='".$value->kode_tindakan."'>".$value->tindakan."</option>";
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