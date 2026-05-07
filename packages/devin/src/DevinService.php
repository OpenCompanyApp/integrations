<?php

namespace OpenCompany\Integrations\Devin;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Devin REST API.
 *
 * Supports the current v3 organization API while preserving legacy v1 session
 * endpoints when a host is still configured with a /v1 API URL.
 */
class DevinService
{
    private string $baseUrl;

    private string $apiVersion;

    /**
     * @param  string  $apiKey  Devin personal, service, or service-user API key.
     * @param  string  $baseUrl  Devin API root URL, optionally including /v1 or /v3 for legacy hosts.
     * @param  string  $orgId  Devin organization ID for v3 organization-scoped endpoints.
     * @param  string  $apiVersion  Preferred API version, usually v3.
     */
    public function __construct(
        private string $apiKey = '',
        string $baseUrl = 'https://api.devin.ai',
        private string $orgId = '',
        string $apiVersion = 'v3',
    ) {
        $baseUrl = rtrim($baseUrl, '/');

        if (str_ends_with($baseUrl, '/v1')) {
            $baseUrl = substr($baseUrl, 0, -3);
            $apiVersion = 'v1';
        } elseif (str_ends_with($baseUrl, '/v3')) {
            $baseUrl = substr($baseUrl, 0, -3);
            $apiVersion = 'v3';
        }

        $this->baseUrl = $baseUrl;
        $this->apiVersion = $apiVersion === 'v1' ? 'v1' : 'v3';
        $this->orgId = trim($this->orgId);
    }

    /**
     * Check whether the Devin integration has an API key.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Create a Devin session.
     *
     * @param  string  $prompt  The task prompt for Devin to execute.
     * @param  array<string, mixed>  $options  Optional session settings such as tags, playbook_id, repos, or create_as_user_id.
     * @return array<string, mixed>
     */
    public function createSession(string $prompt, array $options = []): array
    {
        $payload = $this->sessionPayload($prompt, $options);

        if ($this->usesLegacyV1()) {
            return $this->request('POST', '/v1/sessions', $this->onlyKeys($payload, [
                'prompt',
                'idempotent',
                'knowledge_ids',
                'max_acu_limit',
                'playbook_id',
                'secret_ids',
                'session_secrets',
                'snapshot_id',
                'structured_output_schema',
                'tags',
                'title',
                'unlisted',
            ]));
        }

        return $this->request('POST', $this->organizationPath('/sessions'), $this->onlyKeys($payload, [
            'prompt',
            'advanced_mode',
            'attachment_urls',
            'bypass_approval',
            'child_playbook_id',
            'create_as_user_id',
            'knowledge_ids',
            'max_acu_limit',
            'playbook_id',
            'repos',
            'secret_ids',
            'session_links',
            'session_secrets',
            'structured_output_schema',
            'tags',
            'title',
        ]));
    }

    /**
     * Get details for a Devin session.
     *
     * @param  string  $sessionId  Devin session ID, usually prefixed with devin- for v3.
     * @return array<string, mixed>
     */
    public function getSession(string $sessionId): array
    {
        if ($this->usesLegacyV1()) {
            return $this->request('GET', '/v1/sessions/'.$this->path($sessionId));
        }

        return $this->request('GET', $this->organizationPath('/sessions/'.$this->path($sessionId)));
    }

    /**
     * List Devin sessions.
     *
     * @param  array<string, mixed>  $params  Pagination and filtering parameters.
     * @return array<string, mixed>
     */
    public function listSessions(array $params = []): array
    {
        if ($this->usesLegacyV1()) {
            return $this->request('GET', '/v1/sessions', $this->onlyKeys($params, [
                'limit',
                'offset',
                'skip',
                'tags',
                'user_email',
            ]));
        }

        return $this->request('GET', $this->organizationPath('/sessions'), $this->onlyKeys($params, [
            'after',
            'first',
            'session_ids',
            'created_after',
            'created_before',
            'updated_after',
            'updated_before',
            'tags',
            'playbook_id',
            'origins',
            'schedule_id',
            'user_ids',
            'service_user_ids',
        ]));
    }

