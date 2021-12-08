<div class="row loop-kamar" id="<?= $no ?>" data-no="<?= $no ?>">
<br>
    <div class="col-md-5">
        <select name="kamar[]" class="form-control select2 getHarga kamar" style="width:100%" onkeyup="totalKamar()">
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
        <!-- <input type="text" class="form-control" placeholder="Kuantitas"> -->
        <?php echo form_input(array('id'=>'qty','name'=>'qty[]','type'=>'text','value'=>'','class'=>'form-control qty','placeholder'=>'Kuantitas','style'=>'text-align:left;'));?>
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
<script>
    // function totalKamar(){
    //     var kamar_length = $('[name^=kamar]').length;
    //     var kamar_count = document.getElementsByClassName("loop-kamar");
    //     var total_harga = 0;
    //     console.log(kamar_count);

    //     for(x=0; x<kamar_length; x++){
    //         var a = parseInt($("#qty[]").val());
    //                     var b = parseInt($("#harga_kamar[]").val());
    //                     var c = a*b;
    //                     $("#total_harga[]").val(c);
    //     }
    // }
    // $ (document).ready(function(){
    //   $('#harga_kamar').change(function(){
    //     total_kamar();
    //   });
    //  });
    // function total_kamar(){
    //     $("#qty").keyup(function(){
    //         var a = parseInt($("#qty").val());
    //         var b = parseInt($("#harga_kamar").val());
    //         var c = a*b;
    //         $("#total_harga").val(c);
    //     })
    //     $("#harga_kamar").keyup(function(){
    //         var a = parseInt($("#qty").val());
    //         var b = parseInt($("#harga_kamar").val());
    //         var c = a*b;
    //         $("#total_harga").val(c);
    //     })
    // }
</script>