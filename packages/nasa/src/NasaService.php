<?php

namespace OpenCompany\Integrations\Nasa;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NasaService
{
    /**
     * Create a new NasaService instance.
     *
     * @param  string  $apiKey  NASA API key (defaults to DEMO_KEY for public access).
     * @param  string  $baseUrl  Base URL for the NASA API (defaults to https://api.nasa.gov).
     */
    public function __construct(
        private string $apiKey = 'DEMO_KEY',
        private string $baseUrl = 'https://api.nasa.gov',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the Astronomy Picture of the Day (APOD).
     *
     * @param  string|null  $date  A specific date in YYYY-MM-DD format (defaults to today).
     * @param  string|null  $startDate  Start date for a date range in YYYY-MM-DD format.
     * @param  string|null  $endDate  End date for a date range in YYYY-MM-DD format.
     * @return array<string, mixed>|array<int, array<string, mixed>> A single APOD entry or a list when using date ranges.
     */
    public function getApod(?string $date = null, ?string $startDate = null, ?string $endDate = null): array
    {
        $params = [];
        if ($date !== null) {
            $params['date'] = $date;
        }
        if ($startDate !== null) {
            $params['start_date'] = $startDate;
        }
        if ($endDate !== null) {
            $params['end_date'] = $endDate;
        }

        return $this->request('GET', '/planetary/apod', $params);
    }

    /**
     * Get Mars Rover Photos.
     *
     * @param  string  $rover  The rover name: "curiosity", "opportunity", "spirit", or "perseverance".
     * @param  int|null  $sol  The sol (Martian day) number.
     * @param  string|null  $earthDate  Earth date in YYYY-MM-DD format.
     * @param  string|null  $camera  Camera abbreviation: FHAZ, RHAZ, MAST, CHEMCAM, MAHLI, MARDI, NAVCAM, PANCAM, MINITES, ENTRY, HAZCAM, SKYCAM, SHERLOCWATSON, SUPERCAM, MCZ_LEFT, MCZ_RIGHT, FRONT_HAZCAM_LEFT_A, FRONT_HAZCAM_RIGHT_A, REAR_HAZCAM_LEFT, REAR_HAZCAM_RIGHT.
     * @param  int|null  $page  Page number for pagination (default 1).
     * @return array<string, mixed> The photos response.
     */
    public function getMarsRoverPhotos(string $rover, ?int $sol = null, ?string $earthDate = null, ?string $camera = null, ?int $page = null): array
    {
        $params = [];
        if ($sol !== null) {
            $params['sol'] = $sol;
        }
        if ($earthDate !== null) {
            $params['earth_date'] = $earthDate;
        }
        if ($camera !== null) {
            $params['camera'] = $camera;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/mars-photos/api/v1/rovers/' . urlencode($rover) . '/photos', $params);
    }

    /**
     * Get a feed of Near Earth Objects (asteroids) for a date range.
     *
     * @param  string|null  $startDate  Start date in YYYY-MM-DD format (defaults to today).
     * @param  string|null  $endDate  End date in YYYY-MM-DD format (max 7 days after start_date).
     * @return array<string, mixed> The asteroid feed response.
     */
    public function getAsteroids(?string $startDate = null, ?string $endDate = null): array
    {
        $params = [];
        if ($startDate !== null) {
            $params['start_date'] = $startDate;
        }
        if ($endDate !== null) {
            $params['end_date'] = $endDate;
        }

        return $this->request('GET', '/neo/rest/v1/feed', $params);
    }

    /**
     * Get details for a specific Near Earth Object (asteroid) by its ID.
     *
     * @param  string  $id  The asteroid's unique NASA ID (e.g., "2534304").
     * @return array<string, mixed> The asteroid details.
     */
    public function getAsteroid(string $id): array
    {
        return $this->request('GET', '/neo/rest/v1/neo/' . urlencode($id));
    }

    /**
     * Search the NASA Image and Video Library.
     *
     * @param  string  $q  The search query string.
     * @param  string|null  $mediaType  Filter by media type: "image", "video", or "audio".
     * @param  int|null  $page  Page number (default 1).
     * @return array<string, mixed> The search results.
     */
    public function searchImages(string $q, ?string $mediaType = null, ?int $page = null): array
    {
        $params = ['q' => $q];
        if ($mediaType !== null) {
            $params['media_type'] = $mediaType;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }

        // NASA Image API is hosted at a different base URL
        $baseUrl = rtrim($this->baseUrl, '/');

        try {
            $http = Http::timeout(30);
            $response = $http->get($baseUrl . '/search', $params);

            if (!$response->successful()) {
                $error = $response->body();
                Log::error("NASA Image API error: GET /search", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("NASA Image API error ({$response->status()}): " . $error);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("NASA Image API connection error: GET /search", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to NASA Image API: {$e->getMessage()}");
        }
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed> Parsed JSON response body.
     */
    private function request(string $method, string $path, array $params = []): array
    {
        $response = $this->rawRequest($method, $path, $params);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the NASA API.
     *
     * Appends the api_key query parameter to every request for authentication.
     *
     * @param  string  $method  HTTP method (GET, POST).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException When the API key is missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $params = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('NASA API key is not configured.');
        }

        $url = $this->baseUrl . $path;
        $params['api_key'] = $this->apiKey;

        try {
            $http = Http::timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $json = $response->json();
                $error = $json['error']['message'] ?? $json['msg'] ?? $response->body();

                Log::error("NASA API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("NASA API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("NASA API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to NASA API: {$e->getMessage()}");
        }
    }
}
