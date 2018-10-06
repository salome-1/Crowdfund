@extends('layouts.app')

@section('content')
<div class="container">
  <div class="jumbotron">
    <div class="row">
      <div class="col-sm">
        <img src="{{asset('storage/project_image/' . $projects->project_image)}}" alt="" width="150">
        <h1>{{$projects->title}}</h1>
        <p>{{$projects->description}}</p>
        <p>Project dimulai pada : {{$projects->opened_at}}</p>
        <p>Project ditutup pada : {{$projects->closed_at}}</p>
        <p>Dana yang dibutuhkan : {{$projects->project_price}}</p>
        <p>Slot yang tersedia : {{$projects->slot}}</p>
        <p>Jumlah uang per slot : {{$projects->slot_price}}</p>
        <!-- <p>dibuat oleh : {project-user-name}</p> -->

        <p><a href="/projects" class="btn btn-primary btg-lg">Kembali Ke List Project</a></p>


        {{-- admin --}}
        @if ($projects->isOwner())
          <p><a href="/projects/{{$projects->id}}/edit" class="btn btn-primary btg-lg">Edit Project</a></p>
          <form method="POST" action="/projects/{{$projects->id}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger">
                {{ __('Hapus Project') }}
            </button>
          </form>
        @endif
      </div>

      {{-- button for slots --}}
      <div class="col sm">
        <h1 class="text-center">Beli Slot</h1>
        @foreach ($slots as $slot)
          @if ($slot->status == 0)
            <a href="#" class="btn btn-primary btg-lg" style="margin:25px">{{$slot->price}}</a>          
          @else
            <p class="btn btn-light" style="margin:25px">Dibeli</p>
          @endif
            
        @endforeach
      </div>

    </div>
  </div>
</div>
@endsection