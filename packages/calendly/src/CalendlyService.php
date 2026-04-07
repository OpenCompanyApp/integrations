<?php

namespace OpenCompany\Integrations\Calendly;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Calendly API v2.
 *
 * Wraps HTTP calls to Calendly's REST endpoints for event types,
 * bookings (scheduled events), organizations, and users.
 *
 * @see https://developer.calendly.com/api-docs
 */
class CalendlyService
{
    private const BASE_URL = 'https://api.calendly.com/v2';

    /**
     * @param  string  $accessToken  Calendly Personal Access Token
     */
    public function __construct(
        private string $accessToken = '',
    ) {}

    /**
     * Check whether the access token has been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Current User ────────────────────────────────────────

    /**
     * Get the authenticated user's profile (GET /users/me).
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── Users ───────────────────────────────────────────────

    /**
     * List users (organization memberships) (GET /organization_memberships).
     *
     * @param  array<string, mixed>  $params  Query parameters (organization, user, page_token, count)
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/organization_memberships', $params);
    }

    // ── Event Types ─────────────────────────────────────────

    /**
     * List event types (GET /event_types).
     *
     * @param  array<string, mixed>  $params  Query parameters (user, active, organization, page_token, count)
     * @return array<string, mixed>
     */
    public function listEventTypes(array $params = []): array
    {
        return $this->request('GET', '/event_types', $params);
    }

    /**
     * Get a single event type by UUID (GET /event_types/{uuid}).
     *
     * @param  string  $uuid  The event type UUID
     * @return array<string, mixed>
     */
    public function getEventType(string $uuid): array
    {
        return $this->request('GET', "/event_types/{$uuid}");
    }

    // ── Bookings (Scheduled Events) ─────────────────────────

    /**
     * List scheduled events / bookings (GET /scheduled_events).
     *
     * @param  array<string, mixed>  $params  Query parameters (user, organization, status, min_start_time, max_start_time, page_token, count)
     * @return array<string, mixed>
     */
    public function listBookings(array $params = []): array
    {
        return $this->request('GET', '/scheduled_events', $params);
    }

    /**
     * Create a booking by creating a one-off event type (POST /one_off_event_types).
     *
     * Calendly does not have a direct "create booking" API. Instead, bookings
     * are created through scheduling URLs. This method creates a one-off event
     * type that generates a scheduling URL the invitee can use to book.
     *
     * @param  array<string, mixed>  $data  Body parameters (host, start_time, end_time, location, name)
     * @return array<string, mixed>
     */
    public function createBooking(array $data): array
    {
        return $this->request('POST', '/one_off_event_types', $data);
    }

    // ── Organizations ───────────────────────────────────────

    /**
     * List organizations the authenticated user belongs to (GET /organizations).
     *
     * @param  array<string, mixed>  $params  Query parameters (page_token)
     * @return array<string, mixed>
     */
    public function listOrganizations(array $params = []): array
    {
        return $this->request('GET', '/organizations', $params);
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Calendly.
     *
     * @param  string  $method  HTTP method (GET, POST)
     * @param  string  $path    API path (e.g. /users/me)
     * @param  array<string, mixed>  $data  Query parameters or JSON body
     * @return array<string, mixed>
     *
     * @throws \RuntimeException  If the token is missing or the request fails
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Calendly access token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['message'] ?? $body['title'] ?? $response->body();

                Log::error("Calendly API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Calendly API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Calendly API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Calendly API: {$e->getMessage()}");
        }
    }
}
