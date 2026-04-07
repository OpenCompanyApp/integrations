<?php

namespace OpenCompany\Integrations\SproutSocial;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SproutSocialService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.sproutsocial.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all social media profiles connected to the Sprout Social account.
     *
     * @return array<string, mixed>
     */
    public function listProfiles(): array
    {
        return $this->request('GET', '/profiles');
    }

    /**
     * Get a single social media profile by ID.
     *
     * @param  string  $profileId  The profile ID.
     * @return array<string, mixed>
     */
    public function getProfile(string $profileId): array
    {
        return $this->request('GET', '/profiles/' . urlencode($profileId));
    }

    /**
     * List posts for the account.
     *
     * @param  int|null    $count      Number of posts to return.
     * @param  int|null    $page       Page number for pagination.
     * @param  string|null $status     Filter by post status (e.g., "sent", "scheduled", "draft").
     * @return array<string, mixed>
     */
    public function listPosts(?int $count = null, ?int $page = null, ?string $status = null): array
    {
        $params = [];
        if ($count !== null) {
            $params['count'] = $count;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/posts', $params);
    }

    /**
     * Create a new post for one or more profiles.
     *
     * @param  string     $text           The text content of the post.
     * @param  array      $profileIds     Array of profile IDs to publish to.
     * @param  string|null $scheduledAt   ISO 8601 timestamp for scheduling.
     * @param  array|null  $media         Media attachments.
     * @return array<string, mixed>
     */
    public function createPost(
        string $text,
        array $profileIds,
        ?string $scheduledAt = null,
        ?array $media = null,
    ): array {
        $data = [
            'text' => $text,
            'profile_ids' => $profileIds,
        ];

        if ($scheduledAt !== null) {
            $data['scheduled_at'] = $scheduledAt;
        }

        if ($media !== null) {
            $data['media'] = $media;
        }

        return $this->request('POST', '/posts', $data);
    }

    /**
     * List messages (inbox conversations) for the account.
     *
     * @param  int|null    $count      Number of messages to return.
     * @param  int|null    $page       Page number for pagination.
     * @return array<string, mixed>
     */
    public function listMessages(?int $count = null, ?int $page = null): array
    {
        $params = [];
        if ($count !== null) {
            $params['count'] = $count;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/messages', $params);
    }

    /**
     * Get a single message by ID.
     *
     * @param  string  $messageId  The message ID.
     * @return array<string, mixed>
     */
    public function getMessage(string $messageId): array
    {
        return $this->request('GET', '/messages/' . urlencode($messageId));
    }

    /**
     * Get the currently authenticated Sprout Social user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. "/profiles").
     * @param  array   $data    Query params (GET) or body data (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Sprout Social API.
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
            throw new \RuntimeException('Sprout Social access token is not configured.');
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
                    Log::warning("Sprout Social API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Sprout Social API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Sprout Social API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Sprout Social API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Sprout Social API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Sprout Social API: {$e->getMessage()}");
        }
    }
}
