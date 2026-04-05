<?php

namespace OpenCompany\Integrations\Eventbrite;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EventbriteService
{
    /**
     * Create a new Eventbrite service instance.
     *
     * @param  string  $token  The private token for Bearer authentication.
     * @param  string  $organizationId  The Eventbrite organization ID.
     * @param  string  $baseUrl  The Eventbrite API base URL.
     */
    public function __construct(
        private string $token = '',
        private string $organizationId = '',
        private string $baseUrl = 'https://www.eventbriteapi.com/v3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->token) && !empty($this->organizationId);
    }

    /**
     * Get the configured organization ID.
     */
    public function getOrganizationId(): string
    {
        return $this->organizationId;
    }

    /**
     * List events for the configured organization.
     *
     * @param  array  $params  Query parameters (e.g. status, order_by, page, continuation).
     * @return array<string, mixed>
     */
    public function listEvents(array $params = []): array
    {
        return $this->request('GET', "/organizations/{$this->organizationId}/events/", $params);
    }

    /**
     * Get a single event by ID.
     *
     * @param  string  $eventId  The event ID.
     * @return array<string, mixed>
     */
    public function getEvent(string $eventId): array
    {
        return $this->request('GET', "/events/{$eventId}/");
    }

    /**
     * Create a new event under the configured organization.
     *
     * @param  array<string, mixed>  $eventData  The event payload (name, start, end, currency, etc.).
     * @return array<string, mixed>
     */
    public function createEvent(array $eventData): array
    {
        return $this->request('POST', "/organizations/{$this->organizationId}/events/", $eventData);
    }

    /**
     * Update an existing event.
     *
     * @param  string  $eventId  The event ID.
     * @param  array<string, mixed>  $eventData  Fields to update.
     * @return array<string, mixed>
     */
    public function updateEvent(string $eventId, array $eventData): array
    {
        return $this->request('POST', "/events/{$eventId}/", $eventData);
    }

    /**
     * List attendees for an event.
     *
     * @param  string  $eventId  The event ID.
     * @param  array  $params  Query parameters (e.g. page, continuation, status).
     * @return array<string, mixed>
     */
    public function listAttendees(string $eventId, array $params = []): array
    {
        return $this->request('GET', "/events/{$eventId}/attendees/", $params);
    }

    /**
     * Get a single attendee by ID.
     *
     * @param  string  $eventId  The event ID.
     * @param  string  $attendeeId  The attendee ID.
     * @return array<string, mixed>
     */
    public function getAttendee(string $eventId, string $attendeeId): array
    {
        return $this->request('GET', "/events/{$eventId}/attendees/{$attendeeId}/");
    }

    /**
     * List venues for the configured organization.
     *
     * @param  array  $params  Query parameters (e.g. page, continuation).
     * @return array<string, mixed>
     */
    public function listVenues(array $params = []): array
    {
        return $this->request('GET', "/organizations/{$this->organizationId}/venues/", $params);
    }

    /**
     * Create a new venue under the configured organization.
     *
     * @param  array<string, mixed>  $venueData  The venue payload (name, address, city, etc.).
     * @return array<string, mixed>
     */
    public function createVenue(array $venueData): array
    {
        return $this->request('POST', "/organizations/{$this->organizationId}/venues/", $venueData);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me/');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/events/123/").
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
     * Make a raw HTTP request to the Eventbrite API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->token) {
            throw new \RuntimeException('Eventbrite API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->token,
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
                    Log::warning("Eventbrite API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Eventbrite API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is down.");
                }

                $error = $response->json('error_description') ?? $response->json('error') ?? $body;
                Log::error("Eventbrite API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Eventbrite API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Eventbrite API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Eventbrite API: {$e->getMessage()}");
        }
    }
}
