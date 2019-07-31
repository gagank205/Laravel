@extends('layouts_backend.login.master')
@section('content')
<div class="m-login__signin animated flipInX">
    <div class="m-login__head">
        <h3 class="m-login__title">Admin Login</h3>
    </div>
    <form method="POST"  class="m-login__form m-form" action="{{ route('login') }}">                                   
         @csrf
        <div class="form-group m-form__group">
            <input id="email" type="email" name='email' class="form-control m-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter email address" required autofocus >
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif                    
        </div>
        <div class="form-group m-form__group">
            <input id="password" type="password" name='password' class="form-control m-input m-login__form-input--last{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" 
            required placeholder="Enter password">  
            @if ($errors->has('password'))
                <span class="invalid-feedback" id="error_msg_css" role="alert">
                    {{ $errors->first('password') }}
                </span>
            @endif                           
        </div>
        <div class="row m-login__form-sub">
            <div class="col m--align-left m-login__form-left">
                <label class="m-checkbox  m-checkbox--focus">
                    <input type="checkbox" name="remember"> Remember me
                    <span></span>
                </label>
            </div>
            <div class="col m--align-right m-login__form-right">
                <a href="{{ROUTE('password.request')}}" id="m_login_forget_password_" class="m-link">Forgot Password ?</a>
                
            </div>
        </div>
        <div class="m-login__form-action">
             <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
            {{ __('Login') }}
        </button>                                    
        </div>
    </form>
</div>
                        
@endsection