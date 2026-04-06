<?php

namespace OpenCompany\Integrations\Mux;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Mux API service for managing video assets and live streams.
 *
 * Handles authentication via Bearer token and provides methods for all
 * Mux API operations used by the integration tools.
 */
class MuxService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.mux.com',
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
     * List video assets.
     *
     * @param  int  $limit  Maximum number of assets to return (1–100, default 25).
     * @param  int  $page   Page offset (0-indexed, default 0).
     * @return array<string, mixed>
     */
    public function listAssets(int $limit = 25, int $page = 0): array
    {
        return $this->request('GET', '/api/v1/assets', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Retrieve a single asset by ID.
     *
     * @param  string  $id  The asset ID.
     * @return array<string, mixed>
     */
    public function getAsset(string $id): array
    {
        return $this->request('GET', '/api/v1/assets/' . urlencode($id));
    }

    /**
     * Create a new asset.
     *
     * @param  string  $input            The URL of the input video file.
     * @param  array<string, mixed>|null $playbackPolicy  Playback policy, e.g. ["public"] or ["signed"].
     * @return array<string, mixed>
     */
    public function createAsset(string $input, ?array $playbackPolicy = null): array
    {
        $data = ['input' => $input];
        if ($playbackPolicy !== null) {
            $data['playback_policy'] = $playbackPolicy;
        }

        return $this->request('POST', '/api/v1/assets', $data);
    }

    /**
     * List live streams.
     *
     * @param  int  $limit  Maximum number of live streams to return (1–100, default 25).
     * @param  int  $page   Page offset (0-indexed, default 0).
     * @return array<string, mixed>
     */
    public function listLiveStreams(int $limit = 25, int $page = 0): array
    {
        return $this->request('GET', '/api/v1/live-streams', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Retrieve a single live stream by ID.
     *
     * @param  string  $id  The live stream ID.
     * @return array<string, mixed>
     */
    public function getLiveStream(string $id): array
    {
        return $this->request('GET', '/api/v1/live-streams/' . urlencode($id));
    }

    /**
     * Create a new live stream.
     *
     * @param  array<string, mixed>|null $playbackPolicy     Playback policy, e.g. ["public"] or ["signed"].
     * @param  array<string, mixed>|null $newAssetSettings   Settings applied to assets created from this live stream.
     * @return array<string, mixed>
     */
    public function createLiveStream(?array $playbackPolicy = null, ?array $newAssetSettings = null): array
    {
        $data = [];
        if ($playbackPolicy !== null) {
            $data['playback_policy'] = $playbackPolicy;
        }
        if ($newAssetSettings !== null) {
            $data['new_asset_settings'] = $newAssetSettings;
        }

        return $this->request('POST', '/api/v1/live-streams', $data);
    }

    /**
     * Get realtime data (current viewer counts across all properties).
     *
     * @return array<string, mixed>
     */
    public function getRealtime(): array
    {
        return $this->request('GET', '/data/v1/realtime');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g. /api/v1/assets).
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Mux API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the request fails or the service is not configured.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Mux access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Mux API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Mux API endpoint not available (HTTP {$response->status()}). Check your base URL and access token.");
                }

                $error = $response->json('error') ?? $response->json('errors') ?? $body;
                Log::error("Mux API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Mux API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mux API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Mux API: {$e->getMessage()}");
        }
    }
}
