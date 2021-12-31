<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT BIAYA JENIS OPERASI</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <table class='table table-bordered'>       
                        <tr><td width='200'>Jenis Operasi <?php echo form_error('id_jenis_operasi') ?></td><td><select name="id_jenis_operasi[]" id="id_jenis_operasi[]" class="form-control select2">
                                <option value="0">Pilih Jenis Operasi</option>
                                <?php 
                                    foreach ($jenis as $key => $value) {
                                        $k = $value->id_jenis_operasi == $id_jenis_operasi ? 'selected' : '';
                                        echo "<option  value='".$value->id_jenis_operasi."' $k>".$value->nama_jenis_operasi."</option>";
                                    }
                                ?>
                            </select></td></tr>

                            <tr><td width='200'>Biaya Operasi <?php echo form_error('id_biaya') ?></td><td><select name="id_biaya[]" id="id_biaya[]" class="form-control select2" multiple="multiple">
                                <?php 
                                    foreach ($biaya as $key => $value) {
                                        $k = $value->id_biaya == $id_biaya ? 'selected' : '';
                                        echo "<option  value='".$value->id_biaya."' $k>".$value->nama_biaya."</option>";
                                    }
                                ?>
                            </select></td></tr>                        
                        <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('jenis_biaya_operasi') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table>
                </form>        
            </div>
</div>
</div>