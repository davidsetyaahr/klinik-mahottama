<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA KAMAR</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_kamar" value="<?= $id_kamar ?>">
            <input type="hidden" name="status" value="0">
                <table class='table table-bordered'>
                        <tr><td width='200'>Tipe <?php echo form_error('tipe') ?></td><td>
                            <select name="id_kategori_kamar" id="id_kategori_kamar" class="form-control select2">
                                <option value="0">Pilih Tipe</option>
                                <?php 
                                    foreach ($item as $key => $value) {
                                        $k = $value->id_kategori_kamar == $id_kategori_kamar ? 'selected' : '';
                                        echo "<option  value='".$value->id_kategori_kamar."' $k>".$value->nama."</option>";
                                    }
                                ?>
                            </select>
                        </td></tr>        
                        <tr><td width='200'>No Kamar <?php echo form_error('no_kamar') ?></td><td><input type="text" class="form-control" name="no_kamar" id="no_kamar" placeholder="No Kamar" value="<?php echo $no_kamar; ?>" /></td></tr>
                        
                        <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('kamar') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table>
                </form>        
            </div>
</div>
</div>