<div class="modal" id="jadwalkanUlangModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Jadwalkan Ulang Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('user.jadwalkan_ulang_pengajuan')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Cabang atau Capem</label>
                                <select name="cabang" class="form-control" id="cabang" required>
                                    <option selected disabled>-Pilih Cabang atau Capem Terdekat-</option>
                                    @foreach($cabang as $data)
                                            <option value="{{$data->id}}">{{$data->nama_kantor}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="transaksi_id" id="transaksi_id">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Customer Service</label>
                                <select name="customer_service" class="form-control" id="customer_service" required>
                                    <option selected disabled>-Pilih CS yang Tersedia di Cabang atau Capem Terdekat-</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Jadwal Verifikasi Data Fisik</label>
                                <input type="date" min="{{\Carbon\Carbon::now()->toDateString()}}" name="tanggalVerifikasi" id="tanggalVerifikasi" class="form-control" required >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Slot Waktu Verifikasi Data Fisik</label>
                                <select name="slotWaktu" class="form-control" id="slotWaktu" required>
                                    <option selected disabled>-Pilih Slot Waktu yang Tersedia-</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn" style="background-color: #e46931; border: none; color: white">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



