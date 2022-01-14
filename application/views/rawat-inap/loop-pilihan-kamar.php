<div class="row loop-kamar" id="<?= $no ?>" data-no="<?= $no ?>" <?= isset($selected) ? "data-idDetail='".$selected['value']->id_detail."'" : '' ?>>
<br>
    <div class="col-md-4">
        <?= form_error("id_kategori_kamar[$no]"); ?>
        <!-- <input type="text" name="edit_id_kamar" id="edit_id_kamar"> -->
        <div id="container"></div>
        <select name="<?= isset($selected) ? 'old_' : '' ?>id_kategori_kamar[]" class="form-control <?= !isset($selected) ? 'select2' : '' ?> getHarga tipe-kamar" style="width:100%" <?= isset($selected) ? 'readonly' : '' ?>>
        <?php 
            if(!isset($selected)){
        ?>
        <option value="">---Kategori Kamar---</option>
        <?php 
            }
            if(isset($selected)){
                echo "<option data-harga='".$selected['value']->biaya_per_hari."' value='".$selected['value']->id_kategori_kamar."'>".$selected['value']->nama_kategori."</option>";
            }
            else{
                foreach ($kamar as $key => $value) {
                    echo "<option data-harga='".$value->harga."' value='".$value->id_kategori_kamar."'>".$value->nama."</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="col-md-4">
    <?= form_error("id_kamar[$no]"); ?>
        <select name="<?= isset($selected) ? 'old_' : '' ?>id_kamar[]" class="form-control select2 idKamar <?= isset($selected) ? 'oldChangeKamar' : '' ?>" style="width:100%" <?= isset($selected) ? "data-idkamar='".$selected['value']->id_kamar."'" : ''  ?> >
            <?php 
                if(isset($selected)){
                    echo "<option value='".$selected['value']->id_kamar."'>".$selected['value']->no_kamar."</option>";
                    foreach ($selected['getKamarByKategori'] as $key => $value) {
                        echo "<option value='".$value->id_kamar."'>".$value->no_kamar."</option>";
                    }                    
                }
            ?>
        </select>
    </div>
    <div class='<?= $no!=0 ? 'col-md-3' : 'col-md-4' ?>'>
    <?= form_error("hari[$no]"); ?>
        <!-- <br> -->
        <input type="number" value="<?= isset($selected) ? $selected['value']->jml_hari : ''; ?>" name="<?= isset($selected) ? 'old_' : '' ?>hari[]" placeholder="Jumlah Hari" class="form-control hari <?= isset($selected) ? 'oldChangeQtyHari' : ''  ?>" <?= isset($selected) ? "data-hari='".$selected['value']->jml_hari."'" : ''  ?> id="hari">
    </div>
    <!-- <input type="number" id="member" onkeyup="addFields()" class="form-control" name="member" value="">Number of members: (max. 10)<br />
    <div id="container" class="form_control"></div> -->
    <!-- <div class="col-md-2"> -->
        <?php echo form_input(array('id'=>'harga_kamar','name'=> isset($selected) ? 'old_harga_kamar[]' : 'harga_kamar[]','type'=>'hidden','value'=>isset($selected) ? $selected['value']->biaya_per_hari : '','class'=>'form-control harga', 'readonly'=>'readonly','placeholder'=>'Harga Kamar','style'=>'text-align:left;'));?>
    <!-- </div> -->
    <!-- <div class="<?= $no!=0 ? 'col-md-2' : 'col-md-3' ?>">   -->
        <?php echo form_input(array('id'=>'total_harga','name'=>  isset($selected) ? 'old_subtotal_kamar[]' : 'subtotal_kamar[]','type'=>'hidden','value'=>isset($selected) ? $selected['value']->jml_hari * $selected['value']->biaya_per_hari  :'','class'=>'form-control subtotal', 'readonly'=>'readonly','placeholder'=>'Sub Total','style'=>'text-align:left;'));?>
    <!--  -->
    <!-- </div> -->
    <?php 
        if($no!=0){
    ?>
        <div class="col-md-1">
            <!-- <br> -->
            <a href="" class="btn btn-danger btn-xl remove-kamar <?= isset($selected) ? 'oldRemoveKamar' : '' ?>" <?= isset($selected) ? "data-idDetail='".$selected['value']->id_detail."'" : '' ?> data-no="<?= $no ?>"><span class="fa fa-trash"></span></a>
        </div>
    <?php  } ?>
    
</div>
