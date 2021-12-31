<div class="row loop-alat" data-no="<?= $no ?>">
<br>
<div class="col-md-6">
<div id="container_alat"></div>
        <select name="id_alat[]" class="form-control select2">
            <option value="">---Pilih Alat---</option>
        <?php 
                foreach ($obat as $key => $value) {
                    echo "<option data-stok='".$value->stok_barang."' data-harga='".$value->harga."' value='".$value->kode_barang."'>".$value->nama_barang."</option>";
                }
        ?>
        </select>
    </div>
    <div class="<?= $no!=0 ? 'col-md-6' : 'col-md-5' ?>">
        <select name="jumlah[]" id="qty_alat" class="form-control">
            <?php
                    for ($i=1; $i <= $stok[0]->stok_barang;$i++) {
                        echo "<option>$i</option>";
                    }
            ?>
        </select>
    </div>
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <a href="" class="btn btn-danger btn-sm remove-alat data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
</div>