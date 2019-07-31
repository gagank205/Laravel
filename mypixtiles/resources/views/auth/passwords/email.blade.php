@extends('layouts_backend.login.master')

@section('content')

<div class="m-login__forget-password animated flipInX">
     @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="m-login__head">
        <h3 class="m-login__title">Forgot Password</h3>
        <div class="m-login__desc">Enter your email to reset your password:</div>
    </div>
    <form method="POST" class="m-login__form m-form" id='frm_resetpassword' action="{{ route('password.email') }}">
        @csrf
        <div class="form-group m-form__group">
             <input id="email" type="email" class="form-control m-input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  placeholder="Enter email address">
        </div>
         @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert" style="display: block">
                @foreach ($errors->all() as $key=>$error)
                         {{ $error }}
                    @endforeach
            </span>
        @endif
        <div class="m-login__form-action">
            <button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primaryr">Send</button>&nbsp;&nbsp;
            <a href="{{ROUTE('login')}}" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">Back to login</a>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('js/ResetPassword.js')}}"></script>
@endpush