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

    var awal = $('#checkerMulai').val().substr(0,5);
    var selesai = $('#checkerSelesai').val().substr(0,5);

    var jam = awal + ' - ' + selesai;

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
                if (data[index] === jam){
                    content =   '<option value="'+ data[index]+'" selected>'+data[index]+'</option>'
                }else if(data[index] !== jam){
                    content =   '<option value="'+ data[index]+'">'+data[index]+'</option>'
                }else{
                    content =   '<option value="'+ jam+'">'+jam+'</option>'
                }


                $("#slotWaktu").append(content);
            });
        }
    });

}



function insertTahapAkhir(){

    if ($('#formTahapAkhir').valid()) {

        var cabang = $('#cabang').val();
        var cs = $('#customer_service').val();
        var jadwal = $('#tanggalVerifikasi').val();
        var slot = $('#slotWaktu').val();

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-Token':  $('meta[name="_token"]').attr('content')
            },
            url: "/user/pengajuan/inserttahapakhir",
            dataType: "JSON",
            data: {cabang: cabang, cs : cs, jadwal: jadwal, slot: slot},
            success: function (data) {
                if(data === "success"){
                    location.reload()
                }else{
                    toastr.error("Gagal Menyimpan Data");
                }
            }
        });


    } else {
       toastr.error('Lengkapi semua data');
    }

}


$( document ).ready(function() {
    if ($('#checkerCabang').val() !== "" && $('#checkerCS').val() !== "" && $('#checkerTanggal').val() !== "" && $('#checkerMulai').val() !== "" && $('#checkerSelesai').val() !== ""  ){
        $('#konfirmasiPengajuanModal').modal('toggle');
    }
});




