<div class="modal" id="cetakBlangkoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body px-5">
                <form action="{{route('user.download_blangko')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 >Unduh Blangko Anda</h3>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            <p class="text-muted">Silahkan unduh blangko anda di bawah ini, lalu isikan data yang belum terisi. Setelah itu berikan tanda tangan dan stempel anda sesuai instansi Anda. Kemudian unggah kembali</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{--                            <iframe src="https://docs.google.com/gview?url=http://.'{{asset('blangko/blangko_multiguna_aktif.docx')}}'.&embedded=true"></iframe>--}}
                            <embed src="{{asset('blangko/blangko_pns_aktif.pdf')}}" width="80%" height="800px" />
                        </div>
                    </div>
                    <input type="hidden" name="transaksi_id" id="transaksi_id_unduh">
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn orange-primary"><i class="fa fa-download"></i> Unduh Blangko</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



