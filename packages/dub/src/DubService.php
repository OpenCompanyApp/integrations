<?php

namespace OpenCompany\Integrations\Dub;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DubService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.dub.co',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List links (short URLs).
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $pageSize  Number of results per page.
     * @param  string|null  $search  Search query to filter links.
     * @param  string|null  $domain  Filter by domain.
     * @param  string|null  $tagId  Filter by tag ID.
     * @return array<string, mixed>
     */
    public function listLinks(int $page = 1, int $pageSize = 50, ?string $search = null, ?string $domain = null, ?string $tagId = null): array
    {
        $params = [
            'page' => $page,
            'pageSize' => $pageSize,
        ];

        if ($search !== null) {
            $params['search'] = $search;
        }
        if ($domain !== null) {
            $params['domain'] = $domain;
        }
        if ($tagId !== null) {
            $params['tagId'] = $tagId;
        }

        return $this->request('GET', '/links', $params);
    }

    /**
     * Get a single link by ID.
     *
     * @param  string  $id  The link ID.
     * @return array<string, mixed>
     */
    public function getLink(string $id): array
    {
        return $this->request('GET', '/links/' . urlencode($id));
    }

    /**
     * Create a new short link.
     *
     * @param  string  $url  The destination URL.
     * @param  string|null  $domain  The domain for the short link.
     * @param  string|null  $key  The custom key (back-half) for the short link.
     * @param  string|null  $title  Optional title for the link.
     * @param  string|null  $description  Optional description.
     * @param  array<string>|null  $tags  Optional array of tag names.
     * @return array<string, mixed>
     */
    public function createLink(string $url, ?string $domain = null, ?string $key = null, ?string $title = null, ?string $description = null, ?array $tags = null): array
    {
        $data = ['url' => $url];

        if ($domain !== null) {
            $data['domain'] = $domain;
        }
        if ($key !== null) {
            $data['key'] = $key;
        }
        if ($title !== null) {
            $data['title'] = $title;
        }
        if ($description !== null) {
            $data['description'] = $description;
        }
        if ($tags !== null) {
            $data['tags'] = $tags;
        }

        return $this->request('POST', '/links', $data);
    }

    /**
     * List domains.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $pageSize  Number of results per page.
     * @return array<string, mixed>
     */
    public function listDomains(int $page = 1, int $pageSize = 50): array
    {
        return $this->request('GET', '/domains', [
            'page' => $page,
            'pageSize' => $pageSize,
        ]);
    }

    /**
     * Get a single domain by ID.
     *
     * @param  string  $id  The domain ID (slug or UUID).
     * @return array<string, mixed>
     */
    public function getDomain(string $id): array
    {
        return $this->request('GET', '/domains/' . urlencode($id));
    }

    /**
     * List tags.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $pageSize  Number of results per page.
     * @param  string|null  $search  Search query to filter tags.
     * @return array<string, mixed>
     */
    public function listTags(int $page = 1, int $pageSize = 50, ?string $search = null): array
    {
        $params = [
            'page' => $page,
            'pageSize' => $pageSize,
        ];

        if ($search !== null) {
            $params['search'] = $search;
        }

        return $this->request('GET', '/tags', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Dub.co API.
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
            throw new \RuntimeException('Dub.co access token is not configured.');
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
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Dub.co API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Dub.co API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be down.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Dub.co API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Dub.co API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Dub.co API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Dub.co API: {$e->getMessage()}");
        }
    }
}
