@extends('layouts.app')

@section('content')
<div class="container">

    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li> {{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="/projects" enctype="multipart/form-data">

      <div class="form-group row">
          <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Judul Proyek') }}</label>

          <div class="col-md-6">
              <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required>

              @if ($errors->has('title'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('title') }}</strong>
                  </span>
              @endif
          </div>
      </div>


      <div class="form-group row">
          <label for="opened_at" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal dibuka project') }}</label>

          <div class="col-md-6">
              <input id="opened_at" type="date" class="form-control{{ $errors->has('opened_at') ? ' is-invalid' : '' }}" name="opened_at" value="{{ old('opened_at') }}" required>

              @if ($errors->has('opened_at'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('opened_at') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group row">
          <label for="closed_at" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal ditutup project') }}</label>

          <div class="col-md-6">
              <input id="closed_at" type="date" class="form-control{{ $errors->has('closed_at') ? ' is-invalid' : '' }}" name="closed_at" value="{{ old('closed_at') }}" required>

              @if ($errors->has('closed_at'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('closed_at') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group row">
          <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Deskripsi Project') }}</label>

          <div class="col-md-6">
              <textarea rows="4" cols="50" style="resize:none" id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required></textarea>
              @if ($errors->has('description'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('description') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group row">
          <label for="project_price" class="col-md-4 col-form-label text-md-right">{{ __('Dana yang Dibutuhkan') }}</label>

          <div class="col-md-6">
              <input id="project_price" type="number" class="form-control{{ $errors->has('project_price') ? ' is-invalid' : '' }}" name="project_price" value="{{ old('project_price') }}" required>

              @if ($errors->has('project_price'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('project_price') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group row">
          <label for="slot" class="col-md-4 col-form-label text-md-right">{{ __('Banyak Slot') }}</label>

          <div class="col-md-6">
              <input id="slot" type="number" class="form-control{{ $errors->has('slot') ? ' is-invalid' : '' }}" name="slot" value="{{ old('slot') }}" required>

              @if ($errors->has('slot'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('slot') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <!-- Featured Image -->
      <div class="form-group row">
          <label for="project_image" class="col-md-4 col-form-label text-md-right">{{ __('Submit Gambar') }}</label>

          <div class="col-md-6">
              <input id="project_image" type="file" class="form-control{{ $errors->has('project_image') ? ' is-invalid' : '' }}" name="project_image" value="{{ old('project_image') }}" required>

              @if ($errors->has('project_image'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('project_image') }}</strong>
                  </span>
              @endif
          </div>
      </div>


      {{ csrf_field() }}


      <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                  {{ __('Buat Project') }}
              </button>

              <a class="btn btn-light" href="/home">
                  {{ __('Kembali') }}
              </a>
          </div>
      </div>

    </form>
</div>
@endsection
