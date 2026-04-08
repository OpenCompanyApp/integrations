<?php

namespace OpenCompany\Integrations\Mixpanel;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * MixpanelService — HTTP client for the Mixpanel Analytics API.
 *
 * Wraps all Mixpanel v1 REST endpoints used by the integration tools.
 * Authentication is via Bearer token passed in the Authorization header.
 */
class MixpanelService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.mixpanel.com/v1',
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
     * List events from the Mixpanel events API.
     *
     * @param  string|null  $type    Event type: "general" or "unique" (default "general").
     * @param  string|null  $unit    Time unit: "hour", "day", "week", "month" (default "day").
     * @param  string|null  $from    Start date (YYYY-MM-DD).
     * @param  string|null  $to      End date (YYYY-MM-DD).
     * @param  int          $limit   Maximum number of events to return (default 100).
     * @return array<string, mixed>
     */
    public function listEvents(
        ?string $type = null,
        ?string $unit = null,
        ?string $from = null,
        ?string $to = null,
        int $limit = 100,
    ): array {
        $params = ['limit' => $limit];

        if ($type !== null) {
            $params['type'] = $type;
        }
        if ($unit !== null) {
            $params['unit'] = $unit;
        }
        if ($from !== null) {
            $params['from_date'] = $from;
        }
        if ($to !== null) {
            $params['to_date'] = $to;
        }

        return $this->request('GET', '/events', $params);
    }

    /**
     * Get a single event's data by name.
     *
     * @param  string      $name    The event name.
     * @param  string|null  $type    Event type: "general" or "unique" (default "general").
     * @param  string|null  $unit    Time unit: "hour", "day", "week", "month" (default "day").
     * @param  string|null  $from    Start date (YYYY-MM-DD).
     * @param  string|null  $to      End date (YYYY-MM-DD).
     * @return array<string, mixed>
     */
    public function getEvent(
        string $name,
        ?string $type = null,
        ?string $unit = null,
        ?string $from = null,
        ?string $to = null,
    ): array {
        $params = ['event' => $name];

        if ($type !== null) {
            $params['type'] = $type;
        }
        if ($unit !== null) {
            $params['unit'] = $unit;
        }
        if ($from !== null) {
            $params['from_date'] = $from;
        }
        if ($to !== null) {
            $params['to_date'] = $to;
        }

        return $this->request('GET', '/events', $params);
    }

    /**
     * List funnels from the Mixpanel funnels API.
     *
     * @return array<string, mixed>
     */
    public function listFunnels(): array
    {
        return $this->request('GET', '/funnels/list');
    }

    /**
     * Get a single funnel by its ID.
     *
     * @param  string|int  $id  The Mixpanel funnel ID.
     * @return array<string, mixed>
     */
    public function getFunnel(string|int $id): array
    {
        return $this->request('GET', '/funnels', [
            'funnel_id' => $id,
        ]);
    }

    /**
     * List cohorts from the Mixpanel cohorts API.
     *
     * @return array<string, mixed>
     */
    public function listCohorts(): array
    {
        return $this->request('GET', '/cohorts/list');
    }

    /**
     * Get a single cohort by its ID.
     *
     * @param  string|int  $id  The Mixpanel cohort ID.
     * @return array<string, mixed>
     */
    public function getCohort(string|int $id): array
    {
        return $this->request('GET', '/cohorts', [
            'cohort_id' => $id,
        ]);
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
     * Make a raw HTTP request to the Mixpanel API.
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
            throw new \RuntimeException('Mixpanel API key is not configured.');
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
                    Log::warning("Mixpanel API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Mixpanel API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Mixpanel API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);
                throw new \RuntimeException("Mixpanel API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mixpanel API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Mixpanel API: {$e->getMessage()}");
        }
    }
}
