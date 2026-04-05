<?php

namespace OpenCompany\Integrations\Calendly;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Calendly API v2.
 *
 * Wraps HTTP calls to Calendly's REST endpoints for users, event types,
 * scheduled events, invitees, organizations, and scheduling links.
 *
 * @see https://developer.calendly.com/api-docs
 */
class CalendlyService
{
    private const BASE_URL = 'https://api.calendly.com';

    /**
     * @param  string  $apiToken  Calendly Personal Access Token
     */
    public function __construct(
        private string $apiToken = '',
    ) {}

    /**
     * Check whether the API token has been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    // ── User ────────────────────────────────────────────────

    /**
     * Get the authenticated user's profile (GET /users/me).
     *
     * @return array<string, mixed>
     */
    public function getUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── Event Types ─────────────────────────────────────────

    /**
     * List event types for a user (GET /event_types).
     *
     * @param  array<string, mixed>  $params  Query parameters (user, active, page_token)
     * @return array<string, mixed>
     */
    public function getEventTypes(array $params = []): array
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

    // ── Scheduled Events ────────────────────────────────────

    /**
     * List scheduled events (GET /scheduled_events).
     *
     * @param  array<string, mixed>  $params  Query parameters (user, status, min_start_time, max_start_time, page_token, count)
     * @return array<string, mixed>
     */
    public function listEvents(array $params = []): array
    {
        return $this->request('GET', '/scheduled_events', $params);
    }

    /**
     * Get a single scheduled event by UUID (GET /scheduled_events/{uuid}).
     *
     * @param  string  $uuid  The scheduled event UUID
     * @return array<string, mixed>
     */
    public function getEvent(string $uuid): array
    {
        return $this->request('GET', "/scheduled_events/{$uuid}");
    }

    /**
     * Cancel a scheduled event (POST /scheduled_events/{uuid}/cancellation).
     *
     * @param  string  $uuid    The scheduled event UUID
     * @param  string  $reason  Cancellation reason
     * @return array<string, mixed>
     */
    public function cancelEvent(string $uuid, string $reason = ''): array
    {
        $data = [];
        if ($reason !== '') {
            $data['reason'] = $reason;
        }

        return $this->request('POST', "/scheduled_events/{$uuid}/cancellation", $data);
    }

    // ── Invitees ────────────────────────────────────────────

    /**
     * List invitees for a scheduled event (GET /scheduled_events/{uuid}/invitees).
     *
     * @param  string  $uuid  The scheduled event UUID
     * @param  array<string, mixed>  $params  Query parameters (page_token, count)
     * @return array<string, mixed>
     */
    public function listInvitees(string $uuid, array $params = []): array
    {
        return $this->request('GET', "/scheduled_events/{$uuid}/invitees", $params);
    }

    /**
     * Get a single invitee (GET /scheduled_events/{eventUuid}/invitees/{inviteeUuid}).
     *
     * @param  string  $eventUuid    The scheduled event UUID
     * @param  string  $inviteeUuid  The invitee UUID
     * @return array<string, mixed>
     */
    public function getInvitee(string $eventUuid, string $inviteeUuid): array
    {
        return $this->request('GET', "/scheduled_events/{$eventUuid}/invitees/{$inviteeUuid}");
    }

    // ── One-Off Event Types ─────────────────────────────────

    /**
     * Create a one-off event type (POST /one_off_event_types).
     *
     * @param  array<string, mixed>  $data  Body parameters (host, start_time, end_time, location, name)
     * @return array<string, mixed>
     */
    public function createOneOff(array $data): array
    {
        return $this->request('POST', '/one_off_event_types', $data);
    }

    // ── Organizations ───────────────────────────────────────

    /**
     * Get an organization by UUID (GET /organizations/{uuid}).
     *
     * @param  string  $uuid  The organization UUID
     * @return array<string, mixed>
     */
    public function getOrganization(string $uuid): array
    {
        return $this->request('GET', "/organizations/{$uuid}");
    }

    /**
     * List organization memberships (GET /organizations/{uuid}/memberships).
     *
     * @param  string  $uuid  The organization UUID
     * @param  array<string, mixed>  $params  Query parameters (page_token)
     * @return array<string, mixed>
     */
    public function listOrganizationMemberships(string $uuid, array $params = []): array
    {
        return $this->request('GET', "/organizations/{$uuid}/memberships", $params);
    }

    // ── Scheduling Links ────────────────────────────────────

    /**
     * Create a single-use scheduling link (POST /scheduling_links).
     *
     * @param  array<string, mixed>  $data  Body parameters (owner_uri, max_event_count, link_type)
     * @return array<string, mixed>
     */
    public function createSingleUseLink(array $data): array
    {
        return $this->request('POST', '/scheduling_links', $data);
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
        if (! $this->apiToken) {
            throw new \RuntimeException('Calendly API token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
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
