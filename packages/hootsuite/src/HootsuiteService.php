<?php

namespace OpenCompany\Integrations\Hootsuite;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HootsuiteService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://platform.hootsuite.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List messages scheduled for the authenticated user.
     *
     * @param  string|null  $startTime  Start of time range (ISO 8601, e.g. "2025-01-01T00:00:00Z").
     * @param  string|null  $endTime    End of time range (ISO 8601, e.g. "2025-01-31T23:59:59Z").
     * @param  int|null     $limit      Maximum number of messages to return.
     * @param  array|null   $socialProfileIds  Filter by social profile IDs.
     * @return array<string, mixed>
     */
    public function listMessages(
        ?string $startTime = null,
        ?string $endTime = null,
        ?int $limit = null,
        ?array $socialProfileIds = null,
    ): array {
        $params = [];
        if ($startTime !== null) {
            $params['startTime'] = $startTime;
        }
        if ($endTime !== null) {
            $params['endTime'] = $endTime;
        }
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($socialProfileIds !== null) {
            $params['socialProfileIds'] = implode(',', $socialProfileIds);
        }

        return $this->request('GET', '/v1/messages', $params);
    }

    /**
     * Get a single message by ID.
     *
     * @param  string  $messageId  The message ID.
     * @return array<string, mixed>
     */
    public function getMessage(string $messageId): array
    {
        return $this->request('GET', '/v1/messages/' . urlencode($messageId));
    }

    /**
     * Create (schedule) a new message.
     *
     * @param  string  $text              The message body text.
     * @param  array   $socialProfileIds  Social profile IDs to post to.
     * @param  string  $scheduledSendTime  ISO 8601 timestamp for when to send.
     * @return array<string, mixed>
     */
    public function createMessage(string $text, array $socialProfileIds, string $scheduledSendTime): array
    {
        $body = [
            'text' => $text,
            'socialProfileIds' => $socialProfileIds,
            'scheduledSendTime' => $scheduledSendTime,
        ];

        return $this->request('POST', '/v1/messages', $body);
    }

    /**
     * List social profiles for the authenticated user.
     *
     * @return array<string, mixed>
     */
    public function listSocialProfiles(): array
    {
        return $this->request('GET', '/v1/socialProfiles');
    }

    /**
     * Get a single social profile by ID.
     *
     * @param  string  $profileId  The social profile ID.
     * @return array<string, mixed>
     */
    public function getSocialProfile(string $profileId): array
    {
        return $this->request('GET', '/v1/socialProfiles/' . urlencode($profileId));
    }

    /**
     * List organization members.
     *
     * @param  int|null  $limit  Maximum number of members to return.
     * @return array<string, mixed>
     */
    public function listMembers(?int $limit = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        return $this->request('GET', '/v1/members', $params);
    }

    /**
     * Get the currently authenticated member (me).
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/members/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. "/v1/messages").
     * @param  array   $data    Query params (GET) or body data (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Hootsuite API.
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
            throw new \RuntimeException('Hootsuite access token is not configured.');
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
                    Log::warning("Hootsuite API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Hootsuite API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Hootsuite API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Hootsuite API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Hootsuite API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Hootsuite API: {$e->getMessage()}");
        }
    }
}
