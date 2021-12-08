<div class="row loop-alkes" data-no="<?= $no ?>">
<br>
<div class="col-md-5">
        <select name="kode_barang[]" class="form-control select2 selectAlkes alkes">
            <option value="">---Pilih Alkes---</option>
            <?php 
            foreach ($alkes as $key => $value) {
                    echo "<option data-stok='".$value->stok_barang."' data-harga='".$value->harga."' value='".$value->kode_barang."'>".$value->nama_barang."</option>";
            }
        ?>
        </select>
    </div>
    <div class="col-md-2">
        <select name="jml_barang[]" class="form-control stokAlkes qty" >
        </select>
        <!-- <input type="text" name="hasil[]" class="form-control" placeholder="Hasil" id="" style="<?php echo ($no!=0) ? 'margin-right:10px' : '' ?>"> -->
    </div>
    <div class="col-md-2">
    <input type="text" class="form-control harga" placeholder="Harga Obat" readonly>
        <!-- <?php echo form_input(array('id'=>'harga_alkes','name'=>'harga_alkes[]','type'=>'text','value'=>'', 'readonly'=>'readonly','class'=>'form-control harga_alkes','placeholder'=>'Harga Alkes','style'=>'text-align:left;'));?> -->
    </div>
    <div class="<?= $no!=0 ? 'col-md-2' : 'col-md-3' ?>">
    <input type="text" class="form-control total" placeholder="Sub Total" readonly>
        <!-- <?php echo form_input(array('id'=>'harga_obat','name'=>'harga_obat[]','type'=>'text','value'=>'', 'readonly'=>'readonly','class'=>'form-control subtotal','placeholder'=>'Sub Total','style'=>'text-align:left;'));?> -->
    </div>
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <a href="" class="btn btn-danger btn-sm remove-alkes" data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
</div>