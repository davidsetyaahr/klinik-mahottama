<div class="row loop-alat" data-no="<?= $no ?>">
<br>
<div class="col-md-6">
<div id="container_alat"></div>
        <select name="id_alat[]" class="form-control select2 selectAlat">
            <option value="">---Pilih Alat---</option>
        <?php 
                foreach ($alat as $key => $value) {
                    echo "<option data-stok='".$value->stok_tidak_terpakai."' value='".$value->id."'>".$value->nama."</option>";
                }
        ?>
        </select>
    </div>
    <div class="<?= $no != 0 ? 'col-md-5' : 'col-md-6' ?>">
        <select name="qty_alat[]" id="qty_alat" class="form-control stokAlat">
            <?php
            for ($i = 1; $i <= $stok[0]->stok_barang; $i++) {
                echo "<option>$i</option>";
            }
            ?>
        </select>
    </div>
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <a href="" class="btn btn-danger btn-sm remove-alat" data-no=<?= $no ?>><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
</div>