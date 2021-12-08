<div class="row loop-kamar" id="<?= $no ?>" data-no="<?= $no ?>">
<br>
    <div class="col-md-5">
        <select name="kamar[]" class="form-control select2 getHarga tipe-kamar" style="width:100%" >
        <option value="">---Pilih Kamar---</option>
        <?php 
            foreach ($kamar as $key => $value) {
                    echo "<option data-harga='".$value->harga."' value='".$value->id_kamar."'>".$value->nama."</option>";
            }
        ?>
        </select>
    </div>
    <div class='col-md-2'">
        <!-- <br> -->
        <input id="qty" name="qty[]" type="text" class="form-control qty" placeholder="Kuantitas">
        <!-- <?php echo form_input(array('id'=>'qty','name'=>'qty[]','type'=>'text','value'=>'','class'=>'form-control qty','placeholder'=>'Kuantitas','style'=>'text-align:left;'));?> -->
    </div>
    <div class="col-md-2">
        <?php echo form_input(array('id'=>'harga_kamar','name'=>'harga_kamar[]','type'=>'text','value'=>'','class'=>'form-control harga', 'readonly'=>'readonly','placeholder'=>'Harga Kamar','style'=>'text-align:left;'));?>
    </div>
    <div class="<?= $no!=0 ? 'col-md-2' : 'col-md-3' ?>">  
        <!-- <br> -->
        <!-- <input type="text" id="harga_kamar[]" name="harga_kamar[]" class="form-control harga"> -->
        <?php echo form_input(array('id'=>'total_harga','name'=>'harga_kamar[]','type'=>'text','value'=>'','class'=>'form-control total', 'readonly'=>'readonly','placeholder'=>'Sub Total','style'=>'text-align:left;'));?>
    <!--  -->
    </div>
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <!-- <br> -->
            <a href="" class="btn btn-danger btn-xl remove-kamar" data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
    
</div>