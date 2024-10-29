@extends('user.layout')

@php
    $symbol = $currencyInfo->base_currency_symbol;
@endphp
@section('styles')
    <style>
        .dis-none {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="page-header">
        <h4 class="page-title">{{ __('Add Cause') }}</h4>
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
                <a href="#">{{ __('Donation Management') }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.donation.index', ['language' => $defaultLang->code]) }}">{{ __('Cause') }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ __('Add Cause') }}</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block">{{ __('Add Cause') }}</div>
                    <a class="btn btn-info btn-sm float-right d-inline-block"
                        href="{{ route('user.donation.index', ['language' => $defaultLang->code]) }}">
                        <span class="btn-label">
                            <i class="fas fa-backward"></i>
                        </span>
                        {{ __('Back') }}
                    </a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="alert alert-danger pb-1 dis-none" id="causeErrors">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <ul></ul>
                            </div>

                            <form id="causeForm" action="{{ route('user.donation.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="col-12 mb-2">
                                                <label for="image"><strong>{{ __(' Image') . '*' }}</strong></label>
                                            </div>
                                            <div class="col-md-12 mb-3 showImage">
                                                <img src="{{ asset('assets/admin/img/noimage.jpg') }}" alt="..."
                                                    class="img-thumbnail">
                                            </div>
                                            <input type="file" name="image" id="image" class="form-control">
                                            <p class="text-warning mb-0">{{ __('JPG, PNG, JPEG, SVG images are allowed') }}
                                            </p>
                                            <p class="em text-danger mb-0" id="errimage"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">{{ __('Goal Amount') }} (
                                                {{ $symbol }})
                                                *</label>
                                            <input type="number" class="form-control ltr" name="goal_amount" value=""
                                                placeholder="Enter Amount">
                                            <p id="errgoal_amount" class="mb-0 text-danger em"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">{{ __('Minimum Amount') }}
                                                ( {{ $symbol }})
                                                *</label>
                                            <input type="number" class="form-control ltr" name="min_amount" value=""
                                                placeholder="Enter Amount">
                                            <small class="text-warning">{{ __('Minimum amount for this cause') }}</small>
                                            <p id="errmin_amount" class="mb-0 text-danger em"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">{{ __('Custom Amount') }}
                                                ({{ $symbol }})</label>
                                            <input type="text" class="form-control" name="custom_amount" value=""
                                                data-role="tagsinput">
                                            <small
                                                class="text-warning">{{ __('Use comma (,) to seperate the amounts.') }}</small><br>
                                            <small
                                                class="text-warning">{{ __('Custom amount must be equal to or greater than minimum amount') }}</small>
                                        </div>
                                    </div>
                                </div>

                                <div id="accordion" class="mt-3 custom-accordion">
                                    @foreach ($languages as $language)
                                        <div class="version mt-2">
                                            <div class="version-header" id="heading{{ $language->id }}">
                                                <h5 class="mb-0">
                                                    <button type="button" class="btn accordion-btn" data-toggle="collapse"
                                                        data-target="#collapse{{ $language->id }}"
                                                        aria-expanded="{{ $language->is_default == 1 ? 'true' : 'false' }}"
                                                        aria-controls="collapse{{ $language->id }}">
                                                        {{ $language->name . __(' Language') }}
                                                        {{ $language->is_default == 1 ? '(Default)' : '' }}
                                                        <span class="caret"></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapse{{ $language->id }}"
                                                class="collapse {{ $language->is_default == 1 ? 'show' : '' }} "
                                                aria-labelledby="heading{{ $language->id }}" data-parent="#accordion">
                                                <div class="version-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div
                                                                class="form-group {{ $language->rtl == 1 ? 'rtl text-right' : '' }}">
                                                                <label>{{ __('Title') . '*' }}</label>
                                                                <input type="text" class="form-control"
                                                                    name="{{ $language->code }}_title"
                                                                    placeholder="Enter Title">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div
                                                                class="form-group {{ $language->rtl == 1 ? 'rtl text-right' : '' }}">
                                                                <label for="">{{ __('Category') . '*' }}</label>
                                                                <select name="{{ $language->code }}_category_id"
                                                                    class="form-control">
                                                                    <option disabled selected>
                                                                        {{ __('Select a category') }}
                                                                    </option>
                                                                    @foreach ($language->donationCategories as $category)
                                                                        <option value="{{ $category->id }}">
                                                                            {{ $category->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col">
                                                            <div
                                                                class="form-group {{ $language->rtl == 1 ? 'rtl text-right' : '' }}">
                                                                <label>{{ __('Content') . '*' }}</label>
                                                                <textarea class="form-control summernote" name="{{ $language->code }}_content"
                                                                    placeholder="{{ __('Enter Cause Content') }}" data-height="300">
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div
                                                                class="form-group {{ $language->rtl == 1 ? 'rtl text-right' : '' }}">
                                                                <label>{{ __('Meta Keywords') }}</label>
                                                                <input class="form-control"
                                                                    name="{{ $language->code }}_meta_keywords"
                                                                    placeholder="{{ __('Enter Meta Keywords') }}"
                                                                    data-role="tagsinput">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div
                                                                class="form-group {{ $language->rtl == 1 ? 'rtl text-right' : '' }}">
                                                                <label>{{ __('Meta Description') }}</label>
                                                                <textarea class="form-control" name="{{ $language->code }}_meta_description" rows="5"
                                                                    placeholder="{{ __('Enter Meta Description') }}"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            @php $currLang = $language @endphp

                                                            @foreach ($languages as $language)
                                                                @continue($language->id == $currLang->id)

                                                                <div class="form-check py-0">
                                                                    <label class="form-check-label">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            onchange="cloneInput('collapse{{ $currLang->id }}', 'collapse{{ $language->id }}', event)">
                                                                        <span
                                                                            class="form-check-sign">{{ __('Clone for') }}
                                                                            <strong
                                                                                class="text-capitalize text-secondary">{{ $language->name }}</strong>
                                                                            {{ __('language') }}</span>
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" form="causeForm" class="btn btn-success">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/user/js/cause.js') }}"></script>
@endsection
