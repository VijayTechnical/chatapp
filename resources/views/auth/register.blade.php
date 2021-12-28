@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <img src="{{ asset('form/register.jpg') }}" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-4">
                                <div class="row mt-5 text-center">
                                    <div class="col-md-12 relative">
                                        <img src="{{ asset('form/logo.svg') }}" alt="">
                                        <div class="absolute mt-2" style="height: 5px;width:60px;background:blue;margin-left:42%;"></div>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="row mb-1 px-2">
                                        <label for="name"
                                            class="col-md-12 col-form-label">{{ __('Name') }}</label>

                                        <div class="col-md-12">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-1 px-2">
                                        <label for="email"
                                            class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-12">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-1 px-2">
                                        <label for="password"
                                            class="col-md-12 col-form-label">{{ __('Password') }}</label>

                                        <div class="col-md-12">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-1 px-2">
                                        <label for="password-confirm"
                                            class="col-md-12 col-form-label">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-12">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="d-flex mt-4 align-items-center flex-row" style="justify-content: space-between;margin:5px;">
                                        <div class="pr-2">
                                            <a href="{{ route('login') }}">Back to login</a>
                                        </div>
                                        <div class="mr-2">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