    /**
     * Send a message to an existing Devin session.
     *
     * @param  string  $sessionId  Devin session ID.
     * @param  string  $message  Message content.
     * @param  string|null  $messageAsUserId  Optional user ID for v3 attribution.
     * @return array<string, mixed>
     */
    public function sendMessage(string $sessionId, string $message, ?string $messageAsUserId = null): array
    {
        $payload = ['message' => $message];

        if ($messageAsUserId !== null) {
            $payload['message_as_user_id'] = $messageAsUserId;
        }

        if ($this->usesLegacyV1()) {
            return $this->request('POST', '/v1/sessions/'.$this->path($sessionId).'/message', ['message' => $message]);
        }

        return $this->request('POST', $this->organizationPath('/sessions/'.$this->path($sessionId).'/messages'), $payload);
    }

    /**
     * Terminate an active Devin session.
     *
     * @param  string  $sessionId  Devin session ID.
     * @param  bool  $archive  Whether to archive the v3 session while terminating.
     * @return array<string, mixed>
     */
    public function terminateSession(string $sessionId, bool $archive = false): array
    {
        if ($this->usesLegacyV1()) {
            return $this->request('DELETE', '/v1/sessions/'.$this->path($sessionId));
        }

        $path = $this->organizationPath('/sessions/'.$this->path($sessionId));

        if ($archive) {
            $path .= '?archive=true';
        }

        return $this->request('DELETE', $path);
    }

    /**
     * List messages for a v3 Devin session.
     *
     * @param  string  $sessionId  Devin session ID.
     * @param  array<string, mixed>  $params  Cursor pagination parameters.
     * @return array<string, mixed>
     */
    public function listSessionMessages(string $sessionId, array $params = []): array
    {
        $this->requireV3('Session message listing');

        return $this->request('GET', $this->organizationPath('/sessions/'.$this->path($sessionId).'/messages'), $this->onlyKeys($params, [
            'after',
            'first',
        ]));
    }

    /**
     * List attachments for a v3 Devin session.
     *
     * @param  string  $sessionId  Devin session ID.
     * @param  array<string, mixed>  $params  Cursor pagination parameters.
     * @return array<string, mixed>
     */
    public function listSessionAttachments(string $sessionId, array $params = []): array
    {
        $this->requireV3('Session attachment listing');

        return $this->request('GET', $this->organizationPath('/sessions/'.$this->path($sessionId).'/attachments'), $this->onlyKeys($params, [
            'after',
            'first',
        ]));
    }

    /**
     * Get tags for a v3 Devin session.
     *
     * @param  string  $sessionId  Devin session ID.
     * @return array<string, mixed>
     */
    public function getSessionTags(string $sessionId): array
    {
        $this->requireV3('Session tag reads');

        return $this->request('GET', $this->organizationPath('/sessions/'.$this->path($sessionId).'/tags'));
    }

    /**
     * Append tags to a Devin session.
     *
     * @param  string  $sessionId  Devin session ID.
     * @param  array<int, string>  $tags  Tags to append.
     * @return array<string, mixed>
     */
    public function appendSessionTags(string $sessionId, array $tags): array
    {
        if ($this->usesLegacyV1()) {
            return $this->request('PUT', '/v1/sessions/'.$this->path($sessionId).'/tags', ['tags' => $tags]);
        }

        return $this->request('POST', $this->organizationPath('/sessions/'.$this->path($sessionId).'/tags'), ['tags' => $tags]);
    }

    /**
     * Get generated insights for a v3 Devin session.
     *
     * @param  string  $sessionId  Devin session ID.
     * @return array<string, mixed>
     */
    public function getSessionInsights(string $sessionId): array
    {
        $this->requireV3('Session insights');

        return $this->request('GET', $this->organizationPath('/sessions/'.$this->path($sessionId).'/insights'));
    }

    /**
     * Trigger on-demand insight generation for a v3 Devin session.
     *
     * @param  string  $sessionId  Devin session ID.
     * @return array<string, mixed>
     */
    public function generateSessionInsights(string $sessionId): array
    {
        $this->requireV3('Session insight generation');

        return $this->request('POST', $this->organizationPath('/sessions/'.$this->path($sessionId).'/insights/generate'));
    }

    /**
     * Get information about the authenticated Devin principal.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        $this->requireV3('Authenticated principal lookup');

        return $this->request('GET', '/v3/self');
    }

    /**
     * List v3 organization secrets without returning secret values.
     *
     * @param  array<string, mixed>  $params  Cursor pagination parameters.
     * @return array<string, mixed>
     */
    public function listSecrets(array $params = []): array
    {
        $this->requireV3('Secret listing');

        return $this->request('GET', $this->organizationPath('/secrets'), $this->onlyKeys($params, [
            'after',
            'first',
        ]));
    }

