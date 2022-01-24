<?php 
    if(!empty(set_value("kode_obat[$no]")) && isset($selected)){
        unset($selected);
    }
    $old = isset($selected) ? 'old_' : '';
?>
<div class="row loop-obat" data-no="<?= $no ?>"  <?= isset($selected) ? "data-idDetail='".$selected->id_periksa_d_obat."'" : '' ?>>
<br>
<div class="col-md-6">
<div id="container_biaya"></div>
        <select name="<?= isset($selected) ? 'old_' : '' ?>kode_obat[]" class="form-control <?= !isset($selected) ? 'select2' : '' ?> selectObat obat" <?= isset($selected) ? 'readonly' : '' ?> data-selectedqty="<?= set_value("jml_obat[$no]") ?>">
        <?php
            if(!isset($selected)){
        ?>
            <option value="">---Pilih Obat---</option>
        <?php 
            }
            if(isset($selected)){
                echo "<option data-stok='".$stok[0]->stok_barang."' data-harga='".$selected->harga_satuan."' value='".$selected->kode_barang."'>".$selected->nama_barang."</option>";
            }
            else{
                foreach ($obat as $key => $value) {
                    $s = set_value("kode_obat[$no]")==$value->kode_barang ? 'selected' : '';
                    echo "<option data-stok='".$value->stok_barang."' data-harga='".$value->harga."' value='".$value->kode_barang."' $s>".$value->nama_barang."</option>";
                }
            }
        ?>
        </select>
    </div>
    <div class="<?= $no!=0 ? 'col-md-5' : 'col-md-6' ?>">
        <select name="<?= isset($selected) ? 'old_' : '' ?>jml_obat[]" id="qty_obat" class="form-control stokObat qty <?= isset($selected) ? 'oldChangeQtyObat' : ''  ?>" <?= isset($selected) ? "data-qty='".$selected->jumlah."'" : ''  ?>>
            <?php
                if(isset($selected) || validation_errors()!=''){
                    for ($i=1; $i <= $stok[0]->stok_barang;$i++) { 
                        $val = validation_errors()!='' ? set_value($old."jml_obat[$no]") : $selected->jumlah;
                        $s = $i==$val ? 'selected' : '';
                        echo "<option $s>$i</option>";
                    }
                }
            ?>
        </select>
        <!-- <input type="text" name="hasil[]" class="form-control" placeholder="Hasil" id="" style="<?php echo ($no!=0) ? 'margin-right:10px' : '' ?>"> -->
    </div>
    <?php 
        if(isset($selected) && validation_errors()==""){
            $defaultHargaObat = $selected->harga_satuan;
            $defaultQtyObat = $selected->jumlah;
        }
        else{
            $defaultHargaObat = set_value($old."harga_obat[$no]",0);
            $defaultQtyObat = set_value($old."jml_obat[$no]",1);
        }

    ?>
    <!-- <div class="col-md-2"> -->
        <input type="hidden" class="form-control harga" value="<?= $defaultHargaObat ?>" name="<?= isset($selected) ? 'old_' : '' ?>harga_obat[]" placeholder="Harga Obat" readonly>
    <!-- </div> -->
    <!-- <div class="<?= $no!=0 ? 'col-md-2' : 'col-md-3' ?>"> -->
    <input type="hidden" class="form-control total" value="<?= $defaultHargaObat * $defaultQtyObat ?>" name="<?= isset($selected) ? 'old_' : '' ?>subtotal_obat[]" placeholder="Sub Total" readonly>
    <!-- </div> -->
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <a href="" class="btn btn-danger btn-sm remove-obat <?= isset($selected) ? 'oldRemoveObat' : '' ?>" <?= isset($selected) ? "data-idDetail='".$selected->id_periksa_d_obat."'" : '' ?> data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
</div>