@extends('layouts.app')

@section('content')
<div class="container">
  @if (session('msg'))
      <div class="alert alert-succes">
        <p> {{ session('msg')}}</p>
      </div>
    @endif
  <div class="jumbotron">
    <h1 class="text-center">Halaman Bagi Profit</h1>
    <br><br>
    <div class="row">
      <div class="col-sm">
        <img src="{{asset('storage/project_image/' . $project->project_image)}}" alt="" width="150">
        <h1>{{$project->title}}</h1>
        <p>{{$project->description}}</p>
        <p>Project dimulai pada : {{$project->opened_at}}</p>
        <p>Project ditutup pada : {{$project->closed_at}}</p>
        <p>Dana yang dibutuhkan : {{$project->project_price}}</p>
        <p>Slot yang tersedia : {{$project->slot}}</p>
        <p>Jumlah uang per slot : {{$project->slot_price}}</p>
        <!-- <p>dibuat oleh : {project-user-name}</p> -->

        <p><a href="/projects" class="btn btn-primary btg-lg">Kembali Ke List Project</a></p>

        <p><a href="/projects/{{ $project->slug }}" class="btn btn-primary">lihat halaman slot</a></p>
      </div>

      {{-- button for slots --}}
      <div class="col sm">
        <h1 class="text-center">Bagi Profit</h1>
      <form method="POST" action="/profit/{{$project->slug}}" enctype="multipart/form-data">

        <div class="form-group row">
            <label for="nominal" class="col-md-4 col-form-label text-md-right">{{ __('nominal') }}</label>

            <div class="col-md-6">
                <input id="nominal" type="number" class="form-control{{ $errors->has('nominal') ? ' is-invalid' : '' }}" name="nominal" value="{{ old('nominal') }}" required>

                @if ($errors->has('nominal'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nominal') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        @csrf


        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Bagi Profit') }}
                </button>
            </div>
        </div>
      </form>
    </div>
      
    </div>
  </div>
</div>
@endsection