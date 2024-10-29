@extends('user-front.layout')

@section('tab-title')
    {{ $keywords['Home'] ?? 'Home' }}
@endsection
@php
    Config::set('app.timezone', $userBs->timezoneinfo->timezone);
@endphp
@section('meta-description', !empty($userSeo) ? $userSeo->home_meta_description : '')
@section('meta-keywords', !empty($userSeo) ? $userSeo->home_meta_keywords : '')

@section('content')
    <!--====== Start Hero section ======-->
    <section class="hero-area">
        <div class="hero-wrapper-one">
            <div class="hero-slider-one">
                @if (count($sliders) > 0)
                    @foreach ($sliders as $slider)
                        <div class="single-slider">
                            <div class="slider-inner bg-with-overlay bg_cover lazy"
                                data-bg="{{ asset('assets/front/img/hero_slider/' . $slider->img) }}">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">
                                            <div class="hero-content hero-content-center">
                                                <h1 data-animation="fadeInDown" data-delay=".5s">{{ $slider->title }}</h1>
                                                <h4 data-animation="fadeInDown" data-delay=".55s">{{ $slider->subtitle }}
                                                </h4>
                                                @if (!empty($slider->btn_url))
                                                    <ul class="button" data-animation="fadeInDown" data-delay=".60s">
                                                        <li><a href="{{ $slider->btn_url }}"
                                                                class="main-btn arro-btn">{{ $slider->btn_name }}</a>
                                                        </li>
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="single-slider">
                        <div class="slider-inner bg-with-overlay bg_cover lazy"
                            data-bg="{{ asset('assets/front/img/static/lawyer/hero.jpeg') }}">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-7">
                                        <div class="hero-content hero-content-center">
                                            <h1 data-animation="fadeInDown" data-delay=".5s">Corporate Law Firms</h1>
                                            <h4 data-animation="fadeInDown" data-delay=".55s">25 Years Of Experience In Law
                                                Solutiuons</h4>
                                            <ul class="button" data-animation="fadeInDown" data-delay=".60s">
                                                <li><a href="#" class="main-btn arro-btn">Read more</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!--====== End Hero section ======-->
    @if (in_array('Service', $packagePermissions) &&
            isset($home_sections->featured_services_section) &&
            $home_sections->featured_services_section == 1)
        <!--====== Start Features section ======-->
        <section class="features-area features-area-one">
            <div class="container-fluid ">
                <div class="row features-wrapper-one no-gutters">
                    @foreach ($services as $service)
                        <div class="col-lg-3 features-column">
                            <div class="features-item features-item-one text-center">
                                <div class="item-bg bg_cover lazy"
                                    data-bg="{{ isset($service->image) ? asset('assets/front/img/user/services/' . $service->image) : asset('assets/front/img/profile/service-1.jpg') }}">
                                </div>
                                <div class="icon">
                                    <i class="{{ $service->icon }}"></i>
                                </div>
                                <div class="content">
                                    <h4>{{ $service->name }}</h4>
                                    <p>{!! strlen(strip_tags($service->content)) > 80
                                        ? mb_substr(strip_tags($service->content), 0, 80, 'UTF-8') . '...'
                                        : strip_tags($service->content) !!}
                                    </p>
                                    @if ($service->detail_page == 1)
                                        <a @if ($service->detail_page == 1) href="{{ route('front.user.service.detail', [getParam(), 'slug' => $service->slug, 'id' => $service->id]) }}" @endif
                                            class="icon-btn"><i class="fas fa-arrow-right"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--====== End Features section ======-->
    @endif
    @if (isset($home_sections->intro_section) && $home_sections->intro_section == 1)
        <!--====== Start About section ======-->
        <section class="about-area pt-130 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="about-content-box about-content-box-one mb-50 wow fadeInLeft" data-wow-delay=".3s">
                            <div class="section-title section-title-left mb-40">
                                @if (!empty($home_text->about_title))
                                    <span class="sub-title">{{ $home_text->about_title }}</span>
                                @endif
                                <h2 class="">{{ $home_text->about_subtitle ?? null }}</h2>
                            </div>
                            @if (!empty($home_text))
                                <p class="mb-4">{!! nl2br($home_text->about_content) ?? '' !!}</p>
                            @endif
                            @if (!empty($home_text->about_button_url))
                                <a href="{{ $home_text->about_button_url }}"
                                    class="main-btn arrow-btn">{{ $home_text->about_button_text }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="about-img-box about-img-box-one mb-50">
                            <div class="about-img-one wow fadeInUp " data-wow-delay=".45s">
                                <img class="lazy"
                                    data-src="{{ !empty($home_text->about_image) ? asset('assets/front/img/user/home_settings/' . $home_text->about_image) : asset('assets/front/img/static/lawyer/about.jpg') }}"
                                    alt="about">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--====== End About section ======-->
    @if (isset($home_sections->work_process_section) && $home_sections->work_process_section == 1)
        <!--====== Start Service section ======-->
        <section class="service-area position-relative light-bg pt-120 pb-130">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center mb-75 wow fadeInUp">
                            @isset($home_text->work_process_section_title)
                                <span class="sub-title">{{ $home_text->work_process_section_title }}</span>
                            @endisset
                            <h2>{{ $home_text->work_process_section_subtitle ?? null }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        @foreach ($work_processes as $key => $work_process)
                            <div class="service-item service-item-one wow fadeInUp" data-wow-delay=".2s">
                                <div class="icon">
                                    <i class="{{ $work_process->icon }}"></i>
                                </div>
                                <div class="content">
                                    <h3 class="title">
                                        <a>{{ $work_process->title }}</a>
                                    </h3>
                                    @if (!empty($work_process->text))
                                        <p>{!! nl2br($work_process->text) !!}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-6">
                        <div class="service-img pl-70 wow fadeInRight" data-wow-delay=".60s">
                            <img class="lazy"
                                data-src="{{ isset($home_text->work_process_section_img) ? asset('assets/front/img/work_process/' . $home_text->work_process_section_img) : asset('assets/front/img/static/lawyer/work_process.jpg') }}"
                                alt="service">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== End Service section ======-->
    @endif
    @if (in_array('Team', $packagePermissions) &&
            isset($home_sections->team_members_section) &&
            $home_sections->team_members_section == 1)
        <!--====== Start Team section ======-->
        <section class="team-area pt-120 pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="section-title section-title-left mb-65 wow fadeInLeft" data-wow-delay=".2s">
                            @isset($home_text->team_section_title)
                                <span class="sub-title">{{ $home_text->team_section_title }}</span>
                            @endisset
                            <h2 class="">{{ $home_text->team_section_subtitle ?? null }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($teams as $team)
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="team-item team-item-one mb-40 wow fadeInUp" data-wow-delay=".25s">
                                <div class="team-img">
                                    <img data-src="{{ asset('/assets/front/img/user/team/' . $team->image) }}"
                                        class="lazy" alt="Team">
                                    <div class="team-overlay">
                                        <div class="team-social">
                                            <ul class="social-link">
                                                @isset($team->facebook)
                                                    <li><a href="{{ $team->facebook }}" target="_blank"><i
                                                                class="fab fa-facebook-f"></i></a></li>
                                                @endisset
                                                @isset($team->twitter)
                                                    <li><a href="{{ $team->twitter }}" target="_blank"><i
                                                                class="fab fa-twitter"></i></a>
                                                    </li>
                                                @endisset
                                                @isset($team->instagram)
                                                    <li><a href="{{ $team->instagram }}" target="_blank"><i
                                                                class="fab fa-instagram"></i></a></li>
                                                @endisset
                                                @isset($team->linkedin)
                                                    <li><a href="{{ $team->linkedin }}" target="_blank"><i
                                                                class="fab fa-linkedin"></i></a></li>
                                                @endisset
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-content">
                                    <h3 class="title"><a href="attorney-details.html">{{ convertUtf8($team->name) }}
                                        </a></h3>
                                    <span class="position">{{ convertUtf8($team->rank) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--====== End Team section ======-->
    @endif
    @if (in_array('Request a Quote', $packagePermissions))
        @if ($userBs->is_quote)
            <!--====== Start CTA section ======-->
            <div class="cta-area cta-area-one">
                <div class="container">
                    <div class="row cta-wrapper-one">
                        <div class="col-lg-12">
                            <div class="cta-item text-center wow fadeInUp" data-wow-delay=".2s">
                                <div class="cta-overlay bg_cover"></div>
                                <div class="cta-content">
                                    @isset($home_text->quote_section_title)
                                        <span class="sub-title">{{ $home_text->quote_section_title }}</span>
                                    @endisset
                                    <h2 class="title">
                                        {{ !empty($home_text->quote_section_subtitle) ? $home_text->quote_section_subtitle : null }}
                                    </h2>
                                    <a href="{{ route('front.user.quote', getParam()) }}"
                                        class="main-btn arrow-btn">{{ $keywords['Request_A_Quote'] ?? 'Request A Quote' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End CTA section ======-->
        @endif
    @endif
    @if (isset($home_sections->counter_info_section) && $home_sections->counter_info_section == 1)
        <!--====== Start Counter section ======-->
        <div class="counter-area counter-area-one bg-with-overlay bg_cover pb-85 lazy"
            data-bg="{{ !empty($home_text->counter_section_image) ? asset('assets/front/img/user/home_settings/' . $home_text->counter_section_image) : asset('assets/front/images/bg/counter-bg-1.jpg') }}">
            <div class="container">
                <div class="row">
                    @foreach ($counterInformations as $key => $counterInformation)
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="counter-item counter-item-one mb-40">
                                <div class="icon">
                                    <i class="{{ $counterInformation->icon }}"></i>
                                </div>
                                <div class="content">
                                    <h2><span class="counter">{{ $counterInformation->count }}</span></h2>
                                    <span class="sm-title">{{ $counterInformation->title }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!--====== End Counter section ======-->
    @if (isset($home_sections->testimonials_section) && $home_sections->testimonials_section == 1)
        <!--====== Start Testimonial section ======-->
        <section class="testimonial-area pt-120 pb-80">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center mb-75 wow fadeInUp" data-wow-delay=".2s">
                            @if (!empty($home_text->testimonial_title))
                                <span class="sub-title">{{ $home_text->testimonial_title }}</span>
                            @endif
                            <h2 class="">{{ $home_text->testimonial_subtitle ?? null }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center testimonial-wrapper-one">
                    <div class="col-lg-5">
                        <div class="testimonial-img mb-50 wow fadeInLeft" data-wow-delay=".3s">
                            <img class="lazy"
                                data-src="{{ !empty($home_text->testimonial_image) ? asset('assets/front/img/user/home_settings/' . $home_text->testimonial_image) : asset('assets/front/img/static/lawyer/testimonial.jpg') }}"
                                alt="testimonial">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="testimonial-slider-one mb-50 wow fadeInRight" data-wow-delay=".5s">
                            @foreach ($testimonials as $testimonial)
                                <div class="testimonial-item">
                                    <div class="wt-content">
                                        <h3>"{{ replaceBaseUrl($testimonial->content) }}"</h3>
                                    </div>
                                    <div class="wt-title-thumb">
                                        <div class="wt-thumb">
                                            <img class="lazy"
                                                data-src="{{ asset('assets/front/img/user/testimonials/' . $testimonial->image) }}"
                                                alt="Author thumb">
                                        </div>
                                        <div class="wt-title">
                                            <h4>{{ convertUtf8($testimonial->name) }}</h4>
                                            <span
                                                class="position">{{ convertUtf8($testimonial->occupation) ?? null }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== End Testimonial section ======-->
    @endif
    @if (isset($home_sections->contact_section) && $home_sections->contact_section == 1)
        <!--====== Start Contact section ======-->
        <section class="contact-area">
            <div class="container">
                <div class="contact-wrapper-one wow fadeInDown" data-wow-delay=".2s">
                    <div class="contact-form">
                        <form action="{{ route('front.contact.message', getParam()) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form_group">
                                        <input type="text" class="form_control"
                                            placeholder="{{ $keywords['Name'] ?? 'Name' }}" name="fullname" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form_group">
                                        <input type="emil" class="form_control"
                                            placeholder="{{ $keywords['Email_Address'] ?? 'Email Address' }}"
                                            name="email" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form_group">
                                        <input type="text" class="form_control"
                                            placeholder="{{ $keywords['Subject'] ?? 'Subject' }}" name="subject"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form_group">
                                        <textarea class="form_control" placeholder="{{ $keywords['Message'] ?? 'Message' }}" name="message"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form_group">
                                        <button type="submit"
                                            class="arrow-btn main-btn">{{ $keywords['Send_Message'] ?? 'Send Message' }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--====== End Contact section ======-->
    @if (in_array('Portfolio', $packagePermissions) &&
            isset($home_sections->portfolio_section) &&
            $home_sections->portfolio_section == 1)
        <!--====== Start Case section ======-->
        <section class="case-area pt-260 light-bg pb-130">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="section-title section-title-left mb-75 wow fadeInLeft">
                            @if (!empty($home_text->portfolio_title))
                                <span class="sub-title">{{ $home_text->portfolio_title }}</span>
                            @endif
                            <h2 class="">{{ $home_text->portfolio_subtitle ?? null }}</h2>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="case-arrows mb-80 wow fadeInRight"></div>
                    </div>
                </div>
                <div class="row case-slider-one wow fadeInUp">
                    @foreach ($portfolios as $portfolio)
                        <div class="col-lg-3">
                            <div class="case-item case-item-one">
                                <div class="case-img">
                                    <img data-src="{{ asset('assets/front/img/user/portfolios/' . $portfolio->image) }}"
                                        class="lazy" alt="case">
                                    <div class="case-overlay">
                                        <div class="case-content">
                                            <h3 class="title"><a target="_blank"
                                                    href="{{ route('front.user.portfolio.detail', [getParam(), $portfolio->slug, $portfolio->id]) }}">{{ strlen($portfolio->title) > 25 ? mb_substr($portfolio->title, 0, 25, 'UTF-8') . '...' : $portfolio->title }}</a>
                                            </h3>
                                            <span class="tag">{{ $portfolio->bcategory->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--====== End Case section ======-->
    @endif
    @if (isset($home_sections->newsletter_section) && $home_sections->newsletter_section == 1)
        <!--====== Start Newsletter section ======-->
        <section class="newsletter-area pt-130">
            <div class="container">
                <div class="newsletter-wrapper-one pt-70 pb-80">
                    <div class="map text-center">
                        <img src="assets/front/images/map-1.png" alt="">
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="section-title section-title-white text-center mb-45 wow fadeInUp"
                                data-wow-delay=".2s">
                                <span class="sub-title">{{ $keywords['Newsletter'] ?? 'Newsletter' }}</span>
                                <h2>{{ $keywords['Receive_Latest_Updates'] ?? 'Receive Latest Updates' }}</h2>
                            </div>
                            <div class="newsletter-form wow fadeInUp" data-wow-delay=".3s">
                                <form action="{{ route('front.user.subscriber', getParam()) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form_group">
                                                <input type="email" class="form_control"
                                                    placeholder="{{ $keywords['Email_Address'] ?? 'Email Address' }}"
                                                    name="email" required value="{{ old('email') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form_group">
                                                <button type="submit"
                                                    class="main-btn arrow-btn">{{ $keywords['Subscribe'] ?? 'Subscribe' }}</button>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3 ">
                                            @if ($userBs->is_recaptcha == 1)
                                                <div class="d-block mb-4">
                                                    {!! NoCaptcha::renderJs() !!}
                                                    {!! NoCaptcha::display() !!}
                                                    @error('g-recaptcha-response')
                                                        <p
                                                            id="errg-recaptcha-response"class=" text-danger err-g-recaptcha-response mt-2">
                                                            {{ $message }}
                                                        </p>
                                                    @enderror
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--====== End Newsletter section ======-->
    @if (in_array('Blog', $packagePermissions) && isset($home_sections->blogs_section) && $home_sections->blogs_section == 1)
        <!--====== Start Blog section ======-->
        <section class="blog-area pt-120 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="section-title section-title-left mb-75 wow fadeInLeft">
                            @if (!empty($home_text->blog_title))
                                <span class="sub-title">{{ $home_text->blog_title }}</span>
                            @endif
                            <h2 class="">{{ $home_text->blog_subtitle ?? null }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-6">
                            <div class="blog-post-item blog-post-item-one mb-30 wow fadeInUp" data-wow-delay=".3s">
                                <div class="post-thumbnail">
                                    <img data-src="{{ asset('assets/front/img/user/blogs/' . $blog->image) }}"
                                        class="lazy" alt="blog">
                                </div>
                                <div class="entry-content">
                                    <div class="post-meta">
                                        <ul>
                                            <li><span><i class="fal fa-calendar-alt"></i><a
                                                        href="{{ route('front.user.blog.detail', [getParam(), $blog->slug, $blog->id]) }}">{{ \Carbon\Carbon::parse($blog->created_at)->toFormattedDateString() }}</a></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="title"><a
                                            href="{{ route('front.user.blog.detail', [getParam(), $blog->slug, $blog->id]) }}">{{ $blog->title }}</a>
                                    </h3>
                                    <a href="{{ route('front.user.blog.detail', [getParam(), $blog->slug, $blog->id]) }}"
                                        class="btn-link arrow-btn">{{ $keywords['Learn_More'] ?? 'Learn More' }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!--====== End Blog section ======-->
    @endif
    @if (isset($home_sections->brand_section) && $home_sections->brand_section == 1)
        <!--====== Start sponsor section ======-->
        <section class="sponsor-area light-bg pt-70 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sponsor-slider-one">
                            @foreach ($brands as $brand)
                                <a class="single-sponsor d-block" href="{{ $brand->brand_url }}" target="_blank">
                                    <img data-src="{{ asset('assets/front/img/user/brands/' . $brand->brand_img) }}"
                                        class="lazy" alt="sponsors">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== End sponsor section ======-->
    @endif
@endsection
