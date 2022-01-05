<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $judul ?></h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <table class='table table-bordered'>
                <input type="hidden" name="id" value="<?= $id  ?>">
                        <tr><td width='200'>Nama Alat Operasi <?php echo form_error('nama') ?></td><td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Alat Operasi" value="<?php echo $nama; ?>" /></td></tr>
                        
                        <!-- <tr><td width='200'>Stok Terpakai <?php echo form_error('stok_terpakai') ?></td><td><input type="text" class="form-control" name="stok_terpakai" id="stok_terpakai" placeholder="Stok Terpakai" value="<?php echo $stok_terpakai; ?>" /></td></tr> -->

                        <tr><td width='200'>Kuantitas <?php echo form_error('stok_tidak_terpakai') ?></td><td><input type="text" class="form-control" name="stok_tidak_terpakai" id="stok_tidak_terpakai" placeholder="Kuantitas" value="<?php echo $stok_tidak_terpakai; ?>" /></td></tr>
                        <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('alat_operasi') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table>
                </form>        
            </div>
</div>
</div>