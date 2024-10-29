@extends('user.layout')

@section('content')
    <div class="page-header">
        <h4 class="page-title">{{  __('Booking Details') }}</h4>
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
                <a href="#">{{   __('Hotel Management') }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{   __('Room Bookings') }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{   __('Booking Details') }}</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block">
                        {{   __('Edit Booking Details') }}</div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <form id="bookingDetailsForm" action="{{ route('user.room_bookings.update_booking') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $details->id }}">

                                <input type="hidden" name="room_id" value="{{ $details->room_id }}">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{   __('Booking Number') }}</label>
                                            <input type="text" class="form-control"
                                                value="{{ '#' . $details->booking_number }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{   __('Booking Date') }}</label>
                                            <input type="text" class="form-control"
                                                value="{{ date_format($details->created_at, 'F d, Y') }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{   __('Customer Full Name') . '*' }}</label>
                                            <input type="text" class="form-control"
                                                placeholder="{{   __('Enter Full Name') }}"
                                                name="customer_name" value="{{ $details->customer_name }}">
                                            @error('customer_name')
                                                <p class="mt-1 mb-0 ml-1 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{   __('Customer Email') . '*' }}</label>
                                            <input type="email" class="form-control"
                                                placeholder="{{   __('Enter Customer Email') }}"
                                                name="customer_email" value="{{ $details->customer_email }}">
                                            @error('customer_email')
                                                <p class="mt-1 mb-0 ml-1 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{   __('Customer Phone Number') . '*' }}</label>
                                            <input type="text" class="form-control"
                                                placeholder="{{  __('Enter Phone Number') }}"
                                                name="customer_phone" value="{{ $details->customer_phone }}">
                                            @error('customer_phone')
                                                <p class="mt-1 mb-0 ml-1 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{   __('Room Name') }}</label>
                                            <input type="text" class="form-control" value="{{ $roomTitle }}"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{  __('Room Type') }}</label>
                                            <input type="text" class="form-control" value="{{ $roomCategoryName }}"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{   __('Check In / Out Date') . '*' }}</label>
                                            <input type="text" class="form-control"
                                                placeholder="{{ __('Select Dates') }}" id="date-range" name="dates"
                                                value="{{ $details->arrival_date . ' - ' . $details->departure_date }}"
                                                readonly>
                                            @error('dates')
                                                <p class="mt-1 mb-0 ml-1 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{  __('Number of Nights') . '*' }}</label>
                                            <input type="text" class="form-control"
                                                placeholder="{{ __('Number of Nights') }}" id="night" name="nights"
                                                value="{{ $interval->days }}" readonly>
                                            @error('nights')
                                                <p class="mt-1 mb-0 ml-1 text-danger">{{ $message }}</p>
                                            @enderror
                                            <p class="text-warning mt-1 mb-0 ml-1">
                                                {{ __('Number of nights will be calculated based on checkin & checkout date.') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{   __('Number of Guests') . '*' }}</label>
                                            <input type="number" class="form-control"
                                                placeholder="{{   __('Enter Number of Guests') }}"
                                                name="guests" value="{{ $details->guests }}">
                                            @error('guests')
                                                <p class="mt-1 mb-0 ml-1 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{   __('Subtotal') . ' (' . $details->currency_text . ')' }}</label>
                                            <input type="text" class="form-control" name="subtotal"
                                                value="{{ $details->subtotal }}" readonly id="subtotal">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{   __('Discount') . ' (' . $details->currency_text . ')' }}</label>
                                            <input type="text" class="form-control" name="discount"
                                                value="{{ $details->discount }}" id="discount"
                                                placeholder="{{   __('Enter Discount Amount') }}"
                                                oninput="applyDiscount()">
                                            <p class="text-warning mt-1 mb-0 ml-1">
                                                {{ __('Do not press \'Enter\' key.') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{   __('Total Rent') . ' (' . $details->currency_text . ')' }}</label>
                                            <input type="text" class="form-control" name="total"
                                                value="{{ $details->grand_total }}" readonly id="total">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{  __('Payment Method') . '*' }}</label>
                                            <select name="payment_method" class="form-control">
                                                <option disabled>
                                                    {{   __('Select a Method') }}
                                                </option>

                                                @if (count($onlineGateways) > 0)
                                                    @foreach ($onlineGateways as $onlineGateway)
                                                        <option
                                                            {{ $details->payment_method == $onlineGateway->name ? 'selected' : '' }}
                                                            value="{{ $onlineGateway->name }}">
                                                            {{ $onlineGateway->name }}
                                                        </option>
                                                    @endforeach
                                                @endif

                                                @if (count($offlineGateways) > 0)
                                                    @foreach ($offlineGateways as $offlineGateway)
                                                        <option
                                                            {{ $details->payment_method == $offlineGateway->name ? 'selected' : '' }}
                                                            value="{{ $offlineGateway->name }}">
                                                            {{ $offlineGateway->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('payment_method')
                                                <p class="mt-1 mb-0 ml-1 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{   __('Payment Status') . '*' }}</label>
                                            <select name="payment_status" class="form-control">
                                                <option disabled>{{ __('Select Payment Status') }}</option>
                                                <option {{ $details->payment_status == 1 ? 'selected' : '' }}
                                                    value="1">
                                                    {{   __('Paid') }}
                                                </option>
                                                <option {{ $details->payment_status == 0 ? 'selected' : '' }}
                                                    value="0">
                                                    {{   __('Unpaid') }}
                                                </option>
                                            </select>
                                            @error('payment_status')
                                                <p class="mt-1 mb-0 ml-1 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" form="bookingDetailsForm" class="btn btn-success">
                                {{  __('Update') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        'use strict';

        // assign php value to js variable
        let bookedDates = {!! json_encode($bookedDates) !!};
        let roomRentPerNight = '{{ $rent }}';
    </script>

    <script type="text/javascript" src="{{ asset('assets/admin/js/admin-room.js') }}"></script>
@endsection
