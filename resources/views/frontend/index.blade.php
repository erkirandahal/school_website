@extends('layouts.frontend.app')

@section('title','Welcome - '.$settings->office)

@section('content')
<!-- highlights-start -->
<div id="highlight-row">
  <div class="row highlight">
    <div class="col-md-2 highlight">
      <span>Highlights</span>
    </div>
    <div class="col-md-10 highlight">
      <div class="highlight-content">

        <div class="marquee-container" onmouseover="stopMarquee()" onmouseout="startMarquee()">
          <div class="marquee">
            @forelse($data['marquee_recents'] as $recent)
            <span> <i class="fa fa-caret-right"></i> <a href="{{ route('post-details',$recent->slug) }}" target="_blank"> {{$recent->title}} </a> </span>
            @empty
            <span> <i class="fa fa-caret-right"></i> No highlights...</span>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- highlights-start -->

<!-- slider-start -->
<div class="slider-area pos-relative">
  <div class="slider-active">
    @forelse($data['banners'] as $banner)
    <div class="single-slider slider-height d-flex align-items-center justify-content-center" style="background-image: url('{{ asset("uploads/banners/".$banner->image) }}');">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 col-md-12">
            <div class="slider-content slider-content-2">
              <h1 class="white-color f-700" data-animation="fadeInUp" data-delay=".2s"><span>{{ $banner->title }}</span></h1>
              <p data-animation="fadeInUp" data-delay=".4s">{{ $banner->tagline }}</p>
              <button class="theme-btn" data-animation="fadeInUp" data-delay=".6s"><span class="btn-text">स्वागत</span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    @empty
    <div class="single-slider slider-height d-flex align-items-center justify-content-center" style="background-image: url('frontend/img/slider/slider_bg_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 col-md-12">
            <div class="slider-content slider-content-2">
              <h1 class="white-color f-700" data-animation="fadeInUp" data-delay=".2s">Title 1</h1>
              <p data-animation="fadeInUp" data-delay=".4s">Tagline 1</p>
              <button class="theme-btn" data-animation="fadeInUp" data-delay=".6s"><span class="btn-text">स्वागत</span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="single-slider slider-height d-flex align-items-center justify-content-center" style="background-image: url(frontend/img/slider/2.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-xl-8 col-md-12 offset-xl-2">
            <div class="slider-content slider-content-2 text-center">
              <h1 class="white-color f-700" data-animation="fadeInUp" data-delay=".2s">Title 2</h1>
              <p data-animation="fadeInUp" data-delay=".4s">tagline 2</p>
              <button class="theme-btn" data-animation="fadeInUp" data-delay=".6s"><span class="btn-text">स्वागत</span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforelse
  </div>
</div>
<!-- slider-end -->

<!-- about start -->
<div id="about" class="about-area pt-70 pb-70">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 col-lg-6">
        <div class="about-title-section mb-30">
          <h1>{{$page['about_us'] ? $page['about_us']->title : 'About Us'}}</h1>
          {!! $page['about_us'] ? substr($page['about_us']->description,0,1000) : 'About Us - Description' !!}
          <a href="{{ route('frontend.page',['slug'=>'about-us']) }}" class="theme-btn blue-bg-border mt-20"><span class="btn-text">More...</span></a>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6">
        <div class="nav-tabs-wrapper">
          <ul class="nav nav-pills post-tabs" id="pills-tab" role="tablist">
            @forelse($categories as $key=>$category)
            <li class="nav-item">
              <a class="nav-link {{ ($key==0) ? 'active' :''}}" id="pills-home-tab" data-toggle="pill" href="#pills-{{$category['slug']}}" role="tab" aria-controls="pills-home" aria-selected="true">{{ucfirst($category['slug'])}} </a>
            </li>
            @empty
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-tabs" role="tab" aria-controls="pills-home" aria-selected="true">tabs </a>
            </li>
            @endforelse
          </ul>
          <div class="tab-content" id="pills-tabContent">

            @forelse($categories as $key=>$cat)
            <div class="tab-pane fade {{ ($key== 0) ? 'show active':''}}" id="pills-{{$cat['slug']}}" role="tabpanel" aria-labelledby="pills-home-tab">
              <ul class="list-group">
                @forelse($cat['posts'] as $post)
                <li class="list-group-item"><a href="{{route('post-details',$post->slug)}}"> {{ $post->title }} </a> <span class="float-right published-date"> <i class="fa fa-calendar"></i> {{ date('M j, Y', strtotime($post->date)) }}</span>
                </li>
                @empty
                <li class="list-group-item">Empty!</li>
                @endforelse
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-md-12" style="text-align:center;">
                      <a href="{{ route('all-posts', ['slug'=>$cat['slug']]) }}"><span class="posts-view-all-btn">View All &rarr;</span></a>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            @empty
            <div class="tab-pane fade show active" id="pills-tabs" role="tabpanel" aria-labelledby="pills-home-tab">
              <p class="course-details-overview-para">tabs</p>
            </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- about end -->

