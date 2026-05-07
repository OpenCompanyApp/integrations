<?php

namespace OpenCompany\Integrations\Droplr;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for Droplr API operations.
 *
 * Provides the package's bearer-token API surface plus generic helpers for
 * documented Droplr endpoints that do not yet have dedicated wrappers.
 */
class DroplrService
{
    /**
     * @param  string  $accessToken  Droplr access token.
     * @param  string  $baseUrl  Base URL for the Droplr API.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.droplr.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * List drops with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters including page, limit, offset, amount, type, q, sortBy, order, since, and until.
     * @return array<string, mixed>
     */
    public function listDrops(array $params = []): array
    {
        return $this->request('GET', '/v2/drops', $this->cleanParams($params));
    }

    /**
     * Get a single drop by its ID or code.
     *
     * @param  string  $id  The drop ID or short code.
     * @return array<string, mixed>
     */
    public function getDrop(string $id): array
    {
        return $this->request('GET', '/v2/drops/' . rawurlencode($id));
    }

    /**
     * Create a new drop.
     *
     * @param  array<string, mixed>  $body  Drop creation payload.
     * @return array<string, mixed>
     */
    public function createDrop(array $body): array
    {
        return $this->request('POST', '/v2/drops', $body);
    }

    /**
     * Create a short-link drop.
     *
     * @param  string  $link  Long URL to shorten.
     * @param  string|null  $title  Optional title.
     * @param  string|null  $variant  Optional display variant.
     * @param  array<string, mixed>  $extra  Additional API-supported fields.
     * @return array<string, mixed>
     */
    public function createLinkDrop(string $link, ?string $title = null, ?string $variant = null, array $extra = []): array
    {
        return $this->createDrop($this->cleanParams($extra + [
            'link' => $link,
            'title' => $title,
            'variant' => $variant,
        ]));
    }

    /**
     * Create a note drop.
     *
     * @param  string  $content  Note content.
     * @param  string|null  $title  Optional title.
     * @param  string|null  $variant  Optional note variant.
     * @param  array<string, mixed>  $extra  Additional API-supported fields.
     * @return array<string, mixed>
     */
    public function createNoteDrop(string $content, ?string $title = null, ?string $variant = null, array $extra = []): array
    {
        return $this->createDrop($this->cleanParams($extra + [
            'type' => 'NOTE',
            'content' => $content,
            'title' => $title,
            'variant' => $variant,
        ]));
    }

    /**
     * Update a drop by its ID or code.
     *
     * @param  string  $id  The drop ID or short code.
     * @param  array<string, mixed>  $body  Drop update payload.
     * @return array<string, mixed>
     */
    public function updateDrop(string $id, array $body): array
    {
        return $this->request('PUT', '/v2/drops/' . rawurlencode($id), $body);
    }

    /**
     * Delete a drop by its ID or code.
     *
     * @param  string  $id  The drop ID or short code.
     * @return array<string, mixed>
     */
    public function deleteDrop(string $id): array
    {
        return $this->request('DELETE', '/v2/drops/' . rawurlencode($id));
    }

    /**
     * List boards with optional pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters including page and limit.
     * @return array<string, mixed>
     */
    public function listBoards(array $params = []): array
    {
        return $this->request('GET', '/v2/boards', $this->cleanParams($params));
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
     * Update account fields supported by the host Droplr API.
     *
     * @param  array<string, mixed>  $body  Account update payload.
     * @return array<string, mixed>
     */
    public function updateCurrentUser(array $body): array
    {
        return $this->request('PUT', '/v2/user', $body);
    }

    /**
     * Call a Droplr GET endpoint relative to the configured base URL.
     *
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $path, $params);
    }

    /**
     * Call a Droplr POST endpoint relative to the configured base URL.
     *
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $path, $body);
    }

    /**
     * Call a Droplr PUT endpoint relative to the configured base URL.
     *
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = []): array
    {
        return $this->request('PUT', $path, $body);
    }

    /**
     * Call a Droplr DELETE endpoint relative to the configured base URL.
     *
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $body  Optional JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = []): array
    {
        return $this->request('DELETE', $path, $body);
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
        if ($this->accessToken === '') {
            throw new \RuntimeException('Droplr access token is not configured.');
        }

        $url = $this->baseUrl . '/' . $this->normalizePath($path);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Droplr API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Droplr API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $response->header('x-droplr-errordetails') ?? $body;
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

    /**
     * Remove null and empty string values from request data.
     *
     * @param  array<string, mixed>  $params  Request parameters.
     * @return array<string, mixed>
     */
    private function cleanParams(array $params): array
    {
        return array_filter($params, static fn ($value): bool => $value !== null && $value !== '');
    }

    /**
     * Normalize a relative API path and reject absolute URLs.
     */
    private function normalizePath(string $path): string
    {
        $path = ltrim(trim($path), '/');

        if ($path === '') {
            throw new \InvalidArgumentException('Droplr API path is required.');
        }

        if (preg_match('#^https?://#i', $path) === 1) {
            throw new \InvalidArgumentException('Use a Droplr API path relative to the configured base URL.');
        }

        return $path;
    }
}
