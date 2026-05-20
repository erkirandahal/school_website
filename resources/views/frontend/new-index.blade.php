@extends('layouts.frontend.app')

@section('title', $settings ? $settings->office : 'Welcome')

@section('content')
    <div id="highlight-row">
        <div class="row highlight d-flex flex-nowrap align-items-center">
            <div class="col-md-2">
                <span>Highlights</span>
            </div>
            <div class="col-md-10">
                <div class="highlight-content d-flex align-items-center">
                    <div class="marquee-container" onmouseover="stopMarquee()" onmouseout="startMarquee()">
                        <div class="marquee d-flex justify-content-between align-items-center">
                            @forelse($data['marquee_recents'] as $recent)
                                <span> <a href="{{ route('post-details', $recent->slug) }}" target="_blank"> <i
                                            class="fa fa-caret-right"></i> {{ $recent->title }} </a> </span>
                            @empty
                                <span> <i class="fa fa-caret-right"></i>&nbsp;No highlights...</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="slider-area pos-relative pb-50">
        <div class="slider-active">
            @forelse($data['banners'] as $banner)
                <div class="single-slider slider-height d-flex align-items-end justify-content-center"
                    style="background-image: url('{{ asset('uploads/banners/' . $banner->image) }}');">
                    <div class="container mb-4">
                        <div class="row">
                            <div class="col-xl-9 col-md-12">
                                <div class="slider-content slider-content-2">
                                    <h2 class="white-color f-700" data-animation="fadeInUp" data-delay=".2s">
                                        <span>{{ $banner->title }}</span>
                                    </h2>
                                    <p data-animation="fadeInUp" data-delay=".4s">{{ $banner->tagline }}</p>
                                    <button class="theme-btn" data-animation="fadeInUp" data-delay=".6s"><span
                                            class="btn-text">स्वागत छ हाम्रो विद्यालयमा</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="single-slider slider-height d-flex align-items-center justify-content-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-9 col-md-12">
                                <div class="slider-content slider-content-2">
                                    <h1 class="white-color f-700" data-animation="fadeInUp" data-delay=".2s">Title 1</h1>
                                    <p data-animation="fadeInUp" data-delay=".4s">Tagline 1</p>
                                    <button class="theme-btn" data-animation="fadeInUp" data-delay=".6s"><span
                                            class="btn-text">स्वागत छ हाम्रो विद्यालयमा</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-slider slider-height d-flex align-items-center justify-content-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-md-12 offset-xl-2">
                                <div class="slider-content slider-content-2 text-center">
                                    <h1 class="white-color f-700" data-animation="fadeInUp" data-delay=".2s">Title 2</h1>
                                    <p data-animation="fadeInUp" data-delay=".4s">tagline 2</p>
                                    <button class="theme-btn" data-animation="fadeInUp" data-delay=".6s"><span
                                            class="btn-text">स्वागत छ हाम्रो विद्यालयमा</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <div id="about" class="about-area pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="about-title-section">
                        <h1 class="section-header-color">{{ $page['about_us'] ? $page['about_us']->title : 'About Us' }}
                        </h1>
                        {!! $page['about_us'] ? substr($page['about_us']->description, 0, 1000) : 'About Us - Description' !!}
                        <a href="{{ route('frontend.page', ['slug' => 'about-us']) }}"
                            class="read-more-btn btn btn-primary btn-sm text-capitalize">Read more...</a>
                    </div>
                    <div class="nav-tabs-wrapper mt-50">
                        <ul class="nav nav-pills post-tabs" id="pills-tab" role="tablist">
                            @forelse($categories as $key=>$category)
                                <li class="nav-item">
                                    <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="pills-home-tab"
                                        data-toggle="pill" href="#pills-{{ $category['slug'] }}" role="tab"
                                        aria-controls="pills-home" aria-selected="true">{{ ucfirst($category['title']) }}
                                    </a>
                                </li>

                            @empty
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-tabs"
                                        role="tab" aria-controls="pills-home" aria-selected="true">tabs </a>
                                </li>
                            @endforelse
                        </ul>
                        <div class="tab-content" id="pills-tabContent">

                            @forelse($categories as $key=>$cat)
                                <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}"
                                    id="pills-{{ $cat['slug'] }}" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <ul class="list-group">
                                        @forelse($cat['posts'] as $post)
                                            <li class="list-group-item">
                                                <div class="post-wrapper">
                                                    <a href="{{ route('post-details', $post->slug) }}">
                                                        {{ $post->title }}
                                                    </a>
                                                    <div class="float-left post-download">
                                                        <span class="post-published-date">
                                                            <i class="fa fa-calendar me-2"></i>
                                                            {{ date('M j, Y', strtotime($post->date)) }}
                                                        </span>
                                                        <span class="text-link"><a
                                                                href="{{ url('/download-posts', $post->image ? $post->image : $post->attachment) }}">
                                                                <i class="fa fa-download"></i></a></span>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="list-group-item">NO DATA</li>
                                        @endforelse
                                        <li class="list-group-item">
                                            <div class="view-all">
                                                <a href="{{ route('resources.details', $cat['slug']) }}">View
                                                    All
                                                    &rarr;</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            @empty
                                <div class="tab-pane fade show active" id="pills-tabs" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <p class="course-details-overview-para">tabs</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="section-title mb-50 text-center our-officials-heading mt-50">
                        <div class="section-title-heading mb-20">
                            <h1 class="section-header-color">Our Officials</h1>
                        </div>
                    </div>
                    <div class="officials">
                        @forelse($data['officials'] as $key=>$official)
                            <div class="official-item">
                                <div class="official-item-designation-wrapper">
                                    <h5 class="official-item-designation m-0">{{ $official->designation->name }}</h5>
                                </div>
                                <div class="official-item-img">
                                    @if (file_exists(public_path('uploads/officials/' . $official->image)) && $official->image)
                                        <img src="{{ asset('uploads/officials/' . $official->image) }}" alt="Image"
                                            class="img img-responsive img-fluid" width="200">
                                    @else
                                        <img src="{{ asset('uploads/officials/official-default.jpeg') }}" alt="Image"
                                            class="img img-responsive img-fluid" width="200">
                                    @endif
                                </div>
                                <p class="mt-1 mb-0 official-item-name">{{ $official->first_name }}
                                    {{ $official->last_name }}</p>

                                @if ($official->mobile)
                                    <p class="m-0 official-item-phone">{{ $official->mobile }}</p>
                                @endif
                                @if ($official->email)
                                    <p class="m-0 official-item-email">{{ $official->email }}</p>
                                @endif
                            </div>
                        @empty
                            <div class="official-item">
                                <div>
                                    <img src="{{ asset('uploads/officials/official-default.jpeg') }}" alt="Advertisement"
                                        class="img img-responsive img-fluid" width="200">
                                </div>
                                <h5 class="m-0">Name</h5>
                                <h4 class="m-0">Designation</h4>
                                <p class="m-0"> <i class="fa fa-phone me-1"></i>contact</p>
                                <p class="m-0"> <i class="fa fa-envelope me-1"></i> email/p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="events" class="events-area events-bg-heigh mb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title mb-50 text-center">
                        <div class="section-title-heading mb-20">
                            <h1 class="section-header-color">News & Events</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="events-list">
                <div class="row">
                    @forelse($data['events'] as $event)
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <div class="event-wrapper">
                                <div class="blog-thumb">
                                    <a href="{{ route('news-and-events.details', $event->slug) }}">
                                        <img src="{{ asset('uploads/posts/' . $event->image) }}" alt=""
                                            height="260" width="370">
                                    </a>
                                </div>
                                <div class="event-content">
                                    <h5>
                                        <a href="{{ route('news-and-events.details', $event->slug) }}">{{ $event->title }}
                                        </a>
                                    </h5>
                                    <div>
                                        {!! substr($event->description, 0, 100) !!}...
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-xl-12 col-lg-12 text-center">
                            <div class="border rounded p-3 text-center">
                                <p class="m-0">NO DATA</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 view-all mt-10">
                    <a href="{{ route('news-and-events') }}">View All &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title mb-50 text-center">
                        <div class="section-title-heading mb-20">
                            <h1 class="section-header-color">Photo Gallery</h1>
                        </div>
                    </div>
                </div>
            </div>
            @if (count($data['gallery_images']) > 0)
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($data['gallery_images'] as $photo)
                            <div class="swiper-slide">
                                <div class="swiper-slide-content">
                                    <a href="{{ url('/photo-gallery/' . $photo['gallery_slug']) }}">
                                        <div class="content-img">
                                            <img src="{{ asset('/uploads/galleries/' . $photo['image']) }}"
                                                alt="{{ $photo['title'] ?? '' }}"
                                                title="{{ $photo['title'] ?? '' }}"></img>
                                        </div>
                                        <p class="py-2">{{ $photo['title'] ?? '' }}</p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            @else
                <div class="border rounded p-3 text-center">
                    <p class="m-0">No images available</p>
                </div>
            @endif
        </div>
    </div>

    <div id="facilities" class="row pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title mb-50 text-center">
                        <div class="section-title-heading mb-20">
                            <h1 class="section-header-color">Our Facilities </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse($data['facilities'] as $key=>$facility)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="feature-wrapper mb-20 text-center d-flex flex-column justify-content-center">
                                <div class="facility-images photo-animate">
                                    @if (count($facility->images) > 0)
                                        <a href="{{ url('/facilities') }}">
                                            <img src="{{ asset('uploads/media/' . $facility->images[0]->image) }}"
                                                alt="NO IMAGE" class="img img-responsive">
                                        </a>
                                    @else
                                        <a href="{{ url('/facilities') }}">
                                            <img src="{{ asset('uploads/media/image-6828268854.jpg') }}" alt="NO IMAGE"
                                                class="img img-responsive">
                                        </a>
                                    @endif
                                </div>
                                <div class="facility-hover-content">
                                    <h5 class="m-0">{{ $facility->title }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-xl-12 col-lg-12 col-md-12 text-center">
                        <div class="border rounded p-3 text-center">
                            <p class="m-0">NO DATA</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @if (count($data['testimonials']) > 0)
        <div class="testimonilas-area pt-70 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                        <div class="section-title mb-50 text-center">
                            <div class="section-title-heading mb-20">
                                <h1 class="primary-color">What Our Students Say</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonilas-list">
                    <div class="row testimonilas-active">
                        @forelse($data['testimonials'] as $testimonial)
                            <div class="col-xl-12">
                                <div class="testimonilas-wrapper mb-110">
                                    <div class="testimonilas-heading d-flex">
                                        <div class="testimonilas-author-thumb">
                                            <img src="{{ asset('uploads/testimonials/' . $testimonial->image) }}"
                                                alt="" width="45px">
                                        </div>
                                        <div class="testimonilas-author-title">
                                            <h1>{{ $testimonial->statement_by }}</h1>
                                            <h2>{{ $testimonial->recognition }}</h2>
                                        </div>
                                    </div>
                                    <div class="testimonilas-para">
                                        <p>{{ $testimonial->statement }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-xl-12 text-center">
                                <p>NO DATA</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title mb-50 text-center">
                        <div class="section-title-heading mb-20">
                            <h1 class="section-header-color">Our Location</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8  col-sm-12  col-sm-12  col-xs-12">
                    @if ($embeddings['google_map'])
                        <div class="google-map">
                            {!! $embeddings['google_map']->iframe !!}
                        </div>
                    @else
                        <div class="border rounded p-3 text-center">
                            <p class="text-center m-0">Google Map Not available</p>
                        </div>
                    @endif
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4  col-sm-12  col-sm-12  col-xs-12">
                    @if ($embeddings['facebook'])
                        <div class="facebook-page-block">
                            {!! $embeddings['facebook']->iframe !!}
                        </div>
                    @else
                        <div class="border rounded p-3 text-center">
                            <p class="text-center m-0">Facebook Page Not available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($data['modal_img'])
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <img class="img img-responsive" src="{{ asset('uploads/posts/' . $data['modal_img']->image) }}"
                            alt="About Us" loading="lazy">
                    </div>
                    <div class="modal-body">
                        {{ $data['modal_img']->title }}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js')
    <script>
        var marqueeAnimation;

        function startMarquee() {
            marqueeAnimation = document.querySelector('.marquee').style.animation;
            document.querySelector('.marquee').style.animationPlayState = 'running';
        }

        function stopMarquee() {
            document.querySelector('.marquee').style.animationPlayState = 'paused';
        }

        $(document).ready(() => {
            $('#exampleModal').modal({
                show: true
            });
        })
    </script>

    <script>
        let swiper;

        function initSwiper() {
            const width = $(window).width();

            // Destroy existing swiper before re-init
            if (swiper) {
                swiper.destroy(true, true);
            }

            swiper = new Swiper(".mySwiper", {
                slidesPerView: width < 600 ? 1 : width < 900 ? 2 : 4,
                slidesPerGroup: width < 600 ? 1 : width < 900 ? 2 : 4,
                loop: true,
                spaceBetween: 10,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        }

        $(document).ready(function() {
            initSwiper();
        });

        $(window).on("resize", function() {
            initSwiper();
        });
    </script>

@endsection
