@extends('layout.master')
@section('title')
List Gudang - Inventory
@endsection
@section('content')
<section class="content-header">
    <h1>
        Gudang
        <small>Kelola List Gudang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-industry"></i> Home</a></li>
        <li class="active">Gudang</li>
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
            <h3 class="box-title">Daftar Gudang</h3>
            <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <button class="btn btn-success" data-toggle="modal" data-target="#tambah-barang"><i
                        class="fa fa-plus"></i> Tambah Gudang
                </button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Gudang</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
                @foreach($gudang as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>
                        <input type="hidden" id="jq_id" value="{{ $item->id }}">
                        <input type="hidden" id="jq_nama" value="{{ $item->nama }}">
                        <input type="hidden" id="jq_keterangan" value="{{ $item->keterangan }}">
                        <a href="#" class="btn btn-success btn-edit" data-toggle="modal" data-target="#edit-barang"><i
                                class="fa fa-pencil"></i> </a>
                        <a href="{{ route('delete_barang', ['id' => $item->id ]) }}" class="btn btn-danger hapus"><i
                                class="fa fa-trash"></i> </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="{{ $gudang->url(1) }}">«</a></li>
                @if($gudang->lastPage() > 1)
                @for($i = 1; $i <= $gudang->lastPage(); $i++)
                <li><a href="{{ $gudang->url($i) }}">{{ $i }}</a></li>
                @endfor
                @endif

                <li><a href="{{ $gudang->url($gudang->lastPage()) }}">»</a></li>
            </ul>
        </div><!-- box-footer -->
    </div><!-- /.box -->

</section>
<div class="modal fade" id="tambah-barang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Gudang</h4>
            </div>
            <form role="form" id="form" method="post" action="{{ route('tambah_gudang') }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Gudang</label>
                        <input type="text" name="nama" id="nama" class="form-control"
                               value="{{ old('nama_barang') }}">
                    </div>
                    <div class="form-group" id="form-tambah">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"
                                  placeholder="Masukkan keterangan ...">{{ old('keterangan') }}</textarea>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-tambah" class="btn btn-primary"><i class="fa fa-plus"></i>
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-barang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Gudang</h4>
            </div>
            <form role="form" id="form_edit" method="post" action="{{ route('tambah_gudang') }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_nama">Nama Gudang</label>
                        <input type="text" name="edit_nama" id="edit_nama" class="form-control"
                               value="{{ old('nama_barang') }}">
                    </div>

                    <div class="form-group">
                        <label for="edit_keterangan">Keterangan</label>
                        <textarea class="form-control" id="edit_keterangan" name="edit_keterangan" rows="3"
                                  placeholder="Masukkan keterangan ...">{{ old('keterangan') }}</textarea>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-tambah" class="btn btn-primary"><i class="fa fa-floppy-o"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.btn-edit').click(function () {
            var id = $(this).closest('td').find('#jq_id').val();
            var nama = $(this).closest('td').find('#jq_nama').val();
            var keterangan = $(this).closest('td').find('#jq_keterangan').val();
            $('#edit_nama').val(nama);
            $('#edit_keterangan').text(keterangan);
            $('#form_edit').attr('action', '/gudang/edit/' + id);
        })
    })
</script>
@endsection