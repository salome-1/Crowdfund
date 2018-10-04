@extends('layouts.app')

@section('content')
<div class="container">

    {{-- @if (session('msg'))
      <div class="alert alert-succes">
        <p> {{ session('msg')}}</p>
      </div>
    @endif --}}
    <div class="table-responsive">


      <table class="table table-striped" border="solid">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Nama User</td>
            <th scope="col">Nama Bank User</td>
            <th scope="col">Atas Nama</td>
            <th scope="col">Nominal</td>
            <th scope="col">Bukti Foto</td>
            <th scope="col">Status</td>
            <th scope="col">Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($topups as $topup)
          <tr>
            <td>{{ $topup->username }}</td>
            <td>{{ $topup->bank }}</td>
            <td>{{ $topup->user_name }}</td>
            <td>{{ $topup->nominal }}</td>
            <td><img src="{{asset('storage/proof_image/' . $topup->proof_image)}}" alt="" width="50"></td>
            <td>
            @if( $topup->status == 0 )
            <span class="label label-primary">Pending</span>
            @elseif( $topup->status == 1 )
            <span class="label label-success">Approved</span>
            @elseif( $topup->status == 2 )
            <span class="label label-danger">Rejected</span>
            @endif
            </td>
            <td><a href="{{action('TopupController@edit', $topup->id)}}" class="btn btn-warning">Action</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection
