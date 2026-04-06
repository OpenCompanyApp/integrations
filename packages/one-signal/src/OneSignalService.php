<?php

namespace OpenCompany\Integrations\OneSignal;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * OneSignal API service for sending push notifications and managing devices.
 *
 * Handles authentication via Bearer token and provides methods for all
 * OneSignal REST API v1 endpoints used by this integration.
 */
class OneSignalService
{
    public function __construct(
        private string $apiKey = '',
        private string $appId = '',
        private string $baseUrl = 'https://onesignal.com/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the configured OneSignal app ID.
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * List notifications for an app.
     *
     * @param  string  $appId  The OneSignal app ID.
     * @param  int  $limit  Maximum number of notifications to return (default 50).
     * @param  int  $offset  Offset for pagination (default 0).
     * @return array<string, mixed>
     */
    public function listNotifications(string $appId, int $limit = 50, int $offset = 0): array
    {
        return $this->request('GET', '/notifications', [
            'app_id' => $appId,
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single notification by ID.
     *
     * @param  string  $id  The notification ID.
     * @param  string  $appId  The OneSignal app ID.
     * @return array<string, mixed>
     */
    public function getNotification(string $id, string $appId): array
    {
        return $this->request('GET', '/notifications/' . urlencode($id), [
            'app_id' => $appId,
        ]);
    }

    /**
     * Create and send a new push notification.
     *
     * @param  string  $appId  The OneSignal app ID.
     * @param  array<string, string>  $contents  Notification body per language, e.g. {"en": "Hello!"}.
     * @param  array<string, string>|null  $headings  Notification title per language, e.g. {"en": "Update"}.
     * @param  array<string>|null  $includedSegments  Target segments, e.g. ["All", "Active Users"].
     * @param  string|null  $url  URL to open when the notification is clicked.
     * @param  array<string, mixed>|null  $data  Custom data payload delivered to the app.
     * @return array<string, mixed>
     */
    public function createNotification(
        string $appId,
        array $contents,
        ?array $headings = null,
        ?array $includedSegments = null,
        ?string $url = null,
        ?array $data = null,
    ): array {
        $body = [
            'app_id' => $appId,
            'contents' => $contents,
        ];

        if ($headings !== null) {
            $body['headings'] = $headings;
        }

        if ($includedSegments !== null) {
            $body['included_segments'] = $includedSegments;
        }

        if ($url !== null) {
            $body['url'] = $url;
        }

        if ($data !== null) {
            $body['data'] = $data;
        }

        return $this->request('POST', '/notifications', $body);
    }

    /**
     * List devices (players) registered for an app.
     *
     * @param  string  $appId  The OneSignal app ID.
     * @param  int  $limit  Maximum number of devices to return (default 50).
     * @param  int  $offset  Offset for pagination (default 0).
     * @return array<string, mixed>
     */
    public function listDevices(string $appId, int $limit = 50, int $offset = 0): array
    {
        return $this->request('GET', '/players', [
            'app_id' => $appId,
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single device (player) by ID.
     *
     * @param  string  $id  The device/player ID.
     * @param  string  $appId  The OneSignal app ID.
     * @return array<string, mixed>
     */
    public function getDevice(string $id, string $appId): array
    {
        return $this->request('GET', '/players/' . urlencode($id), [
            'app_id' => $appId,
        ]);
    }

    /**
     * List all apps accessible with the configured API key.
     *
     * @return array<string, mixed>
     */
    public function listApps(): array
    {
        return $this->request('GET', '/apps');
    }

    /**
     * Get the current app by its ID (returns app details).
     *
     * @param  string  $appId  The OneSignal app ID.
     * @return array<string, mixed>
     */
    public function getCurrentApp(string $appId): array
    {
        return $this->request('GET', '/apps/' . urlencode($appId));
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the OneSignal API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On authentication, connection, or API errors.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('OneSignal API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Basic ' . $this->apiKey,
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
                    Log::warning("OneSignal API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("OneSignal API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is down.");
                }

                $error = $response->json('errors') ?? $response->json('error') ?? $body;
                Log::error("OneSignal API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("OneSignal API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("OneSignal API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to OneSignal API: {$e->getMessage()}");
        }
    }
}
