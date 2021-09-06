@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Author</div>

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

                    <button class="btn btn-primary" data-toggle="modal" data-target="#kelolaAuthor">Tambah</button>

                    <div class="table-responsive py-4">
                        <table class="table table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Telp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($author as $key => $a)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$a->nama}}</td>
                                    <td>{{$a->tanggal_lahir}}</td>
                                    <td>{{$a->alamat}}</td>
                                    <td>{{$a->telp}}</td>
                                    <td>
                                        <a href="{{ route('admin.author.edit',$a->id) }}" class="btn btn-warning">Edit</a>
                                        <a href="{{ route('admin.author.hapus',$a->id) }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus author ini? Bila menghapus maka buku author ini juga akan terhapus.')">Hapus</a>
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


<div class="modal fade" id="kelolaAuthor" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.author.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{old('nama')}}" required>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{old('tanggal_lahir')}}" required>
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{old('alamat')}}" required>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telp">Nomor Telfon</label>
                        <input type="number" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" value="{{old('telp')}}" required>
                        @error('telp')
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

