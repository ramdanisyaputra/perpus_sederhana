@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Password</div>

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
                        <form action="{{ route('non_admin.ganti_password.ganti_password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="current_password">Password Lama</label>
                                <input class="form-control" type="password" name="current_password" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">Password Baru</label>
                                <input class="form-control" type="password" name="new_password" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password_confirmation">Komfirmasi Password</label>
                                <input class="form-control" type="password" name="new_password_confirmation" required>
                                
                            </div>
                            <button class="btn btn-success" type="submit">Ganti Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

