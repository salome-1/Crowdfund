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

  @if (session('msg'))
    <div class="alert alert-succes">
      <p> {{ session('msg')}}</p>
    </div>
  @endif

    <form method="POST" action="/topups" enctype="multipart/form-data">
    
    <div class="form-group row">
        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Nama Anda') }}</label>

        <div class="col-md-6">
            
            <textarea placeholder="" class="form-control" id="username" name="username" rows="1" readonly="">{{$user->username}}</textarea>

            @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Atas Nama') }}</label>

        <div class="col-md-6">
            <input id="user_name" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('user_name') }}" required>

            @if ($errors->has('user_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('user_name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="nominal" class="col-md-4 col-form-label text-md-right">{{ __('Masukkan nominal saldo untuk Top Up') }}</label>

        <div class="col-md-6">
            <input id="nominal" type="number" class="form-control{{ $errors->has('nominal') ? ' is-invalid' : '' }}" name="nominal" value="{{ old('nominal') }}" required>

            @if ($errors->has('nominal'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nominal') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="bank" class="col-md-4 col-form-label text-md-right">{{ __('Bank yang anda gunakan') }}</label>

        <div class="col-md-6">
            <input id="bank" type="text" class="form-control{{ $errors->has('bank') ? ' is-invalid' : '' }}" name="bank" value="{{ old('bank') }}" required>

            @if ($errors->has('bank'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('bank') }}</strong>
                </span>
            @endif
        </div>
    </div>

     <!-- Featured Image -->
     <div class="form-group row">
          <label for="proof_image" class="col-md-4 col-form-label text-md-right">{{ __('Submit Bukti') }}</label>

          <div class="col-md-6">
              <input id="proof_image" type="file" class="form-control{{ $errors->has('proof_image') ? ' is-invalid' : '' }}" name="proof_image" value="{{ old('proof_image') }}" required>

              @if ($errors->has('proof_image'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('proof_image') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right"></label>

          <div class="col-md-6 captcha">
              <span>{!! captcha_img() !!}</span>
              <!-- <button type="button" class="btn btn-success btn-refresh">Refresh</button> -->
          </div>

          <div class="col-md-6 offset-md-4">
              <input type="text" id="captcha" class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}" placeholder="Masukkan Captcha" name ="captcha" required>
          </div>
              @if ($errors->has('captcha'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('captcha') }}</strong>
                  </span>
              @endif
      </div>

    {{ csrf_field() }}

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('TOP UP') }}
            </button>

            <a class="btn btn-light" href="/home">
                {{ __('Batal') }}
            </a>
        </div>
    </div>
  </form>

</div>
@endsection
