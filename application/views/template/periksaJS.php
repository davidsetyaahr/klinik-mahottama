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
        function totalBiaya() {
            var totalBiaya = 0
            $(".total_biaya").each(function(i, v) {
                var subTotal = parseInt(v.value)
                totalBiaya += subTotal
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
        $(".tindakan").change(function(){
            var totalTindakan = 0
            var valTindakan = $(this).val()
            if(valTindakan!=null){
                $.each(valTindakan, function(i,v){
                    var harga = parseInt($(".tindakan option[value='"+v+"']").attr('data-harga'))
                    totalTindakan+=harga
                })
            }
            $("#totalTindakan").val(totalTindakan)
            grandTotal()
        })


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
                        var dataNo = $(this).attr('data-no')
                        var dataRow = parseInt($('#row-biaya').attr('data-row'))
                        $('.loop-biaya[data-no="' + dataNo + '"]').remove()
                        $('#row-biaya').attr('data-row', dataRow - 1)
                        totalBiaya()
                    })
                    $(".select2").select2()
                }
            })
        })

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
                        var dataNo = $(this).attr('data-no')
                        var dataRow = parseInt($('#row-obat').attr('data-row'))
                        $('.loop-obat[data-no="'+dataNo+'"]').remove()
                        $('#row-obat').attr('data-row',dataRow-1)
                        totalObat()

                    })
                    $(".select2").select2()
                }
            })
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
                        var dataNo = $(this).attr('data-no')
                        var dataRow = parseInt($('#row-alkes').attr('data-row'))
                        $('.loop-alkes[data-no="'+dataNo+'"]').remove()
                        $('#row-alkes').attr('data-row',dataRow-1)
                        totalAlkes()

                    })
                    $(".select2").select2()
                }
            })
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
                        var dataNo = $(this).attr('data-no')
                        var dataRow = parseInt($('#row-tindakan').attr('data-row'))
                        $('.loop-tindakan[data-no="'+dataNo+'"]').remove()
                        $('#row-tindakan').attr('data-row',dataRow-1)
                    })
                    $(".select2").select2()
                }
            })
        })
