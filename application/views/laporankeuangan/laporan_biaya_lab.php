<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">LAPORAN BIAYA LABORATORIUM</h3>
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
                        <div style="padding-bottom: 10px;">
                        <div style="padding-bottom: 10px;">
                        </div>
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>No Pendaftaran</th>
                                    <th>No Transaksi</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nama Pasien</th>
                                    <th>Nominal Transaksi</th>
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
            ajax: {"url": "json_biaya_lab/<?php echo $_GET['dari'].'_'.$_GET['sampai'];?>", "type": "POST"},
            columns: [
                {
                    "data": "id_transaksi",
                    "orderable": false
                },
                {"data": "no_pendaftaran"},{"data": "no_transaksi"},{"data": "tgl_transaksi"},{"data": "nama_lengkap"},{"data": "ttl",  render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp. ' )}
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
    
</script>
<?php
}
?>