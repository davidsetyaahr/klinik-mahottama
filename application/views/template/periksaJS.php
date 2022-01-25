        function getBiaya(thisParam) {
            var biaya = thisParam.find(":selected").attr('data-biaya')
            var getNo = thisParam.closest('.loop-biaya').attr('data-no')
            $(".loop-biaya[data-no='" + getNo + "'] .biaya").val(biaya)
        }
        function getOk(thisParam){
            var biaya = thisParam.find(":selected").attr('data-biaya-ok')
            $(".opr .ok").val(biaya)
            $("#totalBiayaOk").val(biaya)
            console.log(biaya)
        }
        function subTotalBiaya(dataNo) {
            var qty_biaya = parseInt($(".loop-biaya[data-no='" + dataNo + "'] .qty_biaya").val())
            var biaya = parseInt($(".loop-biaya[data-no='" + dataNo + "'] .biaya").val())
            var subtotal = isNaN(qty_biaya * biaya) ? 0 : qty_biaya * biaya
            $(".loop-biaya[data-no='" + dataNo + "'] .total_biaya").val(subtotal)
        }
        function totalBiaya() {
            var totalBiaya = 0
            $(".total_biaya").each(function(i, v) {
                var subTotal = parseInt(v.value)
                if(!isNaN(subTotal)){
                    totalBiaya += subTotal
                }
            })
            $("#totalBiaya").val(totalBiaya)
            grandTotal()
        }

        $(".qty_biaya").keyup(function() {
            qtyBiaya($(this))
        })
        function qtyBiaya(param){
            var dataNo = param.closest('.loop-biaya').attr('data-no')
            subTotalBiaya(dataNo)
            totalBiaya()
        }


        $(".getBiaya").change(function() {
            getBiaya($(this))
        })

        $(".getOk").change(function() {
            getOk($(this))
        })

        function subTotalBiayaOpr() {
            var qty_biaya = parseInt($(".loop-biaya .qty_biaya").val())
            var biaya = parseInt($(".loop-biaya .biaya").val())
            var subtotal = isNaN(qty_biaya * biaya) ? 0 : qty_biaya * biaya
            $(".loop-biaya .total_biaya").val(subtotal)
        }

        $("#jenis_operasi").change(function(){
            var id_jenis = $(this).val()
            var dataNo =  0
            $.ajax({
                type : 'GET',
                url : '<?php echo base_url().'periksamedis/jenisOpr' ?>',
                data : {id_jenis : id_jenis},
                success : function(data){
                    data = JSON.parse(data)
                    var no = parseInt(dataNo)
                    $(".biaya-auto").remove()
                    $.each(data, function(k, v) {
                        no++
                        $("#row-biaya").append(`
                            <div class="loop-biaya row biaya-auto" data-no="${no}">
                            <br>
                                <div class="col-md-6">
                                    <select name="id_biaya[]" class="form-control getBiaya tipe-biaya" style="width:100%" readonly>
                                        <option value="${v.id_biaya}">${v.nama_biaya}</option>
                                    </select>
                                </div>
                                <div class='col-md-6'">
                                    <input id="qty" name="qty_biaya[]" value="1" type="number" class="form-control qty_biaya" placeholder="Kuantitas">
                                </div>
                                <!-- <div class="col-md-2"> -->
                                    <input id="biaya" name="biaya[]" value="${v.biaya}" type="hidden" class="form-control biaya" placeholder="Harga Biaya" style="text-align:left;" value="" readonly> 
                                <!-- </div> -->
                                <!-- <div class="col-md-3">   -->
                                    <input id="total_biaya" name="subtotal_biaya[]" value="${v.biaya}" type="hidden" class="form-control total_biaya" placeholder="Sub Total" style="text-align:left;" value="" readonly> 
                                <!-- </div> -->
                        `)
                });
                $("#row-biaya").attr('data-row',no)
                $(".qty_biaya").keyup(function() {
                    qtyBiaya($(this))
                })
                totalBiaya()
            }
        })
    })

        $(".tipe-biaya").change(function() {
            var dataNo = $(this).closest('.loop-biaya').attr('data-no')
            subTotalBiaya(dataNo)
            totalBiaya()
        })

        function selectAlkes(thisAttr){
            var stok = thisAttr.find(':selected').data('stok')
            var harga = thisAttr.find(':selected').data('harga')
            var dataId = thisAttr.closest('.loop-alkes').attr('data-no')
            $(".loop-alkes[data-no='"+dataId+"'] .stokAlkes option").remove();
            var option = "";
            if(stok==0){
                option = "<option value=''>Habis</option>";
            }
            else{
                for (let s = 1; s <= stok; s++) {
                    option+="<option>"+s+"</option>";
                }
            }
            $(".loop-alkes[data-no='"+dataId+"'] .stokAlkes").append(option);
            $(".loop-alkes[data-no='"+dataId+"'] .harga").val(harga);
        }

        $(".selectAlkes").change(function(){
            selectAlkes($(this))            
        })

        function totalObat(){
            var totalObat = 0
            $(".loop-obat .total").each(function(i,v){
                var subtotal = parseInt(v.value)
                totalObat+=subtotal
            })
            $("#totalObat").val(totalObat)
            grandTotal()
        }

        function totalAlkes(){
            var totalAlkes = 0
            $(".loop-alkes .total").each(function(i,v){
                var subtotal = parseInt(v.value)
                totalAlkes+=subtotal
            })
            $("#totalAlkes").val(totalAlkes)
            grandTotal()
        }

        <?php 
            if(validation_errors()!=""){
        ?>
            $(".selectObat").each(function(){
                var getStok = $(this).find(':selected').data('stok')
                var dataId = $(this).closest('.loop-obat').attr('data-no')
                var defaultStok = parseInt($(this).data('selectedqty'))
                for(var i = 1;i<=parseInt(getStok);i++){
                    var selected = i==defaultStok ? 'selected' : ''
                    $(".loop-obat[data-no='"+dataId+"'] .stokObat").append(`<option ${selected}>${i}</option>`)
                }
            })

            $(".selectAlkes").each(function(){
                var getStok = $(this).find(':selected').data('stok')
                var dataId = $(this).closest('.loop-alkes').attr('data-no')
                var defaultStok = parseInt($(this).data('selectedqty'))
                for(var i = 1;i<=parseInt(getStok);i++){
                    var selected = i==defaultStok ? 'selected' : ''
                    $(".loop-alkes[data-no='"+dataId+"'] .stokAlkes").append(`<option ${selected}>${i}</option>`)
                }
            })

            $(".selectAlat").each(function(){
                var getStok = $(this).find(':selected').data('stok')
                var dataId = $(this).closest('.loop-alat').attr('data-no')
                var defaultStok = parseInt($(this).data('selectedqty'))
                for(var i = 1;i<=parseInt(getStok);i++){
                    var selected = i==defaultStok ? 'selected' : ''
                    $(".loop-alat[data-no='"+dataId+"'] .stokAlat").append(`<option ${selected}>${i}</option>`)
                }
            })
        <?php
            }
        ?>

        function selectObat(thisAttr){
            var stok = thisAttr.find(':selected').data('stok')
            var harga = thisAttr.find(':selected').data('harga')
            var dataId = thisAttr.closest('.loop-obat').attr('data-no')
            $(".loop-obat[data-no='"+dataId+"'] .stokObat option").remove();
            var option = "";
            if(stok==0){
                option = "<option value=''>Habis</option>";
            }
            else{
                for (let s = 1; s <= stok; s++) {
                    option+="<option>"+s+"</option>";
                }
            }
            $(".loop-obat[data-no='"+dataId+"'] .stokObat").append(option);
            $(".loop-obat[data-no='"+dataId+"'] .harga").val(harga)
        }

        $(".selectObat").change(function(){
            selectObat($(this))
        })

        function subTotalObat(dataNo){
            var qty = parseInt($(".loop-obat[data-no='"+dataNo+"'] .qty").val())
            var harga = parseInt($(".loop-obat[data-no='"+dataNo+"'] .harga").val())
            var subtotal = isNaN(qty*harga) ? 0 : qty*harga 
            $(".loop-obat[data-no='"+dataNo+"'] .total").val(subtotal)
        }
        $(".loop-obat .qty").change(function(){
            var dataNo = $(this).closest('.loop-obat').attr('data-no')
            subTotalObat(dataNo)         
            totalObat()
        })
        $(".loop-obat .obat").change(function(){
            var dataNo = $(this).closest('.loop-obat').attr('data-no')
            subTotalObat(dataNo)            
            totalObat()
        })

        function subTotalAlkes(dataNo){
            var qty = parseInt($(".loop-alkes[data-no='"+dataNo+"'] .qty").val())
            var harga = parseInt($(".loop-alkes[data-no='"+dataNo+"'] .harga").val())
            var subtotal = isNaN(qty*harga) ? 0 : qty*harga 
            $(".loop-alkes[data-no='"+dataNo+"'] .total").val(subtotal)
        }
        $(".loop-alkes .qty").change(function(){
            var dataNo = $(this).closest('.loop-alkes').attr('data-no')
            subTotalAlkes(dataNo)            
            totalAlkes()
        })
        $(".loop-alkes .alkes").change(function(){
            var dataNo = $(this).closest('.loop-alkes').attr('data-no')
            subTotalAlkes(dataNo)            
            totalAlkes()
        })


        $("#addItemBiaya").click(function(e) {
            e.preventDefault();
            var dataRow = parseInt($('#row-biaya').attr('data-row'))
            $.ajax({
                type: 'get',
                url: '<?= base_url() . 'periksamedis/newItemBiaya' ?>',
                data: {
                    no: dataRow + 1
                },
                success: function(data) {
                    $('#row-biaya').append(data)
                    $('#row-biaya').attr('data-row', dataRow + 1)
                    $(".getBiaya").change(function() {
                        getBiaya($(this))
                    })
                    $(".qty_biaya").keyup(function() {
                        var dataNo = $(this).closest('.loop-biaya').attr('data-no')
                        subTotalBiaya(dataNo)
                        totalBiaya()
                    })
                    $(".tipe-biaya").change(function() {
                        var dataNo = $(this).closest('.loop-biaya').attr('data-no')
                        subTotalBiaya(dataNo)
                        totalBiaya()
                    })
                    $(".remove-biaya").click(function(e) {
                        e.preventDefault();
                        removeBiaya($(this))
                    })
                    $(".select2").select2()
                }
            })
        })
        $(".remove-biaya").click(function(e) {
            e.preventDefault();
            removeBiaya($(this))
        })

        function removeBiaya(params){
            var dataNo = params.attr('data-no')
            var dataRow = parseInt($('#row-biaya').attr('data-row'))
            $('.loop-biaya[data-no="' + dataNo + '"]').remove()
            $('#row-biaya').attr('data-row', dataRow - 1)
            totalBiaya()
        }

        $("#addItemObat").click(function(e){
            e.preventDefault();
            var dataRow = parseInt($('#row-obat').attr('data-row'))
            $.ajax({
                type : 'get',
                url : '<?= base_url().'periksamedis/newItemLoopObat' ?>',
                data : {no : dataRow+1},
                success : function(data){
                    $('#row-obat').append(data)
                    $('#row-obat').attr('data-row',dataRow + 1)
                    $(".selectObat").change(function(e){
                        selectObat($(this))
                    })
                    $(".loop-obat .qty").change(function(){
                        var dataNo = $(this).closest('.loop-obat').attr('data-no')
                        subTotalObat(dataNo)            
                        totalObat()
                    })
                    $(".loop-obat .obat").change(function(){
                        var dataNo = $(this).closest('.loop-obat').attr('data-no')
                        subTotalObat(dataNo)            
                        totalObat()
                    })
                    $(".remove-obat").click(function(e){
                        e.preventDefault();
                        removeObat($(this))
                    })
                    $(".select2").select2()
                }
            })
        })
        function removeObat(params){
            var dataNo = params.attr('data-no')
            var dataRow = parseInt($('#row-obat').attr('data-row'))
            $('.loop-obat[data-no="'+dataNo+'"]').remove()
            $('#row-obat').attr('data-row',dataRow-1)
            totalObat()
        }

        $(".remove-obat").click(function(e){
            e.preventDefault();
            removeObat($(this))
        })

        $("#addItemAlkes").click(function(e){
            e.preventDefault();
            var dataRow = parseInt($('#row-alkes').attr('data-row'))
            var dataNo = parseInt($('#row-alat').attr('data-no'))
            console.log(dataRow,dataNo)
            $.ajax({
                type : 'get',
                url : '<?= base_url().'periksamedis/newItemLoopAlkes' ?>',
                data : {no : dataRow+1},
                success : function(data){
                    $('#row-alkes').append(data)
                    $('#row-alkes').attr('data-row',dataRow + 1)
                    // $(".select2").select2()
                    $(".selectAlkes").change(function(){
                        selectAlkes($(this))
                    })
                    $(".loop-alkes .qty").change(function(){
                        var dataNo = $(this).closest('.loop-alkes').attr('data-no')
                        subTotalAlkes(dataNo)  
                        totalAlkes()
                    })
                    $(".loop-alkes .alkes").change(function(){
                        var dataNo = $(this).closest('.loop-alkes').attr('data-no')
                        subTotalAlkes(dataNo)
                        totalAlkes()
                    })
                    $(".remove-alkes").click(function(e){
                        e.preventDefault();
                        removeAlkes($(this))
                    })
                    $(".select2").select2()
                }
            })
        })
        function removeAlkes(params){
            var dataNo = params.attr('data-no')
            console.log(dataNo)
            var dataRow = parseInt($('#row-alkes').attr('data-row'))
            $('.loop-alkes[data-no="'+dataNo+'"]').remove()
            $('#row-alkes').attr('data-row',dataRow-1)
            totalAlkes()
        }        
        $(".remove-alkes").click(function(e){
            e.preventDefault();
            removeAlkes($(this))
        })
        function totalTindakan() {
            var totalBiaya = 0
            $(".total_tindakan").each(function(i, v) {
                var subTotal = parseInt(v.value)
                totalBiaya += subTotal
            })
            $("#totalTindakan").val(totalBiaya)
            grandTotal()
        }
        $(".remove-tindakan").click(function(e){
            e.preventDefault();
            removeTindakan($(this))
        })
        function removeTindakan(params){
            var dataNo = params.attr('data-no')
            var dataRowTindakan = parseInt($('#row-tindakan').attr('data-row'))
            var newRow = dataRowTindakan - 1
            $('#row-tindakan').attr('data-row',newRow)
            $('.loop-tindakan[data-no="'+dataNo+'"]').remove()
            totalBiayaTindakan()
        }
        function totalBiayaTindakan() {
            var totalBiaya = 0
            $(".total_tindakan").each(function(i, v) {
                var subTotal = parseInt(v.value)
                totalBiaya += subTotal
            })
            $("#totalTindakan").val(totalBiaya)
             grandTotal()
        }

        function getBiayaTindakan(thisParam) {
            var biaya = thisParam.find(":selected").attr('data-harga')
            var getNo = thisParam.closest('.loop-tindakan').attr('data-no')
            $(".loop-tindakan[data-no='" + getNo + "'] .biaya_tindakan").val(biaya)
        }
        function subTotalBiayaTindakan(dataNo) {
            var qty_biaya = parseInt($(".loop-tindakan[data-no='" + dataNo + "'] .qty_tindakan").val())
            var biaya = parseInt($(".loop-tindakan[data-no='" + dataNo + "'] .biaya_tindakan").val())
            var subtotal = isNaN(qty_biaya * biaya) ? 0 : qty_biaya * biaya
            $(".loop-tindakan[data-no='" + dataNo + "'] .total_tindakan").val(subtotal)
        }

        $(".tindakan").change(function() {
            getBiayaTindakan($(this))
            var dataNo = $(this).closest('.loop-tindakan').attr('data-no')
            subTotalBiayaTindakan(dataNo)
            totalBiayaTindakan()
        })
        $(".loop-tindakan .qty_tindakan").keyup(function(){
            var dataNo = $(this).closest('.loop-tindakan').attr('data-no')
            subTotalBiayaTindakan(dataNo)  
            totalBiayaTindakan()
        })

        
        $("#addItemTindakan").click(function(e){
            e.preventDefault();
            var dataRow = parseInt($('#row-tindakan').attr('data-row'))
            $.ajax({
                type : 'get',
                url : '<?= base_url().'periksamedis/newItemLoopTindakan' ?>',
                data : {no : dataRow+1},
                success : function(data){
                    $('#row-tindakan').append(data)
                    $('#row-tindakan').attr('data-row',dataRow + 1)

                    $(".remove-tindakan").click(function(e){
                        e.preventDefault();
                        removeTindakan($(this))
                    })
                    $(".tindakan").change(function() {
                        getBiayaTindakan($(this))
                        var dataNo = $(this).closest('.loop-tindakan').attr('data-no')
                        subTotalBiayaTindakan(dataNo)
                        totalBiayaTindakan()
                    })

                    $(".loop-tindakan .qty_tindakan").keyup(function(){
                        var dataNo = $(this).closest('.loop-tindakan').attr('data-no')
                        subTotalBiayaTindakan(dataNo)  
                        totalBiayaTindakan()
                    })

                    $(".select2").select2()
                }
            })
        })


        function selectAlat(thisAttr){
            var stok = thisAttr.find(':selected').data('stok')
            console.log(stok)
            var dataId = thisAttr.closest('.loop-alat').attr('data-no')
            $(".loop-alat[data-no='"+dataId+"'] .stokAlat option").remove();
            var option = "";
            if(stok==0){
                option = "<option value=''>Habis</option>";
            }
            else{
                for (let s = 1; s <= stok; s++) { option+="<option>" +s+"</option>";
                    }
                }
                $(".loop-alat[data-no='"+dataId+"'] .stokAlat").append(option);
        }
        $(".selectAlat").change(function(){
            selectAlat($(this))
        })

        $("#addItemAlat").click(function(e){
            e.preventDefault();
            var dataRow = parseInt($('#row-alat').attr('data-row'))
            var dataNo = parseInt($('#row-alat').attr('data-no'))
            console.log(dataRow,dataNo)
            $.ajax({
                type : 'get',
                url : '<?= base_url().'periksamedis/newItemLoopAlat' ?>',
                data : {no : dataRow+1},
                success : function(data){
                    $('#row-alat').append(data)
                    $('#row-alat').attr('data-row',dataRow + 1)
                    $(".selectAlat").change(function(){
                        selectAlat($(this))
                    })
                    $(".remove-alat").click(function(e){
                        e.preventDefault();
                        removeAlat($(this))
                    })
                    $(".select2").select2()
                }
            })
        })

        $(".remove-alat").click(function (e) {
            e.preventDefault();
            removeAlat($(this))
        })
        function removeAlat(params) {
            var dataNo = params.attr('data-no'); 
            console.log(dataNo);
            var dataRow = parseInt($('#row-alat').attr('data-row')) 
            $('.loop-alat[data-no="' + dataNo + '" ]').remove() 
            $('#row-alat').attr('data-row', dataRow - 1)
        }