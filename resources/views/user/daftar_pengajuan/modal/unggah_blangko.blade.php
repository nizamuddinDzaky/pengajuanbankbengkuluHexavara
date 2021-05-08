<div class="modal" id="unggahBlangkoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body px-5">
                <input type="hidden" name="transaksi_id" id="transaksi_id_batal">
                <div class="row">
                    <div class="col-12 text-center">
                        <h3 >Unggah Blangko Anda</h3>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <p class="text-muted">Ukuran file maks. 5MB. Format file .jpg, .jpeg, .png.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class='content'>
                            <!-- Dropzone -->
                            <div  id="unggahDokumen" class="dropzone" >
                                @csrf
                                <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn orange-primary"> Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



