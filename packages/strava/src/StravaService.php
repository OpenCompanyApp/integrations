<?php

namespace OpenCompany\Integrations\Strava;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StravaService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://www.strava.com/api/v3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List activities for the authenticated athlete.
     *
     * @param  int  $page  Page number (default 1).
     * @param  int  $perPage  Items per page (default 30, max 200).
     * @param  int|null  $before  Unix timestamp — activities before this time.
     * @param  int|null  $after  Unix timestamp — activities after this time.
     * @return array<int, array<string, mixed>>
     */
    public function listActivities(int $page = 1, int $perPage = 30, ?int $before = null, ?int $after = null): array
    {
        $params = [
            'page' => $page,
            'per_page' => min($perPage, 200),
        ];

        if ($before !== null) {
            $params['before'] = $before;
        }

        if ($after !== null) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/athlete/activities', $params);
    }

    /**
     * Get a single activity by ID.
     *
     * @param  int  $activityId  The activity ID.
     * @return array<string, mixed>
     */
    public function getActivity(int $activityId): array
    {
        return $this->request('GET', '/activities/' . $activityId);
    }

    /**
     * Create a manual activity.
     *
     * @param  string  $name  The name of the activity.
     * @param  string  $type  Activity type (e.g., "Run", "Ride", "Swim").
     * @param  string  $startDateLocal  ISO 8601 local start date (e.g., "2025-01-15T09:30:00").
     * @param  int  $elapsedTime  Elapsed time in seconds.
     * @param  array<string, mixed>  $extra  Additional optional fields (description, distance, trainer, commute).
     * @return array<string, mixed>
     */
    public function createActivity(string $name, string $type, string $startDateLocal, int $elapsedTime, array $extra = []): array
    {
        $data = array_merge([
            'name' => $name,
            'type' => $type,
            'start_date_local' => $startDateLocal,
            'elapsed_time' => $elapsedTime,
        ], $extra);

        return $this->request('POST', '/activities', $data);
    }

    /**
     * Get the authenticated athlete's profile.
     *
     * @return array<string, mixed>
     */
    public function getAthlete(): array
    {
        return $this->request('GET', '/athlete');
    }

    /**
     * List clubs the authenticated athlete belongs to.
     *
     * @param  int  $page  Page number (default 1).
     * @param  int  $perPage  Items per page (default 30).
     * @return array<int, array<string, mixed>>
     */
    public function listClubs(int $page = 1, int $perPage = 30): array
    {
        return $this->request('GET', '/athlete/clubs', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/athlete/activities").
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Strava API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Strava access token is not configured.');
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
                $error = $response->json('message') ?? $response->body();

                Log::error("Strava API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Strava API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Strava API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Strava API: {$e->getMessage()}");
        }
    }
}
