<div class="modal" id="detailNasabahModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Nasabah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label >Jadwal Verifikasi Data Fisik </label>
                            <input type="date" value="" id="jadwal_detail" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nama">Slot Waktu Verifikasi Data Fisik</label>
                            <input type="text" class="form-control" id="slot_detail" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label >Cabang atau Capem</label>
                            <input type="text" id="cabang_detail" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-6">

                        <div class="form-group">
                            <label for="nama">Customer Service</label>
                            <input type="text" class="form-control" id="customer_service_detail" readonly>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs mt-3">
                    <li class="mr-5" id="biodata_diri_tab"><a href="#biodata_diri" class="active tab-bar-konfirmasi-active" data-toggle="tab" id="biodata_diri_link">Biodata Diri</a></li>
                    <li class="mr-5" id="formulir_pengajuan_tab"><a href="#formulir_pengajuan" class="tab-bar-konfirmasi-inactive" data-toggle="tab" id="formulir_pengajuan_link">Formulir Pengajuan</a></li>
                    <li class="mr-5" id="dokumen_tab"><a href="#dokumen" class="tab-bar-konfirmasi-inactive" data-toggle="tab" id="dokumen_link">Dokumen</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active mt-3" id="biodata_diri">
                        @include('user.daftar_pengajuan.modal.detail.biodata_multiguna')
                    </div>

                    <div class="tab-pane mt-3" id="formulir_pengajuan">
                        @include('user.daftar_pengajuan.modal.detail.formulir_pengajuan')
                    </div>


                    <div class="tab-pane" id="dokumen">
                        @include('user.daftar_pengajuan.modal.detail.dokumen')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



