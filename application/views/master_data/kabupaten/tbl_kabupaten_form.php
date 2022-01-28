<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA KABUPATEN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
                <table class='table table-bordered'>  
                    <tr><td width='200'>Provinsi <?php echo form_error('id_provinsi') ?></td><td>
                    <select name="id_provinsi" class="form-control select2" id="kabupaten">
                        <option value="">---Pilih Provinsi--</option>
                        <?php 
                            foreach ($provinsi as $key => $value) {
                                $s = $value->id == $id_provinsi ? 'selected' : '';
                                echo "<option value='".$value->id."' $s>".$value->provinsi."</option>";
                            }  
                        ?>
                    </select>
                    </td></tr>
                    <tr><td width='200'>Kabupaten <?php echo form_error('kabupaten') ?></td><td><input type="text" class="form-control" name="kabupaten" id="kabupaten" placeholder="Kabupaten" value="<?php echo $kabupaten; ?>" /></td></tr>
                    
                    <tr><td></td><td>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                        <a href="<?php echo site_url('kabupaten') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table>
                </form>        
            </div>
</div>
</div>