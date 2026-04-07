<?php

namespace OpenCompany\Integrations\Buffer;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BufferService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.bufferapp.com/1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all social media profiles connected to the Buffer account.
     *
     * @return array<string, mixed>
     */
    public function listProfiles(): array
    {
        return $this->request('GET', '/profiles.json');
    }

    /**
     * Get a single social media profile by ID.
     *
     * @param  string  $profileId  The profile ID.
     * @return array<string, mixed>
     */
    public function getProfile(string $profileId): array
    {
        return $this->request('GET', '/profiles/' . urlencode($profileId) . '.json');
    }

    /**
     * List pending (scheduled) updates for a profile.
     *
     * @param  string     $profileId  The profile ID.
     * @param  int|null   $count      Number of updates to return.
     * @param  int|null   $page       Page number for pagination.
     * @return array<string, mixed>
     */
    public function listPendingUpdates(string $profileId, ?int $count = null, ?int $page = null): array
    {
        $params = [];
        if ($count !== null) {
            $params['count'] = $count;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/profiles/' . urlencode($profileId) . '/updates/pending.json', $params);
    }

    /**
     * Create a new update (post) for one or more profiles.
     *
     * @param  string  $text              The text content of the update.
     * @param  array   $profileIds        Array of profile IDs to publish to.
     * @param  bool    $shorten           Whether to shorten links (default true).
     * @param  bool    $now               Post immediately instead of scheduling.
     * @param  string|null  $scheduledAt   ISO 8601 timestamp for scheduling.
     * @param  array|null   $media        Media attachments (photo, link, etc.).
     * @return array<string, mixed>
     */
    public function createUpdate(
        string $text,
        array $profileIds,
        bool $shorten = true,
        bool $now = false,
        ?string $scheduledAt = null,
        ?array $media = null,
    ): array {
        $data = [
            'text' => $text,
            'profile_ids' => $profileIds,
            'shorten' => $shorten,
            'now' => $now,
        ];

        if ($scheduledAt !== null) {
            $data['scheduled_at'] = $scheduledAt;
        }

        if ($media !== null) {
            $data['media'] = $media;
        }

        return $this->request('POST', '/updates/create.json', $data);
    }

    /**
     * List sent (posted) updates for a profile.
     *
     * @param  string   $profileId  The profile ID.
     * @param  int|null $count      Number of updates to return.
     * @param  int|null $page       Page number for pagination.
     * @return array<string, mixed>
     */
    public function listSentUpdates(string $profileId, ?int $count = null, ?int $page = null): array
    {
        $params = [];
        if ($count !== null) {
            $params['count'] = $count;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/profiles/' . urlencode($profileId) . '/updates/sent.json', $params);
    }

    /**
     * Get a single update by ID.
     *
     * @param  string  $updateId  The update ID.
     * @return array<string, mixed>
     */
    public function getUpdate(string $updateId): array
    {
        return $this->request('GET', '/updates/' . urlencode($updateId) . '.json');
    }

    /**
     * Get the currently authenticated Buffer user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user.json');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. "/profiles.json").
     * @param  array   $data    Query params (GET) or body data (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Buffer API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Query params or body data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Buffer access token is not configured.');
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
                    Log::warning("Buffer API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Buffer API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Buffer API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Buffer API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Buffer API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Buffer API: {$e->getMessage()}");
        }
    }
}
