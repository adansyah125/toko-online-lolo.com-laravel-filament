@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Blog</h1>
                        <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                            vulputate velit imperdiet dolor tempor tristique.</p>
                        <p><a href="" class="btn btn-secondary me-2">Shop Now</a><a href="#"
                                class="btn btn-white-outline">Explore</a></p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img src="{{ asset('biled.png') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Blog Section -->
    <div class="blog-section">
        <div class="container">
            <div class="row">
                {{-- @forelse ($blogs as $blog)
                    <div class="col-12 col-sm-6 col-md-4 mb-5">
                        <div class="post-entry">

                            <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('images/post-placeholder.jpg') }}"
                                alt="{{ $blog->title }}" class="img-fluid">
                            </a>
                            <div class="post-content-entry">
                                <h3>{{ $blog->title }}</h3>
                                <div class="meta">
                                    <span>by <a href="#">{{ $blog->author }}</a></span> <span>on <a
                                            href="#">{{ $blog->published_at->format('M d, Y') }}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p>No blogs available.</p>
                    </div>
                @endforelse --}}
            </div>
        </div>
    </div>
    <!-- End Blog Section -->

    <!-- Start Testimonial Slider -->
    <div class="testimonial-section before-footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h2 class="section-title">Testimonials</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-slider-wrap text-center">
                        <div id="testimonial-nav">
                            <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                            <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                        </div>
                        <div class="testimonial-slider">
                            {{-- @forelse ($testimonials as $testimonial)
                                <div class="item">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 mx-auto">
                                            <div class="testimonial-block text-center">
                                                <blockquote class="mb-5">
                                                    <p>“{{ $testimonial->quote }}”</p>
                                                </blockquote>
                                                <div class="author-info">
                                                    <div class="author-pic">
                                                        <img src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('images/person-placeholder.jpg') }}"
                                                            alt="{{ $testimonial->name }}" class="img-fluid">
                                                    </div>
                                                    <h3 class="font-weight-bold">{{ $testimonial->name }}</h3>
                                                    <span class="position d-block mb-3">{{ $testimonial->position }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="item">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 mx-auto">
                                            <p>No testimonials available.</p>
                                        </div>
                                    </div>
                                </div>
                            @endforelse --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Slider -->
@endsection
