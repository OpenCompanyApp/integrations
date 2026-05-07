<?php

namespace OpenCompany\Integrations\OneSignal;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the current OneSignal REST API.
 *
 * Handles app-key authentication and exposes messaging, user, subscription,
 * segment, template, analytics, and app operations for tool classes.
 */
class OneSignalService
{
    /**
     * @param  string  $apiKey  OneSignal App API key or Organization API key.
     * @param  string  $appId  Default OneSignal App ID.
     * @param  string  $baseUrl  Base URL for the OneSignal REST API.
     */
    public function __construct(
        private string $apiKey = '',
        private string $appId = '',
        private string $baseUrl = 'https://api.onesignal.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * List messages for an app.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  array<string, mixed>|int  $params  Query parameters, or legacy limit.
     * @param  int  $offset  Legacy offset argument.
     * @return array<string, mixed>
     */
    public function listNotifications(?string $appId = null, array|int $params = [], int $offset = 0): array
    {
        if (is_int($params)) {
            $params = ['limit' => $params, 'offset' => $offset];
        }

        return $this->request('GET', '/notifications', ['app_id' => $this->resolveAppId($appId)] + $params);
    }

    /**
     * Get a message and optional outcome details.
     *
     * @param  string  $id  Message ID.
     * @param  string|null  $appId  OneSignal app ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function getNotification(string $id, ?string $appId = null, array $params = []): array
    {
        return $this->request('GET', '/notifications/' . rawurlencode($id), ['app_id' => $this->resolveAppId($appId)] + $params);
    }

    /**
     * Create a push, email, or SMS message.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  array<string, mixed>  $payload  Message payload.
     * @return array<string, mixed>
     */
    public function createMessage(?string $appId, array $payload): array
    {
        return $this->request('POST', '/notifications', ['app_id' => $this->resolveAppId($appId)] + $payload);
    }

    /**
     * Legacy-compatible create notification wrapper.
     *
     * @param  string  $appId  OneSignal app ID.
     * @param  array<string, string>  $contents  Localized message body.
     * @param  array<string, string>|null  $headings  Localized title.
     * @param  array<int, string>|null  $includedSegments  Target segments.
     * @param  string|null  $url  Click URL.
     * @param  array<string, mixed>|null  $data  Custom data.
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
        $payload = ['contents' => $contents];

        if ($headings !== null) {
            $payload['headings'] = $headings;
        }

        if ($includedSegments !== null) {
            $payload['included_segments'] = $includedSegments;
        }

        if ($url !== null) {
            $payload['url'] = $url;
        }

        if ($data !== null) {
            $payload['data'] = $data;
        }

        return $this->createMessage($appId, $payload);
    }

    /**
     * Cancel a scheduled or currently outgoing message.
     *
     * @param  string  $messageId  Message ID.
     * @param  string|null  $appId  OneSignal app ID.
     * @return array<string, mixed>
     */
    public function cancelNotification(string $messageId, ?string $appId = null): array
    {
        return $this->request('DELETE', '/notifications/' . rawurlencode($messageId), [
            'app_id' => $this->resolveAppId($appId),
        ]);
    }

    /**
     * List legacy device/player records.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  int  $limit  Maximum rows.
     * @param  int  $offset  Offset.
     * @return array<string, mixed>
     */
    public function listDevices(?string $appId = null, int $limit = 50, int $offset = 0): array
    {
        return $this->request('GET', '/players', [
            'app_id' => $this->resolveAppId($appId),
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Fetch a legacy device/player record.
     *
     * @param  string  $id  Player ID.
     * @param  string|null  $appId  OneSignal app ID.
     * @return array<string, mixed>
     */
    public function getDevice(string $id, ?string $appId = null): array
    {
        return $this->request('GET', '/players/' . rawurlencode($id), [
            'app_id' => $this->resolveAppId($appId),
        ]);
    }

    /**
     * List apps accessible with the configured organization key.
     *
     * @return array<string, mixed>
     */
    public function listApps(): array
    {
        return $this->request('GET', '/apps');
    }

    /**
     * Get app details.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @return array<string, mixed>
     */
    public function getCurrentApp(?string $appId = null): array
    {
        return $this->request('GET', '/apps/' . rawurlencode($this->resolveAppId($appId)));
    }

    /**
     * Update app configuration.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  array<string, mixed>  $payload  App update payload.
     * @return array<string, mixed>
     */
    public function updateApp(?string $appId, array $payload): array
    {
        return $this->request('PATCH', '/apps/' . rawurlencode($this->resolveAppId($appId)), $payload);
    }

    /**
     * Create a user with optional aliases, properties, and subscriptions.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  array<string, mixed>  $payload  User payload.
     * @return array<string, mixed>
     */
    public function createUser(?string $appId, array $payload): array
    {
        return $this->request('POST', '/apps/' . rawurlencode($this->resolveAppId($appId)) . '/users', $payload);
    }

    /**
     * View a user by alias.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $aliasLabel  Alias label.
     * @param  string  $aliasId  Alias value.
     * @return array<string, mixed>
     */
    public function getUser(?string $appId, string $aliasLabel, string $aliasId): array
    {
        return $this->request('GET', $this->userPath($appId, $aliasLabel, $aliasId));
    }

    /**
     * Update a user by alias.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $aliasLabel  Alias label.
     * @param  string  $aliasId  Alias value.
     * @param  array<string, mixed>  $payload  User payload.
     * @return array<string, mixed>
     */
    public function updateUser(?string $appId, string $aliasLabel, string $aliasId, array $payload): array
    {
        return $this->request('PATCH', $this->userPath($appId, $aliasLabel, $aliasId), $payload);
    }

    /**
     * Delete a user and its subscriptions by alias.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $aliasLabel  Alias label.
     * @param  string  $aliasId  Alias value.
     * @return array<string, mixed>
     */
    public function deleteUser(?string $appId, string $aliasLabel, string $aliasId): array
    {
        return $this->request('DELETE', $this->userPath($appId, $aliasLabel, $aliasId));
    }

    /**
     * Fetch all aliases for a user.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $aliasLabel  Alias label.
     * @param  string  $aliasId  Alias value.
     * @return array<string, mixed>
     */
    public function getUserIdentity(?string $appId, string $aliasLabel, string $aliasId): array
    {
        return $this->request('GET', $this->userPath($appId, $aliasLabel, $aliasId) . '/identity');
    }

    /**
     * Create or update aliases for a user.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $aliasLabel  Alias label.
     * @param  string  $aliasId  Alias value.
     * @param  array<string, mixed>  $identity  Identity aliases.
     * @return array<string, mixed>
     */
    public function createOrUpdateAlias(?string $appId, string $aliasLabel, string $aliasId, array $identity): array
    {
        return $this->request('PATCH', $this->userPath($appId, $aliasLabel, $aliasId) . '/identity', [
            'identity' => $identity,
        ]);
    }

    /**
     * Remove an alias from a user.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $aliasLabel  Alias label.
     * @param  string  $aliasId  Alias value.
     * @param  string  $aliasLabelToDelete  Alias label to remove.
     * @return array<string, mixed>
     */
    public function deleteAlias(?string $appId, string $aliasLabel, string $aliasId, string $aliasLabelToDelete): array
    {
        return $this->request('DELETE', $this->userPath($appId, $aliasLabel, $aliasId) . '/identity/' . rawurlencode($aliasLabelToDelete));
    }

    /**
     * Fetch user identity by subscription ID.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $subscriptionId  Subscription ID.
     * @return array<string, mixed>
     */
    public function getIdentityBySubscription(?string $appId, string $subscriptionId): array
    {
        return $this->request('GET', $this->subscriptionPath($appId, $subscriptionId) . '/user/identity');
    }

    /**
     * Create or update aliases using a subscription ID.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $subscriptionId  Subscription ID.
     * @param  array<string, mixed>  $identity  Identity aliases.
     * @return array<string, mixed>
     */
    public function createAliasBySubscription(?string $appId, string $subscriptionId, array $identity): array
    {
        return $this->request('PATCH', $this->subscriptionPath($appId, $subscriptionId) . '/user/identity', [
            'identity' => $identity,
        ]);
    }

    /**
     * Create a subscription for a user identified by alias.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $aliasLabel  Alias label.
     * @param  string  $aliasId  Alias value.
     * @param  array<string, mixed>  $payload  Subscription payload.
     * @return array<string, mixed>
     */
    public function createSubscription(?string $appId, string $aliasLabel, string $aliasId, array $payload): array
    {
        return $this->request('POST', $this->userPath($appId, $aliasLabel, $aliasId) . '/subscriptions', $payload);
    }

    /**
     * Update a subscription by ID.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $subscriptionId  Subscription ID.
     * @param  array<string, mixed>  $payload  Subscription payload.
     * @return array<string, mixed>
     */
    public function updateSubscription(?string $appId, string $subscriptionId, array $payload): array
    {
        return $this->request('PATCH', $this->subscriptionPath($appId, $subscriptionId), $payload);
    }

    /**
     * Transfer a subscription to a different user identity.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $subscriptionId  Subscription ID.
     * @param  array<string, mixed>  $identity  Destination identity.
     * @return array<string, mixed>
     */
    public function transferSubscription(?string $appId, string $subscriptionId, array $identity): array
    {
        return $this->request('PATCH', $this->subscriptionPath($appId, $subscriptionId) . '/owner', [
            'identity' => $identity,
        ]);
    }

    /**
     * List segments for an app.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listSegments(?string $appId, array $params = []): array
    {
        return $this->request('GET', '/apps/' . rawurlencode($this->resolveAppId($appId)) . '/segments', $params);
    }

    /**
     * Get a segment, optionally including filters.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $segmentId  Segment ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function getSegment(?string $appId, string $segmentId, array $params = []): array
    {
        return $this->request('GET', $this->segmentPath($appId, $segmentId), $params);
    }

    /**
     * Create a segment.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  array<string, mixed>  $payload  Segment payload.
     * @return array<string, mixed>
     */
    public function createSegment(?string $appId, array $payload): array
    {
        return $this->request('POST', '/apps/' . rawurlencode($this->resolveAppId($appId)) . '/segments', $payload);
    }

    /**
     * Update a segment.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $segmentId  Segment ID.
     * @param  array<string, mixed>  $payload  Segment payload.
     * @return array<string, mixed>
     */
    public function updateSegment(?string $appId, string $segmentId, array $payload): array
    {
        return $this->request('PATCH', $this->segmentPath($appId, $segmentId), $payload);
    }

    /**
     * Delete a segment.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $segmentId  Segment ID.
     * @return array<string, mixed>
     */
    public function deleteSegment(?string $appId, string $segmentId): array
    {
        return $this->request('DELETE', $this->segmentPath($appId, $segmentId));
    }

    /**
     * List message templates.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listTemplates(?string $appId, array $params = []): array
    {
        return $this->request('GET', '/templates', ['app_id' => $this->resolveAppId($appId)] + $params);
    }

    /**
     * Get a template.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $templateId  Template ID.
     * @return array<string, mixed>
     */
    public function getTemplate(?string $appId, string $templateId): array
    {
        return $this->request('GET', '/templates/' . rawurlencode($templateId), [
            'app_id' => $this->resolveAppId($appId),
        ]);
    }

    /**
     * Create a template.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  array<string, mixed>  $payload  Template payload.
     * @return array<string, mixed>
     */
    public function createTemplate(?string $appId, array $payload): array
    {
        return $this->request('POST', '/templates', ['app_id' => $this->resolveAppId($appId)] + $payload);
    }

    /**
     * Update a template.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $templateId  Template ID.
     * @param  array<string, mixed>  $payload  Template payload.
     * @return array<string, mixed>
     */
    public function updateTemplate(?string $appId, string $templateId, array $payload): array
    {
        return $this->request('PATCH', '/templates/' . rawurlencode($templateId), ['app_id' => $this->resolveAppId($appId)] + $payload);
    }

    /**
     * Delete a template.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  string  $templateId  Template ID.
     * @return array<string, mixed>
     */
    public function deleteTemplate(?string $appId, string $templateId): array
    {
        return $this->request('DELETE', '/templates/' . rawurlencode($templateId), [
            'app_id' => $this->resolveAppId($appId),
        ]);
    }

    /**
     * View outcome analytics.
     *
     * @param  string|null  $appId  OneSignal app ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function viewOutcomes(?string $appId, array $params): array
    {
        return $this->request('GET', '/apps/' . rawurlencode($this->resolveAppId($appId)) . '/outcomes', $params);
    }

    /**
     * Execute a safe raw GET request.
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
     * Execute a safe raw POST request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON payload.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a safe raw PATCH request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON payload.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a safe raw DELETE request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON payload.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204 || trim($response->body()) === '') {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the OneSignal API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return Response
     *
     * @throws RuntimeException On authentication, connection, or API errors.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->apiKey) {
            throw new RuntimeException('OneSignal API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Key ' . $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->withOptions(['query' => $data])->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("OneSignal API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("OneSignal API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('errors') ?? $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("OneSignal API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("OneSignal API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("OneSignal API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to OneSignal API: {$e->getMessage()}");
        }
    }

    /**
     * Resolve an explicit app ID or the configured default.
     */
    private function resolveAppId(?string $appId): string
    {
        $resolved = $appId ?: $this->appId;

        if ($resolved === '') {
            throw new RuntimeException('OneSignal app ID is required.');
        }

        return $resolved;
    }

    /**
     * Build a user-by-alias path.
     */
    private function userPath(?string $appId, string $aliasLabel, string $aliasId): string
    {
        return '/apps/' . rawurlencode($this->resolveAppId($appId)) . '/users/by/' . rawurlencode($aliasLabel) . '/' . rawurlencode($aliasId);
    }

    /**
     * Build a subscription path.
     */
    private function subscriptionPath(?string $appId, string $subscriptionId): string
    {
        return '/apps/' . rawurlencode($this->resolveAppId($appId)) . '/subscriptions/' . rawurlencode($subscriptionId);
    }

    /**
     * Build a segment path.
     */
    private function segmentPath(?string $appId, string $segmentId): string
    {
        return '/apps/' . rawurlencode($this->resolveAppId($appId)) . '/segments/' . rawurlencode($segmentId);
    }

    /**
     * Normalize raw helper paths to safe relative API paths.
     */
    private function normalizePath(string $path): string
    {
        $path = '/' . ltrim(trim($path), '/');

        if ($path === '/' || str_contains($path, '://') || str_contains($path, '//')) {
            throw new RuntimeException('Path must be a non-empty relative OneSignal API path.');
        }

        return $path;
    }
}
