@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Register Client</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('clients') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="header" class="col-md-4 col-form-label text-md-right">Header</label>

                            <div class="col-md-6">
                                <textarea rows="5" class="form-control{{ $errors->has('header') ? ' is-invalid' : '' }}" name="header" value="{{ old('header') }}" required autofocus>Perjanjian sewa menyewa ini (“Perjanjian Sewa”) ditandatangani di Surabaya, pada hari ini, Jumat tanggal Sebelas bulan Desember tahun Dua Ribu Dua Puluh (11-12-2020).
                                </textarea>

                                @if ($errors->has('header'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('header') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pt" class="col-md-4 col-form-label text-md-right">No Invoice</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$data[0]->id}}" name="invoice_id"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pt" class="col-md-4 col-form-label text-md-right">Nama PT</label>

                            <div class="col-md-6">
                                <input id="pt" type="text" value="{{$data[0]->companyname}}" class="form-control{{ $errors->has('pt') ? ' is-invalid' : '' }}" name="pt" value="{{ old('pt') }}" required autofocus>

                                @if ($errors->has('pt'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Alamat PT</label>

                            <div class="col-md-6">
                                <input id="address" value="{{$data[0]->address1}}" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Penanggung Jawab PT</label>

                            <div class="col-md-6">
                                <input id="client" value="{{$data[0]->firstname}} {{$data[0]->lastname}}" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="waktu" class="col-md-4 col-form-label text-md-right">Jangka Waktu</label>

                            <div class="col-md-6">
                                <textarea class="editor" id="waktu" cols="30" rows="10" name="waktu" required>
                                </textarea>

                                @if ($errors->has('waktu'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('waktu') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sewa" class="col-md-4 col-form-label text-md-right">Harga Sewa dan Cara Pembayaran </label>

                            <div class="col-md-6">
                                <textarea class="editor" id="harga" cols="30" rows="10" name="sewa" required>
                                Besarnya biaya sewa tersebut sebesar Rp. 3.140.000,- (Tiga juta seratus empat puluh ribu rupiah), diluar PPN. Pembayaran dilakukan dalam 4 kali termin setiap 3 bulan sebesar Rp 785.000 (Tujuh ratus delapan puluh lima ribu lima rupiah) diluar PPN dengan cara ditransfer ke rekening bank atau dibayar tunai.
                                </textarea>

                                @if ($errors->has('sewa'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sewa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{ asset('js/terbilang.js') }}"></script>
<script type="text/javascript">
  $('.cari').select2({
    placeholder: 'Cari...',
    ajax: {
      url: '/cari',
      dataType: 'json',
      delay: 0,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.id,
              company:item.companyname,
              address:item.address1,
              client:item.firstname+' '+item.lastname,
              total:item.total,
              date:item.date,
              duedate:item.duedate,
              id: item.id
            }
          })
        };
      },
      cache: true
    }
  });
  $('.cari').on("select2:selecting", function(e) {
      $("#pt").val(e.params.args.data.company);
      $("#address").val(e.params.args.data.address);
      $("#client").val(e.params.args.data.client);

});
</script>
<script>
    $(document).ready(function(){
        var options = {
  skin: 'moono',
  enterMode: CKEDITOR.ENTER_BR,
  shiftEnterMode:CKEDITOR.ENTER_P,
  toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
             { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
             { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
             { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
             { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
             { name: 'links', items: [ 'Link', 'Unlink' ] },
             { name: 'insert', items: [ 'Image'] },
             { name: 'spell', items: [ 'jQuerySpellChecker' ] },
             { name: 'table', items: [ 'Table' ] }
             ],
};
    $(".editor").each(function () {
            let id = $(this).attr('id');
            CKEDITOR.replace(id, options);
        });
    });
    var a = terbilang(10000).replace(/  +/g, ' ');
    console.log(a);
</script>
@stop
