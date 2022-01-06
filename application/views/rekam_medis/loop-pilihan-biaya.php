<br>
<br>
<div class="loop-biaya" data-no="<?= $no ?>">
<br>
    <div class="col-md-6">
        <select name="id_biaya[]" class="form-control select2 getBiaya tipe-biaya" style="width:100%">
        <option value="">---Pilih Biaya---</option>
        <?php 
            foreach ($biaya as $key => $value) {
                    echo "<option data-biaya='".$value->biaya."' value='".$value->id_biaya."'>".$value->nama_biaya."</option>";
            }
        ?>
        </select>
    </div>
    <div class="<?= $no!=0 ? 'col-md-5' : 'col-md-6' ?>">
        <!-- <br> -->
        <input id="qty" name="qty_biaya[]" value="1" type="number" class="form-control qty_biaya" placeholder="Kuantitas">
        <!-- <?php echo form_input(array('id'=>'qty_biaya','name'=>'qty[]','type'=>'text','value'=>'','class'=>'form-control qty_biaya','placeholder'=>'Kuantitas','style'=>'text-align:left;'));?> -->
    </div>
    <!-- <div class="col-md-2"> -->
    <?php echo form_input(array('id'=>'biaya','name'=>'biaya[]','type'=>'hidden','value'=>'','class'=>'form-control biaya', 'readonly'=>'readonly','placeholder'=>'Harga Biaya','style'=>'text-align:left;'));?>    
    <!-- <br> -->
    <!-- </div> -->
    <!-- <div class="<?= $no!=0 ? 'col-md-2' : 'col-md-3' ?>">   -->
        <?php echo form_input(array('id'=>'total_biaya','name'=>'subtotal_biaya[]','type'=>'hidden','value'=>'','class'=>'form-control total_biaya', 'readonly'=>'readonly','placeholder'=>'Sub Total','style'=>'text-align:left;'));?>
    <!--  -->
    <!-- </div> -->
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <!-- <br> -->
            <a href="" class="btn btn-danger btn-xl remove-biaya" data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
    
</div>