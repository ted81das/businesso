@extends('user.layout')

@php
    $userDefaultLang = \App\Models\User\Language::where([
        ['user_id',\Illuminate\Support\Facades\Auth::id()],
        ['is_default',1]
    ])->first();
    $userLanguages = \App\Models\User\Language::where('user_id',\Illuminate\Support\Facades\Auth::id())->get();
@endphp

@includeIf('user.partials.rtl-style')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Slider Version') }}</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('admin.dashboard')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Home Page') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Hero Section') }}</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Slider Version') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block">{{ __('Sliders') }}</div>
            </div>

            <div class="col-lg-3">
                @if(!is_null($userDefaultLang))
                    @if (!empty($userLanguages))
                        <select name="userLanguage" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>{{__('Select a Language')}}</option>
                            @foreach ($userLanguages as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    @endif
                @endif
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a
                href="{{ route('user.home_page.hero.create_slider')}}"
                class="btn btn-primary btn-sm float-lg-right float-left"
              ><i class="fas fa-plus"></i> {{ __('Add Slider') }}</a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              @if (count($sliders) == 0)
                <h3 class="text-center">{{ __('NO SLIDER FOUND!') }}</h3>
              @else
                <div class="row">
                  @foreach ($sliders as $slider)
                    <div class="col-md-3">
                      <div class="card">
                        <div class="card-body">
                          <img
                            src="{{ asset('assets/front/img/hero_slider/' . $slider->img) }}"
                            alt="image" class="w-100"
                          >
                        </div>

                        <div class="card-footer text-center">
                          <a
                            class="btn btn-secondary btn-sm mr-2"
                            href="{{ route('user.home_page.hero.edit_slider', $slider->id) . '?language=' . request()->input('language') }}"
                          >
                            <span class="btn-label">
                              <i class="fas fa-edit"></i>
                            </span>
                            {{ __('Edit') }}
                          </a>

                          <form
                            class="deleteform d-inline-block"
                            action="{{ route('user.home_page.hero.delete_slider') }}"
                            method="post"
                          >
                            @csrf
                            <input type="hidden" name="slider_id" value="{{ $slider->id }}">
                            <button type="submit" class="btn btn-danger btn-sm deletebtn">
                              <span class="btn-label">
                                <i class="fas fa-trash"></i>
                              </span>
                              {{ __('Delete') }}
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
