<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT JENIS OPERASI</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_jenis_operasi" value="<?= $id_jenis_operasi  ?>">
                <table class='table table-bordered'>       
                        <tr><td width='200'>Jenis Operasi <?php echo form_error('nama_jenis_operasi') ?></td><td><input type="text" class="form-control" name="nama_jenis_operasi" id="nama_jenis_operasi" placeholder="Jenis Operasi" value="<?php echo $nama_jenis_operasi; ?>" /></td></tr>
                        
                        <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('jenis_operasi') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table>
                </form>        
            </div>
</div>
</div>