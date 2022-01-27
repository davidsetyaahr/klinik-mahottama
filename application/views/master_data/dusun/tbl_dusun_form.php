<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA DUSUN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
                <table class='table table-bordered'>  
                        <tr><td width='200'>Desa <?php echo form_error('id_desa') ?></td><td>
                            <select name="id_desa" id="id_desa" class="form-control select2">
                                <option value="0">Pilih desa</option>
                                <?php 
                                    foreach ($desa as $key => $value) {
                                        $k = $value->id == $id_desa ? 'selected' : '';
                                        echo "<option  value='".$value->id."' $k>".$value->desa."</option>";
                                    }
                                ?>
                            </select>
                        </td></tr>
                        <tr><td width='200'>Nama Dusun <?php echo form_error('nama_dusun') ?></td><td><input type="text" class="form-control" name="nama_dusun" id="nama_dusun" placeholder="Nama Dusun" value="<?php echo $nama_dusun; ?>" /></td></tr>
                        
                        <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('dusun') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table>
                </form>        
            </div>
</div>
</div>