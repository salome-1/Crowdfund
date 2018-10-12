@extends('layouts.app')

@section('content')
<div class="container">

	@if (session('msg'))
      <div class="alert alert-succes">
        <p> {{ session('msg')}}</p>
      </div>
    @endif
    
	<h1>Top Up</h1>
	<div class="table-responsive">
		<table class="table table-striped" border="solid">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Waktu Top Up</th>
					<th scope="col">Nominal Top Up</th>
					<th scope="col">Bukti Foto</th>
					<th scope="col">Saldo Bertmbah</th>
					<th scope="col">Saldo Berkurang</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			
			<tbody>					
				@foreach($transactions as $transaction)
					@if ($transaction->transaction_type == 1)
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
					<th scope="col">Saldo Bertmbah</th>
					<th scope="col">Saldo Berkurang</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			
			<tbody>
				@foreach($transactions as $transaction)
					@if ($transaction->transaction_type == 2)
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

	<br>
	<br>
	<br>
	<hr>
	<h1>Profit</h1>
	
	<div class="table-responsive">
		<table class="table table-striped" border="solid">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Tanggal Dibagikan</th>
					<th scope="col">Nominal Profit</th>
					<th scope="col">Project</th>	
					<th scope="col">Saldo Bertmbah</th>
					<th scope="col">Saldo Berkurang</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			
			<tbody>
				@foreach($transactions as $transaction)
					@if ($transaction->transaction_type == 3)
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
