<div class="row loop-alkes" data-no="<?= $no ?>" <?= isset($selected) ? "data-idDetail='".$selected->id_periksa_d_alkes."'" : '' ?>>
<br>
<div class="col-md-6">
        <select name="<?= isset($selected) ? 'old_' : '' ?>kode_alkes[]" class="form-control <?= !isset($selected) ? 'select2' : '' ?> selectAlkes alkes" <?= isset($selected) ? 'readonly' : '' ?>>
            <?php 
                if(!isset($selected)){
            ?>
                <option value="">---Pilih Alkes---</option>
            <?php 
            }
            if(isset($selected)){
                echo "<option data-stok='".$stok[0]->stok_barang."' data-harga='".$selected->harga_satuan."' value='".$selected->kode_barang."'>".$selected->nama_barang."</option>";
            }
            else{
                foreach ($alkes as $key => $value) {
                    echo "<option data-stok='".$value->stok_barang."' data-harga='".$value->harga."' value='".$value->kode_barang."'>".$value->nama_barang."</option>";
                }
            }
        ?>
        </select>
    </div>
    <div class="<?= $no!=0 ? 'col-md-5' : 'col-md-6' ?>">
        <select name="<?= isset($selected) ? 'old_' : '' ?>jml_alkes[]" class="form-control stokAlkes qty <?= isset($selected) ? 'oldChangeQtyAlkes' : ''  ?>"  <?= isset($selected) ? "data-qty='".$selected->jumlah."'" : ''  ?>>
        <?php 
                if(isset($selected)){
                    for ($i=1; $i <= $stok[0]->stok_barang;$i++) { 
                        $s = $i==$selected->jumlah ? 'selected' : '';
                        echo "<option $s>$i</option>";
                    }
                }
            ?>
        </select>
        <!-- <input type="text" name="hasil[]" class="form-control" placeholder="Hasil" id="" style="<?php echo ($no!=0) ? 'margin-right:10px' : '' ?>"> -->
    </div>
    <!-- <div class="col-md-2"> -->
        <input type="hidden" name="<?= isset($selected) ? 'old_' : '' ?>harga_alkes[]" value="<?= isset($selected) ? $selected->harga_satuan : '' ?>" class="form-control harga" placeholder="Harga alkes" readonly>
    <!-- </div> -->
    <!-- <div class="<?= $no!=0 ? 'col-md-2' : 'col-md-3' ?>"> -->
        <input type="hidden" name="<?= isset($selected) ? 'old_' : '' ?>subtotal_alkes[]" class="form-control total" value="<?= isset($selected) ? $selected->harga_satuan * $selected->jumlah : '' ?>" placeholder="Sub Total" readonly>
    <!-- </div> -->
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <a href="" class="btn btn-danger btn-sm remove-alkes <?= isset($selected) ? 'oldRemoveAlkes' : '' ?>" <?= isset($selected) ? "data-idDetail='".$selected->id_periksa_d_alkes."'" : '' ?> data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
</div>