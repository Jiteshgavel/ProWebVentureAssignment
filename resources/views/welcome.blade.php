@extends('layout.front')
@section('content')
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="index.html">OnePage</a></h1>
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center pt-0">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row icon-boxes">
        @if(!empty($products) and count($products))
          @foreach ($products as $data )
          <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box mb-4">
              <div class="icon"><i class="ri-stack-line"></i></div>
              <h4 class="title"><a href="{{ route('show',$data->id) }}">{{ $data->name ?? '' }}</a></h4>
              <p class="description">{{ $data->description ?? '' }}</p>
            </div>
          </div>
          @endforeach

          {{-- {{ $products->links() }} --}}
       
        @endif

      </div>
     
    </div>
  </section><!-- End Hero -->



@endsection