<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
<form method="POST" action="{{$url_post}}">
@csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control" id="" placeholder="Nama CS" name="name_cs">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" id="" placeholder="Email CS" name="email_cs">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Hak Akses</label>
                <select class="form-control select2" name="type_cs" id="type_cs">
                    @foreach($type_cs as $tcs)
                    <option value="{{$tcs->id}}">{{$tcs->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" id="" placeholder="Password" name="password" value="{{$default_password}}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Cabang/Capem</label>
                <input type="text" class="form-control" id="" placeholder="" name="" value="{{$cabang->nama_kantor}}" readonly>
            </div>
        </div>
    </div>
        
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-orange float-right">Simpan</button>
        </div>
    </div>
</form>
<script src="{{asset('admin/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script>
    
</script>