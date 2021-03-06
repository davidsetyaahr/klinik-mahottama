<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <?php 
            if($this->session->flashdata('message')){
                if($this->session->flashdata('message_type') == 'danger')
                    echo alert('alert-danger', 'Perhatian', $this->session->flashdata('message'));
                else if($this->session->flashdata('message_type') == 'success')
                    echo alert('alert-success', 'Sukses', $this->session->flashdata('message')); 
                else
                    echo alert('alert-info', 'Info', $this->session->flashdata('message')); 
            }
            ?>
            </div>
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">PEMBAYARAN AKTIF</h3>
                    </div>

                    <div class="box-body">
                        <div class="tab-content">
                        <div id="menu1" class="tab-pane fade in active">
                            <table class="table table-bordered table-striped" id="mytable">
                                <thead>
                                    <tr>
                                        <th width="30px">No</th>
                                        <th>No Pembayaran</th>
                                        <th>Nama Pasien</th>
                                        <th>Klinik Periksa</th>
                                        <th>Tgl Periksa</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        </div>                        
                    </div>
                </div>
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">RIWAYAT PEMBAYARAN</h3>
                    </div>

                    <div class="box-body">
                        <div class="tab-content">
                            <div id="list1" class="tab-pane fade in active">
                                <table class="table table-bordered table-striped" id="mytable2">
                                    <thead>
                                        <tr>
                                            <th width="30px">No</th>
                                            <th>No Pembayaran</th>
                                            <th>Nama Pasien</th>
                                            <th>Klinik Periksa</th>
                                            <th>Tgl Periksa</th>
                                            <th>Tgl Pembayaran</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
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
            ajax: {"url": "pembayaran/json", "type": "POST"},
            columns: [
                {
                    "data": "id_transaksi",
                    "orderable": false
                },{"data": "no_pendaftaran"},{"data": "nama_pasien"},{"data": "id_klinik"},{"data": "tgl_periksa"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            // order: [[4, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
        
        var t2 = $("#mytable2").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable2_filter input')
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
            ajax: {"url": "pembayaran/json2", "type": "POST"},
            columns: [
                {
                    "data": "id_transaksi",
                    "orderable": false
                },{"data": "no_pendaftaran"},{"data": "nama_pasien"},{"data": "id_klinik"},{"data": "tgl_periksa"},{"data": "tgl_pembayaran"},
                {
                    "render" : function(data,type,row){
                        var cetak = row.is_surat_ket_sakit=='1' ? row.cetak : ''
                        btnPeriksaLanjutan = "";
                        $.ajax({
                            type : 'get',
                            async : false,
                            url : 'pembayaran/getPeriksaLanjutan',
                            data : {no_pendaftaran : row.no_pendaftaran},
                            success : function(res){
                                $.each(res,function(k,v){
                                    var pos = ""
                                    switch (v.tipe_periksa) {
                                        case '1':
                                           pos = 'Poli' 
                                        break;
                                        case '2':
                                           pos = 'Rawat Inap' 
                                        break;
                                        case '3':
                                           pos = 'Operasi' 
                                        break;
                                        case '4':
                                           pos = 'Laboratorium' 
                                        break;
                                        case '5':
                                           pos = 'Radiologi' 
                                        break;
                                        case '6':
                                           pos = 'UGD' 
                                        break;
                                    }
                                    btnPeriksaLanjutan+=`<li><a href='<?= site_url('pembayaran/cetak_surat_pembayaran_detail/') ?>${row.no_pendaftaran}/${v.tipe_periksa}' target='_blank'>${pos}</a></li>`
                                })
                            }
                        })
                        var btn = `<div class='dropdown'>
                            <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>Cetak Laporan Periksa
                            <span class='caret'></span></button>
                            <ul class='dropdown-menu'>
                                <li><a href='<?= site_url('pembayaran/cetak_surat_pembayaran/') ?>${row.no_pendaftaran}' target='_blank'>Semua POS</a></li>
                                ${btnPeriksaLanjutan}
                            </ul>
                        </div>`
                        return row.cetak_struk+"&nbsp;"+row.action+"&nbsp;"+cetak+"&nbsp;"+btn
                    },
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            // order: [[5, 'desc']],
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