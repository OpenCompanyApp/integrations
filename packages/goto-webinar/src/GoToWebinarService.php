<?php

namespace OpenCompany\Integrations\GoToWebinar;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoToWebinarService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.getgo.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List webinars.
     *
     * @param  int  $page  Page number (0-based).
     * @param  int  $size  Page size.
     * @param  string|null  $status  Filter by status (e.g. "ACTIVE", "IN_SESSION", "ENDED").
     * @return array<string, mixed>
     */
    public function listWebinars(int $page = 0, int $size = 20, ?string $status = null): array
    {
        $params = [
            'page' => $page,
            'size' => $size,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/v2/webinars', $params);
    }

    /**
     * Get a single webinar by ID.
     *
     * @param  string  $webinarKey  The webinar key.
     * @return array<string, mixed>
     */
    public function getWebinar(string $webinarKey): array
    {
        return $this->request('GET', '/v2/webinars/' . urlencode($webinarKey));
    }

    /**
     * Create a new webinar.
     *
     * @param  string  $subject  The webinar subject/title.
     * @param  array<int, array{startTime: string, endTime: string}>  $times  Array of time slots.
     * @param  string|null  $description  Optional webinar description.
     * @return array<string, mixed>
     */
    public function createWebinar(string $subject, array $times, ?string $description = null): array
    {
        $body = [
            'subject' => $subject,
            'times' => $times,
        ];

        if ($description !== null) {
            $body['description'] = $description;
        }

        return $this->request('POST', '/v2/webinars', $body);
    }

    /**
     * List sessions for a webinar.
     *
     * @param  string  $webinarKey  The webinar key.
     * @param  int  $page  Page number (0-based).
     * @param  int  $size  Page size.
     * @return array<string, mixed>
     */
    public function listSessions(string $webinarKey, int $page = 0, int $size = 20): array
    {
        return $this->request('GET', '/v2/webinars/' . urlencode($webinarKey) . '/sessions', [
            'page' => $page,
            'size' => $size,
        ]);
    }

    /**
     * Get a single session for a webinar.
     *
     * @param  string  $webinarKey  The webinar key.
     * @param  string  $sessionKey  The session key.
     * @return array<string, mixed>
     */
    public function getSession(string $webinarKey, string $sessionKey): array
    {
        return $this->request('GET', '/v2/webinars/' . urlencode($webinarKey) . '/sessions/' . urlencode($sessionKey));
    }

    /**
     * List panelists for a webinar.
     *
     * @param  string  $webinarKey  The webinar key.
     * @param  int  $page  Page number (0-based).
     * @param  int  $size  Page size.
     * @return array<string, mixed>
     */
    public function listPanelists(string $webinarKey, int $page = 0, int $size = 20): array
    {
        return $this->request('GET', '/v2/webinars/' . urlencode($webinarKey) . '/panelists', [
            'page' => $page,
            'size' => $size,
        ]);
    }

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the GoTo Webinar API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('GoTo Webinar access token is not configured.');
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
                    Log::warning("GoTo Webinar API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("GoTo Webinar API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $response->json('description') ?? $body;
                Log::error("GoTo Webinar API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("GoTo Webinar API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("GoTo Webinar API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to GoTo Webinar API: {$e->getMessage()}");
        }
    }
}
