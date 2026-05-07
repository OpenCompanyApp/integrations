<?php

namespace OpenCompany\Integrations\Strava;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Strava API v3.
 *
 * Handles activities, athletes, clubs, routes, streams, segments, uploads,
 * and generic relative API calls.
 */
class StravaService
{
    /**
     * @param  string  $accessToken  Strava OAuth access token.
     * @param  string  $baseUrl  Strava API v3 base URL.
     */
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
     * @param  int|null  $before  Unix timestamp for activities before this time.
     * @param  int|null  $after  Unix timestamp for activities after this time.
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
     * Update a Strava activity.
     *
     * @param  int  $activityId  Activity ID.
     * @param  array<string, mixed>  $payload  Activity update payload.
     * @return array<string, mixed>
     */
    public function updateActivity(int $activityId, array $payload): array
    {
        return $this->request('PUT', '/activities/' . $activityId, $payload);
    }

    /**
     * Get streams for an activity.
     *
     * @param  int  $activityId  Activity ID.
     * @param  array<int, string>  $keys  Stream keys such as time, distance, latlng, altitude, velocity_smooth, heartrate, cadence, watts, temp, moving, grade_smooth.
     * @param  string|null  $resolution  Stream resolution.
     * @param  string|null  $seriesType  Series type: time or distance.
     * @return array<string, mixed>
     */
    public function getActivityStreams(int $activityId, array $keys, ?string $resolution = null, ?string $seriesType = null): array
    {
        return $this->request('GET', '/activities/' . $activityId . '/streams', array_filter([
            'keys' => implode(',', $keys),
            'key_by_type' => true,
            'resolution' => $resolution,
            'series_type' => $seriesType,
        ], static fn ($value): bool => $value !== null && $value !== ''));
    }

    /**
     * Get laps for an activity.
     *
     * @param  int  $activityId  Activity ID.
     * @return array<int, array<string, mixed>>
     */
    public function listActivityLaps(int $activityId): array
    {
        return $this->request('GET', '/activities/' . $activityId . '/laps');
    }

