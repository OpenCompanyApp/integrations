<?php

namespace OpenCompany\Integrations\CalCom;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Cal.com v2 API service for managing event types, bookings, teams, and user information.
 *
 * Communicates with the Cal.com v2 REST API using Bearer token authentication.
 * Supports configurable base URL for self-hosted Cal.com instances.
 *
 * @see https://developer.cal.com/api
 */
class CalComService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.cal.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List event types with optional filtering and pagination.
     *
     * @param  int|null  $limit   Maximum number of results per page.
     * @param  int|null  $page    Page number for pagination.
     * @param  int|null  $teamId  Filter event types belonging to a specific team.
     * @return array<string, mixed> API response containing event types.
     */
    public function listEventTypes(?int $limit = null, ?int $page = null, ?int $teamId = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($teamId !== null) {
            $params['teamId'] = $teamId;
        }

        return $this->request('GET', '/event-types', $params);
    }

    /**
     * Get a single event type by its ID.
     *
     * @param  int  $id  The event type ID.
     * @return array<string, mixed> API response containing the event type.
     */
    public function getEventType(int $id): array
    {
        return $this->request('GET', '/event-types/' . $id);
    }

    /**
     * List bookings with optional filtering and pagination.
     *
     * @param  int|null     $limit        Maximum number of results per page.
     * @param  int|null     $page         Page number for pagination.
     * @param  string|null  $status       Filter by booking status (e.g., "confirmed", "cancelled", "pending").
     * @param  int|null     $eventTypeId  Filter bookings for a specific event type.
     * @return array<string, mixed> API response containing bookings.
     */
    public function listBookings(?int $limit = null, ?int $page = null, ?string $status = null, ?int $eventTypeId = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }
        if ($eventTypeId !== null) {
            $params['eventTypeId'] = $eventTypeId;
        }

        return $this->request('GET', '/bookings', $params);
    }

    /**
     * Get a single booking by its ID.
     *
     * @param  int  $id  The booking ID.
     * @return array<string, mixed> API response containing the booking.
     */
    public function getBooking(int $id): array
    {
        return $this->request('GET', '/bookings/' . $id);
    }

    /**
     * Create a new booking.
     *
     * @param  int     $eventTypeId  The event type to book.
     * @param  string  $start        Start time in ISO 8601 format (e.g., "2026-04-10T09:00:00Z").
     * @param  string  $end          End time in ISO 8601 format (e.g., "2026-04-10T09:30:00Z").
     * @param  array   $responses    Attendee responses (name, email, etc.).
     * @return array<string, mixed> API response containing the created booking.
     */
    public function createBooking(int $eventTypeId, string $start, string $end, array $responses): array
    {
        return $this->request('POST', '/bookings', [
            'eventTypeId' => $eventTypeId,
            'start' => $start,
            'end' => $end,
            'responses' => $responses,
        ]);
    }

    /**
     * List teams with optional pagination.
     *
     * @param  int|null  $limit  Maximum number of results per page.
     * @param  int|null  $page   Page number for pagination.
     * @return array<string, mixed> API response containing teams.
     */
    public function listTeams(?int $limit = null, ?int $page = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/teams', $params);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed> API response containing the user profile.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g., "/bookings").
     * @param  array   $data    Query parameters or request body.
     * @return array<string, mixed> Parsed JSON response.
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
     * Make a raw HTTP request to the Cal.com v2 API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Query parameters or request body.
     * @return \Illuminate\Http\Client\Response Raw HTTP response.
     *
     * @throws \RuntimeException When the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Cal.com access token is not configured.');
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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Cal.com API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Cal.com API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Cal.com API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Cal.com API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Cal.com API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Cal.com API: {$e->getMessage()}");
        }
    }
}
