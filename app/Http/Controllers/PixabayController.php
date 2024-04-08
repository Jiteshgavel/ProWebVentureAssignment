<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PixabayService;

class PixabayController extends Controller
{
    protected $pixabayService;

    public function __construct(PixabayService $pixabayService)
    {
        $this->pixabayService = $pixabayService;
    }

    public function image(){
        return view('pixabay_image');
    }
    public function video()
    {
        return view('pixabay_video');
    }
    public function searchImages(Request $request)
    {
        $query = $request->input('query');
        $images = $this->pixabayService->searchImages($query);

        return response()->json($images);
    }

    public function searchVideos(Request $request)
    {
        $query = $request->input('query');
        $videos = $this->pixabayService->searchVideos($query);

        return response()->json($videos);
    }
}
