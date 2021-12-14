<div class="row loop-kamar" id="<?= $no ?>" data-no="<?= $no ?>">
<br>
    <div class="col-md-2">
        <select name="id_kategori_kamar[]" class="form-control select2 getHarga tipe-kamar" style="width:100%" >
        <option value="">---Kategori Kamar---</option>
        <?php 
            foreach ($kamar as $key => $value) {
                echo "<option data-harga='".$value->harga."' value='".$value->id_kamar."'>".$value->nama."</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-md-3">
        <select name="id_kamar[]" class="form-control select2 idKamar" style="width:100%" >
            <option value="">---Pilih Kamar---</option>
        </select>
    </div>
    <div class='col-md-2'">
        <!-- <br> -->
        <input type="number" name="hari[]" placeholder="Jumlah Hari" class="form-control hari" id="">
    </div>
    <div class="col-md-2">
        <?php echo form_input(array('id'=>'harga_kamar','name'=>'harga_kamar[]','type'=>'text','value'=>'','class'=>'form-control harga', 'readonly'=>'readonly','placeholder'=>'Harga Kamar','style'=>'text-align:left;'));?>
    </div>
    <div class="<?= $no!=0 ? 'col-md-2' : 'col-md-3' ?>">  
        <?php echo form_input(array('id'=>'total_harga','name'=>'subtotal_kamar[]','type'=>'text','value'=>'','class'=>'form-control subtotal', 'readonly'=>'readonly','placeholder'=>'Sub Total','style'=>'text-align:left;'));?>
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