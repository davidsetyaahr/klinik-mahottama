<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
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
            <div class="col-md-12">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">DAFTAR ANTRIAN</h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                        </div>
                        <ul class="nav nav-tabs">
                            <?php 
                                if($_SESSION['id_user_level']=='10'){
                            ?>
                                <li class="active"><a data-toggle="tab" href="#medis">Poli</a></li>
                            <?php } ?>
                            <?php 
                                if($_SESSION['id_user_level']=='13'){
                            ?>
                                <li class="active"><a data-toggle="tab" href="#ugd">UGD</a></li>
                            <?php } ?>
                            <?php 
                                if($_SESSION['id_user_level']=='11'){
                            ?>
                                <li class="active"><a data-toggle="tab" href="#inap">Rawat Inap</a></li>
                            <?php } ?>
                            <?php 
                                if($_SESSION['id_user_level']=='12'){
                            ?>
                                <li class="active"><a data-toggle="tab" href="#operasi">Operasi</a></li>
                            <?php } ?>
                            <?php 
                                if($_SESSION['id_user_level']!='12'){
                                    ?>
                            <li><a data-toggle="tab" href="#lab">Laboratorium</a></li>
                            <li><a data-toggle="tab" href="#radiologi">Radiologi</a></li>
                            <?php } ?>
                        </ul>
                        <br>
                        <div class="tab-content">
                            <?php 
                                if($_SESSION['id_user_level']=='10'){
                            ?>
                            <div id="medis" class="tab-pane fade in active">
                                <table class="table table-bordered table-striped" id="mytable">
                                    <thead>
                                        <tr>
                                            <th width="30px">No</th>
                                            <th>No Pendaftaran</th>
                                            <th>No Rekam Medis</th>
                                            <th>No ID Pasien</th>
                                            <th>Nama Pasien</th>
                                            <th>Klinik</th>
                                            <th>Nama Dokter</th>
                                            <th>Tgl Pendaftaran</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <?php } ?>
                            <?php 
                                if($_SESSION['id_user_level']=='11'){
                            ?>
                            <div id="inap" class="tab-pane fade in active">
                            <table class="table table-bordered table-striped" width="100%" id="tableInap">
                                    <thead>
                                        <tr>
                                            <th width="30px">No</th>
                                            <th>No Pendaftaran</th>
                                            <th>No Rekam Medis</th>
                                            <th>No ID Pasien</th>
                                            <th>Nama Pasien</th>
                                            <th>Klinik</th>
                                            <th>Nama Dokter</th>
                                            <th>Tgl Pendaftaran</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <?php } ?>
                            <?php 
                                if($_SESSION['id_user_level']=='12'){
                            ?>
                            <div id="operasi" class="tab-pane fade in active">
                            <table class="table table-bordered table-striped" width="100%" id="tableOperasi">
                                    <thead>
                                        <tr>
                                            <th width="30px">No</th>
                                            <th>No Pendaftaran</th>
                                            <th>No Rekam Medis</th>
                                            <th>No ID Pasien</th>
                                            <th>Nama Pasien</th>
                                            <th>Klinik</th>
                                            <th>Nama Dokter</th>
                                            <th>Tgl Pendaftaran</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <?php } ?>
                            <?php 
                                if($_SESSION['id_user_level']!='12'){
                            ?>
                            <div id="lab" class="tab-pane fade in">
                            <table class="table table-bordered table-striped" width="100%" id="tableLab">
                                    <thead>
                                        <tr>
                                            <th width="30px">No</th>
                                            <th>No Pendaftaran</th>
                                            <th>No Rekam Medis</th>
                                            <th>No ID Pasien</th>
                                            <th>Nama Pasien</th>
                                            <th>Klinik</th>
                                            <th>Nama Dokter</th>
                                            <th>Tgl Pendaftaran</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div id="radiologi" class="tab-pane fade in">
                            <table class="table table-bordered table-striped" width="100%" id="tableRadiologi">
                                    <thead>
                                        <tr>
                                            <th width="30px">No</th>
                                            <th>No Pendaftaran</th>
                                            <th>No Rekam Medis</th>
                                            <th>No ID Pasien</th>
                                            <th>Nama Pasien</th>
                                            <th>Klinik</th>
                                            <th>Nama Dokter</th>
                                            <th>Tgl Pendaftaran</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <?php } ?>
                            <?php 
                                if($_SESSION['id_user_level']=='13'){
                            ?>
                            <div id="ugd" class="tab-pane fade in active">
                                <table class="table table-bordered table-striped" id="tableUgd">
                                    <thead>
                                        <tr>
                                            <th width="30px">No</th>
                                            <th>No Pendaftaran</th>
                                            <th>No Rekam Medis</th>
                                            <th>No ID Pasien</th>
                                            <th>Nama Pasien</th>
                                            <th>Klinik</th>
                                            <th>Nama Dokter</th>
                                            <th>Tgl Pendaftaran</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
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
        <?php 
            if($_SESSION['id_user_level']=='10'){
        ?>
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
            ajax: {"url": "../periksamedis/json_antrian", "type": "POST"},
            columns: [
                {
                    "data": "no_pendaftaran",
                    "orderable": false
                },{"data": "no_pendaftaran"},{"data": "no_rekam_medis"},{"data": "no_id_pasien"},{"data": "nama_pasien"},{"data": "klinik"},{"data": "nama_dokter"},{"data": "tgl_pendaftaran"},{"data": "status"},
                {
                    "data": "action",
                    "orderable": false,
                    "className" : "text-center"
                }
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
        <?php } ?>
        <?php 
            if($_SESSION['id_user_level']=='11'){
        ?>
        var t = $("#tableInap").dataTable({
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
            ajax: {"url": "../periksamedis/json_antrian/2", "type": "POST"},
            columns: [
                {
                    "data": "no_pendaftaran",
                    "orderable": false
                },{"data": "no_pendaftaran"},{"data": "no_rekam_medis"},{"data": "no_id_pasien"},{"data": "nama_pasien"},{"data": "klinik"},{"data": "nama_dokter"},{"data": "tgl_pendaftaran"},{"data": "status"},
                {
                    "data": "action",
                    "orderable": false,
                    "className" : "text-center"
                }
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
        <?php } ?>
        <?php 
            if($_SESSION['id_user_level']=='12'){
        ?>
        var t = $("#tableOperasi").dataTable({
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
            ajax: {"url": "../periksamedis/json_antrian/3", "type": "POST"},
            columns: [
                {
                    "data": "no_pendaftaran",
                    "orderable": false
                },{"data": "no_pendaftaran"},{"data": "no_rekam_medis"},{"data": "no_id_pasien"},{"data": "nama_pasien"},{"data": "klinik"},{"data": "nama_dokter"},{"data": "tgl_pendaftaran"},{"data": "status"},
                {
                    "data": "action",
                    "orderable": false,
                    "className" : "text-center"
                }
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
        <?php } ?>
        <?php 
            if($_SESSION['id_user_level']!='12'){
        ?>
        var t = $("#tableLab").dataTable({
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
            ajax: {"url": "../periksamedis/json_antrian/4", "type": "POST"},
            columns: [
                {
                    "data": "no_pendaftaran",
                    "orderable": false
                },{"data": "no_pendaftaran"},{"data": "no_rekam_medis"},{"data": "no_id_pasien"},{"data": "nama_pasien"},{"data": "klinik"},{"data": "nama_dokter"},{"data": "tgl_pendaftaran"},{"data": "status"},
                {
                    "data": "action",
                    "orderable": false,
                    "className" : "text-center"
                }
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
        var t = $("#tableRadiologi").dataTable({
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
            ajax: {"url": "../periksamedis/json_antrian/5", "type": "POST"},
            columns: [
                {
                    "data": "no_pendaftaran",
                    "orderable": false
                },{"data": "no_pendaftaran"},{"data": "no_rekam_medis"},{"data": "no_id_pasien"},{"data": "nama_pasien"},{"data": "klinik"},{"data": "nama_dokter"},{"data": "tgl_pendaftaran"},{"data": "status"},
                {
                    "data": "action",
                    "orderable": false,
                    "className" : "text-center"
                }
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
        <?php } ?>
        <?php 
            if($_SESSION['id_user_level']=='13'){
        ?>
        var t = $("#tableUgd").dataTable({
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
            ajax: {"url": "../periksamedis/json_antrian/6", "type": "POST"},
            columns: [
                {
                    "data": "no_pendaftaran",
                    "orderable": false
                },{"data": "no_pendaftaran"},{"data": "no_rekam_medis"},{"data": "no_id_pasien"},{"data": "nama_pasien"},{"data": "klinik"},{"data": "nama_dokter"},{"data": "tgl_pendaftaran"},{"data": "status"},
                {
                    "data": "action",
                    "orderable": false,
                    "className" : "text-center"
                }
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
        <?php } ?>
    });
</script>
