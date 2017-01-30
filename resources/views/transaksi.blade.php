@extends('layout.master')
@section('title')
    Transaksi - Inventory
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Transaksi
            <small>Tambah transaksi baru</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-industry"></i> Home</a></li>
            <li class="active">Transaksi</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @foreach(['danger','success','warning','info'] as $msg)
            @if(Session::has('alert-'.$msg))
                <div class="alert alert-{{ $msg }} alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    {{ Session::get('alert-'.$msg) }}
                </div>
            @endif
        @endforeach
        @if(count($errors) > 0)
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Oops!</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Form Transaksi</h3>
                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->

                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <form role="form" method="post" action="{{ route('save') }}">
                <div class="box-body">
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                    <div class="form-group col-md-6">
                        <label for="gudang">Gudang</label>
                        <select name="gudang_id" id="gudang" class="form-control">
                            <option selected disabled>Pilih</option>
                            @foreach($gudang as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tanggal">Tanggal</label>
                        <input type="text" class="form-control" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}"
                               readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="rg">Tipe Transaksi</label>
                        <div class="radio" id="rg">
                            <label>
                                <input type="radio" name="keterangan" id="tipe1" value="Masuk" checked="">
                                Masuk
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="keterangan" id="tipe2" value="Keluar">
                                Keluar
                            </label>
                        </div>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="barang">Barang</label>
                        <select name="barang" id="barang" class="form-control select2" style="width: 100%;">
                            <option selected disabled>Pilih barang</option>
                            @foreach($barang as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="jumlah-barang">Jumlah Barang</label>
                        <input type="text" name="jumlah" id="jumlah-barang" class="form-control">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="unit">Unit</label>
                        <input type="text" name="unit" id="unit" class="form-control" readonly>
                    </div>
                    <div class="col-md-2"><br>
                        <a href="javascript:void(0)" id="tambah-barang" class="btn btn-success">Tambahkan barang</a>
                    </div>
                    <table class="table table-hover" id="daftar-barang">
                        <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Unit</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                </div>
            </form><!-- /.box-body -->
            <div class="box-footer">
            </div><!-- box-footer -->
        </div><!-- /.box -->

    </section>

@endsection
@section('script')
    <script src="{{ asset('js/select2.full.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#gudang, #barang').select2();

            $('#barang').on('change', function (e) {
                var selected = this.value;
                $.ajax({
                    type: 'GET',
                    url: 'transaksi/unit/' + selected,
                    dataType: 'json',
                    success: function (json) {
                        $('#unit').val(json.unit)
                    }
                })
            });
            function isExist(newEntry) {
                return Array.from($('tr[id*=list-barang]'))
                        .some(element => $('td:nth(0)', $(element)).html() === newEntry);
            }

            $('#tambah-barang').click(function (e) {
                var barang = $('#barang option:selected').text();
                if (barang == 'Pilih barang' || !$('#jumlah-barang').val()) {
                    alert('Anda belum memilih barang atau belum memasukkan jumlah barang');
                } else {
                    if (isExist(barang)) {
                        alert('Barang sudah ada dalam daftar');
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('temp') }}',
                            data: {
                                barang_id: $('#barang option:selected').val(),
                                unit: $('#unit').val(),
                                jumlah: $('#jumlah-barang').val(),
                                _token: '{{ Session::token() }}'
                            },
                            dataType: 'json',
                            success: function (data) {
                                $('#daftar-barang tbody').append('<tr id="list-barang"><td>' + barang + '</td><td>' + $('#jumlah-barang').val() + '</td><td>' + $('#unit').val() + '</td></tr>');
                            }
                        });

                    }

                }

            })
        })
    </script>
@endsection