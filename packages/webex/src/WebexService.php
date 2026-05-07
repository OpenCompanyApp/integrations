<?php

namespace OpenCompany\Integrations\Webex;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Cisco Webex REST API.
 *
 * Handles messaging, memberships, people, teams, meetings, webhooks, and
 * generic relative API requests for uncovered Webex endpoints.
 */
class WebexService
{
    /**
     * @param  string  $accessToken  Webex access token.
     * @param  string  $baseUrl  Webex REST API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://webexapis.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List rooms the authenticated user belongs to.
     *
     * @param  int  $max  Maximum number of rooms to return (1-1000, default 100).
     * @param  string|null  $before  List rooms before this ISO 8601 timestamp (for pagination).
     * @param  string|null  $after  List rooms after this ISO 8601 timestamp (for pagination).
     * @return array<string, mixed>
     */
    public function listRooms(int $max = 100, ?string $before = null, ?string $after = null): array
    {
        $params = ['max' => min($max, 1000)];
        if ($before) {
            $params['before'] = $before;
        }
        if ($after) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/rooms', $params);
    }

    /**
     * Get details for a specific room.
     *
     * @param  string  $roomId  The unique identifier for the room.
     * @return array<string, mixed>
     */
    public function getRoom(string $roomId): array
    {
        return $this->request('GET', '/rooms/' . rawurlencode($roomId));
    }

    /**
     * Create a Webex room.
     *
     * @param  array<string, mixed>  $payload  Room creation payload.
     * @return array<string, mixed>
     */
    public function createRoom(array $payload): array
    {
        return $this->request('POST', '/rooms', $payload);
    }

    /**
     * Update a Webex room.
     *
     * @param  string  $roomId  Room ID.
     * @param  array<string, mixed>  $payload  Room update payload.
     * @return array<string, mixed>
     */
    public function updateRoom(string $roomId, array $payload): array
    {
        return $this->request('PUT', '/rooms/' . rawurlencode($roomId), $payload);
    }

    /**
     * Delete a Webex room.
     *
     * @param  string  $roomId  Room ID.
     * @return array<string, mixed>
     */
    public function deleteRoom(string $roomId): array
    {
        return $this->request('DELETE', '/rooms/' . rawurlencode($roomId));
    }

    /**
     * List messages in a room.
     *
     * @param  string  $roomId  The room to list messages for.
     * @param  int  $max  Maximum number of messages to return (1-1000, default 50).
     * @param  string|null  $before  List messages posted before this ISO 8601 timestamp.
     * @param  string|null  $after  List messages posted after this ISO 8601 timestamp.
     * @return array<string, mixed>
     */
    public function listMessages(string $roomId, int $max = 50, ?string $before = null, ?string $after = null): array
    {
        $params = [
            'roomId' => $roomId,
            'max' => min($max, 1000),
        ];
        if ($before) {
            $params['before'] = $before;
        }
        if ($after) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/messages', $params);
    }

    /**
     * Post a message to a room.
     *
     * @param  string  $roomId  The room to post the message in.
     * @param  string|null  $text  Plain-text message content.
     * @param  string|null  $markdown  Markdown-formatted message content.
     * @return array<string, mixed>
     */
    public function createMessage(string $roomId, ?string $text = null, ?string $markdown = null): array
    {
        $data = ['roomId' => $roomId];
        if ($text !== null) {
            $data['text'] = $text;
        }
        if ($markdown !== null) {
            $data['markdown'] = $markdown;
        }

        return $this->request('POST', '/messages', $data);
    }

    /**
     * Get details for one message.
     *
     * @param  string  $messageId  Message ID.
     * @return array<string, mixed>
     */
    public function getMessage(string $messageId): array
    {
        return $this->request('GET', '/messages/' . rawurlencode($messageId));
    }

    /**
     * Update an existing message.
     *
     * @param  string  $messageId  Message ID.
     * @param  array<string, mixed>  $payload  Message update payload.
     * @return array<string, mixed>
     */
    public function updateMessage(string $messageId, array $payload): array
    {
        return $this->request('PUT', '/messages/' . rawurlencode($messageId), $payload);
    }

    /**
     * Delete a message.
     *
     * @param  string  $messageId  Message ID.
     * @return array<string, mixed>
     */
    public function deleteMessage(string $messageId): array
    {
        return $this->request('DELETE', '/messages/' . rawurlencode($messageId));
    }

    /**
     * List people visible to the authenticated token.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listPeople(array $params = []): array
    {
        return $this->request('GET', '/people', $params);
    }

    /**
     * Get one person by ID.
     *
     * @param  string  $personId  Person ID.
     * @return array<string, mixed>
     */
    public function getPerson(string $personId): array
    {
        return $this->request('GET', '/people/' . rawurlencode($personId));
    }

    /**
     * List room memberships.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listMemberships(array $params = []): array
    {
        return $this->request('GET', '/memberships', $params);
    }

    /**
     * Create a room membership.
     *
     * @param  array<string, mixed>  $payload  Membership creation payload.
     * @return array<string, mixed>
     */
    public function createMembership(array $payload): array
    {
        return $this->request('POST', '/memberships', $payload);
    }

    /**
     * Delete a room membership.
     *
     * @param  string  $membershipId  Membership ID.
     * @return array<string, mixed>
     */
    public function deleteMembership(string $membershipId): array
    {
        return $this->request('DELETE', '/memberships/' . rawurlencode($membershipId));
    }

