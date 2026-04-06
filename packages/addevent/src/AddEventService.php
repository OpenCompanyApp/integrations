<?php

namespace OpenCompany\Integrations\AddEvent;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AddEventService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.addevent.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List events with optional pagination and category filtering.
     *
     * @param  int  $limit   Number of events per page (default 50).
     * @param  int  $page    Page number (1-indexed).
     * @param  int|null  $categoryId  Optional category filter.
     * @return array<string, mixed>
     */
    public function listEvents(int $limit = 50, int $page = 1, ?int $categoryId = null): array
    {
        $params = ['limit' => $limit, 'page' => $page];
        if ($categoryId !== null) {
            $params['category'] = $categoryId;
        }

        return $this->request('GET', '/v1/events', $params);
    }

    /**
     * Get a single event by ID.
     *
     * @param  int  $id  The event ID.
     * @return array<string, mixed>
     */
    public function getEvent(int $id): array
    {
        return $this->request('GET', '/v1/events/' . $id);
    }

    /**
     * Create a new event.
     *
     * @param  string  $title        Event title.
     * @param  string  $startDate    Start date/time (e.g., "2026-04-10T09:00:00").
     * @param  string  $endDate      End date/time (e.g., "2026-04-10T10:00:00").
     * @param  string|null  $location     Optional location.
     * @param  string|null  $description  Optional description.
     * @param  int|null  $categoryId   Optional category ID.
     * @return array<string, mixed>
     */
    public function createEvent(
        string $title,
        string $startDate,
        string $endDate,
        ?string $location = null,
        ?string $description = null,
        ?int $categoryId = null,
    ): array {
        $data = [
            'title' => $title,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        if ($location !== null) {
            $data['location'] = $location;
        }
        if ($description !== null) {
            $data['description'] = $description;
        }
        if ($categoryId !== null) {
            $data['category_id'] = $categoryId;
        }

        return $this->request('POST', '/v1/events', $data);
    }

    /**
     * List all categories.
     *
     * @return array<string, mixed>
     */
    public function listCategories(): array
    {
        return $this->request('GET', '/v1/categories');
    }

    /**
     * List groups with optional pagination.
     *
     * @param  int  $limit  Number of groups per page (default 50).
     * @param  int  $page   Page number (1-indexed).
     * @return array<string, mixed>
     */
    public function listGroups(int $limit = 50, int $page = 1): array
    {
        return $this->request('GET', '/v1/groups', ['limit' => $limit, 'page' => $page]);
    }

    /**
     * Get a single group by ID.
     *
     * @param  int  $id  The group ID.
     * @return array<string, mixed>
     */
    public function getGroup(int $id): array
    {
        return $this->request('GET', '/v1/groups/' . $id);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g., "/v1/events").
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the AddEvent API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('AddEvent access token is not configured.');
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
                    Log::warning("AddEvent API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("AddEvent API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("AddEvent API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("AddEvent API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("AddEvent API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to AddEvent API: {$e->getMessage()}");
        }
    }
}