    /**
     * Get zones for an activity.
     *
     * @param  int  $activityId  Activity ID.
     * @return array<int, array<string, mixed>>
     */
    public function getActivityZones(int $activityId): array
    {
        return $this->request('GET', '/activities/' . $activityId . '/zones');
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
     * Upload an activity file for processing.
     *
     * @param  string  $filePath  Absolute path to the activity file.
     * @param  string  $dataType  File type: fit, fit.gz, tcx, tcx.gz, gpx, gpx.gz.
     * @param  array<string, mixed>  $params  Optional upload parameters.
     * @return array<string, mixed>
     */
    public function uploadActivity(string $filePath, string $dataType, array $params = []): array
    {
        if (!file_exists($filePath)) {
            throw new RuntimeException("File not found: {$filePath}");
        }

        return $this->rawUpload('/uploads', $filePath, array_merge($params, [
            'data_type' => $dataType,
        ]))->json() ?? [];
    }

    /**
     * Get upload processing status.
     *
     * @param  int  $uploadId  Upload ID.
     * @return array<string, mixed>
     */
    public function getUpload(int $uploadId): array
    {
        return $this->request('GET', '/uploads/' . $uploadId);
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
     * Get stats for an athlete.
     *
     * @param  int  $athleteId  Athlete ID.
     * @return array<string, mixed>
     */
    public function getAthleteStats(int $athleteId): array
    {
        return $this->request('GET', '/athletes/' . $athleteId . '/stats');
    }

    /**
     * Get heart rate and power zones for the authenticated athlete.
     *
     * @return array<string, mixed>
     */
    public function getAthleteZones(): array
    {
        return $this->request('GET', '/athlete/zones');
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
     * Get a club by ID.
     *
     * @param  int  $clubId  Club ID.
     * @return array<string, mixed>
     */
    public function getClub(int $clubId): array
    {
        return $this->request('GET', '/clubs/' . $clubId);
    }

    /**
     * List club activities.
     *
     * @param  int  $clubId  Club ID.
     * @param  int  $page  Page number.
     * @param  int  $perPage  Items per page.
     * @return array<int, array<string, mixed>>
     */
    public function listClubActivities(int $clubId, int $page = 1, int $perPage = 30): array
    {
        return $this->request('GET', '/clubs/' . $clubId . '/activities', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * List club members.
     *
     * @param  int  $clubId  Club ID.
     * @param  int  $page  Page number.
     * @param  int  $perPage  Items per page.
     * @return array<int, array<string, mixed>>
     */
    public function listClubMembers(int $clubId, int $page = 1, int $perPage = 30): array
    {
        return $this->request('GET', '/clubs/' . $clubId . '/members', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * List routes for an athlete.
     *
     * @param  int  $athleteId  Athlete ID.
     * @param  int  $page  Page number.
     * @param  int  $perPage  Items per page.
     * @return array<int, array<string, mixed>>
     */
    public function listRoutes(int $athleteId, int $page = 1, int $perPage = 30): array
    {
        return $this->request('GET', '/athletes/' . $athleteId . '/routes', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get a route by ID.
     *
     * @param  int  $routeId  Route ID.
     * @return array<string, mixed>
     */
    public function getRoute(int $routeId): array
    {
        return $this->request('GET', '/routes/' . $routeId);
    }

    /**
     * Export a route as GPX or TCX.
     *
     * @param  int  $routeId  Route ID.
     * @param  string  $format  Export format: gpx or tcx.
     * @return array<string, mixed>
     */
    public function exportRoute(int $routeId, string $format): array
    {
        return $this->request('GET', '/routes/' . $routeId . '/export_' . $format);
    }

    /**
     * Get route streams.
     *
     * @param  int  $routeId  Route ID.
     * @return array<string, mixed>
     */
    public function getRouteStreams(int $routeId): array
    {
        return $this->request('GET', '/routes/' . $routeId . '/streams');
    }

    /**
     * List starred segments for the authenticated athlete.
     *
     * @param  int  $page  Page number.
     * @param  int  $perPage  Items per page.
     * @return array<int, array<string, mixed>>
     */
    public function listStarredSegments(int $page = 1, int $perPage = 30): array
    {
        return $this->request('GET', '/segments/starred', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get a segment by ID.
     *
     * @param  int  $segmentId  Segment ID.
     * @return array<string, mixed>
     */
    public function getSegment(int $segmentId): array
    {
        return $this->request('GET', '/segments/' . $segmentId);
    }

    /**
     * Star or unstar a segment.
     *
     * @param  int  $segmentId  Segment ID.
     * @param  bool  $starred  Whether the segment should be starred.
     * @return array<string, mixed>
     */
    public function starSegment(int $segmentId, bool $starred): array
    {
        return $this->request('PUT', '/segments/' . $segmentId . '/starred', [
            'starred' => $starred,
        ]);
    }

    /**
     * Explore segments in a bounding box.
     *
     * @param  array<int, float|int|string>  $bounds  Southwest and northeast bounds.
     * @param  string|null  $activityType  ride or running.
     * @param  int|null  $minCat  Minimum climb category.
     * @param  int|null  $maxCat  Maximum climb category.
     * @return array<string, mixed>
     */
    public function exploreSegments(array $bounds, ?string $activityType = null, ?int $minCat = null, ?int $maxCat = null): array
    {
        return $this->request('GET', '/segments/explore', array_filter([
            'bounds' => implode(',', $bounds),
            'activity_type' => $activityType,
            'min_cat' => $minCat,
            'max_cat' => $maxCat,
        ], static fn ($value): bool => $value !== null && $value !== ''));
    }

    /**
     * List efforts for a segment.
     *
     * @param  int  $segmentId  Segment ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<int, array<string, mixed>>
     */
    public function listSegmentEfforts(int $segmentId, array $params = []): array
    {
        return $this->request('GET', '/segment_efforts', array_merge($params, [
            'segment_id' => $segmentId,
        ]));
    }

    /**
     * Get one segment effort by ID.
     *
     * @param  int  $effortId  Segment effort ID.
     * @return array<string, mixed>
     */
    public function getSegmentEffort(int $effortId): array
    {
        return $this->request('GET', '/segment_efforts/' . $effortId);
    }

    /**
     * Get segment streams.
     *
     * @param  int  $segmentId  Segment ID.
     * @param  array<int, string>  $keys  Stream keys.
     * @param  string|null  $resolution  Stream resolution.
     * @param  string|null  $seriesType  Series type.
     * @return array<string, mixed>
     */
    public function getSegmentStreams(int $segmentId, array $keys, ?string $resolution = null, ?string $seriesType = null): array
    {
        return $this->request('GET', '/segments/' . $segmentId . '/streams', array_filter([
            'keys' => implode(',', $keys),
            'key_by_type' => true,
            'resolution' => $resolution,
            'series_type' => $seriesType,
        ], static fn ($value): bool => $value !== null && $value !== ''));
    }

    /**
     * Send a GET request to a relative Strava API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Send a POST request to a relative Strava API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Send a PUT request to a relative Strava API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Send a DELETE request to a relative Strava API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  Optional JSON body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
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
        return $response->json() ?? ($response->body() === '' ? [] : ['body' => $response->body()]);
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
            throw new RuntimeException('Strava access token is not configured.');
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
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->body();

                Log::error("Strava API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Strava API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Strava API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Strava API: {$e->getMessage()}");
        }
    }

    /**
     * Upload a multipart activity file.
     *
     * @param  string  $path  API path.
     * @param  string  $filePath  Local file path.
     * @param  array<string, mixed>  $params  Multipart form parameters.
     * @return \Illuminate\Http\Client\Response
     */
    private function rawUpload(string $path, string $filePath, array $params = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new RuntimeException('Strava access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $request = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
            ])->timeout(120)->attach('file', file_get_contents($filePath), basename($filePath));

            foreach ($params as $key => $value) {
                if ($value !== null && $value !== '') {
                    $request = $request->attach($key, (string) $value);
                }
            }

            $response = $request->post($url);

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->body();
                Log::error("Strava API upload error: POST {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("Strava API upload error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Strava API connection error: upload {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Strava API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize and validate caller-supplied relative API paths.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || str_contains($path, '://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Strava API path must be relative, such as /athlete.');
        }

        return str_starts_with($path, '/') ? $path : '/' . $path;
    }
}
