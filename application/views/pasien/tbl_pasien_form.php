<?php echo form_open('pasien/update_action', array('class' => 'form-horizontal', 'id' => 'form-create_pendaftaran')); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">FORM DATA PASIEN</h3>
                    </div>
    
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-2">No Rekam Medis <?php echo form_error('no_rekam_medis'); ?></div>
                            <div class="col-sm-10">
                                <?php echo form_input(array('id'=>'no_rekam_medis','name'=>'no_rekam_medis','type'=>'text','value'=>$no_rekam_medis,'class'=>'form-control','readonly'=>'readonly'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">No ID <?php echo form_error('no_id'); ?></div>
                            <div class="col-sm-10">
                                <?php echo form_input(array('id'=>'no_id','name'=>'no_id','type'=>'text','value'=>$no_id,'class'=>'form-control','readonly'=>'readonly'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">Nama Lengkap <?php echo form_error('nama_lengkap'); ?></div>
                            <div class="col-sm-10">
                                <?php echo form_input(array('id'=>'nama_lengkap','name'=>'nama_lengkap','type'=>'text','value'=>$nama_lengkap,'class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">Golongan Darah <?php echo form_error('golongan_darah'); ?></div>
                            <div class="col-sm-10">
                                <?php echo form_dropdown('golongan_darah', array(''=>'Pilih Golongan Darah','A'=>'A','B'=>'B','AB'=>'AB','O'=>'O'),$golongan_darah,array('id'=>'golongan_darah','class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">Status Menikah <?php echo form_error('status_menikah'); ?></div>
                            <div class="col-sm-10">
                                <?php echo form_dropdown('status_menikah', array(''=>'Pilih Status Menikah','Menikah'=>'Menikah','Belum Menikah'=>'Belum Menikah'),$status_menikah,array('id'=>'status_menikah','class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">Pekerjaan <?php echo form_error('pekerjaan'); ?></div>
                            <div class="col-sm-10">
                                <?php echo form_input(array('id'=>'pekerjaan','name'=>'pekerjaan','type'=>'text','value'=>$pekerjaan,'class'=>'form-control'));?>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="col-sm-2">Alamat <?php echo form_error('alamat'); ?></div>
                            <div class="col-sm-10">
                                <?php //echo form_textarea(array('id'=>'alamat','name'=>'alamat','type'=>'textarea','value'=>$alamat,'rows'=>'2','class'=>'form-control'));?>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="col-sm-2">Kabupaten/Kota <?php echo form_error('id_kabupaten') ?></div>
                            <div class="col-sm-10">
                                <select name="id_kabupaten" class="form-control select2" id="kabupaten">
                                    <option value="">---Pilih Kabupaten--</option>
                                    <?php 
                                        foreach ($allKabupaten as $key => $value) {
                                            $s = $value->id==$id_kabupaten ? "selected" : "";
                                            echo "<option value='".$value->id."' $s>".$value->kabupaten."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">Kecamatan <?php echo form_error('id_kecamatan') ?></div>
                            <div class="col-sm-10">
                                <select name="id_kecamatan" class="form-control select2" id="kecamatan">
                                    <option value="">---Pilih Kecamatan--</option>
                                    <?php 
                                        foreach ($getKecamatan as $key => $value) {
                                            $s = $value->id==$id_kecamatan ? "selected" : "";
                                            echo "<option value='".$value->id."' $s>".$value->kecamatan."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">Desa <?php echo form_error('id_desa') ?></div>
                            <div class="col-sm-10">
                                <select name="id_desa" class="form-control select2" id="desa">
                                    <option value="">---Pilih Desa--</option>
                                    <?php 
                                        foreach ($getDesa as $key => $value) {
                                            $s = $value->id==$id_desa ? "selected" : "";
                                            echo "<option value='".$value->id."' $s>".$value->desa."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">Dusun <?php echo form_error('id_dusun') ?></div>
                            <div class="col-sm-10">
                                <select name="id_dusun" class="form-control select2" id="dusun">
                                    <option value="">---Pilih Dusun--</option>
                                    <?php 
                                        foreach ($getDusun as $key => $value) {
                                            $s = $value->id==$id_dusun ? "selected" : "";
                                            echo "<option value='".$value->id."' $s>".$value->nama_dusun."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">RT <?php echo form_error('rt') ?></div>
                            <div class="col-sm-10">
                                <?php echo form_input(array('id'=>'rt','name'=>'rt','type'=>'text','value'=>$rt,'class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">RW <?php echo form_error('rw') ?></div>
                            <div class="col-sm-10">
                                <?php echo form_input(array('id'=>'rw','name'=>'rw','type'=>'text','value'=>$rw,'class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">Nama Orang Tua / Istri <?php echo form_error('nama_orangtua_atau_istri'); ?></div>
                            <div class="col-sm-10">
                                <?php echo form_input(array('id'=>'nama_orangtua_atau_istri','name'=>'nama_orangtua_atau_istri','type'=>'text','value'=>$nama_orangtua_atau_istri,'class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">Nomor Telepon <?php echo form_error('nomor_telepon'); ?></div>
                            <div class="col-sm-10">
                                <?php echo form_input(array('id'=>'nomor_telepon','name'=>'nomor_telepon','type'=>'text','value'=>$nomor_telepon,'class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Update</button>
                                <a href="<?php echo site_url('pasien') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                            </div>
                        </div>
            </div>   
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>

<script>
    $(document).ready(function(){
        $("#kabupaten").change(function(){
            var thisVal = $(this).val()
            $("#kecamatan").prop('disabled','true')

            $.ajax({
                type : "get",
                data : {id_kabupaten:thisVal},
                url : "<?= base_url()."kecamatan/kecamatanByKab" ?>",
                dataType : 'json',
                success : function(res){
                    $("#kecamatan").removeAttr('disabled')
                    $("#kecamatan option[value!='']").remove()
                    $("#desa option[value!='']").remove()
                    $("#dusun option[value!='']").remove()
                    $.each(res,function(i,v){
                        $("#kecamatan").append(`<option value='${v.id}'>${v.kecamatan}</option>`)
                    })
                    $(".select2").select2()
                }
            })
        })
        $("#kecamatan").change(function(){
            var thisVal = $(this).val()
            $("#desa").prop('disabled','true')

            $.ajax({
                type : "get",
                data : {id_kecamatan:thisVal},
                url : "<?= base_url()."desa/desaByKec" ?>",
                dataType : 'json',
                success : function(res){
                    $("#desa").removeAttr('disabled')
                    $("#desa option[value!='']").remove()
                    $("#dusun option[value!='']").remove()
                    $.each(res,function(i,v){
                        $("#desa").append(`<option value='${v.id}'>${v.desa}</option>`)
                    })
                    $(".select2").select2()
                }
            })
        })
        $("#desa").change(function(){
            var thisVal = $(this).val()
            $("#dusun").prop('disabled','true')

            $.ajax({
                type : "get",
                data : {id_desa:thisVal},
                url : "<?= base_url()."dusun/dusunByDesa" ?>",
                dataType : 'json',
                success : function(res){
                    $("#dusun").removeAttr('disabled')
                    $("#dusun option[value!='']").remove()
                    $.each(res,function(i,v){
                        $("#dusun").append(`<option value='${v.id}'>${v.nama_dusun}</option>`)
                    })
                    $(".select2").select2()
                }
            })
        })
    })
</script>
<?php echo form_close();?>