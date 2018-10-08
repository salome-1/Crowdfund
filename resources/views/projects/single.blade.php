@extends('layouts.app')

@section('content')
<div class="container">
  <div class="jumbotron">
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


        {{-- admin --}}
        @if ($project->isOwner())
          <p><a href="/projects/{{$project->id}}/edit" class="btn btn-primary btg-lg">Edit Project</a></p>
          <form method="POST" action="/projects/{{$project->id}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger">
                {{ __('Hapus Project') }}
            </button>
          </form>
        @endif
      </div>

      {{-- button for slots --}}
      @if (Auth::user())
        <div class="col sm">
          <h1 class="text-center">Beli Slot</h1>
          @foreach ($slots as $slot)
            @if ($slot->status == 0)
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-slotid="{{$slot->id}}" data-userid="{{Auth::user()->id}}" style="margin:10px">{{$slot->price}}</button>
              @include('slots.formBuySlot')
            @else
              <p class="btn btn-light">Telah Dibeli</p>
            @endif
          @endforeach
        </div>
      @endif
      
    </div>
  </div>
</div>
@endsection