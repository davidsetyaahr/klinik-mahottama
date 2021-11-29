<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA BIAYA</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_biaya" value="<?= $id_biaya ?>">
                <table class='table table-bordered'>        
                        <tr><td width='200'>Nama Biaya <?php echo form_error('nama_biaya') ?></td><td><input type="text" class="form-control" name="nama_biaya" id="nama_biaya" placeholder="Nama Biaya" value="<?php echo $nama_biaya; ?>" /></td></tr>
                        <tr><td width='200'>Tipe Biaya <?php echo form_error('tipe') ?></td><td>
                            <select name="id_kategori_biaya" id="id_kategori_biaya" class="form-control select2">
                                <option value="0">Pilih Tipe Biaya</option>
                                <?php 
                                    foreach ($item as $key => $value) {
                                        echo "<option  value='".$value->id_kategori_biaya."'>".$value->item."</option>";
                                    }
                                ?>
                            </select>
                        </td></tr> 
                        <tr><td width='200'>Biaya <?php echo form_error('biaya') ?></td><td><input type="int" class="form-control" name="biaya" id="biaya" placeholder="Biaya" value="<?php echo $biaya; ?>" /></td></tr>
                        <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('biaya') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table>
                </form>        
            </div>
</div>
</div>