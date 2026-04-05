<?php

namespace OpenCompany\Integrations\Zoom;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Zoom REST API v2.
 *
 * Wraps HTTP calls to Zoom's REST endpoints for meetings, webinars,
 * users, recordings, and account management using OAuth2 Bearer tokens.
 */
class ZoomService
{
    private const BASE_URL = 'https://api.zoom.us/v2';

    /**
     * @param  string  $accessToken  Zoom OAuth2 access token
     */
    public function __construct(
        private string $accessToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Connection ──────────────────────────────────────────

    /**
     * Test the connection by fetching the current user.
     *
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(): array
    {
        try {
            $response = $this->request('GET', '/users/me');
            $firstName = $response['first_name'] ?? '';
            $lastName = $response['last_name'] ?? '';
            $name = trim("$firstName $lastName") ?: ($response['email'] ?? 'Unknown');

            return [
                'success' => true,
                'message' => "Connected to Zoom as {$name}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    // ── Meetings ────────────────────────────────────────────

    /**
     * Create a meeting for a user.
     *
     * @param  string  $userId  The user ID or email address
     * @param  array<string, mixed>  $data  Meeting creation payload
     * @return array<string, mixed>
     */
    public function createMeeting(string $userId, array $data): array
    {
        return $this->request('POST', "/users/{$userId}/meetings", $data);
    }

    /**
     * Get a meeting by ID.
     *
     * @param  string  $meetingId  The meeting ID
     * @return array<string, mixed>
     */
    public function getMeeting(string $meetingId): array
    {
        return $this->request('GET', "/meetings/{$meetingId}");
    }

    /**
     * Update a meeting.
     *
     * @param  string  $meetingId  The meeting ID
     * @param  array<string, mixed>  $data  Fields to update
     * @return array<string, mixed>
     */
    public function updateMeeting(string $meetingId, array $data): array
    {
        return $this->request('PATCH', "/meetings/{$meetingId}", $data);
    }

    /**
     * Delete a meeting.
     *
     * @param  string  $meetingId  The meeting ID
     * @return array<string, mixed>
     */
    public function deleteMeeting(string $meetingId): array
    {
        return $this->request('DELETE', "/meetings/{$meetingId}");
    }

    /**
     * List meetings for a user.
     *
     * @param  string  $userId  The user ID or email address
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listMeetings(string $userId, array $params = []): array
    {
        return $this->request('GET', "/users/{$userId}/meetings", $params);
    }

    /**
     * List past meeting instances.
     *
     * @param  string  $meetingId  The meeting ID
     * @return array<string, mixed>
     */
    public function listPastMeetings(string $meetingId): array
    {
        return $this->request('GET', "/past_meetings/{$meetingId}/instances");
    }

    // ── Webinars ────────────────────────────────────────────

    /**
     * Create a webinar for a user.
     *
     * @param  string  $userId  The user ID or email address
     * @param  array<string, mixed>  $data  Webinar creation payload
     * @return array<string, mixed>
     */
    public function createWebinar(string $userId, array $data): array
    {
        return $this->request('POST', "/users/{$userId}/webinars", $data);
    }

    /**
     * List webinars for a user.
     *
     * @param  string  $userId  The user ID or email address
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listWebinars(string $userId, array $params = []): array
    {
        return $this->request('GET', "/users/{$userId}/webinars", $params);
    }

    /**
     * Get a webinar by ID.
     *
     * @param  string  $webinarId  The webinar ID
     * @return array<string, mixed>
     */
    public function getWebinar(string $webinarId): array
    {
        return $this->request('GET', "/webinars/{$webinarId}");
    }

    // ── Users ────────────────────────────────────────────────

    /**
     * List users in the account.
     *
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
    }

    /**
     * Get a user by ID.
     *
     * @param  string  $userId  The user ID or email address
     * @return array<string, mixed>
     */
    public function getUser(string $userId): array
    {
        return $this->request('GET', "/users/{$userId}");
    }

    /**
     * Create a user.
     *
     * @param  array<string, mixed>  $data  User creation payload
     * @return array<string, mixed>
     */
    public function createUser(array $data): array
    {
        return $this->request('POST', '/users', $data);
    }

    /**
     * Get user settings.
     *
     * @param  string  $userId  The user ID or email address
     * @return array<string, mixed>
     */
    public function getUserSettings(string $userId): array
    {
        return $this->request('GET', "/users/{$userId}/settings");
    }

    // ── Account ──────────────────────────────────────────────

    /**
     * Get the current account info.
     *
     * @return array<string, mixed>
     */
    public function getAccount(): array
    {
        return $this->request('GET', '/accounts/me');
    }

    // ── Recordings ──────────────────────────────────────────

    /**
     * List recordings for a user.
     *
     * @param  string  $userId  The user ID or email address
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listRecordings(string $userId, array $params = []): array
    {
        return $this->request('GET', "/users/{$userId}/recordings", $params);
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Zoom.
     *
     * @param  array<string, mixed>  $data  Query params (GET) or body (POST/PATCH)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Zoom access token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->status() === 204) {
                return ['success' => true];
            }

            $body = $response->json() ?? [];

            if (! $response->successful()) {
                $error = $body['message'] ?? $response->body();

                Log::error("Zoom API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Zoom API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $body;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zoom API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zoom API: {$e->getMessage()}");
        }
    }
}
