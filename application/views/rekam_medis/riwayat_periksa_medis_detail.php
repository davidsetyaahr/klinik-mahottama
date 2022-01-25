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
                        <h3 class="box-title">DETAIL REKAM MEDIS <?= $no_rekam_medis ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-md-4">
                                <?php echo anchor(site_url('periksamedis/riwayat'), '<i class="fa fa-sign-out" aria-hidden="true"></i> Kembali', 'class="btn btn-info btn-sm"'); ?>
                            </div>
                            <div class="col-md-1 text-right">
                            </div>
                            <div class="col-md-3 text-right">

                            </div>
                        </div>
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>No Pendaftaran</th>
                                    <th>Tanggal Periksa</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
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
        <h3>Riwayat Periksa Medis</h3>
        <table class="table table-bordered table-striped" id="detailPeriksa">
            <thead>
                <tr>
                    <th width="30px">No</th>
                    <th>No Periksa</th>
                    <th>Pos Periksa</th>
                </tr>
            </thead>
            <tbody id="accordion">
            <tr class="header">
                <td>1</td>
                <td>123</td>
                <td>123</td>
            </tr>
            <tr>
                <td></td>
                <td>data</td>
                <td>data</td>
            </tr>
            <tr class="header">
                <td>1</td>
                <td>123</td>
                <td>123</td>
            </tr>
            <tr>
                <td></td>
                <td>data</td>
                <td>data</td>
            </tr>
            </tbody>
        </table>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </div>
  </div>
</div>
<!-- MODAL -->

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
            ajax: {"url": "<?= base_url() ?>periksamedis/json_history_detail/<?= $no_rekam_medis ?>", "type": "POST"},
            columns: [
                {
                    "data": "no_pendaftaran",
                    "orderable": false
                },{"data": "no_pendaftaran"},{"data": "dtm_crt"}
                ,{
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'asc']],
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
        $('#detailPeriksa tbody tr').remove();
        $('#myModal').show();
        var no = 1;
        $.ajax({
            type: "GET",
            url: "<?= base_url('periksamedis/json_check?no_pendaftaran=')?>"+no_pendaftaran,
            dataType : 'json',
            success: function(response){
                arrData = response;
                $('#title').html('Detail Riwayat '+no_pendaftaran)
                for(i = 0; i < arrData.length; i++){
                    var table = 
                        '<tr class="header" data-toggle="collapse" data-parent="#accordion" data-target="#detail'+i+'" data-noperiksa="'+arrData[i].no_periksa+'">'
                        +'<td><div class="text-center">'+no+++'</div></td>'+
                        '<td><div>'+arrData[i].no_periksa+'</div></td>'+
                        '<td><div>'+arrData[i].pos+'</div></td>'+
                        '</tr>'+
                        '<tr class="collapse" id="detail'+i+'">'+
                        '<td colspan="3">'+
                        '</td>'+
                        '</tr>';
                    $('#detailPeriksa tbody').append(table);
                }

                $(".header").click(function(){
                    var noPeriksa = $(this).attr('data-noperiksa')
                    var target = $(this).attr('data-target')
                    target+=" td"
                    $.ajax({
                        type: "GET",
                        url: "<?= base_url('periksamedis/json_history_check_multiverse?no_periksa=')?>"+noPeriksa,
                        dataType: 'json',
                        success: function(respon){
                        $(target).empty()
                        $.each(respon,function(key,val){
                            $(target).append(`
                                <h4 style="margin-top:10px"><b>${key}</b></h4>
                            `)

                            $.each(val,function(i,v){
                                $(target).append(`
                                    <p>Item : ${v.item}</p>
                                    <p>Jumlah : ${v.jumlah}</p>
                                `)
                            })
                        })
                        }
                    });
                })
            }
        });

    }
</script>
