<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA KATEGORI BIAYA</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_kategori_biaya" value="<?= $id_kategori_biaya ?>">
                <table class='table table-bordered'>        
                        <tr><td width='200'>Nama Kategori Biaya <?php echo form_error('item') ?></td><td><input type="text" class="form-control" name="item" id="item" placeholder="Nama Kategori Biaya" value="<?php echo $item; ?>" /></td></tr>
                        <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('tipe_lab') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table>
                </form>        
            </div>
</div>
</div>