@extends('layouts.member.master')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Profil Member</h1>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('member.profile.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $member->nama }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $member->telepon }}">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informasi Akun</h5>
                    <p class="card-text">Email: {{ Auth::user()->email }}</p>
                    <p class="card-text">Member sejak: {{ $member->created_at->format('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection