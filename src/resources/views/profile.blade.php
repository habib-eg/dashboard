@extends('dashboard::layouts.layout')
@push('header')
    <!-- Header -->
    <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url({{asset('vendor/dashboard/img/theme/profile-cover.jpg')}}); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">@lang('dashboard::dashboard.hello') {{adminGuard()->user()->name}}</h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
            <button type="button" onclick="profileUserUpdate.submit()" class="btn btn-neutral">@lang('dashboard::dashboard.edit_profile')</button>
          </div>
        </div>
      </div>
    </div>
@endpush
@section('content')
    <!-- Page content -->
    <div class="row">
        <div class="col-xl-4 order-xl-2">
            <div class="card card-profile">
                <img src="{{asset('vendor/dashboard/img/theme/img-1-1000x600.jpg')}}" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="{{asset('vendor/dashboard/img/theme/team-4.jpg')}}" class="rounded-circle">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-sm btn-info  mr-4 ">Connect</a>
                        <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center">
                                <div>
                                    <span class="heading">22</span>
                                    <span class="description">Friends</span>
                                </div>
                                <div>
                                    <span class="heading">10</span>
                                    <span class="description">Photos</span>
                                </div>
                                <div>
                                    <span class="heading">89</span>
                                    <span class="description">Comments</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h5 class="h3">
                            Jessica Jones<span class="font-weight-light">, 27</span>
                        </h5>
                        <div class="h5 font-weight-300">
                            <i class="ni location_pin mr-2"></i>Bucharest, Romania
                        </div>
                        <div class="h5 mt-4">
                            <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                        </div>
                        <div>
                            <i class="ni education_hat mr-2"></i>University of Computer Science
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">@lang('dashboard::dashboard.edit_profile') </h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="#!" class="btn btn-sm btn-primary">@lang('dashboard::dashboard.settings')</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('dashboard.update_profile',adminGuard()->user())}}" name="profileUserUpdate">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">@lang('dashboard::dashboard.user_information')</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">@lang('dashboard::dashboard.name')</label>
                                        <input type="text" id="input-name" name="name"  class="form-control" placeholder="name" value="{{adminGuard()->user()->name}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">@lang('dashboard::dashboard.email')</label>
                                        <input type="email" id="input-email" class="form-control" value="{{adminGuard()->user()->email}}" placeholder="{{adminGuard()->user()->email}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


