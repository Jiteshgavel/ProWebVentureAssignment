<?php
// app/Services/PixabayService.php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Client\RequestException;

class PixabayService
{
    protected $apiKey;
    protected $httpClient;

    public function __construct()
    {
        $this->apiKey = env('PIXABAY_API_KEY');
        $this->httpClient = new Client(['base_uri' => 'https://pixabay.com/api/']);
    }

    public function searchImages($query)
    {
        try {
            $response = $this->httpClient->request('GET', '', [
                'query' => [
                    'key' => $this->apiKey,
                    'q' => $query,
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Log or handle the error appropriately
            return ['error' => 'An error occurred while fetching images.'];
        }

    }

    public function searchVideos($query)
    {
        try {
            $response = $this->httpClient->request('GET', 'videos/', [
                'query' => [
                    'key' => $this->apiKey,
                    'q' => $query,
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Log or handle the error appropriately
            return ['error' => 'An error occurred while fetching videos.'];
        }
    }
}
