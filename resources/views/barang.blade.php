@extends('layout.master')
@section('title')
    List Barang - Inventory
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Barang
            <small>Kelola List Barang</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cubes"></i> Home</a></li>
            <li class="active">Barang</li>
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
                <h3 class="box-title">Daftar Barang</h3>
                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <button class="btn btn-success" data-toggle="modal" data-target="#tambah-barang"><i
                                class="fa fa-plus"></i> Tambah Barang
                    </button>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Deskripsi</th>
                        <th>Unit</th>
                        <th>Stok</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                    @foreach($barang as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                <input type="hidden" id="jq_id" value="{{ $item->id }}">
                                <input type="hidden" id="jq_nama" value="{{ $item->nama_barang }}">
                                <input type="hidden" id="jq_deskripsi" value="{{ $item->deskripsi }}">
                                <input type="hidden" id="jq_unit" value="{{ $item->unit }}">
                                <input type="hidden" id="jq_stok" value="{{ $item->stok }}">
                                <input type="hidden" id="jq_keterangan" value="{{ $item->keterangan }}">
                                <a href="#" class="btn btn-success btn-edit" data-toggle="modal" data-target="#edit-barang"><i class="fa fa-pencil"></i> </a>
                                <a href="{{ route('delete_barang', ['id' => $item->id ]) }}" class="btn btn-danger hapus"><i class="fa fa-trash"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="{{ $barang->url(1) }}">«</a></li>
                    @if($barang->lastPage() > 1)
                        @for($i = 1; $i <= $barang->lastPage(); $i++)
                            <li><a href="{{ $barang->url($i) }}">{{ $i }}</a></li>
                        @endfor
                    @endif

                    <li><a href="{{ $barang->url($barang->lastPage()) }}">»</a></li>
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
                    <h4 class="modal-title" id="myModalLabel">Tambah Barang</h4>
                </div>
                <form role="form" id="form" method="post" action="{{ route('tambah_barang') }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ old('nama_barang') }}">
                        </div>
                        <div class="form-group" id="form-tambah">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                                      placeholder="Masukkan deskripsi ...">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <select name="unit" id="unit" class="form-control">
                                <option selected disabled>Pilih</option>
                                <option>Pcs</option>
                                <option>Karton</option>
                                <option>Kg</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok Awal</label>
                            <input type="text" name="stok" id="stok" class="form-control" value="{{ old('stok') }}">
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
                    <h4 class="modal-title" id="myModalLabel">Edit Barang</h4>
                </div>
                <form role="form" id="form_edit" method="post" action="{{ route('tambah_barang') }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_nama_barang">Nama Barang</label>
                            <input type="text" name="edit_nama_barang" id="edit_nama_barang" class="form-control" value="{{ old('nama_barang') }}">
                        </div>
                        <div class="form-group" id="form-tambah">
                            <label for="edit_deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="edit_deskripsi" name="edit_deskripsi" rows="3"
                                      placeholder="Masukkan deskripsi ...">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_unit">Unit</label>
                            <select name="edit_unit" id="edit_unit" class="form-control">
                                <option selected disabled>Pilih</option>
                                <option value="Pcs">Pcs</option>
                                <option value="Karton">Karton</option>
                                <option value="Kg">Kg</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_stok">Stok Awal</label>
                            <input type="text" name="edit_stok" id="edit_stok" class="form-control" value="{{ old('stok') }}">
                        </div>
                        <div class="form-group" id="form-tambah">
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
            var nama_barang = $(this).closest('td').find('#jq_nama').val();
            var deskripsi = $(this).closest('td').find('#jq_deskripsi').val();
            var unit = $(this).closest('td').find('#jq_unit').val();
            var stok = $(this).closest('td').find('#jq_stok').val();
            var keterangan = $(this).closest('td').find('#jq_keterangan').val();
            $('#edit_nama_barang').val(nama_barang);
            $('#edit_deskripsi').text(deskripsi);
            $('#edit_unit').val(unit);
            $('#edit_stok').val(stok);
            $('#edit_keterangan').text(keterangan);
            $('#form_edit').attr('action','/barang/edit/'+id);
        })
    })
</script>
@endsection