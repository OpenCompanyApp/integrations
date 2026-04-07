<?php

namespace OpenCompany\Integrations\TikTok;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TiktokService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://business-api.tiktok.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List videos for an advertiser.
     *
     * @param  string  $advertiserId  The TikTok advertiser ID.
     * @param  array<string, mixed>  $params  Optional query parameters (e.g. fields, page, page_size).
     * @return array<string, mixed>
     */
    public function listVideos(string $advertiserId, array $params = []): array
    {
        $params['advertiser_id'] = $advertiserId;

        return $this->request('GET', '/file/video/search/', $params);
    }

    /**
     * Get details for a single video.
     *
     * @param  string  $advertiserId  The TikTok advertiser ID.
     * @param  string  $videoId  The video ID.
     * @param  array<string, mixed>  $params  Optional query parameters.
     * @return array<string, mixed>
     */
    public function getVideo(string $advertiserId, string $videoId, array $params = []): array
    {
        $params['advertiser_id'] = $advertiserId;
        $params['video_id'] = $videoId;

        return $this->request('GET', '/file/video/info/', $params);
    }

    /**
     * Upload a video to TikTok.
     *
     * @param  string  $advertiserId  The TikTok advertiser ID.
     * @param  string  $videoUrl  The URL of the video to upload.
     * @param  array<string, mixed>  $params  Additional parameters (e.g. file_name, auto_fix_enabled).
     * @return array<string, mixed>
     */
    public function uploadVideo(string $advertiserId, string $videoUrl, array $params = []): array
    {
        $params['advertiser_id'] = $advertiserId;
        $params['video_url'] = $videoUrl;

        return $this->request('POST', '/file/video/ad/upload/', $params);
    }

    /**
     * List campaigns for an advertiser.
     *
     * @param  string  $advertiserId  The TikTok advertiser ID.
     * @param  array<string, mixed>  $params  Optional query parameters (e.g. page, page_size, filtering).
     * @return array<string, mixed>
     */
    public function listCampaigns(string $advertiserId, array $params = []): array
    {
        $params['advertiser_id'] = $advertiserId;

        return $this->request('GET', '/campaign/get/', $params);
    }

    /**
     * Get details for a single campaign.
     *
     * @param  string  $advertiserId  The TikTok advertiser ID.
     * @param  string  $campaignId  The campaign ID.
     * @param  array<string, mixed>  $params  Optional query parameters.
     * @return array<string, mixed>
     */
    public function getCampaign(string $advertiserId, string $campaignId, array $params = []): array
    {
        $params['advertiser_id'] = $advertiserId;
        $params['campaign_ids'] = json_encode([$campaignId]);

        return $this->request('GET', '/campaign/get/', $params);
    }

    /**
     * List advertisers accessible to the authenticated user.
     *
     * @param  array<string, mixed>  $params  Optional query parameters.
     * @return array<string, mixed>
     */
    public function listAdvertisers(array $params = []): array
    {
        return $this->request('GET', '/oauth2/advertiser/get/', $params);
    }

    /**
     * Get the current authenticated user's information.
     *
     * @param  array<string, mixed>  $params  Optional query parameters.
     * @return array<string, mixed>
     */
    public function getCurrentUser(array $params = []): array
    {
        return $this->request('GET', '/user/info/', $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/user/info/").
     * @param  array<string, mixed>  $data  Query or body parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the TikTok Business API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query or body parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('TikTok access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Access-Token' => $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $json = $response->json();
                $error = $json['message'] ?? $json['error'] ?? $response->body();

                Log::error("TikTok API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("TikTok API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("TikTok API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to TikTok API: {$e->getMessage()}");
        }
    }
}
