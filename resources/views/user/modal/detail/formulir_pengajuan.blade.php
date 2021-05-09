<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">Produk Kredit</label>
            <select class="form-control" name="produk_kredit" id="produk_kredit" disabled>
                <option selected disabled>-Pilih Produk Kredit-</option>
                @foreach($produk as $data)
                    @if($transaksi->produk_id == $data->id)
                        <option value="{{$data->id}}" selected>{{$data->nama}}</option>
                    @else
                        <option value="{{$data->id}}">{{$data->nama}}</option>
                    @endif

                @endforeach
            </select>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Penghasilan per Bulan</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                </div>
                <input type="text" class="form-control currency"  value="{{$transaksi->penghasilan}}" id="penghasilan_per_bulan" disabled>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="nama">Jangka Waktu Kredit</label>
            <div class="input-group mb-3">
                <input type="number" value="{{$transaksi->masa_tenor}}" class="form-control"  name="jangka_waktu_kredit" id="jangka_waktu_kredit"  disabled>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Bulan</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="nama">Suku Bunga per Tahun</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="suku_bunga" value="{{$transaksi->suku_bunga}}" disabled>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">%</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Maksimal Plafond yang Dapat Diambil</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                </div>
                <input type="text" class="form-control currency" value="{{$transaksi->max_plafond}}"  id="max_plafond"  readonly>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">Nominal Pengajuan Kredit</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                </div>
                <input type="text" class="form-control currency"  id="nominal_pengajuan_kredit" value="{{$transaksi->plafond}}" disabled>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Jumlah Angsuran per Bulan</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                </div>
                <input type="text" class="form-control currency" value="{{$transaksi->jumlah_angsuran}}"  id="jumlah_angsuran_per_bulan" readonly>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">Keperluan Pinjaman</label>
            <input type="text" disabled class="form-control" name="keperluan_pinjaman"  id="keperluan_pinjaman" value="{{$transaksi->keperluan_pinjaman}}" >
        </div>
    </div>
</div>
