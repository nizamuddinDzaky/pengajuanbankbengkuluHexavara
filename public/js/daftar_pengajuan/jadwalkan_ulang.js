$('#cabang').on('change', function(){

    var cabang_id = $(this).val();

    getCustomerService(cabang_id);

    var customer_service = $('#customer_service').val();
    var tanggal = $('#tanggalVerifikasi').val();

    getSlotWaktu(tanggal, customer_service);

});


$('#customer_service').on('change', function(){

    var customer_service = $(this).val();
    var tanggal = $('#tanggalVerifikasi').val();

    getSlotWaktu(tanggal, customer_service);

});


$('#tanggalVerifikasi').on('change', function(){

    var tanggal = $(this).val();

    var myDate = new Date(tanggal);


    if(myDate.getDay() == 6 || myDate.getDay() == 0){
        toastr.error('Pilih hari selain Sabtu dan Minggu')
        $('#slotWaktu').empty();
    }else{
        var customer_service = $('#customer_service').val();
        getSlotWaktu(tanggal, customer_service);
    }





});


function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}




function getCustomerService(cabang_id){

    var customer_service =  $('#checkerCS').val()


    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
        },
        url: "/user/pengajuan/getcustomerservice",
        dataType: "JSON",
        data: {id: cabang_id},
        success: function (data) {
            $('#customer_service').empty();
            $.each(data, function(index) {
                var content = "";
                if (customer_service == data[index]['id'])
                {
                    content =   '<option value="'+ data[index]['id']+'" selected>'+data[index]['name']+'</option>'
                }else{
                    content =   '<option value="'+ data[index]['id']+'">'+data[index]['name']+'</option>'
                }

                $("#customer_service").append(content);
            });
        }
    });
}


function getSlotWaktu(tanggal, customer_service){

    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
        },
        url: "/user/pengajuan/getslotwaktu",
        dataType: "JSON",
        data: {tanggal: tanggal, customer_service : customer_service},
        success: function (data) {
            var content = "";
            $('#slotWaktu').empty();

            $.each(data, function(index) {
                    content =   '<option value="'+ data[index]+'">'+data[index]+'</option>'



                $("#slotWaktu").append(content);
            });
        }
    });

}






