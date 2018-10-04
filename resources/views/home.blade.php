@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Hi {{ Auth::user()->username }} You are logged in!</br>
                    Email : {{ Auth::user()->email }}</br></br>
                    
                    @if (auth()->user()->isAdmin())
                    <a href="{{ url('/admin') }}">Ke Page Admin</a></br></br>
                    <a href="{{ url('/projects/create') }}">Buat Project Baru</a></br></br>
                    <a href="{{ url('/users') }}">Lihat List User</a></br></br>
                    <a href="{{ url('/topups') }}">Approve User Top Up</a></br></br>
                    @else
                    <a href="{{ url('/topups/create') }}">Isi Saldo</a></br></br>
                    @endif
                    <a href="{{ url('/projects') }}">Lihat Project yang tersedia</a></br></br>
                    <a href="{{ url('/transaksi') }}">Lihat history transaksi</a></br></br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
