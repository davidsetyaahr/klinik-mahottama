<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TIPE PERIKSA RADIOLOGI</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_tipe" value="<?= $id_tipe ?>">
                <table class='table table-bordered'>        
                        <tr><td width='200'>Item <?php echo form_error('item') ?></td><td><input type="text" class="form-control" name="item" id="item" placeholder="Item" value="<?php echo $item; ?>" /></td></tr>
                        <tr><td width='200'>Harga <?php echo form_error('harga') ?></td><td><input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" /></td></tr>
                        <tr><td width='200'>Nilai Normal <?php echo form_error('nilai_normal') ?></td>
                            <td>
                            <input type="text" class="form-control" name="nilai_normal" id="nilai_normal" placeholder="Nilai Normal" value="<?php echo $nilai_normal; ?>" />
                            </td>
                        </tr>
                        <tr><td width='200'>Kategori Pemeriksaan <?php echo form_error('id_kategori')?></td>
                            <td>
                                <select name="id_kategori" class="form-control select2" selected="selected" style="width:100%">
                                    <option value="0">---Pilih Kategori Pemeriksaan Radiologi---</option>
                                    <?php
                                        foreach ($kategori as $key => $value) {
                                            $r = $value->id_kategori == $id_kategori ? 'selected' : '';
                                            echo "<option value='".$value->id_kategori."' $r>".$value->nama_kategori."</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr><td></td><td>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                            <a href="<?php echo site_url('tipe_radiologi') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
                </table>
                </form>        
            </div>
</div>
</div>