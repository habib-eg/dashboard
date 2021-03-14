@extends('dashboard::layouts.layout')

@push('header')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">@lang('dashboard::dashboard.dashboard')</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{action([\Habib\Dashboard\Http\Controllers\DashboardController::class,'home'])}}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('dashboard::dashboard.contacts')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">@lang('dashboard::dashboard.contacts')</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">#</th>
                            <th scope="col" class="sort" data-sort="budget">@lang('dashboard::dashboard.name')</th>
                            <th scope="col" class="sort" data-sort="status">@lang('dashboard::dashboard.email')</th>
                            <th scope="col" class="sort" data-sort="status">@lang('dashboard::dashboard.phone')</th>
                            <th scope="col">@lang('dashboard::dashboard.message')</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach ($contacts as $contact)
                            <tr>
                                <th scope="row">
                                    {{$loop->index}}
                                </th>
                                <td class="budget">
                                    {{$contact->name}}
                                </td>
                                <td>
                                    {{$contact->email}}
                                </td>
                                <td>
                                    {{$client->phone}}
                                </td>
                                <td>
                                    {{$client->message}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- Card footer -->
                <div class="card-footer py-4">
                    {{$contacts->withQueryString()->links()}}
                </div>
            </div>
        </div>
    </div>

@stop
