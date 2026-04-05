<?php

namespace OpenCompany\Integrations\Klaviyo;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Klaviyo v2 REST API covering profiles, events, lists, flows, and campaigns.
 *
 * Wraps the Klaviyo JSON:API-compliant REST API using private API key authentication.
 * All requests use the revision header `2024-10-15` and expect/return JSON:API formatted payloads.
 */
class KlaviyoService
{
    private const BASE_URL = 'https://a.klaviyo.com/api';
    private const REVISION = '2024-10-15';

    /** @param string $apiKey Klaviyo private API key */
    public function __construct(
        private string $apiKey = '',
    ) {}

    /**
     * Check whether the API key is configured.
     *
     * @return bool
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ── Account ──────────────────────────────────────────

    /**
     * Get the connected Klaviyo account information.
     *
     * @return array<string, mixed>
     */
    public function getAccount(): array
    {
        return $this->request('GET', '/accounts');
    }

    // ── Profiles ─────────────────────────────────────────

    /**
     * Create a new profile in Klaviyo.
     *
     * @param  string                $email        Profile email address.
     * @param  string|null           $phoneNumber  Phone number (E.164 format recommended).
     * @param  string|null           $firstName    First name.
     * @param  string|null           $lastName     Last name.
     * @param  array<string, mixed>  $properties   Custom profile properties.
     * @return array<string, mixed>
     */
    public function createProfile(
        string $email,
        ?string $phoneNumber = null,
        ?string $firstName = null,
        ?string $lastName = null,
        array $properties = [],
    ): array {
        $attributes = array_filter([
            'email' => $email,
            'phone_number' => $phoneNumber,
            'first_name' => $firstName,
            'last_name' => $lastName,
        ], fn ($v) => $v !== null);

        if (! empty($properties)) {
            $attributes['properties'] = $properties;
        }

        return $this->request('POST', '/profiles', [
            'data' => [
                'type' => 'profile',
                'attributes' => $attributes,
            ],
        ]);
    }

    /**
     * Get a single profile by ID.
     *
     * @param  string  $profileId  The Klaviyo profile ID.
     * @return array<string, mixed>
     */
    public function getProfile(string $profileId): array
    {
        return $this->request('GET', "/profiles/{$profileId}");
    }

    /**
     * Update an existing profile.
     *
     * @param  string                $profileId    The Klaviyo profile ID.
     * @param  string|null           $email        New email address.
     * @param  string|null           $phoneNumber  New phone number.
     * @param  string|null           $firstName    New first name.
     * @param  string|null           $lastName     New last name.
     * @param  array<string, mixed>  $properties   Custom profile properties to update.
     * @return array<string, mixed>
     */
    public function updateProfile(
        string $profileId,
        ?string $email = null,
        ?string $phoneNumber = null,
        ?string $firstName = null,
        ?string $lastName = null,
        array $properties = [],
    ): array {
        $attributes = array_filter([
            'email' => $email,
            'phone_number' => $phoneNumber,
            'first_name' => $firstName,
            'last_name' => $lastName,
        ], fn ($v) => $v !== null);

        if (! empty($properties)) {
            $attributes['properties'] = $properties;
        }

        return $this->request('PATCH', "/profiles/{$profileId}", [
            'data' => [
                'type' => 'profile',
                'id' => $profileId,
                'attributes' => $attributes,
            ],
        ]);
    }

    /**
     * List profiles with cursor-based pagination.
     *
     * @param  int|null      $limit       Number of profiles to return (default 20, max 100).
     * @param  string|null   $pageCursor  Cursor from a previous response for pagination.
     * @return array<string, mixed>
     */
    public function listProfiles(?int $limit = null, ?string $pageCursor = null): array
    {
        return $this->request('GET', '/profiles', array_filter([
            'page[size]' => $limit,
            'page[cursor]' => $pageCursor,
        ]));
    }

    // ── Profile Subscriptions ────────────────────────────

    /**
     * Subscribe a profile to a Klaviyo list.
     *
     * @param  string      $listId       The list ID to subscribe to.
     * @param  string      $email        Subscriber email address.
     * @param  string|null $phoneNumber  Subscriber phone number.
     * @param  string|null $consentedAt  ISO 8601 timestamp of consent.
     * @return array<string, mixed>
     */
    public function subscribeProfile(
        string $listId,
        string $email,
        ?string $phoneNumber = null,
        ?string $consentedAt = null,
    ): array {
        $attributes = array_filter([
            'email' => $email,
            'phone_number' => $phoneNumber,
            'consented_at' => $consentedAt,
        ], fn ($v) => $v !== null);

        return $this->request('POST', '/profile-subscriptions', [
            'data' => [
                'type' => 'profile-subscription-bulk-create-job',
                'attributes' => [
                    'profiles' => [
                        'data' => [
                            [
                                'type' => 'profile',
                                'attributes' => $attributes,
                            ],
                        ],
                    ],
                ],
                'relationships' => [
                    'list' => [
                        'data' => [
                            'type' => 'list',
                            'id' => $listId,
                        ],
                    ],
                ],
            ],
        ]);
    }

    // ── Events ───────────────────────────────────────────

    /**
     * Track a new event for a profile.
     *
     * @param  string                $profileId   The Klaviyo profile ID.
     * @param  string                $eventName   The event name (metric name).
     * @param  array<string, mixed>  $properties  Event properties.
     * @param  float|null            $value       Numeric value associated with the event.
     * @param  string|null           $time        ISO 8601 timestamp of when the event occurred.
     * @return array<string, mixed>
     */
    public function createEvent(
        string $profileId,
        string $eventName,
        array $properties = [],
        ?float $value = null,
        ?string $time = null,
    ): array {
        $attributes = [
            'metric' => [
                'data' => [
                    'type' => 'metric',
                    'attributes' => [
                        'name' => $eventName,
                    ],
                ],
            ],
            'profile' => [
                'data' => [
                    'type' => 'profile',
                    'id' => $profileId,
                ],
            ],
        ];

        if (! empty($properties)) {
            $attributes['properties'] = $properties;
        }
        if ($value !== null) {
            $attributes['value'] = $value;
        }
        if ($time !== null) {
            $attributes['time'] = $time;
        }

        return $this->request('POST', '/events', [
            'data' => [
                'type' => 'event',
                'attributes' => $attributes,
            ],
        ]);
    }

