@extends('layouts.app')

@section('content')
<div class="container">
	<h1>Top Up</h1>

	<div class="table-responsive">
		<table class="table table-striped" border="solid">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Tanggal Top Up</th>
					<th scope="col">Nominal Top Up</th>
					<th scope="col">Bukti Foto</th>
					<th scope="col">Deposit</th>
					<th scope="col">Kredit</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			
			<tbody>
				@foreach($transactions as $transaction)
					<tr>
						<td scope="col">{{$transaction->created_at}}</th>
						<td scope="col">{{ $transaction->nominal }}</th>
						<td><img src="{{asset('storage/proof_image/' . $transaction->transaction_image)}}" alt="" width="50"></td>
						<td scope="col"> {{$transaction->deposit}} </td>
						<td scope="col"> {{$transaction->credit}} </td>
						<td scope="col"> {{$transaction->status}} </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
