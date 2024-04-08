


@extends('layout.front')
@section('content')

  <!-- ======= Header ======= -->
 

  <!-- ======= Hero Section ======= -->
  <section id="hero" class=" h-auto  align-items-center ">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
    <h1 class="text-center">Pixabay Image Search</h1>
    <div class="row mt-3">
        <div class="col-md-8">
            <form id="searchForm" class="row ">
                <div class="col-8">
                    <label for="searchQuery">Search Image</label>
                    <input type="text" class="form-control" id="searchQuery" placeholder="Enter your search query">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary mt-4 ">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <h3>Images</h3>
            <div id="imageResults" class="row"></div>
        </div>
    </div>
</div>
  </section><!-- End Hero -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Initial search for images and videos
    searchContent('nature');
    // Search form submission
    $('#searchForm').submit(function(e) {
        e.preventDefault();
        var query = $('#searchQuery').val();
        searchContent(query);
    });

    function searchContent(query) {
        $.ajax({
            url: '/search-images',
            method: 'GET',
            data: { query: query },
            success: function(data) {
                displayImages(data.hits);
            }
        });

    }

    function displayImages(images) {
        $('#imageResults').empty();
        images.forEach(function(image) {
            $('#imageResults').append('<div class="col-md-4"><img src="' + image.largeImageURL + '" class="img-fluid"></div>');
        });
    }
});
</script>


@endsection