    /**
     * List Webex teams.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listTeams(array $params = []): array
    {
        return $this->request('GET', '/teams', $params);
    }

    /**
     * Get one Webex team.
     *
     * @param  string  $teamId  Team ID.
     * @return array<string, mixed>
     */
    public function getTeam(string $teamId): array
    {
        return $this->request('GET', '/teams/' . rawurlencode($teamId));
    }

    /**
     * Create a Webex team.
     *
     * @param  array<string, mixed>  $payload  Team creation payload.
     * @return array<string, mixed>
     */
    public function createTeam(array $payload): array
    {
        return $this->request('POST', '/teams', $payload);
    }

    /**
     * Update a Webex team.
     *
     * @param  string  $teamId  Team ID.
     * @param  array<string, mixed>  $payload  Team update payload.
     * @return array<string, mixed>
     */
    public function updateTeam(string $teamId, array $payload): array
    {
        return $this->request('PUT', '/teams/' . rawurlencode($teamId), $payload);
    }

    /**
     * Delete a Webex team.
     *
     * @param  string  $teamId  Team ID.
     * @return array<string, mixed>
     */
    public function deleteTeam(string $teamId): array
    {
        return $this->request('DELETE', '/teams/' . rawurlencode($teamId));
    }

    /**
     * List Webex team memberships.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listTeamMemberships(array $params = []): array
    {
        return $this->request('GET', '/team/memberships', $params);
    }

    /**
     * List meetings for the authenticated user.
     *
     * @param  string|null  $from  Start time (ISO 8601) for the range to query.
     * @param  string|null  $to  End time (ISO 8601) for the range to query.
     * @param  int  $max  Maximum number of meetings to return (1-100, default 100).
     * @return array<string, mixed>
     */
    public function listMeetings(?string $from = null, ?string $to = null, int $max = 100): array
    {
        $params = ['max' => min($max, 100)];
        if ($from) {
            $params['from'] = $from;
        }
        if ($to) {
            $params['to'] = $to;
        }

        return $this->request('GET', '/meetings', $params);
    }

    /**
     * Get one Webex meeting by ID.
     *
     * @param  string  $meetingId  Meeting ID.
     * @return array<string, mixed>
     */
    public function getMeeting(string $meetingId): array
    {
        return $this->request('GET', '/meetings/' . rawurlencode($meetingId));
    }

    /**
     * Create a Webex meeting.
     *
     * @param  array<string, mixed>  $payload  Meeting creation payload.
     * @return array<string, mixed>
     */
    public function createMeeting(array $payload): array
    {
        return $this->request('POST', '/meetings', $payload);
    }

    /**
     * Update a Webex meeting.
     *
     * @param  string  $meetingId  Meeting ID.
     * @param  array<string, mixed>  $payload  Meeting update payload.
     * @return array<string, mixed>
     */
    public function updateMeeting(string $meetingId, array $payload): array
    {
        return $this->request('PUT', '/meetings/' . rawurlencode($meetingId), $payload);
    }

    /**
     * Delete a Webex meeting.
     *
     * @param  string  $meetingId  Meeting ID.
     * @return array<string, mixed>
     */
    public function deleteMeeting(string $meetingId): array
    {
        return $this->request('DELETE', '/meetings/' . rawurlencode($meetingId));
    }

    /**
     * List Webex webhooks.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listWebhooks(array $params = []): array
    {
        return $this->request('GET', '/webhooks', $params);
    }

    /**
     * Get one Webex webhook.
     *
     * @param  string  $webhookId  Webhook ID.
     * @return array<string, mixed>
     */
    public function getWebhook(string $webhookId): array
    {
        return $this->request('GET', '/webhooks/' . rawurlencode($webhookId));
    }

    /**
     * Create a Webex webhook.
     *
     * @param  array<string, mixed>  $payload  Webhook creation payload.
     * @return array<string, mixed>
     */
    public function createWebhook(array $payload): array
    {
        return $this->request('POST', '/webhooks', $payload);
    }

    /**
     * Update a Webex webhook.
     *
     * @param  string  $webhookId  Webhook ID.
     * @param  array<string, mixed>  $payload  Webhook update payload.
     * @return array<string, mixed>
     */
    public function updateWebhook(string $webhookId, array $payload): array
    {
        return $this->request('PUT', '/webhooks/' . rawurlencode($webhookId), $payload);
    }

    /**
     * Delete a Webex webhook.
     *
     * @param  string  $webhookId  Webhook ID.
     * @return array<string, mixed>
     */
    public function deleteWebhook(string $webhookId): array
    {
        return $this->request('DELETE', '/webhooks/' . rawurlencode($webhookId));
    }

    /**
     * Get the profile of the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/people/me');
    }

    /**
     * Send a GET request to a relative Webex API path.
     *
     * @param  string  $path  Relative Webex API path.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Send a POST request to a relative Webex API path.
     *
     * @param  string  $path  Relative Webex API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Send a PUT request to a relative Webex API path.
     *
     * @param  string  $path  Relative Webex API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Send a DELETE request to a relative Webex API path.
     *
     * @param  string  $path  Relative Webex API path.
     * @param  array<string, mixed>  $payload  Optional JSON body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., "/rooms").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Webex API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new RuntimeException('Webex access token is not configured.');
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
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Webex API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("Webex API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('errors') ?? $body;
                Log::error("Webex API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("Webex API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Webex API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Webex API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize and validate caller-supplied relative Webex paths.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || str_contains($path, '://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Webex API path must be relative, such as /rooms.');
        }

        return str_starts_with($path, '/') ? $path : '/' . $path;
    }
}
