<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA DESA</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
                <table class='table table-bordered'>  
                        <tr><td width='200'>Kecamatan <?php echo form_error('id_kecamatan') ?></td><td>
                            <select name="id_kecamatan" id="id_kecamatan" class="form-control select2">
                                <option value="0">Pilih kecamatan</option>
                                <?php 
                                    foreach ($kecamatan as $key => $value) {
                                        $k = $value->id == $id_kecamatan ? 'selected' : '';
                                        echo "<option  value='".$value->id."' $k>".$value->kecamatan."</option>";
                                    }
                                ?>
                            </select>
                        </td></tr>
                        <tr><td width='200'>Desa <?php echo form_error('desa') ?></td><td><input type="text" class="form-control" name="desa" id="desa" placeholder="Desa" value="<?php echo $desa; ?>" /></td></tr>
                        
                        <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('desa') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table>
                </form>        
            </div>
</div>
</div>