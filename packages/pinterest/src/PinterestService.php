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
     * Get the current authenticated user's account information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user_account');
    }

    /**
     * List all boards for the authenticated user.
     *
     * @param  int  $limit  Maximum number of boards to return (default: 25, max: 250).
     * @param  string|null  $bookmark  Cursor for pagination — pass the bookmark from a previous response.
     * @return array<string, mixed>
     */
    public function listBoards(int $limit = 25, ?string $bookmark = null): array
    {
        $params = ['page_size' => $limit];
        if ($bookmark) {
            $params['bookmark'] = $bookmark;
        }

        return $this->request('GET', '/boards', $params);
    }

    /**
     * Get details for a specific board.
     *
     * @param  string  $boardId  The unique identifier of the board.
     * @return array<string, mixed>
     */
    public function getBoard(string $boardId): array
    {
        return $this->request('GET', '/boards/' . urlencode($boardId));
    }

    /**
     * Create a new board.
     *
     * @param  string  $name  The name of the board.
     * @param  string|null  $description  An optional description for the board.
     * @return array<string, mixed>
     */
    public function createBoard(string $name, ?string $description = null): array
    {
        $data = ['name' => $name];
        if ($description !== null) {
            $data['description'] = $description;
        }

        return $this->request('POST', '/boards', $data);
    }

    /**
     * List pins on a specific board.
     *
     * @param  string  $boardId  The unique identifier of the board.
     * @param  int  $limit  Maximum number of pins to return (default: 25, max: 250).
     * @param  string|null  $bookmark  Cursor for pagination.
     * @return array<string, mixed>
     */
    public function listPins(string $boardId, int $limit = 25, ?string $bookmark = null): array
    {
        $params = ['page_size' => $limit];
        if ($bookmark) {
            $params['bookmark'] = $bookmark;
        }

        return $this->request('GET', '/boards/' . urlencode($boardId) . '/pins', $params);
    }

    /**
     * Create a new pin on a board.
     *
     * @param  string  $boardId  The board to pin to.
     * @param  string  $title  The title of the pin.
     * @param  string  $imageUrl  The URL of the image to pin.
     * @param  string|null  $description  An optional description for the pin.
     * @param  string|null  $link  An optional destination link for the pin.
     * @return array<string, mixed>
     */
    public function createPin(string $boardId, string $title, string $imageUrl, ?string $description = null, ?string $link = null): array
    {
        $data = [
            'board_id' => $boardId,
            'title' => $title,
            'media_source' => [
                'source_type' => 'image_url',
                'url' => $imageUrl,
            ],
        ];

        if ($description !== null) {
            $data['description'] = $description;
        }

        if ($link !== null) {
            $data['link'] = $link;
        }

        return $this->request('POST', '/pins', $data);
    }

    /**
     * Delete a pin.
     *
     * @param  string  $pinId  The unique identifier of the pin to delete.
     */
    public function deletePin(string $pinId): void
    {
        $this->request('DELETE', '/pins/' . urlencode($pinId));
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
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
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
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
                    throw new \RuntimeException("Pinterest API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the token may be invalid.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
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