    /**
     * Get a single event by ID.
     *
     * @param  string  $eventId  The Klaviyo event ID.
     * @return array<string, mixed>
     */
    public function getEvent(string $eventId): array
    {
        return $this->request('GET', "/events/{$eventId}");
    }

    /**
     * List events with optional filtering and cursor-based pagination.
     *
     * @param  string|null  $filter      Klaviyo filter expression (e.g. "greater-than(timestamp,2024-01-01)").
     * @param  int|null     $limit       Number of events to return (default 20, max 100).
     * @param  string|null  $pageCursor  Cursor from a previous response for pagination.
     * @return array<string, mixed>
     */
    public function listEvents(?string $filter = null, ?int $limit = null, ?string $pageCursor = null): array
    {
        return $this->request('GET', '/events', array_filter([
            'filter' => $filter,
            'page[size]' => $limit,
            'page[cursor]' => $pageCursor,
        ]));
    }

    // ── Lists ────────────────────────────────────────────

    /**
     * List all lists in the account.
     *
     * @param  int|null      $limit       Number of lists to return.
     * @param  string|null   $pageCursor  Cursor from a previous response for pagination.
     * @return array<string, mixed>
     */
    public function listLists(?int $limit = null, ?string $pageCursor = null): array
    {
        return $this->request('GET', '/lists', array_filter([
            'page[size]' => $limit,
            'page[cursor]' => $pageCursor,
        ]));
    }

    /**
     * Create a new list.
     *
     * @param  string  $name  The list name.
     * @return array<string, mixed>
     */
    public function createList(string $name): array
    {
        return $this->request('POST', '/lists', [
            'data' => [
                'type' => 'list',
                'attributes' => [
                    'name' => $name,
                ],
            ],
        ]);
    }

    /**
     * Get a single list by ID.
     *
     * @param  string  $listId  The Klaviyo list ID.
     * @return array<string, mixed>
     */
    public function getList(string $listId): array
    {
        return $this->request('GET', "/lists/{$listId}");
    }

    /**
     * List profiles that belong to a specific list.
     *
     * @param  string       $listId      The Klaviyo list ID.
     * @param  int|null     $limit       Number of profiles to return.
     * @param  string|null  $pageCursor  Cursor from a previous response for pagination.
     * @return array<string, mixed>
     */
    public function listListProfiles(string $listId, ?int $limit = null, ?string $pageCursor = null): array
    {
        return $this->request('GET', "/lists/{$listId}/profiles", array_filter([
            'page[size]' => $limit,
            'page[cursor]' => $pageCursor,
        ]));
    }

    // ── Flows ────────────────────────────────────────────

    /**
     * List all flows in the account.
     *
     * @param  int|null      $limit       Number of flows to return.
     * @param  string|null   $pageCursor  Cursor from a previous response for pagination.
     * @return array<string, mixed>
     */
    public function listFlows(?int $limit = null, ?string $pageCursor = null): array
    {
        return $this->request('GET', '/flows', array_filter([
            'page[size]' => $limit,
            'page[cursor]' => $pageCursor,
        ]));
    }

    /**
     * Get a single flow by ID.
     *
     * @param  string  $flowId  The Klaviyo flow ID.
     * @return array<string, mixed>
     */
    public function getFlow(string $flowId): array
    {
        return $this->request('GET', "/flows/{$flowId}");
    }

    // ── Campaigns ────────────────────────────────────────

    /**
     * List all campaigns in the account.
     *
     * @param  int|null      $limit       Number of campaigns to return.
     * @param  string|null   $pageCursor  Cursor from a previous response for pagination.
     * @return array<string, mixed>
     */
    public function listCampaigns(?int $limit = null, ?string $pageCursor = null): array
    {
        return $this->request('GET', '/campaigns', array_filter([
            'page[size]' => $limit,
            'page[cursor]' => $pageCursor,
        ]));
    }

    // ── HTTP ─────────────────────────────────────────────

    /**
     * Send an authenticated request to the Klaviyo API.
     *
     * @param  string                   $method  HTTP method (GET, POST, PATCH, DELETE).
     * @param  string                   $path    API endpoint path (e.g. /profiles).
     * @param  array<string, mixed>     $data    Query params (GET) or JSON body (POST/PATCH).
     * @return array<string, mixed>
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Klaviyo API key is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => "Klaviyo-API-Key {$this->apiKey}",
                'Content-Type' => 'application/json',
                'revision' => self::REVISION,
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->failed()) {
                $body = $response->json();
                $errors = $body['errors'] ?? [];
                $message = $errors[0]['detail'] ?? $errors[0]['title'] ?? $response->body();

                Log::error('Klaviyo API error', [
                    'method' => $method,
                    'path' => $path,
                    'status' => $response->status(),
                    'body' => $body,
                ]);

                throw new \RuntimeException("Klaviyo API error ({$response->status()}): {$message}");
            }

            return $response->json() ?? [];
        } catch (ConnectionException $e) {
            Log::error('Klaviyo connection error', ['method' => $method, 'path' => $path, 'error' => $e->getMessage()]);
            throw new \RuntimeException("Klaviyo connection error: {$e->getMessage()}");
        }
    }
}
