@extends('layouts_backend.masters',['title'=>'Change Password'])
@section('content')
<div class="m-subheader ">

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">Profile Management</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{ROUTE('dashboard')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>               
                <li class="m-nav__item">
                    <span class="m-nav__link-text">Change Password</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="m-content">
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Change Password
                            </h3>
                        </div>
                    </div>
                    <div class="pull-right back-btn">
                        <a href="{{url('dashborad')}}"><button type="button" class="btn btn-primary">Back</button></a>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post" 
                action="{{ url('changePassword/store')}}" name="changepassword_form" id="changepassword_form">
                    @csrf
                    <input type="hidden" name="ajax_route" id='ajax_route' value="{{ROUTE('changePassword')}}">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">                                                      
                            <div class="col-lg-6">
                                <label>Current Password:</label>
                                <input type="password" class="form-control m-input" name="current_password" placeholder="Enter current password" id="current-password" max='25'>
                                <span class="m-form__help error current_password"></span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">                                                      
                            <div class="col-lg-6">
                                <label>New Password:</label>
                                <input type="password" class="form-control m-input" name="password" placeholder="Enter new password" id="new-password" max='25'>
                                <span class="m-form__help error password"></span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">                                                      
                            <div class="col-lg-6">
                                <label>Confirm New Password:</label>
                                <input type="password" class="form-control m-input" name="password_confirmation" placeholder="Enter confirm new password" id="current-password" max='25'>
                                <span class="m-form__help error password_confirmation"></span>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="submit" name="city_submit" id="city_submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('dashboard')}}">
                                    <button type="button" class="btn btn-secondary">Cancel</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
            <!--end::Portlet-->
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('js/ChangePasswordFormValidation.js')}}"></script>
@endpush