    /**
     * Create a v3 organization secret.
     *
     * @param  array<string, mixed>  $payload  Secret data including type, key, value, is_sensitive, and optional note.
     * @return array<string, mixed>
     */
    public function createSecret(array $payload): array
    {
        $this->requireV3('Secret creation');

        if (array_key_exists('sensitive', $payload) && !array_key_exists('is_sensitive', $payload)) {
            $payload['is_sensitive'] = $payload['sensitive'];
        }

        return $this->request('POST', $this->organizationPath('/secrets'), $this->onlyKeys($payload, [
            'type',
            'key',
            'value',
            'is_sensitive',
            'note',
        ]));
    }

    /**
     * Delete a v3 organization secret.
     *
     * @param  string  $secretId  Secret ID to delete.
     * @return array<string, mixed>
     */
    public function deleteSecret(string $secretId): array
    {
        $this->requireV3('Secret deletion');

        return $this->request('DELETE', $this->organizationPath('/secrets/'.$this->path($secretId)));
    }

    /**
     * Make an API request and return parsed JSON or a string response wrapper.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        $json = $response->json();

        if (is_array($json)) {
            return $json;
        }

        $body = $response->body();

        return $body === '' ? ['success' => true] : ['response' => $body];
    }

    /**
     * Make a raw HTTP request to the Devin API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return Response
     *
     * @throws RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->apiKey) {
            throw new RuntimeException('Devin API key is not configured.');
        }

        $url = $this->baseUrl.$path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(60);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Devin API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Devin API: {$e->getMessage()}");
        }
    }

    /**
     * Throw a normalized API error.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  Response  $response  Failed response.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = $response->header('Content-Type') ?? '';
        $body = $response->body();

        if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("Devin API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new RuntimeException("Devin API endpoint not available (HTTP {$response->status()}). Check the configured API URL and version.");
        }

        $error = $response->json('detail') ?? $response->json('error') ?? $response->json('message') ?? $body;

        Log::error("Devin API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException("Devin API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
    }

    /**
     * Build an organization-scoped v3 path.
     *
     * @param  string  $path  Resource path beneath the organization.
     */
    private function organizationPath(string $path): string
    {
        if ($this->orgId === '') {
            throw new RuntimeException('Devin org_id is required for v3 organization endpoints. Set org_id or configure a legacy /v1 API URL.');
        }

        return '/v3/organizations/'.$this->path($this->orgId).$path;
    }

    /**
     * Ensure a method is available only in v3 mode.
     *
     * @param  string  $feature  Human-readable feature name.
     */
    private function requireV3(string $feature): void
    {
        if ($this->usesLegacyV1()) {
            throw new RuntimeException("{$feature} requires Devin API v3. Configure the API URL as https://api.devin.ai and set org_id.");
        }
    }

    /**
     * Determine whether this service is using the legacy v1 API.
     */
    private function usesLegacyV1(): bool
    {
        return $this->apiVersion === 'v1';
    }

    /**
     * Build a session payload from agent arguments.
     *
     * @param  string  $prompt  Required session prompt.
     * @param  array<string, mixed>  $options  Additional session fields.
     * @return array<string, mixed>
     */
    private function sessionPayload(string $prompt, array $options): array
    {
        $options['prompt'] = $prompt;

        return $this->withoutNulls($options);
    }

    /**
     * Keep only supported keys and remove null values.
     *
     * @param  array<string, mixed>  $data  Source data.
     * @param  array<int, string>  $keys  Allowed keys.
     * @return array<string, mixed>
     */
    private function onlyKeys(array $data, array $keys): array
    {
        return $this->withoutNulls(array_intersect_key($data, array_flip($keys)));
    }

    /**
     * Remove null values while preserving false, zero, and empty arrays.
     *
     * @param  array<string, mixed>  $data  Source data.
     * @return array<string, mixed>
     */
    private function withoutNulls(array $data): array
    {
        return array_filter($data, static fn (mixed $value): bool => $value !== null);
    }

    /**
     * URL-encode a path segment.
     *
     * @param  string  $value  Path segment value.
     */
    private function path(string $value): string
    {
        return rawurlencode($value);
    }
}
