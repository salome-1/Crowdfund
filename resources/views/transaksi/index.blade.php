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
					@if ($transaction->topup_id != null)
						<tr>
							<td scope="col">{{$transaction->created_at}}</td>
							<td scope="col">{{ $transaction->nominal }}</td>
							<td><img src="{{asset('storage/proof_image/' . $transaction->transaction_image)}}" alt="" width="50"></td>
							<td scope="col"> {{$transaction->deposit}} </td>
							<td scope="col"> {{$transaction->credit}} </td>
							<td scope="col"> {{$transaction->status}} </td>
						</tr>
					@endif		
				@endforeach
			</tbody>
		</table>
	</div>
	<br>
	<br>
	<br>
	<hr>
	<h1>Slot</h1>
	
	<div class="table-responsive">
		<table class="table table-striped" border="solid">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Tanggal Beli</th>
					<th scope="col">Nominal Slot</th>
					<th scope="col">Project</th>	
					<th scope="col">Deposit</th>
					<th scope="col">Kredit</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			
			<tbody>
				@foreach($transactions as $transaction)
					@if ($transaction->slot_id != null)
						<tr>
							<td scope="col">{{$transaction->created_at}}</td>
							<td scope="col">{{ $transaction->nominal }}</td>
							<td scope="col">{{ $transaction->project_name }}</td>
							<td scope="col"> {{$transaction->deposit}} </td>
							<td scope="col"> {{$transaction->credit}} </td>
							<td scope="col"> {{$transaction->status}} </td>
						</tr>
					@endif			
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
