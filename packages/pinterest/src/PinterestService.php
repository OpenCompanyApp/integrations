<?php

namespace OpenCompany\Integrations\Pinterest;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PinterestService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.pinterest.com/v5',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List pins for the authenticated user.
     *
     * @param  string|null  $bookmark  Cursor for pagination.
     * @param  int|null     $pageSize  Number of pins to return per page.
     * @return array<string, mixed>
     */
    public function listPins(?string $bookmark = null, ?int $pageSize = null): array
    {
        $params = [];
        if ($bookmark !== null) {
            $params['bookmark'] = $bookmark;
        }
        if ($pageSize !== null) {
            $params['page_size'] = $pageSize;
        }

        return $this->request('GET', '/pins', $params);
    }

    /**
     * Get a single pin by ID.
     *
     * @param  string  $pinId  The pin ID.
     * @return array<string, mixed>
     */
    public function getPin(string $pinId): array
    {
        return $this->request('GET', '/pins/' . urlencode($pinId));
    }

    /**
     * Create a new pin.
     *
     * @param  string  $boardId   The board ID to pin to.
     * @param  string  $title     The pin title.
     * @param  string  $description  The pin description.
     * @param  string  $mediaSource  The media source type (e.g., "image_url").
     * @param  string  $imageUrl  The image URL for the pin.
     * @param  string|null  $link     Optional destination link.
     * @return array<string, mixed>
     */
    public function createPin(
        string $boardId,
        string $title,
        string $description,
        string $mediaSource,
        string $imageUrl,
        ?string $link = null,
    ): array {
        $body = [
            'board_id' => $boardId,
            'title' => $title,
            'description' => $description,
            'media_source' => [
                'source_type' => $mediaSource,
                'url' => $imageUrl,
            ],
        ];

        if ($link !== null) {
            $body['link'] = $link;
        }

        return $this->request('POST', '/pins', $body);
    }

    /**
     * List boards for the authenticated user.
     *
     * @param  string|null  $bookmark  Cursor for pagination.
     * @param  int|null     $pageSize  Number of boards to return per page.
     * @return array<string, mixed>
     */
    public function listBoards(?string $bookmark = null, ?int $pageSize = null): array
    {
        $params = [];
        if ($bookmark !== null) {
            $params['bookmark'] = $bookmark;
        }
        if ($pageSize !== null) {
            $params['page_size'] = $pageSize;
        }

        return $this->request('GET', '/boards', $params);
    }

    /**
     * Get a single board by ID.
     *
     * @param  string  $boardId  The board ID.
     * @return array<string, mixed>
     */
    public function getBoard(string $boardId): array
    {
        return $this->request('GET', '/boards/' . urlencode($boardId));
    }

    /**
     * List ad campaigns for the authenticated user.
     *
     * @param  string|null  $adAccountId  The ad account ID.
     * @param  string|null  $bookmark     Cursor for pagination.
     * @param  int|null     $pageSize     Number of campaigns to return per page.
     * @return array<string, mixed>
     */
    public function listCampaigns(?string $adAccountId = null, ?string $bookmark = null, ?int $pageSize = null): array
    {
        if ($adAccountId === null) {
            throw new \RuntimeException('An ad account ID is required to list campaigns.');
        }

        $params = [];
        if ($bookmark !== null) {
            $params['bookmark'] = $bookmark;
        }
        if ($pageSize !== null) {
            $params['page_size'] = $pageSize;
        }

        return $this->request('GET', "/ad_accounts/{$adAccountId}/campaigns", $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user_account');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. "/v5/pins").
     * @param  array   $data    Query params (GET) or body data (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Pinterest API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Query params or body data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Pinterest access token is not configured.');
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
                    Log::warning("Pinterest API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Pinterest API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Pinterest API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Pinterest API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Pinterest API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Pinterest API: {$e->getMessage()}");
        }
    }
}
