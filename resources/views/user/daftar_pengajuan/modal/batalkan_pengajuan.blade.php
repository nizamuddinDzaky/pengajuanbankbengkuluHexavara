<div class="modal" id="batalkanPengajuanModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body px-5">
                <form action="{{route('user.batalkan_pengajuan')}}" method="POST">
                    @csrf
                    <input type="hidden" name="transaksi_id" id="transaksi_id_batal">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 >Batalkan Pengajuan</h3>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                          <p>Apakah Anda yakin untuk membatalkan pengajuan kredit?</p>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-6 text-right">
                            <button data-dismiss="modal" class="btn orange-outline" style="width: 100%">Tidak</button>
                        </div>
                        <div class="col-6 text-left">
                           <button type="submit" class="btn  orange-primary" style="width: 100%">Yakin</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



