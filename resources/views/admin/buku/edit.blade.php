@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Buku</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('alert'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('alert') }}
                        </div>
                    @endif
                        <form action="{{ route('admin.buku.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$buku->id}}">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" value="{{$buku->judul}}" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="kode">Kode Buku</label>
                                <input type="text" class="form-control" id="kode" name="kode" value="{{$buku->kode}}" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="author_id">Author</label>
                                <select name="author_id" id="author_id" class="custom-select" required>
                                    <option value=""disbled selected>Pilih Author</option>
                                    @foreach($author as $b)
                                    <option value="{{$b->id}}" {{$b->id == $buku->author_id ? 'selected' : '' }}>{{$b->nama}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <label for="penerbit">Penerbit</label>
                                <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{$buku->penerbit}}" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="tahun_terbit">Tahun Terbit</label>
                                <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="{{$buku->tahun_terbit}}" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" value="{{$buku->stok}}" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <br>
                                <img src="{{url('gambar_buku/'.$buku->foto)}}" style="width:200px;height:200px">
                                <br>
                                <br>
                                <input type="file" class="form-control" id="foto" name="foto">
                            </div>
                            <button class="btn btn-warning" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

