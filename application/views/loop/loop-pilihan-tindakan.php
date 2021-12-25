<div class="<?= empty($isPoli) ? 'row ' : '' ?>loop-tindakan" data-no="<?= $no ?>"  <?= isset($selected) ? "data-idDetail='".$selected->id_periksa_d_tindakan."'" : '' ?> <?= isset($isPoli) ? "style='margin-top : 30px '" : "" ?>>
    <br>
    <div class="col-md-5">
        <select name="<?= isset($selected) ? 'old_' : '' ?>tindakan[]" style="width:100%" class="<?= !isset($selected) ? 'select2' : '' ?> form-control tindakan" <?= isset($selected) ? 'readonly' : '' ?>>
        <?php 
            if(!isset($selected)){
        ?>
            <option value="">---Pilih Tindakan---</option>
            <?php
            }
            if(isset($selected)){
                echo "<option value='".$selected->kode_tindakan."' data-harga='".$selected->biaya."'>".$selected->tindakan."</option>";
            }
            else{
                foreach ($tindakan as $key => $value) {
                    echo "<option value='".$value->kode_tindakan."' data-harga='".$value->biaya."'>".$value->tindakan."</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class='col-md-2'">
        <!-- <br> -->
        <input id="qty" name="<?= isset($selected) ? 'old_' : '' ?>qty_tindakan[]" value="<?= isset($selected) ? $selected->jumlah : '1' ?>" type="number" class="form-control qty_tindakan  <?= isset($selected) ? 'oldChangeQtyTindakan' : ''  ?>" <?= isset($selected) ? "data-qty='".$selected->jumlah."'" : ''  ?> placeholder="Kuantitas">
    </div>
    <div class="col-md-2">
    <?php echo form_input(array('id'=>'biaya_tindakan','name'=> isset($selected) ? 'old_biaya_tindakan[]' : 'biaya_tindakan[]','type'=>'text','value'=>isset($selected) ? $selected->biaya : '','class'=>'form-control biaya_tindakan', 'readonly'=>'readonly','placeholder'=>'Biaya Tindakan','style'=>'text-align:left;'));?>    
    <!-- <br> -->
    </div>
    <div class="<?= $no!=0 ? 'col-md-2' : 'col-md-3' ?>">  
        <?php echo form_input(array('id'=>'total_tindakan','name'=> isset($selected) ? 'old_subtotal_tindakan[]' : 'subtotal_tindakan[]','type'=>'text','value'=>isset($selected) ? $selected->biaya * $selected->jumlah : '','class'=>'form-control total_tindakan', 'readonly'=>'readonly','placeholder'=>'Sub Total','style'=>'text-align:left;'));?>
    <!--  -->
    </div>
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <!-- <br> -->
            <a href="" class="btn btn-danger btn-xl remove-tindakan <?= isset($selected) ? 'oldRemoveTindakan' : '' ?>" <?= isset($selected) ? "data-idDetail='".$selected->id_periksa_d_tindakan."'" : '' ?> data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
</div>