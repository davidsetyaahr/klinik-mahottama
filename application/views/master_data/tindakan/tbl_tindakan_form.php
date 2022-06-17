<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TINDAKAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <table class='table table-bordered>'        
                        <tr><td width='200'>Kode Tindakan <?php echo form_error('kode_tindakan') ?></td><td><input type="text" class="form-control" name="kode_tindakan" id="kode_tindakan" placeholder="Kode Tindakan" value="<?php echo $kode_tindakan; ?>" 
                        <?php if(isset($kode_tindakan) && $kode_tindakan!='') echo 'readonly'; else ''; ?> />
                    </td></tr>
                        <tr><td width='200'>Tindakan <?php echo form_error('tindakan') ?></td><td><input type="text" class="form-control" name="tindakan" id="tindakan" placeholder="Tindakan" value="<?php echo $tindakan; ?>" /></td></tr>
                        <tr><td width='200'>Biaya <?php echo form_error('biaya') ?></td><td><input type="number" class="form-control" name="biaya" id="biaya" placeholder="Biaya" value="<?php echo $biaya; ?>" /></td></tr>
                        <tr><td width='200'>Tipe <?php echo form_error('tipe') ?></td><td>
                            <select name="id_kategori" id="kategori" class="form-control select2">
                                <option value="0">Pilih kategori</option>
                                <?php 
                                    foreach ($item as $key => $value) {
                                        $t = $value->id_kategori == $id_kategori ? 'selected' : '';
                                        echo "<option  value='".$value->id_kategori."' $t>".$value->item."</option>";
                                    }
                                ?>
                            </select>
                        </td></tr>
                        <tr><td width='200'>User <?php echo form_error('kode_user') ?></td><td>
                            <select name="kode_user" id="kode_user" class="form-control select2">
                                <option value="0">Pilih User</option>
                                <?php 
                                    foreach ($user as $key => $value) {
                                        $t = $value->id_users == $kode_user ? 'selected' : '';
                                        echo "<option  value='".$value->id_users."' $t>".$value->full_name."</option>";
                                    }
                                ?>
                            </select>
                        </td></tr>
                        <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('tindakan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table>
                </form>        
            </div>
</div>
</div>