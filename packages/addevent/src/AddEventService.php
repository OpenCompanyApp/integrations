<?php

namespace OpenCompany\Integrations\AddEvent;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the AddEvent Calendar and Events API v2.
 *
 * Handles Bearer API key authentication, JSON requests, and error
 * normalization for event and calendar resources.
 */
class AddEventService
{
    /**
     * @param  string  $accessToken  AddEvent API key used as a Bearer token.
     * @param  string  $baseUrl  Base URL for the Calendar and Events API v2.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.addevent.com/calevent/v2',
    ) {
        $this->baseUrl = $this->normalizeBaseUrl($this->baseUrl);
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * Search events created in AddEvent.
     *
     * @param  int  $page  Page number, starting at 1.
     * @param  int  $pageSize  Number of results per page, 1-20.
     * @param  string|null  $calendarId  Optional calendar ID filter.
     * @param  string|null  $sortBy  Optional sort field.
     * @param  string|null  $sortOrder  Optional sort order.
     * @return array<string, mixed>
     */
    public function listEvents(int $page = 1, int $pageSize = 10, ?string $calendarId = null, ?string $sortBy = null, ?string $sortOrder = null): array
    {
        $params = $this->paginationParams($page, $pageSize, $sortBy, $sortOrder);
        if ($calendarId !== null && $calendarId !== '') {
            $params['calendar_id'] = $calendarId;
        }

        return $this->request('GET', '/events', $params);
    }

    /**
     * Retrieve a single AddEvent event.
     *
     * @param  string  $id  Event ID.
     * @return array<string, mixed>
     */
    public function getEvent(string $id): array
    {
        return $this->request('GET', '/events/' . rawurlencode($id));
    }

    /**
     * Create a new event on an AddEvent calendar.
     *
     * @param  array<string, mixed>  $attributes  AddEvent event attributes.
     * @return array<string, mixed>
     */
    public function createEvent(array $attributes): array
    {
        return $this->request('POST', '/events', $this->filterEmpty($attributes));
    }

    /**
     * Update an existing AddEvent event.
     *
     * @param  string  $id  Event ID.
     * @param  array<string, mixed>  $attributes  Event attributes to patch.
     * @return array<string, mixed>
     */
    public function updateEvent(string $id, array $attributes): array
    {
        return $this->request('PATCH', '/events/' . rawurlencode($id), $this->filterEmpty($attributes));
    }

    /**
     * Delete an AddEvent event.
     *
     * @param  string  $id  Event ID.
     * @return array<string, mixed>
     */
    public function deleteEvent(string $id): array
    {
        return $this->request('DELETE', '/events/' . rawurlencode($id));
    }

    /**
     * Search calendars created in AddEvent.
     *
     * @param  int  $page  Page number, starting at 1.
     * @param  int  $pageSize  Number of results per page, 1-20.
     * @param  array<int, string>  $calendarIds  Optional calendar ID filter.
     * @param  string|null  $sortBy  Optional sort field.
     * @param  string|null  $sortOrder  Optional sort order.
     * @return array<string, mixed>
     */
    public function listCalendars(int $page = 1, int $pageSize = 10, array $calendarIds = [], ?string $sortBy = null, ?string $sortOrder = null): array
    {
        $params = $this->paginationParams($page, $pageSize, $sortBy, $sortOrder);
        if ($calendarIds !== []) {
            $params['calendar_ids'] = implode(',', $calendarIds);
        }

        return $this->request('GET', '/calendars', $params);
    }

    /**
     * Retrieve a single AddEvent calendar.
     *
     * @param  string  $id  Calendar ID.
     * @return array<string, mixed>
     */
    public function getCalendar(string $id): array
    {
        return $this->request('GET', '/calendars/' . rawurlencode($id));
    }

    /**
     * Create a new AddEvent calendar.
     *
     * @param  array<string, mixed>  $attributes  Calendar attributes.
     * @return array<string, mixed>
     */
    public function createCalendar(array $attributes): array
    {
        return $this->request('POST', '/calendars', $this->filterEmpty($attributes));
    }

    /**
     * List supported AddEvent timezones.
     *
     * @return array<string, mixed>
     */
    public function listTimezones(): array
    {
        return $this->request('GET', '/timezones');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
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
     * Make a raw HTTP request to the AddEvent API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('AddEvent API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? $response->body();

                Log::error("AddEvent API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $body,
                ]);

                throw new \RuntimeException('AddEvent API error (' . $response->status() . '): ' . (is_string($body) ? $body : json_encode($body)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("AddEvent API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to AddEvent API: {$e->getMessage()}");
        }
    }

    /**
     * Build validated pagination and sorting query parameters.
     *
     * @return array<string, mixed>
     */
    private function paginationParams(int $page, int $pageSize, ?string $sortBy, ?string $sortOrder): array
    {
        $params = [
            'page' => max(1, $page),
            'page_size' => min(max(1, $pageSize), 20),
        ];

        if ($sortBy !== null && $sortBy !== '') {
            $params['sort_by'] = $sortBy;
        }
        if ($sortOrder !== null && $sortOrder !== '') {
            $params['sort_order'] = $sortOrder;
        }

        return $params;
    }

    /**
     * Remove null and empty string values from JSON payloads.
     *
     * @param  array<string, mixed>  $attributes
     * @return array<string, mixed>
     */
    private function filterEmpty(array $attributes): array
    {
        return array_filter($attributes, static fn ($value): bool => $value !== null && $value !== '');
    }

    /**
     * Normalize root and legacy API URLs to the v2 Calendar and Events base URL.
     */
    private function normalizeBaseUrl(string $baseUrl): string
    {
        $baseUrl = rtrim($baseUrl, '/');

        return str_ends_with($baseUrl, '/calevent/v2') ? $baseUrl : $baseUrl . '/calevent/v2';
    }
}
