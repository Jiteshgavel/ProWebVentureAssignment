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
         <div class="col-lg-12">
            <div class="portfolio-info">
              <h3>{{ $product->name ?? '' }}</h3>
              <ul>
                <li><strong>Weight</strong>: {{ $product->weight ?? '' }}</li>
                <li><strong>Price</strong>: {{ $product->price ?? '' }}</li>
                <li><strong>Category</strong>: {{ $product->category ? $product->category->name : '' }}</li>
              </ul>
            </div>
            <div class="portfolio-description">
              <p>
                {{ $product->description ?? '' }}
              </p>
            </div>
            <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
          </div>
      </div>
     
    </div>
  </section><!-- End Hero -->



@endsection