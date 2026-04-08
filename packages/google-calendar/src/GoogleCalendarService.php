<?php

namespace OpenCompany\Integrations\GoogleCalendar;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleCalendarService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://www.googleapis.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List events on a calendar.
     *
     * @param  string  $calendarId  The calendar identifier (use "primary" for the user's primary calendar).
     * @param  array<string, mixed>  $params  Query parameters (timeMin, timeMax, maxResults, q, orderBy, etc.).
     * @return array<string, mixed>
     */
    public function listEvents(string $calendarId, array $params = []): array
    {
        return $this->request('GET', '/calendar/v3/calendars/' . urlencode($calendarId) . '/events', $params);
    }

    /**
     * Get a single event from a calendar.
     *
     * @param  string  $calendarId  The calendar identifier.
     * @param  string  $eventId  The event identifier.
     * @return array<string, mixed>
     */
    public function getEvent(string $calendarId, string $eventId): array
    {
        return $this->request('GET', '/calendar/v3/calendars/' . urlencode($calendarId) . '/events/' . urlencode($eventId));
    }

    /**
     * Create an event on a calendar.
     *
     * @param  string  $calendarId  The calendar identifier.
     * @param  array<string, mixed>  $event  The event payload (summary, start, end, description, attendees, location, etc.).
     * @return array<string, mixed>
     */
    public function createEvent(string $calendarId, array $event): array
    {
        return $this->request('POST', '/calendar/v3/calendars/' . urlencode($calendarId) . '/events', $event);
    }

    /**
     * List calendars on the user's calendar list.
     *
     * @param  array<string, mixed>  $params  Query parameters (maxResults, pageToken, etc.).
     * @return array<string, mixed>
     */
    public function listCalendars(array $params = []): array
    {
        return $this->request('GET', '/calendar/v3/users/me/calendarList', $params);
    }

    /**
     * Get a calendar by its identifier.
     *
     * @param  string  $calendarId  The calendar identifier.
     * @return array<string, mixed>
     */
    public function getCalendar(string $calendarId): array
    {
        return $this->request('GET', '/calendar/v3/calendars/' . urlencode($calendarId));
    }

    /**
     * Get the available color definitions for calendars and events.
     *
     * @return array<string, mixed>
     */
    public function listColors(): array
    {
        return $this->request('GET', '/calendar/v3/colors');
    }

    /**
     * Get the authenticated user's profile information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/oauth2/v2/userinfo');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., /calendar/v3/calendars/primary/events).
     * @param  array<string, mixed>  $data  Query parameters or request body.
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
     * Make a raw HTTP request to the Google Calendar API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Google Calendar access token is not configured.');
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
                $json = $response->json();
                $error = $json['error']['message'] ?? $response->body();

                Log::error("Google Calendar API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Google Calendar API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Calendar API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Google Calendar API: {$e->getMessage()}");
        }
    }
}
