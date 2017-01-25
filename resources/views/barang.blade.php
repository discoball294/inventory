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

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar Barang</h3>
                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <button class="btn btn-success"><i class="fa fa-plus"></i> Tambah Barang </button>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody><tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Deskripsi</th>
                        <th>Unit</th>
                        <th>Stok</th>
                        <th>Keterangan</th>
                    </tr>
                    @foreach($barang as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->stok }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                    @endforeach
                    </tbody></table>
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
@endsection