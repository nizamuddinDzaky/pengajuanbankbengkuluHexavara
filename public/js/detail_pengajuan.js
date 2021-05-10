$('#detailPengajuanModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('transaksi_id');

    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        url: "/user/daftar_pengajuan/get_detail_transaksi",
        dataType: "JSON",
        data : {id : id},
        success: function (response) {


            //header
            $('#jadwal_detail').val(response['tanggal']);
            $('#slot_detail').val(response['slot_waktu']);
            $('#cabang_detail').val(response['nama_cabang']);
            $('#customer_service_detail').val(response['nama_cs']);

            //formulir pengajuan
            $('#produk_kredit_detail').val(response['nama_produk']);
            $('#penghasilan_per_bulan_detail').val(response['penghasilan']);
            $('#jangka_waktu_kredit_detail').val(response['masa_tenor']);
            $('#suku_bunga_detail').val(response['suku_bunga']);
            $('#max_plafond_detail').val(response['max_plafond']);
            $('#nominal_pengajuan_kredit_detail').val(response['plafond']);
            $('#jumlah_angsuran_per_bulan_detail').val(response['jumlah_angsuran']);
            $('#keperluan_pinjaman_detail').val(response['keperluan_pinjaman']);


            //biodata
            $('#name_detail').val(response['nama_nasabah']);
            $('#email_detail').val(response['email_nasabah']);
            $('#jenis_kelamin_detail').val(response['jenis_kelamin_nasabah']);
            $('#no_ktp_detail').val(response['no_ktp_nasabah']);
            $('#no_hp_detail').val(response['no_hp_nasabah']);
            $('#tempat_lahir_detail').val(response['tempat_lahir_nasabah']);
            $('#tanggal_lahir_detail').val(response['tanggal_lahir_nasabah']);
            $('#alamat_detail').val(response['alamat_nasabah']);
            $('#pekerjaan_detail').val(response['pekerjaan_nasabah']);
            $('#no_npwp_detail').val(response['npwp_nasabah']);



            $('#nama_panggilan_detail').val(JSON.parse(response['biodata']).nama_panggilan);
            $('#masa_berlaku_ktp_detail').val(JSON.parse(response['biodata']).masa_berlaku_ktp);
            $('#nama_ibu_kandung_detail').val(JSON.parse(response['biodata']).nama_ibu_kandung);
            $('#status_perkawinan_detail').val(JSON.parse(response['biodata']).status_perkawinan);
            $('#agama_detail').val(JSON.parse(response['biodata']).agama);
            $('#nama_pasangan_detail').val(JSON.parse(response['biodata']).nama_pasangan);
            $('#no_ktp_pasangan_detail').val(JSON.parse(response['biodata']).no_ktp_pasangan);
            $('#pekerjaan_pasangan_detail').val(JSON.parse(response['biodata']).pekerjaan_pasangan);
            $('#alamat_nohp_pasangan_detail').val(JSON.parse(response['biodata']).alamat_nohp_pasangan);
            $('#hubungan_pasangan_detail').val(JSON.parse(response['biodata']).hubungan);
            $('#pendidikan_detail').val(JSON.parse(response['biodata']).pendidikan);
            $('#keterangan_gelar_detail').val(JSON.parse(response['biodata']).keterangan_gelar);
            $('#kewarganegaraan_detail').val(JSON.parse(response['biodata']).kewarganegaraan);
            $('#jumlah_anak_detail').val(JSON.parse(response['biodata']).jumlah_anak);
            $('#no_telp_rumah_detail').val(JSON.parse(response['biodata']).no_telp_rumah);
            $('#status_kepemilikan_rumah_detail').val(JSON.parse(response['biodata']).status_kepemilikan_rumah);
            $('#jabatan_detail').val(JSON.parse(response['biodata']).jabatan);
            $('#pangkat_detail').val(JSON.parse(response['biodata']).pangkat);
            $('#kantor_detail').val(JSON.parse(response['biodata']).kantor);
            $('#nip_detail').val(JSON.parse(response['biodata']).NIP);
            $('#no_telp_kantor_detail').val(JSON.parse(response['biodata']).no_telp_kantor);
            $('#no_fax_kantor_detail').val(JSON.parse(response['biodata']).no_fax_kantor);
            $('#email_kantor_detail').val(JSON.parse(response['biodata']).email_kantor);
            $('#lama_bekerja_detail').val(JSON.parse(response['biodata']).lama_bekerja);
            $('#alamat_kantor_detail').val(JSON.parse(response['biodata']).alamat_kantor);
            $('#provinsi_detail').val(response['provinsi']);
            $('#kabkot_detail').val(response['kabkot']);
            $('#kecamatan_detail').val(response['kecamatan']);
            $('#kelurahan_detail').val(response['kelurahan']);
            $('#kode_pos_detail').val(response['kode_pos']);


            //dokumen user
            setImageDokumenUser(response, "ktp");
            setImageDokumenUser(response, "npwp");
            setImageDokumenUser(response, "pas_foto");

            //dokumen
            setImageDokumenSaya(response, "kartu_keluarga");
            setImageDokumenSaya(response, "ktp_pasangan");
            setImageDokumenSaya(response, "pas_foto_pasangan");
            setImageDokumenSaya(response, "buku_tabungan");
            setImageDokumenSaya(response, "buku_nikah");
            setImageDokumenSaya(response, "jaminan_shm");
            setImageDokumenSaya(response, "dokumen_spt");

            setImageDokumenKredit(response, "gaji_terakhir")
            setImageDokumenKredit(response, "struk_gaji_bulan_terakhir")
            setImageDokumenKredit(response, "SK_CAPEG")
            setImageDokumenKredit(response, "SK_pegawai_tetap")
            setImageDokumenKredit(response, "SK_pangkat_terakhir")
            setImageDokumenKredit(response, "SK_berkala_terakhir")
            setImageDokumenKredit(response, "kartu_pegawai")
            setImageDokumenKredit(response, "kartu_taspen")

            $('#nomor_sk_capeg_detail').val(JSON.parse(response['path_file']).no_SK_CAPEG);
            $('#nomor_sk_pegawai_tetap_detail').val(JSON.parse(response['path_file']).no_SK_pegawai_tetap);
            $('#nomor_sk_pangkat_terakhir_detail').val(JSON.parse(response['path_file']).no_SK_pangkat_terakhir);
            $('#nomor_sk_berkala_terakhir_detail').val(JSON.parse(response['path_file']).no_SK_berkala_terakhir);
            $('#nomor_shm_detail').val(JSON.parse(response['path_file_dokumen_saya']).no_shm_bpkb);


        }
    });

});

function setImageDokumenSaya(response, nama){
    $('#'+nama+'_detail').val(response[nama]);
    if(response[nama] != "Tidak Ada File yang Diunggah"){
        $('#'+nama+'_image').attr("href", "/"+JSON.parse(response['path_file_dokumen_saya'])[nama]);
        $('#'+nama+'_image').show();
    }else{
        $('#'+nama+'_image').hide();
    }
}

function setImageDokumenKredit(response, nama){
    $('#'+nama+'_detail').val(response[nama]);
    if(response[nama] != "Tidak Ada File yang Diunggah"){
        $('#'+nama+'_image').attr("href", "/"+JSON.parse(response['path_file'])[nama]);
        $('#'+nama+'_image').show();
    }else{
        $('#'+nama+'_image').hide();
    }
}

function setImageDokumenUser(response, nama){
    $('#'+nama+'_detail').val(response[nama]);
    if(response[nama] != "Tidak Ada File yang Diunggah"){
        $('#'+nama+'_image').attr("href", "/"+JSON.parse(response['path_file_user'])[nama]);
        $('#'+nama+'_image').show();
    }else{
        $('#'+nama+'_image').hide();
    }
}
