<div class="row loop-alkes" data-no="<?= $no ?>">
<br>
<div class="col-md-5">
        <select name="kode_alkes[]" class="form-control select2 selectAlkes alkes">
            <option value="">---Pilih Alkes---</option>
            <?php 
            foreach ($alkes as $key => $value) {
                $s = isset($selected) && $selected['value']->kode_barang == $value->kode_barang ? 'selected' : ''; 
                echo "<option data-stok='".$value->stok_barang."' data-harga='".$value->harga."' value='".$value->kode_barang."' $s>".$value->nama_barang."</option>";
            }
        ?>
        </select>
    </div>
    <div class="col-md-2">
        <select name="jml_alkes[]" class="form-control stokAlkes qty" >
        <?php 
                if(isset($selected)){
                    echo "<option>".$selected['value']->jumlah."</option>";
                }
            ?>
        </select>
        <!-- <input type="text" name="hasil[]" class="form-control" placeholder="Hasil" id="" style="<?php echo ($no!=0) ? 'margin-right:10px' : '' ?>"> -->
    </div>
    <div class="col-md-2">
        <input type="text" name="harga_alkes[]" value="<?= isset($selected) ? $selected['value']->harga_satuan : '' ?>" class="form-control harga" placeholder="Harga alkes" readonly>
    </div>
    <div class="<?= $no!=0 ? 'col-md-2' : 'col-md-3' ?>">
        <input type="text" name="subtotal_alkes[]" class="form-control total" value="<?= isset($selected) ? $selected['value']->harga_satuan * $selected['value']->jumlah : '' ?>" placeholder="Sub Total" readonly>
    </div>
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <a href="" class="btn btn-danger btn-sm remove-alkes" data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
</div>