@extends('user.layout')

{{-- this style will be applied when the direction of language is right-to-left --}}
@includeIf('user.partials.rtl-style')

@section('content')
    <div class="page-header">
        <h4 class="page-title">{{   __('Certificate Settings') }}</h4>
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
                <a href="#">{{   __('Course Management') }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a
                    href="{{ route('user.course_management.courses', ['language' => $defaultLang->code]) }}">{{ __('Courses') }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                @php
                    $title = $course
                        ->courseInformation()
                        ->where('language_id', $defaultLang->id)
                        ->pluck('title')
                        ->first();
                @endphp

                <a href="#">{{ strlen($title) > 35 ? mb_substr($title, 0, 35, 'UTF-8') . '...' : $title }}</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{   __('Certificate Settings') }}</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form
                    action="{{ route('user.course_management.course.update_certificate_settings', ['id' => $course->id]) }}"
                    method="POST">

                    @csrf
                    <div class="card-header">
                        <div class="card-title d-inline-block">{{ __('Update Certificate Settings') }}</div>
                        <a class="btn btn-info btn-sm float-right d-inline-block"
                            href="{{ route('user.course_management.courses', ['language' => $defaultLang->code]) }}">
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
                                    <label>{{   __('Certificate Status') }}</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="certificate_status" value="1"
                                                class="selectgroup-input"
                                                {{ $course->certificate_status == 1 ? 'checked' : '' }}>
                                            <span
                                                class="selectgroup-button">{{   __('Enable') }}</span>
                                        </label>

                                        <label class="selectgroup-item">
                                            <input type="radio" name="certificate_status" value="0"
                                                class="selectgroup-input"
                                                {{ $course->certificate_status == 0 ? 'checked' : '' }}>
                                            <span
                                                class="selectgroup-button">{{   __('Disable') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div id="certificate-settings"
                                    @if ($course->certificate_status == 1) class="dis-block" @else class="dis-none" @endif>
                                    <div class="form-group">
                                        <label>{{ __('Enforce Video Watching') }}</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="video_watching" value="1"
                                                    class="selectgroup-input"
                                                    {{ $course->video_watching == 1 ? 'checked' : '' }}>
                                                <span
                                                    class="selectgroup-button">{{   __('Enable') }}</span>
                                            </label>

                                            <label class="selectgroup-item">
                                                <input type="radio" name="video_watching" value="0"
                                                    class="selectgroup-input"
                                                    {{ $course->video_watching == 0 ? 'checked' : '' }}>
                                                <span
                                                    class="selectgroup-button">{{   __('Disable') }}</span>
                                            </label>
                                        </div>
                                        <p class="text-warning mb-0">
                                            {{ __('Students must view 90% of a video to complete a video.') }}
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label>{{   __('Enforce Quiz Completion') }}</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="quiz_completion" value="1"
                                                    class="selectgroup-input"
                                                    {{ $course->quiz_completion == 1 ? 'checked' : '' }}>
                                                <span
                                                    class="selectgroup-button">{{   __('Enable') }}</span>
                                            </label>

                                            <label class="selectgroup-item">
                                                <input type="radio" name="quiz_completion" value="0"
                                                    class="selectgroup-input"
                                                    {{ $course->quiz_completion == 0 ? 'checked' : '' }}>
                                                <span
                                                    class="selectgroup-button">{{   __('Disable') }}</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div id="minScore" class="dis-none">
                                        <div class="form-group">
                                            <label
                                                for="">{{   __('Minimum Quiz Score') }}</label>
                                            <input type="text" class="form-control" name="min_quiz_score"
                                                value="{{ $course->min_quiz_score }}">
                                            <div class="text-warning mb-0">
                                                {{  __('Minimum quiz score needed to complete quiz of a lesson') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>{{  __('Certificate Title') }}</label>
                                        <input type="text" class="form-control" name="certificate_title"
                                            placeholder="{{    __('Enter Certificate Title') }}" value="{{ $course->certificate_title }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{  __('Certificate Text') }}</label>
                                        <textarea class="form-control" name="certificate_text" rows="7" placeholder="{{$keywords['Enter_Certificate_Text'] ?? __('Enter Certificate Text') }}">{{ $course->certificate_text }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <h4 class="text-warning border-bottom pb-2 mb-3">{{  __('Shortcodes') }}</h4>
                                        <table class="table table-striped mb-2 border">
                                            <thead>
                                                <tr>
                                                    <th scope="col">{{   __('Code') }}</th>
                                                    <th scope="col">{{  __('Meaning') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{name}</td>
                                                    <td scope="row">{{  __('Student Name') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{duration}</td>
                                                    <td scope="row">{{  __('Course Duration') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{title}</td>
                                                    <td scope="row">{{  __('Course Title') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{date}</td>
                                                    <td scope="row">{{  __('Course Completion Date') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <p class="text-warning">
                                            {{   __('You can use these short codes to show dynamic data in certificate text') . '.' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success">
                                    {{  __('Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/tenant/js/partial.js') }}"></script>
@endsection
