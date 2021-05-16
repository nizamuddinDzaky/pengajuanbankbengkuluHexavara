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

                <ul class="nav nav-tabs">
                    <li class="mr-5" id="biodata_diri_tab"><a href="#biodata_diri" class="active tab-bar-konfirmasi-active" data-toggle="tab" id="biodata_diri_link">Biodata Diri</a></li>
                    <li class="mr-5" id="dokumen_tab"><a href="#dokumen" class="tab-bar-konfirmasi-inactive" data-toggle="tab" id="dokumen_link">Dokumen</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active mt-3" id="biodata_diri">
                        @include('adminpusat.modal.biodata_nasabah')
                    </div>

                    <div class="tab-pane" id="dokumen">
                        @include('adminpusat.modal.dokumen_nasabah')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



