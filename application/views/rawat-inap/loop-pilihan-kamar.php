<?php 
    if($nameIdKategoriKamar=="id_kategori_kamar[$no]" && isset($selected)){
        unset($selected);
    }
?>
<div class="row loop-kamar" id="<?= $no ?>" data-no="<?= $no ?>" <?= isset($selected) ? "data-idDetail='".$selected['value']->id_detail."'" : '' ?>>
<br>
    <div class="col-md-4">
        <?= form_error("$nameIdKategoriKamar");?>
        <!-- <input type="text" name="edit_id_kamar" id="edit_id_kamar"> -->
        <div id="container"></div>
        <select name="<?= $nameIdKategoriKamar ?>" class="form-control <?= !isset($selected) ? 'select2' : '' ?> getHarga tipe-kamar" style="width:100%" <?= isset($selected) ? 'readonly' : '' ?>>
        <?php 
            if(!isset($selected) && set_value("$nameIdKategoriKamar")==""){
        ?>
        <option value="">---Kategori Kamar---</option>
        <?php 
            }
            if(isset($selected)){
                echo "<option data-harga='".$selected['value']->biaya_per_hari."' value='".$selected['value']->id_kategori_kamar."'>".$selected['value']->nama_kategori."</option>";
            }
            else{
                foreach ($kamar as $key => $value) {
                    $s = $value->id_kategori_kamar==set_value("$nameIdKategoriKamar") ? "selected" : "";
                    echo "<option data-harga='".$value->harga."' value='".$value->id_kategori_kamar."' $s>".$value->nama."</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="col-md-4">
    <?= form_error("$nameIdKamar");?>
        <select name="<?= $nameIdKamar ?>" class="form-control select2 idKamar <?= isset($selected) ? 'oldChangeKamar' : '' ?>" style="width:100%" <?= isset($selected) ? "data-idkamar='".$selected['value']->id_kamar."'" : ''  ?> >
            <?php 
                if(isset($selected)){
                    echo "<option value='".$selected['value']->id_kamar."'>".$selected['value']->no_kamar."</option>";
                    foreach ($selected['getKamarByKategori'] as $key => $value) {
                        echo "<option value='".$value->id_kamar."'>".$value->no_kamar."</option>";
                    }                    
                }
                else{
                    if(set_value("$nameIdKategoriKamar")!=""){
                        foreach ($getKamarByKategori as $key => $value) {
                            $s = $value->id_kamar==set_value("$nameIdKamar") ? "selected" : "";
                            if($key==0){
                                echo "<option value='' $s>---Pilih Kamar---</option>";
                            }
                            echo "<option value='".$value->id_kamar."' $s>".$value->no_kamar."</option>";
                        }                    
                    }
                    else{
                        echo "<option value=''>---Pilih Kamar---</option>";
                    }
                }
            ?>
        </select>
    </div>
    <div class='<?= $no!=0 ? 'col-md-3' : 'col-md-4' ?>'>
    <?= form_error("$nameHari"); ?>
        <!-- <br> -->
        <?php 
            $valueHari = "";
            $valueBiayaPerHari = "";
            $subtotalKamar = 0;
            if(isset($selected) && validation_errors()==""){
                $valueHari = $selected['value']->jml_hari;
                $valueBiayaPerHari = $selected['value']->biaya_per_hari;
                $subtotalKamar = $selected['value']->jml_hari * $selected['value']->biaya_per_hari;
            }
            else{
                $valueHari = set_value("$nameHari");
                $valueBiayaPerHari = set_value("$nameHargaKamar");
                $subtotalKamar = set_value("$nameSubtotalKamar",0);
            }
        ?>
        <input type="number" value="<?= $valueHari; ?>" name="<?= $nameHari  ?>" placeholder="Jumlah Hari" class="form-control hari <?= isset($selected) ? 'oldChangeQtyHari' : ''  ?>" <?= isset($selected) ? "data-hari='".$selected['value']->jml_hari."'" : ''  ?> id="hari" min='1'>
    </div>
    <!-- <input type="number" id="member" onkeyup="addFields()" class="form-control" name="member" value="">Number of members: (max. 10)<br />
    <div id="container" class="form_control"></div> -->
    <!-- <div class="col-md-2"> -->
        <?php echo form_input(array('id'=>'harga_kamar','name'=> $nameHargaKamar,'type'=>'hidden','value'=>$valueBiayaPerHari,'class'=>'form-control harga', 'readonly'=>'readonly','placeholder'=>'Harga Kamar','style'=>'text-align:left;'));?>
    <!-- </div> -->
    <!-- <div class="<?= $no!=0 ? 'col-md-2' : 'col-md-3' ?>">   -->
        <?php echo form_input(array('id'=>'total_harga','name'=>  $nameSubtotalKamar,'type'=>'hidden','value'=>$subtotalKamar,'class'=>'form-control subtotal', 'readonly'=>'readonly','placeholder'=>'Sub Total','style'=>'text-align:left;'));?>
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
