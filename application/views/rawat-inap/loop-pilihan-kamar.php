<div class="row loop-kamar box-body" data-no="<?= $no ?>">
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
    <div class='col-md-6'">
        <!-- <br> -->
        <input type="text" class="form-control harga" placeholder="Harga" readonly>
    </div>
    <div class="col-md-6">  
        <br>
        <input type="text" class="form-control" placeholder="Jumlah">
    <!--  -->
    </div>
    <div class="<?= $no!=0 ? 'col-md-5' : 'col-md-6' ?>">
    <br>
        <input type="text" name="hasil[]" class="form-control" placeholder="Sub Total" readonly id="" style="<?php echo ($no!=0) ? 'margin-right:10px' : '' ?>">
    </div>
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <br>
            <a href="" class="btn btn-danger btn-sm remove-kamar" data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php } ?>
</div>