<!-- program start -->
@if(count($data['programs']) <= 1)
  <div id="programs" class="about-area pb-70">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
        <div class="section-title mb-50 text-center">
          <div class="section-title-heading mb-20">
            <h1 class="primary-color">Our Programs</h1>
          </div>
          <div class="section-title-para">
            <p class="gray-color">We offer excellent skill based programs</p>
          </div>
        </div>
      </div>
    </div>

    @forelse($data['programs'] as $program)
    @if(($program->order % 2) != 0)
    <div class="row">
      <div class="col-xl-5 col-lg-5">
        <div class="about-left-img">
          <img src="{{ asset('uploads/programs/'.$data['programs'][0]->image)}}" alt="NO IMAGE" width="450">
        </div>
      </div>
      <div class="col-xl-7 col-lg-7">
        <div class="about-title-section mb-30">
          <h1>{{$data['programs'][0]->title}}</h1>
          <p>{!! substr($data['programs'][0]->description,0,420) !!}</p>
          <a href="{{ route('program-details',$data['programs'][0]->slug)}}" class="theme-btn blue-bg-border mt-20"><span class="btn-text">Click for more...</span></a>
        </div>
      </div>
    </div>

    @else
    <div class="row">
      <div class="col-xl-7 col-lg-7">
        <div class="about-title-section mb-30">
          <h1>{{$data['programs'][0]->title}}</h1>
          <p>{!! substr($data['programs'][0]->description,0,350) !!}</p>
          <a href="{{ route('program-details',$data['programs'][0]->title)}}" class="theme-btn blue-bg-border mt-20"><span class="btn-text">Click for more...</span></a>
        </div>
      </div>
      <div class="col-xl-5 col-lg-5">
        <div class="about-right-img mb-30">
          <img src="{{ asset('uploads/programs/'.$data['programs'][0]->image)}}" alt="NO IMAGE" width="420">
        </div>
      </div>
    </div>
    @endif
    @empty
    <div class="row">
      <div class="col-xl-5 col-lg-5">
        <div class="about-right-img mb-30">
          <img src="{frontend/img/about/about-right.png" alt="NO IMAGE" width="420">
        </div>
      </div>
      <div class="col-xl-7 col-lg-7">
        <div class="about-title-section mb-30">
          <h1>Program title</h1>
          <p>program descriptions</p>
          <button class="theme-btn blue-bg-border mt-20"><span class="btn-text">Click for more...</span></button>
        </div>
      </div>
    </div>
    @endforelse
  </div>
  </div>
  @else
  <div id="programs" class="courses-area courses-bg-height pb-70">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
          <div class="section-title mb-50 text-center">
            <div class="section-title-heading mb-20">
              <h1 class="primary-color">Our Programs</h1>
            </div>
            <div class="section-title-para">
              <p class="gray-color">We offer excellent skill based programs</p>
            </div>
          </div>
        </div>
      </div>
      <div class="courses-list">
        <div class="row">
          @forelse($data['programs'] as $program)
          <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="courses-wrapper mb-30">
              <div class="courses-thumb">
                <a href="{{ route('program-details',$program->slug)}}"><img src="{{ asset('uploads/programs/'.$program->image)}}" alt=" NO IMAGE "></a>
              </div>
              <div class="courses-content courses-content-2 text-center">
                <div class="courses-heading text-center">
                  <h1><a href="{{ route('program-details',$program->slug)}}">{{$program->title}}</a></h1>
                </div>
                <div class="courses-icon text-center">
                  <div class="courses-single-icon courses-single-icon-2">
                    <span class="ti-user"></span>
                    <span class="seat">Quota</span>
                    <span class="user-number">{{$program->quota}}</span>
                  </div>
                  <div class="courses-single-icon courses-single-icon-2">
                    <i class="fa fa-clock"></i>
                    <span class="price">Duration</span>
                    <span class="user-number">{{$program->duration}}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @empty
          <div class="col-xl-12 col-lg-12 col-md-12 text-center">
            NO DATA
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
  @endif
  <!-- program end -->


  <!-- events start -->
  <div id="events" class="events-area events-bg-height pt-70 pb-70" style="background-image: url(frontend/img/courses/courses_bg.png)">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
          <div class="section-title mb-50 text-center">
            <div class="section-title-heading mb-20">
              <h1 class="white-color">Upcoming Events</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="events-list mb-30">
        <div class="row">
          @forelse($data['events'] as $event)
          <div class="col-xl-4 col-lg-4 col-md-4">
            <div class="blog-wrapper mb-30">
              <div class="blog-thumb mb-25">
                <a href="{{ route('event-details',$event->slug.'?nid='.base64_encode($event->id))}}"><img src="{{ asset('uploads/events/'.$event->image)}}" alt="" height="260" width="370"></a>
                <span class="blog-category">Event</span>
              </div>
              <div class="blog-content">
                <div class="blog-meta">

                  @if($event->start_date == $event->end_date)
                  <span>{{ date("F jS, Y",strtotime($event->start_date)) }} ({{$event->start_time}} - {{ $event->end_time}} )</span>
                  @else

                  <span>{{ date("F jS, Y",strtotime($event->start_date)) }},({{$event->start_time}}) - {{ date("F jS, Y",strtotime($event->start_date)) }}, ( {{ $event->end_time}} )</span>
                  @endif

                </div>
                <h5><a href="{{ route('event-details',$event->slug.'?nid='.base64_encode($event->id))}}">{{ $event->title}}</a></h5>
                <p>{!! substr($event->description,0,100) !!}</p>
                <div class="read-more-btn">
                  <a href="{{ route('event-details',$event->slug.'?nid='.base64_encode($event->id))}}">
                    Read more...
                  </a>
                </div>
              </div>
            </div>
          </div>
          @empty
          <div class="col-xl-12 col-lg-12">
            <p class="text-center"> NO DATA</p>
          </div>
          @endforelse
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12" style="text-align:center;">
        <a class="btn btn-sm" href="{{ route('all-events') }}">view all events<span>&rarr;</span></a>
      </div>
    </div>
  </div>
  <!-- events end -->


  <div id="facilities" class="row pt-70">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
          <div class="section-title mb-50 text-center">
            <div class="section-title-heading mb-20">
              <h1 class="primary-color">Our Facilities </h1>
            </div>
            <div class="section-title-para">
              <p class="gray-color">We provide the excellent facilities </p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        @forelse($data['facilities'] as $key=>$facility)
        <div class="col-xl-4 col-lg-4 col-md-6">
          <div class="facility-images">
            <img src="{{ asset('uploads/facilities/image-6828268854.jpg')}}" alt="NO IMAGE" class="img img-responsive">
          </div>
          <div class="feature-wrapper mb-30">
            <div class="feature-title-heading">
              <h3>{{ $facility->title }}</h3>
              <span>{{++$key}}</span>
            </div>
            <div class="feature-text">
              <p>{!! $facility->summary ? $facility->summary : substr($facility->description,0,100) !!}</p>
            </div>
            <div class="feature-text">
              <a href="" class="btn-link">more...</a>
            </div>
          </div>
        </div>
        @empty
        <div class="col-xl-12 col-lg-12 col-md-12">
          <p class="text-center">NO DATA</p>
        </div>
        @endforelse
      </div>
    </div>
  </div>

  <!-- testimonials start -->
  <div class="testimonilas-area pt-70 pb-70">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
          <div class="section-title mb-50 text-center">
            <div class="section-title-heading mb-20">
              <h1 class="primary-color">What Our Students Say</h1>
            </div>
            <div class="section-title-para">
              <p class="gray-color">We value their precious words</p>
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
                  <img src="{{ asset('uploads/testimonials/'.$testimonial->image)}}" alt="" width="45px">
                </div>
                <div class="testimonilas-author-title">
                  <h1>{{ $testimonial->statement_by}}</h1>
                  <h2>{{ $testimonial->recognition}}</h2>
                </div>
              </div>
              <div class="testimonilas-para">
                <p>{{ $testimonial->statement}}</p>
              </div>
            </div>
          </div>
          @empty
          <div class="col-xl-12">
            <div class="testimonilas-wrapper">
              <div class="testimonilas-heading d-flex">
                <div class="testimonilas-author-thumb">
                  <img src="frontend/img/testimonials/testimonilas_author_thumb1.png" alt="">
                </div>
                <div class="testimonilas-author-title">
                  <h1>Name of spec</h1>
                  <h2>CSE Student</h2>
                </div>
              </div>
              <div class="testimonilas-para">
                <p>But also the leap into electronic type reman see essentially unchanged. It was popul arised thew with the release of letraset sheets.</p>
              </div>
            </div>
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
  <!-- testimonials end -->
  <!-- video start -->
  <div class="video-area">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
          <div class="video-wrapper text-center">
            <div class="video-content">
              <a class="popup-video" href="{{ $data['video']->link}}"><img src="frontend/img/video/play_icon.png" alt=""></a>
              <span>Watch Our Latest Video</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- video end -->

  <!-- subscribe start -->
  <div class="subscribe-area">
    <div class="container">
      <div class="subscribe-box">
        <div class="row">
          <div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1 col-md-12">
            <div class="row justify-content-between">
              <div class="col-xl-6 col-lg-7 col-md-8">
                <div class="subscribe-text">
                  <h1>Subscribe</h1>
                  <span>Enter your email and get latest updates and offers subscribe us</span>
                </div>
              </div>
              <div class="col-xl-4 col-lg-5 col-md-4 justify-content-end">
                <div class="email-submit-form">
                  <div class="subscribe-form">
                    <form action="#">
                      <input placeholder="Enter your email" type="email">
                      <i class="fas fa-long-arrow-alt-right"></i>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- subscribe end -->

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
  </script>

  @endsection
  @stop
