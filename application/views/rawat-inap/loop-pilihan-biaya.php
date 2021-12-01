<div class="row loop-biaya" data-no="<?= $no ?>">
<br>
    <div class="col-md-6">
        <select name="biaya[]" class="form-control select2 getHarga" style="width:100%">
        <option value="">---Pilih Biaya---</option>
        <?php 
            foreach ($biaya as $key => $value) {
                    echo "<option data-harga='".$value->biaya."' value='".$value->id_biaya."'>".$value->nama_biaya."</option>";
            }
        ?>
        </select>
    </div>
    <div class='col-md-2'">
        <!-- <br> -->
        <input type="text" class="form-control" placeholder="Kuantitas">
    </div>
    <div class="<?= $no!=0 ? 'col-md-2' : 'col-md-3' ?>">  
        <!-- <br> -->
        <input type="text" class="form-control" placeholder="Sub Total" readonly>
    <!--  -->
    </div>
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <!-- <br> -->
            <a href="" class="btn btn-danger btn-xl remove-biaya" data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
    
</div>