<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <?php 
            if($this->session->flashdata('message')){
                if($this->session->flashdata('message_type') == 'danger')
                    echo alert('alert-danger', 'Perhatian', $this->session->flashdata('message'));
                else if($this->session->flashdata('message_type') == 'success')
                    echo alert('alert-success', 'Sukses', $this->session->flashdata('message')); 
                else
                    echo alert('alert-info', 'Info', $this->session->flashdata('message')); 
            }
            ?>
            </div>
            <div class="col-md-6">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">FORM PENDAFTARAN</h3>
                    </div>
                    <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_pendaftaran')); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-4">Nama Dokter <?php echo form_error('nama_dokter'); ?></div>
                            <div class="col-sm-8">
                                <select name="nama_dokter" id="nama_dokter" class="form-control select2 namaDokter">
                                    <option value="" data-poli='0'>Pilih Dokter</option>
                                    <?php 
                                    foreach ($dokter as $key => $value) {
                                        echo "<option data-poli='".$value->id_poli."' value='".$value->id_dokter."'>".$value->nama_dokter."</option>";
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">Pemeriksaan <?php echo form_error('tipe_periksa'); ?></div>
                            <!-- <div class="col-sm-8">
                                <?php echo form_dropdown('tipe_periksa', array(''=>'Pilih Pemeriksaan','1'=>'Poli','6'=>'UGD'),$tipe_periksa,array('id'=>'tipe_periksa','class'=>'form-control tipe'));?>
                            </div> -->
                            <div class="col-sm-8">
                                <select name="tipe_periksa" class="form-control select2 tipe">
                                    <option value="" data-tipe="">Pilih Pemeriksaan</option>
                                    <option value="1" data-tipe="1">Poli</option>
                                    <option value="6" data-tipe="6">UGD</option>
                                </select>
                            </div>
                        </div>
                        <div id="poli"></div>
                        <!-- <div class="form-group">
                            <div class="col-sm-4">Poli</div>
                            <div class="col-sm-8">
                                <select name="id_poli" class="form-control select2 poli">
                                    <option value="">Pilih Poli</option>
                                    <?php 
                                        foreach ($poli as $key => $value) {
                                            echo "<option value='".$value->id_poli."'>".$value->item."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="col-sm-4">No Rekam Medis <?php echo form_error('no_rekam_medis'); ?></div>
                            <div class="col-sm-8">
                                <?php echo form_input(array('id'=>'no_rekam_medis','name'=>'no_rekam_medis','type'=>'text','value'=>$no_rekam_medis,'class'=>'form-control','readonly'=>'readonly'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">No ID <?php echo form_error('no_id'); ?></div>
                            <div class="col-sm-8">
                                <?php echo form_input(array('id'=>'no_id','name'=>'no_id','type'=>'text','value'=>$no_id,'class'=>'form-control','readonly' => 'readonly'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">Nik <?php echo form_error('nik'); ?></div>
                            <div class="col-sm-8">
                                <?php echo form_input(array('id'=>'nik','name'=>'nik','type'=>'text','value'=>$nik,'class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">Nama Lengkap <?php echo form_error('nama_lengkap'); ?></div>
                            <div class="col-sm-8">
                                <?php echo form_input(array('id'=>'nama_lengkap','name'=>'nama_lengkap','type'=>'text','value'=>$nama_lengkap,'class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
							<div class="col-sm-4">Tanggal Lahir <?php echo form_error('tanggal_lahir'); ?></div>
							<div class="col-sm-8">
							    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo $tanggal_lahir;?>" />
							</div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">Golongan Darah <?php echo form_error('golongan_darah'); ?></div>
                            <div class="col-sm-8">
                                <?php echo form_dropdown('golongan_darah', array(''=>'Pilih Golongan Darah','A'=>'A','B'=>'B','AB'=>'AB','O'=>'O'),$golongan_darah,array('id'=>'golongan_darah','class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">Status Menikah <?php echo form_error('status_menikah'); ?></div>
                            <div class="col-sm-8">
                                <?php echo form_dropdown('status_menikah', array(''=>'Pilih Status Menikah','Menikah'=>'Menikah','Belum Menikah'=>'Belum Menikah'),$status_menikah,array('id'=>'status_menikah','class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">Pekerjaan <?php echo form_error('pekerjaan'); ?></div>
                            <div class="col-sm-8">
                                <?php echo form_input(array('id'=>'pekerjaan','name'=>'pekerjaan','type'=>'text','value'=>$pekerjaan,'class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">Kabupaten/Kota <?php echo form_error('id_kabupaten') ?></div>
                            <div class="col-sm-7">
                                <select name="id_kabupaten" class="form-control select2 changeKabupaten" data-elementstart=".box-body" id="kabupaten">
                                    <option value="">---Pilih Kabupaten--</option>
                                    <?php 
                                        if($id_kabupaten!=""){
                                            foreach ($allKabupaten as $key => $value) {
                                                $s = $value->id==$id_kabupaten ? 'selected' : '';
                                                echo "<option value='".$value->id."' $s>".$value->kabupaten."</option>";
                                            }
                                        }else{
                                            foreach ($allKabupaten as $key => $value) {
                                                $s = $value->id==$id_kabupaten ? 'selected' : '';
                                                echo "<option value='".$value->id."' $s>".$value->kabupaten."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <?php //echo form_input(array('id'=>'kabupaten','name'=>'kabupaten','type'=>'text','value'=>$kabupaten,'class'=>'form-control'));?>
                                <?php // echo form_dropdown('kabupaten',$kabupaten_opt,$kabupaten,array('id'=>'kabupaten','class'=>'form-1o style="padding-left:0px"ntrol select2','onchange'=>'get_kecamatan(this)'));?>
                            </div>
                            <div class="col-sm-1" style="padding-left:0px"><a href="" class="btn btn-default" data-toggle="modal" data-target="#kabModal"><span class="fa fa-plus"></span></a></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">Kecamatan <?php echo form_error('id_kecamatan') ?></div>
                            <div class="col-sm-7">
                                <select name="id_kecamatan" class="form-control select2 changeKecamatan" data-elementstart=".box-body" id="kecamatan">
                                    <option value="">---Pilih Kecamatan--</option>
                                    <?php 
                                        $getKecamatan = $this->db->get_where("tbl_kecamatan",['id_kabupaten' => $id_kabupaten])->result();
                                        foreach ($getKecamatan as $key => $value) {
                                            $s = $value->id==$id_kecamatan ? 'selected' : '';
                                            echo "<option value='".$value->id."' $s>".$value->kecamatan."</option>";
                                        }
                                    ?>
                                </select>
                                <?php //echo form_input(array('id'=>'kecamatan','name'=>'kecamatan','type'=>'text','value'=>$kecamatan,'class'=>'form-control'));?>
                            </div>
                            <div class="col-sm-1" style="padding-left:0px"><a href="" class="btn btn-default" data-toggle="modal" data-target="#kecModal"><span class="fa fa-plus"></span></a></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">Desa <?php echo form_error('id_desa') ?></div>
                            <div class="col-sm-7">
                                <select name="id_desa" class="form-control select2 changeDesa" data-elementstart=".box-body" id="desa">
                                    <option value="">---Pilih Desa--</option>
                                    <?php 
                                        if($id_desa!=""){
                                            $getDesa = $this->db->get_where("tbl_desa",['id_kecamatan' => $id_kecamatan])->result();
                                            foreach ($getDesa as $key => $value) {
                                                $s = $value->id==$id_desa ? 'selected' : '';
                                                echo "<option value='".$value->id."' $s>".$value->desa."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <?php //echo form_input(array('id'=>'desa','name'=>'desa','type'=>'text','value'=>$desa,'class'=>'form-control'));?>
                            </div>
                            <div class="col-sm-1" style="padding-left:0px"><a href="" class="btn btn-default" data-toggle="modal" data-target="#desModal"><span class="fa fa-plus"></span></a></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">Dusun <?php echo form_error('id_dusun') ?></div>
                            <div class="col-sm-7">
                                <select name="id_dusun" class="form-control select2" id="dusun">
                                    <option value="">---Pilih Dusun--</option>
                                    <?php 
                                        if($id_dusun!=""){
                                            $getDusun = $this->db->get_where("tbl_dusun",['id_desa' => $id_desa])->result();
                                            foreach ($getDusun as $key => $value) {
                                                $s = $value->id==$id_dusun ? 'selected' : '';
                                                echo "<option value='".$value->id."' $s>".$value->nama_dusun."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <?php //echo form_input(array('id'=>'dusun','name'=>'dusun','type'=>'text','value'=>$dusun,'class'=>'form-control'));?>
                            </div>
                            <div class="col-sm-1" style="padding-left : 0px;"><a href="" class="btn btn-default" data-toggle="modal" data-target="#dusModal"><span class="fa fa-plus"></span></a></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">RT <?php echo form_error('rt') ?></div>
                            <div class="col-sm-8">
                                <?php echo form_input(array('id'=>'rt','name'=>'rt','type'=>'text','value'=>$rt,'class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">RW <?php echo form_error('rw') ?></div>
                            <div class="col-sm-8">
                                <?php echo form_input(array('id'=>'rw','name'=>'rw','type'=>'text','value'=>$rw,'class'=>'form-control'));?>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="col-sm-4">Alamat <?php echo form_error('alamat'); ?></div>
                            <div class="col-sm-8">
                                <?php echo form_textarea(array('id'=>'alamat','name'=>'alamat','type'=>'textarea','value'=>$alamat,'rows'=>'2','class'=>'form-control'));?>
                            </div>
                        </div> -->
                        <!--<div class="form-group">-->
                        <!--    <div class="col-sm-4">Kecamatan <?php echo form_error('kecamatan'); ?></div>-->
                        <!--    <div class="col-sm-8">-->
                                <?php // echo form_input(array('id'=>'kecamatan','name'=>'kecamatan','type'=>'text','value'=>$kecamatan,'class'=>'form-control'));?>
                        <!--        <?php echo form_dropdown('kecamatan',$kecamatan_opt,'',array('id'=>'kecamatan','class'=>'form-control select2','onchange'=>'get_kelurahan(this)'));?>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="form-group">-->
                        <!--    <div class="col-sm-4">Kelurahan/Desa <?php echo form_error('kelurahan'); ?></div>-->
                        <!--    <div class="col-sm-8">-->
                                <?php // echo form_input(array('id'=>'kelurahan','name'=>'kelurahan','type'=>'text','value'=>$kelurahan,'class'=>'form-control'));?>
                        <!--        <?php echo form_dropdown('kelurahan',$kelurahan_opt,'',array('id'=>'kelurahan','class'=>'form-control select2'));?>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="form-group">
                            <div class="col-sm-4">Nama Ibu Kandung <?php echo form_error('nama_orangtua_atau_istri'); ?></div>
                            <div class="col-sm-8">
                                <?php echo form_input(array('id'=>'nama_orangtua_atau_istri','name'=>'nama_orangtua_atau_istri','type'=>'text','value'=>$nama_orangtua_atau_istri,'class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">Nomor Telepon <?php echo form_error('nomor_telepon'); ?></div>
                            <div class="col-sm-8">
                                <?php echo form_input(array('id'=>'nomor_telepon','name'=>'nomor_telepon','type'=>'text','value'=>$nomor_telepon,'class'=>'form-control'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">Status Pasien <?php echo form_error('is_pasien'); ?></div>
                            <div class="col-sm-8">
                                <?php echo form_dropdown('is_pasien', array('1'=>'Pasien Baru','0'=>'Pasien Lama'),$is_pasien,array('id'=>'is_pasien','class'=>'form-control','readonly' => 'true'));?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div align="right">
                                    <a href="<?php echo site_url('pendaftaran') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan Pendaftaran</button> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">STATUS PEMERIKSAAN DOKTER</h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                        </div>
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Nama Dokter</th>
                                    <th>No Pendaftaran</th>
                                    <th>Status Dokter</th>
                                    <th>Sisa Antrian</th>
                                    <!--<th width="100px">Action</th>-->
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">ATUR STATUS DOKTER DAN KLINIK PERIKSA</h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                        </div>
                        <table class="table table-bordered table-striped" id="mytable2">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Nama Dokter</th>
                                    <th>Status Dokter</th>
                                    <th>Nama Klinik</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Kabupaten -->
<div id="kabModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Kabupaten</h4>
            </div>
            <div class="modal-body">
                <label for="">Kabupaten</label>
                <input type="text" id="addkabupaten" name="kabupaten" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info" id="addKab">Tambah</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Kecamatan -->
<div id="kecModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Kecamatan</h4>
            </div>
            <div class="modal-body">
                <label for="">Kabupaten</label>
                <select class="form-control select2 changeKabupaten" data-elementstart="#kecModal" name="id_kabupaten" id="addkabupaten" style="width:100%">
                    <option value="">---Pilih Kabupaten--</option>
                    <?php
                        $getKabupaten = $this->db->get("tbl_kabupaten")->result();
                        foreach ($getKabupaten as $key => $value) {
                            echo "<option value='".$value->id."'>".$value->kabupaten."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="modal-body">
                <label for="">Kecamatan</label>
                <input type="text" id="addkecamatan" name="kecamatan" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info" id="addKec">Tambah</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Desa -->
<div id="desModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Desa</h4>
            </div>
            <div class="modal-body">
                <label for="">Kabupaten</label>
                <select name="id_kabupaten" class="form-control select2 changeKabupaten" data-elementstart="#desModal" id="kabupaten" style="width:100%">
                    <option value="">---Pilih Kabupaten--</option>
                    <?php 
                        $getKabupaten = $this->db->get("tbl_kabupaten")->result();
                        foreach ($getKabupaten as $key => $value) {
                            $s = $value->id==$id_kabupaten ? 'selected' : '';
                            echo "<option value='".$value->id."' $s>".$value->kabupaten."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="modal-body">
                <label for="">Kecamatan</label>
                <select name="id_kecamatan" class="form-control select2" id="kecamatan" style="width:100%">
                    <option value="">---Pilih Kecamatan--</option>
                    <?php 
                        $getKecamatan = $this->db->get_where("tbl_kecamatan",['id_kabupaten' => $id_kabupaten])->result();
                        foreach ($getKecamatan as $key => $value) {
                            $s = $value->id==$id_kecamatan ? 'selected' : '';
                            echo "<option value='".$value->id."' $s>".$value->kecamatan."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="modal-body">
                <label for="">Desa</label>
                <input type="text" id="adddesa" name="desa" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info" id="addDes">Tambah</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Dusun -->
<div id="dusModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Dusun</h4>
            </div>
            <div class="modal-body">
                <label for="">Kabupaten</label>
                <select name="id_kabupaten" class="form-control select2 changeKabupaten" data-elementstart="#dusModal" id="kabupaten" style="width:100%">
                    <option value="">---Pilih Kabupaten--</option>
                    <?php 
                        $getKabupaten = $this->db->get("tbl_kabupaten")->result();
                        foreach ($getKabupaten as $key => $value) {
                            $s = $value->id==$id_kabupaten ? 'selected' : '';
                            echo "<option value='".$value->id."' $s>".$value->kabupaten."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="modal-body">
                <label for="">Kecamatan</label>
                <select name="id_kecamatan" class="form-control select2 changeKecamatan" data-elementstart="#dusModal" id="kecamatan" style="width:100%">
                    <option value="">---Pilih Kecamatan--</option>
                    <?php 
                            $getKecamatan = $this->db->get_where("tbl_kecamatan",['id_kabupaten' => $id_kabupaten])->result();
                            foreach ($getKecamatan as $key => $value) {
                                $s = $value->id==$id_kecamatan ? 'selected' : '';
                                echo "<option value='".$value->id."' $s>".$value->kecamatan."</option>";
                            }
                        
                    ?>
                </select>
            </div>
            <div class="modal-body">
                <label for="">Desa</label>
                <select name="id_desa" class="form-control select2" id="desa" style="width:100%">
                    <option value="">---Pilih Desa--</option>
                    <?php 
                        if($id_desa!=""){
                            $getDesa = $this->db->get_where("tbl_desa",['id_kecamatan' => $id_kecamatan])->result();
                            foreach ($getDesa as $key => $value) {
                                $s = $value->id==$id_desa ? 'selected' : '';
                                echo "<option value='".$value->id."' $s>".$value->desa."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="modal-body">
                <label for="">Dusun</label>
                <input type="text" id="adddusun" name="dusun" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info" id="addDus">Tambah</button>
            </div>
        </div>
    </div>
</div>

<style>
select[readonly].select2+.select2-container {
  pointer-events: none;
  touch-action: none;
}
select[readonly].select2+.select2-container .select2-selection {
    background : #eee;
}
</style>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".changeKabupaten").change(function(){
            var thisVal = $(this).val()
            var elementStart = $(this).data('elementstart')
            $(elementStart+" #kecamatan").prop('disabled','true')

            $.ajax({
                type : "get",
                data : {id_kabupaten:thisVal},
                url : "<?= base_url()."pendaftaran/changeKabupaten" ?>",
                dataType : 'json',
                success : function(res){
                    $(elementStart+" #kecamatan").removeAttr('disabled')
                    $(elementStart+" #kecamatan option[value!='']").remove()
                    $(elementStart+" #desa option[value!='']").remove()
                    $(elementStart+" #dusun option[value!='']").remove()
                    $.each(res,function(i,v){
                        $(elementStart+" #kecamatan").append(`<option value='${v.id}'>${v.kecamatan}</option>`)
                    })
                    $(".select2").select2()
                }
            })
        })
        $(".changeKecamatan").change(function(){
            var thisVal = $(this).val()
            var elementStart = $(this).data('elementstart')
            $(elementStart+" #desa").prop('disabled','true')

            $.ajax({
                type : "get",
                data : {id_kecamatan:thisVal},
                url : "<?= base_url()."pendaftaran/desaByKec" ?>",
                dataType : 'json',
                success : function(res){
                    $(elementStart+" #desa").removeAttr('disabled')
                    $(elementStart+" #desa option[value!='']").remove()
                    $(elementStart+" #dusun option[value!='']").remove()
                    $.each(res,function(i,v){
                        $(elementStart+" #desa").append(`<option value='${v.id}'>${v.desa}</option>`)
                    })
                    $(".select2").select2()
                }
            })
        })
        $(".changeDesa").change(function(){
            var thisVal = $(this).val()
            var elementStart = $(this).data('elementstart')
            $(elementStart+" #dusun").prop('disabled','true')

            $.ajax({
                type : "get",
                data : {id_desa:thisVal},
                url : "<?= base_url()."pendaftaran/dusunByDesa" ?>",
                dataType : 'json',
                success : function(res){
                    $(elementStart+" #dusun").removeAttr('disabled')
                    $(elementStart+" #dusun option[value!='']").remove()
                    $.each(res,function(i,v){
                        $(elementStart+" #dusun").append(`<option value='${v.id}'>${v.nama_dusun}</option>`)
                    })
                    $(".select2").select2()
                }
            })
        })
        $(".namaDokter").change(function(){
            getPoli()
        })
        function getPoli(){
            var idPoli = $(".namaDokter").find(":selected").attr('data-poli')
            $(".poli").val(idPoli)
            $(".poli").select2()
            $(".poli").removeAttr('readonly');
            if(idPoli!=0){
                $(".poli").attr('readonly','true');
            }
        }
        function changePoli(thisAttr){
            var idPoli = thisAttr.val()
            // console.log()
            $.ajax({
                type : 'get',
                url : '<?= base_url().'pendaftaran/getDokter' ?>',
                data : {id_poli : idPoli},
                success : function(res){
                    $(".namaDokter option").remove()
                    res = JSON.parse(res)
                    $(".namaDokter").append(`<option value='0' data-poli='0'>Pilih Dokter</option>`)
                    $.each(res,function(i,v){
                        $(".namaDokter").append(`<option value='${v.id_dokter}' data-poli='${v.id_poli}'>${v.nama_dokter}</option>`)
                    })
                }
            })
        }
        $(".tipe").change(function(){
            var idTipe = $(this).find(":selected").attr('data-tipe')
            if(idTipe==1){
            $("#poli").append(`
                <div class="form-group" id="select-poli">
                <div class="col-sm-4">Poli <?php echo form_error('poli'); ?></div>
                    <div class="col-sm-8">
                        <select name="id_poli" class="form-control select2 poli">
                            <option value="">Pilih Poli</option>
                            <?php 
                                foreach ($poli as $key => $value) {
                                    echo "<option value='".$value->id_poli."'>".$value->item."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            `);
            $(".poli").change(function(){
                changePoli($(this))
            })
            getPoli()
            } else{
                $("#select-poli").remove()
            }
        })
        $("#addKab").click(function(e){
            e.preventDefault()
            var kabupaten = $("#kabModal #addkabupaten").val();

            $.ajax({
                type : "post",
                data : {kabupaten : kabupaten,ajax : true},
                url : '<?= base_url().'pendaftaran/kabcreate_action' ?>',
                cache: false,
                beforeSend : function(){
                    $(this).prop('disabled','true')
                },
                success : function(id){
                    $(this).prop('disabled','false')
                    $("#kabModal").modal('hide')
                    alert('Kabupaten Berhasil Ditambahkan')
                    $("#kabModal #addkabupaten").val('')
                    $(".changeKabupaten").append(`<option value='${id}'>${kabupaten}</option>`)
                    $(".changeKabupaten").val('').change()
                }
            })
        })
        $("#addKec").click(function(e){
            e.preventDefault()
            var kabupaten = $("#kecModal #addkabupaten").val()
            var kecamatan = $("#kecModal #addkecamatan").val()
            $.ajax({
                type : "post",
                data : {id_kabupaten : kabupaten, kecamatan:kecamatan, ajax:true},
                url : '<?= base_url().'pendaftaran/keccreate_action' ?>',
                beforeSend : function(){
                    $(this).prop('disabled','true')
                },
                success : function(id){
                    $(this).prop('disabled','false')
                    $("#kecModal").modal('hide')
                    alert('Kecamatan Berhasil Ditambahkan')
                    $("#kecModal #addkabupaten").val('')
                    $("#kecModal #addkecamatan").val('')
                    $(".changeKabupaten").val('').change()
                }
            })
        })

        $("#addDes").click(function(e){
            e.preventDefault()
            var kecamatan = $("#desModal #kecamatan").val()
            var desa = $("#desModal #adddesa").val()
            $.ajax({
                type : "post",
                data : {id_kecamatan:kecamatan, desa: desa},
                url : '<?= base_url().'pendaftaran/descreate_action' ?>',
                beforeSend : function(){
                    $(this).prop('disabled','true')
                },
                success : function(){
                    $(this).prop('disabled','false')
                    $("#desModal").modal('hide')
                    alert('Desa Berhasil Ditambahkan')
                    $("#desModal #kecamatan").val('')
                    $("#desModal #adddesa").val('')
                    $(".changeKabupaten").val('').change()
                }
            })
        })

        $("#addDus").click(function(e){
            e.preventDefault()
            var desa = $("#dusModal #desa").val()
            var dusun = $("#dusModal #adddusun").val()
            $.ajax({
                type : "post",
                data : {id_desa:desa, nama_dusun: dusun},
                url : '<?= base_url().'pendaftaran/duscreate_action' ?>',
                beforeSend : function(){
                    $(this).prop('disabled','true')
                },
                success : function(){
                    $(this).prop('disabled','false')
                    $("#dusModal").modal('hide')
                    alert('Dusun Berhasil Ditambahkan')    
                    $("#dusModal #desa").val('')
                    $("#dusModal #adddusun").val('')
                    $(".changeKabupaten").val('').change()
                }
            })
        })
        // $("#tipe_dokter_umum").change(function(){
        //     var thisVal = $(this).val()

        //     if(thisVal=='5'){
        //         $("#jasa_lainnya").show();
        //         $("#jasa_lainnya select").attr('disabled',false);

        //         $("#pemeriksaan_lab").hide();
        //         $("#pemeriksaan_lab select").attr('disabled',true);
        //     }
        //     else if(thisVal=='6'){
        //         $("#jasa_lainnya").hide();
        //         $("#jasa_lainnya select").attr('disabled',true);

        //         $("#pemeriksaan_lab").show();
        //         $("#pemeriksaan_lab select").attr('disabled',false);
        //     }
        //     else{
        //         $("#jasa_lainnya").hide();
        //         $("#jasa_lainnya select").attr('disabled',true);

        //         $("#pemeriksaan_lab").hide();
        //         $("#pemeriksaan_lab select").attr('disabled',true);
        //     }
        // })
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $("#mytable").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "../pendaftaran/json_status_dokter", "type": "POST"},
            columns: [
                {
                    "data": "id_dokter",
                    "orderable": false
                },{"data": "nama_dokter"},{"data": "no_pendaftaran"},{"data": "status"},{"data": "sisa_antrian"}
            ],
            order: [[3, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
        
        var t2 = $("#mytable2").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable2_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "../pendaftaran/json_status_dokter2", "type": "POST"},
            columns: [
                {
                    "data": "id_dokter",
                    "orderable": false
                },{"data": "nama_dokter"},{"data": "status"},{"data": "klinik"},{"data": "action","className":"text-center"}
            ],
            order: [[1, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
        
    });
</script>
<script type="text/javascript">
    
    // $(document).ready(function() {
    //     alert('coba');
    // });
    
    function autocomplate_no_id(){
        //autocomplete
        $("#no_id").autocomplete({
            source: "<?php echo base_url() ?>index.php/pendaftaran/autocomplate_no_id_pasien",
            minLength: 1
        });
        autoFill();
    }
    
    function autoFill(){
        var no_id = $("#no_id").val();
        $.ajax({
            url: "<?php echo base_url() ?>index.php/pendaftaran/autofill",
            data:"no_id="+no_id ,
        }).success(function (data) {
            var json = data,
            obj = JSON.parse(json);
            $('#no_rekam_medis').val(obj.no_rekam_medis);
            $('#nama_lengkap').val(obj.nama_lengkap);
			$('#pekerjaan').val(obj.pekerjaan);
			$('#alamat').val(obj.alamat);
			$('#kabupaten').val(obj.kabupaten);
			$('#kecamatan').val(obj.kecamatan);
			$('#kelurahan').val(obj.kelurahan);
			$('#nama_orangtua_atau_istri').val(obj.nama_orangtua_atau_istri);
			$('#nomor_telepon').val(obj.nomor_telepon);
			$('#golongan_darah').val(obj.golongan_darah);
			$('#status_menikah').val(obj.status_menikah);
			
			if(obj.no_rekam_medis == null)
			    $('#no_rekam_medis').val("<?php echo $no_rekam_medis_default;?>");
        });
    }
    
    
    
</script>



