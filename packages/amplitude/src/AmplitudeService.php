<?php

namespace OpenCompany\Integrations\Amplitude;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * AmplitudeService — HTTP client for the Amplitude Analytics API.
 *
 * Wraps Amplitude REST endpoints used by the integration tools.
 * Authentication is via Bearer token passed in the Authorization header.
 */
class AmplitudeService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.amplitude.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List events from the Amplitude events API.
     *
     * @param  string|null  $userId   Filter by user ID (Amplitude user_id).
     * @param  string|null  $deviceId Filter by device ID.
     * @param  string|null  $start    Start timestamp (ISO 8601 or milliseconds epoch).
     * @param  string|null  $end      End timestamp (ISO 8601 or milliseconds epoch).
     * @param  int          $limit    Maximum number of events to return (default 1000).
     * @return array<string, mixed>
     */
    public function listEvents(
        ?string $userId = null,
        ?string $deviceId = null,
        ?string $start = null,
        ?string $end = null,
        int $limit = 1000,
    ): array {
        $params = ['limit' => $limit];

        if ($userId !== null) {
            $params['user_id'] = $userId;
        }
        if ($deviceId !== null) {
            $params['device_id'] = $deviceId;
        }
        if ($start !== null) {
            $params['start'] = $start;
        }
        if ($end !== null) {
            $params['end'] = $end;
        }

        return $this->request('GET', '/events', $params);
    }

    /**
     * Get a single event by its ID.
     *
     * @param  string|int  $id  The Amplitude event ID.
     * @return array<string, mixed>
     */
    public function getEvent(string|int $id): array
    {
        return $this->request('GET', '/events/' . urlencode((string) $id));
    }

    /**
     * List funnels from the Amplitude dashboard API.
     *
     * @param  int|null  $projectId  Filter by project ID.
     * @param  int       $limit      Maximum number of funnels to return (default 100).
     * @return array<string, mixed>
     */
    public function listFunnels(?int $projectId = null, int $limit = 100): array
    {
        $params = ['limit' => $limit];

        if ($projectId !== null) {
            $params['project_id'] = $projectId;
        }

        return $this->request('GET', '/funnels', $params);
    }

    /**
     * Get a single funnel by its ID.
     *
     * @param  string|int  $id  The funnel ID.
     * @return array<string, mixed>
     */
    public function getFunnel(string|int $id): array
    {
        return $this->request('GET', '/funnels/' . urlencode((string) $id));
    }

    /**
     * List behavioral cohorts from the Amplitude dashboard API.
     *
     * @param  int|null  $projectId  Filter by project ID.
     * @param  int       $limit      Maximum number of cohorts to return (default 100).
     * @return array<string, mixed>
     */
    public function listCohorts(?int $projectId = null, int $limit = 100): array
    {
        $params = ['limit' => $limit];

        if ($projectId !== null) {
            $params['project_id'] = $projectId;
        }

        return $this->request('GET', '/cohorts', $params);
    }

    /**
     * Get a single cohort by its ID.
     *
     * @param  string|int  $id  The cohort ID.
     * @return array<string, mixed>
     */
    public function getCohort(string|int $id): array
    {
        return $this->request('GET', '/cohorts/' . urlencode((string) $id));
    }

    /**
     * Get the currently authenticated user (caller identity).
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. "/events").
     * @param  array   $data    Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Amplitude API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On connection failure or non-2xx response.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Amplitude API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Amplitude API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Amplitude API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Amplitude API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);
                throw new \RuntimeException("Amplitude API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Amplitude API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Amplitude API: {$e->getMessage()}");
        }
    }
}
