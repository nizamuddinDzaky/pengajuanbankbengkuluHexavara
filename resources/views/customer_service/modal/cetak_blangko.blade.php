<div class="modal" id="cetakBlangkoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body px-5">
                <form action="{{route('user.download_blangko')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 >Pilih Blangko untuk Dicetak</h3>
                        </div>
                    </div>

                    <ul class="nav nav-tabs mt-3">
                        <li class="mr-5" id="template_blangko_tab"><a href="#template_blangko" class="active tab-bar-konfirmasi-active" data-toggle="tab" id="template_blangko_link">Template Blangko</a></li>
                        <li class="mr-5" id="blangko_nasabah_tab"><a href="#blangko_nasabah" class="tab-bar-konfirmasi-inactive" data-toggle="tab" id="blangko_nasabah_link">Blangko Nasabah</a></li>
                    </ul>


                    <div class="tab-content">
                        <div class="tab-pane active mt-3" id="template_blangko">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <embed  width="80%" height="800px" class="template_blangko_pdf" />
                                </div>
                            </div>
                        </div>
                        @if(isset($nasabah[0]))
                        <input type="hidden" value="{{$nasabah[0]->transaksi_id}}" name="transaksi_id">
                        @endif
                        <div class="tab-pane mt-3" id="blangko_nasabah">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    @if(isset($nasabah[0]))
                                    @if($nasabah[0]->path_file_blangko != null)
                                    <embed src="{{asset($nasabah[0]->path_file_blangko)}}" width="80%" height="800px" />
                                    @else
                                        <embed src="" width="80%" height="800px" class="blangko_nasabah_pdf" />
                                    @endif
                                    @else
                                        <embed src="" width="80%" height="800px" class="blangko_nasabah_pdf" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-12 text-right">
                            <button   class="btn orange-outline" id="buttonCetakBlangko" ><i class="fa fa-print"></i> Unduh Template Blangko</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



