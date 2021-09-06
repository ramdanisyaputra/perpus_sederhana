@extends('layouts.non_admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Buku</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('alert'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('alert') }}
                        </div>
                    @endif

                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaNonAdmin">Tambah</button>

                    <div class="table-responsive py-4">
                        <table class="table table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Judul</th>
                                    <th>Author</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Stok</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($buku as $key => $a)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$a->kode}}</td>
                                    <td>{{$a->judul}}</td>
                                    <td>{{$a->author->nama}}</td>
                                    <td>{{$a->penerbit}}</td>
                                    <td>{{$a->tahun_terbit}}</td>
                                    <td>{{$a->stok}}</td>
                                    <td><img src="{{url('gambar_buku/'.$a->foto)}}" style="width:100px;height:100px"></td>
                                    <td>
                                        <a href="{{ route('non_admin.buku.edit',$a->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('non_admin.buku.hapus',$a->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ?')">Hapus</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="4">Data belum dimasukkan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="kelolaNonAdmin" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('non_admin.buku.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{old('judul')}}" required>
                        @error('judul')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kode">Kode Buku</label>
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" value="{{old('kode')}}" required>
                        @error('kode')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="author_id">Author</label>
                        <select name="author_id" id="author_id" class="custom-select" required>
                            <option value=""disbled selected>Pilih Author</option>
                            @foreach($author as $b)
                            <option value="{{$b->id}}">{{$b->nama}}</option>
                            @endforeach
                        </select>
                        @error('author_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" name="penerbit" value="{{old('penerbit')}}" required>
                        @error('penerbit')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit</label>
                        <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit" name="tahun_terbit" value="{{old('tahun_terbit')}}" required>
                        @error('tahun_terbit')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{old('stok')}}" required>
                        @error('stok')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" value="{{old('foto')}}" required>
                        @error('foto')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

