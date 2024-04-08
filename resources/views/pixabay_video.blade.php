@extends('layout.front')
@section('content')

  <!-- ======= Header ======= -->
 

  <!-- ======= Hero Section ======= -->
  <section id="hero" class=" h-auto  align-items-center ">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
    <h1 class="text-center">Pixabay Video Search</h1>
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
            <h3>Videos</h3>
            <div id="videoResults" class="row"></div>
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
            url: '/search-videos',
            method: 'GET',
            data: { query: query },
            success: function(data) {
                displayVideos(data.hits);
            }
        });
    }

    function displayVideos(videos) {
        $('#videoResults').empty();
        videos.forEach(function(video) {
            $('#videoResults').append('<div class="col-md-4"><video controls class="img-fluid"><source src="' + video.videos.large.url + '" type="video/mp4"></video></div>');
        });
    }
});
</script>


@endsection
