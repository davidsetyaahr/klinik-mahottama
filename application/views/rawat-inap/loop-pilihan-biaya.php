<div class="row loop-biaya" data-no="<?= $no ?>"  <?= isset($selected) ? "data-idDetail='".$selected->id_periksa_d_biaya."'" : '' ?>>
<br>
    <div class="col-md-6">
        <div id="container_biaya"></div>
        <select name="<?= isset($selected) ? 'old_' : '' ?>id_biaya[]" class="form-control <?= !isset($selected) ? 'select2' : '' ?> getBiaya tipe-biaya" style="width:100%" <?= isset($selected) ? 'readonly' : '' ?>>
        <?php 
            if(!isset($selected)){
        ?>
        <option value="">---Pilih Biaya---</option>
        <?php
            }
            if(isset($selected)){
                echo "<option data-biaya='".$selected->biaya."' value='".$selected->id_biaya."'>".$selected->nama_biaya."</option>";
            }
            else{
                foreach ($biaya as $key => $value) {
                    echo "<option data-biaya='".$value->biaya."' value='".$value->id_biaya."'>".$value->nama_biaya."</option>";
                }
            }
        ?>
        </select>
    </div>
    <div class="<?= $no!=0 ? 'col-md-5' : 'col-md-6' ?>">
        <!-- <br> -->
        <input id="qty" name="<?= isset($selected) ? 'old_' : '' ?>qty_biaya[]" value="<?= isset($selected) ? $selected->jumlah : '1' ?>" type="number" class="form-control qty_biaya  <?= isset($selected) ? 'oldChangeQtyBiaya' : ''  ?>" <?= isset($selected) ? "data-qty='".$selected->jumlah."'" : ''  ?> placeholder="Kuantitas">
    </div>
    <!-- <div class="col-md-2"> -->
    <?php echo form_input(array('id'=>'biaya','name'=> isset($selected) ? 'old_biaya[]' : 'biaya[]','type'=>'hidden','value'=>isset($selected) ? $selected->biaya : '','class'=>'form-control biaya', 'readonly'=>'readonly','placeholder'=>'Harga Biaya','style'=>'text-align:left;'));?>    
    <!-- <br> -->
    <!-- </div> -->
    <!-- <div class="<?= $no!=0 ? 'col-md-2' : 'col-md-3' ?>">   -->
        <?php echo form_input(array('id'=>'total_biaya','name'=> isset($selected) ? 'old_subtotal_biaya[]' : 'subtotal_biaya[]','type'=>'hidden','value'=>isset($selected) ? $selected->biaya * $selected->jumlah : '','class'=>'form-control total_biaya', 'readonly'=>'readonly','placeholder'=>'Sub Total','style'=>'text-align:left;'));?>
    <!--  -->
    <!-- </div> -->
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <!-- <br> -->
            <a href="" class="btn btn-danger btn-xl remove-biaya <?= isset($selected) ? 'oldRemoveBiaya' : '' ?>" <?= isset($selected) ? "data-idDetail='".$selected->id_periksa_d_biaya."'" : '' ?> data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
    
</div>