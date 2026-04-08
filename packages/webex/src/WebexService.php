<?php

namespace OpenCompany\Integrations\Webex;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebexService
{
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
     * @param  int  $max  Maximum number of rooms to return (1–1000, default 100).
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
        return $this->request('GET', '/rooms/' . urlencode($roomId));
    }

    /**
     * List messages in a room.
     *
     * @param  string  $roomId  The room to list messages for.
     * @param  int  $max  Maximum number of messages to return (1–1000, default 50).
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
     * List meetings for the authenticated user.
     *
     * @param  string|null  $from  Start time (ISO 8601) for the range to query.
     * @param  string|null  $to  End time (ISO 8601) for the range to query.
     * @param  int  $max  Maximum number of meetings to return (1–100, default 100).
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
     * Get the profile of the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/people/me');
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
            throw new \RuntimeException('Webex access token is not configured.');
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

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Webex API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Webex API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('errors') ?? $body;
                Log::error("Webex API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Webex API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Webex API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Webex API: {$e->getMessage()}");
        }
    }
}
