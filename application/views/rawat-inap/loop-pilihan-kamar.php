<div class="row loop-kamar" data-no="<?= $no ?>">
<br>
    <div class="col-md-6">
        <select name="periksa_kamar[]" class="form-control select2 getHarga" style="width:100%">
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
            <a href="" class="btn btn-danger btn-xl remove-kamar" data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
    
</div>