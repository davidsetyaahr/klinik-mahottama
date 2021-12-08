<div class="row loop-obat" data-no="<?= $no ?>">
<br>
<div class="col-md-5">
        <select name="kode_obat[]" class="form-control select2 selectObat obat">
            <option value="">---Pilih Obat---</option>
            <?php 
            foreach ($obat as $key => $value) {
                    echo "<option data-stok='".$value->stok_barang."' data-harga='".$value->harga."' value='".$value->kode_barang."'>".$value->nama_barang."</option>";
            }
        ?>
        </select>
    </div>
    <div class="col-md-2">
        <select name="jml_obat[]" class="form-control stokObat qty">
        </select>
        <!-- <input type="text" name="hasil[]" class="form-control" placeholder="Hasil" id="" style="<?php echo ($no!=0) ? 'margin-right:10px' : '' ?>"> -->
    </div>
    <div class="col-md-2">
        <input type="text" class="form-control harga" placeholder="Harga Obat" readonly>
    </div>
    <div class="<?= $no!=0 ? 'col-md-2' : 'col-md-3' ?>">
    <input type="text" class="form-control total" placeholder="Sub Total" readonly>
    </div>
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <a href="" class="btn btn-danger btn-sm remove-obat" data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
</div>