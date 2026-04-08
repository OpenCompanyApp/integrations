<?php

namespace OpenCompany\Integrations\Fellow;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FellowService
{
    /**
     * Create a new FellowService instance.
     *
     * @param  string  $accessToken  The Fellow API access token.
     * @param  string  $baseUrl  The Fellow API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.fellow.app/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List meetings with optional date filters and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (date_from, date_to, cursor, limit, etc.).
     * @return array<string, mixed>
     */
    public function listMeetings(array $params = []): array
    {
        return $this->request('GET', '/meetings', $params);
    }

    /**
     * Get a single meeting by its ID.
     *
     * @param  string  $meetingId  The Fellow meeting UUID.
     * @return array<string, mixed>
     */
    public function getMeeting(string $meetingId): array
    {
        return $this->request('GET', '/meetings/' . urlencode($meetingId));
    }

    /**
     * Create a note for a specific meeting.
     *
     * @param  string  $meetingId  The Fellow meeting UUID.
     * @param  array<string, mixed>  $data  The note payload (content, etc.).
     * @return array<string, mixed>
     */
    public function createNote(string $meetingId, array $data): array
    {
        return $this->request('POST', '/meetings/' . urlencode($meetingId) . '/notes', $data);
    }

    /**
     * List action items with optional filters and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (cursor, limit, status, etc.).
     * @return array<string, mixed>
     */
    public function listActionItems(array $params = []): array
    {
        return $this->request('GET', '/action_items', $params);
    }

    /**
     * List goals.
     *
     * @param  array<string, mixed>  $params  Query parameters (cursor, limit, etc.).
     * @return array<string, mixed>
     */
    public function listGoals(array $params = []): array
    {
        return $this->request('GET', '/goals', $params);
    }

    /**
     * Get the currently authenticated Fellow user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Fellow API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Fellow access token is not configured.');
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
                    Log::warning("Fellow API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Fellow API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Fellow API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Fellow API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Fellow API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Fellow API: {$e->getMessage()}");
        }
    }
}
