        function getBiaya(thisParam) {
            var biaya = thisParam.find(":selected").attr('data-biaya')
            var getNo = thisParam.closest('.loop-biaya').attr('data-no')
            $(".loop-biaya[data-no='" + getNo + "'] .biaya").val(biaya)
        }
        function subTotalBiaya(dataNo) {
            var qty_biaya = parseInt($(".loop-biaya[data-no='" + dataNo + "'] .qty_biaya").val())
            var biaya = parseInt($(".loop-biaya[data-no='" + dataNo + "'] .biaya").val())
            var subtotal = isNaN(qty_biaya * biaya) ? 0 : qty_biaya * biaya
            $(".loop-biaya[data-no='" + dataNo + "'] .total_biaya").val(subtotal)
        }
        function getOpr(thisParam){
            var biaya = thisParam.find(":selected").attr('data-biaya-opr')
            console.log(biaya)
            $(".opr .biayaopr").val(biaya)
        }

        $(".selectOpr").keyup(function() {
            var dataNo = $(this).closest('.opr').attr('data-biaya-opr')
            totalBiaya()
        })

        $(".getOpr").change(function() {
            getOpr($(this))
        })
        function totalBiaya() {
            var totalBiaya = 0
            var biayaOpr = parseInt($(".opr .biayaopr").val())
            $(".total_biaya").each(function(i, v) {
                var subTotal = parseInt(v.value)
                totalBiaya += subTotal + biayaOpr
            })
            $("#totalBiaya").val(totalBiaya)
            grandTotal()
        }

        $(".qty_biaya").keyup(function() {
            var dataNo = $(this).closest('.loop-biaya').attr('data-no')
            subTotalBiaya(dataNo)
            totalBiaya()
        })


        $(".getBiaya").change(function() {
            getBiaya($(this))
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

