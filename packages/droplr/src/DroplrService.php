<?php

namespace OpenCompany\Integrations\Droplr;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DroplrService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.droplr.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List drops with optional filtering and pagination.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @param  string|null  $type  Filter by drop type (e.g., "LINK", "IMAGE", "FILE", "NOTE").
     * @param  string|null  $query  Search query to filter drops.
     * @return array<string, mixed>
     */
    public function listDrops(int $page = 1, int $limit = 20, ?string $type = null, ?string $query = null): array
    {
        $params = [
            'page' => $page,
            'limit' => $limit,
        ];

        if ($type !== null) {
            $params['type'] = $type;
        }

        if ($query !== null) {
            $params['q'] = $query;
        }

        return $this->request('GET', '/v2/drops', $params);
    }

    /**
     * Get a single drop by its ID.
     *
     * @param  string  $id  The drop ID.
     * @return array<string, mixed>
     */
    public function getDrop(string $id): array
    {
        return $this->request('GET', '/v2/drops/' . urlencode($id));
    }

    /**
     * Create a new drop (short link).
     *
     * @param  string  $link  The long URL to shorten.
     * @param  string|null  $title  Optional title for the drop.
     * @param  string|null  $variant  Optional variant (e.g., "redirect", "frame").
     * @return array<string, mixed>
     */
    public function createDrop(string $link, ?string $title = null, ?string $variant = null): array
    {
        $data = ['link' => $link];

        if ($title !== null) {
            $data['title'] = $title;
        }

        if ($variant !== null) {
            $data['variant'] = $variant;
        }

        return $this->request('POST', '/v2/drops', $data);
    }

    /**
     * Delete a drop by its ID.
     *
     * @param  string  $id  The drop ID.
     */
    public function deleteDrop(string $id): void
    {
        $this->request('DELETE', '/v2/drops/' . urlencode($id));
    }

    /**
     * List boards with optional pagination.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @return array<string, mixed>
     */
    public function listBoards(int $page = 1, int $limit = 20): array
    {
        return $this->request('GET', '/v2/boards', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/v2/drops").
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Droplr API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Droplr access token is not configured.');
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
                    Log::warning("Droplr API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Droplr API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Droplr API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Droplr API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Droplr API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Droplr API: {$e->getMessage()}");
        }
    }
}
