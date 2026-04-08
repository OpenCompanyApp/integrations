<?php

namespace OpenCompany\Integrations\DailyCo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DailyCoService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.daily.co/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List rooms with optional pagination and filters.
     *
     * @param  int  $limit   Results per page (max 100).
     * @param  string|null  $endingBefore  Room ID to paginate before.
     * @param  string|null  $startingAfter  Room ID to paginate after.
     * @return array<string, mixed>
     */
    public function listRooms(int $limit = 20, ?string $endingBefore = null, ?string $startingAfter = null): array
    {
        $params = ['limit' => $limit];
        if ($endingBefore !== null) {
            $params['ending_before'] = $endingBefore;
        }
        if ($startingAfter !== null) {
            $params['starting_after'] = $startingAfter;
        }

        return $this->request('GET', '/rooms', $params);
    }

    /**
     * Get a single room by name.
     *
     * @param  string  $name  The room name.
     * @return array<string, mixed>
     */
    public function getRoom(string $name): array
    {
        return $this->request('GET', '/rooms/' . urlencode($name));
    }

    /**
     * Create a new room.
     *
     * @param  array<string, mixed>  $properties  Room configuration (name, privacy, properties, etc.).
     * @return array<string, mixed>
     */
    public function createRoom(array $properties = []): array
    {
        return $this->request('POST', '/rooms', $properties);
    }

    /**
     * Delete a room by name.
     *
     * @param  string  $name  The room name to delete.
     * @return array<string, mixed>
     */
    public function deleteRoom(string $name): array
    {
        return $this->request('DELETE', '/rooms/' . urlencode($name));
    }

    /**
     * List meetings with optional filters.
     *
     * @param  array<string, mixed>  $filters  Query filters (room, starting_after, ending_before, limit, etc.).
     * @return array<string, mixed>
     */
    public function listMeetings(array $filters = []): array
    {
        return $this->request('GET', '/meetings', $filters);
    }

    /**
     * Get a single meeting by ID.
     *
     * @param  string  $meetingId  The meeting ID.
     * @return array<string, mixed>
     */
    public function getMeeting(string $meetingId): array
    {
        return $this->request('GET', '/meetings/' . urlencode($meetingId));
    }

    /**
     * List recordings with optional filters.
     *
     * @param  array<string, mixed>  $filters  Query filters (room, starting_after, ending_before, limit, etc.).
     * @return array<string, mixed>
     */
    public function listRecordings(array $filters = []): array
    {
        return $this->request('GET', '/recordings', $filters);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g. /rooms).
     * @param  array<string, mixed>  $data  Query params (GET) or body (POST/PUT/DELETE).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Daily.co API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Daily.co API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
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
                    Log::warning("Daily.co API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Daily.co API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Daily.co API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Daily.co API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Daily.co API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Daily.co API: {$e->getMessage()}");
        }
    }
}
