<div class="modal" id="tambahProdukModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk dan Akad Kredit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.pusat.tambah.produk_kredit')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label> Nama Produk <span style="color: red">*</span> </label>
                                <input type="text" value="" class="form-control" name="nama_produk" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label >Penjelasan <span style="color: red">*</span></label>
                                <textarea class="form-control" name="penjelasan" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="noktp">Dokumen Formulir / Blangko <span style="color: red">*</span></label>
                            <div class='content'>
                                <!-- Dropzone -->
                                <div id="dokumenBlangko" class="dropzone">
                                    @csrf
                                    <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                                </div>
                            </div>
                            <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .docx</small>
                        </div>
                        <div class="col-6">
                            <label for="noktp">Template Formulir / Blangko <span style="color: red">*</span></label>
                            <div class='content'>
                                <!-- Dropzone -->
                                <div id="dokumenTemplateBlangko" class="dropzone">
                                    @csrf
                                    <div class="dz-message" data-dz-message><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                                </div>
                            </div>
                            <small  class="form-text text-muted">Ukuran file maks 5MB. Format file .pdf</small>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <h2>Penentuan Bunga</h2>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label >Jenis Bunga <span style="color: red">*</span></label>
                                <select name="suku_bunga" id="suku_bunga_tambah" class="form-control" required>
                                    <option value="berjangka">Suku Bunga Berjangka</option>
                                    <option value="flat">Suku Bunga Flat</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-6" id="suku_bunga_flat">
                            <div class="form-group">
                                <label >Bunga per tahun <span style="color: red">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" required name="bunga_flat" id="bunga_flat" step="0.01">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="suku_bunga_berjangka">
                    <div class="row mt-3" id="">
                        <div class="col-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="number" class="form-control berjangka" name="tahun_awal[]" required placeholder="Awal">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Tahun</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="number" class="form-control berjangka" required name="tahun_akhir[]" placeholder="Akhir">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Tahun</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="number" step="0.01" class="form-control berjangka" name="bunga_berjangka[]" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-2">
                        <button class="btn orange-outline" type="button" onclick="tambahJangkaWaktu()">+ Jangka Waktu</button>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button  class="btn" style="background-color: #e46931; border: none; color: white" onClick='return confirmSubmit()'>Konfirmasi</button>
                    </div>
                </form>

                <form action="" id="validasiBlangkoTambah" name="validasiBlangkoTambah">
                    <input type="hidden" id="template_blangko_tambah" required>
                    <input type="hidden" id="dokumen_blangko_tambah" required>
                </form>
            </div>
        </div>
    </div>
</div>



