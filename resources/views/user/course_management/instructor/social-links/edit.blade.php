@extends('user.layout')

@section('content')
    <div class="page-header">
        <h4 class="page-title">{{   __('Social Links') }}</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ route('user-dashboard') }}">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{   __('Instructors') }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ $instructor->name }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{   __('Edit Social Links') }}</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form id="ajaxEditForm"
                    action="{{ route('user.instructor.update_social_link', ['id' => $socialLink->id]) }}" method="post">

                    @csrf
                    <div class="card-header">
                        <div class="card-title d-inline-block">
                            {{  __('Edit Social Link') }}
                        </div>
                        <a class="btn btn-info btn-sm float-right d-inline-block"
                            href="{{ route('user.instructor.social_links', ['id' => $instructor->id]) }}">
                            <span class="btn-label">
                                <i class="fas fa-backward"></i>
                            </span>
                            {{   __('Back') }}
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                <div class="form-group">
                                    <label for="">{{   __('Social Icon') }} **</label>
                                    <div class="btn-group d-block">
                                        <button type="button" class="btn btn-primary iconpicker-component"><i
                                                class="{{ $socialLink->icon }}"></i></button>
                                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="fa-car" data-toggle="dropdown">
                                        </button>
                                        <div class="dropdown-menu"></div>
                                    </div>
                                    <input id="inputIcon" type="hidden" name="icon" value="{{ $socialLink->icon }}">
                                    <p class="mt-2 mb-0 text-danger" id="editErr_icon"></p>
                                    <div class="mt-2">
                                        <small>{{ __('NB: click on the dropdown icon to select a social link icon.') }}</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">{{  __('URL') . '*' }}</label>
                                    <input type="text" class="form-control" name="url"
                                        value="{{ $socialLink->url }}"
                                        placeholder="{{   __('Enter URL of Social Media Account') }}">
                                    <p class="mt-2 mb-0 text-danger" id="editErr_url"></p>
                                </div>

                                <div class="form-group">
                                    <label
                                        for="">{{  __('Serial Number') . '*' }}</label>
                                    <input type="number" class="form-control" name="serial_number"
                                        value="{{ $socialLink->serial_number }}"
                                        placeholder="{{   __('Enter Serial Number') }}">
                                    <p class="mt-2 mb-0 text-danger" id="editErr_serial_number"></p>
                                    <p class="text-warning mt-2 mb-0">
                                        <small>{{ __('The higher the serial number is, the later the social link will be shown.') }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer pt-3">
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success" id="updateBtn">
                                    {{   __('Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
