@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('msg'))
      <div class="alert alert-succes">
        <p> {{ session('msg')}}</p>
      </div>
    @endif
</div>
@endsection
