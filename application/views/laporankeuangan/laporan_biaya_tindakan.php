<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">LAPORAN BIAYA TINDAKAN</h3>
                    </div>

                    <div class="box-body">
                        <form action="" id="form-bayar" method="get">
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="">Dari Tanggal</label>
                                    <input type="date" name="dari" class="form-control" value="<?= isset($_GET['dari']) ? $_GET['dari'] : '' ?>" >
                                </div>
                                <div class="col-md-6">
                                    <label for="">Sampai Tanggal</label>
                                    <input type="date" name="sampai" class="form-control" value="<?= isset($_GET['sampai']) ? $_GET['sampai'] : '' ?>" >
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                <br>
                                    <select name="kode_tindakan" id="" class="form-control select2" width="200">
                                        <option value="">Semua Tindakan</option>
                                        <?php 
                                                foreach ($tindakan as $key => $value) {
                                                    // $s = isset($_GET['kode_tindakan']) && $_GET['kode_tindakan']==$value->kode_tindakan ? 'selected' : '';
                                                    echo "<option  value='".$value->kode_tindakan."'>".$value->tindakan."</option>";
                                                }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <br>
                                    <button class="btn btn-danger"><span class="fa fa-search"></span> Tampilkan</button>
                                </div>
                            </div>
                    </form>
                        <?php 
                            if(isset($_GET['dari'])){
                        ?>
                        <hr />
                        <?php echo anchor(site_url('laporankeuangan/excel_biaya_tindakan/'.$_GET['dari'].'_'.$_GET['sampai']),'<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
                        <div style="padding-bottom: 10px;">
                        <div style="padding-bottom: 10px;">
                        </div>
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>No Periksa</th>
                                    <th>Nama Pasien</th>
                                    <th>Nama Tindakan</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <!-- <th width="30px">Aksi</th> -->
                                </tr>
                            </thead>
                        </table>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- MODAL -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <h3>Detail Biaya</h3>
        <table class="table table-bordered table-striped" id="detailTindakan">
            <thead>
                <tr>
                    <th width="30px">No</th>
                    <th>No Periksa</th>
                    <th>Tindakan</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </div>
  </div>
</div>
<!-- MODAL -->
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>

<?php 
if(isset($_GET['dari'])){
?>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $("#mytable").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "json_laporan_tindakan/<?php echo $_GET['dari'].'_'.$_GET['sampai'];?>", "type": "POST"},
            columns: [
                {
                    "data": "id_periksa_d_tindakan",
                    "orderable": false
                }
                ,{"data": "no_periksa"}
                ,{"data": "nama_lengkap"}
                ,{"data": "tindakan"}
                ,{"data": "jumlah"}
                ,{"data": "biaya",  render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp. ' )}
                ,{"data": "ttl",  render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp. ' )}
                // {
                //     "data" : "action",
                //     "orderable": false,
                //     "className" : "text-center"
                // }
            ],
            order: [[1, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        
    });

    function cekDetail(no_pendaftaran){
        $('#myModal').show();
        $('#detailTindakan td').remove();
        $.ajax({
            type: "GET",
            url: "<?= base_url('laporankeuangan/json_detail_tindakan?no_pendaftaran=')?>"+no_pendaftaran, //json get site
            dataType : 'json',
            success: function(response){
                arrData = response;
                $('#title').html('Nomor Pendaftaran : '+no_pendaftaran)
                for(i = 0; i < arrData.length; i++){
                    var table= '<tr><td><div class="text-center">'+arrData[i].no_pendaftaran+'</div></td>'+
                        '<td><div class="text-center">'+arrData[i].no_periksa+'</div></td>'+
                        '<td><div class="text-center">'+arrData[i].tindakan+'</div></td>'+
                        '<td><div class="text-left">Rp. '+formatRupiah(arrData[i].biaya)+'</div></td></tr>';
                    $('#detailTindakan tbody').append(table);
                }
            }
        });

    }
    function formatRupiah(angka, prefix)
      {
        var reverse = angka.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
      }
    
</script>
<?php
}
?>