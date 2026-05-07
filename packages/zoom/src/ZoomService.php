<?php

namespace OpenCompany\Integrations\Zoom;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Zoom REST API v2.
 *
 * Handles bearer-token authentication and meeting, webinar, user, account,
 * recording, and settings endpoints used by the Zoom tool classes.
 */
class ZoomService
{
    /**
     * @param  string  $accessToken  Zoom OAuth or Server-to-Server OAuth access token
     * @param  string  $baseUrl  Zoom API base URL
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.zoom.us/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List meetings for a user.
     *
     * @param  string  $userId   The user ID or "me" for the authenticated user.
     * @param  string  $type     Meeting type: scheduled, live, upcoming.
     * @param  int     $pageSize Number of meetings per page.
     * @param  string  $nextPageToken  Token for the next page.
     * @return array<string, mixed>
     */
    public function listMeetings(string $userId = 'me', string $type = 'live', int $pageSize = 30, string $nextPageToken = ''): array
    {
        $params = [
            'type' => $type,
            'page_size' => $pageSize,
        ];

        if ($nextPageToken !== '') {
            $params['next_page_token'] = $nextPageToken;
        }

        return $this->request('GET', '/users/' . urlencode($userId) . '/meetings', $params);
    }

    /**
     * Get a meeting by ID.
     *
     * @param  string  $meetingId  The meeting ID.
     * @return array<string, mixed>
     */
    public function getMeeting(string $meetingId): array
    {
        return $this->request('GET', '/meetings/' . urlencode($meetingId));
    }

    /**
     * Create a meeting for a user.
     *
     * @param  string  $topic     Meeting topic/title.
     * @param  string  $type      Meeting type: 1=instant, 2=scheduled, 3=recurring no fixed time, 8=recurring fixed time.
     * @param  string  $startTime Meeting start time (ISO 8601).
     * @param  int     $duration  Meeting duration in minutes.
     * @param  string  $timezone  Timezone (e.g. "America/New_York").
     * @param  string  $userId    The user ID or "me".
     * @param  array   $options   Additional options (agenda, settings, etc.).
     * @return array<string, mixed>
     */
    public function createMeeting(string $topic, string $type = '2', string $startTime = '', int $duration = 30, string $timezone = '', string $userId = 'me', array $options = []): array
    {
        $data = array_merge([
            'topic' => $topic,
            'type' => (int) $type,
        ], $options);

        if ($startTime !== '') {
            $data['start_time'] = $startTime;
        }
        if ($duration > 0) {
            $data['duration'] = $duration;
        }
        if ($timezone !== '') {
            $data['timezone'] = $timezone;
        }

        return $this->request('POST', '/users/' . urlencode($userId) . '/meetings', $data);
    }

    /**
     * List users in the account.
     *
     * @param  int     $pageSize Number of users per page.
     * @param  string  $nextPageToken  Token for the next page.
     * @return array<string, mixed>
     */
    public function listUsers(int $pageSize = 30, string $nextPageToken = ''): array
    {
        $params = [
            'page_size' => $pageSize,
        ];

        if ($nextPageToken !== '') {
            $params['next_page_token'] = $nextPageToken;
        }

        return $this->request('GET', '/users', $params);
    }

    /**
     * Get a user by ID.
     *
     * @param  string  $userId  The user ID or "me".
     * @return array<string, mixed>
     */
    public function getUser(string $userId): array
    {
        return $this->request('GET', '/users/' . urlencode($userId));
    }

    /**
     * List recordings for a user.
     *
     * @param  string  $userId   The user ID or "me".
     * @param  string  $nextPageToken  Token for the next page.
     * @param  int     $pageSize Number of recordings per page.
     * @return array<string, mixed>
     */
    public function listRecordings(string $userId = 'me', string $nextPageToken = '', int $pageSize = 30): array
    {
        $params = [
            'page_size' => $pageSize,
        ];

        if ($nextPageToken !== '') {
            $params['next_page_token'] = $nextPageToken;
        }

        return $this->request('GET', '/users/' . urlencode($userId) . '/recordings', $params);
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
     * Create a user in the Zoom account.
     *
     * @param  array<string, mixed>  $data  User creation payload
     * @return array<string, mixed>
     */
    public function createUser(array $data): array
    {
        return $this->request('POST', '/users', $data);
    }

    /**
     * Create a webinar for a user.
     *
     * @param  string  $userId  User ID, email, or "me"
     * @param  array<string, mixed>  $data  Webinar payload
     * @return array<string, mixed>
     */
    public function createWebinar(string $userId, array $data): array
    {
        return $this->request('POST', '/users/' . urlencode($userId) . '/webinars', $data);
    }

    /**
     * Delete a meeting by ID.
     *
     * @return array<string, mixed>
     */
    public function deleteMeeting(string $meetingId): array
    {
        return $this->request('DELETE', '/meetings/' . urlencode($meetingId));
    }

    /**
     * Get the current account details.
     *
     * @return array<string, mixed>
     */
    public function getAccount(): array
    {
        return $this->request('GET', '/accounts/me');
    }

    /**
     * Get settings for a user.
     *
     * @return array<string, mixed>
     */
    public function getUserSettings(string $userId): array
    {
        return $this->request('GET', '/users/' . urlencode($userId) . '/settings');
    }

    /**
     * Get a webinar by ID.
     *
     * @return array<string, mixed>
     */
    public function getWebinar(string $webinarId): array
    {
        return $this->request('GET', '/webinars/' . urlencode($webinarId));
    }

    /**
     * List past meeting instances for a meeting.
     *
     * @return array<string, mixed>
     */
    public function listPastMeetings(string $meetingId): array
    {
        return $this->request('GET', '/past_meetings/' . urlencode($meetingId) . '/instances');
    }

    /**
     * List webinars for a user.
     *
     * @param  string  $userId  User ID, email, or "me"
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listWebinars(string $userId, array $params = []): array
    {
        return $this->request('GET', '/users/' . urlencode($userId) . '/webinars', $params);
    }

    /**
     * Update a meeting by ID.
     *
     * @param  array<string, mixed>  $data  Meeting fields to update
     * @return array<string, mixed>
     */
    public function updateMeeting(string $meetingId, array $data): array
    {
        return $this->request('PATCH', '/meetings/' . urlencode($meetingId), $data);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path (e.g. /users/me).
     * @param  array   $data    Query params or JSON body.
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
     * Make a raw HTTP request to the Zoom API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array   $data    Query params or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Zoom access token is not configured.');
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

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Zoom API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Zoom API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $json = $response->json();
                $error = $json['message'] ?? $json['error'] ?? $body;
                Log::error("Zoom API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Zoom API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zoom API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zoom API: {$e->getMessage()}");
        }
    }
}
