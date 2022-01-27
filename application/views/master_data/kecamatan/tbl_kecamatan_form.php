<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA KECAMATAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
                <table class='table table-bordered'>  
                        <tr><td width='200'>Kabupaten <?php echo form_error('id_kabupaten') ?></td><td>
                            <select name="id_kabupaten" id="id_kabupaten" class="form-control select2">
                                <option value="0">Pilih Kabupaten</option>
                                <?php 
                                    foreach ($kabupaten as $key => $value) {
                                        $k = $value->id == $id_kabupaten ? 'selected' : '';
                                        echo "<option  value='".$value->id."' $k>".$value->kabupaten."</option>";
                                    }
                                ?>
                            </select>
                        </td></tr>
                        <tr><td width='200'>Kecamatan <?php echo form_error('kecamatan') ?></td><td><input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="Kecamatan" value="<?php echo $kecamatan; ?>" /></td></tr>
                        <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('kecamatan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table>
                </form>        
            </div>
</div>
</div>