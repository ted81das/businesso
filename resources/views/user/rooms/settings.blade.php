@extends('user.layout')

@section('content')
    <div class="page-header">
        <h4 class="page-title">{{ __('Settings') }}</h4>
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
                <a href="#">{{ __('Hotel Management') }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ __('Settings') }}</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title">{{ __('Room Settings') }}</div>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-5 pb-5">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <form id="ajaxForm" action="{{ route('user.rooms_management.update_settings') }}"
                                method="post">
                                @csrf

                                <div class="form-group">
                                    <label>{{ __('Rooms') . '*' }}</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="is_room" value="1" class="selectgroup-input"
                                                {{ $data->is_room == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>

                                        <label class="selectgroup-item">
                                            <input type="radio" name="is_room" value="0" class="selectgroup-input"
                                                {{ $data->is_room == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                    <p id="err_is_room" class="mb-0 text-danger em"></p>

                                    <p class="text-warning mt-2 mb-0">
                                        {{ __('If it is deactive the customer will not see any room booking information on his dashboard.') }}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Category Status') . '*' }}</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="room_category_status" value="1"
                                                class="selectgroup-input"
                                                {{ $data->room_category_status == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>

                                        <label class="selectgroup-item">
                                            <input type="radio" name="room_category_status" value="0"
                                                class="selectgroup-input"
                                                {{ $data->room_category_status == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                    <p id="err_room_category_status" class="mb-0 text-danger em"></p>

                                    <p class="text-warning mt-2 mb-0">
                                        {{ __('Specify whether the category for room will be active or not.') }}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Rating Status*') }}</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="room_rating_status" value="1"
                                                class="selectgroup-input"
                                                {{ $data->room_rating_status == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>

                                        <label class="selectgroup-item">
                                            <input type="radio" name="room_rating_status" value="0"
                                                class="selectgroup-input"
                                                {{ $data->room_rating_status == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                    <p id="err_room_rating_status" class="mb-0 text-danger em"></p>

                                    <p class="text-warning mt-2 mb-0">
                                        {{ __('Specify whether the rating system for room will be active or not.') }}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Guest Checkout Status*') }}</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="room_guest_checkout_status" value="1"
                                                class="selectgroup-input"
                                                {{ $data->room_guest_checkout_status == 1 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Active') }}</span>
                                        </label>

                                        <label class="selectgroup-item">
                                            <input type="radio" name="room_guest_checkout_status" value="0"
                                                class="selectgroup-input"
                                                {{ $data->room_guest_checkout_status == 0 ? 'checked' : '' }}>
                                            <span class="selectgroup-button">{{ __('Deactive') }}</span>
                                        </label>
                                    </div>
                                    <p id="err_room_guest_checkout_status" class="mb-0 text-danger em"></p>

                                    <p class="text-warning mt-2 mb-0">
                                        {{ __('If guest checkout is active, then users can checkout without login.') }}
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" id="submitBtn" class="btn btn-success">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
