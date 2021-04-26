<div id="detailFakturModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="justify-content: flex-start!important;">
                <div class="tabsdetail active" id="tab01detail">
                    <h6 class="font-weight-bold">Detail</h6>
                </div>
                <div class="tabsdetail" id="tab02detail">
                    <h6 class="font-weight-bold" style="float: left">Barang</h6>
                </div>
                <div class="tabsdetail" id="tab03detail">
                    <h6 class="font-weight-bold" style="float: left">Log Aktivitas</h6>
                </div>
            </div>
            <div class="line"></div>
            <div class="modal-body p-0">
                <fieldset class="show fieldsetdetail" id="tab01detail1">
                    <div class="bg-light">
                        <div class="form-group pt-3 px-3">
                            <label for="noinvoice">No Invoice</label>
                            <input type="text" id="noinvoice_detail" class="form-control" name="no_invoice" disabled>
                        </div>
                        <div class="form-group px-3">
                            <label for="kodebarang">Sales</label>
                            <input type="text" class="form-control" disabled id="sales_detail">
                        </div>
                        <div class="form-group px-3">
                            <label for="kodebarang">Customer</label>
                            <input type="text" class="form-control" disabled id="customer_detail">
                        </div>
                        <div class="form-group px-3">
                            <label for="kodebarang">Jenis Pembayaran</label>
                            <input type="text" class="form-control" disabled id="jenispembayaran_detail">
                        </div>
                        <div class="form-group px-3">
                            <label for="status">Status</label>
                            <input type="text" class="form-control"  disabled id="status_detail">
                        </div>
                        <div class="form-group px-3">
                            <label for="status">Tanggal Faktur</label>
                            <input type="date" class="form-control" name="tanggaldibuat" disabled id="created_at_detail">
                        </div>
                        <div class="form-group px-3">
                            <label for="status">Tanggal Update</label>
                            <input type="date" class="form-control" name="tanggalupdate" disabled id="updated_at_detail">
                        </div>
                    </div>
                </fieldset>
                <fieldset id="tab02detail1" class="fieldsetdetail">
                    <div class="bg-light barangsectiondetail">
                    </div>
                </fieldset>
                <fieldset id="tab03detail1" class="fieldsetdetail">
                    <div class="bg-light logdetail">
                        <table class="table px-3">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Aktivitas</th>
                                <th>Tanggal</th>
                            </tr>
                            </thead>
                            <tbody id="logDetailTabel">

                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </div>
            <div class="line"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-outline-danger btn-selesai" >Selesai</button>
            </div>
        </div>
    </div>
</div>
