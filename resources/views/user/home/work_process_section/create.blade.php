@extends('user.layout')

{{-- this style will be applied when the direction of language is right-to-left --}}
@includeIf('user.partials.rtl-style')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Add Work Process') }}</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('user-dashboard')}}">
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
        <a href="#">{{ __('Add Work Process') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-10">
              <div class="card-title">{{ __('Create New Work Process') }}</div>
            </div>

            <div class="col-lg-2">
              <a
                class="btn btn-info btn-sm float-right d-inline-block"
                href="{{ route('user.home_page.work_process_section') . '?language=' . request()->input('language') }}"
              >
                <span class="btn-label">
                  <i class="fas fa-backward"></i>
                </span>
                {{ __('Back') }}
              </a>
            </div>
          </div>
        </div>

        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form
                id="addSkillForm"
                action="{{ route('user.home_page.work_process_section.store_work_process', ['language' => request()->input('language')]) }}"
                method="POST"
                enctype="multipart/form-data"
              >
                @csrf
                  <div class="form-group">
                      <label for="">Icon **</label>
                      <div class="btn-group d-block">
                          <button type="button" class="btn btn-primary iconpicker-component"><i
                                  class="fa fa-fw fa-heart"></i></button>
                          <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                  data-selected="fa-car" data-toggle="dropdown">
                          </button>
                          <div class="dropdown-menu"></div>
                      </div>
                      <input id="inputIcon" type="hidden" name="icon" value="fas fa-heart">
                      @if ($errors->has('icon'))
                          <p class="mb-0 text-danger">{{$errors->first('icon')}}</p>
                      @endif
                      <div class="mt-2">
                          <small>NB: click on the dropdown sign to select a icon.</small>
                      </div>
                      @if ($errors->has('icon'))
                          <p class="mt-2 mb-0 text-danger">{{ $errors->first('icon') }}</p>
                      @endif
                  </div>
                <div class="form-group">
                  <label for="">{{ __('Language*') }}</label>
                  <select name="user_language_id" class="form-control">
                    <option value="" selected disabled>Select a Language</option>
                    @foreach ($langs as $lang)
                    <option value="{{$lang->id}}">{{$lang->name}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('language_id'))
                    <p class="mt-2 mb-0 text-danger">{{ $errors->first('language_id') }}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label for="">{{ __('Title*') }}</label>
                  <input type="text" class="form-control" name="title" placeholder="Enter Title">
                  @if ($errors->has('title'))
                    <p class="mt-2 mb-0 text-danger">{{ $errors->first('title') }}</p>
                  @endif
                </div>
                  <div class="form-group">
                      <label for="">{{ __('Content*') }}</label>
                      <textarea class="form-control" name="text" rows="5"
                                cols="80"></textarea>
                      @if ($errors->has('text'))
                          <p class="mt-2 mb-0 text-danger">{{ $errors->first('text') }}</p>
                      @endif
                  </div>
                <div class="form-group">
                  <label for="">{{ __('Serial Number*') }}</label>
                  <input type="number" class="form-control ltr" name="serial_number" placeholder="Enter Serial Number">
                  @if ($errors->has('serial_number'))
                    <p class="mt-2 mb-0 text-danger">{{ $errors->first('serial_number') }}</p>
                  @endif
                  <p class="text-warning mt-2">
                    <small>{{ __('The higher the serial number is, the later the testimonial will be shown.') }}</small>
                  </p>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="addSkillForm" class="btn btn-success">
                {{ __('Save') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
